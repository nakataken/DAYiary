<?php
    session_start();
    require "../config/config.php";

    if(isset($_SESSION['username'])) {
        $check_sql = "SELECT ID, NAME FROM user_table WHERE USERNAME='".$_SESSION['username']."'";
        if($rs=$conn->query($check_sql)) {
            if($row=$rs->fetch_assoc()) {
                $_SESSION['id'] = $row['ID'];
                $_SESSION['name'] = $row['NAME'];
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="../public/css/index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body class="main">
<header>

    <nav class="navbar navbar-expand-md px-5 pt-3">
        <a class="navbar-brand" href="/DAYiary/users/"><img src="../public/img/logo.png" alt="logo" class="logo"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">
                <?php if(!isset($_SESSION['username'])) { ?>
                
                    <?php if($_SERVER['REQUEST_URI'] == '/DAYiary/users/register.php'){?>
                        <li class="nav-item">
                            <a class="nav-link" href="/DAYiary/users/login.php"> <button type="submit" class="btn px-5">Login</button></a>
                        </li>
                    <?php }?>

                    <?php if($_SERVER['REQUEST_URI'] == '/DAYiary/users/login.php'){?>
                        <li class="nav-item">
                            <a class="nav-link" href="/DAYiary/users/register.php"> <button type="submit" class="btn px-5">Register</button></a>
                        </li>
                    <?php }?>

                <?php } else { ?>
                <li class="nav-item">
                    Hello, <?php echo $_SESSION['name']; ?>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-3" href="/DAYiary/users/profile.php">My Profile</a>
                </li>
                <li class="nav-item">
                    <a  class="nav-link mx-3" href="/DAYiary/users/logout.php">My Diary</a>
                </li>
                <li class="nav-item">
                    <button type="submit" class="btn">Log out</button>
                </li>
                <?php } ?>
            </ul>
        
        </div>
    </nav>
  
</header>