<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Malaysian Sign Language</title>
    <meta charset="utf-8">
    <meta name="description" content="signup">
    <meta name="keywords" content="signup">
    <meta name="author" content="Daniel Sie, Zwe Htet Zaw, Paing Chan, Sherlyn Kok, Michael Wong">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link
      rel="icon"
      href="images/love-you-gesture-svgrepo-com.svg"
      type="images/svg"
    >
    <link rel="stylesheet" href="styles/style.css" >
    <link
      rel="stylesheet"
      type="text/css"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    >
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>

  <body>
    <?php include "connection.php" ?>
    <header>
      <?php include "header.php" ?>
    </header>

    <?php if (!isset($_SESSION['login_user'])) { ?>
      <section class="user-body">
        <div class="user-container">
          <h1>REGISTER</h1>
          <?php
            if (isset($_GET['error']) && !empty($_GET['error'])) {
                echo "<p class='user_error'>".$_GET['error']."</p>";
            }
          ?>
          <form class="user-form" method="post" action="signup_process.php">
            <p><label for="userid">User ID</label></p>
            <p><input type="text" name="userID" maxlength="20" id="userid"></p>
            <p><label for="email_signup">Email</label></p>
            <p><input type="text" name="email" placeholder="abc@gmail.com"  id="email_signup"></p>
            <p><label for="password">Password</label></p>
            <p><input type="password" name="password"  id="password"></p>
            <p><label for="confirmpassword">Confirm Password</label></p>
            <p><input type="password" name="confirmpassword"  id="password_confirmation"></p>
            <p class="account">Already have an account? Click <a href="login.php">here</a> to login.</p>
            <div class="button">
              <input type="submit" value="Sign Up">
            </div>
          </form>
        </div>
      </section>
    <?php } else{ ?>
      <section class="user-body">
        <div class="user-container">
          <h1>You had already signed up</h1>
          <p>Press <a href="index.php">here</a> to go homepage.</p>
        </div>
      </section>
    <?php } ?>

    <footer>
      <?php include "footer.php"; ?>
    </footer>
  </body>
</html>
