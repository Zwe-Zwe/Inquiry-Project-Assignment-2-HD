<?php

include "../connection.php";

$id = $title = $date = $description = $photo = $error = "";

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
        $photo = $_POST['original_photo'];

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
            header("Location: activities_management.php");
            exit();
        } else {
            $error = "Error updating activity. No changes were made or the activity does not exist.";
        }
        $stmt->close();
    } else if (isset($_POST['submit']) && $_POST['submit'] == 'Create') {
        $title = $_POST["title"];
        $date = $_POST["date"];
        $description = $_POST["description"];
        $photo = "";

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

        // Begin transaction
        $conn->begin_transaction();

        try {
            // Step 1: Increment the ID of all existing rows by 1 in reverse order
            $sql_update = "UPDATE activities SET id = id + 1 ORDER BY id DESC";
            if (!$conn->query($sql_update)) {
                throw new Exception("Error updating IDs: " . $conn->error);
            }

            // Step 2: Insert the new row with ID 1
            $sql_insert = "INSERT INTO activities (id, title, date, description, photo) VALUES (1, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql_insert);
            $stmt->bind_param("ssss", $title, $date, $description, $photo);

            if (!$stmt->execute()) {
                throw new Exception("Error creating activity: " . $stmt->error);
            }

            // Commit transaction
            $conn->commit();
            header("Location: activities_management.php");
            exit();
        } catch (Exception $e) {
            // Rollback transaction on error
            $conn->rollback();
            $error = $e->getMessage();
        }

        $stmt->close();
    }
    elseif (isset($_POST['submit']) && $_POST['submit'] == 'delete') {
        $id = $_POST["id"];
    
        // Delete the user
        $sqlDelete = "DELETE FROM activities WHERE id = ?";
        $stmtDelete = $conn->prepare($sqlDelete);
        if ($stmtDelete) {
            $stmtDelete->bind_param("i", $id);
            if ($stmtDelete->execute()) {
                // Close the statement
                $stmtDelete->close();
    
                // Update the IDs of rows with higher IDs
                $sqlUpdate = "UPDATE activities SET id = id - 1 WHERE id > ?";
                $stmtUpdate = $conn->prepare($sqlUpdate);
                if ($stmtUpdate) {
                    $stmtUpdate->bind_param("i", $id);
                    $stmtUpdate->execute();
                    $stmtUpdate->close();
                } else {
                    $error = "Error preparing update statement: " . $conn->error;
                }
    
                // Reset the auto-increment value
                if ($conn->query("ALTER TABLE activities AUTO_INCREMENT = 1")) {
                    header("Location: activities_management.php");
                    exit();
                } else {
                    $error = "Error resetting auto-increment value: " . $conn->error;
                }
            } else {
                $error = "Error deleting activity: " . $stmtDelete->error;
            }
        } else {
            $error = "Error preparing delete statement: " . $conn->error;
        }
        
        $stmtDelete->close();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['action'])) {
   
     if ($_GET['action'] == 'edit' && isset($_GET['id'])) {
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
$search = "";

// Check if sorting order is provided in the URL
if (isset($_GET['sortBy'])) {
    $sortBy = $_GET['sortBy'];
}

if (isset($_GET['sort']) && ($_GET['sort'] == 'asc' || $_GET['sort'] == 'desc')) {
    $sortOrder = ($_GET['sort'] == 'desc') ? 'DESC' : 'ASC';
}

// Check if search query is provided in the URL
if (isset($_GET['search'])) {
    $search = $conn->real_escape_string($_GET['search']);
}

// Construct SQL query based on $sortBy, $sortOrder, and $search
if (!empty($search)) {
    $sql = "SELECT * FROM activities WHERE title LIKE '%$search%' ORDER BY $sortBy $sortOrder";
} else {
    $sql = "SELECT * FROM activities ORDER BY $sortBy $sortOrder";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Panel (Activities)</title>
    <meta charset="utf-8" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="Daniel Sie, Zwe Htet Zaw, Paing Chan" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="images/love-you-gesture-svgrepo-com.svg" type="images/svg" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../styles/style.css" />
</head>
<body id="management_body">
    <section id="management">
        <div class="container">
        <input type="checkbox" id="menu-toggle" class="menu-toggle">
        <label for="menu-toggle" class="menu-toggle-label">☰</label>
            <aside class="sidebar">
                <div class="logo"><img src="../images/logo2.png"></div>
                <nav>
                    <ul>
                        <li><a href="user_management.php">User Management</a></li>
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
                        <form method="GET" action="activities_management.php" id="search_form">
                            <input type="text" name="search" placeholder="Search by Title" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                            <input type="submit" value="Search">
                        </form>
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
                        <a class="sort_logout" href="activities_management.php?action=add">Add New Activity</a>
                 _       <a class="sort_logout" href="../index.php">Logout</a>
                    </div>
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Date</th>
                            <th>Photo</th>
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
                                <td><img id='activity-img' src='../images/{$row['photo']}'></td>
                                <td>
                                    <a id='edit-button' href='activities_management.php?action=view&id={$row['id']}'>View</a>
                                    <a id='edit-button' href='activities_management.php?action=edit&id={$row['id']}'>Edit</a>
                                    <a id='delete-button' href='activities_management.php?action=confirm_delete&id={$row['id']}'>Delete</a>
                                </td>
                            </tr>
                            ";
                        }
                        ?>
                    </table>
                    <?php if (isset($_GET['action']) && ($_GET['action'] == 'add' || ($_GET['action'] == 'edit' && isset($_GET['id'])))): ?>
                    <div id="user-edit" class="pop-up">
                        <div class="pop-up-content-activity">
                            <a class="close-btn" href="activities_management.php">&times;</a>
                            <form method="post" enctype="multipart/form-data">
                                <h1><?php echo $_GET['action'] == 'edit' ? 'Update Activity' : 'Create New Activity'; ?></h1>
                                <?php if ($_GET['action'] == 'edit'): ?>
                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                                <?php endif; ?>
                                <input type="hidden" name="original_photo" value="<?php echo htmlspecialchars($photo); ?>">
                                <label for="title">Title:</label>
                                <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($title); ?>"> <br>
                                <label for="date">Date: (DD/MM/YYYY)</label>
                                <input type="text" name="date" id="date" value="<?php echo htmlspecialchars($date); ?>"> <br>
                                <label for="description">Description:</label>
                                <textarea rows="10" cols="76" name="description" id="description"><?php echo htmlspecialchars($description); ?></textarea> <br>
                                <label for="photo">Photo:</label>
                                <?php if ($_GET['action'] == 'edit' && !empty($photo)): ?>
                                    <img src="../images/<?php echo htmlspecialchars($photo); ?>" alt="activity_image" id="display_img" /><br>
                                <?php endif; ?>
                                <input type="file" name="photo" id="photo"><br>
                                <input type="submit" name="submit" value="<?php echo $_GET['action'] == 'edit' ? 'Update' : 'Create'; ?>">
                                <input type="submit" name="cancel" value="Cancel">
                            </form>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if (isset($_GET['action']) && ($_GET['action'] == 'view' && isset($_GET['id']))): ?>
                    <div id="user-edit" class="pop-up">
                        <div class="pop-up-content-activity">
                            <a class="close-btn" href="activities_management.php">&times;</a>
                            <form method="post">
                                <h1><?php echo $title; ?></h1> <br>
                                <p> <?php 
                                    echo 'Date: <br>'; 
                                    echo $date; 
                                ?></p> <br>

                                <p>
                                    <?php 
                                    echo 'Description: <br>';
                                    echo $description; 
                                    ?></p> <br>
                                <img src="../images/<?php echo htmlspecialchars($photo); ?>" alt="activity_image" id="display_img" /><br>
                                <input type="submit" name="cancel" value="Cancel">
                            </form>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if(isset($_GET['action']) && ($_GET['action'] == 'confirm_delete' && isset($_GET['id']))) { ?>
                    <div id="user-edit" class="pop-up" style="display: flex;">
                        <div class="pop-up-content">
                            <a class="close-btn" href="activities_management.php">&times;</a>
                            <form method="post">
                                <h1>Confrim to Delete!</h1>
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($_GET['id']); ?>">
                                <input type="submit" id='confirm-delete' name="submit" value="delete">
                                <input type="submit" name="cancel" value="Cancel">
                            </form>
                        </div>
                    </div> 
                <?php } ?>
                </section>
            </main>
        </div>
    </section>
</body>
</html>
