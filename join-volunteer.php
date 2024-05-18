<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Malaysian Sign Language</title>
    <meta charset="utf-8">
    <meta name="description" content="volunteer">
    <meta name="keywords" content="volunteer">
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

    <section class="volunteer-body">
      <div class="volunteer-container">
        <h1>Registration for Volunteering</h1>
        <form
          class="volunteer-form"
          action="joinvolunteer_process.php"
          method="POST"
        >
          <div class="user-details">
            <div class="input-box">
              <label for="first-name">First Name</label>
              <input
                id="first-name"
                name="first-name"
                type="text"
                placeholder="Enter your first name"
              />
            </div>
            <div class="input-box">
              <label for="last-name">Last Name</label>
              <input
                id="last-name"
                name="last-name"
                type="text"
                placeholder="Enter your last name"
              />
            </div>
            <div class="input-box">
              <label for="volunteer-email">Email</label>
              <input
                id="volunteer-email"
                name="email"
                type="email"
                placeholder="name@gmail.com"
              />
            </div>

            <fieldset class="address-field">
              <legend>Address Information</legend>
              <div class="input-box">
                <label for="address">Street Address</label>
                <input
                  id="address"
                  name="address"
                  type="text"
                  placeholder="Enter your street"
                />
              </div>
              <div class="input-box">
                <label for="city-town">City / Town</label>
                <input
                  id="city-town"
                  name="city-town"
                  type="text"
                  placeholder="Enter your city / town"
                />
              </div>
              <div class="input-box">
                <label for="state">State</label>
                <select id="state" name="state" >
                  <option value="" disabled selected>Select your state</option>
                  <option value="Johor">Johor</option>
                  <option value="Kedah">Kedah</option>
                  <option value="Kelantan">Kelantan</option>
                  <option value="Melaka">Melaka</option>
                  <option value="Negeri Sembilan">Negeri Sembilan</option>
                  <option value="Pahang">Pahang</option>
                  <option value="Perak">Perak</option>
                  <option value="Perlis">Perlis</option>
                  <option value="Pulau Pinang">Pulau Pinang</option>
                  <option value="Sabah">Sabah</option>
                  <option value="Sarawak">Sarawak</option>
                  <option value="Selangor">Selangor</option>
                  <option value="Terengganu">Terengganu</option>
                  <option value="Federal Territory of Kuala Lumpur">
                    Federal Territory of Kuala Lumpur
                  </option>
                  <option value="Federal Territory of Labuan">
                    Federal Territory of Labuan
                  </option>
                  <option value="Federal Territory of Putrajaya">
                    Federal Territory of Putrajaya
                  </option>
                </select>
              </div>
              <div class="input-box">
                <label for="postal-code">Postcode</label>
                <input
                  id="postal-code"
                  name="postal-code"
                  type="text"
                  placeholder="Enter your postal-code"
                />
              </div>
            </fieldset>

            <div class="input-box">
              <label for="phone-number">Phone Number</label>
              <input
                id="phone-number"
                name="phone-number"
                type="tel"
                placeholder="+## ##### #####"                
              />
            </div>
          </div>

          <div class="volunteer-details">
            <!--Default radio which will be later hidden by CSS-->
            <input type="radio" name="volunteer" id="dot-1" value="Full-time" />
            <input type="radio" name="volunteer" id="dot-2" value="Part-time" />
            <label for="volunteer-options" class="volunteer-title"
              >Which organization you wish to join as a Volunteer ?</label
            >
            <select id="volunteer-options" name="volunteer-options" >
              <option value="" selected disabled>Select an Organization</option>
              <option value="MSL">Malaysian Sign Language (MSL)</option>
              <option value="Sarawak Society for the Deaf">
                Sarawak Society for the Deaf
              </option>
            </select>
            <div class="category">
              <label for="dot-1">
                <!--Custom Radio Buttons-->
                <span class="dot one"></span>
                <span class="volunteer">Full-time</span>
              </label>
              <label for="dot-2">
                <span class="dot two"></span>
                <span class="volunteer">Part-time</span>
              </label>
            </div>
            <div class="full-time-details">
              <p>Working Hours:</p>
              <p>Monday To Friday => 8am - 5pm</p>
              <p>Saturday => 9am - 5pm</p>
            </div>
            <div class="part-time-details">
              <p>Working Days</p>
              <label for="monday">
                  <input type="checkbox" name="day[]" id="monday" value="Monday" />Monday
              </label>
              <label for="tuesday">
                  <input type="checkbox" name="day[]" id="tuesday" value="Tuesday" />Tuesday
              </label>
              <label for="wednesday">
                  <input type="checkbox" name="day[]" id="wednesday" value="Wednesday" />Wednesday
              </label>
              <label for="thursday">
                  <input type="checkbox" name="day[]" id="thursday" value="Thursday" />Thursday
              </label>
              <label for="friday">
                  <input type="checkbox" name="day[]" id="friday" value="Friday" />Friday
              </label>
              <label for="saturday">
                  <input type="checkbox" name="day[]" id="saturday" value="Saturday" />Saturday
              </label>

              <br />
              <p>Working Time</p>
              <label
                ><input type="radio" name="time" value="9am-11am" />9am -
                11am</label
              >
              <label
                ><input type="radio" name="time" value="11am-1pm" />11am -
                1pm</label
              >
              <label
                ><input type="radio" name="time" value="1pm-3pm" />1pm -
                3pm</label
              >
              <label
                ><input type="radio" name="time" value="3pm-5pm" />3pm -
                5pm</label
              >
            </div>
            <div class="reason-to-volunteer">
              <textarea
                id="message"
                name="message"
                rows="4"
                placeholder="Why you would like to volutnteer? "
                
              ></textarea>
            </div>
          </div>

          <div class="buttons">
            <div class="button">
              <input type="reset" value="Reset" />
            </div>
            <div class="button">
              <input type="submit" value="Register" />
            </div>
          </div>

          <p id="required_warning">
            *All the fields are required to be filled.
          </p>
        </form>
      </div>
    </section>

    <a href="#" class="top">Back To Top</a>

    <?php include 'footer.php'?>
  </body>
</html>
