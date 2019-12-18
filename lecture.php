<?php
session_start();

//Checks if the user logged in
if(!isset($_SESSION['u_id'])){
  header("Location: ./index.php");
  exit();
}

include 'includes/dbh.inc.php';

//Establishing the lecture content
$lecture_id = $_GET['lecture_id'];
$sql = "SELECT * FROM lectures WHERE lecture_id=?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i",$lecture_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

//Fetch the data
$title = $row['lecture_title'];
$content = $row['lecture_content'];

?>

<!doctype html>
<html lang="en">
  <head>
    <title>Online Java Courseware</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="EnlighterJS" content="Advanced javascript based syntax highlighting" data-indent="4" data-selector-block="pre" data-selector-inline="code" data-language="java" />

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,900" rel="stylesheet">
    <link rel="icon" href="images/logo.png">

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">

    <link rel="stylesheet" href="fonts/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="fonts/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

    <!-- Enlighter Plugin -->
    <script type="text/javascript" src="js/MooTools-Core-1.6.0-compressed.js"></script>
    <!-- Include EnlighterJS Styles -->
    <link rel="stylesheet" type="text/css" href="css/EnlighterJS.min.css" />
    <!-- Include EnlighterJS -->
    <script type="text/javascript" src="js/EnlighterJS.min.js" ></script>

    <!-- Theme Style -->
    <link rel="stylesheet" href="css/style.css">
    <style>
    /* CSS for responsive iframe */
/* ========================= */

/* outer wrapper: set max-width & max-height; max-height greater than padding-bottom % will be ineffective and height will = padding-bottom % of max-width */
#Iframe-Liason-Sheet {
  max-width: 550px;
  max-height: 100%; 
  overflow: hidden;
}
/* inner wrapper: make responsive */
.responsive-wrapper {
  position: relative;
  height: 0;    /* gets height from padding-bottom */
  /* following necessary for proper mobile behavior */
  -webkit-overflow-scrolling: touch;
  overflow: auto
}
 .responsive-wrapper iframe {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  margin: 0;
  padding: 0;
  border: none;
}
/* padding-bottom = h/w as % -- sets aspect ratio */
/* YouTube video aspect ratio */
.responsive-wrapper-wxh-650x315 {
  padding-bottom: 200.25%;
}
.responsive-wrapper-wxh-550x2000 {
  padding-bottom: 100.6364%;
}

/* general styles */
/* ============== */

.set-box-shadow { 
  -webkit-box-shadow: 4px 4px 14px #4f4f4f;
  -moz-box-shadow: 4px 4px 14px #4f4f4f;
  box-shadow: 4px 4px 14px #4f4f4f;
}
.set-padding {
  padding: 5px;
}
.set-margin {
  margin: 5px;
}
.center-block-horiz {
  margin-left: auto;
  margin-right: auto;
}

    </style>
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
                <a class="nav-link" href="index.php">Home</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="about.php">About</a>
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

    <section class="site-hero site-hero-innerpage overlay" data-stellar-background-ratio="0.5" style="background-image: url(images/big_image_1.jpg);">
      <div class="container">
        <div class="row align-items-center site-hero-inner justify-content-center">
          <div class="col-md-8 text-center">

            <div class="mb-5 element-animate">
            <?php echo '<p class="mb-3 h1">'.$title.'</p>'?>
              <p class="post-meta">Created by Khyn Harold Jay Antoque</p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- END section -->


    <section class="site-section">
      <?php
      //Lecture Content
        echo '<div class="container">
              <p align="right"><a href="course.php"><button type="button" class="btn btn-secondary">Go back</button></a></p>
          <div class="container">
            <p>'.$content.'</p>
            ';
        echo '<form action="course.php" method="POST"> 
              <input type="hidden" name="lecture_id" value="'.$lecture_id.'">';
              //Lecture Button
              $isLectureChecked = $_GET['checked'];
              if($isLectureChecked=='checked'){  
                echo '<input type="hidden" name="status" value="">';
                echo '<p align="center"><a href="course.php"><button class="btn btn-outline-success" disabled>Completed ✔</button></a></p>';
              }else{
                echo '<input type="hidden" name="status" value="checked">';
                echo '<p align="center"><button type="submit" name="lec_submit" class="btn btn-outline-success">Complete Lecture</button></p>';
              }

        echo '</form>
            </div>
          </div>';
      ?>
      
      
          
    </section>

  <?php include 'includes/footer.php'; ?>
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