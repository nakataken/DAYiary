<?php 
    $title = "Home";
    require_once "./includes/header.php";
    
    if(!isset($_SESSION['email'])) {
        header("location:./login.php");
    }
?>

<a href="/DAYiary/users/createDiary.php">Create Diary</a>

<?php require_once "./includes/footer.php"; ?>
