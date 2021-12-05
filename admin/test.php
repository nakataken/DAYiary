<?php 
    require "../config/config.php";

    $fname = "System";
    $lname = "Administrator";
    $email = "admin@gmail.com";
    $pass = password_hash("Admin12345", PASSWORD_DEFAULT);

    $insert_sql = "INSERT INTO admin_table SET email='$email',password='$pass',fname='$fname',lname='$lname'";
    if(!$conn->query($insert_sql)) {
        echo '<script>alert("'.$conn->error.'")</script>';
    }
?>