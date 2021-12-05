<?php
    session_start();
    require "../config/config.php";

    if(isset($_SESSION['adminEmail'])) {
        $email = $_SESSION['adminEmail'];
        $check_sql = "SELECT id,fname,lname FROM admin_table where email='$email'";
        if($rs=$conn->query($check_sql)) {
            if($row=$rs->fetch_assoc()) {
                $_SESSION['adminId'] = $row['id'];
                $_SESSION['adminFname'] = $row['fname'];
                $_SESSION['adminLname'] = $row['lname'];
            }
        }
    } else {
        header("location:./login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Dashboard</title>
    <link rel="stylesheet" href="../public/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <ul>
        <li>
            <a href="./logout.php">Logout</a>
        </li>
    </ul>
    <h1>DASHBOARD</h1>
</body>
</html>