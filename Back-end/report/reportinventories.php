<?php
session_start();
include('../../assets/connect/conn.php');
$_SESSION['page'] = "reportinventories.php";
function DateThai($strDate)
{
    $strYear = date("Y", strtotime($strDate)) + 543;
    $strMonth = date("n", strtotime($strDate));
    $strDay = date("j", strtotime($strDate));
    $strSeconds = date("s", strtotime($strDate));

    $strtime = date("H:i", strtotime($strDate));

    $strMonthCut = array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
    $strMonthThai = $strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear $strtime";
}
$month = date("Y-m", time());
$time = date("Y-m-d", time());
$num = 0;
$numrow = 0;
$all=0;
$nummost=0;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../../assets/img/logoicon.ico">
    <title>
        รายงานสินค้าคงเหลือ
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
    <link href="../../assets/css/employee1.css" rel="stylesheet">
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
                                <h2 class='col-6'>รายงานสินค้าคงเหลือ</h2>
                                <div class='col-6 text-end'><a class="btn btn-success rounded-0"  onClick="window.open('printinventories.php','','width=1200,height=800,top=100,left=200'); return false;" ><i class="fa fa-print"></i> ปริ้นสารสนเทศ</a></div>

                            </div>



                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <!-- เนื้อหา -->
                            <center>
                                <?php
                                echo "<hr class='bg-dark'>";
                                ?>
                                
                              

                                <div class='row m-2'>

                                    <!-- Earnings (Monthly) Card Example -->

                                    <div class="col-4">
                                        <div class="card border-left-primary shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col-12 mt-3">
                                                        <div class="h5 font-weight-bold text-primary text-uppercase text-center  mb-1">
                                                            จำนวนสินค้าคงเหลือทั้งหมด
                                                        </div>
                                                    </div>

                                                    <div class="col-12 mr-2 text-center ">
                                                        <div class="h3 mb-0 font-weight-bold text-gray-1000 mt-2">
                                                            <?php
                                                            $sql = "SELECT sum(product_stock_remaining) FROM tb_product_stock_list";
                                                            $result = mysqli_query($connect, $sql);
                                                            list($all) = mysqli_fetch_row($result);
                                                            echo $all . " ชิ้น";
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Earnings (Monthly) Card Example -->
                                    <div class="col-4">
                                        <div class="card border-left-primary shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col-12 ">
                                                        <div class="h5 font-weight-bold text-primary text-uppercase text-center  mb-1">
                                                            ชื่อสินค้าที่เหลือเยอะที่สุด
                                                        </div>
                                                    </div>

                                                    <div class="col-12 mr-2 text-center ">
                                                        <?php
                                                        $sql = "SELECT product_name,sum(product_stock_remaining)as product_re FROM tb_product_stock_list as d
                                             INNER JOIN tb_product_list as b  ON b.product_id=d.product_id
                                             WHERE product_stock_expiry_date >='$time'
                                             GROUP BY d.product_id  ORDER BY product_re DESC  LIMIT 3";
                                                        $result = mysqli_query($connect, $sql);
                                                        if (mysqli_num_rows($result) > 0) {
                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                $nummost++;
                                                                $product_name = $row['product_name'];
                                                                $product_stock_remaining = $row['product_re'];
                                                                echo "<div class='h5 mb-0 font-weight-bold text-gray-1000 mt-2'>อันดับ $nummost $product_name เหลือ $product_stock_remaining ชิ้น </div>";
                                                            }
                                                        }
                                                        $nummost = 0;
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Earnings (Monthly) Card Example -->
                                    <div class="col-4">
                                        <div class="card border-left-primary shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col-12 ">
                                                        <div class="h5 font-weight-bold text-primary text-uppercase text-center  mb-1">
                                                            ชื่อสินค้าที่เหลือน้อยที่สุด
                                                        </div>
                                                    </div>

                                                    <div class="col-12 mr-2 text-center ">
                                                        <?php
                                                        $sql = "SELECT product_name,sum(product_stock_remaining)as product_re FROM tb_product_stock_list as d
                                             INNER JOIN tb_product_list as b  ON b.product_id=d.product_id
                                             WHERE product_stock_expiry_date >='$time'
                                             GROUP BY d.product_id  ORDER BY product_re LIMIT 3";
                                                        $result = mysqli_query($connect, $sql);
                                                        if (mysqli_num_rows($result) > 0) {
                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                $nummost++;
                                                                $product_name = $row['product_name'];
                                                                $product_stock_remaining = $row['product_re'];
                                                                echo "<div class='h5 mb-0 font-weight-bold text-gray-1000 mt-2'>อันดับ $nummost $product_name เหลือ $product_stock_remaining ชิ้น </div>";
                                                            }
                                                        }
                                                        $nummost = 0;
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <hr>
                                <div class="table-responsive p-3">
                                    <table class="table table-striped table-hover " id="dataTable" width="100%" cellspacing="0">
                                        <thead class="thead-secondary">
                                            <tr>
                                                <th>อันดับสินค้าคงเหลือ</th>
                                                <th>รูปภาพสินค้า</th>
                                                <th>ชื่อสินค้า</th>
                                                <th>จำนวนที่คงเหลือ</th>
                                                <th>หมายเหตุ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            $sql = "SELECT product_name,product_img,product_unit,sum(product_stock_remaining)as product_re FROM tb_product_stock_list as d
                                 INNER JOIN tb_product_list as b  ON b.product_id=d.product_id
                                 WHERE product_stock_expiry_date >='$time'
                                 GROUP BY d.product_id  ORDER BY product_re DESC ";
                                            $result = $connect->query($sql);
                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = $result->fetch_array()) {
                                                    echo "<tr>";
                                                    $num++;
                                                    echo "<td>" . $num . "</td>";
                                                    echo "<td>" . $row['product_name'] . "</td>";
                                                    if (empty($row['product_img'])) {
                                                        echo "<td>ไม่มีรูปภาพ</td>";
                                                    } else {
                                                        echo "<td><img src='../../assets/img/product/" . $row['product_img'] . "' height='100' width='100'></td>";
                                                    }
                                                    $product_unit = $row['product_unit'];
                                                    echo "<td>" . $row['product_re'] . " " . $product_unit . "</td>";
                                                    if ($row['product_re'] >= 50) {
                                                        echo "<td class='text-center text-primary'>สินค้าคงเหลือมาก</td>";
                                                    } else if ($row['product_re'] >= 11 && $row['product_re'] <= 49) {
                                                        echo "<td class='text-center text-info'>สินค้าคงเหลือปกติ</td>";
                                                    } else if ($row['product_re'] >= 1 && $row['product_re'] <= 9) {
                                                        echo "<td class='text-center text-danger'>สินค้าใกล้จะหมด</td>";
                                                    } else {
                                                        echo "<td class='text-center text-danger'>สินค้าหมด</td>";
                                                    }

                                                    echo "</tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='5' class='text-center'>ไม่มีข้อมูล</td></tr>";
                                            }

                                            ?>
                                        </tbody>
                                    </table>
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

            });
        });
    </script>


</body>

</html>