<?php

include "../connection.php";

$id = $title = $date= $description = $photo = $error ="";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['cancel'])) {
        header("Location: activities_management.php");
        exit();
    } else if (isset($_POST['submit']) && $_POST['submit'] == 'Update') {
        $id = $_POST["id"];
        $title = $_POST["title"];
        $date = $_POST["date"];
        $description = $_POST["description"];
        $photo = $_POST["photo"];

        if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0) {
            $target_dir = "../images/";
            $target_file = $target_dir . basename($_FILES["photo"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            $allowed_types = ["jpg", "jpeg", "png", "gif"];
            if (in_array($imageFileType, $allowed_types)) {
                if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                    $photo = basename($_FILES["photo"]["name"]);
                } else {
                    $error = "Sorry, there was an error uploading your file.";
                }
            } else {
                $error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            }
        }

        $sql = "UPDATE activities SET title=?, date=?, description=?, photo=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $title, $date, $description, $photo, $id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            header("Location: index.php");
            exit();
        } else {
            $error = "Error updating user. No changes were made or the user does not exist.";
        }
        $stmt->close();
    } else if (isset($_POST['submit']) && $_POST['submit'] == 'Create') {
        $title = $_POST["title"];
        $date = $_POST["date"];
        $description = $_POST["description"];
        $photo = $_POST['photo'];

        if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0) {
            $target_dir = "../images/";
            $target_file = $target_dir . basename($_FILES["photo"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            $allowed_types = ["jpg", "jpeg", "png", "gif"];
            if (in_array($imageFileType, $allowed_types)) {
                if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                    $photo = basename($_FILES["photo"]["name"]);
                } else {
                    $error = "Sorry, there was an error uploading your file.";
                }
            } else {
                $error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            }
        }

        $sql = "INSERT INTO activities (title, date, description, photo) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $title, $date, $description, $photo);
        if ($stmt->execute()) {
            header("Location: index.php");
            exit();
        } else {
            $error = "Error creating activity.";
        }
        $stmt->close();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['action'])) {
    if ($_GET['action'] == 'delete' && isset($_GET['id'])) {
        $id = $_GET['id'];

        // Delete the row
        $sql_delete = "DELETE FROM activities WHERE id=?";
        $stmt_delete = $conn->prepare($sql_delete);
        $stmt_delete->bind_param("i", $id);
        $stmt_delete->execute();
        $stmt_delete->close();

        // Retrieve IDs of rows with IDs greater than the deleted row's ID
        $sql_get_higher_ids = "SELECT id FROM activities WHERE id > ?";
        $stmt_get_higher_ids = $conn->prepare($sql_get_higher_ids);
        $stmt_get_higher_ids->bind_param("i", $id);
        $stmt_get_higher_ids->execute();
        $result_higher_ids = $stmt_get_higher_ids->get_result();
        
        // Decrement each ID by 1 and update the database
        $sql_update_ids = "UPDATE activities SET id = id - 1 WHERE id = ?";
        $stmt_update_ids = $conn->prepare($sql_update_ids);
        while ($row_higher_ids = $result_higher_ids->fetch_assoc()) {
            $stmt_update_ids->bind_param("i", $row_higher_ids['id']);
            $stmt_update_ids->execute();
        }


        $sql_reset_auto_increment = "ALTER TABLE activities AUTO_INCREMENT = 1";
        $conn->query($sql_reset_auto_increment);

        header('Location: activities_management.php');
        exit();
    } else if ($_GET['action'] == 'edit' && isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM activities WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if ($row) {
            $title = $row["title"];
            $date = $row["date"];
            $description = $row["description"];
            $photo = $row["photo"];
        }
        $stmt->close();
    } else if ($_GET['action'] == 'view' && isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM activities WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if ($row) {
            $title = $row["title"];
            $date = $row["date"];
            $description = $row["description"];
            $photo = $row["photo"];
        }
        $stmt->close();
    }
    
}







// Initialize $sortBy and $sortOrder with default values
$sortBy = "id";
$sortOrder = "ASC";

// Check if sorting order is provided in the URL


// Check if sorting column is provided in the URL
if (isset($_GET['sortBy'])) {
    // Assign the value from the query string to $sortBy
    $sortBy = $_GET['sortBy'];

    // Additional validation if necessary
    // For example, you might want to ensure that $sortBy is one of the allowed values
    // You can use a switch statement or if conditions for this purpose
}

if (isset($_GET['sort']) && ($_GET['sort'] == 'asc' || $_GET['sort'] == 'desc')) {
    $sortOrder = ($_GET['sort'] == 'desc') ? 'DESC' : 'ASC';
}

// Construct SQL query based on $sortBy and $sortOrder
$sql = "SELECT * FROM activities ORDER BY $sortBy $sortOrder";
$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Panel (Users)</title>
    <meta charset="utf-8" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="Daniel Sie, Zwe Htet Zaw, Paing Chan" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="images/love-you-gesture-svgrepo-com.svg" type="images/svg" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../styles/style.css" />
    <style>
    

    </style>
</head>
<body id = management_body>
    <section id="management">
    <div class="container">
        <aside class="sidebar">
            <div class="logo"><img src="../images/logo2.png"></div>
            <nav>
                <ul>
                    <li><a href="index.php">User Management</a></li>
                    <li><a href="#">Enquiry Forms</a></li> 
                    <li><a href="#">Volunteer Forms</a></li>
                    <li><a id="current_tab" href="activities_management.php">Activities</a></li>
                    <li><a href="feedback_management.php">Feedbacks</a></li>
                </ul>
            </nav>
        </aside>
        <main>
            <section class="user-management">
            <h1>Activity Management</h1>
                <div id="table_top">                  
                    <div class="dropdown">
                    <button class="dropbtn">Sort By: <?php echo strtoupper($sortBy); ?></button>
                        <div class="dropdown-content">
                            <a href="?sortBy=id">ID</a>
                            <a href="?sortBy=title">TITLE</a>
                            <a href="?sortBy=date">DATE</a>
                        </div>
                    </div>
                    <a class="sort_logout" href="?sort=asc&sortBy=<?php echo $sortBy; ?>">Sort Ascending</a>
                    <a class="sort_logout" href="?sort=desc&sortBy=<?php echo $sortBy; ?>">Sort Descending</a>
                    <a class="sort_logout" href="activities_management.php?action=add">Add New Activty</a>  
                    <a class="sort_logout" href="../index.php">Logout</a>
                </div>    
                <table>
                    
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        
                        <?php
                        if (!$result) {
                            die("Invalid query!");
                        }
                        while ($row = $result->fetch_assoc()) {
                        
                            
                            echo "
                            <tr>
                                <td>{$row['id']}</td>
                                <td>{$row['title']}</td>
                                <td>{$row['date']}</td>
                                <td>
                                    <a id='edit-button' href='activities_management.php?action=view&id={$row['id']}'>View</a>                                
                                    <a id='edit-button' href='activities_management.php?action=edit&id={$row['id']}'>Edit</a>
                                    <a id='delete-button' href='activities_management.php?action=delete&id={$row['id']}'>Delete</a>
                                </td>
                            </tr>
                            ";
                        
                    }
                    

                        ?>
                    
                        <!-- Add table rows here -->
                        
        
                        <!-- Continue for other rows -->
    
                </table>
                <?php if (isset($_GET['action']) && ($_GET['action'] == 'add' || ($_GET['action'] == 'edit' && isset($_GET['id'])))): ?>
                <div id="user-edit" class="pop-up">
                    <div class="pop-up-content-activity">
                        <a class="close-btn" href="activities_management.php">&times;</a>
                        <form method="post">
                            <h1><?php echo $_GET['action'] == 'edit' ? 'Update User\'s Info' : 'Create New User'; ?></h1>
                            <?php if ($_GET['action'] == 'edit'): ?>
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                            <?php endif; ?>
                            <label for="title"> Title: </label>
                            <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($title); ?>"> <br>
                            <label for="email1"> Date: (DD/MM/YYYY) </label>
                            <input type="text" name="date" id="date" value="<?php echo htmlspecialchars($date); ?>"> <br>
                            <label for="description"> Description:</label>
                            <textarea rows="10" cols="76" name="description" id="description"><?php echo htmlspecialchars($description); ?></textarea> <br>
                            <label for="photo">Photo: </label>
                            <?php if (isset($_GET['action']) && $_GET['action'] == 'edit') { ?>
                                <img src="../images/<?php echo htmlspecialchars($photo); ?>" alt="activity_image" id="display_img" /><br>
                            <?php } ?>
                            <input type="file" id="photo" name="photo"> <br>
                            <input type="submit" name="submit" value="<?php echo $_GET['action'] == 'edit' ? 'Update' : 'Create'; ?>">
                            <input type="submit" name="cancel" value="Cancel">
                        </form>
                    </div>
                </div>
                <?php endif; ?>

                <?php if (isset($_GET['action']) && ($_GET['action'] == 'view'&& isset($_GET['id']))): ?>
                <div id="user-edit" class="pop-up">
                    <div class="pop-up-content-activity">
                        <a class="close-btn" href="activities_management.php">&times;</a>
                        <form method="post">
                            
                            <h1><?php echo $title; ?></h1> <br>  
                            <p><?php echo $date; ?></p> <br>
                            <p><?php echo $description; ?></p> <br>
                                                      
                            <img src="../images/<?php echo htmlspecialchars($photo); ?>" alt="activity_image" id="display_img" /><br>   
                            <input type="submit" name="cancel" value="Cancel">  
                         </form>                     
                    </div>
                </div>
                <?php endif; ?>
            </section>
        </main>
    </div>
    </section>
</body>
</html>
