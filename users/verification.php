<?php 

    require_once "./includes/header.php";
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    $userError= '';


    
    function email_ver(){ 
        require 'PHPMailer/Exception.php';
        require 'PHPMailer/PHPMailer.php';
        require 'PHPMailer/SMTP.php';
        $code = $_SESSION['code'];
        $mail = new PHPMailer;
        
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = "smtp.gmail.com";                         // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = "dayiary.noreply@gmail.com";                 // SMTP username
        $mail->Password = 'Dayiary2020';     
        $mail->Port = 465;                       
        $mail->SMTPSecure = 'ssl';                            // Enable encryption, 'ssl' also accepted

        $mail->From = 'dayiary.noreply@gmail.com';
        $mail->FromName = 'Dayiary';
        $mail->addAddress ($_SESSION['user_info'][3]);     // Add a recipient        
      
        $mail->WordWrap = 1000;                                 // Set word wrap to 50 characters
        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = 'Verification Code';
        $mail->Body    = '<p>Please enter this code in the results screen </p><h1>'.$code.'</h1> ';
        $mail->AltBody = 'Please enter this code in the results screen '.$code.'';
        try {
            $mail->send();
           // echo "Message has been sent successfully";
        } catch (Exception $e) {
            //echo "Mailer Error: " . $mail->ErrorInfo;
        }
    }


    if(isset($_POST['ver_code'])){
        $name = $_SESSION['user_info'][0];
        $bdate = $_SESSION['user_info'][1];
        $username = $_SESSION['user_info'][2];
        $email = $_SESSION['user_info'][3];
        $encrypted = $_SESSION['user_info'][4];
      
        $code = $_POST['ver_code'];

        if($_SESSION['code'] == $code ){

            $insert_sql = "INSERT INTO user_table SET NAME='$name', EMAIL='$email',USERNAME='$username',password='$encrypted',birthdate='$bdate'";
            if(!$conn->query($insert_sql)) {
                echo '<script>alert("'.$conn->error.'")</script>';
            } else {
                echo '<script>alert("Registration Successful.")</script>'; 
                $_SESSION['username'] = $username;
                header("location:./index.php");
            }
        }

        else{
            $userError .= 'incorrect verification code';
        }
    }

    if(isset($_POST['resend'])){
        $_SESSION['code'] = rand(10000,50000); 
        email_ver();
        $userError ="";
    }
?>



<div class=" verification container col-xl-4 col-md-6 col-10">
    <h1 class="text-center col-12">Verify Your Email</h1>
    <p class="text-center col-12">We've sent the code on your email. </br>Please enter the code to activate your account.</p>
    <form class="mt-5" method="POST" class="">
        <div class="form-group mb-3">
            <label for="ver_code">Code</label>
            <input type="text" name="ver_code" class="form-control">
            <div>
                <?php if(isset($userError)) {?>
                <p class="text-danger"> <?php echo $userError; ?></p>
                <?php } ?>
            </div>
        </div>
        <button type="submit" class="btn button_1 col-12 mt-3">Confirm</button>
        <button type="submit" class="btn button_2  col-12  mt-3" name="resend">Resend Code</button>

    </form>
</div>