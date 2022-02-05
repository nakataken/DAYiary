

<?php 
    $title = "Home";
    require_once "./includes/header.php";
    include "display.php";

?>

<div class="home-div container-fluid  d-flex flex-lg-row row-reverse flex-column align-items-center mb-5">
    <div class="left-div container col-lg-5 col-md-6  p-0">
        <img src="../public/img/dayiary-01.png" alt="log-illus" class="illus col-12">
    </div>
    <div class="right-div container col-xl-5 col-lg-6 col-12 ms-auto">
        <div class="d-flex flex-column col-lg-10 col-12 ">
            <h1 class="col-12">Hello, <?php echo $_SESSION['username']; ?>!</h1>
            <h2 class="col-md-8 col-12">With <img src="../public/img/dayiary_ud.png" alt="logo" class="my-top"> you can now save your memories and day to day activities easily.</h2>
            <div class="d-flex flex-row flex-wrap justify-content-md-start justify-content-center col-12 mt-2 p-0 ">
                <a href="/DAYiary/users/createDiary.php" class="col-md-6 col-12 pe-md-1"><button type="submit" class="btn col-12 mt-3 button_1">Write Now</button></a>
                <a href="/DAYiary/users/view.php" class="col-md-6 col-12 ps-md-1"><button type="submit" class="btn col-12 mt-3 button_2">View Diary</button></a>
            </div>
        </div>
    </div>
    
</div>

</body>
</html>


<script>

</script>