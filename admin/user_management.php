<?php

include "../connection.php";

$id = $userid = $email = $password = $error ="";


// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['cancel'])) {
        header("Location: user_management.php");
        exit(); 
    } 


    if (isset($_POST["userid"], $_POST["email"], $_POST["password"])) {
        // Assign values if they are set
        $userid = $_POST["userid"];
        $email = $_POST["email"];
        $password = $_POST["password"];
    }    

    if (empty($userid) || empty($email) || empty($password)) {
        $error = "Please fill in all the required fields.";
    } else {
        $password_hashed = password_hash($password, PASSWORD_BCRYPT);
        
        if (isset($_POST['submit']) && $_POST['submit'] == 'Update') {
            $id = $_POST["id"];
            $sql = "UPDATE users SET userid=?, email=?, password=?, password_hashed=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssi", $userid, $email, $password, $password_hashed, $id);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                header("Location: user_management.php");
                exit();
            } else {
                $error = "Error updating user. No changes were made or the user does not exist.";
            }
            $stmt->close();
        } else if (isset($_POST['submit']) && $_POST['submit'] == 'Create') {
        
            $sql = "INSERT INTO users (userid, email, password, password_hash) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $userid, $email, $password, $password_hashed);
            if ($stmt->execute()) {
                header("Location: user_management.php");
                exit();
            } else {
                $error = "Error creating user.";
            }
            $stmt->close();
        }      
    }

    if (isset($_POST['submit']) && $_POST['submit'] == 'delete') {
        $id = $_POST["id"];
    
        // Delete the user
        $sqlDelete = "DELETE FROM users WHERE id = ?";
        $stmtDelete = $conn->prepare($sqlDelete);
        if ($stmtDelete) {
            $stmtDelete->bind_param("i", $id);
            if ($stmtDelete->execute()) {
                // Close the statement
                $stmtDelete->close();
    
                // Update the IDs of rows with higher IDs
                $sqlUpdate = "UPDATE users SET id = id - 1 WHERE id > ?";
                $stmtUpdate = $conn->prepare($sqlUpdate);
                if ($stmtUpdate) {
                    $stmtUpdate->bind_param("i", $id);
                    $stmtUpdate->execute();
                    $stmtUpdate->close();
                } else {
                    $error = "Error preparing update statement: " . $conn->error;
                }
    
                // Reset the auto-increment value
                if ($conn->query("ALTER TABLE users AUTO_INCREMENT = 1")) {
                    header("Location: user_management.php");
                    exit();
                } else {
                    $error = "Error resetting auto-increment value: " . $conn->error;
                }
            } else {
                $error = "Error deleting user: " . $stmtDelete->error;
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
        $sql = "SELECT * FROM users WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if ($row) {
            $userid = $row["userid"];
            $email = $row["email"];
            $password = $row["password"];
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
    $sql = "SELECT * FROM users WHERE userid LIKE '%$search%' ORDER BY $sortBy $sortOrder";
} else {
    $sql = "SELECT * FROM users ORDER BY $sortBy $sortOrder";
}

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
<body id = 'management_body'>
    <div class="container">
    <section id="management">
    <input type="checkbox" id="menu-toggle" class="menu-toggle">
    <label for="menu-toggle" class="menu-toggle-label">☰</label>
        <aside class="sidebar">
            <div class="logo"><img src="../images/logo2.png"></div>
            <nav>
                <ul>
                    <li><a id="current_tab" href="#">User Management</a></li>
                    <li><a href="viewenquiry.php">Enquiry Forms</a></li> 
                    <li><a href="#">Volunteer Forms</a></li>
                    <li><a href="activities_management.php">Activities</a></li>
                    <li><a href="feedback_management.php">Feedbacks</a></li>
                </ul>
            </nav>
        </aside>
        <main>
            <section class="user-management">
            <h1>User Management</h1>
                <div id="table_top">    
                    <form method="GET" action="user_management
                    .php" id="search_form">
                        <input type="text" name="search" placeholder="Search by UserID" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                        <input type="submit" value="Search">
                    </form>              
                    <div class="dropdown">
                    <button class="dropbtn">Sort By: <?php echo strtoupper($sortBy); ?></button>
                        <div class="dropdown-content">
                            <a href="?sortBy=id">ID</a>
                            <a href="?sortBy=userid">UserID</a>
                            <a href="?sortBy=email">Email</a>
                        </div>
                    </div>
                    <a class="sort_logout" href="?sort=asc&sortBy=<?php echo $sortBy; ?>">Sort Ascending</a>
                    <a class="sort_logout" href="?sort=desc&sortBy=<?php echo $sortBy; ?>">Sort Descending</a>
                    <a class="sort_logout" href="user_management.php?action=add">Add New User</a>  
                    <a class="sort_logout" href="../index.php">Logout</a>
                </div>    
                <table>
                    
                        <tr>
                            <th>ID</th>
                            <th>UserID</th>
                            <th>Password</th>
                            <th>Email</th>
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
                                <td>{$row['userid']}</td>
                                <td>{$row['password']}</td>
                                <td>{$row['email']}</td>  <td>  ";

                                if ($row['userid'] != 'admin') {
                                echo "
                               
                                
                                    <a id='edit-button' href='user_management
                                    .php?action=edit&id={$row['id']}'>Edit</a>
                                    <a id='delete-button' href='user_management.php?action=confirm_delete&id={$row['id']}'>Delete</a>";
                                }
                                echo"
                                </td>
                            </tr>
                            ";
                        
                    }
                    

                        ?>
                    
                        <!-- Add table rows here -->
                        
        
                        <!-- Continue for other rows -->
    
                </table>
                <?php if (isset($_GET['action']) && ($_GET['action'] == 'add' || ($_GET['action'] == 'edit' && isset($_GET['id'])))): ?>
                    <div id="user-edit" class="pop-up" style="display: flex;">
                        <div class="pop-up-content">
                            <a class="close-btn" href="user_management
                            .php">&times;</a> 
                            <?php if (!empty($error)) echo "<p style='color: red;'>$error</p>"; ?>                           
                            <form method="post">
                                <h1><?php echo $_GET['action'] == 'edit' ? 'Update User\'s Info' : 'Create New User'; ?></h1>
                                <?php if ($_GET['action'] == 'edit'): ?>
                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($_GET['id']); ?>">
                                <?php endif; ?>
                                <label for="userid"> USER ID: </label>
                                <input type="text" name="userid" id="userid" value="<?php echo htmlspecialchars($userid); ?>"> <br>
                                <label for="email1"> EMAIL: </label>
                                <input type="text" name="email" id="email1" value="<?php echo htmlspecialchars($email); ?>"> <br>
                                <label for="password"> PASSWORD: </label>
                                <input type="text" name="password" id="password" value="<?php echo htmlspecialchars($password); ?>"> <br>
                                <input type="submit" name="submit" value="<?php echo $_GET['action'] == 'edit' ? 'Update' : 'Create'; ?>">
                                <input type="submit" name="cancel" value="Cancel">
                            </form>
                            
                        </div>
                    </div>
                <?php endif; ?>

                <?php if(isset($_GET['action']) && ($_GET['action'] == 'confirm_delete' && isset($_GET['id']))) { ?>
                    <div id="user-edit" class="pop-up" style="display: flex;">
                        <div class="pop-up-content">
                            <a class="close-btn" href="user_management.php">&times;</a>
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