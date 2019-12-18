<?php
session_start();
if(!isset($_SESSION['u_id'])){
  header("Location: ./index.php");
  exit();
}
include 'includes/dbh.inc.php';

$section_id = $_POST['section_id'];
if($section_id==''){
  header("Location: ./course.php");
  exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    
    <title>Online Java Courseware</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    
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
      /* Customize the label (the container) */
      .container_radio {
        display: block;
        position: relative;
        padding-left: 35px;
        margin-bottom: 12px;
        cursor: pointer;
        font-size: 16px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      /* Hide the browser's default radio button */
      .container_radio input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
      }

      /* Create a custom radio button */
      .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 25px;
        width: 25px;
        background-color: #eee;
        border-radius: 50%;
      }

      /* On mouse-over, add a grey background color */
      .container_radio:hover input ~ .checkmark {
        background-color: #ccc;
      }

      /* When the radio button is checked, add a blue background */
      .container_radio input:checked ~ .checkmark {
        background-color: #2196F3;
      }

      /* Create the indicator (the dot/circle - hidden when not checked) */
      .checkmark:after {
        content: "";
        position: absolute;
        display: none;
      }

      /* Show the indicator (dot/circle) when checked */
      .container_radio input:checked ~ .checkmark:after {
        display: block;
      }

      /* Style the indicator (dot/circle) */
      .container_radio .checkmark:after {
        top: 9px;
        left: 9px;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: white;
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
            <!-- Show logout if the user logged in -->
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
              <h1 class="mb-3">Quiz</h1>
              <p class="post-meta">Created by Khyn Harold Jay Antoque</p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- END section -->


    
      <div class="container">
          <div class="box box-body">
          <p align="right"><a href="course.php"><button type="button" class="btn btn-secondary">Go back to the course</button></a></p>
            <p class="h1">Quiz Assessment<br></p>
            <!-- Generate quiz content -->
              
            <form action="score.php" method="POST">

            <?php
              $question_num = 1;
              $sql = "SELECT quiz_id, quiz_question, quiz_answer FROM quizzes WHERE section_id = $section_id";
              
              foreach($conn->query($sql) as $quiz_row) {
                $quiz_id = $quiz_row['quiz_id'];
                
                //echo question title
                echo '<table class="table table-hover">
                        <input type="hidden" name="quiz-'.$question_num.'" value="'.$quiz_id.'">
                        <thead><b>'.$question_num.'.) '.$quiz_row['quiz_question'].'</b></thead>
                      <tbody>';

                //Query answers for the question's content
                $sql_answers = "SELECT * FROM answers WHERE quiz_id = $quiz_id";
                
                  foreach ($conn->query($sql_answers) as $ans_row) {
                    echo '<tbody>
                            <tr>
                              <td>
                              <label class="container_radio" >'.$ans_row['answer_content'].'
                                <input type="radio" name="choices-'.$question_num.'" value="'.$ans_row['answer_id'].'" required>
                                <span class="checkmark"></span>
                              </label>
                              </td>
                            <tr>
                          ';
                          
                  }
                  
                  echo '</tbody></table>';
                  $question_num++;
              }
            
            ?>
            <input type="hidden" name="question_num" value="<?php echo $question_num-1;?>">
            <input type="hidden" name="section_id" value="<?php echo $section_id;?>">
            <button type="submit" name="submit" class="btn btn-outline-success">Compile Answers</button>
            </form>
           </div>
      </div>
            
  <?php include 'includes/footer.php'; ?>


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