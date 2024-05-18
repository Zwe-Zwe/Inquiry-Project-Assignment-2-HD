<?php

include "../connection.php";

$id = $userid = $email = $password = $error ="";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['cancel'])) {
        header("Location: index.php");
        exit();
    } else if (isset($_POST['submit']) && $_POST['submit'] == 'Update') {
        $id = $_POST["id"];
        $userid = $_POST["userid"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        $sql = "UPDATE users SET userid=?, email=?, password=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi",$userid, $email, $password, $id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            header("Location: index.php");
            exit();
        } else {
            $error = "Error updating user. No changes were made or the user does not exist.";
        }
        $stmt->close();
    } else if (isset($_POST['submit']) && $_POST['submit'] == 'Create') {
        $userid = $_POST["userid"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        $sql = "INSERT INTO users (userid, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $userid, $email, $password);
        if ($stmt->execute()) {
            header("Location: index.php");
            exit();
        } else {
            $error = "Error creating user.";
        }
        $stmt->close();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['action'])) {
    if ($_GET['action'] == 'delete' && isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "DELETE FROM users WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();

        header('Location: index.php');
        exit();
    } else if ($_GET['action'] == 'edit' && isset($_GET['id'])) {
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

// Default sorting order
$sortOrder = "ASC"; // Default ascending order

// Check if sorting order is provided in the URL
if (isset($_GET['sort']) && ($_GET['sort'] == 'asc' || $_GET['sort'] == 'desc')) {
    $sortOrder = ($_GET['sort'] == 'desc') ? 'DESC' : 'ASC';
    $sql = "SELECT * FROM users ORDER BY email $sortOrder";
} else {
    $sql = "SELECT * FROM users";
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
<body>
    <section id="management">
    <div class="container">
        <aside class="sidebar">
            <div class="logo"><img src="../images/logo2.png"></div>
            <nav>
                <ul>
                    <li><a href="#">User Management</a></li>
                    <li><a href="index.php?action=add">Add New User</a></li>
                    <li><a href="#">Enquiry Forms</a></li> 
                    <li><a href="#">Volunteer Forms</a></li> 
                </ul>
            </nav>
        </aside>
        <main>
            <header>
               
                
            </header>
            <section class="user-management">
                <div id="table_top">
                    <h1>User management</h1>
                    <a class="sort_logout" href="?sort=''">Default</a>  <a class="sort_logout" href="?sort=asc">Sort Ascending</a>  <a class="sort_logout" href="?sort=desc">Sort Descending</a>
                    <a class="sort_logout" href="../index.php">Logout</a>
                </div>    
                <table>
                    
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
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
                               
                                
                                    <a id='edit-button' href='index.php?action=edit&id={$row['id']}'>Edit</a>
                                    <a id='delete-button' href='index.php?action=delete&id={$row['id']}'>Delete</a>";
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
                        <a class="close-btn" href="index.php">&times;</a>
                        <form method="post">
                            <h1><?php echo $_GET['action'] == 'edit' ? 'Update User' : 'Create New User'; ?></h1>
                            <?php if ($_GET['action'] == 'edit'): ?>
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
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
            </section>
        </main>
    </div>
    </section>
</body>
</html>
