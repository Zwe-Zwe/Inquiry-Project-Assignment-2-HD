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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <header>
      <?php include "header.php" ?>
    </header>
    
    <section class="volunteer-process-section">
        <div class="form-container">
            <h2>Volunteering Confirmation Details</h2>
            <?php

            include 'connection.php';

            $errors = [];
            $confirmed = false;

            // Check if form is submitted and confirmation is clicked
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm'])) {
                
                $confirmed = true;
                $email = $_POST['email'];
                $phoneNum = $_POST['phone-number'];
                if($_POST['volunteer'] == 'Part-time'){
                    $days = implode(", ", $_POST['day']);
                }

                // Check if email or phone number already exists
                $emailExists = mysqli_query($conn, "SELECT email FROM volunteer_information WHERE email = '$email'");
                $phoneExists = mysqli_query($conn, "SELECT phone_num FROM volunteer_information WHERE phone_num = '$phoneNum'");
                if (mysqli_num_rows($emailExists) > 0) $errors['email'] = "Email already exists.";
                if (mysqli_num_rows($phoneExists) > 0) $errors['phone-number'] = "Phone number already exists.";

                // Insert data if no errors
                if (empty($errors)) {
                    // Prepared statement to prevent SQL injection attacks and improve security by using placeholders and bind parameters
                    $stmt = $conn->prepare("INSERT INTO volunteer_information (first_name, last_name, email, phone_num, street_address, city_or_town, state, postcode, organization, organization_type, days, time, message) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    // Bind parameters to the query and execute the query
                    $stmt->bind_param("sssssssssssss", $_POST['first-name'], $_POST['last-name'], $email, $phoneNum, $_POST['address'], $_POST['city-town'], $_POST['state'], $_POST['postal-code'], $_POST['volunteer-options'], $_POST['volunteer'], $days, $_POST['time'], $_POST['message']);
                    
                    // Execute the query and redirect to join-volunteer.php if successful
                    if ($stmt->execute()) {
                        header("Location: join-volunteer.php");
                        exit();
                    } else {
                        echo "Error inserting data: " . htmlspecialchars($stmt->error);
                    }
                    $stmt->close();
                } else {
                    foreach ($errors as $key => $error) {
                        echo "<p>Error in $key: $error</p>";
                    }
                }
            }

            // Initial process and confirmation display
            if ($_SERVER["REQUEST_METHOD"] == "POST" && !$confirmed) {
                // Initial process: validate data and display for confirmation
                $firstName = filter_input(INPUT_POST, "first-name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $lastName = filter_input(INPUT_POST, "last-name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
                $phoneNumber = filter_input(INPUT_POST, "phone-number", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $address = filter_input(INPUT_POST, "address", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $cityTown = filter_input(INPUT_POST, "city-town", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $state = filter_input(INPUT_POST, "state", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $postalCode = filter_input(INPUT_POST, "postal-code", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $volunteerOptions = filter_input(INPUT_POST, "volunteer-options", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $volunteerType = filter_input(INPUT_POST, "volunteer", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $days = isset($_POST['day']) ? implode(", ", $_POST['day']) : '';
                $time = filter_input(INPUT_POST, "time", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $message = filter_input(INPUT_POST, "message", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                // Bulletproofing - Checking for empty fields and adding corresponding errors
                if (empty($firstName)) $errors['first-name'] = "First name is required.";
                if (empty($lastName)) $errors['last-name'] = "Last name is required.";
                if (!$email) $errors['email'] = "Invalid or empty email.";
                if (empty($phoneNumber)) $errors['phone-number'] = "Phone number is required.";
                if (empty($address)) $errors['address'] = "Address is required.";
                if (empty($cityTown)) $errors['city-town'] = "City or town is required.";
                if (empty($state)) $errors['state'] = "State is required.";
                if (empty($postalCode)) $errors['postal-code'] = "Postal code is required.";
                if (empty($volunteerOptions)) $errors['volunteer-options'] = "Volunteer option is required.";
                if (empty($volunteerType)) $errors['volunteer'] = "Volunteer type is required.";
                if (empty($message)) $errors['message'] = "Reason to volunteer is required.";
                
                // Additional validation for phone number and postal code
                // pattern of phoneNumber - +601234567890
                if (!preg_match('/^\+[0-9]{12}$/', $phoneNumber)) $errors[] = "Invalid phone number. Please enter 10 digits.";
                // pattern of postalCode - 12345
                if (!preg_match('/^\d{5}$/', $postalCode)) $errors[] = "Postal code must be numbers only";

                // Display confirmation details if no errors // htmlsepcialchars() to prevent XSS attacks by converting special characters to HTML entities
                if (empty($errors)) {
                    echo "<h3>Please confirm your details:</h3>";
                    echo "<p>Name: " . htmlspecialchars($firstName) . " " . htmlspecialchars($lastName) . "</p>"; 
                    echo "<p>Email: " . htmlspecialchars($email) . "</p>";
                    echo "<p>Phone Number: " . htmlspecialchars($phoneNumber) . "</p>";
                    echo "<p>Address: " . htmlspecialchars($address) . ", " . htmlspecialchars($cityTown) . ", " . htmlspecialchars($state) . ", " . htmlspecialchars($postalCode) . "</p>";
                    echo "<p>Volunteer Option: " . htmlspecialchars($volunteerOptions) . "</p>";
                    echo "<p>Volunteer Type: " . htmlspecialchars($volunteerType) . "</p>";
                    // Display days and time only if volunteer type is Part-time
                    if($volunteerType == 'Part-time'){
                        echo "<p>Days: " . htmlspecialchars($days) . "</p>";
                        echo "<p>Time: " . htmlspecialchars($time) . "</p>";
                    }
                    echo "<p>Message: " . htmlspecialchars($message) . "</p>";

                    echo '<form action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '" method="post">';
                    foreach ($_POST as $key => $value) {
                        if (is_array($value)) {
                            foreach ($value as $item) {
                                echo '<input type="hidden" name="' . htmlspecialchars($key) . '[]" value="' . htmlspecialchars($item) . '">';
                            }
                        } else {
                            echo '<input type="hidden" name="' . htmlspecialchars($key) . '" value="' . htmlspecialchars($value) . '">';
                        }
                    }
                    echo '<input type="hidden" name="confirm" value="1">';
                    echo '<input class="volunteer-process-button" type="submit" value="CONFIRM"></input>';
                    echo '</form>';
                } else {
                    foreach ($errors as $key => $error) {
                        echo "<p>Error in $key: $error</p>";
                    }
                    echo '<a class="volunteer-process-button" href="join-volunteer.php">RETURN</a>';
                }
            }

            mysqli_close($conn);
            ?>
        </div>
    </section>

    <?php include 'footer.php'; ?>

</body>
</html>
