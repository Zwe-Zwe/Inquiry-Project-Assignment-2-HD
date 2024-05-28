<?php

include "../connection.php";

$id = $userid = $feedback = $created_at = $activity_id = $error ="";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['cancel'])) {
        header("Location: feedback_management.php");
        exit(); 
    }
    if (isset($_POST['submit']) && $_POST['submit'] == 'delete') {
        $id = $_POST["id"];
    
        // Delete the user
        $sqlDelete = "DELETE FROM activity_feedbacks WHERE id = ?";
        $stmtDelete = $conn->prepare($sqlDelete);
        if ($stmtDelete) {
            $stmtDelete->bind_param("i", $id);
            if ($stmtDelete->execute()) {
                // Close the statement
                $stmtDelete->close();
    
                // Update the IDs of rows with higher IDs
                $sqlUpdate = "UPDATE activity_feedbacks SET id = id - 1 WHERE id > ?";
                $stmtUpdate = $conn->prepare($sqlUpdate);
                if ($stmtUpdate) {
                    $stmtUpdate->bind_param("i", $id);
                    $stmtUpdate->execute();
                    $stmtUpdate->close();
                } else {
                    $error = "Error preparing update statement: " . $conn->error;
                }
    
                // Reset the auto-increment value
                if ($conn->query("ALTER TABLE activity_feedbacks AUTO_INCREMENT = 1")) {
                    header("Location: feedback_management.php");
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
    $sql = "SELECT * FROM activity_feedbacks WHERE userid LIKE '%$search%' ORDER BY $sortBy $sortOrder";
} else {
    $sql = "SELECT * FROM activity_feedbacks ORDER BY $sortBy $sortOrder";
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
<body id = management_body>
    <section id="management">
    <div class="container">
        <aside class="sidebar">
            <div class="logo"><img src="../images/logo2.png"></div>
            <nav>
                <ul>
                    <li><a href="user_management.php">User Management</a></li>
                    <li><a href="#">Enquiry Forms</a></li> 
                    <li><a href="#">Volunteer Forms</a></li>
                    <li><a href="activities_management.php">Activities</a></li>
                    <li><a id="current_tab" href="feedback_management.php">Feedbacks</a></li>
                </ul>
            </nav>
        </aside>
        <main>
            <section class="user-management">
            <h1>Feedback Management</h1>
                <div id="table_top"> 
                <form method="GET" action="feedback_management.php" id="search_form">
                        <input type="text" name="search" placeholder="Search by UserID" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                        <input type="submit" value="Search">
                    </form>                 
                    <div class="dropdown">
                    <button class="dropbtn">Sort By: <?php echo strtoupper($sortBy); ?></button>
                        <div class="dropdown-content">
                            <a href="?sortBy=id">ID</a>
                            <a href="?sortBy=activity_id">AcitvityID</a>
                            <a href="?sortBy=userid">UserID</a>
                        </div>
                    </div>
                    <a class="sort_logout" href="?sort=asc&sortBy=<?php echo $sortBy; ?>">Sort Ascending</a>
                    <a class="sort_logout" href="?sort=desc&sortBy=<?php echo $sortBy; ?>">Sort Descending</a> 
                    <a class="sort_logout" href="../index.php">Logout</a>
                </div>    
                <table>
                    
                        <tr>
                            <th>ID</th>
                            <th>Activity ID</th>
                            <th>User ID</th>
                            <th>Feedback</th>
                            <th>Date Created</th>
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
                                <td>{$row['activity_id']}</td>
                                <td>{$row['userid']}</td>
                                <td>{$row['feedback']}</td>
                                <td>{$row['created_at']}</td>
                                <td><a id='delete-button' href='feedback_management.php?action=confirm_delete&id={$row['id']}'>Delete</a></td>              
                            </tr>
                            ";
                        
                    }
                    

                        ?>
                    
                        <!-- Add table rows here -->
                        
        
                        <!-- Continue for other rows -->
    
                </table>  
                <?php if(isset($_GET['action']) && ($_GET['action'] == 'confirm_delete' && isset($_GET['id']))) { ?>
                    <div id="user-edit" class="pop-up" style="display: flex;">
                        <div class="pop-up-content">
                            <a class="close-btn" href="feedback_management.php">&times;</a>
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
