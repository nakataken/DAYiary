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

    $records_per_page =5;
    if (isset ($_GET['page']) ) {  
        $page = $_GET['page'];  
    } else {  
        $page = 1;  
    } 
    $start_from  = ($page-1) * $records_per_page;

    $page_query = "SELECT * FROM diary_table  WHERE USER_ID='".$_SESSION['id']."'";        
    if($rs=$conn->query($page_query)) {
        $rowcount = mysqli_num_rows($rs);
    }

    $total_pages = ceil($rowcount/$records_per_page);


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
                $output .= noresult();
            }
        }
    } 
    else {
        $num = 0;
        $output = "";
        $view_sql = "SELECT * FROM diary_table  WHERE USER_ID='".$_SESSION['id']."' LIMIT ".$start_from ." , ".$records_per_page."" ;        
        if($rs=$conn->query($view_sql)) {
            if($rs->num_rows>0) {
                while($rows=$rs->fetch_assoc()) {
                    $num++;
                    $content = $rows['CONTENT'];
                    $output.= resultdisplay($rows['CREATED_AT'],$content,$rows['STATUS'],$rows['ID']);
                }
            } else {
                $output .= noentry();
            }
        }
    }
?>

<div class="home-div container-fluid  d-flex flex-lg-row flex-column align-items-center">
    <div class="left-div container col-lg-5 col-md-6  p-0">
        <img src="../public/img/dayiary-01.png" alt="log-illus" class="illus col-12">
    </div>
    <div class="right-div container col-xl-5 col-lg-6 col-12 ms-auto">
        <div class="d-flex flex-column  col-lg-10 col-12 ">
            <h1 class="m-0 text-center">Hello, <?php echo $_SESSION['username']; ?>!</h1>
            <h2 class="text-center m-0">Share something on your diary today</h2>
            <a href="/DAYiary/users/createDiary.php" class="col-md-8 col-12 mt-5 mx-auto"><button type="submit" class="btn col-12 mt-3">WRITE ON MY DIARY</button></a>
        </div>
    </div>
    
</div>

<div class="records-div container-fluid pb-5 px-0 ">
    <div class="p-4"></div>
    <div class="head-div container-fluid ">
        <div class="d-flex flex-row justify-content-between py-3 px-2 mx-auto col-lg-8 ">
            <h3 class="col-6 my-auto">My Diary</h3>
            <form method="POST" class="col-lg-4 col-md-6 col-6 d-flex flex-row flex-wrap gx-5 ms-auto">
                <input  class="col-6 px-3" name="date" id="datefield" type="date" max="" placeholder="all">
                <button  class="btn col-5 ms-2" type="submit" name="filter"  onclick="getDatefunction()">Filter</button>
            </form>
        </div>
    </div>
    <?php echo $output;?>
    <div class="page_div col-12 mt-5 d-flex flex-row flex-wrap justify-content-center">
        <?php if($page !=1 ): ?>
            <a class="arrow_next btn " href="/DAYiary/users/?page=<?=$page-1?>"><img src="https://img.icons8.com/material-rounded/24/594EC4/back--v1.png"/></a>
        <?php else:?>
            <a class="arrow_next btn " href="/DAYiary/users/?page=<?=$page?>"><img src="https://img.icons8.com/material-rounded/24/594EC4/back--v1.png"/></a>
        <?php endif;?>
        <div class="d-flex flex-row flex-wrap justify-content-center page_body mx-2">
       

            <?php for($i=0; $i<$total_pages; $i++):?>
                <?php if($page == $i+1){
                    $type_class= "active"; }
                else{
                    $type_class="";
                }
                ?>
                <a class="page p-2 <?=$type_class?> " href="/DAYiary/users/?page=<?=$i+1?>"><?= $i+1 ?></a>
            <?php endfor; ?>
        </div>
        <?php if($page != $total_pages ): ?>
            <a class="arrow_next btn " href="/DAYiary/users/?page=<?=$page+1?>"><img src="https://img.icons8.com/material-rounded/24/594EC4/forward.png"/></a>
        <?php else:?>
            <a class="arrow_next btn " href="/DAYiary/users/?page=<?=$page?>"><img src="https://img.icons8.com/material-rounded/24/594EC4/forward--v1.png"/></a>
        <?php endif; ?>
    </div>
    
</div>
<script>
    function getDatefunction() {
        document.getElementById("datefield").form.submit();
    }
</script>
<script src="../public/currentDate.js"></script>

<?php require_once "./includes/footer.php"; ?>
