<?php 

    $title = "Register";
    require_once "./includes/header.php";
    if(!isset($_SESSION['username'])){
        if(isset($_POST['username'])) {
            $name = $_POST['name'];
            $bdate = $_POST['bdate'];
            $username = $_POST['username'];
            $pass = $_POST["pass"];
            $confPass = $_POST["confPass"];
    
            if(!empty($_POST["pass"]) && ($_POST["pass"] == $_POST["confPass"])) {
                if (strlen($_POST["pass"]) <= 8) {
                    $passError.="Your Password Must Contain At Least 8 Characters!";
                    $passValidated = false;
                } elseif(!preg_match("#[0-9]+#",$pass)) {
                    $passError.="Your Password Must Contain At Least 1 Number!";
                    $passValidated = false;
                } elseif(!preg_match("#[A-Z]+#",$pass)) {
                    $passError.="Your Password Must Contain At Least 1 Capital Letter!";
                    $passValidated = false;
                } elseif(!preg_match("#[a-z]+#",$pass)) {
                    $passError.="Your Password Must Contain At Least 1 Lowercase Letter!";
                    $passValidated = false;
                } else {
                    $encrypted = password_hash($pass, PASSWORD_DEFAULT);
                    $userValidated = $passValidated = true;
                }
            } else {
                $passError.="Password didn't match.";
                $passValidated = false;
            }
            
            if($userValidated && $passValidated) {
                $check_sql = "SELECT USERNAME FROM user_table where USERNAME='$username'";
                if($rs=$conn->query($check_sql)) {
                    if($rs->num_rows==0) {
                        $insert_sql = "INSERT INTO user_table SET NAME='$name',USERNAME='$username',password='$encrypted',birthdate='$bdate'";
                        if(!$conn->query($insert_sql)) {
                            echo '<script>alert("'.$conn->error.'")</script>';
                        } else {
                            echo '<script>alert("Registration Successful.")</script>'; 
                            $_SESSION['username'] = $username;
                            header("location:./index.php");
                        }
                    } else {
                        $userError.="Username already used.";
                        $userValidated = false; 
                    }
                }
            }
        }
     
    }
    else{
       header("location:./index.php");
    }
    

?>

<div class="reg-div container-fluid  d-flex flex-row align-items-center mt-5">
    <div class="container-fluid col-lg-6 d-lg-block d-none ">
        <img src="../public/img/download(1).png" alt="log-illus" class="">
    </div>
    <div class="right-div container col-lg-6 col-8">
        <div class="d-flex flex-column  col-xxl-7 col-xl-8 col-lg-10 col-12 mx-auto">
            <h1 class="m-0">Welcome to DAYiary!</h1>
            <h2 class="m-0">Create your account</h2>
            <form class="mt-5" method="POST">
                <div class="form-group mb-3">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label for="bdate">Birthdate</label>
                    <input id="datefield" type="date" name="bdate" class="form-control" max="" required>
                </div>
                <div class="form-group mb-3">
                    <label for="username">Username</label>
                    <input type="text" name="username" class="form-control" required>
                    <div>
                        <?php if(isset($userError)) {?>
                        <p class="text-danger"> <?php echo $userError; ?></p>
                        <?php } ?>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="pass">Password</label>
                    <input type="password" name="pass" class="form-control" required>
                </div>
                <div class="form-group mb-5">
                    <label for="confPass">Confirm Password</label>
                    <input type="password" name="confPass" class="form-control" required>
                    <?php if(isset($passError)) {?>
                    <p class="error-meessage"><?php echo $passError; ?></p>
                    <?php } ?>
                </div>
  
                <button type="submit" class="btn col-12 mt-3">Sign up</button>
                <h2 class="text-center my-5">Already a member? <a href="/DAYiary/users/login.php">Log in </a></h2>
            </form>
        </div>
    </div>
</div>

<script src="../public/currentDate.js"></script>

<?php require_once "./includes/footer.php"; ?>