<?php
session_start();
include('../../assets/connect/conn.php');
$_SESSION['page'] = "Preparetoproduct.php";
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
$rownum = 0;
if (isset($_POST['date_from']) && !empty($_POST['date_to'])) {
    $date_form = $_POST['date_from'];
    $date_to = $_POST['date_to'];
    
} elseif (isset($_POST['date_from'])) {
    $date_form = $_POST['date_from'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../../assets/img/logoicon.ico">
  <title>
    จัดเตรียมสินค้า
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
  <link href="../../assets/css/body.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
  <link href="../../assets/css/employee.css" rel="stylesheet">
  
 

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
                <h2 class='col-6'>จัดเตรียมสินค้า</h2>
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
                <form action="receipt_checkoutpage.php" method="POST">
                    <div class="row m-2">
                        <div class="form-group col-md-2 text-start">
                            <label for="date_from" class="control-label">วันที่เริ่มต้น :</label>
                            <input type="date" name="date_from" id="date_from" value="<?php echo $date_form;  ?>" class="form-control rounded-0">
                        </div>
                        <div class="form-group col-md-2 text-start">
                            <label for="date_to" class="control-label">ถึงวันที่</label>
                            <input type="date" name="date_to" id="date_to" value="<?php echo $date_to;  ?>" class="form-control rounded-0">
                        </div>
                        <div class="form-group col-md-4 text-start mt-1">
                                <br>
                                <button class="btn btn-primary rounded-0" id="filter" type="submit"><i class="fa fa-filter"></i> ค้นหา</button>
                        </div>
                    </div>
                </form>
                <hr class='bg-dark'>

                <div class="table-responsive p-3">
                    <table class="table table-striped table-hover " id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-pink">
                                <tr>
                                    <th>#</th>
                                    <th>เลขที่ใบเสร็จ</th>
                                    <td>สถานะการสั่งซื้อ</td>
                                    <th>วัน/เดือน/ปี</th>
                                    <th>จำนวนสินค้า</th>
                                    <th>ราคา</th>
                                    <th>คนอนุมัติการสั่งซื้อ</th>
                                    
                                    <th>จัดเตรียมสินค้า</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($_POST['date_from'])) {
                                    $date_form = $_POST['date_from'];
                                    $sql = "SELECT * FROM tb_order as o  
                                            INNER JOIN tb_employee AS e ON o.employee_id=e.employee_id
                                            WHERE order_date_added>='$date_form' AND  order_status='จัดเตรียมสินค้า'
                                            ORDER BY order_receipt_no DESC";
                                } else {
                                    $sql = "SELECT * FROM tb_order as o  
                                            INNER JOIN tb_employee AS e ON o.employee_id=e.employee_id
                                            WHERE order_status='จัดเตรียมสินค้า'
                                            ORDER BY order_receipt_no DESC";
                                }
                                $result = $connect->query($sql);
                                while ($row = $result->fetch_array()) {
                                    $rownum += 1;

                                    echo "<tr>";
                                    echo "<td> $rownum </td>";
                                    echo "<td>" . $row['order_receipt_no'] . "</td>";
                                    if($row['order_status']=="รอการชำระเงิน"){
                                        echo "<td class='text-warning'>" . $row['order_status'] . "</td>";
                                        
                                    }
                                    else if($row['order_status']=="จัดเตรียมสินค้า")
                                    {
                                        echo "<td class='text-primary'>" . $row['order_status'] . "</td>";
                                       
                                    }
                                    else if ($row['order_status']=="รออาหารสักครู่")
                                    {
                                        echo "<td class='text-success'>" . $row['order_status'] . "</td>";
                                    }
                                    else if($row['order_status']=="กำลังไปเสริฟ")
                                    {
                                        echo "<td class='text-info'>" . $row['order_status'] . "</td>";
                                    }
                                    else if($row['order_status']=="ได้รับอาหารแล้ว")
                                    {
                                        echo "<td class='text-success'>" . $row['order_status'] . "</td>";
                                    }
                                    else{
                                        echo "<td class='text-danger'>" . $row['order_status'] . "</td>";
                                    }
                                    echo "<td>" . $row['order_date_added'] . "</td>";
                                    $sql2 = "SELECT * FROM tb_orderdetail WHERE order_id='" . $row['order_id'] . "'";
                                    $result2 = $connect->query($sql2);
                                    $numitem = mysqli_num_rows($result2);
                                    echo "<td> $numitem </td>";
                                    echo "<td>" . number_format($row['order_total']-$row['order_discount']+$row['order_service_total'],2) . " บาท</td>";
                                    echo "<td>" . $row['employee_firstname'] . "</td>";
                                ?>
                                    <td><a href="#" onClick="window.open('Preparetoproduct_detail.php?id=<?php echo $row['order_id']; ?>','','width=1200,height=700,top=200,left=200'); return false;" class="text-success">รายละเอียด</a></td>
                                  

                                <?php
                                    echo "</tr>";
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
        $(document).ready( function () {
    $('#dataTable').DataTable();
} );
      </script>


</body>

</html>