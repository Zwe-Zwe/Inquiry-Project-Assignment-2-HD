<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Malaysian Sign Language</title>
    <meta charset="utf-8">
    <meta name="description" content="activities">
    <meta name="keywords" content="activities">
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
    <header>
      <?php include "header.php" ?>
    </header>    
    
    <article class="space activities_section">
        <section>
        <?php
        include 'connection.php';

        $sql = "SELECT * FROM activities WHERE id='1'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                ?>
                <section>
                    <div class="card1">
                    <input id="ch1" type="checkbox" />
                    <div class="text">
                        <h1><?php echo $row['title'] ?></h1>
                        <h2>"Taste the charity, it's delicious."</h2>
                    </div>
                    <div class="content1">
                        <div class="content_text">
                            <p>
                                <img
                                src="<?php echo $row['photo'] ?>"
                                alt="charity_event"
                                class="activity_img"
                                />
                            </p>
                            <?php echo $row['description'] ?>
                        </div>
                        <label class="extend" for="ch1">&#129033;</label>
                    </div>
                    <label class="extend" for="ch1">&#129035;</label>
                    </div>
                </section>
                <?php
            }
            // Free the result set after using it
            mysqli_free_result($result);
        } else {
            echo "0 results";
        }

        $sql = "SELECT * FROM activities WHERE id='2'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                ?>
                <section>
                    <div class="card2">
                    <input id="ch2" type="checkbox" />
                    <div class="text">
                        <h1 ><?php echo $row['title'] ?></h1>
                    </div>
                    <div class="content2">
                        <div class="content_text">
                        <aside id="activity_aside">
                            <iframe
                            src="<?php echo $row['photo'] ?>"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            ></iframe>
                        </aside>
                        <p>
                        <?php echo $row['description'] ?>
                        </p>
                        </div>
                        <label class="extend" for="ch2">&#129033;</label>
                    </div>
                    <label class="extend" for="ch2">&#129035;</label>
                    </div>
                </section>
                <?php
            }
            // Free the result set after using it
            mysqli_free_result($result);
        } else {
            echo "0 results";
        }

        $sql = "SELECT * FROM activities WHERE id='3'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                ?>
                <section>
                    <div class="card3">
                    <input id="ch3" type="checkbox" />
                    <div class="text">
                        <h1><?php echo $row["title"]?></h1>
                    </div>
                    <div class="content3">
                        <div class="content_text">
                        <p>
                            <img src="<?php echo $row["photo"]?>" alt="dinner" class="activity_img" />
                        </p>
                        <p>
                        <?php echo $row["description"]?>
                        </p>
                        <br />
                        <p>
                            In conjuction of this event The National Consumer Action Council -
                            Sarawak (MTPN) and the Malaysian Sustainable Society Foundation
                            (YMLM) generously donate RM3000 to Sarawak Society for Deaf (SSD).
                        </p>
                        <br />
                        <p>
                            Sir Wynson Ong Teck Ping, Chairman of the Sarawak National
                            Consumer Action Council in his speech mentioned that giving this
                            sincere donation is a sign that the MTPN takes seriously this
                            close relationship with the Deaf community in Sarawak.
                        </p>
                        <br />
                        <p>
                            SSD is looking forward to future collaboration with MTPN and
                            empower our Deaf Community to be better.
                        </p>
                        </div>
                        <label class="extend" for="ch3">&#129033;</label>
                    </div>
                    <label class="extend" for="ch3">&#129035;</label>
                    </div>
                </section>                     
                <?php
            }
            // Free the result set after using it
            mysqli_free_result($result);
        } else {
            echo "0 results";
        }

        $sql = "SELECT * FROM activities WHERE id='4'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                ?>
                <section>
                    <div class="card4">
                    <input id="ch4" type="checkbox" />
                    <div class="text">
                        <h1><?php echo $row["title"]?></h1>
                    </div>
                    <div class="content4">
                        <div class="content_text">
                        <figure>
                            <img src="<?php echo $row["photo"]?>" alt="rice" class="activity_img" />
                            <figcaption><?php echo $row["description"]?>
                            </figcaption>
                        </figure>
                        </div>
                        <label class="extend" for="ch4">&#129033;</label>
                    </div>
                    <label class="extend" for="ch4">&#129035;</label>
                    </div>
                </section>                
                <?php
            }
            // Free the result set after using it
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
