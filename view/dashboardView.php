<?php 
     if(!isset($_SESSION['ID'])){
        header('Location: index.php');
     }
?>



<?php include "includes/header.php" ?>




<!-- Content All Time -->

<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Statistics Machine</h6>
                
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Pie Chart -->
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Statistics All Machine</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                    <canvas id="myPieChart"></canvas>
                </div>
                <div class="mt-4 text-center small">
                    <span class="mr-2">
                        <i class="fas fa-circle text-primary"></i> เครื่องที่ 1
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-success"></i> เครื่องที่ 2
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-info"></i> เครื่องที่ 3
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Content m1 -->
    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Machine1</h6>
                    
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="chartM1"></canvas>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
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
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">1 เดือน 25 วัน</div>
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
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">50 ครั้ง</div>
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


<!-- Page level custom scripts -->
<script src="public/js/demo/chart-area-demo-control.js"></script>
<script src="public/js/demo/chart-pie-demo-control.js"></script>
<script>
    let machine = [{id:1}]
    initChartArea(JSON.stringify(machine));
</script>




<?php include "includes/footer.php" ?>


