<?php 
    $title = "Create Diary";
    require_once "./includes/header.php";
    
    if(!isset($_SESSION['email'])) {
        header("location:./login.php");
    }

    if(isset($_POST['content'])) {
        $user_id = $_SESSION['id'];
        $content = encryptContent($_POST['content']);
        $status = $_POST['status'];
        
        $check_sql = "SELECT id FROM user_table where id='$user_id'";
        if($rs=$conn->query($check_sql)) {
            if($rs->num_rows!=0) {
                $insert_sql = "INSERT INTO diary_table SET user_id='$user_id',content='$content',status='$status'";
                if(!$conn->query($insert_sql)) {
                    echo '<script>alert("'.$conn->error.'")</script>';
                } else {
                    echo '<script>alert("You have successfully created new entry.")</script>'; 
                }
            }
        }
    }

    function encryptContent($content) {
        $ciphering = "BF-CBC";
        $iv_length = openssl_cipher_iv_length($ciphering);
        $options = 0;
        $encryption_iv = random_bytes($iv_length);
        $encryption_key = openssl_digest(php_uname(), 'MD5', TRUE);
        $encryption = openssl_encrypt($content, $ciphering,$encryption_key, $options, $encryption_iv);
        return $encryption;
    }
    // function decryptContent($content) {
    //     $ciphering = "BF-CBC";
    //     $iv_length = openssl_cipher_iv_length($ciphering);
    //     $options = 0;
    //     $decryption_iv = random_bytes($iv_length);
    //     $decryption_key = openssl_digest(php_uname(), 'MD5', TRUE);
    //     $decryption = openssl_decrypt ($content, $ciphering,$decryption_key, $options, $encryption_iv);
    //     return $decryption;
    // }
?>

<div class="container">
    <div class="card p-4">
        <h3 class="card-title m-3">Create Diary</h3>
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <span>Date:</span>
                    <span id="date"></span>
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Diary Content</label>
                    <textarea name="content" id="content" cols="100" rows="5"></textarea>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status:</label> 
                    <ul>
                        <li><input type="radio" name="status" value="Happy"> Happy</li>
                        <li><input type="radio" name="status" value="Sad"> Sad</li>
                        <li><input type="radio" name="status" value="Neutral"> Neutral</li>
                    </ul>     
                </div>
                <input type="submit" name="submit" value="Submit" class="btn btn-primary">
            </form>
        </div>
    </div>
</div>

<script>
    date =  new Date();
    y = date.getFullYear();
    m = date.getMonth() + 1;
    d = date.getDate();
    document.getElementById("date").innerHTML = m + "/" + d + "/" + y;
</script>

<?php require_once "./includes/footer.php"; ?>