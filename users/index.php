<?php 
    $title = "Home";
    require_once "./includes/header.php";
    
    if(!isset($_SESSION['email'])) {
        header("location:./login.php");
    }

    $num = 0;
    $output = "";
    $view_sql = "SELECT * FROM diary_table WHERE user_id=".$_SESSION['id'];
    if($rs=$conn->query($view_sql)) {
        if($rs->num_rows>0) {
            while($rows=$rs->fetch_assoc()) {
                $num++;
                // $content = decryptContent($rows['CONTENT']);
                $content = $rows['CONTENT'];
                $output.='<tr><td>'.$num.'</td><td>'.$rows['CREATED_AT'].'</td><td>'.$content.'</td><td>'.$rows['STATUS'].'</td><td></tr>';
            }
        } else {
            $output = '<tr><td class="text-center" colspan="5">No diary found!</td></tr>';
        }
    }
?>

<a href="/DAYiary/users/createDiary.php">Create Diary</a>

<div class="container-md mt-5">
    <div class="card p-4">
        <h3 class="card-title m-3">View Diary</h3>
        <div class="card-body">
            <table class="table">
                <thead>
                    <th>Entry #</th>
                    <th>Date</th>
                    <th>Content</th>
                    <th>Status</th>
                </thead>
                <?php echo $output;?>
            </table>
        </div>
    </div>
<div>

<?php require_once "./includes/footer.php"; ?>
