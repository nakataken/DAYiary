<?php 
    $title = "Login";
    require_once "./includes/header.php";
    $errorMessage = "";

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
?>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2>Login</h2>
            <form method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" class="form-control" required>
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

<?php require_once "./includes/footer.php"; ?>