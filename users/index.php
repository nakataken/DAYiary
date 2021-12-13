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
    
    if(!isset($_SESSION['username'])) {
        header("location:./login.php");
    }

    if(isset($_POST['date'])) {
        $output = "";
        $num = 0;
        $select_sql = "SELECT * FROM diary_table WHERE CREATED_AT='".$_POST['date']."' && USER_ID=".$_SESSION['id'];
        
        if($rs=$conn->query($select_sql)) {
            if($rs->num_rows>0) {
                while($rows=$rs->fetch_assoc()) {
                    $num++;
                    $content = $rows['CONTENT'];
                    $output.='<tr><td>'.$num.'</td><td>'.$rows['CREATED_AT'].'</td><td>'.$content.'</td><td>'.$rows['STATUS'].'</td><td><a class="btn btn-sm btn-primary" href="./editDiary.php?token='.$rows['ID'].'">Edit</a><a class="btn btn-sm btn-danger" href="./deleteDiary.php?token='.$rows['ID'].'">Delete</a></td></tr>';
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
                    $output.='<tr><td>'.$num.'</td><td>'.$rows['CREATED_AT'].'</td><td>'.$content.'</td><td>'.$rows['STATUS'].'</td><td><a class="btn btn-sm btn-primary" href="./editDiary.php?token='.$rows['ID'].'">Edit</a><a class="btn btn-sm btn-danger delete" href="./deleteDiary.php?token='.$rows['ID'].'">Delete</a></td></tr>';
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
            <a href="/DAYiary/users/createDiary.php" class="col-8"><button type="submit" class="btn col-12 mt-3">Write on my Diary</button></a>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="container-md my-5">
        <div class="card p-4">
            <h3 class="card-title m-3">View Diary</h3>
            <form method="POST">
                <label for="date">Filter date</label>
                <input id="datefield" type="date" name="date" class="form-control" max="" onchange="this.form.submit()">
            </form>
            
            <div class="card-body">
                <table class="table">
                    <thead>
                        <th>Entry #</th>
                        <th>Date</th>
                        <th>Content</th>
                        <th>Status</th>
                        <th>Action</th>
                    </thead>
                    <?php echo $output;?>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="../public/currentDate.js"></script>

<?php require_once "./includes/footer.php"; ?>
