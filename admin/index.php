<?php
    session_start();
    require "../config/config.php";
    $title = "Dashboard";
    require_once "./includes/header.php";

    if(isset($_SESSION['adminUsername'])) {
        $check_sql = "SELECT ID FROM admin_table where USERNAME='".$_SESSION['adminUsername']."'";
        if($rs=$conn->query($check_sql)) {
            if($row=$rs->fetch_assoc()) {
                $_SESSION['adminId'] = $row['ID'];
            }
        }

        // Total Users
        $total_user_sql = "SELECT * FROM user_table";
        if($rs=$conn->query($total_user_sql)) {
            $totalUsers = $rs->num_rows;
        }

        // Total Diary Entries
        $total_diary_sql = "SELECT * FROM diary_table";
        if($rs=$conn->query($total_diary_sql)) {
            $totalDiaries = $rs->num_rows;
        }

        // Bar Chart
        $totalDay = [];
        $dayLabel = [];
        for($i=0;$i<7;$i++) {
            $day =$i." days";
            $totalDay[] = getTotalDiary($day);
        }
        for($i=0;$i<7;$i++) {
            $day =$i." days";
            $dayLabel[] = getDay($day);
        }

        // Pie Chart
        $total_status_heart = "SELECT * FROM diary_table WHERE STATUS='Heart'";
        if($rs=$conn->query($total_status_heart)) {
            $totalHeart = $rs->num_rows;
        }
        $total_status_happy = "SELECT * FROM diary_table WHERE STATUS='Happy'";
        if($rs=$conn->query($total_status_happy)) {
            $totalHappy = $rs->num_rows;
        }
        $total_status_sad = "SELECT * FROM diary_table WHERE STATUS='Sad'";
        if($rs=$conn->query($total_status_sad)) {
            $totalSad = $rs->num_rows;
        }
        $total_status_neutral = "SELECT * FROM diary_table WHERE STATUS='Neutral'";
        if($rs=$conn->query($total_status_neutral)) {
            $totalNeutral = $rs->num_rows;
        }

    } else {
        header("location:./login.php");
    }

    function getTotalDiary($num_of_day) {
        require "../config/config.php";

        $date = date_create(date("Y/m/d"));
        if($num_of_day!="0 days") {
            date_sub($date,date_interval_create_from_date_string($num_of_day));
        }

        $total_diary_day = "SELECT * FROM diary_table WHERE CREATED_AT = '".date_format($date,"Y-m-d")."'";

        if($rs=$conn->query($total_diary_day)) {
            $totalDay = $rs->num_rows;
        } else {
            $totalDay = 0;
        }

        return $totalDay;
    }

    function getDay($num_of_day) {
        $date = date_create(date("Y/m/d"));
        if($num_of_day!="0 days") {
            date_sub($date,date_interval_create_from_date_string($num_of_day));
        }
        return date_format($date,"Y-m-d");
    }
?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<h1 class="display-5">DASHBOARD</h1>

<div class="">
    <?php if(isset($totalUsers)) { ?>
        <span>Total Users - <?php echo $totalUsers; ?></span>
    <?php } ?>
    <?php if(isset($totalDiaries)) { ?>
        <span>Total Diary Entries - <?php echo $totalDiaries; ?></span>
    <?php } ?>
</div>

<!-- Line Chart -->
<div class="container">
    <div class="" style="width:1000px; height:500px;">
        <canvas id="lineChart" width="100" height="50"></canvas>
    </div>
</div>

<!-- Script for Line Chart -->
<script>
    let dayLabel = <?php echo json_encode($dayLabel); ?>;
    let totalDay = <?php echo json_encode($totalDay); ?>;

    const lineData = {
        labels: dayLabel.reverse(),
        datasets: [{
            label: "DAILY DIARY ENTRIES IN A WEEK",
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: totalDay.reverse(),
        }]
    };
    const lineConfig = {
        type: 'line',
        data: lineData,
        options: { 
            responsive: true
        }
    };

    const lineChart = new Chart(
        document.getElementById('lineChart'),
        lineConfig
    );
</script>

<?php require_once "./includes/footer.php"; ?>