<?php
session_start();
include('../../assets/connect/conn.php');
$_SESSION['page'] = "employee.php";
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
        จัดการข้อมูลพนักงาน
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
                                <h2 class='col-6'>จัดการข้อมูลพนักงาน</h2>


                            </div>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <!-- เนื้อหา -->
                            <center>
                                <form action='add_employee_ck.php' method='post' enctype='multipart/form-data'>
                                    <?php
                                    echo "<hr class='bg-dark'>";
                                    echo "<table class=''>";
                                    echo " <colgroup>
                                                <col width='50%'>
                                                <col width=''>
                                                </colgroup> ";
                                    echo "<tr class=''>";
                                    echo "<td class=''><p class='p-3 fs-4 text-dark text-end'>username :</p></td>";
                                    echo "<td class=''><p class=' fs-4 text-dark col-6'><input type='text' id='checkusername' class='form-control fs-4'  name='employee_username' placeholder='กรุณากรอกusername'></p></td>";
                                    echo "</tr>";
                                    echo "<tr id='showusername'>";
                                    echo "<input type='hidden' id='chkusers' value=''>";
                                    echo "</tr>";
                                    echo "<tr class=''>";
                                    echo "<td class=''><p class='p-3 fs-4 text-dark text-end'>password :</p></td>";
                                    echo "<td class=''><p class=' fs-4 text-dark col-6'><input id='employee_password' class='form-control fs-4' type='password' name='employee_password' placeholder='กรุณากรอกpassword'></p></td>";
                                    echo "</tr>";
                                    /////
                                    echo "<tr id='showemployee_password'>";
                                    echo "<td></td>";
                                    echo "<td><div class='text-danger fs-4 mb-2'>*กรุณากรอกpassword</div></td>";
                                    echo "</tr>";
                                    ///
                                    echo "<tr class=''>";
                                    echo "<td class=''><p class='p-3 fs-4 text-dark text-end'>คำนำหน้า :</p></td>";
                                    echo "<td class=''><p class=' fs-4 text-dark col-6'>";
                                    echo "<select name='employee_title'  class='form-select fs-4' id='employee_title'>";
                                    echo "<option value='' selected>กรุณาเลือกคำนำหน้า</option>";
                                    echo "<option value='นาย' >นาย</option>";
                                    echo "<option value='นาง' >นาง</option>";
                                    echo "<option value='นางสาว' >นางสาว</option>";
                                    echo "</select>";
                                    echo "</p></td>";
                                    echo "</tr>";
                                    /////
                                    echo "<tr id='showemployee_title'>";
                                    echo "<td></td>";
                                    echo "<td><div class='text-danger fs-4 mb-2'>*กรุณาเลือกคำนำหน้า</div></td>";
                                    echo "</tr>";
                                    ///
                                    echo "<tr class=''>";
                                    echo "<td class=''><p class='p-3 fs-4 text-dark text-end'>ชื่อ :</p></td>";
                                    echo "<td class=''><p class=' fs-4 text-dark col-6'><input  id='employee_firstname' class='form-control fs-4' type='text' placeholder='กรุณากรอกชื่อ' name='employee_firstname' ></p></td>";
                                    echo "</tr>";
                                    /////
                                    echo "<tr id='showemployee_firstname'>";
                                    echo "<td></td>";
                                    echo "<td><div class='text-danger fs-4 mb-2'>*กรุณากรอกชื่อ</div></td>";
                                    echo "</tr>";
                                    ///
                                    echo "<tr class=''>";
                                    echo "<td class=''><p class='p-3 fs-4 text-dark text-end'>นามสกุล :</p></td>";
                                    echo "<td class=''><p class=' fs-4 text-dark col-6'><input id='employee_surname' class='form-control fs-4' type='text' placeholder='กรุณากรอกนามสกุล' name='employee_surname'  ></p></td>";
                                    echo "</tr>";
                                    /////
                                    echo "<tr id='showemployee_surname'>";
                                    echo "<td></td>";
                                    echo "<td><div class='text-danger fs-4 mb-2'>*กรุณากรอกนามสกุล</div></td>";
                                    echo "</tr>";
                                    ///
                                    echo "<tr>";
                                    echo "<td ><p class='p-3 fs-4 text-dark text-end'>เบอร์โทร :</p></td>";
                                    echo "<td ><p class='fs-4 text-dark col-6'><input id='employee_tel' class='form-control fs-4' type='tel' name='employee_tel' minlength='9' maxlength='10' onKeyPress='CheckNum()' placeholder='กรุณากรอกเบอร์โทร'></p></td>";
                                    echo "</tr>";
                                    /////
                                    echo "<tr id='showemployee_tel'>";
                                    echo "<td></td>";
                                    echo "<td><div class='text-danger fs-4 mb-2'>*กรุณากรอกเบอร์โทร</div></td>";
                                    echo "</tr>";
                                    ///
                                    echo "<tr>";
                                    echo "<td ><p class='p-3 fs-4 text-dark text-end'>อีเมล :</p></td>";
                                    echo "<td ><p class='fs-4 text-dark col-6'><input  id='employee_email' class='form-control fs-4' type='email' name='employee_email' placeholder='กรุณากรอกอีเมล์'></p></td>";
                                    echo "</tr>";
                                    /////
                                    echo "<tr id='showemployee_email'>";
                                    echo "<td></td>";
                                    echo "<td><div class='text-danger fs-4 mb-2'>*กรุณากรอกอีเมล</div></td>";
                                    echo "</tr>";
                                    ///
                                   
                                    echo "<tr>";
                                    echo "<td ><p class='p-3 fs-4 text-dark text-end'>วันเดือนปีที่เข้าทำงาน :</p></td>";
                                    echo "<td ><p class='fs-4 text-dark col-6'><input id='employee_workdate' class='form-control fs-4' type='date' name='employee_workdate'></p></td>";
                                    echo "</tr>";
                                    /////
                                    echo "<tr id='showemployee_workdate'>";
                                    echo "<td></td>";
                                    echo "<td><div class='text-danger fs-4 mb-2'>*กรุณากรอกวันเดือนปีที่เข้าทำงาน</div></td>";
                                    echo "</tr>";
                                    ///
                                    echo "<tr>";
                                    echo "<td ><p class='p-3 fs-4 text-dark text-end'>รูปภาพ :</p></td>";
                                    echo "<td ><p class='fs-4 text-dark col-6'> <input class='form-control' type='file' name='employee_img' ></p></td>";
                                    echo "</tr>";
                                    echo "<tr>";
                                    echo "<td ><p class='p-3 fs-4 text-dark text-end'>เลือกตำแหน่ง :</p></td>";
                                    echo "<td ><p class='fs-4 text-dark col-6'>";
                                    echo "<select id='employee_position' name='employee_position' class='form-select fs-4 '>";
                                        echo "<option value='' selected>กรุณาเลือกตำแหน่ง</option>";
                                        echo "<option value='admin' >admin</option>"; 
                                        echo "<option value='พนักงาน' >พนักงาน</option>"; 
                                        echo "<option value='พนักงานจัดส่ง' >พนักงานจัดส่ง</option>"; 
                                        echo "<option value='เจ้าของร้าน' >เจ้าของร้าน</option>"; 
                                    echo "</select>";
                                    echo "</p></td>";
                                    echo "</tr>";
                                    /////
                                    echo "<tr id='showemployee_position'>";
                                    echo "<td></td>";
                                    echo "<td><div class='text-danger fs-4 mb-2'>*กรุณาเลือกตำแหน่ง</div></td>";
                                    echo "</tr>";
                                    ///
                                    echo "</table>";
                                    echo "<hr class='bg-dark' >";

                                    echo "<p class='text-center'>";
                                    echo "<button type='button' id='chk'  class='btn btn-lg btn-primary me-md-2'>บันทึก</button>";
                                    echo "<a class='btn btn-lg btn-danger' href='employee.php'>ยกเลิก</a>";
                                    echo "</p>";

                                    ?>
                            </center>

                            <!--ยืนยันแก้ไขข้อมูล -->
                            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">แก้ไขข้อมูลส่วนตัว</h5>
                                        </div>
                                        <div class="modal-body">คุณต้องการบันทึกข้อมูลส่วนตัว?</div>
                                        <div class="modal-footer">
                                            <input type='submit' value='บันทึก' class='btn btn-primary'>
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
    <script language="javascript">
        function CheckNum() {
            if (event.keyCode < 48 || event.keyCode > 57) {
                event.returnValue = false;
            }
        }
    </script>
    <script>
        $( "#checkusername" ).keyup(function(event) {
    
            var username =  $( this ).val();
            $.ajax({
                type: "POST",
                url: "ajaxselect.php",
                data: {id:username,function:'checkusername'},
                success: function(data){
                    $('#showusername').show();
                    $('#showusername').html(data); 
                   
                }
            });
        });
    </script>
    <script>
        $('#showusername').hide(); 
        $('#showemployee_password').hide(); 
        $('#showemployee_title').hide(); 
        $('#showemployee_firstname').hide(); 
        $('#showemployee_surname').hide(); 
        $('#showemployee_nickname').hide(); 
        $('#showemployee_sex').hide(); 
        $('#showemployee_tel').hide(); 
        $('#showemployee_birthdate').hide(); 
        $('#showemployee_workdate').hide(); 
        $('#showemployee_address').hide(); 
        $('#showemployee_position').hide(); 
        $('#showemployee_email').hide(); 


        $('#chk').on('click', function() {
            $('#showusername').hide(); 
            $('#showemployee_password').hide(); 
            $('#showemployee_title').hide(); 
            $('#showemployee_firstname').hide(); 
            $('#showemployee_surname').hide(); 
            $('#showemployee_nickname').hide(); 
            $('#showemployee_sex').hide(); 
            $('#showemployee_tel').hide(); 
            $('#showemployee_birthdate').hide(); 
            $('#showemployee_workdate').hide(); 
            $('#showemployee_address').hide(); 
            $('#showemployee_position').hide(); 
            $('#showemployee_email').hide(); 
            
            if ($('#employee_password').val() != '' && $('#employee_title').val() != '' && $('#employee_firstname').val() != '' && $('#employee_surname').val() != '' &&
                $('#employee_nickname').val() != '' && $('#employee_sex').val() != '' && $('#employee_tel').val() != '' &&
                $('#employee_email').val() != '' && $('#employee_birthdate').val() != '' && $('#employee_workdate').val() != '' &&
                $('#employee_address').val() != '' && $('#chkusers').val() != '' && $('#employee_position').val() != '') {
                var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                if (!regex.test($('#employee_email').val())) {
                    $('#showemployee_email').show();
                    $('#showusername').html("<td></td><td><div class='text-danger fs-4 mb-2'>*กรุณากรอกรูปแบบอีเมล์ให้ถูกต้อง</div></td>");
                    
                    
                } else {
                    $('#alertchk').hide();
                    $('#editModal').modal('show');
                }

            } else {
                
                if ($('#checkusername').val() == '') {
                    $('#showusername').show();
                    $('#showusername').html("<td><input type='hidden' id='chkusers' value=''></td><td><div class='text-danger fs-4 mb-2'>*กรุณากรอกusername</div></td>");
                    window.location.href = '#checkusername'
                }
                else if ($('#employee_password').val() == '') {
                    $('#showemployee_password').show(); 
                    window.location.href = '#employee_password'

                   
                }
                else if ($('#employee_position').val() == '') {
                    $('#showemployee_position').show(); 
                    window.location.href = '#employee_position'
            
                }
                
                else if ($('#employee_title').val() == '') {
                    $('#showemployee_title').show(); 
                    window.location.href = '#employee_title'
                }
                else if ($('#employee_firstname').val() == '') {
                    $('#showemployee_firstname').show(); 
                    window.location.href = '#employee_firstname'
            
                }
                else if ($('#employee_surname').val() == '') {
                    $('#showemployee_surname').show();
                    window.location.href = '#employee_surname'
            
                }
                else if ($('#employee_nickname').val() == '') {
                    $('#showemployee_nickname').show();
                    window.location.href = '#employee_nickname'
            
                }
                else if ($('#employee_sex').val() == '') {
                    $('#showemployee_sex').show();
                    window.location.href = '#employee_sex'
            
                }
                else if ($('#employee_tel').val() == '') {
                    $('#showemployee_tel').show(); 
                    window.location.href = '#employee_tel'
           
                }
                else if ($('#employee_email').val() == '') {
                    $('#showemployee_email').show();
                    window.location.href = '#employee_tel'
           
           
            
                }
                else if ($('#employee_birthdate').val() == '') {
                    $('#showemployee_birthdate').show();
                    window.location.href = '#employee_birthdate'
                }
                else if ($('#employee_workdate').val() == '') {
                    $('#showemployee_workdate').show(); 
                    window.location.href = '#employee_workdate'
                }
                else if ($('#employee_address').val() == '') {
                    $('#showemployee_address').show(); 
                    window.location.href = '#employee_address'
                }
                

            }
        })
        $('#dis').on('click', function() {
            $('#editModal').modal('hide');
        })

    </script>
    


</body>

</html>