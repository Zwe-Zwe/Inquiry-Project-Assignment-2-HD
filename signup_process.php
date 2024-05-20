<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = ""; // Replace with your database password
$dbname = "MSL";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userid = $_POST['userID'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];

    // Check for missing input
    if (empty($userid)) {
        header("Location: signup.php?error=User ID is required");
        exit();
    }
    if (empty($email)) {
        header("Location: signup.php?error=Email is required");
        exit();
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: signup.php?error=Invalid email format");
        exit();
    }
    if (empty($password)) {
        header("Location: signup.php?error=Password is required");
        exit();
    }
    if (strlen($password) <= 5) {
        header("Location: signup.php?error=Password must be more than 5 characters");
        exit();
    }
    if (empty($confirmpassword)) {
        header("Location: signup.php?error=Confirm Password is required");
        exit();
    }
    if ($password !== $confirmpassword) {
        header("Location: signup.php?error=Passwords do not match");
        exit();
    }

    // Check if User ID or Email already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE userid = ? OR email = ?");
    $stmt->bind_param("ss", $userid, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row['userid'] === $userid) {
            header("Location: signup.php?error=User ID already exists");
            exit();
        } elseif ($row['email'] === $email) {
            header("Location: signup.php?error=Email already exists");
            exit();
        }
    }

    // Hash the password before storing it
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO users (userid, email, password, password_hashed) VALUES (?, ?, ?,?)");
    $stmt->bind_param("ssss", $userid, $email, $password, $hashed_password);

    // Execute the statement
    if ($stmt->execute()) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Malaysian Sign Language</title>
    <meta charset="utf-8">
    <meta name="description" content="volunteer">
    <meta name="keywords" content="volunteer">
    <meta name="author" content="Daniel Sie, Zwe Htet Zaw, Paing Chan, Sherlyn Kok, Michael Wong">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/love-you-gesture-svgrepo-com.svg" type="images/svg">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
<header>
    <?php include "header.php" ?>
</header>

<section class="user-body">
    <div class="user-container">
        <h1>Registered Successfully</h1>
        <p>Welcome to our community! We are happy to see you here. Please double-check your information below again.
        </p>
        <div id="user_info">
            <p>User ID: <?php echo $userid; ?></p>
            <p>Email: <?php echo $email; ?></p>
            <p>Password: <?php echo $password; ?></p> <!-- Displaying plain password -->
        </div>
    </div>
</section>

<footer>
    <?php include "footer.php"; ?>
</footer>
</body>
</html>
<?php
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>

  </body>
</html>



