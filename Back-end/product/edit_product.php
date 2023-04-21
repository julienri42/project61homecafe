<?php
session_start();
include('../../assets/connect/conn.php');
$_SESSION['page'] = "product.php";
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
        เพิ่มข้อมูลสินค้า
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
   

    <link href="../../assets/css/body1.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <link href="../../assets/css/employee1.css" rel="stylesheet">
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
                                <h2 class='col-6'>เพิ่มข้อมูลสินค้า</h2>
                            </div>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <!-- เนื้อหา -->
                            <center>
                                <form action='edit_product_ck.php' method='post' enctype='multipart/form-data'>
                                    <?php
                                    echo "<hr class='bg-dark'>";
                                    $product_id = $_GET['id'];
                                    $sql = "SELECT * FROM tb_product_list  WHERE product_id='$product_id'";
                                    $result = mysqli_query($connect, $sql);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<table class=''>";
                                    echo " <colgroup>
                                             <col width='50%'>
                                             <col width=''>
                                           </colgroup> ";
                                    echo "<tr class=''>";
                                    echo "<td class=''><p class='p-3 fs-4 text-dark text-end'>ชื่อสินค้า: :</p></td>";
                                    echo "<td class=''><p class=' fs-4 text-dark col-6'><input type='text' value='".$row['product_name']."' id='product_name' class='form-control fs-4'  name='product_name' placeholder='กรุณากรอกชื่อสินค้า'></p></td>";
                                    echo "</tr>";
                                    echo "<tr id='showproduct_name'>";
                                    echo "<td></td>";
                                    echo "<td><div class='text-danger fs-4 mb-2'>*กรุณากรอกชื่อสินค้า</div></td>";
                                    echo "</tr>";
                                    echo "<tr class=''>";
                                    echo "<td class=''><p class='p-3 fs-4 text-dark text-end'>ประเภทสินค้า :</p></td>";
                                    echo "<td class=''><p class=' fs-4 text-dark col-6'>";
                                    echo "<select name='typeproduct_id' class='form-select fs-4' id='typeproduct_id'>";
                                    echo "<option value='' >กรุณาประเภทสินค้า</option>";
                                    $sql2="SELECT * FROM tb_typeproduct";
                                    $result2= mysqli_query($connect, $sql2);
                                    while ($row2 = mysqli_fetch_assoc($result2)) {
                                        if($row['typeproduct_id']==$row2['typeproduct_id'])
                                        {
                                            echo "<option value='".$row2['typeproduct_id']."' selected>".$row2['typeproduct_name']."</option>";
                                        }
                                        else
                                        {
                                            echo "<option value='".$row2['typeproduct_id']."' >".$row2['typeproduct_name']."</option>";
                                        }
                                        
                                    }
                                    echo "</select>";
                                    echo "</p></td>";
                                    echo "</tr>";
                                    echo "<tr id='showtypeproduct_id'>";
                                    echo "<td></td>";
                                    echo "<td><div class='text-danger fs-4 mb-2'>*กรุณาเลือกประเภทสินค้า</div></td>";
                                    echo "</tr>";
                                    echo "<tr>";
                                    echo "<td ><p class='p-3 fs-4 text-dark text-end'>รายละเอียดสินค้า :</p></td>";
                                    echo "<td ><p class='fs-4 text-dark col-6'> <textarea id='product_description'  name='product_description' rows='4' cols='50' class='form-control  fs-4' placeholder='กรุณากรอกรายละเอียด' >".$row['product_description']." </textarea></p></td>";
                                    echo "</tr>";
                                    echo "<tr id='showproduct_description'>";
                                    echo "<td></td>";
                                    echo "<td><div class='text-danger fs-4 mb-2'>*กรุณากรอกรายละเอียด</div></td>";
                                    echo "</tr>";
                                    echo "<tr class=''>";
                                    echo "<td class=''><p class='p-3 fs-4 text-dark text-end'>ราคาสินค้า :</p></td>";
                                    echo "<td class=''><p class=' fs-4 text-dark col-6'><input  id='product_price' value='".$row['product_price']."' class='form-control fs-4' type='number' placeholder='กรุณากรอกราคาสินค้า' name='product_price' ></p></td>";
                                    echo "</tr>";
                                    echo "<tr id='showproduct_price'>";
                                    echo "<td></td>";
                                    echo "<td><div class='text-danger fs-4 mb-2'>*กรุณากรอกราคาสินค้า</div></td>";
                                    echo "</tr>";
                                    echo "<tr class=''>";
                                    echo "<td class=''><p class='p-3 fs-4 text-dark text-end'>หน่วยสินค้า :</p></td>";
                                    echo "<td class=''><p class=' fs-4 text-dark col-6'>";
                                    echo "<select name='product_unit'  class='form-select fs-4' id='product_unit'>";
                                    echo "<option value='' >กรุณาเลือกหน่วย</option>";
                                    if($row['product_unit']=="ชิ้น")
                                    {
                                        echo "<option value='ชิ้น' selected>ชิ้น</option>";
                                        echo "<option value='ปอนด์' >ปอนด์</option>";
                                        echo "<option value='ถุง' >ถุง</option>";
                                        echo "<option value='แพ็ค' >แพ็ค</option>";
                                        echo "<option value='อื่นๆ' >อื่นๆ</option>";
                                    }
                                    else if($row['product_unit']=="ปอนด์")
                                    {
                                        echo "<option value='ชิ้น' >ชิ้น</option>";
                                        echo "<option value='ปอนด์' selected>ปอนด์</option>";
                                        echo "<option value='ถุง' >ถุง</option>";
                                        echo "<option value='แพ็ค' >แพ็ค</option>";
                                        echo "<option value='อื่นๆ' >อื่นๆ</option>";
                                    }
                                    else if ($row['product_unit']=="ถุง")
                                    {
                                        echo "<option value='ชิ้น' >ชิ้น</option>";
                                        echo "<option value='ปอนด์' >ปอนด์</option>";
                                        echo "<option value='ถุง' selected>ถุง</option>";
                                        echo "<option value='แพ็ค' >แพ็ค</option>";
                                        echo "<option value='อื่นๆ' >อื่นๆ</option>";
                                    }
                                    else if($row['product_unit']=="แพ็ค")
                                    {
                                        echo "<option value='ชิ้น' >ชิ้น</option>";
                                        echo "<option value='ปอนด์' >ปอนด์</option>";
                                        echo "<option value='ถุง' >ถุง</option>";
                                        echo "<option value='แพ็ค' selected>แพ็ค</option>";
                                        echo "<option value='อื่นๆ' >อื่นๆ</option>";
                                    }
                                    else 
                                    {
                                        echo "<option value='ชิ้น' >ชิ้น</option>";
                                        echo "<option value='ปอนด์' >ปอนด์</option>";
                                        echo "<option value='ถุง' >ถุง</option>";
                                        echo "<option value='แพ็ค' >แพ็ค</option>";
                                        echo "<option value='อื่นๆ' selected>อื่นๆ</option>";
                                    }
                                    echo "</select>";
                                    echo "</p></td>";
                                    echo "</tr>";
                                    if($row['product_unit']!="ชิ้น"&& $row['product_unit']!="ปอนด์" && $row['product_unit']!="ถุง"
                                    && $row['product_unit']!="แพ็ค")
                                    {
                                        echo "<tr  id='typeunit'>";
                                        echo "<td ><p class='p-3 fs-4 text-dark text-end'>เขียนหน่วยสินค้า :</p></td>";
                                        echo "<td ><p class='fs-4 text-dark col-6'> <input type='text' name='otherunit' class='form-control fs-4' value='".$row['product_unit']."'></td>";
                                        echo "</tr>";
                                    }
                                    else
                                    {
                                        echo "<tr  id='typeunit'>";
                                        echo "<td ><p class='p-3 fs-4 text-dark text-end'>เขียนหน่วยสินค้า :</p></td>";
                                        echo "<td ><p class='fs-4 text-dark col-6'> <input type='text' name='otherunit' class='form-control'></td>";
                                        echo "</tr>";  
                                    }
                                    
                                    echo "<tr id='showproduct_unit'>";
                                    echo "<td></td>";
                                    echo "<td><div class='text-danger fs-4 mb-2'>*กรุณาเลือกหน่วย</div></td>";
                                    echo "</tr>";
                                    echo "<tr class=''>";
                                    echo "<td class=''><p class='p-3 fs-4 text-dark text-end'>รูปแบบสินค้า:</p></td>";
                                    echo "<td class=''><p class=' fs-4 text-dark col-6'>";
                                    echo "<select name='product_make'  class='form-select fs-4' id='product_make'>";
                                    echo "<option value='' >กรุณาเลือกรูปแบบสินค้า</option>";
                                    if($row['product_make']=="ทำเอง")
                                    {
                                        echo "<option value='ทำเอง' selected>ทำเอง</option>";
                                        echo "<option value='รับมาขาย' >รับมาขาย</option>";
                                    }
                                    else {
                                        echo "<option value='ทำเอง' >ทำเอง</option>";
                                        echo "<option value='รับมาขาย' selected>รับมาขาย</option>";
                                    }
                                    echo "</select>";
                                    echo "</p></td>";
                                    echo "</tr>";
                                    echo "<tr id='showproduct_make'>";
                                    echo "<td></td>";
                                    echo "<td><div class='text-danger fs-4 mb-2'>*กรุณาเลือกรูปแบบสินค้า</div></td>";
                                    echo "</tr>";
                                    echo "</tr>";
                                    echo "<tr class=''>";
                                    echo "<td class=''><p class='p-3 fs-4 text-dark text-end'>สถานะการออกขายสินค้า :</p></td>";
                                    echo "<td class=''><p class=' fs-4 text-dark col-6'>";
                                    echo "<select name='product_status'  class='form-select fs-4' id='product_status'>";
                                    if($row['product_status']=="เปิดขาย")
                                    {
                                        echo "<option value='เปิดขาย' selected>เปิดขาย</option>";
                                        echo "<option value='ยังไม่เปิดขาย' >ยังไม่เปิดขาย</option>";
                                    }
                                    else
                                    {
                                        echo "<option value='เปิดขาย' >เปิดขาย</option>";
                                        echo "<option value='ยังไม่เปิดขาย' selected>ยังไม่เปิดขาย</option>";
                                    }
                                    echo "</select>";
                                    echo "</p></td>";
                                    echo "</tr>";
                                    echo "<tr>";
                                    echo "<td></td>";
                                    if (!empty($row['product_img'])) {
                                        echo "<td><img src='../../assets/img/product/" . $row['product_img'] . "' class='img-profile rounded-circle' height='200' width='200'></td>";
                                    } else {
                                        echo "<td><img src='../../assets/img/product/noproduct.png' class='img-profile rounded-circle ' height='200' width='200'></td>";
                                    }
                                    echo "</tr>";
                                    echo "<tr>";
                                    echo "<td ><p class='p-3 fs-4 text-dark text-end'>รูปภาพสินค้า :</p></td>";
                                    echo "<td ><p class='fs-4 text-dark col-6'> <input class='form-control' type='file' name='product_img' ></p></td>";
                                    echo "</tr>";
                                    echo "</table>";
                                    echo "<hr class='bg-dark' >";
                                    echo "<p class='text-center'>";
                                    echo "<button type='button' id='chk'  class='btn btn-lg btn-primary me-md-2'>เพิ่ม</button>";
                                    echo "<a class='btn btn-lg btn-danger' href='product.php'>ยกเลิก</a>";
                                    echo "</p>";
                                    echo "<input type='hidden' name='product_id'  value='".$row['product_id']."'>";
                                    echo "<input type='hidden' name='product_img2'  value='".$row['product_img']."'>";
                                }
                                    ?>
                            </center>

                            <!--ยืนยันแก้ไขข้อมูล -->
                            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">แก้ไขข้อมูลสินค้า</h5>
                                        </div>
                                        <div class="modal-body">คุณต้องการแก้ไขข้อมูลสินค้า?</div>
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
        $('#showproduct_name').hide(); 
        $('#showtypeproduct_id').hide(); 
        $('#showproduct_description').hide();
        $('#showproduct_price').hide();
        $('#showproduct_unit').hide();
        $('#showproduct_make').hide();
        if($('#product_unit').val()=="อื่นๆ")
        {
            $('#typeunit').show();
        }
        else
        {
            $('#typeunit').hide();
        }
        

        $('#product_unit').change(function() {
            var product_unit = $(this).val();
            if(product_unit=="อื่นๆ")
            {
                $('#typeunit').show();
            }
            else{
                $('#typeunit').hide();
            }
        });

        $('#chk').on('click', function() {
            $('#showproduct_name').hide(); 
        $('#showtypeproduct_id').hide(); 
        $('#showproduct_description').hide();
        $('#showproduct_price').hide();
        $('#showproduct_unit').hide();
        $('#showproduct_make').hide();
            if ($('#product_name').val() != '' && $('#typeproduct_id').val() != ''
                &&  $('#product_description').val() != '' && $('#product_price').val() != ''
                && $('#product_unit').val() != ''    && $('#product_make').val() != '' 
                ) {
                    $('#editModal').modal('show');
            } else {
                if ($('#product_name').val() == '') {
                    $('#showproduct_name').show();
                    window.location.href = '#product_name'
                }
                else if ($('#typeproduct_id').val() == ''){
                    $('#showtypeproduct_id').show();
                    window.location.href = '#typeproduct_id'
                }
                else if ($('#product_description').val() == ''){
                    $('#showproduct_description').show();
                    window.location.href = '#product_description'
                }
                else if ($('#product_price').val() == ''){
                    $('#showproduct_price').show();
                    window.location.href = '#product_price'
                }
                else if ($('#product_unit').val() == ''){
                    $('#showproduct_unit').show();
                    window.location.href = '#product_unit'
                }
                else if ($('#product_make').val() == ''){
                    $('#showproduct_make').show();
                    window.location.href = '#product_make'
                }

            }
        })
        $('#dis').on('click', function() {
            $('#editModal').modal('hide');
        })

       

    </script>
    


</body>

</html>