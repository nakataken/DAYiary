<?php 
    $title = "Login";
    require_once "./includes/header.php";
    $errorMessage = "";

    if(!isset($_SESSION['username'])) {
        if(isset($_POST['username'])) {
            
            $check_sql = "SELECT USERNAME, PASSWORD FROM user_table where USERNAME='".$_POST['username']."'";
            if($rs=$conn->query($check_sql)) {
                if($row=$rs->fetch_assoc()) {
                    $decrypted = password_verify($_POST['pass'],$row['PASSWORD']);
                    if($decrypted) {
                        $_SESSION['username'] = $row['USERNAME'];
                        header("location:./index.php");
                    } else {
                        $errorMessage = "You have entered an invalid username or password.";
                    }
                } else {
                    $errorMessage = "You have entered an invalid username or password.";
                }
            } 
        } 
    }else{
        header("location:./index.php");
    }
    
    
?>
<div class="reg-div container-fluid d-flex flex-row align-items-center mt-5">
    <div class="container col-lg-6 d-lg-block d-none">
        <img src="../public/img/download(1).png" alt="log-illus" class="">
    </div>
    <div class="right-div container d-flex flex-column col-lg-6 col-md-8 col-10 ">
        <div class="d-flex flex-column col-xxl-7 col-xl-8 col-lg-10 col-12  mx-auto">   
            <h1 class="m-0">Welcome back!</h1>
            <h2 class="m-0">Log in to your account</h2>
            <form class="mt-5" method="POST">
                <div class="form-group mb-3">
                    <label for="username">Username:</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="form-group mb-5">
                    <label for="pass">Password: </label>
                    <input class="form-control"  type="password" name="pass" required>
                    <?php if(isset($errorMessage)) {?>
                    <p class="error-meessage"><?php echo $errorMessage; ?></p>
                    <?php } ?>
                    
                </div>
                
                <button type="submit" class="btn col-12 mt-3">Login</button>
            </form>
            
            <h2 class="text-center my-5">Don’t have an account? <a href="/DAYiary/users/register.php">Sign Up Now </a></h2>
            
        </div>

    </div>
</div>

<?php require_once "./includes/footer.php"; ?>