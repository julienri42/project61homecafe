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
                            <form action="add_product_stock_ck.php" method="post">
                            <table>
                                <tr>
                                    <td><p class="mt-2 mb-2 mr-3 float-right">ประเภทสินค้า:</p></td>
                                    <td>
                                        <p class="mt-2 mb-2">
                                            <select name="typeproduct_id" class="form-select" id="typeproduct">
                                                <option value='0'>กรุณาเลือกประเภทสินค้า</option>
                                                <?php 
                                                    $sql ="SELECT * FROM tb_typeproduct";
                                                    $result =  mysqli_query($connect,$sql);
                                                    while($row = mysqli_fetch_assoc($result))
                                                    {
                                                        echo "<option value='".$row['typeproduct_id']."'>".$row['typeproduct_name']."</option>";  
                                                    }
                                                ?>
                                            </select>
                                        </p>
                                    </td>
                                </tr>

                                <tr id='product_show'>
                                    <td><p class="mt-2 mb-2 mr-3 float-right">ชื่อสินค้า:</p></td>
                                    <td><p class="mt-2 mb-2">
                                        <select name="product_id" class="form-control" id='product'>          
                                        </select>
                                    </p></td>
                                </tr>
                                <tr >
                                    <td colspan='2' id='price_show'>

                                    </td>
                                 </tr>
                                
                                <tr id='expiry_show'>
                                    <td><p class="mt-2 mb-2 mr-3 float-right">วันหมดอายุ:</p></td>
                                    <td><p class="mt-2 mb-2"><input type="date" name="product_stock_expiry_date" class="form-control" placeholder='กรุณากรอกราคาสินค้า'></p></td>
                                </tr>
                            </table> 
                                <div id='button_show'>
                                    <a href="#"  data-toggle="modal" data-target="#add" class="btn btn-pink mt-2">เพิ่มข้อมูลสต็อกสินค้า</a>
                                    <a href="product_stock.php" class="btn btn-danger mt-2">ยกเลิก</a>
                                </div>
                                
                            </center>

                            <!--ยืนยันแก้ไขข้อมูล -->
                            <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">เพิ่มข้อมูลสต็อกสินค้า</h5>
                                        </div>
                                        <div class="modal-body">คุณต้องการเพิ่มข้อมูลเพิ่มข้อมูลสต็อกสินค้า?</div>
                                        <div class="modal-footer">
                                            <input type='submit' value='เพิ่ม' class='btn btn-primary'>
                                            <button class="btn btn-secondary" type="button" id='dis' data-dismiss="modal">ยกเลิก</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--จบยืนยันแก้ไขข้อมูล -->
                            </form>

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
$("#product_show").hide();
$('#expiry_show').hide(); 
$('#button_show').hide();

$('#typeproduct').change(function() {
      var id_typeproduct = $(this).val();
      $.ajax({
      type: "POST",
      url: "ajaxselect.php",
      data: {id:id_typeproduct,function:'typeproduct'},
      success: function(data){
          $('#product').html(data);
          $("#product_show").show(); 
          
      }
    });
  });
  $('#product').change(function() {
      var id_product = $(this).val();
      $.ajax({
      type: "POST",
      url: "ajaxselect.php",
      data: {id:id_product,function:'product'},
      success: function(data){
        $('#price_show').html(data);
        $('#expiry_show').show(); 
        $('#button_show').show();
      }
    });
  });

</script>
    


</body>

</html>