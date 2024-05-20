<?php

include "../connection.php";

$id = $userid = $feedback = $created_at = $activity_id = $error ="";


if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['action'])) {
    if ($_GET['action'] == 'delete' && isset($_GET['id'])) {
        $id = $_GET['id'];

        // Delete the row
        $sql_delete = "DELETE FROM activity_feedbacks WHERE id=?";
        $stmt_delete = $conn->prepare($sql_delete);
        $stmt_delete->bind_param("i", $id);
        $stmt_delete->execute();
        $stmt_delete->close();

        // Retrieve IDs of rows with IDs greater than the deleted row's ID
        $sql_get_higher_ids = "SELECT id FROM activity_feedbacks WHERE id > ?";
        $stmt_get_higher_ids = $conn->prepare($sql_get_higher_ids);
        $stmt_get_higher_ids->bind_param("i", $id);
        $stmt_get_higher_ids->execute();
        $result_higher_ids = $stmt_get_higher_ids->get_result();
        
        // Decrement each ID by 1 and update the database
        $sql_update_ids = "UPDATE activity_feedbacks SET id = id - 1 WHERE id = ?";
        $stmt_update_ids = $conn->prepare($sql_update_ids);
        while ($row_higher_ids = $result_higher_ids->fetch_assoc()) {
            $stmt_update_ids->bind_param("i", $row_higher_ids['id']);
            $stmt_update_ids->execute();
        }


        $sql_reset_auto_increment = "ALTER TABLE activity_feedbacks AUTO_INCREMENT = 1";
        $conn->query($sql_reset_auto_increment);

        header('Location: feedback_management.php');
        exit();
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
$sql = "SELECT * FROM activity_feedbacks ORDER BY $sortBy $sortOrder";
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
                    <li><a href="activities_management.php">Activities</a></li>
                    <li><a id="current_tab" href="feedback_management.php">Feedbacks</a></li>
                </ul>
            </nav>
        </aside>
        <main>
            <section class="user-management">
            <h1>Feedback Management</h1>
                <div id="table_top">                  
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
                                <td><a id='delete-button' href='feedback_management.php?action=delete&id={$row['id']}'>Delete</a></td>              
                            </tr>
                            ";
                        
                    }
                    

                        ?>
                    
                        <!-- Add table rows here -->
                        
        
                        <!-- Continue for other rows -->
    
                </table>             
            </section>
        </main>
    </div>
    </section>
</body>
</html>
