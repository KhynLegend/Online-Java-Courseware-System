<?php
  session_start();
  if(!isset($_SESSION['u_id'])){
    header("Location: ./index.php");
    exit();
  }
  include 'includes/dbh.inc.php';
  $user_id = $_SESSION['u_id'];
  // Lecture's data form manager
  if(isset($_POST['lec_submit'])){
    $lec_id = $_POST['lecture_id'];
    $lec_status = $_POST['status'];
    //check if the lecture is already completed
    $sql = "SELECT comp_id, user_id, lecture_id, lecture_status FROM user_completion 
    WHERE lecture_id=$lec_id AND user_id=$user_id";
    
    $result = $conn->query($sql);

      $row_count = $result->num_rows;
      if($row_count == 0){
        $lecture_insert_sql = "INSERT INTO `ojc`.`user_completion` (`comp_id`, `lecture_id`, `user_id`, `lecture_status`) VALUES (NULL, '$lec_id', '$user_id', '$lec_status');";
		
        
		mysqli_query($conn,$lecture_insert_sql);
		
      }elseif ($row_count > 0){
        $row = $result->fetch_assoc();
        if($row['lecture_status']==''){
          $lecture_update_sql = "UPDATE user_completion SET lecture_status = 'checked' WHERE lecture_id = ? AND user_id=?";
          
          $stmt_lec_update = $conn->prepare($lecture_update_sql);
          $stmt_lec_update->bind_param("ii",$lec_id,$user_id);
          $stmt_lec_update->execute();
          $stmt_lec_update->close();
        }
        
      }
    
    
  }

  
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
    <script src="js/progressbar.js"></script>
    <!-- Theme Style -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Checkbox CSS -->
    <style>
    /* The container */
    .containerCheckbox {
        display: block;
        position: relative;
        padding-left: 35px;
        margin-bottom: 1px;
        cursor: pointer;
        font-size: 15px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    /* Hide the browser's default checkbox */
    .containerCheckbox input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
    }

    /* Create a custom checkbox */
    .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 25px;
        width: 25px;
        background-color: #eee;
        float: right;
    }


    /* On mouse-over, add a grey background color */
    .containerCheckbox:hover input~.checkmark {
        background-color: #ccc;
    }

    /* When the checkbox is checked, add a blue background */
    .containerCheckbox input:checked~.checkmark {
        background-color: rgb(15, 161, 40);
    }

    /* Create the checkmark/indicator (hidden when not checked) */
    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }

    /* Show the checkmark when checked */
    .containerCheckbox input:checked~.checkmark:after {
        display: block;
    }

    /* Style the checkmark/indicator */
    .containerCheckbox .checkmark:after {
        left: 9px;
        top: 5px;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 3px 3px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }

    .progress-label {
        float: right;
        margin-right: 5px;
    }

    #container {
        margin: 10px;
        width: 95%;
        height: 8px;
        position: relative;

    }

    .wrap {
        float: right;
        margin-right: 25px;
        margin-left: 25px;
        margin-top: 10px;
        margin-bottom: 5px;
        text-align: right;
        -webkit-box-shadow: 0 2px 30px 0px rgba(0, 0, 0, 0.2);
        box-shadow: 0 2px 30px 0px rgba(0, 0, 0, 0.2);
        height: 87px;
        width: auto;
        padding: 5px;
        background-color: #ffffffb7;
        z-index: 100;
    }
    </style>
</head>

<body>

    <header role="banner">

        <nav class="navbar navbar-expand-md navbar-dark bg-light">
            <div class="container">
                <a class="navbar-brand absolute" href="index.php">Online Java Courseware</a>

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

    <section class="site-hero overlay" data-stellar-background-ratio="0.5" style="background-image: url(images/img_2.jpg); padding: 20px;">
        <div class="container">
            <div class="row align-items-center site-hero-inner justify-content-center">
                <div class="col-md-12">

                    <div class="mb-5 element-animate">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h1 class="mb-3">Java Begginer Course: Core Concepts</h1>
                                <p>By Khyn Harold Jay Antoque</p>
                                <p class="lead mb-5">Learn Java using your full potential</p>
                            </div>
                            <div class="col-md-4">
                                <img src="images/javahead.jpg" style="height: auto;" alt="Image placeholder" class="img-fluid">
                                <br><br><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END section -->
    <div class="wrap">
        <div id="container"></div>
    </div>

    <!-- Episode Section-->
    <section class="site-section">

        <div class="container">

            <?php
        $sql = "SELECT lecture_status FROM user_completion WHERE user_id=$user_id AND lecture_status='checked'";
        $progress = $conn->query($sql);
        $progress_num = $progress->num_rows;
        $progress_total = $conn->query("SELECT * FROM lectures");
        $progress_total_num = $progress_total->num_rows;
        $current_progress = $progress_num / $progress_total_num;
        $current_progress = round($current_progress,2);
      
      ?>

        </div>
        <!-- Progress PHP Code, estimating the user's progress throughout the course -->
        <script>
        // progressbar.js@1.0.0 version is used
        // Docs: http://progressbarjs.readthedocs.org/en/1.0.0/

        var bar = new ProgressBar.Line(container, {
            strokeWidth: 4,
            easing: 'easeInOut',
            duration: 4000,
            // Change to color green if the current progress is full
            <?php 
          if($current_progress == 1)
            echo "color: '#28bd28',";
          else 
            echo "color: '#FFEA82',";
          ?>
            trailColor: '#eee',
            trailWidth: 1,
            svgStyle: {
                width: '100%',
                height: '100%'
            },
            text: {
                style: {
                    // Text color.
                    // Default: same as stroke color (options.color)
                    color: '#00000066',
                    position: 'relative',
                    right: '0',
                    top: '10px',
                    padding: 0,
                    margin: 0,
                    transform: null
                },
                autoStyleContainer: false
            },
            from: {
                color: '#FFEA82'
            },
            to: {
                color: '#28bd28'
            },
            step: (state, bar) => {
                bar.setText("Course progress: " + Math.round(bar.value() * 100) + ' %');
            }
        });

        bar.animate(<?php echo $current_progress;?>); // Number from 0.0 to 1.0
        </script>
        <div class="container">
            <!-- Episode Contents -->

            <!-- Automating Lecture Display -->
            <?php
        //Establishing the lecture content
        $sqlSec_num = "SELECT DISTINCT section_id FROM lectures";
        $stmt = mysqli_stmt_init($conn);
        if(mysqli_stmt_prepare($stmt, $sqlSec_num)){
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
        }
        $sec_num = mysqli_stmt_num_rows($stmt);

        //Query the names of each section for the table head
        $sqly = "SELECT section_id, section_name FROM sections";
        //Iterate each content from theads and their table rows
          foreach($conn->query($sqly) as $row){
            //loop each table head
            echo '<table class="table table-hover">
                    <thead class="thead-dark"><th>'.$row['section_name'].'</th></thead>
                    <tbody>';
            
            $sec_name = $row['section_name']; 
            $sql = "SELECT lecture_id, lecture_title FROM lectures WHERE section_id
             IN (SELECT section_id FROM sections WHERE section_name='$sec_name')";
              //iterate each row        
              foreach($conn->query($sql) as $rows){
                $lecture_id = $rows['lecture_id'];
                $checkedSql = "SELECT user_id, lecture_id, lecture_status FROM user_completion WHERE user_id='$user_id' AND lecture_id='$lecture_id';";
                $query = mysqli_query($conn, $checkedSql);
                $data_row = mysqli_fetch_assoc($query);
                    echo '<tr>
                            <td>
                            <label class="containerCheckbox">
                            <input onclick="check(this);" type="checkbox" '.$data_row['lecture_status'].' value="'.$lecture_id.'" disabled><span class="checkmark"></span>
                            </label>
                            <form name="form" method="GET" action="lecture.php">
                                ';
                                if($data_row['lecture_status']=='checked'){
                                  echo '<input type="hidden" id="'.$lecture_id.'" value="checked" name="checked">';
                                }else{
                                  echo '<input id="'.$lecture_id.'" type="hidden" value="" name="checked">';
                                }
                                  echo'<input type="hidden" value="'.$lecture_id.'" name="lecture_id">
                              <a style="color:#007bff; padding-left:3em; cursor: pointer;" onclick="$(this).closest(\'form\').submit()">'.$rows['lecture_title'].'</a>
                             </form>
                            </td>
                          </tr>';
                      }
                      if($row['section_id']>2){
                        echo '<tr>
                        <td>
                        <form action="quiz.php" method="POST" name="form">
                          <input type="hidden" value="'.$row['section_id'].'" name="section_id">
                          <a style="color:#007bff; cursor: pointer;" onclick="$(this).closest(\'form\').submit()">Short Quiz</a>
                        </form>
                        </td>
                        </tr>';
                      }
                
              echo '</tbody>
              </table>';
          }
          
      ?>
            <!-- Episodes Ended -->
        </div>
    </section>

    <?php 
      include 'includes/footer.php';
      
    ?>



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