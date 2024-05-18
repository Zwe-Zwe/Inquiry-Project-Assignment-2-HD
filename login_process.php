<?php
session_start();
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "MSL";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userid = $_POST['userID'];
    $password = $_POST['password'];

    // Check for missing input
    if (empty($userid) || empty($password)) {
        header("Location: login.php?error=User ID and Password are required");
        exit();
    }

    // Prepare and bind
    $stmt = $conn->prepare("SELECT * FROM users WHERE userid = ?");
    $stmt->bind_param("s", $userid);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Password is correct, start a new session
            $_SESSION['login_user'] = $userid;
            if($userid == "admin"){
                header("Location: admin/index.php");
            } else {
                header("Location: index.php"); // Redirect to welcome page
            }
            exit();
        } else {
            // Incorrect password
            header("Location: login.php?error=Incorrect password");
            exit();
        }
    } else {
        // User ID not found
        header("Location: login.php?error=User ID not found");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>

