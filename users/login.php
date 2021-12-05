<?php 
    $title = "Login";
    require_once "../includes/header.php";
    $errorMessage = "";

    if(isset($_POST['email'])) {
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $check_sql = "SELECT email, fname, lname, password FROM user_table where email='$email'";
        if($rs=$conn->query($check_sql)) {
            if($row=$rs->fetch_assoc()) {
                $decrypted = password_verify($pass,$row['password']);
                if($decrypted) {
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['fname'] = $row['fname'];
                    $_SESSION['lname'] = $row['lname'];
                    header("location:./index.php");
                } else {
                    $errorMessage = "You have entered an invalid username or password";
                }
            } else {
                $errorMessage = "You have entered an invalid username or password";
            }
        } 
    }
?>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2>Login</h2>
            <form method="POST">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="pass">Password</label>
                    <input type="password" name="pass" class="form-control" required>
                </div>
                <?php if(isset($errorMessage)) {?>
                    <p class="text-danger"> <?php echo $errorMessage; ?></p>
                <?php } ?>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>
</div>

<?php require_once "../includes/footer.php"; ?>