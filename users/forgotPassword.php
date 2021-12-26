<?php 

    error_reporting(0);
    
    require_once "./includes/header.php";
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    function forgot_pass(){ 
        if (!isset($_SESSION['CREATED'])) {
            $_SESSION['CREATED'] = time();
        }
        
        require 'PHPMailer/Exception.php';
        require 'PHPMailer/PHPMailer.php';
        require 'PHPMailer/SMTP.php';

        $code = $_SESSION['code'];
        $mail = new PHPMailer;
        
        $mail->isSMTP();                                        // Set mailer to use SMTP
        $mail->Host = "smtp.gmail.com";                         // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                                 // Enable SMTP authentication
        $mail->Username = "dayiary.noreply@gmail.com";          // SMTP username
        $mail->Password = 'Dayiary2020';     
        $mail->Port = 465;                       
        $mail->SMTPSecure = 'ssl';                              // Enable encryption, 'ssl' also accepted

        $mail->From = 'dayiary.noreply@gmail.com';
        $mail->FromName = 'Dayiary';
        $mail->addAddress ($_SESSION['email']);                 // Add a recipient        
    
        $mail->WordWrap = 1000;                                 // Set word wrap to 50 characters
        $mail->isHTML(true);                                    // Set email format to HTML

        $mail->Subject = 'Forgot your password?';
        $mail->Body    = '<p>To reset your password, enter the code below. This code is only valid for 10 minutes.</p><h1>'.$code.'</h1>';
        $mail->AltBody = 'To reset your password, enter the code '.$code.'. This code is only valid for 10 minutes. ';

        try {
            $mail->send();
        // echo "Message has been sent successfully";
        } catch (Exception $e) {
        //   echo "Mailer Error: " . $mail->ErrorInfo;
        }
    }
 
    if(isset($_POST['email'])){
       
        $email = $_POST['email'];
        $check_sql = "SELECT EMAIL FROM user_table where EMAIL ='$email'";
        if($rs=$conn->query($check_sql)) {
            if($rs->num_rows==0) {
                $_SESSION['emailError'] ="Account doesn't exist.";
                $emailValidated = false; 
            } else{
                $emailValidated = true;
                $codeValidated = false; 
                $_SESSION['code'] = rand(10000,50000);
                $_SESSION['email'] = $_POST['email'];
                forgot_pass();
            }
        
        }
    }

    if(isset($_POST['ver_code'])){
        if (time() - $_SESSION['CREATED'] >= 600) {
            echo '<script>alert("Code expired '.time().' : '.$_SESSION['CREATED'].'")</script>'; 
        }
        else{
            $code = $_POST['ver_code'];
            if($_SESSION['code'] == $code ){
            $codeValidated = $emailValidated = true;
            $passValidated = false; 
            }
            else{
                $emailValidated = true;
                $codeValidated = false; 
                $_SESSION['codeError'] = 'incorrect verification code';
            }
        }
        
    }

    if(isset($_POST['resend'])){
        $_SESSION['code'] = rand(10000,50000); 
        forgot_pass();
    }

    if(isset($_POST["pass"])){
        $pass = $_POST["pass"];
        if(!empty($_POST["pass"]) && ($_POST["pass"] == $_POST["confPass"])) {
            if (strlen($_POST["pass"]) <= 8) {
                $_SESSION['passError']="Your Password Must Contain At Least 8 Characters!";
                $emailValidated = $codeValidated =true;
                $passValidated = false;
            } elseif(!preg_match("#[0-9]+#",$pass)) {
                $_SESSION['passError']="Your Password Must Contain At Least 1 Number!";
                $emailValidated = $codeValidated =true;
                $passValidated = false;
            } elseif(!preg_match("#[A-Z]+#",$pass)) {
                $_SESSION['passError']="Your Password Must Contain At Least 1 Capital Letter!";
                $emailValidated = $codeValidated =true;
                $passValidated = false;
            } elseif(!preg_match("#[a-z]+#",$pass)) {
                $_SESSION['passError']="Your Password Must Contain At Least 1 Lowercase Letter!";
                $emailValidated = $codeValidated =true;
                $passValidated = false;
            } else {
                $encrypted = password_hash($pass, PASSWORD_DEFAULT);
                $emailValidated = $codeValidated = $passValidated = true;
                $passError ="";
            }
        } else {
            $_SESSION['passError']="Password didn't match.";
            $emailValidated = $codeValidated =true;
            $passValidated = false;
        }
    }


    
    //display
    if($emailValidated == false){
        $result = get_email();
    }

    if( $emailValidated == true && $codeValidated == false){
        $result = get_code();
    }

    if($emailValidated == true && $codeValidated == true && $passValidated == false){
        
        $result = get_newPassword();
    }

    if( $passValidated == true){
        $email = $_SESSION['email'];
 
        $update_sql = "UPDATE user_table SET PASSWORD='$encrypted' WHERE EMAIL='$email'";
        if($conn->query($update_sql)) { 
            echo '<script>alert("Password changed successfully.")</script>'; 
            header("location:./login.php");
        } else {
            echo $conn->error;
        }
    }

    function get_email(){
        $disp ="";
        $disp .= '
        <div class="verification container col-xl-4 col-md-6 col-10">
            <h1 class="text-center col-12">Forgot Password</h1>
            <p class="text-center col-12">Please enter your email address.</p>
            <form class="mt-5" method="POST" class="">
                <div class="form-group mb-3">
                    <label for="ver_code">email</label>
                    <input type="email" name="email" class="form-control" required>
                    <div>            
                    <p class="error-meessage"> '.$_SESSION['emailError'].'   </p>     
                    </div>
                </div>
                <button type="submit" class="btn button_1 col-12 mt-3">Submit</button>
            </form>
        </div>
        ';

        return $disp;
    }

    function get_code(){
        $disp ="";
        $disp .= '
        <div class=" verification container col-xl-4 col-md-6 col-10">
            <h1 class="text-center col-12">Reset Password</h1>
            <p class="text-center col-12">We have sent the code on your email. </br>Please enter the code to reset your password.</p>
            <form class="mt-5" method="POST" class="">
                <div class="form-group mb-3">
                    <label for="ver_code">Code</label>
                    <input type="text" name="ver_code" class="form-control" required>
                    <div>
                    <p class="error-meessage"> '.$_SESSION['codeError'].'   </p> 
                    </div>
                </div>
                <button type="submit" class="btn button_1 col-12 mt-3">Confirm</button>
                <button type="submit" class="btn button_2  col-12  mt-3" name="resend">Resend Code</button>

            </form>
        </div>
        ';

        
        return $disp;
    }

    function get_newPassword(){
        $disp ="";
        $disp .='
        <div class=" verification container col-xl-4 col-md-6 col-10">
                <h1 class="text-center col-12">Enter your new password</h1>
                <p class="text-center col-12">We have sent the code on your email. </br>Please enter the code to reset your password.</p>
                <form class="mt-5" method="POST" class="">
                    <div class="form-group mb-3">
                        <label for="pass">Password</label>
                        <input type="password" name="pass" class="form-control" required>
                    </div>
                    <div class="form-group mb-5">
                        <label for="confPass">Confirm Password</label>
                        <input type="password" name="confPass" class="form-control" required>
                        <div>
                        <p class="error-meessage"> '.$_SESSION['passError'].'   </p> 
                        </div>
                    </div>
                    <button type="submit" class="btn button_1 col-12 mt-3">Confirm</button>
                </form>
            </div>
        ';

        return $disp;
    }
   

?>


<?= $result; ?>
</body>
</html>