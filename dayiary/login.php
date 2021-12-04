<?php 
    $title = "Login";
    require_once "../includes/header.php";

    if(isset($_POST['email'])) {
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $check_sql = "SELECT email, fname, lname, password FROM user_table where email='$email'";
        // Insert encryption and decryption
        if($rs=$conn->query($check_sql)) {
            if($row=$rs->fetch_assoc()) {
                // $decrypted = password_verify("Kennakata0130_",'$2y$10$biHoplRuJk29Z6rAg/KNIOKg8sLqSs5Tyd2bVFPZZce');
                if($pass == $row['password']) {
                    $validated = true;
                    echo "Verified";
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['fname'] = $row['fname'];
                    $_SESSION['lname'] = $row['lname'];
                    header("location:./index.php");
                } else {
                    $validated = false;
                }
            }
        }
    } else {
        $validated = false;
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
                <!-- <?php if(isset($validated) && !$validated) {?>
                    <p class="text-danger"> <?php echo "Email or Password basta mali"; ?></p>
                <?php } ?> -->
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>
</div>

<?php require_once "../includes/footer.php"; ?>