<?php 
    require "../config/config.php";
?>

<?php 
    $title = "Login";
    require_once "../includes/header.php";
?>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2>Login</h2>
            <form action="validation.php" method="POST">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>
</div>

<?php require_once "../includes/footer.php"; ?>