<?php
session_start();
include('../../assets/connect/conn.php');
$_SESSION['page'] = "product_stock.php";
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
$time = date("Y-m-d", time());
$numtotal = 0;
$material_stock_remaining = 0;
$product_make = 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../../assets/img/logoicon.ico">
    <title>
        เพิ่มข้อมูลสต็อกสินค้า
    </title>
    <link id="pagestyle" href="../assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->


    <link href="../../assets/css/body.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <link href="../../assets/css/employee.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/vendor/select2/dist/css/select2.min.css">


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
                                <h2 class='col-6'>เพิ่มข้อมูลสต็อกสินค้า</h2>


                            </div>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <!-- เนื้อหา -->
                            <center>
                                <hr class='bg-dark'>
                                <?php
                                $product_stock_id = $_GET['id'];
                                $sql = "SELECT * FROM tb_product_stock_list AS b INNER JOIN tb_product_list AS l ON b.product_id=l.product_id
                                    WHERE product_stock_id ='$product_stock_id'";
                                $result = $connect->query($sql);
                                while ($row = $result->fetch_array()) {
                                    $sql2 = "SELECT * FROM tb_listmaterial_to_product WHERE product_id='" . $row['product_id'] . "'";
                                    $result2 = $connect->query($sql2);
                                    while ($row2 = $result2->fetch_array()) {
                                        $listmaterial_quantity = $row2['listmaterial_quantity'];
                                        $material_id = $row2['material_id'];
                                        $sql3 = "SELECT * FROM tb_material_stock_list WHERE material_id='$material_id' AND material_stock_expiry_date>='$time'";
                                        $result3 = $connect->query($sql3);
                                        while ($row3 = $result3->fetch_array()) {
                                            $material_stock_remaining = $material_stock_remaining + $row3['material_stock_remaining'];
                                        }
                                        if (isset($material_stock_remaining)) {
                                            $nummaterial = $material_stock_remaining / $listmaterial_quantity;
                                            if ($nummaterial < $numtotal || $numtotal == 0) {
                                                $numtotal = $nummaterial;
                                            }
                                            $material_stock_remaining = 0;
                                        }
                                    }

                                ?>
                                    <form action="edit_product2_stock_ck.php" method="post">
                                        <table>
                                            <tr>
                                                <td>
                                                    <p class="mt-2 mb-2 mr-3 float-right">รหัสสต็อกสินค้า:</p>
                                                </td>
                                                <td>
                                                    <p class="mt-2 mb-2">
                                                        <?php
                                                        echo $row['product_stock_id'];
                                                        echo "<input type='hidden' name='product_stock_id'  value='" . $row['product_stock_id'] . "'>";
                                                        ?>
                                                    </p>
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p class="mt-2 mb-2 mr-3 float-right">ชื่อสินค้า:</p>
                                                </td>
                                                <td>
                                                    <p class="mt-2 mb-2">
                                                        <?php
                                                        echo $row['product_name'];
                                                        echo "<input type='hidden' name='product_id'  value='" . $row['product_id'] . "'>";
                                                        ?>
                                                    </p>
                                                </td>
                                                <td></td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <p class="mt-2 mb-2 mr-3 float-right">จำนวนสต็อก: </p>
                                                </td>
                                                <?php $total = $numtotal + $row['product_stock_quantity']; ?>
                                                <td>
                                                    <p class="mt-2 mb-2"><input type="number" name="product_stock_quantity" class="form-control" max="<?php echo $total;  ?>" value="<?php echo $row['product_stock_quantity']; ?>" placeholder='กรุณาจำนวนต่อชิ้น'></p>
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p class="mt-2 mb-2 mr-3 float-right">จำนวนคงเหลือ: </p>
                                                </td>
                                                <td>
                                                    <p class="mt-2 mb-2"><input type="number" max="<?php echo $row['product_stock_quantity']; ?>" name="product_stock_remaining" class="form-control" value="<?php echo $row['product_stock_remaining']; ?>" placeholder='กรุณาจำนวนต่อชิ้น'></p>
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p class="mt-2 mb-2 mr-3 float-right">วันหมดอายุ:</p>
                                                </td>
                                                <td>
                                                    <p class="mt-2 mb-2"><input type="date" name="product_stock_expiry_date" class="form-control" value="<?php echo date("Y-m-d", strtotime($row['product_stock_expiry_date'])); ?>" placeholder='กรุณากรอกราคาสินค้า'></p>
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">
                                                    <table class="table table-bordered ">
                                                        <thead class="thead-pink">
                                                            <tr>
                                                                <td>ชื่อวัตถุดิบที่ใช้</td>

                                                                <td>จำนวนทั้งหมดของวัตถุดิบ</td>
                                                                <td>จำนวนที่ใช้</td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $sql1 = "SELECT * FROM tb_product_list WHERE product_id='" . $row['product_id'] . "'";
                                                            $result1 = $connect->query($sql1);
                                                            while ($row1 = $result1->fetch_array()) {
                                                                $product_make = $row1['product_make'];
                                                            }
                                                            if ($product_make == "ทำเอง") {
                                                                $sql2 = "SELECT * FROM tb_listmaterial_to_product AS m
                                                                INNER JOIN tb_material_list AS t ON m.material_id=t.material_id 
                                                                INNER JOIN tb_product_list AS b ON m.product_id=b.product_id
                                                                WHERE m.product_id='" . $row['product_id'] . "'";
                                                                $result2 = $connect->query($sql2);
                                                                while ($row2 = $result2->fetch_array()) {

                                                                    $listmaterial_quantity = $row2['listmaterial_quantity'];
                                                                    $material_id = $row2['material_id'];
                                                                    echo "<tr>";
                                                                    echo "<td>" . $row2['material_name'] . "</td>";



                                                                    $sql3 = "SELECT * FROM tb_material_stock_list WHERE material_id='$material_id' AND material_stock_expiry_date>='$time'";
                                                                    $result3 = $connect->query($sql3);
                                                                    while ($row3 = $result3->fetch_array()) {
                                                                        $material_stock_remaining = $material_stock_remaining + $row3['material_stock_remaining'];
                                                                    }
                                                                    echo "<td>" . number_format($material_stock_remaining, 2) . " " . $row2['material_usedunit'] . "</td>";
                                                                    echo "<td>" . number_format($listmaterial_quantity, 2) . " " . $row2['material_usedunit'] . "ต่อ" . $row2['product_unit'] . "</td>";
                                                                    echo "</tr>";
                                                                    if (isset($material_stock_remaining)) {
                                                                        $nummaterial = $material_stock_remaining / $listmaterial_quantity;
                                                                        if ($nummaterial < $numtotal || $numtotal == 0) {
                                                                            $numtotal = $nummaterial;
                                                                        }
                                                                        $material_stock_remaining = 0;
                                                                    }
                                                                }
                                                            }
                                                            echo "<tr><td colspan='3'> <center>สามารถทำได้ " . round($total) . "ชิ้น</center></td></tr>";
                                                            echo "<input type='hidden' value='" . $row['product_stock_quantity'] . "' name='total'>";


                                                            ?>
                                                        </tbody>
                                                    </table>
                                                    <a href="#" data-toggle="modal" data-target="#edit" class="btn btn-pink mt-2">แก้ไขข้อมูลสต็อกสินค้า</a>
                                                    <a href="product_stock.php" class="btn btn-danger mt-2">ยกเลิก</a>

                            </center>

                            <!-- edit Modal-->
                            <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">แก้ไขข้อมูลสต็อกสินค้า</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">คุณต้องการแก้ไขข้อมูลสต็อกสินค้าใช่หรือไม่ ?</div>
                                        <div class="modal-footer">
                                            <input class="btn btn-pink text-light" type="submit" value="ใช่">
                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">ยกเลิก</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ปิด-->
                            </form>
                        <?php } ?>
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