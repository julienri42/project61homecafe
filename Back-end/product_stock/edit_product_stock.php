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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../../assets/img/logoicon.ico">
    <title>
        เพิ่มสต็อกสินค้า
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
                                <h2 class='col-6'>เพิ่มสต็อกสินค้า</h2>


                            </div>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <!-- เนื้อหา -->
                            <center>
                                <hr class='bg-dark'>
                                    <?php

                                    $product_id = $_GET['id'];
                                    $sql = "SELECT * FROM tb_product_list WHERE product_id ='$product_id'";
                                    $result = $connect->query($sql);
                                    while ($row = $result->fetch_array()) {

                                    ?>
                                    <form action="add_product_stock_ck.php" method="post">
                            <table>
                                
                                <tr>
                                    <td><p class="mt-2 mb-2 mr-3 float-right">ชื่อสินค้า:</p></td>
                                    <td><p class="mt-2 mb-2">
                                        <?php echo $row['product_name'];?>
                                    </p></td>
                                    <td></td>
                                </tr>
                               
                                <tr>
                                    <td><p class="mt-2 mb-2 mr-3 float-right" >จำนวน: </p></td>
                                    <td><p class="mt-2 mb-2"><input type="number" id='product_stock_quantity' name="product_stock_quantity" class="form-control" ></p></td>
                                    <td></td>
                                </tr>
                               <tr id='showproduct_stock_quantity'>
                                    <td></td>
                                    <td class='text-danger'>*กรุณากรอกจำนวน</td>
                                </tr>
                                <tr>
                                    <td><p class="mt-2 mb-2 mr-3 float-right" >ราคาที่รับมา: </p></td>
                                    <td><p class="mt-2 mb-2"><input type="number" id='product_stock_price' name="product_stock_price" class="form-control" ></p></td>
                                    <td></td>
                                </tr>
                               <tr id='showproduct_stock_price'>
                                    <td></td>
                                    <td class='text-danger'>*กรุณากรอกราคาที่รับมา</td>
                                </tr>
                                <tr>
                                    <td><p class="mt-2 mb-2 mr-3 float-right">วันหมดอายุ:</p></td>
                                    <td><p class="mt-2 mb-2"><input type="date" id='product_stock_expiry_date' name="product_stock_expiry_date" class="form-control" ></p></td>
                                    <td></td>
                                </tr>
                                <tr id='showproduct_stock_expiry_date'>
                                    <td></td>
                                    <td class='text-danger'>*กรุณากรอกวันหมดอายุ</td>
                                </tr>
                  
                            </table>   
                            <button type='button' id='chk'  class='btn btn-primary mt-2'>เพิ่ม</button>
                                <a href="product_stock.php" class="btn btn-danger mt-2">ยกเลิก</a>

                            </center>

                           <!-- edit Modal-->
                           <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                     <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">เพิ่มสต็อกสินค้า</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                     <div class="modal-body">คุณต้องการเพิ่มสต็อกสินค้าใช่หรือไม่ ?</div>
                                        <div class="modal-footer">
                                            
                                            <input class="btn btn-pink text-light"  type="submit" value="ใช่">
                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">ยกเลิก</button>
                                        </div>
                                    </div>
                                </div>
                            </div>  
                    <!-- ปิด-->
                            <input type='hidden' name='product_id' value='<?php echo $row['product_id'];?>'>      
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
    <script>
        $('#showproduct_stock_quantity').hide(); 
        $('#showproduct_stock_expiry_date').hide(); 
        $('#showproduct_stock_price').hide(); 
        
        $('#chk').on('click', function() {
            $('#showproduct_stock_quantity').hide(); 
            $('#showproduct_stock_expiry_date').hide();
            if( $('#product_stock_quantity').val() != '' && $('#product_stock_expiry_date').val() != ''&& $('#product_stock_price').val())
            {
                $('#editModal').modal('show');
            }
            else{
                if($('#product_stock_quantity').val() == ''){
                    $('#showproduct_stock_quantity').show();
                    window.location.href = '#product_stock_quantity'
                }
                else if($('#product_stock_expiry_date').val() == ''){
                    $('#showproduct_stock_expiry_date').show();
                    window.location.href = '#product_stock_expiry_date'
                }
                else if($('#product_stock_price').val() == ''){
                    $('#showproduct_stock_price').show();
                    window.location.href = '#product_stock_price'
                }
            }
        })
    </script>
    



</body>

</html>