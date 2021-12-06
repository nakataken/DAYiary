<?php
    session_start();
    require "../config/config.php";
    $title = "Dashboard";
    require_once "./includes/header.php";

    if(isset($_SESSION['adminEmail'])) {
        $email = $_SESSION['adminEmail'];
        $check_sql = "SELECT id,fname,lname FROM admin_table where email='$email'";
        if($rs=$conn->query($check_sql)) {
            if($row=$rs->fetch_assoc()) {
                $_SESSION['adminId'] = $row['id'];
                $_SESSION['adminFname'] = $row['fname'];
                $_SESSION['adminLname'] = $row['lname'];
            }
        }

        $total_user_sql = "SELECT * FROM user_table";
        if($rs=$conn->query($total_user_sql)) {
            $totalUsers = $rs->num_rows;
        }
        $total_diary_sql = "SELECT * FROM diary_table";
        if($rs=$conn->query($total_diary_sql)) {
            $totalDiaries = $rs->num_rows;
        }

        // Bar Chart
        // $totalDay = [];
        // $dayLabel = [];
        // for($i=0;$i<7;$i++) {
        //     $day =$i." days";
        //     $totalDay[] = getTotalDiary($day);
        // }
        // for($i=0;$i<7;$i++) {
        //     $day =$i." days";
        //     $dayLabel[] = getDay($day);
        // }
        
    } else {
        header("location:./login.php");
    }

    // function getTotalDiary($num_of_day) {
    //     require "../config/config.php";

    //     $date = date_create(date("Y/m/d"));
    //     if($num_of_day!="0 days") {
    //         date_sub($date,date_interval_create_from_date_string($num_of_day));
    //     }

    //     $total_diary_day = "SELECT * FROM diary_table WHERE CREATED_AT = '".date_format($date,"Y-m-d")."'";

    //     if($rs=$conn->query($total_diary_day)) {
    //         $totalDay = $rs->num_rows;
    //     } else {
    //         $totalDay = 0;
    //     }

    //     return $totalDay;
    // }

    // function getDay($num_of_day) {
    //     $date = date_create(date("Y/m/d"));
    //     if($num_of_day!="0 days") {
    //         date_sub($date,date_interval_create_from_date_string($num_of_day));
    //     }
    //     return date_format($date,"Y-m-d");
    // }
?>


<h1>DASHBOARD</h1>
<?php if(isset($totalUsers)) { ?>
    <p>Total Users - <?php echo $totalUsers; ?></p>
<?php } ?>
<?php if(isset($totalDiaries)) { ?>
    <p>Total Diary Entries - <?php echo $totalDiaries; ?></p>
<?php } ?>

<!-- <div>
    <canvas id="diaryEntries"></canvas>
</div> -->

<!-- <script src="../public/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
<?php require_once "./includes/footer.php"; ?>