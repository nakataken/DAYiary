<?php
    $title = "Edit";
    require_once "./includes/header.php";

    $date = date('Y-m-d');
    $createdAt;
    $content = "";
    $status = "";
    if(isset($_SESSION['id'])) {
        if(!isset($_GET['token'])) {
            header("location:./index.php");
        } else {
            $select_sql = "SELECT * FROM dms_diary_table WHERE ID=".$_GET['token'];
            if($rs=$conn->query($select_sql)) {
                if($row=$rs->fetch_assoc()) {
                    $createdAt = $row['CREATED_AT'];
                    $content = $row['CONTENT'];
                    $status = $row['STATUS'];
                    $dateholder = strtotime($createdAt);
                    $dateformat =date('F j, Y ', $dateholder);
                }
            }
        }

        if(isset($_POST['content'])) {
            $update_sql = 'UPDATE dms_diary_table SET CONTENT="'.$_POST['content'].'", STATUS="'.$_POST['status'].'", MODIFIED_AT="'.$date.'" WHERE ID='.$_GET['token'];
            if($conn->query($update_sql)) {
                header("location:./index.php");
            } else {
                echo $conn->error;
            }
        }
    } else {
        header("location:./login.php");
    }
?>

<div class="create-div container-fluid d-flex flex-row align-items-center ">
    <div class="col-12 px-5 mx-auto">
        <div class="bot-div col-lg-8 col-12 mx-auto">
            
            <form  method="POST">
                <div class="d-flex flex-row mb-3 ">
                    <div class="character">
                    </div>
                    <div class="ms-2">
                        <h3 class="my-0"><?php echo $_SESSION['username']; ?></h3>
                        <h2><span id="date"><?php echo $dateformat; ?></span></h2>
                    </div>
                </div>

                <div class="mb-3">
                    <textarea class="p-sm-4 p-3 col-12" name="content" id="content" cols="100" rows="5" placeholder="" required><?php echo $content; ?></textarea>
                </div>
                <div class="d-flex flex-row flex-wrap justify-content-between" >
                    <ul class="d-flex flex-row justify-content-center col-md-4 col-sm-6 col-12 p-0">
                        <li class="<?=$status?>1 react-btn btn  col-3 p-0" id="1" onclick="myFunction(this.id)">
                            <label class=" col-12 d-flex flex-row align-items-center">
                                <div class="dum"></div>
                                <input class="col-12" type="radio" name="status" value="Heart">
                                <img src="../public/img/heart.png" alt="log-illus" class="mx-auto">
                                
                            </label>
                        </li>
                        <li class="<?=$status?>2 react-btn btn col-3 p-0" id="2" onclick="myFunction(this.id)">
                            <label class="  col-12 d-flex flex-row align-items-center">
                                <input class="col-12" type="radio" name="status" value="Happy">
                                <img src="../public/img/happy.png" alt="log-illus" class="mx-auto">
                            </label>
                        </li>
                        <li class="<?=$status?>3 react-btn btn col-3 p-0" id="3" onclick="myFunction(this.id)">
                            <label class="col-12 d-flex flex-row align-items-center">
                                <input class="col-12 p-0" type="radio" name="status" value="Sad">
                                <img src="../public/img/sad.png" alt="log-illus" class="mx-auto">
                            </label>
                        </li>
                        <li class="<?=$status?>4 react-btn btn col-3 p-0" id="4" onclick="myFunction(this.id)">
                            <label class="col-12 d-flex flex-row align-items-center">
                                <input class="col-12 btn mx-auto" type="radio" name="status" value="Neutral">
                                <img src="../public/img/neutral.png" alt="log-illus" class="mx-auto">
                            </label>
                        </li>
                        
                    </ul>     
                    <div class="col-sm-3 col-12">
                    <input type="submit" name="submit" value="Save" class="btn save-btn col-12">

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
                val.classList.remove("Heart1");
                val.classList.remove("Happy2");
                val.classList.remove("Sad3");
                val.classList.remove("Neutral4");
            }
        }

    }
</script>
<?php require_once "./includes/footer.php"; ?> 