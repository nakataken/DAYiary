<?php 
    $title = "Home";
    require_once "../includes/header.php";
    
    if(!isset($_SESSION['email'])) {
        header("location:./login.php");
    }
?>

<?php require_once "../includes/footer.php"; ?>
