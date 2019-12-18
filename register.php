<?php 
if(isset($_SESSION['u_id'])){
  header("Location: ../index.php");
  exit();
}
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Online Java Courseware</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="icon" href="images/logo.png">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,900" rel="stylesheet">

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
              <h1>Register</h1>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- END section -->

    <section class="site-section bg-light">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-5 box">
            <h2 class="mb-5">Register new account</h2>
            <div class="alert alert-warning" role="alert">
              <?php
                if(isset($_GET['error'])){
                  switch($_GET['error']){

                    case "12ff":
                    case "x801false":
                      echo "Error occured, please contact the researchers.";
                      break;
                    
                    case "6732Ad":
                      echo "This email is taken by an existing user!";
                      break;

                    case "1dcA4":
                      echo "Please use a proper password!";
                      break;

                    case "84658lNM":
                      echo "Please use stronger password. The password's length must be 8 characters long.";
                      break;
                    
                    case "1644HNnnLsad":
                      echo "The password doesn't match with the previous password.";
                      break;

                    default:
                      echo "Unknown error occured, please contact the researchers.";
                  }
                }else{
                   echo "Please register yourself first.";
                }
              ?>
            </div>
            <!--Register Form Here-->
            <form name="register" action="includes/signup.inc.php" method="post" onsubmit="return submitUserForm();">
                  <div class="row">
                    <div class="col-md-12 form-group">
                      <label for="email">Email Address</label>
                      <input type="email" id="email" name="email" class="form-control" min="8" required>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 form-group">
                      <label for="password">Password</label>
                      <input type="password" id="password" name="password" class="form-control " required>
                    </div>
                  </div>
                  <div class="row mb-5">
                    <div class="col-md-12 form-group">
                      <label for="repassword">Re-type Password</label>
                      <input type="password" id="password" name="repassword" class="form-control " required>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 form-group">
                      <div id="g-recaptcha-error"></div>
                      <div class="g-recaptcha" data-sitekey="6Lc-8HQUAAAAAIporarpoHmGY1uU7bRt70R2LvrA"></div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 form-group">
                      <input type="submit" value="Register" name="submit" class="btn btn-primary" onclick="return checkForm()">
                    </div>
                  </div>
                </form>
              <!-- Form Ended -->
          </div>
        </div>
      </div>
    </section>
    <!-- END section -->

  
    <?php include 'includes/footer.php'?>
    <!-- END footer -->
    
    <script src="jquery-3.2.1.min.js"></script>
    <script src="jquery-migrate-3.0.0.js"></script>
    <script src="popper.min.js"></script>
    <script src="bootstrap.min.js"></script>
    <script src="owl.carousel.min.js"></script>
    <script src="jquery.waypoints.min.js"></script>
    <script src="jquery.stellar.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
    function submitUserForm() {
			var response = grecaptcha.getResponse();
			if (response.length == 0) {
				document.getElementById('g-recaptcha-error').innerHTML = '<span style="color:red;">This field is required.</span>';
				return false;
			}
			return true;
		}

		function verifyCaptcha() {
			document.getElementById('g-recaptcha-error').innerHTML = '';
		}
    </script>
    
    <script src="main.js"></script>
  </body>
</html>