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
    
    $block ="d-block";
    $toggler ="collapse navbar-collapse";
    if($_SERVER['REQUEST_URI'] == '/DAYiary/users/register.php' || $_SERVER['REQUEST_URI'] == '/DAYiary/users/login.php'){
        $toggler ="";
        $block ="d-none";
    }
    else{
        $toggler ="collapse navbar-collapse";
        $block ="d-md-none d-block";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="diary, online diary, free online diary, journal">
    <meta name="author" content="DAYiary">
    <meta name="description" content="Save diary or journal online">
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
    <nav class="navbar navbar-expand-md   px-md-5 px-2 pt-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="/DAYiary/users/"><img src="../public/img/logo.png" alt="logo" class="logo"></a>
            <button  class="<?=$block?> navbar-toggler p-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon col-12 my-auto"><img src="./../public/img/menu_btn.png" class="mx-auto col-12 my-auto"></span>
            </button>

            <div class="<?=$toggler?> collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto my-auto d-flex flex-md-row flex-column align-items-end ">
                    <?php if(!isset($_SESSION['username'])) { ?>
                        
                        <?php if($_SERVER['REQUEST_URI'] == '/DAYiary/users/register.php' || $_SERVER['REQUEST_URI'] == '/DAYiary/users/verification.php'){?>
                            <li class="nav-item">
                                <a class="nav-link " href="/DAYiary/users/login.php"> <button type="submit" class=" reg-btn btn px-5">Login</button></a>
                            </li>

                        <?php }?>

                        <?php if($_SERVER['REQUEST_URI'] == '/DAYiary/users/login.php'){?>
                            <li class="nav-item">
                                <a class="nav-link" href="/DAYiary/users/register.php"> <button type="submit" class="reg-btn btn px-5">Register</button></a>
                            </li>
                        <?php }?>

                    <?php } else { ?>
                    <?php $toggler ="navbar-expand-lg"; ?>
                    <li class="nav-item">
                        <a class="nav-link mx-3" href="/DAYiary/users">Home</a>
                    </li>
                    <li class="nav-item">
                        <a  class="nav-link mx-3"  href="/DAYiary/users/createDiary.php">Diary</a>
                    </li>
                    <li class="nav-item d-md-block d-none">
                        <div class="dropdown  ms-auto nav-link">
                                <button class="profile-btn btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    Profile
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end mt-lg-1 mt-2 p-0" aria-labelledby="dropdownMenuButton1">
                                    <li class=" p-0">
                                        <a class="dropdown-item"  href="/DAYiary/users/profile.php">
                                        Settings
                                        </a>
                                        <a class="dropdown-item"   href="/DAYiary/users/logout.php" >
                                        Log out
                                        </a>
                                    </li>
                                
                                </ul>
                            </div>
                    </li>
                    <li class="nav-item d-md-none col-12 border-top border-bottom d-flex flex-column align-items-end">
                        
                        <a class="nav-link mx-3"  href="/DAYiary/users/profile.php">
                        Settings
                        </a>
                        <a class="nav-link mx-3 "   href="/DAYiary/users/logout.php" >
                        Log out
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            
            </div>
        </div>
        
    </nav>
</header>