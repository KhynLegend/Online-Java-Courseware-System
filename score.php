<?php
session_start();
if(!isset($_SESSION['u_id'])){
  header("Location: ./index.php");
  exit();
}
include 'includes/dbh.inc.php';

if(!isset($_POST['section_id']) || !isset($_POST['question_num'])){
  header("Location: ./course.php?error=true");
  exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    
    <title>Online Java Courseware</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,300,600,800,900" rel="stylesheet" type="text/css">
    <link rel="icon" href="images/logo.png">

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">

    <link rel="stylesheet" href="fonts/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="fonts/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

    <!-- Theme Style -->
    <link rel="stylesheet" href="css/style.css">

    <style>
    .progress{
    width: 150px;
    height: 150px;
    line-height: 150px;
    background: none;
    margin: 0 auto;
    box-shadow: none;
    position: relative;
}
.progress:after{
    content: "";
    width: 100%;
    height: 100%;
    border-radius: 50%;
    border: 2px solid #fff;
    position: absolute;
    top: 0;
    left: 0;
}
.progress > span{
    width: 50%;
    height: 100%;
    overflow: hidden;
    position: absolute;
    top: 0;
    z-index: 1;
}
.progress .progress-left{
    left: 0;
}
.progress .progress-bar{
    width: 100%;
    height: 100%;
    background: none;
    border-width: 2px;
    border-style: solid;
    position: absolute;
    top: 0;
}
.progress .progress-left .progress-bar{
    left: 100%;
    border-top-right-radius: 80px;
    border-bottom-right-radius: 80px;
    border-left: 0;
    -webkit-transform-origin: center left;
    transform-origin: center left;
}
.progress .progress-right{
    right: 0;
}
.progress .progress-center{
  margin: auto;
}
.progress .progress-right .progress-bar{
    left: -100%;
    border-top-left-radius: 80px;
    border-bottom-left-radius: 80px;
    border-right: 0;
    -webkit-transform-origin: center right;
    transform-origin: center right;
    animation: loading-1 1.8s linear forwards;
}
.progress .progress-value{
    width: 85%;
    height: 85%;
    border-radius: 50%;
    border: 2px solid #ebebeb;
    font-size: 32px;
    line-height: 125px;
    text-align: center;
    position: absolute;
    top: 7.5%;
    left: 7.5%;
}
.progress.blue .progress-bar{
    border-color: #049dff;
}
.progress.blue .progress-value{
    color: #049dff;
}
.progress.blue .progress-left .progress-bar{
    animation: loading-2 1.5s linear forwards 1.8s;
}
.progress.yellow .progress-bar{
    border-color: #fdba04;
}
.progress.yellow .progress-value{
    color: #fdba04;
}
.progress.yellow .progress-left .progress-bar{
    animation: loading-3 1s linear forwards 1.8s;
}
.progress.pink .progress-bar{
    border-color: #ed687c;
}
.progress.pink .progress-value{
    color: #ed687c;
}
.progress.pink .progress-left .progress-bar{
    animation: loading-4 0.4s linear forwards 1.8s;
}
.progress.green .progress-bar{
    border-color: #1abc9c;
}
.progress.green .progress-value{
    color: #1abc9c;
}
.progress.green .progress-left .progress-bar{
    animation: loading-5 1.2s linear forwards 1.8s;
}
@keyframes loading-1{
    0%{
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    100%{
        -webkit-transform: rotate(180deg);
        transform: rotate(180deg);
    }
}
@keyframes loading-2{
    0%{
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    100%{
        -webkit-transform: rotate(144deg);
        transform: rotate(144deg);
    }
}
@keyframes loading-3{
    0%{
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    100%{
        -webkit-transform: rotate(90deg);
        transform: rotate(90deg);
    }
}
@keyframes loading-4{
    0%{
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    100%{
        -webkit-transform: rotate(36deg);
        transform: rotate(36deg);
    }
}
@keyframes loading-5{
    0%{
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    100%{
        -webkit-transform: rotate(126deg);
        transform: rotate(126deg);
    }
}
@media only screen and (max-width: 990px){
    .progress{ margin-bottom: 20px; }
}
#container {
  margin-left: auto;
  margin-right: auto;
  width: 200px;
  height: 100px;

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
              <h1 class="mb-3">Score</h1>
              <p class="post-meta">Created by Khyn Harold Jay Antoque</p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- END section -->

<script>
var ProgressBar = require('js/progressbar.js')
var line = new ProgressBar.Line('#container');
</script>
    
      <div class="container">
          <div class="box box-body">

            <?php
                $sec_id = $_POST['section_id'];
                $answers = array();
                $questions = array();
                //Number of questions submitted == question_num from quiz.php
                $question_num = $_POST['question_num'];

                if($question_num==null || $question_num==0){
                  header("Location: ./course.php");
                  exit();
                }else{
                for($x = 1; $x <= $question_num; $x++){
                    //answer_id from answers ang value ani
                    $answers[$x] = $_POST['choices-'.$x];
                    //quiz_id from quizzes ang value ani
                    $questions[$x] = $_POST['quiz-'.$x];
                }

                $totalCorrect = 0;
                for($x = 1; $x <= $question_num; $x++){
                  $quiz_id = $questions[$x];
                  $sql = "SELECT quiz_id, quiz_answer FROM quizzes WHERE quiz_id = $quiz_id AND section_id = $sec_id";
                  foreach($conn->query($sql) as $row) {
                    if($row['quiz_answer']==$answers[$x]){
                      $totalCorrect++;
                    }
                  }
                }
                
                $rated_score = $totalCorrect / $question_num;
                $rated_score = round($rated_score,2);
                echo ' <p align="right"><a href="course.php"><button type="button" class="btn btn-secondary">Go back to the course</button></a></p>';
              }?>     
            <div id="container">
            <script src="js/progressbar.js"></script>
              <?php 
              echo "<script>
              
              // progressbar.js@1.0.0 version is used
              // Docs: http://progressbarjs.readthedocs.org/en/1.0.0/

              var bar = new ProgressBar.SemiCircle(container, {
                strokeWidth: 6,
                color: '#FFEA82',
                trailColor: '#eee',
                trailWidth: 1,
                easing: 'easeInOut',
                duration: 4000,
                svgStyle: null,
                text: {
                  value: '',
                  alignToBottom: false
                },
                from: {color: '#FFEA82'},
                to: {color: '#28bd28'},
                // Set default step function for all animate calls
                step: (state, bar) => {
                  bar.path.setAttribute('stroke', state.color);
                  var value = Math.round(bar.value() * 100);
                  if (value === 0) {
                    bar.setText('');
                  } else {
                    bar.setText(value + '%');
                  }

                  bar.text.style.color = state.color;
                }
              });
              bar.text.style.fontFamily = '".'Raleway'.", Helvetica, sans-serif';
              bar.text.style.fontSize = '2rem';

              bar.animate(".$rated_score.");  // Number from 0.0 to 1.0
              </script>";
              ?>
              
              </div>
              <?php
                  echo '<br><br><p align="center" style="margin: auto; color:green;" class="h1">Your score is '.$totalCorrect.' over '.$question_num.' questions!</p>';
                  if($totalCorrect < $question_num/2){
                    echo '<p align="center" style="margin: auto;" role="alert" class="alert-dangerous">Reviewing lectures is always a good idea.</p><br>';
                  }elseif($totalCorrect < $question_num){
                      echo '<p align="center" role="alert" style="margin: auto;" class="alert-warning">Just a little bit more.
                            </p><br>';
                  }else{
                      echo '<p align="center" style="margin: auto;" role="alert" class="alert-success">Congratulations!. Well done! Splendid.</p><br>';
                  }
              ?>

                <form action="quiz.php" method="POST">
                  <input type="hidden" name="section_id" value="<?php echo $_POST['section_id']; ?>">
                  <p align="center"><button type="submit" name="lec_submit" class="btn btn-warning">Retake Quiz</button></p>
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
