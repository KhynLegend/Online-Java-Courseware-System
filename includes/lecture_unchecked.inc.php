<?php
    session_start();
    $user_id = $_SESSION['u_id'];
    header("Content-type: text/javascript");
    include 'dbh.inc.php';

    $sql = "UPDATE user_completion SET lecture_status='' WHERE user_id=$user_id AND lecture_id";

    echo 'alert("Unchecked");';