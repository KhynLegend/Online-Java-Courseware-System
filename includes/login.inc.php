<?php

session_start();

if(isset($_POST['submit'])){
    include 'dbh.inc.php';

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE user_email=?;";
    //Create a prepared statment
    $stmt = $conn->prepare($sql);
	$stmt->bind_param("s",$email);
	$stmt->execute();
	$result = $stmt->get_result();
    
    if($stmt->num_rows() > 0){
        header("Location: ../login.php?error=x8401");
        exit();
    }else{
        if($row = $result->fetch_assoc()){
            //De-hashing Password
            $hashedPasswordCheck = password_verify($password, $row['user_password']);
            if($hashedPasswordCheck == false){
                header("Location: ../login.php?error=6783x");
                exit();
            }elseif ($hashedPasswordCheck == true){
                $_SESSION['u_id'] = $row['user_id'];
                $_SESSION['u_email'] = $row['user_email'];
                header("Location: ../course.php");
                exit();
            }
        }else{
            header("Location: ../login.php?error=xxx666");
                exit();
        }
    }

}else if(isset($_SESSION['u_id'])){
    header("Location: ../index.php");
    exit();
} else {
    header("Location: ../login.php?error=true");
    exit();
}