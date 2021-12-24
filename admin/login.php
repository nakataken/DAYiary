<?php 
    session_start();
    
    require "../config/config.php";
    $errorMessage = "";

    if(isset($_POST['username'])) {
        $check_sql = "SELECT USERNAME, PASSWORD FROM admin_table WHERE USERNAME='".$_POST['username']."'";
        if($rs=$conn->query($check_sql)) {
            if($row=$rs->fetch_assoc()) {
                $decrypted = password_verify($_POST['pass'],$row['PASSWORD']);
                if($decrypted) {
                    $_SESSION['adminUsername'] = $row['USERNAME'];
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
    <link rel="stylesheet" href="../public/css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <div class="admin-login container d-flex flex-row align-items-center">
        <div class="d-flex flex-column justify-content-center col-xl-4 col-md-6 col-8 mx-auto">
                <h2>Admin Login</h2>
                <form method="POST" class="mt-3">
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
                    <button type="submit" class="btn  col-12 mt-4">Login</button>
                </form>
      
        </div>
    </div>
</body>
</html>