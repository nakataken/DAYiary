<?php
    session_start();    
    require "../config/config.php";
    $title = "Users Table";
    require_once "./includes/header.php";

    if(isset($_SESSION['adminUsername'])) {
        // $select_sql_asc = "SELECT USERNAME, NAME, BIRTHDATE FROM user_table ORDER BY ASC";
        // $select_sql_desc = "SELECT USERNAME, NAME, BIRTHDATE FROM user_table ORDER BY DESC";
        $num = 0;
        $output = "";
        $select_sql = "SELECT USERNAME, NAME, BIRTHDATE FROM user_table";

        if($rs=$conn->query($select_sql)) {
            if($rs->num_rows>0) {
                while($rows=$rs->fetch_assoc()) {
                    $num++;
                    $output.='<tr><td>'.$num.'</td><td>'.$rows['USERNAME'].'</td><td>'.$rows['NAME'].'</td><td>'.$rows['BIRTHDATE'].'</td></tr>';
                }
            } else {
                $output = '<tr><td class="text-center" colspan="5">No record found!</td></tr>';
            }
        }

        if(isset($_POST['search'])) {
            $num = 0;
            $output = "";
            $find_sql = "SELECT USERNAME, NAME, BIRTHDATE FROM user_table WHERE USERNAME LIKE '%".$_POST['search']."%'";

            if($rs=$conn->query($find_sql)) {
                if($rs->num_rows>0) {
                    while($rows=$rs->fetch_assoc()) {
                        $num++;
                        $output.='<tr><td>'.$num.'</td><td>'.$rows['USERNAME'].'</td><td>'.$rows['NAME'].'</td><td>'.$rows['BIRTHDATE'].'</td></tr>';
                    }
                } else {
                    $output = '<tr><td class="text-center" colspan="5">No record found!</td></tr>';
                    $_POST['search'] = NULL;
                }
        }
    }
    } else {
        header("location:./login.php");
    }


?>

    <!-- Nireuse ko nalang muna code ko -->
    <div class="container-md mt-5">
        <div class="card p-4">
            <h3 class="card-title m-3">User table</h3>
            <form method="POST">
                <input type="text" name="search" placeholder="Search by Username">
                <button type="submit">Search</button>
            </form>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <th>User #</th>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Birthdate</th>
                    </thead>
                    <?php echo $output;?>
                </table>
            </div>
        </div>
    <div>
<?php require_once "./includes/footer.php"; ?>