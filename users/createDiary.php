<?php 
    $title = "Create Diary";
    require_once "./includes/header.php";
    
    if(!isset($_SESSION['username'])) {
        header("location:./login.php");
    }

    // Ibahin nalang design, temporary lang yung table
    if(isset($_SESSION['id'])) {
        if(isset($_POST['content'])) {
            $user_id = $_SESSION['id'];
            $content = $_POST['content'];
            $status = $_POST['status'];
            
            $check_sql = "SELECT ID FROM user_table where ID='$user_id'";
            if($rs=$conn->query($check_sql)) {
                if($rs->num_rows!=0) {
                    $insert_sql = "INSERT INTO diary_table SET USER_ID='$user_id',CONTENT='$content',STATUS='$status'";
                    if(!$conn->query($insert_sql)) {
                        echo '<script>alert("'.$conn->error.'")</script>';
                    } else {
                        echo '<script>alert("You have successfully created new entry.")</script>'; 
                    }
                }
            }
        }
    } else {
        header("location:./login.php");
    }
?>

<div class="create-div container-fluid d-flex flex-row align-items-center mt-5">
    <div class="col-12 px-5 mx-auto mt-5">
        
        <div class="bot-div col-lg-8  mx-auto mt-2">
            
            <form  method="POST">
                <div class="d-flex flex-row mb-3 ">
                    <div class="character">
                    </div>
                    <div class="ms-2">
                        <h3 class="my-0"><?php echo $_SESSION['username']; ?></h3>
                        <h2><span id="date"></span></h2>
                    </div>
                </div>
                <div class="mb-3">
                    <textarea class="p-5 col-12" name="content" id="content" cols="100" rows="5" placeholder="Lorem ipsum dolor sit amet, consectetur adipiscing" required></textarea>
                </div>
                <div class="d-flex flex-row  justify-content-between" >
                    <ul class="d-flex flex-row justify-content-center col-md-4 col-sm-6 col-12 p-0">
                        <li class="react-btn btn  col-3 p-0" id="1" onClick="myFunction(this.id)">
                            
                            <label class="col-12 d-flex flex-row align-items-center p-2">
                                <input class="col-12" type="radio" name="status" value="Happy">
                                <img src="../public/img/heart.png" alt="log-illus" class="mx-auto">
                            </label>

                        </li>
                        <li class="react-btn btn col-3 p-0" id="2" onClick="myFunction(this.id)">
                            <label class="col-12 d-flex flex-row align-items-center p-2">
                                <input class="col-12" type="radio" name="status" value="Happy">
                                <img src="../public/img/happy.png" alt="log-illus" class="mx-auto">
                            </label>
                        </li>
                        <li class="react-btn btn col-3 p-0" id="3" onClick="myFunction(this.id)">
                            <label class="col-12 d-flex flex-row align-items-center p-2">
                                <input class="col-12 p-0" type="radio" name="status" value="Sad">
                                <img src="../public/img/sad.png" alt="log-illus" class="mx-auto">
                            </label>
                        </li>
                        <li class="react-btn btn col-3 p-0" id="4" onClick="myFunction(this.id)">
                            <label class="col-12 d-flex flex-row align-items-center p-2">
                                <input class="col-12 btn mx-auto" type="radio" name="status" value="Nuetral">
                                <img src="../public/img/neutral.png" alt="log-illus" class="mx-auto">
                            </label>
                        </li>
                        
                    </ul>     
                    <div class="col-3">
                    <input type="submit" name="submit" value="Submit" class="btn save-btn col-12">

                    </div>
                </div>
                
            </form>
        </div>
    </div>
</div>

<script>

    function myFunction(value){
       
        var element = document.getElementById(value);
        var el = parseInt(value);

        for (let i = 1; i < 5; i++) {
            if(i == parseInt(value)){
                element.classList.add("react_selected");
            }else{
                var val =  document.getElementById(String(i));
                val.classList.remove("react_selected");
            }
        }

    }

    const month = ["January","February","March","April","May","June","July","August","September","October","November","December"];
   
    date =  new Date();
    y = date.getFullYear();
    m = month[date.getMonth()];
    d = date.getDate();
    document.getElementById("date").innerHTML = m + " " + d + ", " + y;
</script>

<?php require_once "./includes/footer.php"; ?>

