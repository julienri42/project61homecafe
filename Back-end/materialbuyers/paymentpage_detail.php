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

    <title>ข้อมูลการแจ้งซื้อของเข้าร้าน</title>
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
                        ใบเสร็จซื้อของเข้าร้าน
                    </div>
                </h5>
                <div class="card-body" id='body'>
                    <div id="outprint_receipt">
                        <?php
                        $matbuy_id = $_GET['id'];
                        $sql = "SELECT * FROM materialbuyers AS o 
                        WHERE matbuy_id ='$matbuy_id'";
                        $result = $connect->query($sql);
                        while ($row = $result->fetch_array()) {
                        ?>
                            <div class="text-center fw-bold lh-1">
                                <span>ใบเสร็จซื้อของเข้าร้าน</span><br>
                                <small>61 home cafe</small><br>
                                <small>ที่ตั้ง 61 บ้านหนองเต่าคำใหม่ หมู่ที่9 อำเภอสันทราย เชียงใหม่ 50210</small><br>
                                <small>โทร. 098 414 4998</small>
                            </div>
                            <div class="text-end">
                                <span class="col-auto pe-2">วันที่:</span>
                                <span class="border-bottom border-dark flex-grow-1"><?php echo DateThai($row['matbuy_date_added']); ?></span>
                            </div>
                            <div class="text-end">
                                <span class="col-auto pe-2">เลขที่ใบเสร็จ:</span>
                                <span class="border-bottom border-dark flex-grow-1"><?php echo $row['matbuy_receipt_no']; ?></span>
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
                                <span class="col-auto pe-2">สถานะการซื้อของเข้าร้าน:</span>
                                <?php
                                if ($row['matbuy_status'] == "รอการซื้อของเข้าร้าน") {
                                    echo "<span class='border-bottom border-dark flex-grow-1 text-warning'> " . $row['matbuy_status'] . " </span>";
                                } else if ($row['matbuy_status'] == "กำลังซื้อของเข้าร้าน") {
                                    echo "<span class='border-bottom border-dark flex-grow-1 text-primary'> " . $row['matbuy_status'] . " </span>";
                                } else if ($row['matbuy_status'] == "รอซื้อของเข้าร้าน") {
                                    echo "<span class='border-bottom border-dark flex-grow-1 text-info'> " . $row['matbuy_status'] . " </span>";
                                } else if ($row['matbuy_status'] == "ซื้อของเข้าร้านเรียบร้อยแล้ว") {
                                    echo "<span class='border-bottom border-dark flex-grow-1 text-success'> " . $row['matbuy_status'] . " </span>";
                                } else {
                                    echo "<span class='border-bottom border-dark flex-grow-1 text-danger'> " . $row['matbuy_status'] . " </span>";
                                }

                                ?>
                            </div>
                            
                            <table class="table table-striped">
                                <colgroup>
                                    <col width="50%">
                                    <col width="50%">
                                    
                                </colgroup>
                                <thead>
                                    <tr class="text-dark">
                                        <th class="py-0 px-1">ชื่อสินค้า</th>
                                        <th class="py-0 px-1">จำนวน</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql2 = "SELECT * FROM materialbuyers_detail AS d
                                    INNER JOIN tb_material_list AS b ON d.material_id   =b.material_id  
                                    WHERE matbuy_id='$matbuy_id'";
                                    $result2 = $connect->query($sql2);
                                    while ($row2 = $result2->fetch_array()) {

                                    ?>
                                        <tr class='hover'>
                                            <td class="px-1 py-0 align-middle"> <?php echo $row2['material_name'];  ?></td>
                                            <td class="px-1 py-0 align-middle">
                                                <?php echo $row2['matbuy_detail_quantity'];  ?>
                                    <?php   } ?>
                                </tbody>
                                <tfoot>
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
                                    
                                </tbody>
                            </table> -->
                            <center>
                                <a href="approve_payment.php?id=<?php echo $matbuy_id; ?>" class='btn btn-success ml-3'>ยืนยันซื้อของเข้าร้าน</a>
                                <a href="disapproved_payment.php?id=<?php echo $matbuy_id; ?>" class='btn btn-danger ml-3'>ยกเลิกการซื้อของเข้าร้าน</a>
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