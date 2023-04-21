<?php
session_start();
include('../assets/connect/conn.php');
$_SESSION['page'] = "admin_home.php";
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
    <link rel="icon" type="image/png" href="../assets/img/logoicon.ico">
    <title>
        61 home cafe หน้าหลัก
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="./assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
    <link href="../assets/css/admin_home.css" rel="stylesheet">
    <link href="../assets/css/body1.css" rel="stylesheet">
</head>

<body class="g-sidenav-show">
    <?php
    include("aside.php");
    ?>
    <main class="main-content position-relative border-radius-lg ">
        <?php
        include("nav.php");
        ?>
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h2>แก้ไขข้อมูลส่วนตัว</h2>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <!-- เนื้อหา -->
                            <center>
                                <form action='edit_employee_ck.php' method='post' enctype='multipart/form-data'>
                                    <?php
                                    echo "<hr class='bg-dark'>";
                                    $employee_id = $_SESSION["employee_id"];
                                    $sql = "SELECT * FROM tb_employee  WHERE employee_id='$employee_id'";
                                    $result = mysqli_query($connect, $sql);
                                    while ($row = mysqli_fetch_assoc($result)) {

                                        echo "<table class=''>";
                                        echo " <colgroup>
                                                <col width='50%'>
                                                <col width=''>
                                                </colgroup> ";
                                        echo "<tr class=''>";
                                        echo "<td class=''><p class='p-3 fs-4 text-dark text-end'>username :</p></td>";
                                        echo "<td class=''><p class=' fs-4 text-dark col-6'>" . $row['employee_username'] . "</p></td>";
                                        echo "</tr>";
                                        echo "<tr class=''>";
                                        echo "<td class=''><p class='p-3 fs-4 text-dark text-end'>password :</p></td>";
                                        echo "<td class=''><p class=' fs-4 text-dark col-6'><input id='employee_password' class='form-control fs-4' type='password' name='employee_password'  value='" . $row['employee_password'] . "'></p></td>";
                                        echo "</tr>";
                                        echo "<tr class=''>";
                                        echo "<td class=''><p class='p-3 fs-4 text-dark text-end'>คำนำหน้า :</p></td>";
                                        echo "<td class=''><p class=' fs-4 text-dark col-6'>";
                                        echo "<select name='employee_title'  class='form-select fs-4' id='employee_title'>";
                                        if ($row['employee_title'] == 'นาย') {
                                            echo "<option value='นาย' selected>นาย</option>";
                                            echo "<option value='นาง' >นาง</option>";
                                            echo "<option value='นางสาว' >นางสาว</option>";
                                        } elseif ($row['employee_title'] == 'นาง') {
                                            echo "<option value='นาย' >นาย</option>";
                                            echo "<option value='นาง' selected>นาง</option>";
                                            echo "<option value='นางสาว' >นางสาว</option>";
                                        } elseif ($row['employee_title'] == 'นางสาว') {
                                            echo "<option value='นาย' >นาย</option>";
                                            echo "<option value='นาง' >นาง</option>";
                                            echo "<option value='นางสาว' selected>นางสาว</option>";
                                        }
                                        echo "</select>";
                                        echo "</p></td>";
                                        echo "</tr>";
                                        echo "<tr class=''>";
                                        echo "<td class=''><p class='p-3 fs-4 text-dark text-end'>ชื่อ :</p></td>";
                                        echo "<td class=''><p class=' fs-4 text-dark col-6'><input  id='employee_firstname' class='form-control fs-4' type='text' name='employee_firstname'  value='" . $row['employee_firstname'] . "'></p></td>";
                                        echo "</tr>";
                                        echo "<tr class=''>";
                                        echo "<td class=''><p class='p-3 fs-4 text-dark text-end'>นามสกุล :</p></td>";
                                        echo "<td class=''><p class=' fs-4 text-dark col-6'><input id='employee_surname' class='form-control fs-4' type='text' name='employee_surname'  value='" . $row['employee_surname'] . "'></p></td>";
                                        echo "</tr>";
                                        echo "<tr>";
                                        echo "<td ><p class='p-3 fs-4 text-dark text-end'>เบอร์โทร :</p></td>";
                                        echo "<td ><p class='fs-4 text-dark col-6'><input id='employee_tel' class='form-control fs-4' type='tel' name='employee_tel' minlength='9' maxlength='10' onKeyPress='CheckNum()'  value='" . $row['employee_tel'] . "'></p></td>";
                                        echo "</tr>";
                                        echo "<tr>";
                                        echo "<td ><p class='p-3 fs-4 text-dark text-end'>อีเมล :</p></td>";
                                        echo "<td ><p class='fs-4 text-dark col-6'><input  id='employee_email' class='form-control fs-4' type='email' name='employee_email'  value='" . $row['employee_email'] . "'></p></td>";
                                        echo "</tr>";
                                     
                                        echo "<tr>";
                                        echo "<td ><p class='p-3 fs-4 text-dark text-end'>วันเดือนปีที่เข้าทำงาน :</p></td>";
                                        echo "<td ><p class='fs-4 text-dark col-6'><input id='employee_workdate' class='form-control fs-4' type='date' name='employee_workdate'  value='" . $row['employee_workdate'] . "'></p></td>";
                                        echo "</tr>";
                                      
                                        echo "<tr>";
                                        echo "<td></td>";
                                        if (!empty($_SESSION['employee_img'])) {
                                            echo "<td><img src='../assets/img/employee/" . $row['employee_img'] . "' class='img-profile rounded-circle' height='200' width='200'></td>";
                                        } else {
                                            echo "<td><img src='../assets/img/user/user.png' class='img-profile rounded-circle ' height='200' width='200'></td>";
                                        }
                                        echo "</tr>";
                                        echo "<tr>";
                                        echo "<td ><p class='p-3 fs-4 text-dark text-end'>รูปภาพ :</p></td>";
                                        echo "<td ><p class='fs-4 text-dark col-6'> <input class='form-control' type='file' name='employee_img' ></p></td>";
                                        echo "</tr>";
                                        echo "</table>";
                                        echo "<input class='form-control' type='hidden' name='employee_id'  value='" . $row['employee_id'] . "'>";
                                        echo "<input class='form-control' type='hidden' name='employee_img2'  value='" . $row['employee_img'] . "'>";
                                        echo "<div class='col-6' id='alertchk'>";
                                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <span class="fs-4 text-white" id="alerttext"></span>
                                        <button type="button" class="close mt-2" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>';
                                        echo "</div>";
                                       
                                        echo "<hr class='bg-dark' >";
                                       
                                        echo "<p class='text-center'>";
                                        echo "<button type='button' id='chk'  class='btn btn-lg btn-primary me-md-2'>บันทึก</button>";
                                        echo "<a class='btn btn-lg btn-danger' href='admin_home.php'>ยกเลิก</a>";
                                        echo "</p>";
                                    }
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
    <script src="./assets/js/core/popper.min.js"></script>
    <script src="./assets/js/core/bootstrap.min.js"></script>
    <script src="./assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="./assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="./assets/js/plugins/chartjs.min.js"></script>

    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="./assets/js/argon-dashboard.min.js?v=2.0.4"></script>



    <!-- Bootstrap core JavaScript-->
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../assets/js/sb-admin-2.min.js"></script>
    <script language="javascript">
        function CheckNum() {
            if (event.keyCode < 48 || event.keyCode > 57) {
                event.returnValue = false;
            }
        }
    </script>
    <script>
    $('#alertchk').hide();
    $('#chk').on('click',function(){
        if($('#employee_password').val() !=''&& $('#employee_title').val() !='' && $('#employee_firstname').val() !='' && $('#employee_surname').val() !='' 
            && $('#employee_nickname').val() !='' && $('#employee_sex').val() !='' && $('#employee_tel').val() !='' 
            && $('#employee_email').val() !='' && $('#employee_birthdate').val() !='' && $('#employee_workdate').val() !=''
            && $('#employee_address').val() !='' ){
            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if(!regex.test($('#employee_email').val())) {
                $('#alertchk').show(); 
                var text ="กรุณากรอกรูปแบบอีเมล์ให้ถูกต้อง"; 
                $('#alerttext').html(text);          
            }else{
                $('#editModal').modal('show');
            }
           
        }
        else{
            $('#alertchk').show();
            var text ="กรุณากรอก ";
            if($('#employee_password').val() =='')
            {
                text+=" password";
            }
            if($('#employee_title').val() =='')
            {
                text+=" คำนำหน้า";
            }
            if($('#employee_firstname').val() =='')
            {
                text+=" ชื่อ";
            }
            if($('#employee_surname').val() =='')
            {
                text+=" นามสกุล";
            }
            if($('#employee_nickname').val() =='')
            {
                text+=" ชื่อเล่น";
            }
            if($('#employee_sex').val() =='')
            {
                text+=" เพศ";
            }
            if($('#employee_tel').val() =='')
            {
                text+=" เบอร์โทร";
            }
            if($('#employee_email').val() =='')
            {
                text+=" อีเมล์";
            }
            if($('#employee_birthdate').val() =='')
            {
                text+=" วันเดือนปีเกิด";
            }
            if($('#employee_workdate').val() =='')
            {
                text+=" วันที่เข้าทำงาน";
            }
            if($('#employee_address').val() =='')
            {
                text+=" ที่อยู่";
            }
            text+=" ให้ครบ";
            
            $('#alerttext').html(text);
            
        }
    })
    $('#dis').on('click',function(){
        $('#editModal').modal('hide');
    })
    </script>



</body>

</html>