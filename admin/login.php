<?php 
    session_start();
    
    require "../config/config.php";
    $errorMessage = "";

    if(isset($_POST['email'])) {
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $check_sql = "SELECT email, password FROM admin_table where email='$email'";
        if($rs=$conn->query($check_sql)) {
            if($row=$rs->fetch_assoc()) {
                $decrypted = password_verify($pass,$row['password']);
                if($decrypted) {
                    $_SESSION['adminEmail'] = $row['email'];
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Login</title>
    <link rel="stylesheet" href="../public/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
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
</body>
</html>