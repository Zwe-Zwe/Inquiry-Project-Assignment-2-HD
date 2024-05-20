<?php
session_start();
include 'connection.php';

// Handle feedback form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $activity_id = $_POST['activity_id'];
    $userid = isset($_SESSION['login_user']) ? $_SESSION['login_user'] : 'Anonymous';
    $feedback = $_POST['feedback'];

    $stmt = $conn->prepare("INSERT INTO activity_feedbacks (activity_id, userid, feedback) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $activity_id, $userid, $feedback);

    if ($stmt->execute()) {
        header("Location: activities.php?success=Feedback submitted");
    } else {
        header("Location: activities.php?error=Failed to submit feedback");
    }

    $stmt->close();
    $conn->close();
    exit(); // Ensure no further code is executed after handling the form
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Malaysian Sign Language</title>
    <meta charset="utf-8">
    <meta name="description" content="activities">
    <meta name="keywords" content="activities">
    <meta name="author" content="Daniel Sie, Zwe Htet Zaw, Paing Chan, Sherlyn Kok, Michael Wong">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/love-you-gesture-svgrepo-com.svg" type="images/svg">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php include 'header.php'?>

    <article id="activities-container">
        <section>
        <?php
        include 'connection.php';

        // Fetch all activities
        $sql = "SELECT * FROM activities";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                ?>
                <section>
                    <div class="activity-card">
                    <div class="activity-text">
                        <h1><?php echo $row['title']; ?></h1>
                        <p><?php echo $row['date']; ?></p>
                    </div>

                    <div class="activity-content">
                        <div class="activity-content-text">
                            <p>
                                <img src="images/<?php echo $row['photo']; ?>" alt="activity_image" class="activity-image" />
                            </p>
                            <?php echo $row['description']; ?>
                        </div>

                        <form class="feedback-form" action="" method="post">
                            <input type="hidden" name="activity_id" value="<?php echo $row['id']; ?>">
                            <input type="hidden" name="userid" value="<?php echo isset($_SESSION['login_user']) ? $_SESSION['login_user'] : 'Anonymous'; ?>">
                            <textarea rows="2" cols="42" name="feedback" placeholder="Leave your feedback here"></textarea>
                            <button type="submit">Submit Feedback</button>
                        </form>

                        <div class="feedback-section">
                            <?php
                            // Fetch and display feedback for this activity
                            $activityId = $row['id'];
                            $feedbackSql = "SELECT * FROM activity_feedbacks WHERE activity_id = '$activityId'";
                            $feedbackResult = mysqli_query($conn, $feedbackSql);

                            echo "<h3>Feedback</h3>";
                            if (mysqli_num_rows($feedbackResult) > 0) {
                                while ($feedbackRow = mysqli_fetch_assoc($feedbackResult)) {
                                    $timestamp = strtotime($feedbackRow['created_at']);
                                    $timeAgo = time() - $timestamp;
                            
                                    if ($timeAgo < 60) {
                                        $timeAgoString = "Less than a minute ago";
                                    } elseif ($timeAgo < 3600) {
                                        $timeAgoString = ceil($timeAgo / 60) . " minutes ago";
                                    } elseif ($timeAgo < 86400) {
                                        $timeAgoString = ceil($timeAgo / 3600) . " hours ago";
                                    } else {
                                        $timeAgoString = ceil($timeAgo / 86400) . " days ago";
                                    }
                                    $user = !empty($feedbackRow['userid']) ? $feedbackRow['userid'] : 'Anonymous';
                                    echo "<p><strong>" . $user . ":</strong> " . $feedbackRow['feedback'] . " - " . $timeAgoString . "</p>";
                                }
                            } else {
                                echo "<div class='no-feedback'>No feedback yet.</div>";
                            }
                            ?>
                        </div>
                    </div>
                    </div>
                </section>
                <?php
            }
            mysqli_free_result($result);
        } else {
            echo "0 results";
        }

        mysqli_close($conn);
        ?>    
        </section>
    </article>

    <?php include 'back-to-top.php'?>
    <?php include 'footer.php'?>
</body>
</html>
