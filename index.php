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
    
    <header role="banner">
     
      <nav class="navbar navbar-expand-md navbar-dark bg-light">
        <div class="container">
          <a class="navbar-brand absolute" href="index.php">Online Java Courseware</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse navbar-light" id="navbarsExample05">
            <ul class="navbar-nav mx-auto">
              <li class="nav-item">
                <a class="nav-link active" href="index.php">Home</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="about.php">About</a>
              </li>

            </ul>
            <!--Show logout button if the user is logged in-->
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

    <section class="site-hero overlay" data-stellar-background-ratio="0.5" style="background-image: url(images/big_image_1.jpg);">
      <div class="container">
        <div class="row align-items-center site-hero-inner justify-content-center">
          <div class="col-md-8 text-center">
            
            <div class="mb-5 element-animate">
              <h1>Learn From Doing</h1>
              <p class="lead">Learn something new every day with our website.</p>
              <p>
                <?php 
                  if(isset($_SESSION['u_id'])){
                    echo '<a href="course.php" class="btn btn-primary">View Course</a>';
                  } else {
                    echo '<a href="login.php" class="btn btn-primary">Login</a>
                    <a href="register.php" class="btn btn-primary">Register</a>';
                  }
                ?>
              </p>
            </div>
          
            
          </div>
        </div>
      </div>
      
    </section>
    <!-- END section -->

    <section class="school-features d-flex" style="background-color: rgba(0, 0, 0, 0.808)">

      <div class="inner">
        <div class="media d-block feature">
          <div class="icon"><span class="flaticon-video-call"></span></div>
          <div class="media-body">
            <h3 class="mt-0">Online training</h3>
            <p>Enhance you skill in programming using Java today!</p>
          </div>
        </div>

        <div class="media d-block feature">
          <div class="icon"><span class="flaticon-student"></span></div>
          <div class="media-body">
            <h3 class="mt-0">Learn anywhere in the world</h3>
            <p>No matter on what your geographical location is, the website is accessable worldwide.</p>
          </div>
        </div>

        <div class="media d-block feature">
          <div class="icon"><span class="flaticon-learning"></span></div>
          <div class="media-body">
            <h3 class="mt-0">Creative learning through lectures</h3>
            <p>The course content is rich with learning resources that will provide you satisfaction.</p>
          </div>
        </div>


        <div class="media d-block feature">
          <div class="icon"><span class="flaticon-test"></span></div>
          <div class="media-body">
            <h3 class="mt-0">Answer Quizzes</h3>
            <p>This courseware provide you quizzes to enhance further your learning pace.</p>
          </div>
        </div>
      </div>
    </section>
    <!-- END section -->

    <?php include 'includes/footer.php'; ?>
    <!-- END footer -->
    
    <!-- loader -->

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