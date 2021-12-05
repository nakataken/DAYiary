<?php
    session_start();
    require "../config/config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="../public/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<header>
    <a href="/DAYiary/users/">DAYiary</a>
    <ul>
        <?php if(!isset($_SESSION['email'])) { ?>
            <li>
                <a href="/DAYiary/users/login.php">Login</a>
            </li>
            <li>
                <a href="/DAYiary/users/register.php">Register</a>
            </li>
        <?php } else { ?>
            <li>
                Hello, <?php echo $_SESSION['fname'].' '.$_SESSION['lname']; ?>
            </li>
            <li>
                <a href="/DAYiary/users/profile.php">Profile</a>
            </li>
            <li>
                <a href="/DAYiary/users/logout.php">Logout</a>
            </li>
        <?php } ?>
    <ul>
</header>