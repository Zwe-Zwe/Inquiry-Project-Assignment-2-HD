<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Malaysian Sign Language</title>
    <meta charset="utf-8">
    <meta name="description" content="service4">
    <meta name="keywords" content="service4">
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

    <div class="space">
      <section>
        <!-- Section dedicated to displaying images in a slider -->
        <div id="slideshow-wrap">
          <input type="radio" id="button-1" name="controls" checked="checked" />
          <label for="button-1"></label>
          <input type="radio" id="button-2" name="controls" />
          <label for="button-2"></label>
          <input type="radio" id="button-3" name="controls" />
          <label for="button-3"></label>

          <label for="button-1" class="arrows" id="arrow-1">></label>
          <label for="button-2" class="arrows" id="arrow-2">></label>
          <label for="button-3" class="arrows" id="arrow-3">></label>
          <div id="slideshow-inner">
            <ul>
              <li id="slide1">
                <figure>
                  <img
                    src="images/st1.jpg"
                    width="650"
                    alt="sewing and alteration 1"
                    title="Alteration Services at SSD"
                  />
                  <figcaption>Sewing and Alteration 1</figcaption>
                </figure>
              </li>
              <li id="slide2">
                <figure>
                  <img
                    src="images/st2.jpg"
                    width="650"
                    alt="sewing and alteration 2"
                    title="Tailoring Services at SSD"
                  />
                  <figcaption>Sewing and Alteration 2</figcaption>
                </figure>
              </li>
              <li id="slide3">
                <figure>
                  <img
                    src="images/st3.jpg"
                    width="650"
                    alt="sewing and alteration 3"
                    title="Sewing Services at SSD"
                  />
                  <figcaption>Sewing and Alteration 3</figcaption>
                </figure>
              </li>
            </ul>
          </div>
        </div>
      </section>

      <section class="services_section">
        <!-- Content Section -->
        <div class="services">
          <h2 class="servicesh2">Sewing and Alteration</h2>
          <dl>
            <dt><strong> -- Sewing &amp; Alteration -- </strong></dt>
            <dd>
              As the name suggests, Sarawak Society for the Deaf provides the
              public with sewing and alteration for any fabric or garments.
            </dd>
          </dl>
        </div>
        <hr class="serviceshr" />
        <div class="service_content_1">
          <aside class="servicesaside">
            Besides the alteration services, members of SSD also handcraft
            various items such as baskets made out of <em>rattan</em>, drawings,
            postcards, keychains, cakes, cookies etc.
          </aside>

          <h3 class="servicesh3">About the Service</h3>
          <p>
            This particular service offered by SSD is also one of the favourites
            besides the BIM classes and Charity Car Wash. Most revies online
            have recommend this service to others as they mentioned that people
            can take their clothes here to be altered while waiting for their
            car to be cleaned.
          </p>

          <h3 class="servicesh3">Sewing, Alteration and Tailoring</h3>
          <p>
            &nbsp; Alteration and tailoring services here are provided by the
            experienced deaf tailors at low charges. They have been practicing
            and honing their skills for years and becoming experts in their
            field, thus meeting the different needs of society. Do drop by if
            you have any torn, undersized or oversized garments and let the
            experts do their magic!
          </p>
        </div>
      </section>
    </div>
    <?php include 'back-to-top.php'; ?>
    <?php include 'footer.php'; ?>
  </body>
</html>
