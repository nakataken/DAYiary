<?php
    session_start();
    require "../config/config.php";
    $title = "Dashboard";
    require_once "./includes/header.php";
    
    if(isset($_SESSION['adminUsername'])) {
        $check_sql = "SELECT ID FROM dms_admin_table where USERNAME='".$_SESSION['adminUsername']."'";
        if($rs=$conn->query($check_sql)) {
            if($row=$rs->fetch_assoc()) {
                $_SESSION['adminId'] = $row['ID'];
            }
        }

        // Total Users
        $total_user_sql = "SELECT * FROM dms_user_table";
        if($rs=$conn->query($total_user_sql)) {
            $totalUsers = $rs->num_rows;
        }

        // Total Diary Entries
        $total_diary_sql = "SELECT * FROM dms_diary_table";
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

        if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['generate'])) {
            $_SESSION['totalUsers'] = $totalUsers;
            $_SESSION['totalDiaries'] = $totalDiaries;
            $_SESSION['totalDay'] = $totalDay;
            $_SESSION['dayLabel'] = $dayLabel;
            header("location:./report/generate.php");
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

        $total_diary_day = "SELECT * FROM dms_diary_table WHERE CREATED_AT = '".date_format($date,"Y-m-d")."'";

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

<div class="admin container-fluid mb-5 ">
    <div class="admin-1 container mx-auto row mt-5">
        <h1 class=" col-12">DASHBOARD</h1>
        <?php if(isset($totalUsers)) { ?>
            <div class="col-md-6  p-2">
                <div class="acard py-5 col-12">
                    <h2 class="text-center"><?php echo $totalUsers;?></h2>
                    <p  class="text-center" >Total Users</p>
                </div>
            </div>
        <?php } ?>
        <?php if(isset($totalDiaries)) { ?>
            <div class="col-md-6  p-2">
                <div class="acard py-5 col-12">
                    <h2 class="text-center"><?php echo $totalDiaries;?></h2>
                    <p  class="text-center" >Total Diary Entries</p>
                </div>
            </div>
        <?php } ?>
    
    </div>

    <!-- Line Chart -->
    <div class="container my-5">
        <div class="col-lg-10 col-12 mx-auto">
            <canvas id="lineChart" width="100" height="50"></canvas>
        </div>
    </div>
    <!-- Generate Report -->
    <div class="admin-1 container mx-auto row mt-5">
        <div class="col-md-6 p-2">
            <div class="acard py-5 col-12">
                <form method="POST">
                    <input type="submit" name="generate" value="Generate Report">
                </form>
                <!-- <a href="/DAYiary/admin/report/generate.php" class="text-center">Generate Report</a> -->
            </div>
        </div>
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