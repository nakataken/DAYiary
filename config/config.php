<?php 
    $server = "localhost";
    // to be changed later
    $user = "root"; 
    $pass = "";
    $db_name = "dms_dayiarydb";
    $conn = new mysqli($server, $user, $pass, $db_name);
    if($conn->connect_error) {
        die('Connection Failed'.$conn->connect_error);
    }
?>