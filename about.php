<?php
  session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <title>Online Java Courseware</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,900" rel="stylesheet">
    <link rel="icon" href="images/logo.png">

    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">

    <link rel="stylesheet" href="fonts/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="fonts/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

    <!-- Theme Style -->
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    
    <header role="banner" style="background-color: black; -webkit-box-shadow: 0 3px 10px -2px rgba(0, 0, 0, 0.2) !important; box-shadow: 0 3px 10px -2px rgba(0, 0, 0, 0.2) !important;">
     
      <nav class="navbar navbar-expand-md navbar-dark">
        <div class="container">
          <a class="navbar-brand absolute" href="index.php">Online Java Courseware</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse navbar-dark" id="navbarsExample05">
            <ul class="navbar-nav mx-auto">
              <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="about.php">About</a>
              </li>
            </ul>

            <?php
              if(isset($_SESSION['u_id'])) {
                echo '<ul class="navbar-nav absolute-right">
                        <li class="nav-item">
                        <form action="includes/logout.inc.php" method="POST">
                        <button type="submit" name="submit" class="btn btn-primary">Logout</button>
                        </form>
                        </li>
                      </ul>';
              } else {
                echo '<ul class="navbar-nav absolute-right">
                        <li class="nav-item">
                          <a href="login.php" class="nav-link">Login</a>
                        </li>
                        <li class="nav-item">
                          <a href="register.php" class="nav-link">Register</a>
                        </li>
                      </ul>';
              }
            ?>

          </div>
        </div>
      </nav>
    </header>
    <!-- END header -->

    <!-- END section -->
    <section class="site-section">
      <div class="container">
        <div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center">
            <p align="center"><img src="images/logo.png" alt="Image placeholder" class="img-fluid"></p>
            <h2>Meet The Researchers</h2>
            <p class="lead">The people who developed this system and push their efforts to meet the required output.</p>
          </div>
        </div>
        <section class="school-features text-dark d-flex">

          <div class="inner">
                <div class="media d-block feature text-center">
                  <img src="images/person_1.jpg" alt="Image placeholder" class="mb-3">
                  <div class="media-body">
                    <h3 class="mt-0">Khyn Harold Jay H. Antoque</h3>
                    <p class="instructor-meta">Senior Highschool Student, Project Developer, Researcher</p>
                    <p>A knowledgeable person in Java, he made all of this by the help of his team. The one who want to expand his limits further beyond.</p>
                  </div>
                </div>

            <div class="media d-block feature text-center">
              <img src="images/person_2.jpg" alt="Image placeholder" class="mb-3">
              <div class="media-body">
                <h3 class="mt-0">Thomas Laro</h3>
                <p class="instructor-meta">Senior Highschool Student, Project Contributor, Moral Support, Researcher</p>
                <p>Researcher with a heart, a person who's eager to help his team to meet the requirements.</p>
              </div>
            </div>

            <div class="media d-block feature text-center">
              <img src="images/person_3.jpg" alt="Image placeholder" class="mb-3">
              <div class="media-body">
                <h3 class="mt-0">Jeff Ray Bioco</h3>
                <p class="instructor-meta">Senior Highschool Student, Web Enthusiast, Project Contributor, Reseacher</p>
                <p>A person who are knowledgable in front-end web development and a little bit of back-end development.</p>
              </div>
            </div>

            </div>
          </div>
        </section>


      </div>
    </section>
    <!-- END section -->

    


    
  
    <?php include 'includes/footer.php'; ?>
    <!-- END footer -->
    
    

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/jquery-migrate-3.0.0.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>

    
    <script src="js/main.js"></script>
  </body>
</html>