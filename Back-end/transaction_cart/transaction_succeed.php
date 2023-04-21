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
    <link href="../css/index.css" rel="stylesheet">


</head>

<body>
    <?php include("../nav_folder.php"); ?>
    <!-- Section-->
    <section class="py-5 ">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="card shadow mb-4">
                <h5 class="card-header bg-secondary text-white">
                    <div class="float-left mt-2">
                        ใบเสร็จการซื้อของเข้าร้าน
                    </div>
                </h5>
                <div class="card-body" id='body'>
                <?php
            if (isset($_SESSION['register_status'])) {


                echo '<div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                                <h5 class="alert-heading">' . $_SESSION['register_status'] . '</h5>  
                                

                                </div>';

                unset($_SESSION['register_status']);
            }
            ?>
                    <div id="outprint_receipt">
                        <?php
                        $matbuy_id = $_GET['id'];
                        $sql = "SELECT * FROM materialbuyers AS o 
                        WHERE matbuy_id ='$matbuy_id'";
                        $result = $connect->query($sql);
                        while ($row = $result->fetch_array()) {
                        ?>
                            <div class="text-center fw-bold lh-1">
                                <span>ใบเสร็จการซื้อของเข้าร้าน</span><br>
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
                                <span class="col-auto pe-2">สถานะการซื้อของเข้าร้าน :</span>
                                <?php
                                if ($row['matbuy_status'] == "รอการซื้อของเข้าร้าน") {
                                    echo "<span class='border-bottom border-dark flex-grow-1 text-warning'> " . $row['matbuy_status'] . " </span>";
                                } else if ($row['matbuy_status'] == "กำลังซื้อของเข้าร้าน") {
                                    echo "<span class='border-bottom border-dark flex-grow-1 text-info'> " . $row['matbuy_status'] . " </span>";
                                } else if ($row['matbuy_status'] == "ซื้อของเข้าร้านเรียบร้อยเเล้ว") {
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
                                    INNER JOIN tb_material_list AS b ON d.material_id  =b.material_id  
                                    WHERE matbuy_id='$matbuy_id'";
                                    $result2 = $connect->query($sql2);
                                    while ($row2 = $result2->fetch_array()) {

                                    ?>
                                        <tr class='hover'>
                                            
                                            <td class="px-1 py-1 align-middle"> <?php echo $row2['material_name'];  ?></td>
                                            <td class="px-1 py-1 align-middle">
                                                <?php echo $row2['matbuy_detail_quantity'];  ?>
                                            </td>
                                           
                                        </tr>
                                    <?php   } ?>
                                </tbody>
                            </table>
                            <center> <a href="../materialbuyers/materialbuyer.php" class='btn btn-success'>ยืนยันการซื้อของเข้าร้าน</a></center>
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