<?php
if (!isset($_SESSION['ID'])) {
    header('Location: index.php');
}
?>



<?php include "includes/header.php" ?>



<!-- <form action="index.php?filter=month" method="get">
    <button type=" submit">CLICK</button>
</form>
<a href="./index.php?filter=month">CCCCCCc</a> -->

<!-- Content All Time -->
<div class="row">

    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">All Machine</h6>

            </div>
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="machineBar"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Statistics All Machine</h6>
            </div>
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                    <canvas id="machinePie"></canvas>
                </div>
                <div class="mt-4 text-center small">
                    <span class="mr-2"><i class="fas fa-circle text-primary"></i> เครื่องที่ 1</span>
                    <span class="mr-2"><i class="fas fa-circle text-success"></i> เครื่องที่ 2</span>
                    <span class="mr-2"><i class="fas fa-circle text-info"></i> เครื่องที่ 3</span>
                    <br>
                    <span class="mr-2"><i class="fas fa-circle text-warning"></i> เครื่องที่ 4</span>
                    <span class="mr-2"><i class="fas fa-circle text-danger"></i> เครื่องที่ 5</span>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content m1 -->
<div class="dropdown mb-4">
    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        Filter by <?php echo ucfirst($datos["filter"]); ?>
    </button>
    <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton" style="">
        <a class="dropdown-item" href="./index.php?filter=week">Week</a>
        <a class="dropdown-item" href="./index.php?filter=month">Month</a>
        <a class="dropdown-item" href="./index.php?filter=year">Year</a>
    </div>
</div>
<div class="card mb-4 py-3 border-left-primary">
    <div id='date-info' class="card-body">
        ข้อมูล ณ
    </div>
</div>


<?php

// echo $_SESSION["filter"];
// foreach ($datos["titulo"] as $row) {
//     print_r($row['count']);
// }
// 
// print_r($datos["machineAll"]);
// print_r($datos["dateDuration"]);
// echo $datos["dateDuration"]['month'];
// echo implode('', $datos["dateDuration"]);
// echo implode(', ', $datos["weekCount"]);
?>


<?php for ($i = 1; $i <= 5; $i++) { ?>
<div class="row">

    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">เครื่องที่ <?php echo $i ?></h6>

            </div>
            <div class="card-body">
                <div class="chart-area">
                    <canvas id=<?php echo "machine$i" ?>></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Data</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <!-- Earnings (Monthly) Card Example -->
                <div class="card border-left-primary shadow h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    ระยะเวลาการใช้งาน</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?php echo $datos["machineDuration"][$i - 1]['month'] . " เดือน";
                                        ?>
                                    <?php echo $datos["machineDuration"][$i - 1]['day'] . " วัน";
                                        ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <br>

                <div class="card border-left-success shadow h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    จำนวนการใช้งาน</div>
                                <div id=<?php echo "machineUse$i" ?> class="h5 mb-0 font-weight-bold text-gray-800">

                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>

<?php   } ?>






<script src="public/js/chart/chart-bar.js"></script>
<script src="public/js/chart/chart-pie.js"></script>
<script src="public/js/chart/chart-area.js"></script>


<!-- main function -->
<script>
function getCurrentWeekDays() {
    const today = new Date();
    const startDate = new Date(today);
    startDate.setDate(today.getDate() - today.getDay());
    const weekDays = [];
    for (let i = 0; i < 7; i++) {
        const currentDate = new Date(startDate);
        currentDate.setDate(startDate.getDate() + i);
        weekDays.push(currentDate.getDate() + "");
    }
    return weekDays;
}

function getCurrentMonthDays() {
    const today = new Date();
    const firstDayOfMonth = new Date(today.getFullYear(), today.getMonth(), 1); // Set to the first day of the month
    const numDaysInMonth = 32 - new Date(today.getFullYear(), today.getMonth(), 32)
        .getDate(); // Calculate the number of days in the month

    const monthDays = [];
    for (let i = 0; i < numDaysInMonth; i++) {
        const currentDate = new Date(firstDayOfMonth);
        currentDate.setDate(firstDayOfMonth.getDate() + i);
        monthDays.push(currentDate.getDate() + "");
    }

    return monthDays;
}
</script>

<script>
function diffAssign(mDay, mData, weekDay) {
    const obj = {}
    mDay.forEach((element, index) => {
        obj[`${element}`] = mData[index];
    });
    let weekData = []
    weekDay.forEach((element, index) => {
        if (obj[element]) {
            weekData.push(parseInt(obj[element]));
        } else {
            weekData.push(0);
        }
    });
    return weekData;
}

function sum(array) {
    let num = 0;
    array.forEach((n) => {
        num += parseInt(n)
    })
    return num
}

function getCurrentDateInfo() {
    const today = new Date();
    const year = today.getFullYear();
    const month = today.getMonth() + 1; // Add 1 to get 1-based month
    const day = today.getDate();
    return {
        year: year,
        month: month,
        day: day
    };
}

const labels = '<?php echo implode(",", $datos['machineAll'][0]); ?>'.split(',')
const data = '<?php echo implode(",", $datos['machineAll'][1]); ?>'.split(',')

generateBarChart({
    elementId: "machineBar",
    labels: ["เครื่องที่ 1", "เครื่องที่ 2", "เครื่องที่ 3", "เครื่องที่ 4", "เครื่องที่ 5"],
    data: data
})
generatePieChart({
    elementId: "machinePie",
    labels: ["เครื่องที่ 1", "เครื่องที่ 2", "เครื่องที่ 3", "เครื่องที่ 4", "เครื่องที่ 5"],
    data: data
})

let dateInfo = document.querySelector('#date-info')
let currentDate = getCurrentDateInfo()
</script>


<?php if (strtolower($datos['filter']) == "year") { ?>

<script>
const machine = JSON.parse('<?php echo $datos['machine']; ?>');
let month = []
for (let i = 1; i <= 12; i++) {
    month.push(i);
}
machine.forEach((data, index) => {
    const machineData = diffAssign(data[0], data[1], month);
    const assignMachineUse = document.querySelector(`#machineUse${index+1}`)
    assignMachineUse.textContent = `${sum(data[1])} ครั้ง`

    generateAreaChart({
        elementId: `machine${index+1}`,
        labels: month.map((month) => `เดือนที่ ${month >= 10 ? month: '0' + month}`),
        data: machineData
    })
})
dateInfo = document.querySelector('#date-info')
currentDate = getCurrentDateInfo()
dateInfo.textContent +=
    `  ${1}/${month[0]}/${currentDate.year} - ${31}/${month[month.length-1]}/${currentDate.year}`
</script>

<?php    } else if (strtolower($datos['filter']) == "month") { ?>

<script>
const machine = JSON.parse('<?php echo $datos['machine']; ?>');
const monthDay = getCurrentMonthDays();
machine.forEach((data, index) => {
    const machineData = diffAssign(data[0], data[1], monthDay);
    const assignMachineUse = document.querySelector(`#machineUse${index+1}`)
    assignMachineUse.textContent = `${sum(data[1])} ครั้ง`

    generateAreaChart({
        elementId: `machine${index+1}`,
        labels: monthDay.map((day) => `วันที่ ${day >= 10 ? day: '0'+day}`),
        data: machineData
    })
})
dateInfo = document.querySelector('#date-info')
currentDate = getCurrentDateInfo()
dateInfo.textContent +=
    `  ${monthDay[0]}/${currentDate.month}/${currentDate.year} - ${monthDay[monthDay.length-1]}/${currentDate.month}/${currentDate.year}`
</script>

<?php   } else { ?>

<script>
const machine = JSON.parse('<?php echo $datos['machine']; ?>');
const weekDay = getCurrentWeekDays();
machine.forEach((data, index) => {
    const machineData = diffAssign(data[0], data[1], weekDay);
    const assignMachineUse = document.querySelector(`#machineUse${index+1}`)
    assignMachineUse.textContent = `${sum(data[1])} ครั้ง`

    generateAreaChart({
        elementId: `machine${index+1}`,
        labels: weekDay.map((day) => `วันที่ ${day >= 10 ? day: '0'+day}`),
        data: machineData
    })
})
dateInfo = document.querySelector('#date-info')
currentDate = getCurrentDateInfo()
dateInfo.textContent +=
    `  ${weekDay[0]}/${currentDate.month}/${currentDate.year} - ${weekDay[weekDay.length-1]}/${currentDate.month}/${currentDate.year}`
</script>
<?php   } ?>



<?php include "includes/footer.php" ?>