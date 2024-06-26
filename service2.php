<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Malaysian Sign Language</title>
    <meta charset="utf-8">
    <meta name="description" content="service2">
    <meta name="keywords" content="service2">
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
      <section> <!-- Section dedicated to displaying images in a slider -->
          <div id="slideshow-wrap">
            <input type="radio" id="button-1" name="controls" checked="checked">
            <label for="button-1"></label>
            <input type="radio" id="button-2" name="controls">
            <label for="button-2"></label>
            <input type="radio" id="button-3" name="controls">
            <label for="button-3"></label>

            <label for="button-1" class="arrows" id="arrow-1">></label>
            <label for="button-2" class="arrows" id="arrow-2">></label>
            <label for="button-3" class="arrows" id="arrow-3">></label>
            <div id="slideshow-inner">
                <ul>
                    <li id="slide1">
                        <figure><img src="images/carwash4.jpg" width="650" alt="charity car wash 1" title="Charity Car Wash Session 1"><figcaption>Charity Car Wash Session 1</figcaption></figure>
                    </li>
                    <li id="slide2">
                        <figure><img src="images/carwash5.jpg" width="650" alt="charity car wash 2" title="Charity Car Wash Session 2"><figcaption>Charity Car Wash Session 2</figcaption></figure>
                    </li>
                    <li id="slide3">
                        <figure><img src="images/carwash3.jpg" width="650" alt="charity car wash 3" title="Charity Car Wash Session 3"><figcaption>Charity Car Wash Session 3</figcaption></figure>
                    </li>
                </ul>
            </div>
          </div>
      </section>

      <section class="services_section"> <!-- Content Section -->
        <div class="services">
          <h2 class="servicesh2"> Charity Car Wash </h2>
            <dl>
              <dt><strong> -- Charity Car Wash -- </strong></dt>
              <dd>The charity car wash service does not only mean you can have your car cleaned, it also involves you giving back a small portion to the society in the form of honourable charity.</dd>
            </dl>
        </div>
          <hr class="serviceshr">
        <div class="service_content_1">    
            <aside class="servicesaside">
              Established around the year 2003, Sarawak Society for the Deaf (SSD)'s car wash services has been serving the community for more than two decades! Not only is it offering services at a low cost, it is also contributing and supporting a noble cause.  
            </aside>

            <h3 class="servicesh3">About the Car Wash</h3>
            <p>
              The car wash sessions are led by the deaf, who are also professional and experienced in the sector of handling your precious cars! They are also dedicated workers who can guarantee customers high quality service that will not disappoint. A noteworthy mention is that the public has said the workers are hardworking and friendly towards everyone. By supporting the car wash, you are also helping the deaf community and they are no doubt grateful for your contribution. 
            </p>

            <h3 class="servicesh3">Car Wash Listing and Prices</h3>
            <p>
              &nbsp; Ever since SSD launched a charity car wash service, it has gathered positive feedback from the community and there are lots who recommend the service and gave good reviews on social media. Sometimes, there are long queues during the weekends which proves the people's unconditional support! 
            </p>
            <p>
              <br> &nbsp; Below are the 5 types of services that SSD offers which inciudes wash and vacuum, vehicle body wash, vehicle interior vacuum, under carriage wash as well as wash, vacuum, and under carriage wash all together. The offer also extends to motorcycles however it is limited to only the body wash for a low price of RM3.00. Do take note that prices tend to increase (by RM 5.00) around Chinese New Year periods.
              <table class="servicestable">
                <caption class="servicestc">Charity Car Wash Prices</caption>
                  <tr>
                    <td colspan="2">Types of Services / Vehicle</td>
                    <th>Small Car</th>
                    <th>Sedan</th>
                    <th>Bigger Sedan</th>
                    <th>4WD</th>
                    <th>Van</th>
                    <th>Big Lorry</th>
                  </tr>

                  <tr>
                    <td>i)</td>
                    <th>Wash &amp; Vacuum</th>
                    <td>RM 8.00</td>
                    <td>RM 10.00</td>
                    <td>RM 12.00</td>
                    <td>RM 15.00</td>
                    <td>RM 18.00</td>
                    <td>RM 25.00</td>
                  </tr>
                  
                  <tr>
                    <td>ii)</td>
                    <th>Body Wash</th>
                    <td>RM 5.00</td>
                    <td>RM 6.00</td>
                    <td>RM 8.00</td>
                    <td>RM 11.00</td>
                    <td>RM 13.00</td>
                    <td>-</td>
                  </tr>

                  <tr>
                    <td>iii)</td>
                    <th>Interior Vacuum</th>
                    <td>RM 4.00</td>
                    <td>RM 5.00</td>
                    <td>RM 6.00</td>
                    <td>RM 7.00</td>
                    <td>RM 8.00</td>
                    <td>-</td>
                  </tr>

                  <tr>
                    <td>iv)</td>
                    <th>Under Carriage Wash</th>
                    <td>RM 4.00</td>
                    <td>RM 5.00</td>
                    <td>RM 6.00</td>
                    <td>RM 8.00</td>
                    <td>RM 9.00</td>
                    <td>-</td>
                  </tr>

                  <tr>
                    <td>v)</td>
                    <th>Wash, Vacuum &amp; Under Carriage Wash</th>
                    <td>RM 12.00</td>
                    <td>RM 15.00</td>
                    <td>RM 18.00</td>
                    <td>RM 23.00</td>
                    <td>RM 27.00</td>
                    <td>RM 35.00</td>
                  </tr>
              </table>
            </p>
            <p>
              &nbsp; <br> According to Sarawak Society for the Deaf (SSD)'s Facebook, the car wash operating hours are every Monday to Saturday from from 8 a.m. until 5 p.m. in the evening, however they are closed on Sunday(s) and public holidays. So if you are ever in need of a car wash, stop by <a href="https://www.google.com/maps/place/Sarawak+Society+for+the+Deaf+(Whatsapp+only)/@1.524002,110.3436355,717m/data=!3m2!1e3!4b1!4m6!3m5!1s0x31fba76f975981d9:0x134cacac64b7cb53!8m2!3d1.524002!4d110.3436355!16s%2Fg%2F1pzs3yccm?entry=ttu" class="serviceslink">SSD Headquarters</a> to get your car sparkling clean!
            </p>
        </div>
      </section>
    </div>
    <?php include 'back-to-top.php'?>
    <?php include 'footer.php'?>  
  </body>
</html>
