<?php
session_start();
include('../../assets/connect/conn.php');
$_SESSION['page'] = "reportonlinesales.php";
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
$rownum = 0;
if (isset($_POST['date_from']) && !empty($_POST['date_to'])) {
    $date_form = $_POST['date_from'];
    $date_to = $_POST['date_to'];
} elseif (isset($_POST['date_from'])) {
    $date_form = $_POST['date_from'];
}
$num = 0;


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../../assets/img/logoicon.ico">
    <title>
        รายงานยอดขาย   
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
                                <h2 class='col-6'>รายงานยอดขาย</h2>
                            </div>



                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <!-- เนื้อหา -->
                            <center>
                                <?php

                                echo "<hr class='bg-dark'>";
                                if (isset($_SESSION['edit_status'])) {
                                    if ($_SESSION['edit_status'] == "3") {
                                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <h5 class="alert-heading">ลบข้อมูลใบเสร็จ(พนักงาน)สำเร็จ</h5>
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>';
                                    }
                                    if ($_SESSION['edit_status'] == "2") {
                                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <h5 class="alert-heading">ยกเลิกข้อมูลใบเสร็จ(พนักงาน)สำเร็จ</h5>
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>';
                                    }
                                    $_SESSION['edit_status'] = "";
                                }
                                ?>
                                <form action="reportonlinesales.php" method="POST">
                                <div class="row m-2">
                                        <div class="form-group col-md-2 text-start">
                                            <label for="date_from" class="control-label">เลือกเดือน :</label>
                                            <input type="month" name="date_from" id="date_from" value="<?php echo $date_form;  ?>" class="form-control rounded-0">
                                        </div>

                                        <div class="form-group col-md-4 text-start mt-1">
                                            <br>
                                            <button class="btn btn-primary rounded-0" id="filter" type="submit"><i class="fa fa-filter"></i> ค้นหา</button>
                                            <?php
                                            if (empty($date_form)) {
                                                $date_form = "";
                                            }
                                            ?>
                                            <!-- <a class="btn btn-success rounded-0" onClick="window.open('printonlinesales.php?id=<?php echo $date_form; ?>','','width=1200,height=800,top=100,left=200'); return false;"><i class="fa fa-print"></i> ปริ้นสารสนเทศ</a> -->
                                        </div>
                                    </div>
                                </form>
                                <hr class='bg-dark'>
                                <div class='row m-2'>

                                    <!-- Earnings (Monthly) Card Example -->
                                    <div class="col-xl-3 col-md-6 mb-4">
                                        <div class="card border-left-primary shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="้h1 font-weight-bold text-primary text-uppercase mb-1">
                                                            ยอดขายออนไลน์
                                                        </div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                            <?php
                                                         if (isset($_POST['date_from'])) {
                                                                $sql = "SELECT 	sum(order_total-order_discount) FROM tb_order
                            WHERE order_status != 'พนักงาน' AND order_date_added LIKE '$date_form%'  AND order_status!='การสั่งซื้อหมดอายุ' AND order_status!='รอการชำระเงิน'";
                                                            } else {
                                                                $sql = "SELECT 	sum(order_total-order_discount) FROM tb_order
                            WHERE order_status != 'พนักงาน' AND order_status!='การสั่งซื้อหมดอายุ' AND order_status!='รอการชำระเงิน'";
                                                            }
                                                            $result = mysqli_query($connect, $sql);
                                                            if (mysqli_num_rows($result) > 0) {
                                                                list($ordernum) = mysqli_fetch_row($result);
                                                            } else {

                                                                $ordernum = 0;
                                                            }
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

                                    <!-- Earnings (Monthly) Card Example -->
                                    <div class="col-xl-3 col-md-6 mb-4">
                                        <div class="card border-left-primary shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="้h1 font-weight-bold text-primary text-uppercase mb-1">
                                                            จำนวนในการขาย
                                                        </div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                            <?php
                                                           if (isset($_POST['date_from'])) {
                                                                $sql = "SELECT 	count(order_id) FROM tb_order
                            WHERE order_status != 'พนักงาน' AND order_date_added LIKE '$date_form%'  AND order_status!='การสั่งซื้อหมดอายุ' AND order_status!='รอการชำระเงิน'";
                                                            } else {
                                                                $sql = "SELECT 	count(order_id) FROM tb_order
                            WHERE order_status != 'พนักงาน'  AND order_status!='การสั่งซื้อหมดอายุ' AND order_status!='รอการชำระเงิน'";
                                                            }
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

                                    <!-- Earnings (Monthly) Card Example -->
                                    <div class="col-xl-3 col-md-6 mb-4">
                                        <div class="card border-left-primary shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="้h1 font-weight-bold text-primary text-uppercase mb-1">
                                                            สินค้าที่ขายได้มากที่สุด
                                                        </div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                            <?php

                                                            if (isset($_POST['date_from'])) {
                                                                $sql = "SELECT product_name FROM tb_orderdetail as b
                            INNER JOIN tb_product_list as d ON b.product_id=d.product_id
                            INNER JOIN tb_order as o ON o.order_id=b.order_id
                            WHERE order_date_added LIKE '$date_form%'  AND order_status != 'พนักงาน'  AND order_status!='การสั่งซื้อหมดอายุ' AND order_status!='รอการชำระเงิน'
                            GROUP BY b.product_id  ORDER BY sum(orderdetail_quantity) DESC LIMIT 1";
                                                            } else {
                                                                $sql = "SELECT product_name FROM tb_orderdetail as b
                            INNER JOIN tb_product_list as d ON b.product_id=d.product_id
                            INNER JOIN tb_order as o ON o.order_id=b.order_id
                            WHERE order_status != 'พนักงาน'
                            GROUP BY b.product_id  ORDER BY sum(orderdetail_quantity) DESC LIMIT 1";
                                                            }

                                                            $result = mysqli_query($connect, $sql);
                                                            if (mysqli_num_rows($result) > 0) {
                                                                list($product_name) = mysqli_fetch_row($result);
                                                            } else {
                                                                $product_name = "ไม่มี";
                                                            }
                                                            echo $product_name;
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fa-book fa-3x text-gray-500"></i>
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
                                                <th>อันดับ</th>
                                                <th>วัน/เดือน/ปี</th>
                                                <th>ราคา</th>
                                                <th>ผู้สั่งซื้อ</th>
                                                <th>แสดงรายละเอียด</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                           if (isset($_POST['date_from'])) {
                                                $sql = "SELECT 	order_id,order_date_added,order_total,order_discount,user_id FROM tb_order
                                    WHERE order_status != 'พนักงาน' AND order_date_added LIKE '$date_form%'  AND order_status!='การสั่งซื้อหมดอายุ' AND order_status!='รอการชำระเงิน'
                                    ORDER BY order_date_added DESC
                                    ";
                                            } else {
                                                $sql = "SELECT 	order_id,order_date_added,order_total,order_discount,user_id FROM tb_order
                                    WHERE order_status != 'พนักงาน' AND order_status!='การสั่งซื้อหมดอายุ' AND order_status!='รอการชำระเงิน'
                                    ORDER BY order_date_added DESC
                                    ";
                                            }

                                            $result = $connect->query($sql);
                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = $result->fetch_array()) {
                                                    echo "<tr>";
                                                    $num++;
                                                    echo "<td>" . $num . "</td>";
                                                    echo "<td>" . DateThai($row['order_date_added']) . "</td>";
                                                    echo "<td>" . number_format($row['order_total'] - $row['order_discount'], 2) . "</td>";
                                                    if ($row['user_id'] == "0") {
                                                        echo "<td> - </td>";
                                                    } else {
                                                        $sql2 = "SELECT user_firstname,user_surname FROM tb_user WHERE user_id='" . $row['user_id'] . "'";
                                                        $result2 = mysqli_query($connect, $sql2);
                                                        while ($row2 = mysqli_fetch_assoc($result2)) {
                                                            echo "<td>" . $row2['user_firstname'] . " " . $row2['user_surname'] . "</td>";
                                                        }
                                                    }
                                            ?>
                                                    <td><a href="#" onClick="window.open('receipt_online_detail.php?id=<?php echo $row['order_id']; ?>','','width=1200,height=700,top=200,left=200'); return false;" class="text-success">รายละเอียด</a></td>
                                            <?php

                                                    echo "</tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='4' class='text-center'>ไม่มีข้อมูลในวันที่เลือก</td></tr>";
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
            $('#dataTable').DataTable();
        });
    </script>


</body>

</html>