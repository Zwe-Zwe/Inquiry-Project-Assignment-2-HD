<a href="index.php"><img src="images/logo.jpg" id="logo"></a>
    <input class="side-menu" type="checkbox" id="side-menu">
    <label class="hamb" for="side-menu"><span class="hamb-line"></span></label>
    <nav>
        <a href="index.php"><img src="images/logo.jpg" alt="logo" id="navbar_logo"></a>
        <ul class="navbar">
            <li><a href="index.php">Home</a></li>
            <li class="subnav">
                <a href="#">Services <i class="fa fa-caret-down"></i></a>
                <ul class="submenu">
                    <li><a href="service1.php">BIM Class</a></li>
                    <li><a href="service2.php">Car Wash</a></li>
                    <li><a href="service3.php">Haircut & Trimming</a></li>
                    <li><a href="service4.php">Sewing & Alteration</a></li>
                </ul>
            </li>
            <li><a href="activities.php">Activities</a></li>
            <li class="subnav">
                <a href="#">Forms <i class="fa fa-caret-down"></i></a>
                <ul class="submenu">
                    <li><a href="enquiry-service.php">Enquiry</a></li>
                    <li><a href="join-volunteer.php">Volunteer</a></li>
                </ul>
            </li>
            <li class="subnav">
                <a href="#">About Us <i class="fa fa-caret-down"></i></a>
                <ul class="submenu">
                    <li><a href="daniel.php">&#128100; Daniel Sie</a></li>
                    <li><a href="michael.php">&#128100; Michael Wong</a></li>
                    <li><a href="paing.php">&#128100; Paing Chan</a></li>
                    <li><a href="sherlyn.php">&#128100; Sherlyn Kok</a></li>
                    <li><a href="zwe.php">&#128100; Zwe Htet Zaw</a></li>
                </ul>
            </li>
        </ul>
        <?php
        session_start();
        if (isset($_SESSION['login_user'])) {
            // If logged in, display the user's ID
            echo '<div class="dropdown_login">';
            echo '<input type="checkbox" id="login_toggle" class="login_toggle">';
            echo '<label for="login_toggle" id="userid_button"><i class="fas fa-user-circle"></i> ' . $_SESSION['login_user'] . '</label>';
            echo '<div class="login_content">';
            echo '<a href="logout.php">Logout</a>';
            echo '</div>';
            echo '</div>';
        } else {
            // If not logged in, display the "Login" link
            echo '<p id="login_button"><a href="login.php">Login</a></p>';
        }
        ?>
    </nav>