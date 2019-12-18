<?php



$dbServername = "localhost";

$dbUsername = "root";

$dbPassword = "";

$dbName = "ojc";



$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);



if(!$conn){

    header("Location: ../index.php?dberror=true");

    exit();

}