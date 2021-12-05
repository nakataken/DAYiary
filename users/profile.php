<?php 
    $title = "Profile";
    require_once "./includes/header.php";

    if(isset($_SESSION['id'])) {
        $select_sql = "SELECT * FROM user_table WHERE id =".$_SESSION['id'];
        if($rs=$conn->query($select_sql)) {
            if($row=$rs->fetch_assoc()) {
                $fname = $row['FNAME'];
                $lname = $row['LNAME'];
                $bdate = $row['BIRTHDATE'];
                $email = $row['EMAIL'];
                $pass = $row['PASSWORD'];
            }
        }

        if(isset($_POST['changePass'])) {
            $changePass = true;
        }   

        if(isset($_POST['pass'])) {
            $decrypted = password_verify($_POST['pass'],$pass);
            if($decrypted) {
                $newPass = true;
            } else {
                $passError = "You have entered an invalid username or password.";
            }
        }

        if(isset($_POST['newPass'])) {
            $passwordCheck = password_verify($_POST['newPass'],$pass);

            if(!empty($_POST["newPass"]) && ($_POST["newPass"] == $_POST["confPass"])) {
                $newPass = $_POST["newPass"];
                $confPass = $_POST["confPass"];
                if (strlen($_POST["newPass"]) <= 8) {
                    $errorMessage.="Your Password Must Contain At Least 8 Characters!";
                    $passValidated = false;
                } elseif(!preg_match("#[0-9]+#",$pass)) {
                    $errorMessage.="Your Password Must Contain At Least 1 Number!";
                    $passValidated = false;
                } elseif(!preg_match("#[A-Z]+#",$pass)) {
                    $errorMessage.="Your Password Must Contain At Least 1 Capital Letter!";
                    $passValidated = false;
                } elseif(!preg_match("#[a-z]+#",$pass)) {
                    $errorMessage.="Your Password Must Contain At Least 1 Lowercase Letter!";
                    $passValidated = false;
                } else if($passwordCheck){
                    $errorMessage.="Your Password Must Not Be Same With Your Old Password!";
                    $passValidated = false;
                } else {
                    $encrypted = password_hash($newPass, PASSWORD_DEFAULT);
                    $passValidated = true;
                }
            } else {
                $errorMessage.="Password didn't match.";
                $passValidated = false;
            }

            if($passValidated) {
                $update_sql = 'UPDATE user_table SET PASSWORD="'.$encrypted.'" WHERE ID='.$_SESSION['id'];
                echo $update_sql;
                if($conn->query($update_sql)) { 
                    header("location:./profile.php");
                } else {
                    echo $conn->error;
                }
            }
        }
    } else {
        header("location:./login.php");
    }
?>

<div>
    <p><?php echo $fname; ?></p>
    <p><?php echo $lname; ?></p>
    <p><?php echo $bdate; ?></p>
    <p><?php echo $email; ?></p>
    <form method="POST">
        <input type="hidden" name="changePass" value="changePass">
        <button type="submit">Change Password</button>
    </form>
    <?php if(isset($changePass)) {  ?>
        <form method="POST">
            <label for="pass">Enter your password: </label>
            <input type="password" name="pass" required>
            <button type="submit">Submit</button>
        </form>
    <?php } ?>
    <?php if(isset($passError)) {?>
        <p class="text-danger"> <?php echo $passError; ?></p>
    <?php } ?>
    <?php if(isset($newPass)) {  ?>
        <form method="POST">
            <label for="newPass">New password</label>
            <input type="password" name="newPass" required>
            <label for="confPass">Confirm password</label>
            <input type="password" name="confPass" required>
            <button type="submit">Submit</button>
        </form>
    <?php } ?>
    <?php if(isset($errorMessage)) {?>
        <p class="text-danger"> <?php echo $errorMessage; ?></p>
    <?php } ?>
</div>

<?php require_once "./includes/footer.php"; ?>