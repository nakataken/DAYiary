<?php 
    require "../config/config.php";

    $username = "sysadmin";
    $pass = password_hash("Admin12345", PASSWORD_DEFAULT);

    $insert_sql = "INSERT INTO admin_table SET USERNAME='".$username."',PASSWORD='".$pass."'";
    if(!$conn->query($insert_sql)) {
        echo '<script>alert("'.$conn->error.'")</script>';
    }
?>