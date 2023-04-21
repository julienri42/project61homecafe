<?php
session_start();
include('../../assets/connect/conn.php');
$time = date("Y-m-d H:i:s", time());
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
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>61 home cafe</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="../assets/favicon.ico" />
    <link href="../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../css/styles.css" rel="stylesheet">
    <link href="../css/index1.css" rel="stylesheet">
    <link href="../../assets/css/employee1.css" rel="stylesheet">
</head>

<body>
    <?php include("../nav_folder.php"); ?>
    <!-- Section-->
    <section class="py-5 ">
        <div class="container px-4 px-lg-5 mt-5">
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
                                } else if ($row['order_status'] == "รออาหารสักครู่") {
                                    echo "<span class='border-bottom border-dark flex-grow-1 text-info'> " . $row['order_status'] . " </span>";
                                } else if ($row['order_status'] == "ได้รับอาหารแล้ว") {
                                    echo "<span class='border-bottom border-dark flex-grow-1 text-success'> " . $row['order_status'] . " </span>";
                                } else {
                                    echo "<span class='border-bottom border-dark flex-grow-1 text-danger'> " . $row['order_status'] . " </span>";
                                }

                                ?>
                            </div>
                            <div class="fs-6 fs-light d-flex w-100 mb-1">
                                <span class="col-auto pe-2">วันหมดอายุออเดอร์:</span>
                                <span class="border-bottom border-dark flex-grow-1"><?php echo $row['order_expiration_date']; ?></span>
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
                                        <th class="px-1 py-0 text-end"><?php echo  number_format($row['order_total'] - $row['order_discount'], 2) . " บาท"; ?></th>
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
                            <div>
                                <?php
                               
                                // if ($row['order_status'] == "รอการชำระเงิน") {
                                //     echo "<a href='../transaction_cart/payment_confirmation.php' class='btn btn-success m-2'>ยืนยันการสั่งซื้อ</a>";
                                // }
                                if ($row['order_status'] == "ได้รับอาหารแล้ว") {
                                    ?>
                                   <a href="#" onClick="window.open('report_checkoutpage2.php?id=<?php echo $row['order_id']; ?>','','width=650,height=600,top=100,left=500'); return false;" class="btn btn-success">ปริ้นท์ใบเสร็จ</a>
                                
                                <?php
                                }
                                echo "<a href='order_history.php' class='btn btn-danger m-2'>กลับหน้าประวัติการสั่งซื้อ</a>";
                                ?>

                            </div>
                            </center>
                    </div>
                <?php
                        }
                ?>

                </div>


            </div>

        </div>
    </section>
    <?php
    include("../footer_folder.php");
    ?>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="../js/scripts.js"></script>
    <!-- Bootstrap core JavaScript-->
    <script src="../../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../assets/js/sb-admin-2.min.js"></script>

</body>

</html>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

<script type="text/javascript">
    function cartnum() {
        $.ajax({
            method: "POST",
            url: "../ajax_cart/button_cart.php",
            success: function(data) {
                $("#cartnum").html(data);
            }
        });
    }
    cartnum();

    function show_cart() {
        $.ajax({
            method: "POST",
            url: "../ajax_cart/show_cart_folder.php",
            success: function(data) {
                $("#show_cart").html(data);
                cartnum();
            }
        });
    }
    $(document).on("click", "#cartModaltest", function() {
        show_cart();
    });

    $(document).on("click", ".plus", function() {
        var id = $(this).attr("id");
        $.ajax({
            method: "POST",
            url: "../ajax_cart/plus_minus_cart.php",
            data: {
                id: id,
                function: "plus"
            },
            success: function(data) {
                show_cart();
                cartnum();
            }
        });
    });

    $(document).on("click", ".minus", function() {
        var id = $(this).attr("id");
        $.ajax({
            method: "POST",
            url: "../ajax_cart/plus_minus_cart.php",
            data: {
                id: id,
                function: "minus"
            },
            success: function(data) {
                show_cart();
                cartnum();
            }
        });

    });

    $(document).on("click", "#delete_all", function() {
        $.ajax({
            method: "POST",
            url: "../ajax_cart/delete_cart.php",
            data: {
                function: "delete_all"
            },
            success: function(data) {
                show_cart();
                cartnum();

            }
        });
    });
    $(document).on("click", ".delete", function() {
        var id = $(this).attr("id");
        $.ajax({
            method: "POST",
            url: "../ajax_cart/delete_cart.php",
            data: {
                id: id,
                function: "delete"
            },
            success: function(data) {
                show_cart();
                cartnum();
            }
        });
    });
</script>