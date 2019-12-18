<?php
if (isset($_POST['submit'])){

    include_once 'dbh.inc.php';

    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpass = $_POST['repassword'];

    // Error Handling
    if(strlen($password) < 8){
        header("Location: ../register.php?error=84658lNM");
        exit();
    }elseif ($confirmpass != $password){
        header("Location: ../register.php?error=1644HNnnLsad");
        exit();
    } else {
        //Check email if duplicated in database
        $sql = "SELECT * FROM users WHERE user_email=?;";
        //Create a prepared statement
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            //Query Error
            header("Location: ../index.php?error=12ff");
            exit();
        }else{
            //Bind parameters to the placeholder
            mysqli_stmt_bind_param($stmt, "s", $email);
            //Run parameters inside the database
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
        }

        // If the $resultCheck detects email check return a number of rows the its taken
        if(mysqli_stmt_num_rows($stmt) == 1){
            //Email Error
            header("Location: ../register.php?error=6732Ad");
            exit();
        } else {
            // Password Hashing
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);   
            // Insert the user to the database
            $sql = "INSERT INTO users (user_email, user_password) VALUES (?, ?);";
            //Create prepared statement
            $stmt = mysqli_stmt_init($conn);
            //Check if the statement is prepared: Error Handling
            if(!mysqli_stmt_prepare($stmt, $sql)){
                //Password Error
                header("Location: ../index.php?error=1dcA4");
                exit();
            }else{
                //Bind parameters to the placeholder
                mysqli_stmt_bind_param($stmt, "ss", $email, $hashedPassword);
                //Run parameters inside the database
                mysqli_stmt_execute($stmt);
                //DB error
                header("Location: ../login.php?error=x801false");
                exit();
            }
        }
    }
} else {
    header("Location: ../register.php");
    exit();
}
