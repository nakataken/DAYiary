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
            $select_sql = "SELECT * FROM diary_table WHERE ID=".$_GET['token'];
            if($rs=$conn->query($select_sql)) {
                if($row=$rs->fetch_assoc()) {
                    $createdAt = $row['CREATED_AT'];
                    $content = $row['CONTENT'];
                    $status = $row['STATUS'];
                }
            }
        }

        if(isset($_POST['content'])) {
            $update_sql = 'UPDATE diary_table SET CONTENT="'.$_POST['content'].'", STATUS="'.$_POST['status'].'", MODIFIED_AT="'.$date.'" WHERE ID='.$_GET['token'];
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

<div class="container">
    <div class="card p-4">
        <h3 class="card-title m-3">Edit Diary</h3>
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <span>Date:</span>
                    <span><?php echo $createdAt; ?></span>
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Diary Content</label>
                    <textarea name="content" id="content" cols="100" rows="5" required><?php echo $content; ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status:</label> 
                    <ul>
                        <?php if($status=="Heart") { ?>
                            <li><input type="radio" name="status" value="Heart" checked required> Heart</li>
                            <li><input type="radio" name="status" value="Happy"> Happy</li>
                            <li><input type="radio" name="status" value="Sad"> Sad</li>
                            <li><input type="radio" name="status" value="Neutral"> Neutral</li>
                        <?php } else if($status=="Happy") { ?>
                            <li><input type="radio" name="status" value="Heart" required> Heart</li>
                            <li><input type="radio" name="status" value="Happy" checked> Happy</li>
                            <li><input type="radio" name="status" value="Sad"> Sad</li>
                            <li><input type="radio" name="status" value="Neutral"> Neutral</li>
                        <?php } else if($status=="Sad") { ?>
                            <li><input type="radio" name="status" value="Heart" required> Heart</li>
                            <li><input type="radio" name="status" value="Happy"> Happy</li>
                            <li><input type="radio" name="status" value="Sad" checked> Sad</li>
                            <li><input type="radio" name="status" value="Neutral" > Neutral</li>
                        <?php } else { ?>
                            <li><input type="radio" name="status" value="Heart" required> Heart</li>
                            <li><input type="radio" name="status" value="Happy"> Happy</li>
                            <li><input type="radio" name="status" value="Sad"> Sad</li>
                            <li><input type="radio" name="status" value="Neutral" checked> Neutral</li>
                        <?php } ?>
                    </ul>     
                </div>
                <input type="submit" name="submit" value="Submit" class="btn btn-primary">
            </form>
        </div>
    </div>
</div>

<?php require_once "./includes/footer.php"; ?> 