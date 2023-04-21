<?php
session_start();
include('../../assets/connect/conn.php');
$_SESSION['page'] = "service_shopping.php";
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
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../../assets/img/logoicon.ico">
  <title>
    รออาหาร
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
                <h2 class='col-6'>  รออาหาร(รายละเอียด)</h2>
               
                
              </div>
                

              
            </div>
            <div class="card-body px-0 pt-0 pb-2">
            <div id="outprint_receipt" class='p-2'>
                        <?php
                        $order_id = $_GET['id'];
                        $sql = "SELECT * FROM tb_order AS o 
                        WHERE order_id ='$order_id'";
                        $result = $connect->query($sql);
                        while ($row = $result->fetch_array()) {
                        ?>
                           
                            <div class="fs-6 fs-light d-flex w-100 mb-1">
                                <span class="col-auto pe-2">วัน:</span>
                                <span class="border-bottom border-dark flex-grow-1"><?php echo $row['order_date_added']; ?></span>
                            </div>
                            <div class="fs-6 fs-light d-flex w-100 mb-1">
                                <span class="col-auto pe-2">เลขที่ใบเสร็จ:</span>
                                <span class="border-bottom border-dark flex-grow-1"><?php echo $row['order_receipt_no']; ?></span>
                            </div>
                            <?php
                            if ($row['user_id'] != 0) {
                                $sql3 = "SELECT * FROM tb_user WHERE user_id='" . $row['user_id'] . "'";
                                $result3 = $connect->query($sql3);
                                while ($row3 = $result3->fetch_array()) {
                                    echo ' <div class="fs-6 fs-light d-flex w-100 mb-1">
                                <span class="col-auto pe-2">ชื่อ : </span> 
                                <span class="border-bottom border-dark flex-grow-1">' . $row3['user_firstname'] . ' ' . $row3['user_surname'] . '</span>
                            </div>';
                                }
                            }

                            ?>
                            <div class="fs-6 fs-light d-flex w-100 mb-1">
                                <span class="col-auto pe-2">สถานะการสั่งซื้อออเดอร์:</span>
                                <?php
                                if ($row['order_status'] == "รอการชำระเงิน") {
                                    echo "<span class='border-bottom border-dark flex-grow-1 text-warning'> " . $row['order_status'] . " </span>";
                                } else if ($row['order_status'] == "จัดเตรียมสินค้า") {
                                    echo "<span class='border-bottom border-dark flex-grow-1 text-primary'> " . $row['order_status'] . " </span>";
                                }else if($row['order_status']=="รออาหารสักครู่"){
                                    echo "<span class='border-bottom border-dark flex-grow-1 text-success'> " . $row['order_status'] . " </span>";
                                }else if ($row['order_status'] == "กำลังไปเสริฟ") {
                                    echo "<span class='border-bottom border-dark flex-grow-1 text-info'> " . $row['order_status'] . " </span>";
                                } else if ($row['order_status'] == "ได้รับอาหารแล้ว") {
                                    echo "<span class='border-bottom border-dark flex-grow-1 text-success'> " . $row['order_status'] . " </span>";
                                } else {
                                    echo "<span class='border-bottom border-dark flex-grow-1 text-danger'> " . $row['order_status'] . " </span>";
                                }
                                
                                 ?>
                            </div>
                           
                            <table class="table table-bordered">
                                <colgroup>
                                    <col width="15%">
                                    <col width="15%">
                                    <col width="50%">
                                    <col width="20%">
                                </colgroup>
                                <thead>
                                    <tr class="text-white thead-pink">
                                        <th class="py-0 px-1">รูปภาพ</th>
                                        <th class="py-0 px-1">ชื่อสินค้า</th>
                                        <th class="py-0 px-1">จำนวน</th>
                                        <th class="py-0 px-1">ราคารวม</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql2 = "SELECT * FROM tb_orderdetail AS d
                                    INNER JOIN tb_product_list AS b ON d.product_id  =b.product_id  
                                    WHERE order_id='$order_id'";
                                    $result2 = $connect->query($sql2);
                                    while ($row2 = $result2->fetch_array()) {

                                    ?>
                                        <tr class='hover'>
                                            <td>
                                                <?php
                                                if (empty($row2['product_img'])) {
                                                    echo "<img class='card-img-top' height='125px' src='../../assets/img/product/noproduct.png' />";
                                                } else {
                                                    echo "<img class='card-img-top' height='125px' src='../../assets/img/product/" . $row2['product_img'] . "' />";
                                                }
                                                ?>
                                            </td>
                                            <td class="px-1 py-0 align-middle"> <?php echo $row2['product_name'];  ?></td>
                                            <td class="px-1 py-0 align-middle">
                                                <?php echo $row2['orderdetail_quantity'];  ?>
                                            </td>
                                            <td class="px-1 py-0 align-middle text-end"> <?php echo $row2['orderdetail_price']." บาท";  ?> </td>
                                        </tr>
                                    <?php   } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="px-1 py-0" colspan="3">ราคา:</th>
                                        <th class="px-1 py-0 text-end"><?php echo  $row['order_total']." บาท";  ?></th>
                                    </tr>
                                    <tr>
                                        <th class="px-1 py-0" colspan="3">ค่าจัดส่ง :</th>
                                        <th class="px-1 py-0 text-end"><?php echo $row['order_service_total']." บาท";  ?></th>
                                    </tr>
                                    <tr>
                                        <th class="px-1 py-0" colspan="3">ลดราคา:</th>
                                        <th class="px-1 py-0 text-end"><?php echo $row['order_discount']." บาท";  ?></th>
                                    </tr>
                                    <tr>
                                        <th class="px-1 py-0" colspan="3">ราคารวม:</th>
                                        <th class="px-1 py-0 text-end"><?php echo  number_format($row['order_total'] + $row['order_service_total'] - $row['order_discount'], 2)." บาท"; ?></th>
                                    </tr>
                                </tfoot>
                            </table>
                            <center> <a href='service_shopping_ck.php?id=<?php echo $row['order_id'] ; ?>' class='btn btn-pink'>เสริฟสำเร็จ</a> <a href='service_shopping_ck2.php?id=<?php echo $row['order_id'] ; ?>' class='btn btn-danger'>ไม่สามารถเสริฟได้</a> <a href="service_shopping.php" class='btn btn-info'>กลับสู่รอเสริฟ</a> </center>                    
                    </div>
                <?php
                        }
                ?>

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
    $('#dataTable').DataTable(
      { order: [[0, 'desc']],}
    );
} );
</script>


</body>

</html>