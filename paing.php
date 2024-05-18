<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Malaysian Sign Language</title>
    <meta charset="utf-8">
    <meta name="description" content="paing">
    <meta name="keywords" content="paing">
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
                Hi! I'm William and currently a first-year Computer Science
                Degree student in Swinburne, Sarawak.
              </p></span
            >
          </span>
          <img src="images/paing.jpg" alt="Picture of Paing" id="pfp" />
        </div>

        <div id="credentials">
          <p id="name">Paing Chan</p>
          <p id="student_id">102783895</p>
          <p id="course">Bachelor of Computer Science</p>
        </div>
      </section>

      <br />

      <!--Information section-->
      <section>
        <div id="table">
          <table id="info_t">
            <tr class="odd paing">
              <th>Age</th>
              <td>23</td>
            </tr>

            <tr class="even">
              <th>Gender</th>
              <td>Male</td>
            </tr>

            <tr class="odd paing">
              <th>Nationality</th>
              <td>Myanmar</td>
            </tr>

            <tr class="even">
              <th>Description of Hometown</th>
              <td>
                I am from Mandalay, which is a former royal capital in Northern
                Myanmar on the Irrawaddy River.
              </td>
            </tr>

            <tr class="odd paing">
              <th>A Great Achievement</th>
              <td>
                I'm proud of my dedication to continual growth and improvement
                when faced with challenges and difficulties
              </td>
            </tr>

            <tr class="even">
              <th>Some things I enjoy!</th>
              <td>
                I enjoy watching English movies and series especially sci-fi and
                mystery genres
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
            <a href="mailto:102783895@students.swinburne.edu.my">
              Contact Me
            </a>
          </button>
        </div>
      </section>
    </article>
    
    <?php include 'footer.php'?>
  </body>
</html>
