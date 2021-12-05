<?php 
    $title = "Home";
    require_once "./includes/header.php";
    
    if(!isset($_SESSION['email'])) {
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
        $view_sql = "SELECT * FROM diary_table WHERE user_id=".$_SESSION['id'];
        if($rs=$conn->query($view_sql)) {
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
    }
?>

<a href="/DAYiary/users/createDiary.php">Create Diary</a>

<div class="container-md mt-5">
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
<div>

<script>
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; 
    var yyyy = today.getFullYear();

    if (dd < 10)
        dd = '0' + dd;

    if (mm < 10) 
        mm = '0' + mm;
        
    today = yyyy + '-' + mm + '-' + dd;
    document.getElementById("datefield").setAttribute("max", today);
</script>

<?php require_once "./includes/footer.php"; ?>
