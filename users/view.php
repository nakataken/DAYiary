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
    $title = "My Diary";
    require_once "./includes/header.php";
    include "display.php";

    $records_per_page =5;
    if (isset ($_GET['page']) ) {  
        $page = $_GET['page'];  
    } else {  
        $page = 1;  
    } 
    $start_from  = ($page-1) * $records_per_page;

    $page_query = "SELECT * FROM dms_diary_table  WHERE USER_ID='".$_SESSION['id']."'";        
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
        $select_sql = "SELECT * FROM dms_diary_table  WHERE CREATED_AT='".$_POST['date']."' && USER_ID='".$_SESSION['id']."'";
        
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
        $view_sql = "SELECT * FROM dms_diary_table  WHERE USER_ID='".$_SESSION['id']."' ORDER BY CREATED_AT DESC LIMIT ".$start_from ." , ".$records_per_page."" ;        
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



<section id="display_sec" class="records-div container-fluid pb-5 px-0 mt-0 ">

    <div class="head-div container py-5 px-0">
        <div class="d-flex flex-row flex-wrap justify-content-start align-items-start py-3 mx-auto col-9">
           <h3 class="">My Diary</h3>
            <form method="POST" class=" col-md-6 col-12 d-flex flex-row justify-content-end ms-auto flex-wrap">
                <input  class="col-8 px-3 text-center" name="date" id="datefield" type="date" max="" placeholder="all">
                <button  class="btn col-3 ms-2" type="submit" name="filter"  onclick="getDatefunction()">Filter</button>
            </form>
        </div>
    </div>
    <?php echo $output;?>
    <div class="page_div col-12 mt-5 d-flex flex-row flex-wrap justify-content-center">
        <?php if($page !=1 ): ?>
            <a class="arrow_next btn " href="/DAYiary/users/view.php?page=<?=$page-1?>"><img src="https://img.icons8.com/material-rounded/24/594EC4/back--v1.png"/></a>
        <?php else:?>
            <a class="arrow_next btn " href="/DAYiary/users/view.php?page=<?=$page?>"><img src="https://img.icons8.com/material-rounded/24/594EC4/back--v1.png"/></a>
        <?php endif;?>
        <div class="d-flex flex-row flex-wrap justify-content-center page_body mx-2">
       

            <?php for($i=0; $i<$total_pages; $i++):?>
                <?php if($page == $i+1){
                    $type_class= "active"; }
                else{
                    $type_class="";
                }
                ?>
                <a class="page p-2 <?=$type_class?> " href="/DAYiary/users/view.php?page=<?=$i+1?>"><?= $i+1 ?></a>
            <?php endfor; ?>
        </div>
        <?php if($page != $total_pages ): ?>
            <a class="arrow_next btn " href="/DAYiary/users/view.php?page=<?=$page+1?>"><img src="https://img.icons8.com/material-rounded/24/594EC4/forward.png"/></a>
        <?php else:?>
            <a class="arrow_next btn " href="/DAYiary/users/view.php?page=<?=$page?>"><img src="https://img.icons8.com/material-rounded/24/594EC4/forward--v1.png"/></a>
        <?php endif; ?>
    </div>
    
</section>
<script>
    function getDatefunction() {
        document.getElementById("datefield").form.submit();
    }
</script>
<script src="../public/currentDate.js"></script>


<?php require_once "./includes/footer.php"; ?>
