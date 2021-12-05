<?php 
    $title = "Register";
    require_once "./includes/header.php";
    
    if(isset($_POST['fname'])) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $bdate = $_POST['bdate'];
        $email = $_POST['email'];
        $pass = "";
        $confPass = "";
        $encrypted = "";
        $emailValidated = false;
        $passValidated = false;
        $passError = "";
        $emailError = "";

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailError.="Not a valid email address.";
            $emailValidated = false;
        } else {
            $emailValidated = true;
        }

        if(!empty($_POST["pass"]) && ($_POST["pass"] == $_POST["confPass"])) {
            $pass = $_POST["pass"];
            $confPass = $_POST["confPass"];
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
        
        if($emailValidated && $passValidated) {
            $check_sql = "SELECT email FROM user_table where email='$email'";
            if($rs=$conn->query($check_sql)) {
                if($rs->num_rows==0) {
                    $insert_sql = "INSERT INTO user_table SET email='$email',password='$encrypted',fname='$fname',lname='$lname',birthdate='$bdate'";
                    if(!$conn->query($insert_sql)) {
                        echo '<script>alert("'.$conn->error.'")</script>';
                    } else {
                        echo '<script>alert("Registration Successful.")</script>'; 
                        $_SESSION['email'] = $email;
                        header("location:./index.php");
                    }
                } else {
                    $emailError.="gamit na email";
                    $emailValidated = false; 
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
                    <label for="fname">First Name</label>
                    <input type="text" name="fname" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="lname">Last Name</label>
                    <input type="text" name="lname" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="bdate">Birthdate</label>
                    <input id="datefield" type="date" name="bdate" class="form-control" max="" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" class="form-control" required>
                    <div>
                        <?php if(isset($emailError)) {?>
                        <p class="text-danger"> <?php echo $emailError; ?></p>
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

<script>
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; 
    var yyyy = today.getFullYear();

    if (dd < 10)
        dd = '0' + dd;

    if (mm < 10) 
        mm = '0' + mm;
        
    today = yyyy + '-' + mm + '-' + dd;
    document.getElementById("datefield").setAttribute("max", today);
</script>

<?php require_once "./includes/footer.php"; ?>