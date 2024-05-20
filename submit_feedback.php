<?php
include 'connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $activity_id = $_POST['activity_id'];
    $feedback = $_POST['feedback'];

    // Insert feedback into database
    $sql_insert_feedback = "INSERT INTO activity_feedbacks (activity_id, feedback) VALUES ('$activity_id', '$feedback')";
    if (mysqli_query($conn, $sql_insert_feedback)) {
        // Redirect back to the original page
        header("Location: activities.php");
        exit();
    } else {
        echo "Error: " . $sql_insert_feedback . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
