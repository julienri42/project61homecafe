<?php
session_start();
include('../../assets/connect/conn.php');
$_SESSION['page'] = "material.php";
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
        เพิ่มข้อมูลวัตถุดิบ
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
                                <h2 class='col-6'>เพิ่มข้อมูลวัตถุดิบ</h2>
                            </div>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <!-- เนื้อหา -->
                            <center>
                                <form action='add_material_ck.php' method='post' enctype='multipart/form-data'>
                                    <?php
                                    echo "<hr class='bg-dark'>";
                                    echo "<table class=''>";
                                    echo " <colgroup>
                                             <col width='50%'>
                                             <col width=''>
                                           </colgroup> ";
                                    echo "<tr class=''>";
                                    echo "<td class=''><p class='p-3 fs-4 text-dark text-end'>ชื่อวัตถุดิบ :</p></td>";
                                    echo "<td class=''><p class=' fs-4 text-dark col-6'><input type='text' id='material_name' class='form-control fs-4'  name='material_name' placeholder='กรุณากรอกชื่อวัตถุดิบ'></p></td>";
                                    echo "</tr>";
                                    echo "<tr id='showmaterial_name'>";
                                    echo "<td></td>";
                                    echo "<td><div class='text-danger fs-4 mb-2'>*กรุณากรอกชื่อวัตถุดิบ</div></td>";
                                    echo "</tr>";
                                    echo "<tr class=''>";
                                    echo "<td class=''><p class='p-3 fs-4 text-dark text-end'>ประเภทวัตถุดิบ :</p></td>";
                                    echo "<td class=''><p class=' fs-4 text-dark col-6'>";
                                    echo "<select name='typematerial_id' class='form-select fs-4' id='typematerial_id'>";
                                    echo "<option value='' selected>กรุณาประเภทวัตถุดิบ</option>";
                                    $sql2="SELECT * FROM tb_typematerial";
                                    $result2= mysqli_query($connect, $sql2);
                                    while ($row2 = mysqli_fetch_assoc($result2)) {
                                        echo "<option value='".$row2['typematerial_id']."' >".$row2['typematerial_name']."</option>";
                                    }
                                    echo "</select>";
                                    echo "</p></td>";
                                    echo "</tr>";
                                    echo "<tr id='showtypematerial_id'>";
                                    echo "<td></td>";
                                    echo "<td><div class='text-danger fs-4 mb-2'>*กรุณาเลือกประเภทวัตถุดิบ</div></td>";
                                    echo "</tr>";

                                    echo "<tr>";
                                    echo "<td ><p class='p-3 fs-4 text-dark text-end'>รายละเอียดวัตถุดิบ :</p></td>";
                                    echo "<td ><p class='fs-4 text-dark col-6'> <textarea id='material_description'  name='material_description' rows='4' cols='50' class='form-control  fs-4' placeholder='กรุณากรอกรายละเอียด' ></textarea></p></td>";
                                    echo "</tr>";
                                    echo "<tr id='showmaterial_description'>";
                                    echo "<td></td>";
                                    echo "<td><div class='text-danger fs-4 mb-2'>*กรุณากรอกรายละเอียด</div></td>";
                                    echo "</tr>";
                                   
                                    echo "<tr class=''>";
                                    echo "<td class=''><p class='p-3 fs-4 text-dark text-end'>หน่วยที่ใช้ในวัตถุดิบ :</p></td>";
                                    echo "<td class=''><p class=' fs-4 text-dark col-6'>";
                                    echo "<select name='material_usedunit'  class='form-select fs-5' id='material_usedunit'>";
                                    echo "<option value='' selected>กรุณาเลือกหน่วยที่ใช้ในวัตถุดิบ</option>";
                                    echo "<option value='กรัม'>กรัม</option>";
                                    echo "<option value='ชิ้น'>ชิ้น</option>";
                                    echo "<option value='ฟอง'>ฟอง</option>";
                                    echo "<option value='มิลลิลิตร'>มิลลิลิตร</option>";
                                      echo "<option value='อื่นๆ'>อื่นๆ</option>";
                                    echo "</select>";
                                    echo "</p></td>";
                                    echo "</tr>";
                                    echo "<tr  id='typeusedunit'>";
                                    echo "<td ><p class='p-3 fs-4 text-dark text-end'>เขียนหน่วยที่ใช้ในวัตถุดิบ :</p></td>";
                                    echo "<td ><p class='fs-4 text-dark col-6'> <input type='text' name='otherusedunit' class='form-control fs-4'></td>";
                                    echo "</tr>";
                                    echo "<tr id='showmaterial_usedunit'>";
                                    echo "<td></td>";
                                    echo "<td><div class='text-danger fs-4 mb-2'>*กรุณาเลือกหน่วย</div></td>";
                                    echo "</tr>";
                                    

                                    echo "<tr class=''>";
                                    echo "<td class=''><p class='p-3 fs-4 text-dark text-end'>หน่วยที่รับเข้ามา :</p></td>";
                                    echo "<td class=''><p class=' fs-4 text-dark col-6'>";
                                    echo "<select name='material_buyunit'  class='form-select fs-5' id='material_buyunit'>";
                                    echo "<option value='' selected>กรุณาเลือกหน่วยที่รับเข้ามา</option>";
                                    echo "<option value='ถุง'>ถุง</option>";
                                    echo "<option value='แผง'>แผง</option>";
                                    echo "<option value='โหล'>โหล</option>";
                                    echo "<option value='แกลลอน'>แกลลอน</option>";
                                    echo "<option value='อื่นๆ'>อื่นๆ</option>";
                                    echo "</select>";
                                    echo "</p></td>";
                                    echo "</tr>";
                                    echo "<tr  id='typebuyunit'>";
                                    echo "<td ><p class='p-3 fs-4 text-dark text-end'>เขียนหน่วยที่รับเข้ามา :</p></td>";
                                    echo "<td ><p class='fs-4 text-dark col-6'><input type='text' name='otherbuyunit' class='form-control fs-4'></td>";
                                    echo "</tr>";
                                    echo "<tr id='showmaterial_buyunit'>";
                                    echo "<td></td>";
                                    echo "<td><div class='text-danger fs-4 mb-2'>(ถ้าไม่มีหน่วยที่รับมาวัตถุดิบให้ปล่อยวางไว้)</div></td>";
                                    echo "</tr>";

                                    echo "<tr class=''>";
                                    echo "<td class=''><p class='p-3 fs-4 text-dark text-end'>จำนวนที่รับเข้าต่อจำนวนที่ใช้ :</p></td>";
                                    echo "<td class=''><p class=' fs-4 text-dark col-6'><input  id='material_buyconversionused' class='form-control fs-4' type='text' placeholder='กรุณากรอกจำนวน' name='material_buyconversionused' ></p></td>";
                                    echo "</tr>";
                                    echo "<tr id='showmaterial_buyconversionused'>";
                                    echo "<td></td>";
                                    echo "<td><div class='text-danger fs-4 mb-2'>(ถ้าไม่มีหน่วยที่รับมาวัตถุดิบให้ปล่อยวางไว้)</div></td>";
                                    echo "</tr>";
                                    echo "</table>";
                                    echo "<hr class='bg-dark' >";

                                    echo "<p class='text-center'>";
                                    echo "<button type='button' id='chk'  class='btn btn-lg btn-primary me-md-2'>เพิ่ม</button>";
                                    echo "<a class='btn btn-lg btn-danger' href='material.php'>ยกเลิก</a>";
                                    echo "</p>";
                                    ?>
                            </center>

                            <!--ยืนยันแก้ไขข้อมูล -->
                            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">เพิ่มข้อมูลวัตถุดิบ</h5>
                                        </div>
                                        <div class="modal-body">คุณต้องการเพิ่มข้อมูลวัตถุดิบ?</div>
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
        $('#showmaterial_name').hide(); 
        $('#showtypematerial_id').hide(); 
        $('#showmaterial_description').hide();
        $('#showmaterial_usedunit').hide();
        $('#typeusedunit').hide();
        $('#typebuyunit').hide();

        $('#material_usedunit').change(function() {
            var usedunit = $(this).val();
            if(usedunit=="อื่นๆ")
            {
                $('#typeusedunit').show();
            }
            else{
                $('#typeusedunit').hide();
            }
        });
        $('#material_buyunit').change(function() {
            var buyunit = $(this).val();
            if(buyunit=="อื่นๆ")
            {
                $('#typebuyunit').show();
            }
            else{
                $('#typebuyunit').hide();
            }
        });
        
        $('#chk').on('click', function() {
            $('#showmaterial_name').hide(); 
            $('#showtypematerial_id').hide(); 
            $('#showmaterial_description').hide();
            $('#showmaterial_usedunit').hide();
            if ($('#material_name').val() != '' && $('#typematerial_id').val() != ''
                &&  $('#material_description').val() != '' && $('#material_usedunit').val() != '') 
            {
                    $('#editModal').modal('show');
            } else {

                if ($('#material_name').val() == '') {
                    $('#showmaterial_name').show();
                    window.location.href = '#material_name'
                }
                else if ($('#typematerial_id').val() == ''){
                    $('#showtypematerial_id').show();
                    window.location.href = '#typematerial_id'
                }
                else if ($('#material_description').val() == ''){
                    $('#showmaterial_description').show();
                    window.location.href = '#material_description'
                }
                else if ($('#material_usedunit').val() == ''){
                    $('#showmaterial_usedunit').show();
                    window.location.href = '#material_usedunit'
                }

            }
        })
        $('#dis').on('click', function() {
            $('#editModal').modal('hide');
        })

       

    </script>
    


</body>

</html>