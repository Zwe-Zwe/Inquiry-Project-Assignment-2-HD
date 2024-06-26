<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Malaysian Sign Language</title>
    <meta charset="utf-8" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="Daniel Sie, Zwe Htet Zaw, Paing Chan" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link
      rel="icon"
      href="images/love-you-gesture-svgrepo-com.svg"
      type="images/svg"
    />
    <link rel="stylesheet" href="styles/style.css" />
    <link
      rel="stylesheet"
      type="text/css"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>

  <body>
    <header>
      <?php include "header.php" ?>
    </header>
    
    <article id="slide_article">
      <section class="slider_container">
        <section class="slider">
          <div class="slide one">
            <img src="images/signs.jpg" alt="Signs" />
            <span class="caption">Sign Language</span>
          </div>
          <div class="slide two">
            <img src="images/carwash3.jpg" alt="Car Wash" />
            <span class="caption"> Car Wash </span>
          </div>
          <div class="slide three">
            <img src="images/hc2.jpg" alt="Hair Cut" />
            <span class="caption"> Hair Cut </span>
          </div>
          <div class="slide four">
            <img src="images/bim3.jpg" alt="Sign Language Class" />
            <span class="caption"> Sign Language Class </span>
          </div>
          <div class="slide four">
            <img src="images/st3.jpg" alt="Sewing" />
            <span class="caption"> Sweing </span>
          </div>
        </section>
      </section>
    </article>

    <section class="about">
      <div class="photos">
        <a href="https://www.sarawaksocietyforthedeaf.org/"
          ><img src="images/ssftd.png" alt="SSD_logo"
        /></a>
      </div>
      <div class="text">
        <h2>About</h2>
        <p>
          A project collaboration by Swinburne University of Technology Sarawak
          and Sarawak Society for the Deaf to collect an open access dataset for
          Malaysian Sign Language (MSL) in Medical context. After researching
          into open access available datasets for Malaysian Sign Language for
          projects, we had found there were no video data or any media for MSL
          in medical context. Due to lack of data, many oppurtunities for
          research and development are halted which can help the local Deaf
          community. With this in mind, we would like to encourage more
          researchers and developers to look into this field by giving a dataset
          to work with.
        </p>
      </div>
      <div class="photos">
        <a href="https://www.swinburne.edu.my/"
          ><img src="images/swinburne.jpg" alt="Swinburne_logo"
        /></a>
      </div>
    </section>

    <hr />

    <h2 class="card-h2">Services</h2>
    <section class="card-section">
      <div class="card-container">
        <div class="card-row">
          <div class="card">
            <div class="card-inner">
              <div class="card-front front-1"></div>
              <div class="card-back">
                <h1>Charity Car Wash</h1>
                <p>
                  Come and get your car cleaned up by our group of professional
                  deaf members. Sit back, relax, and leave the dirt behind
                </p>
                <a class="card-read-more" href="service1.html">Read More</a>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-inner">
              <div class="card-front front-2"></div>
              <div class="card-back">
                <h1>Sewing & Alteration</h1>
                <p>
                  Our experienced deaf will be able to assist you with your
                  tailoring needs. Craft or repair? No problem!
                </p>
                <span
                  ><a class="card-read-more" href="service1.html"
                    >Read More</a
                  ></span
                >
              </div>
            </div>
          </div>
        </div>
        <div class="card-row">
          <div class="card">
            <div class="card-inner">
              <div class="card-front front-3"></div>
              <div class="card-back">
                <h1>Malaysian Sign Language Class</h1>
                <p>
                  Interested in learning basic Malaysian Sign Language? Come
                  join us and we will guide you step by step. Our classes are
                  conducted by the deaf and are done in small groups.
                </p>
                <span
                  ><a class="card-read-more" href="service1.html"
                    >Read More</a
                  ></span
                >
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-inner">
              <div class="card-front front-4"></div>
              <div class="card-back">
                <h1>Haircut & Trimming</h1>
                <p>
                  Come and experience haircut by the Deaf. They know which
                  hairstyle suits you the best!
                </p>
                <span
                  ><a class="card-read-more" href="service1.html"
                    >Read More</a
                  ></span
                >
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <hr />

    <section id="index_video">
      <h2>Malaysia Sign Language Introduction</h2>
      <br />
      <iframe

        src="https://www.youtube.com/embed/NAq9_FfZHag?si=YGSHXKAZ1xfXHIhS"
        title="YouTube video player"
        frameborder="0"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
        referrerpolicy="strict-origin-when-cross-origin"
        allowfullscreen
      ></iframe>
    </section>

    <a href="#" class="top">Back To Top</a>

    <footer>
      <div class="container">
        <div class="row">
          <div class="footer-col">
            <h4 class="foot-h4-oh">operating hours</h4>
            <ul>
              <li>Monday to Friday 8am- 5pm</li>
              <li>Saturday 9am- 5pm</li>
              <li>Sunday Closed</li>
            </ul>
          </div>
          <div class="footer-col">
            <h4>organization</h4>
            <ul>
              <li><a href="activities.html">activities</a></li>
              <li><a href="enquiry-service.html">enquiry</a></li>
              <li><a href="join-volunteer.html">join us</a></li>
            </ul>
          </div>
          <div class="footer-col">
            <h4>profile</h4>
            <ul>
              <li><a href="daniel.html">Daniel Sie</a></li>
              <li><a href="michael.html">Michael Wong</a></li>
              <li><a href="paing.html">Paing Chan</a></li>
              <li><a href="sherlyn.html">Sherlyn Kok</a></li>
              <li><a href="zwe.html">Zwe Htet Zaw</a></li>
            </ul>
          </div>
          <div class="footer-col">
            <h4>contact us</h4>
            <div class="social-links">
              <a href="https://www.facebook.com/sarawaksocietyforthedeaf"
                ><i class="fab fa-facebook-f"></i
              ></a>
              <a href="https://www.sarawaksocietyforthedeaf.org/"
                ><i class="fa-solid fa-globe"></i
              ></a>
              <a href="https://wa.me/+6012-8118260"
                ><i class="fa-brands fa-whatsapp"></i
              ></a>
              <a href="mailto:102783895@students.swinburne.edu.my"
                ><i class="fa-solid fa-envelope"></i
              ></a>
              <br />
              <a href="#"><i class="fa-brands fa-youtube"></i></a>
              <span id="youtube-link">Link to YouTube</span>
            </div>
            <a class="footer-essentials" href="acknowledgement.php"
              >Acknowledgements</a
            >
            <a class="footer-essentials" href="enhancement1.php"
              >Enhancements</a
            >
          </div>
        </div>
      </div>
    </footer>
  </body>
</html>
