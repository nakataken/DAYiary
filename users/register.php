<?php 
    $title = "Register";
    require_once "./includes/header.php";
    
    if(isset($_POST['username'])) {
        $name = $_POST['name'];
        $bdate = $_POST['bdate'];
        $username = $_POST['usernmae'];
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
                $passValidated = true;
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
?>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2>Register</h2>
            <form method="POST">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="bdate">Birthdate</label>
                    <input id="datefield" type="date" name="bdate" class="form-control" max="" required>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" class="form-control" required>
                    <div>
                        <?php if(isset($userError)) {?>
                        <p class="text-danger"> <?php echo $userError; ?></p>
                    <?php } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="pass">Password</label>
                    <input type="password" name="pass" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="confPass">Confirm Password</label>
                    <input type="password" name="confPass" class="form-control" required>
                </div>
                <div>
                    <?php if(isset($passError)) {?>
                    <p class="text-danger"> <?php echo $passError; ?></p>
                <?php } ?>
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
            </form>
        </div>
    </div>
</div>

<script src="../public/currentDate.js"></script>

<?php require_once "./includes/footer.php"; ?>