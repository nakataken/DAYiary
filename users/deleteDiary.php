<?php
    $title = "Delete";
    require_once "./includes/header.php";

    // Delete record
    if(isset($_SESSION['id'])) {
        if(isset($_GET['token'])) {
            $id=$_GET['token'];
            $delete_sql = "DELETE FROM diary_table WHERE ID=".$id;
            if($conn->query($delete_sql)) {
                header("location:./index.php");
            } else {
                echo $conn->error;
            }
        } else {
            header("location:./index.php");
        }
    } else {
        header("location:./login.php");
    }
?>

<!-- INSERT CONFIRMATION -->

<?php require_once "./includes/footer.php"; ?> 