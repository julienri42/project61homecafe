<?php
session_start();
include('../../assets/connect/conn.php');
$_SESSION['page'] = "Dashboard.php";
function DateThai($strDate)
{
    $strYear = date("Y", strtotime($strDate)) + 543;
    $strMonth = date("n", strtotime($strDate));
    $strDay = date("j", strtotime($strDate));
    $strSeconds = date("s", strtotime($strDate));


    $strMonthCut = array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
    $strMonthThai = $strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear";
}
$strMonthCut = array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
$month = date("Y-m", time());
$month2= date("n", time());
$year= date("Y", time());
$time = date("Y-m-d", time());
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../../assets/img/logoicon.ico">
    <title>
        Dashboard
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="../assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
    <link href="../../assets/css/admin_home.css" rel="stylesheet">
    <link href="../../assets/css/body1.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <link href="../../assets/css/employee.css" rel="stylesheet">
    <link href="../../assets/css/report.css" rel="stylesheet">


</head>

<body class="g-sidenav-show">
    <?php
    include("../aside_folder.php");
    ?>
    <main class="main-content position-relative border-radius-lg ">
        <?php
        include("../nav_folder.php");
        ?>
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <div class='row'>
                                <h2 class='col-6'>Dashboard</h2>


                            </div>



                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <!-- เนื้อหา -->

                            <?php
                            echo "<hr class='bg-dark'>";
                            ?>
                            <center>
                                <h4 class='m-3'>รายวัน (<?php echo DateThai($time); ?>)</h4>

                                <div class='row p-2'>

                                    <div class="col-xl-3 col-md-6 mb-4">
                                        <div class="card border-left-primary shadow h-100">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="font-weight-bold text-primary text-uppercase mb-1">
                                                            ยอดขายวันนี้ 
                                                        </div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                            <?php
                                                            $sql = "SELECT 	sum(order_total-order_discount) FROM tb_order
                                                            WHERE order_date_added LIKE '$time %'";
                                                            $result = mysqli_query($connect, $sql);
                                                            if (mysqli_num_rows($result) > 0) {

                                                                list($order) = mysqli_fetch_row($result);
                                                                if (empty($order)) {
                                                                    $order = 0;
                                                                }
                                                            } else {
                                                                $order = 0;
                                                            }
                                                            echo $order . " บาท";
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fa-clipboard-list fa-3x text-gray-500"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- -->

                                    <div class="col-xl-3 col-md-6 mb-4">
                                        <div class="card border-left-primary shadow h-100">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="font-weight-bold text-primary text-uppercase mb-1">
                                                            สั่งซื้อวันนี้
                                                        </div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                            <?php
                                                            $sql = "SELECT count(order_id) FROM tb_order WHERE order_date_added LIKE '$time%'";
                                                            $result = mysqli_query($connect, $sql);
                                                            if (mysqli_num_rows($result) > 0) {
                                                                list($ordernum) = mysqli_fetch_row($result);
                                                            } else {
                                                                $ordernum = 0;
                                                            }
                                                            echo $ordernum . " ครั้ง";
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fa-clipboard-list fa-3x text-gray-500"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-md-6 mb-4">
                                        <div class="card border-left-primary shadow h-100">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="font-weight-bold text-primary text-uppercase mb-1">
                                                            ค่าใช้จ่าย
                                                        </div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                            <?php
                                                            $sql = "SELECT 	sum(product_stock_price) FROM tb_product_stock_list
                                                            WHERE product_stock_date_added LIKE '$time %'";
                                                            $result = mysqli_query($connect, $sql);
                                                            if (mysqli_num_rows($result) > 0) {

                                                                list($ordernum) = mysqli_fetch_row($result);
                                                                if (empty($ordernum)) {
                                                                    $ordernum = 0;
                                                                }
                                                            } else {
                                                                $ordernum = 0;
                                                            }

                                                            $sql = "SELECT 	sum(material_stock_price) FROM tb_material_stock_list
                                                            WHERE material_stock_date_added	LIKE '$time %'";
                                                            $result = mysqli_query($connect, $sql);
                                                            if (mysqli_num_rows($result) > 0) {

                                                                list($materialnum) = mysqli_fetch_row($result);
                                                                if (empty($materialnum)) {
                                                                    $materialnum = 0;
                                                                }
                                                            } else {
                                                                $materialnum = 0;
                                                            }
                                                            $ordernum += $materialnum;
                                                            echo $ordernum . " บาท";
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fa-clipboard-list fa-3x text-gray-500"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-md-6 mb-4">
                                        <div class="card border-left-primary shadow h-100">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="font-weight-bold text-primary text-uppercase mb-1">
                                                            กำไร
                                                        </div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                            <?php
                                                            $numprofit = $order - $ordernum;
                                                            echo $numprofit . " บาท";
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fa-clipboard-list fa-3x text-gray-500"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <h4 class='m-3'>รายเดือน (<?php echo $strMonthCut[$month2]." ".$year; ?>)</h4>
                                <div class='row p-2'>
                                    <div class="col-xl-3 col-md-6 mb-4">
                                        <div class="card border-left-primary shadow h-100">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="font-weight-bold text-primary text-uppercase mb-1">
                                                            ยอดขายรายเดือน
                                                        </div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                            <?php
                                                            $sql = "SELECT 	sum(order_total-order_discount) FROM tb_order
                                                        WHERE order_date_added>='$month-1' AND order_date_added<='$month-31 23:59:00'";
                                                            $result = mysqli_query($connect, $sql);
                                                            if (mysqli_num_rows($result) > 0) {
                                                                list($ordermon) = mysqli_fetch_row($result);
                                                                if (empty($ordermon)) {
                                                                    $ordermon = 0;
                                                                }
                                                            } else {
                                                                $ordermon = 0;
                                                            }
                                                            echo $ordermon . " บาท";
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fa-clipboard-list fa-3x text-gray-500"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-md-6 mb-4">
                                        <div class="card border-left-primary shadow h-100">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="font-weight-bold text-primary text-uppercase mb-1">
                                                            สั่งซื้อรายเดือน
                                                        </div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                            <?php
                                                            $sql = "SELECT count(order_id) FROM tb_order WHERE order_date_added>='$month-1' AND order_date_added<='$month-31 23:59:00'";
                                                            $result = mysqli_query($connect, $sql);
                                                            if (mysqli_num_rows($result) > 0) {
                                                                list($ordernum) = mysqli_fetch_row($result);
                                                            } else {
                                                                $ordernum = 0;
                                                            }
                                                            echo $ordernum . " ครั้ง";
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fa-clipboard-list fa-3x text-gray-500"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-md-6 mb-4">
                                        <div class="card border-left-primary shadow h-100">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="font-weight-bold text-primary text-uppercase mb-1">
                                                            ค่าใช้จ่าย
                                                        </div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                            <?php
                                                            $sql = "SELECT 	sum(product_stock_price) FROM tb_product_stock_list
                                                            WHERE  product_stock_date_added>='$month-1' AND product_stock_date_added<='$month-31 23:59:00'";
                                                            $result = mysqli_query($connect, $sql);
                                                            if (mysqli_num_rows($result) > 0) {

                                                                list($ordernum) = mysqli_fetch_row($result);
                                                                if (empty($ordernum)) {
                                                                    $ordernum = 0;
                                                                }
                                                            } else {
                                                                $ordernum = 0;
                                                            }

                                                            $sql = "SELECT 	sum(material_stock_price) FROM tb_material_stock_list
                                                            WHERE material_stock_date_added>='$month-1' AND material_stock_date_added<='$month-31 23:59:00'";
                                                            $result = mysqli_query($connect, $sql);
                                                            if (mysqli_num_rows($result) > 0) {

                                                                list($materialnum) = mysqli_fetch_row($result);
                                                                if (empty($materialnum)) {
                                                                    $materialnum = 0;
                                                                }
                                                            } else {
                                                                $materialnum = 0;
                                                            }
                                                            $ordernum += $materialnum;
                                                            echo $ordernum . " บาท";
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fa-clipboard-list fa-3x text-gray-500"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-md-6 mb-4">
                                        <div class="card border-left-primary shadow h-100">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="font-weight-bold text-primary text-uppercase mb-1">
                                                            กำไร
                                                        </div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                            <?php
                                                            $numprofit = $ordermon - $ordernum;
                                                            echo $numprofit . " บาท";
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fa-clipboard-list fa-3x text-gray-500"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class="col-lg-12 mb-lg-0 mb-4">
                                        <div class="card z-index-2 shadow m-3">
                                            <div class="card-header pb-0 pt-3 bg-transparent">
                                                <h6 class="text-capitalize">รายรับ - รายจ่าย แบบรายเดือน</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="chart ">
                                                    <?php

                                                    $sql = "SELECT MONTH(order_date_added) as mon,year(order_date_added) as year ,sum(order_total-order_discount) as sumprice  FROM tb_order GROUP BY MONTH(order_date_added) ,YEAR(order_date_added) ORDER BY MONTH(order_date_added),YEAR(order_date_added) ASC ";
                                                    $result = mysqli_query($connect, $sql);
                                                    if (mysqli_num_rows($result) > 0) {
                                                        while ($row = $result->fetch_array()) {
                                                            $strMonthThai = $strMonthCut[$row['mon']];
                                                            $mon=$row['mon'];
                                                            $year=$row['year'];
                                                            
                                                            ////
                                                            $sql2 = "SELECT MONTH(product_stock_date_added) as mon,YEAR(product_stock_date_added) as year ,sum(product_stock_price) as sumprice  FROM tb_product_stock_list  WHERE  product_stock_date_added>='$year-$mon-1' AND product_stock_date_added<='$year-$mon-31 23:59:00' ";
                                                            $result2 = mysqli_query($connect, $sql2);
                                                            if (mysqli_num_rows($result2) > 0) {
                                                                while ($row2 = $result2->fetch_array()) {
                                                                   
                                                                    $strMonthThai = $strMonthCut[$row['mon']];
                                                                    $sumprice=$row2['sumprice'];
        
                                                                    $sqlqq="SELECT sum(material_stock_price) as materialprice  FROM tb_material_stock_list 
                                                                    WHERE  material_stock_date_added>='$year-$mon-1' AND material_stock_date_added<='$year-$mon-31 23:59:00'";
                                                                    $resultqq = mysqli_query($connect, $sqlqq);
                                                                    if (mysqli_num_rows($resultqq) > 0) {
                                                                        while ($row3 = $resultqq->fetch_array()) {
                                                                            $materialprice=$row3['materialprice'];
                                                                        }
                                                                    }
                                                                    else
                                                                    {
                                                                        $materialprice=0;
                                                                    }
                                                                    $sumprice+=$materialprice;
                                                                    
                                                                    
                                                                }
                                                            }
                                                            $profit= (float)$row['sumprice'];
                                                            
                                                            $loss=(float)$sumprice;
                                                            
                                                            $summ=$profit-$loss;
                                                          
                                                            $dataPoints3[] = array("y" =>  (float)$row['sumprice'], "label" => $strMonthThai ,"summ"=> "$summ");
                                                            ////

                                                        }
                                                    }
                                                    $sql = "SELECT MONTH(product_stock_date_added) as mon,YEAR(product_stock_date_added) as year ,sum(product_stock_price) as sumprice  FROM tb_product_stock_list GROUP BY MONTH(product_stock_date_added) ,YEAR(product_stock_date_added) ORDER BY MONTH(product_stock_date_added) ,YEAR(product_stock_date_added) ASC ";
                                                    $result = mysqli_query($connect, $sql);
                                                    if (mysqli_num_rows($result) > 0) {
                                                        while ($row = $result->fetch_array()) {
                                                            $mon=$row['mon'];
                                                            $year=$row['year'];
                                                            $strMonthThai = $strMonthCut[$row['mon']];
                                                            $sumprice=$row['sumprice'];

                                                            $sqlqq="SELECT sum(material_stock_price) as materialprice  FROM tb_material_stock_list 
                                                            WHERE  material_stock_date_added>='$year-$mon-1' AND material_stock_date_added<='$year-$mon-31 23:59:00'";
                                                            $resultqq = mysqli_query($connect, $sqlqq);
                                                            if (mysqli_num_rows($resultqq) > 0) {
                                                                while ($row2 = $resultqq->fetch_array()) {
                                                                    $materialprice=$row2['materialprice'];
                                                                }
                                                            }
                                                            else
                                                            {
                                                                $materialprice=0;
                                                            }
                                                            $sumprice+=$materialprice;
                                                            $dataPoints4[] = array("y" => (float)$sumprice, "label" => $strMonthThai);
                                                            
                                                        }
                                                    }

                                                    
                                                    ?>
                                                  
                                                    <div id="chartContainer3" style="height: 370px; width: 100%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class="col-lg-12 mb-lg-0 mb-4">
                                        <div class="card z-index-2 shadow m-3">
                                            <div class="card-header pb-0 pt-3 bg-transparent">
                                                <h6 class="text-capitalize">สินค้าขายดี (<?php echo $strMonthCut[$month2]." ".$year; ?>)</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="chart ">
                                                    <?php
                                                    $sql = "SELECT product_name,sum(orderdetail_quantity) as ranker FROM tb_orderdetail as d
                                                     INNER JOIN tb_product_list as b  ON b.product_id=d.product_id
                                                     GROUP BY d.product_id ORDER BY ranker DESC  LIMIT 10";
                                                    $result = mysqli_query($connect, $sql);
                                                    if (mysqli_num_rows($result) > 0) {
                                                        while ($row = $result->fetch_array()) {
                                                            $data[] = array("y" => $row['ranker'], "label" => $row['product_name']);
                                                        }
                                                    }
                                                    $dataPoints = $data;
                                                    ?>
                                                    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                                                    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mb-lg-0 mb-4">
                                        <div class="card z-index-2 shadow m-3">
                                            <div class="card-header pb-0 pt-3 bg-transparent">
                                                <h6 class="text-capitalize">ลูกค้าที่สั่งซื้อสินค้า (<?php echo $strMonthCut[$month2]." ".$year; ?>)</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="chart ">
                                                    <?php
                                                    $sql = "SELECT user_img,user_firstname,user_surname,count(order_id) as sumorder FROM tb_order as o
                                                    INNER JOIN tb_user as u ON o.user_id=u.user_id
                                                    GROUP BY o.user_id ORDER BY sumorder DESC";
                                                    $result = $connect->query($sql);
                                                    if (mysqli_num_rows($result) > 0) {
                                                        while ($row = $result->fetch_array()) {
                                                            $dataPoints2[] = array("label" => $row['user_firstname'], "y" => $row['sumorder']);
                                                        }
                                                    }


                                                    ?>
                                                    <div id="chartContainer1" style="height: 370px; width: 100%;"></div>
                                                    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>


                        </center>

                    </div>
                </div>
            </div>

        </div>

        </div>
    </main>

    <!--   Core JS Files   -->
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/chartjs.min.js"></script>

    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/argon-dashboard.min.js?v=2.0.4"></script>



    <!-- Bootstrap core JavaScript-->
    <script src="../../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../assets/js/sb-admin-2.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script>
        // เพิ่มส่วนนี้เข้าไปจะถือว่าเป็นการตั้งค่าให้ Datatable เป็น Default ใหม่เลย
        $.extend(true, $.fn.dataTable.defaults, {
            "language": {
                "sProcessing": "กำลังดำเนินการ...",
                "sLengthMenu": "แสดง _MENU_  แถว",
                "sZeroRecords": "ไม่พบข้อมูล",
                "sInfo": "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
                "sInfoEmpty": "แสดง 0 ถึง 0 จาก 0 แถว",
                "sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
                "sInfoPostFix": "",
                "sSearch": "ค้นหา:",
                "sUrl": "",
                "oPaginate": {
                    "sFirst": "เริ่มต้น",
                    "sPrevious": "ก่อนหน้า",
                    "sNext": "ถัดไป",
                    "sLast": "สุดท้าย"
                }
            }
        });
        $(document).ready(function() {
            $('#dataTable').DataTable({
                order: [
                    [0, 'desc']
                ],
            });
        });
    </script>



    <script>
        window.onload = function() {

            var chart3 = new CanvasJS.Chart("chartContainer3", {
	animationEnabled: true,
	title:{
		text: ""
	},
	subtitles: [{
		text: "",
		fontSize: 18
	}],
	
	legend:{
		cursor: "pointer",
		itemclick: toggleDataSeries
	},
	toolTip: {
		shared: true ,
        
        
	},
	data: [
	{
		type: "area",
		name: "รายรับ",
		showInLegend: "true",
		xValueType: "dateTime",
		xValueFormatString: "MMM YYYY", 
		yValueFormatString: "#,##0.## บาท",
        indexLabel: "{summ} บาท",
        toolTipContent: "{label}<br>กำไร:{summ}<br> รายรับ : {y}",
		dataPoints: <?php echo json_encode($dataPoints3); ?>
	},
	{
		type: "area",
		name: "รายจ่าย",
		showInLegend: "true",
		xValueType: "dateTime",
		xValueFormatString: "MMM YYYY",
       
		yValueFormatString: "#,##0.## บาท",
		dataPoints: <?php echo json_encode($dataPoints4); ?>
	}
	]
});
 
chart3.render();
 
function toggleDataSeries(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else{
		e.dataSeries.visible = true;
	}
	chart3.render();
}




            var chart1 = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                theme: "light2", // "light1", "light2", "dark1", "dark2"
                title: {
                    text: ""
                },
                axisY: {
                    title: ""
                },
                data: [{
                    type: "column",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>

                }]
            });
            chart1.render();

            var chart = new CanvasJS.Chart("chartContainer1", {
                theme: "light2",
                animationEnabled: true,
                title: {
                    text: ""
                },
                data: [{
                    type: "pie",
                    indexLabel: "{y}",
                    yValueFormatString: "#,##ครั้ง",
                    indexLabelPlacement: "inside",
                    indexLabelFontColor: "#36454F",
                    indexLabelFontSize: 18,
                    indexLabelFontWeight: "bolder",
                    showInLegend: true,
                    legendText: "{label}",
                    dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();

        }
    </script>

</body>

</html>