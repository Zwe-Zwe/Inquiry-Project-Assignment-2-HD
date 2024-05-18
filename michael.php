<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Malaysian Sign Language</title>
    <meta charset="utf-8">
    <meta name="description" content="michael">
    <meta name="keywords" content="michael">
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

    <article id="profile-page">
      <!--Picture and credentials section-->
      <section>
        <div id="title">Student Profile Page</div>

        <br />

        <!--padding in between sections-->
        <div id="pic">
          <span id="cpt">
            <span
              ><p>
                Hi! I'm Michael and currently a first-year CompSci degree student in Swinburne.
              </p></span
            >
          </span>
          <img src="images/michael.png" alt="Picture of Michael" id="pfp" />
        </div>

        <div id="credentials">
          <p id="name">Michael Wong Joo Jia</p>
          <p id="student_id">104381424</p>
          <p id="course">Bachelor of Computer Science</p>
        </div>
      </section>

      <br />

      <!--Information section-->
      <section>
        <div id="table">
          <table id="info_t">
            <tr class="odd michael">
              <th>Age</th>
              <td>19</td>
            </tr>

            <tr class="even">
              <th>Gender</th>
              <td>Male</td>
            </tr>

            <tr class="odd michael">
              <th>Nationality</th>
              <td>Malaysian</td>
            </tr>

            <tr class="even">
              <th>Description of Hometown</th>
              <td>
                Originally from Sarikei, a small town in Sarawak, I moved to Kuching early on in my life.
              </td>
            </tr>

            <tr class="odd michael">
              <th>A Great Achievement</th>
              <td>
                I'm proud of my tenure as the Leo Club president at my school from 2021 to 2022. I'm happy to have had the chance to help so many others out as well as changing myself and my life for the better.
              </td>
            </tr>

            <tr class="even">
              <th>Some things I enjoy!</th>
              <td>
                I enjoy reading, looking for tunes and video games in my spare time!
              </td>
            </tr>
          </table>
        </div>
      </section>

      <br /><br />

      <!--Email section-->
      <section>
        <div id="email">
          <button>
            <a href="mailto:104381424@students.swinburne.edu.my">
              Contact Me
            </a>
          </button>
        </div>
      </section>
    </article>

    <?php include 'footer.php'?>
  </body>
</html>
