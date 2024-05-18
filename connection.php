<?php
// --------- ESTABLISH CONNECTION FIRST WITHOUT DATABASE NAME ---------
// set the servername,username and password
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = mysqli_connect($servername, $username, $password,""); 

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// --------------------------- CREATE DATABASE ---------------------------
$sql = "CREATE DATABASE IF NOT EXISTS MSL";
if (!mysqli_query($conn, $sql)) {
    echo "Error creating database: " . mysqli_error($conn);
}
mysqli_close($conn);

// ------ ESTABLISH CONNECTION AGAIN NOW WITH DATABASE NAME INCLUDED ------
// set the servername,username and password
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "MSL"; // database name included this time

// Create connection
$conn = mysqli_connect($servername, $username, $password,$dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// ----------------------------- CREATE TABLES -----------------------------

// ACTIVITIES TABLE
$sql = "CREATE TABLE IF NOT EXISTS activities (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL UNIQUE,
    date VARCHAR(255) NOT NULL,
    description TEXT NOT NULL UNIQUE,
    photo TEXT NOT NULL UNIQUE
)";
if (!mysqli_query($conn, $sql)) {
    echo "Error creating table: " . mysqli_error($conn);
} 

// VOLUNTEER INFORMATION TABLE
$sql_volunteer = "CREATE TABLE IF NOT EXISTS volunteer_information (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    phone_num VARCHAR(255) NOT NULL UNIQUE,
    street_address VARCHAR(255) NOT NULL,
    city_or_town VARCHAR(255) NOT NULL,
    state VARCHAR(255) NOT NULL,
    postcode VARCHAR(255) NOT NULL,
    organization VARCHAR(255) NOT NULL,
    organization_type VARCHAR(255) NOT NULL,
    days VARCHAR(255),
    time VARCHAR(255),
    message VARCHAR(255)
)";
if (!mysqli_query($conn, $sql_volunteer)) {
    echo "Error creating table: " . mysqli_error($conn);
}

// USERS TABLE
$sql_user = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    userid VARCHAR(255) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
)";
if (!mysqli_query($conn, $sql_user)) {
    echo "Error creating table: " . mysqli_error($conn);
}

// ENQUIRY INFORMATION TABLE
$sql_enquiry = "CREATE TABLE IF NOT EXISTS enquiry_information(
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    countryCode VARCHAR(255) NOT NULL,
    phoneNumber VARCHAR(255) NOT NULL UNIQUE,
    service_type VARCHAR(255) NOT NULL,
    contact_method VARCHAR(255) NOT NULL,
    appointment_option VARCHAR(255) NOT NULL,
    appointment_date VARCHAR(255) NOT NULL,
    appointment_type VARCHAR(255) NOT NULL
)";
if (!mysqli_query($conn, $sql_enquiry)) {
    echo "Error creating table: " . mysqli_error($conn);
}

// FEEDBACK TABLE
$sql_feedback = "CREATE TABLE IF NOT EXISTS activity_feedbacks (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    activity_id INT(6) UNSIGNED,
    feedback TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
if (!mysqli_query($conn, $sql_feedback)) {
    echo "Error creating table: " . mysqli_error($conn);
}


// ----------------------- INSERT DEFAULT DATA INTO TABLES -----------------------
// ACTIVITES TABLE
// Check if the data already exists
$sql_check = "SELECT COUNT(*) AS count FROM activities";
$result = mysqli_query($conn, $sql_check);
$row = mysqli_fetch_assoc($result);
$count = $row['count'];
// If count is 0 (meaning no data exists), then perform the INSERT IGNORE
if ($count == 0) {
    $sql = "INSERT IGNORE activities (title, date, description, photo) VALUES
    (
        'CHARITY FOOD FAIR 🍲',
        '07/04/2024',
        '<p>We welcome you to come and support on 07/04/2024!</p>
        <br />
        <p>Purchasing a book of coupon which is worth RM100, you can buy various items in the fair, while also supporting Sarawak Society of the Deaf(SSD) in gathering the goal of RM300,000. The money will be used for:-</p>
        <div class=\"unordered\">
            <ul>
                <li>BIM Classes</li>
                <li>Brews & Bites Café</li>
                <li>Early Intervention Community Programme</li>
                <li>Deaf Video Broadcasting Project</li>
                <li>Facility Upgrade</li>
            </ul>
        </div>
        <br />
        <hr class=\"activity_line\" />
        <p>In addition to purchasing coupons for the bazaar above, you can also:-</p>
        <div class=\"unordered\">
            <ol id=\"activity_addition\">
                <li>Set up a booth: Showcase your business or services at a bazaar.</li>
                <li>Donate items: Provide items for the deaf to sell at the bazaar.</li>
                <li>Cash Donation: Directly assist SSD&#39;s goals financially.</li>
            </ol>
        </div>
        <br />
        <hr class=\"activity_line\" />
        <p>If you are interested in supporting, please contact the person in charge:-</p>
        <div class=\"unordered\">
            <ul>
                <li>WhatsApp &#45; Mr. Ernest Ting (deaf) <a href=\"https://www.wasap.my/60168716216\">https://www.wasap.my/60168716216</a></li>
                <li>Phone/Text &#45; Mdm. Helena Lim 013-809 4599</li>
            </ul>
        </div>
        <br />
        <hr class=\"activity_line\" />
        <dl>
            <dt>&#91;SSD Charity Food Fair 2024&#93;</dt>
            <dd>
                <table id=\"activity_detail\">
                    <tr>
                        <th>Date:</th>
                        <td>07/04/2024</td>
                    </tr>
                    <tr>
                        <th>Time:</th>
                        <td>8:00a.m. to 12:00p.m.</td>
                    </tr>
                    <tr>
                        <th>Location:</th>
                        <td>Association of Churches, Jalan Stampin, Kuching, Sarawak</td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td>ssdkuching1982@gmail.com</td>
                    </tr>
                </table>
            </dd>
        </dl>
        <iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.411045755735!2d110.34421479999999!3d1.5218199!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31fba76940665d95%3A0xd41d7f8c99537582!2sAssociation%20of%20Churches%20in%20Sarawak!5e0!3m2!1sen!2smy!4v1710830899080!5m2!1sen!2smy\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>',
        'charity.jpg'
    ),
    (
        'PINES SQUARE FAIR',
        '26/01/2024',
        'Hi everyone! SSD is thrilled to be invited by MTPN to host our Deaf businesses at their Fair. Come check us out at Pines Square (opposite MJC Batu Kawa) - we are open from 7pm every night from 26 January until 7 February (15 days)!',
        'pines-square.webp'
    ),
    (
        'THANK YOU FOR THE DONATION',
        '15/01/2024', 
        'Representatives from Kuching Buddhist Meditation handed over 30 bags of rice and one big packet of Bee Hoon to Sarawak Society for the Deaf. SSD staff Amy Lau thanked and presented a token of appreciation to them.', 
        'rice.jpg'
    ),
    (
        'UNITY CHARITY AND CULTURE',
        '13/01/2024',
        'Sarawak Society for the Deaf (SSD) is happy and honoured to be invited by MTPN & YMLM Sarawak to attend their UNITY CHARITY AND CULTURE at the Riverine Ballroom by Lok Thian on 13 January 2024.',
        'eating.jpg'
    )";
    if (!mysqli_query($conn, $sql)) {
        echo "Error inserting data: " . mysqli_error($conn);
    }
}

// USERS TABLE
// Check if the data already exists
$sql_check = "SELECT COUNT(*) AS count FROM users";
$result = mysqli_query($conn, $sql_check);
$row = mysqli_fetch_assoc($result);
$count = $row['count'];
$password = password_hash('password', PASSWORD_BCRYPT);
if ($count == 0) {
    $sql = "INSERT IGNORE users (userid, email, password) VALUES
    ('admin', 'admin@gmail.com', '$password')";
    if (!mysqli_query($conn, $sql)) {
        echo "Error inserting data: " . mysqli_error($conn);
    }
}

?>