<?php
session_start();
include('../../assets/connect/conn.php');
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ข้อมูลการแจ้งชำระเงิน</title>
    <!-- Custom fonts for this template-->

    <!-- Custom styles for this template-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="../../assets/css/employee1.css" rel="stylesheet">
    <link href="../../assets/css/table-hover.css" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <div class="container-fluid">
            <div class="card shadow mb-4">
                <h5 class="card-header bg-secondary text-white">
                    <div class="float-left mt-2">
                        ใบเสร็จการสั่งซื้อออนไลน์
                    </div>
                </h5>
                <div class="card-body" id='body'>
                    <div id="outprint_receipt">
                        <?php
                        $order_id = $_GET['id'];
                        $sql = "SELECT * FROM tb_order AS o 
                        WHERE order_id ='$order_id'";
                        $result = $connect->query($sql);
                        while ($row = $result->fetch_array()) {
                        ?>
                            <div class="text-center fw-bold lh-1">
                                <span>ใบเสร็จการสั่งซื้อสินค้า</span><br>
                                <small>61 home cafe</small><br>
                                <small>ที่ตั้ง 61 บ้านหนองเต่าคำใหม่ หมู่ที่9 อำเภอสันทราย เชียงใหม่ 50210</small><br>
                                <small>โทร. 098 414 4998</small>
                            </div>
                            <div class="text-end">
                                <span class="col-auto pe-2">วันที่:</span>
                                <span class="border-bottom border-dark flex-grow-1"><?php echo DateThai($row['order_date_added']); ?></span>
                            </div>
                            <div class="text-end">
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
                                } else if ($row['order_status'] == "กำลังเตรียมจัดส่ง") {
                                    echo "<span class='border-bottom border-dark flex-grow-1 text-primary'> " . $row['order_status'] . " </span>";
                                } else if ($row['order_status'] == "รออาหารสักครู่") {
                                    echo "<span class='border-bottom border-dark flex-grow-1 text-info'> " . $row['order_status'] . " </span>";
                                } else if ($row['order_status'] == "ได้รับอาหารแล้ว") {
                                    echo "<span class='border-bottom border-dark flex-grow-1 text-success'> " . $row['order_status'] . " </span>";
                                } else {
                                    echo "<span class='border-bottom border-dark flex-grow-1 text-danger'> " . $row['order_status'] . " </span>";
                                }

                                ?>
                            </div>
                            
                            <table class="table table-striped">
                                <colgroup>
                                    <col width="15%">
                                    <col width="15%">
                                    <col width="50%">
                                    <col width="20%">
                                </colgroup>
                                <thead>
                                    <tr class="text-dark">
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
                                            <td class="px-1 py-0 align-middle text-end"> <?php echo $row2['orderdetail_price'] . " บาท";  ?> </td>
                                        </tr>
                                    <?php   } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="px-1 py-0" colspan="3">ราคา:</th>
                                        <th class="px-1 py-0 text-end"><?php echo  $row['order_total'] . " บาท";  ?></th>
                                    </tr>
                                
                                    <tr>
                                        <th class="px-1 py-0" colspan="3">ลดราคา:</th>
                                        <th class="px-1 py-0 text-end"><?php echo $row['order_discount'] . " บาท";  ?></th>
                                    </tr>
                                    <tr>
                                        <th class="px-1 py-0" colspan="3">ราคารวม:</th>
                                        <th class="px-1 py-0 text-end"><?php echo  number_format($row['order_total']  - $row['order_discount'], 2) . " บาท"; ?></th>
                                    </tr>
                                </tfoot>
                            </table>
                            <!-- <center>
                                <h4>การแจ้งชำระเงิน</h4> <br>
                            </center>
                            <table class="table table-bordered">
                                <thead class="thead-secondary">
                                    <td>เลขการแจ้งชำระเงิน</td>
                                    <td>รูปหลักฐานการโอน</td>
                                    <td>สถานะ</td>
                                    <td>พนักงานที่อนุมัติ</td>
                                    <td>ชื่อคนแจ้ง</td>
                                    <td>ราคาเงินที่โอน</td>
                                    <td>วัน/เวลาในการโอน</td>

                                </thead>
                                <tbody>
                                    <?php
                                    $sqlpayment = mysqli_query($connect, "SELECT * FROM tb_payment_notification WHERE order_id='$order_id'");
                                    if (mysqli_num_rows($sqlpayment) > 0) {
                                        while ($rowpayment = mysqli_fetch_assoc($sqlpayment)) {
                                            echo "<tr class='hover'>";
                                            echo "<td>" . $rowpayment['payment_id'] . "</td>";
                                            if (empty($rowpayment['payment_img'])) {
                                                echo "<td>ไม่มีรูปภาพ</td>";
                                            } else {
                                                echo "<td><img src='../../assets/img/payment/" . $rowpayment['payment_img'] . "' width='200' height='200'></td>";
                                            }


                                            if ($rowpayment['payment_status'] == "กำลังรอการอนุมัติ") {
                                                echo "<td class='text-warning'>" . $rowpayment['payment_status'] . "</td>";
                                            } else if ($rowpayment['payment_status'] == "อนุมัติการสั่งซื้อ") {
                                                echo "<td class='text-primary'>" . $rowpayment['payment_status'] . "</td>";
                                            } else if ($rowpayment['payment_status'] == "ไม่อนุมัติการสั่งซื้อ") {
                                                echo "<td class='text-info'>" . $rowpayment['payment_status'] . "</td>";
                                            }

                                            if ($rowpayment['employee_id'] == "0") {
                                                echo "<td>ยังไม่มีคนอนุมัติ</td>";
                                            } else {
                                                
                                                $employee_id=$rowpayment['employee_id'];
                                                $sql2="SELECT * FROM tb_employee WHERE employee_id='$employee_id'";
                                                $result2= mysqli_query($connect,$sql2);
                                                while ($row2 = mysqli_fetch_assoc($result2)) {
                                                    echo "<td>" . $row2['employee_firstname']." " .$row2['employee_surname']."</td>";
                                                }
                                            }

                                            echo "<td>" . $rowpayment['payment_name'] . "</td>";
                                            echo "<td>" . $rowpayment['payment_price'] . "</td>";
                                            echo "<td>" . $rowpayment['payment_date'] . "</td>";

                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr class='hover'><td colspan='7'><center>ยังไม่มีการแจ้งชำระเงิน</center></td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table> -->
                            <center>
                                <a href="approve_payment.php?id=<?php echo $order_id; ?>" class='btn btn-success ml-3'>ยืนยันการสั่งออเดอร์</a>
                                <a href="disapproved_payment.php?id=<?php echo $order_id; ?>" class='btn btn-danger ml-3'>ยกเลิกการสั่งออเดอร์</a>
                                <a href="#" onClick="window.close();"   class="btn btn-info">ปิด</a>
                            </center>
                    </div>
                <?php
                        }
                ?>

                </div>


            </div>
        </div>
    </div>

    <!-- End of Page Wrapper -->
</body>

</html>
<!-- Bootstrap core JavaScript-->
<script src="../../assets/vendor/jquery/jquery.js"></script>
<script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>

<!-- Core plugin JavaScript-->
<script src="../../assets/vendor/jquery-easing/jquery.easing.js"></script>

<!-- Custom scripts for all pages-->
<script src="../../assets/js/sb-admin-2.js"></script>

<?php

mysqli_close($connect);
?>