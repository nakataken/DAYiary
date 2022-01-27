<?php 
    $title = "Profile";


    $errorMessage ="";
    require_once "./includes/header.php";


    if(isset($_SESSION['id'])) {
        $select_sql = "SELECT * FROM dms_user_table WHERE ID =".$_SESSION['id'];
        $date = date('Y-m-d');

        if($rs=$conn->query($select_sql)) {
            if($row=$rs->fetch_assoc()) {
                $name = $row['NAME'];
                $bdate = $row['BIRTHDATE'];
                $username = $row['USERNAME'];
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
                $passError = "You have entered an invalid password.";
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
                $update_sql = 'UPDATE dms_user_table SET PASSWORD="'.$encrypted.'", MODIFIED_AT="'.$date.'" WHERE ID='.$_SESSION['id'];
                echo $update_sql;
                if($conn->query($update_sql)) { 
                    echo '<script>alert("Password changed successfully.")</script>'; 
                    header("location:./profile.php");
                } else {
                    echo $conn->error;
                }
            }
        }
    } else {
        header("location:./login.php");
    }

    $dateholder = strtotime($bdate);
    $dateformat =date('F j, Y ', $dateholder);
       
?>
<div class="profile-div container-fluid">
<div class="container my-5">
    <div class="left-div col-lg-8 mx-auto">
        <div class= "top-div col-12 p-3">
            <div class="dropdown dropstart col-1 ms-auto">
                <button class="btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="../public/img/menu_w.png" alt="log-illus" class="ms-auto">
                </button>
                <ul class="dropdown-menu  p-0" aria-labelledby="dropdownMenuButton1">
                    <li class="p-0">
                        <a class="dropdown-item" onclick="changePassword()">
                            Change Password
                        </a>
                        <a class="dropdown-item"  href="/DAYiary/users/logout.php">
                            Logout
                        </a>
                    </li>
                    
                </ul>
            </div>    
            <div class= "circle d-flex align-items-center mx-auto">
                    <h3 class="text-center col-12 my-auto">M</h3>
            </div>
            <p class="text-center name mt-3"><?=  $username; ?></p>
        </div>
        <div class="bot-div mb-5">
            <div class="px-2 mt-4">
                <p class="date text-center m-0">Name:</p>
                <p class="name text-center m-0"><?=  $name; ?></p>
                <p class="date text-center mt-2 mb-0">Email:</p>
                <p class="name text-center m-0"><?=  $email; ?></p>
                <p class="date text-center mt-2 mb-0">Birthday:</p>
                <p class="name text-center m-0"><?=  $dateformat; ?></p>

            </div>

        
            <form class="col-lg-6 col-12 d-none d-flex flex-column mt-5 px-5 mx-auto" method="POST" id="pass_verification">
                <label for="pass">Enter your password: </label>
                <input  class="form-control mt-2"   type="password" name="pass" required>
                <button class="btn px-3 mt-3 ms-auto"  type="submit">Confirm</button>
                
            </form>
            <?php if(isset($passError)) {?>
                <p class="text-danger text-center d-block px-5 mt-5" id="pass_invalid"> <?php echo $passError; ?></p>
            <?php } ?>

            <?php if(isset($newPass)) {  ?>
                <form class="col-lg-6 col-12 d-none d-flex flex-column mt-5 px-5 mx-auto"  method="POST">
                    <label for="newPass">New password:</label>
                    <input class="form-control my-2" type="password" name="newPass" required>
                    <label for="confPass">Confirm password: </label>
                    <input  class="form-control mt-2"   type="password" name="confPass" required>
                    <button class="btn px-5 mt-3 ms-auto" type="submit">Change Password</button>
                </form>
            <?php } ?>

            <?php if(isset($errorMessage)) {?>
                <p class="text-danger text-center px-5 mt-5" id="match_error"> <?php echo $errorMessage; ?></p>
            <?php } ?>
        </div>
        
        
            
    </div>

</div>
</div>


<?php require_once "./includes/footer.php"; ?>

<script>

function changePassword() {
  var element= document.getElementById("pass_verification");
  var invalid_2 = document.getElementById("match_error");
  var invalid_1= document.getElementById("pass_invalid");

  element.classList.remove("d-none");
  element.classList.add("d-block");
  invalid_2.classList.add("d-none");
  invalid_1.classList.add("d-none");
}
</script>


<!-- 
<?php if(isset($changePass)) {  ?>
<?php } ?>
-->
