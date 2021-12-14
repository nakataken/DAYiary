<script language="JavaScript" type="text/javascript">
    $(document).ready(function(){
        $("a.delete").click(function(e){
            if(!confirm('Are you sure?')){
                e.preventDefault();
                return false;
            }
            return true;
        });
    });
</script>

<?php 
    $title = "Home";
    require_once "./includes/header.php";
    include "display.php";

    if(!isset($_SESSION['username'])) {
        header("location:./login.php");
    }
    if(isset($_POST['filter'])) {
        $output = "";
        $num = 0;
        $create = "";
        $select_sql = "SELECT * FROM diary_table WHERE CREATED_AT='".$_POST['date']."' && USER_ID=".$_SESSION['id'];
        
        if($rs=$conn->query($select_sql)) {
            if($rs->num_rows>0) {
                while($rows=$rs->fetch_assoc()) {
                    $num++;
                    $content = $rows['CONTENT'];
                    $output.= resultdisplay($rows['CREATED_AT'],$content,$rows['STATUS'],$rows['ID']);
                }
            } else { 
                $output = '<tr><td class="text-center" colspan="5">No diary found!</td></tr>';
  
            }
        }
    } else {
        $num = 0;
        $output = "";
        $view_sql = "SELECT * FROM diary_table WHERE USER_ID=".$_SESSION['id'];
        if($rs=$conn->query($view_sql)) {
            if($rs->num_rows>0) {
                while($rows=$rs->fetch_assoc()) {
                    $num++;
                    $content = $rows['CONTENT'];
                    $output.= resultdisplay($rows['CREATED_AT'],$content,$rows['STATUS'],$rows['ID']);
                }
            } else {
                $output = '<tr><td class="text-center" colspan="5">No diary found!</td></tr>';
            }
        }
    }
?>
<div class="home-div container-fluid  d-flex flex-row align-items-center">
    <div class="left-div container col-lg-6 d-lg-block d-none">
        <img src="../public/img/download(1).png" alt="log-illus" class="">
    </div>
    <div class="right-div container col-lg-6 col-8 ">
        <div class="d-flex flex-column  col-xxl-7 col-xl-8 col-lg-10 col-12 mx-auto">
            <h1 class="m-0">Hello, <?php echo $_SESSION['username']; ?>!</h1>
            <h2 class="m-0">have something in mind?</h2>
            <a href="/DAYiary/users/createDiary.php" class="col-md-8 col-12"><button type="submit" class="btn col-12 mt-3">Write on my Diary</button></a>
        </div>
    </div>
</div>

<div class="records-div container-fluid mt-5">
    <div class="head-div container d-flex flex-row justify-content-between py-3 px-4 mx-auto ">
        <h3 class="col-6 my-auto">My Diary</h3>
     
        <form method="POST" class="col-lg-4 col-md-6 col-6 d-flex flex-row flex-wrap gx-5 ms-auto">
            <input  class="col-6 px-3" name="date" id="datefield" type="date" max="" >
            
            <button  class="btn col-5 ms-2" type="submit" name="filter"  onclick="getDatefunction()">Filter</button>

        </form>
       

    </div>
    <?php echo $output;?>
    
</div>
<script>
    function getDatefunction() {
        document.getElementById("datefield").form.submit();
    }
</script>
<script src="../public/currentDate.js"></script>

<?php require_once "./includes/footer.php"; ?>
