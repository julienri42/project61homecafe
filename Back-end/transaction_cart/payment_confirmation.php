<?php
session_start();
include('../../assets/connect/conn.php');
$time = date("Y-m-d H:i:s", time());




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
                        แจ้งการชำระเงิน
                    </div>
                </h5>
                <div class="card-body" id='body'>
                <?php
                    if (isset($_SESSION['register_status'])) {
                        echo '<div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                                    <h5 class="alert-heading">' . $_SESSION['register_status'] . '</h5>  
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>';
                        unset($_SESSION['register_status']);
                        }
                    ?>

                    <form action="payment_confirmation_ck.php" method="POST" enctype="multipart/form-data">
                        <label for="order_id" class="form-label mt-2">เลือกเลขการสั่งซื้อ :</label>
                        <select name="order_id" id="order_id" class="form-control">
                            <option value="0">กรุณาเลือกเลขการสั่งซื้อ</option>
                            <?php
                            $user_id = $_SESSION['user_id'];
                            $selectorder = mysqli_query($connect, "SELECT order_id FROM tb_order WHERE user_id ='$user_id' AND order_status='รอการชำระเงิน'");
                            while ($row = mysqli_fetch_assoc($selectorder)) {
                                $order_id = $row['order_id'];
                                echo "<option value='$order_id'>$order_id</option>";
                            }
                            ?>

                        </select>

                        <label for="payment_name" class="form-label mt-3">ชื่อผู้โอน :</label>
                        <input type="text" id="payment_name" name="payment_name" placeholder="กรุณากรอกชื่อผู้โอน" class="form-control">

                        <label for="payment_price" class="form-label mt-3">จำนวนเงินที่โอน :</label>
                        <input type="text" id="payment_price" name="payment_price" placeholder="กรุณากรอกจำนวนเงินที่โอน" class="form-control">

                        <label for="payment_date" class="form-label mt-3">วันเวลาที่โอน :</label>
                        <input type="datetime-local" id="payment_date" name="payment_date" placeholder="กรุณากรอกวันเวลาที่โอน" class="form-control" aria-describedby="กรุณากรอกชื่อผู้โอน">

                        <label for="payment_detail" class="form-label mt-3">หมายเหตุ(ถ้าไม่มีก็ไม่ต้องเขียน) :</label>
                        <input type="text" id="payment_detail" name="payment_detail" placeholder="กรุณากรอกหมายเหตุ" class="form-control" aria-describedby="กรุณากรอกชื่อผู้โอน">

                        <label for="payment_img	" class="form-label mt-3">หลักฐานการโอนเงิน :</label>
                        <input type="File" id="payment_img" name="payment_img" placeholder="กรุณากรอกหลักฐานการโอนเงิน" class="form-control" aria-describedby="กรุณากรอกชื่อผู้โอน">
                        <center>
                            <input type="submit" class="btn btn-success mt-4 ml-2" value="ยืนยันการชำระเงิน">
                            <a href="../index.php" class="btn btn-danger mt-4">ยกเลิก</a>
                        </center>
                    </form>
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
