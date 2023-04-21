<?php
session_start();
include('../../assets/connect/conn.php');
$_SESSION['page'] = "users.php";
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
        จัดการข้อมูลสมาชิก
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
                                <h2 class='col-6'>แก้ไขข้อมูลสมาชิก</h2>
                            </div>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                             <!-- เนื้อหา -->
                             <center>
                                <form action='edit_users_ck.php' method='post' enctype='multipart/form-data'>
                                    <?php
                                    echo "<hr class='bg-dark'>";
                                    $user_id = $_GET['id'];
                                    $sql = "SELECT * FROM tb_user  WHERE user_id='$user_id'";
                                    $result = mysqli_query($connect, $sql);
                                    while ($row = mysqli_fetch_assoc($result)) {

                                       echo "<table class=''>";
                                    echo " <colgroup>
                                                <col width='50%'>
                                                <col width=''>
                                                </colgroup> ";
                                    echo "<tr class=''>";
                                    echo "<td class=''><p class='p-3 fs-4 text-dark text-end'>username :</p></td>";
                                    echo "<td class=''><p class=' fs-4 text-dark col-6'>".$row['user_username']."</td>";
                                    echo "</tr>";

                                    echo "<tr class=''>";
                                    echo "<td class=''><p class='p-3 fs-4 text-dark text-end'>password :</p></td>";
                                    echo "<td class=''><p class=' fs-4 text-dark col-6'><input id='user_password' class='form-control fs-4' type='password' name='user_password' value='".$row['user_password']."' placeholder='กรุณากรอกpassword'></p></td>";
                                    echo "</tr>";
                                    /////
                                    echo "<tr id='showuser_password'>";
                                    echo "<td></td>";
                                    echo "<td><div class='text-danger fs-4 mb-2'>*กรุณากรอกpassword</div></td>";
                                    echo "</tr>";
                                    ///
                                    echo "<tr class=''>";
                                    echo "<td class=''><p class='p-3 fs-4 text-dark text-end'>คำนำหน้า :</p></td>";
                                    echo "<td class=''><p class=' fs-4 text-dark col-6'>";
                                    echo "<select name='user_title'  class='form-select fs-4' id='user_title'>";
                                    echo "<option value='' >กรุณาเลือกคำนำหน้า</option>";
                                    if($row['user_title']=="นาย")
                                    {
                                        echo "<option value='นาย' selected>นาย</option>";
                                        echo "<option value='นาง' >นาง</option>";
                                        echo "<option value='นางสาว' >นางสาว</option>";
                                    }
                                    else if($row['user_title']=="นาง")
                                    {
                                        echo "<option value='นาย' >นาย</option>";
                                        echo "<option value='นาง' selected>นาง</option>";
                                        echo "<option value='นางสาว' >นางสาว</option>";
                                    }
                                    else if($row['user_title']=="นางสาว")
                                    {
                                        echo "<option value='นาย' >นาย</option>";
                                        echo "<option value='นาง' >นาง</option>";
                                        echo "<option value='นางสาว' selected>นางสาว</option>";
                                    }
                                    echo "</select>";
                                    echo "</p></td>";
                                    echo "</tr>";
                                    /////
                                    echo "<tr id='showuser_title'>";
                                    echo "<td></td>";
                                    echo "<td><div class='text-danger fs-4 mb-2'>*กรุณากรอกคำนำหน้า</div></td>";
                                    echo "</tr>";
                                    ///
                                    echo "<tr class=''>";
                                    echo "<td class=''><p class='p-3 fs-4 text-dark text-end'>ชื่อ :</p></td>";
                                    echo "<td class=''><p class=' fs-4 text-dark col-6'><input  id='user_firstname' class='form-control fs-4' type='text' placeholder='กรุณากรอกชื่อ' value='".$row['user_firstname']."' name='user_firstname' ></p></td>";
                                    echo "</tr>";
                                    /////
                                    echo "<tr id='showuser_firstname'>";
                                    echo "<td></td>";
                                    echo "<td><div class='text-danger fs-4 mb-2'>*กรุณากรอกชื่อ</div></td>";
                                    echo "</tr>";
                                    ///
                                    echo "<tr class=''>";
                                    echo "<td class=''><p class='p-3 fs-4 text-dark text-end'>นามสกุล :</p></td>";
                                    echo "<td class=''><p class=' fs-4 text-dark col-6'><input id='user_surname' class='form-control fs-4' type='text' placeholder='กรุณากรอกนามสกุล' name='user_surname' value='".$row['user_surname']."' ></p></td>";
                                    echo "</tr>";
                                    /////
                                    echo "<tr id='showuser_surname'>";
                                    echo "<td></td>";
                                    echo "<td><div class='text-danger fs-4 mb-2'>*กรุณากรอกนามสกุล</div></td>";
                                    echo "</tr>";
                                    ///
                                    
                                    echo "<tr>";
                                    echo "<td ><p class='p-3 fs-4 text-dark text-end'>เบอร์โทร :</p></td>";
                                    echo "<td ><p class='fs-4 text-dark col-6'><input id='user_tel' value='".$row['user_tel']."' class='form-control fs-4' type='tel' name='user_tel' minlength='9' maxlength='10' onKeyPress='CheckNum()' placeholder='กรุณากรอกเบอร์โทร'></p></td>";
                                    echo "</tr>";

                                    echo "<tr id='showtel'>";
                                    echo "<input type='hidden' id='chktel' value='3'>";
                                    echo "</tr>";
                                    echo "<tr>";
                                    echo "<td ><p class='p-3 fs-4 text-dark text-end'>อีเมล :</p></td>";
                                    echo "<td ><p class='fs-4 text-dark col-6'><input  id='user_email' value='".$row['user_email']."' class='form-control fs-4' type='email' name='user_email' placeholder='กรุณากรอกอีเมล์'></p></td>";
                                    echo "</tr>";
                                    echo "<tr id='showemail'>";
                                    echo "<input type='hidden' id='chkemail' value='3'>";
                                    echo "</tr>";
                                    ///
                                    echo "<tr>";
                                    echo "<td></td>";
                                    if (!empty($row['user_img'])) {
                                        echo "<td><img src='../../assets/img/user/" . $row['user_img'] . "' class='img-profile rounded-circle' height='200' width='200'></td>";
                                    } else {
                                        echo "<td><img src='../../assets/img/user/user.png' class='img-profile rounded-circle ' height='200' width='200'></td>";
                                    }
                                    echo "</tr>";
                                     /////
                                     echo "<tr id='showuser_address'>";
                                     echo "<td></td>";
                                     echo "<td><div class='text-danger fs-4 mb-2'>*กรุณากรอกที่อยู่</div></td>";
                                     echo "</tr>";
                                     ///
                                    echo "<tr>";
                                    echo "<td ><p class='p-3 fs-4 text-dark text-end'>รูปภาพ :</p></td>";
                                    echo "<td ><p class='fs-4 text-dark col-6'> <input class='form-control' type='file' name='user_img' ></p></td>";
                                    echo "</tr>";
                                    echo "<tr>";
                                    echo "<td ><p class='p-3 fs-4 text-dark text-end'>ประเภทสมาชิก :</p></td>";
                                    echo "<td ><p class='fs-4 text-dark col-6'>";
                                    echo "<select id='usertype_id' name='usertype_id' class='form-select fs-4 '>";
                                        echo "<option value='' selected>กรุณาเลือกตำแหน่ง</option>";

                                        $sql2='SELECT * FROM tb_usertype';
                                        $result2= mysqli_query($connect, $sql2);
                                        while ($row2 = mysqli_fetch_assoc($result2)) {
                                            $usertype_id=$row['usertype_id'];
                                            $usertype_id2=$row2['usertype_id'];
                                            if($usertype_id==$usertype_id2)
                                            {
                                                echo "<option value='".$row2['usertype_id']."' selected>".$row2['usertype_name']."</option>";
                                            }
                                            else{
                                                echo "<option value='".$row2['usertype_id']."'>".$row2['usertype_name']."</option>";
                                            }
                                            
                                        }
                                    echo "</select>";
                                    echo "</p></td>";
                                    echo "</tr>";
                                    /////
                                    echo "<tr id='showusertype_id'>";
                                    echo "<td></td>";
                                    echo "<td><div class='text-danger fs-4 mb-2'>*กรุณาเลือกประเภท</div></td>";
                                    echo "</tr>";
                                    ///
                                    echo "</table>";
                                        echo "<input class='form-control' type='hidden' name='user_id'  value='" . $row['user_id'] . "'>";
                                        echo "<input class='form-control' type='hidden' name='user_img2'  value='" . $row['user_img'] . "'>";
                                        echo "<input class='form-control' type='hidden' name='user_tel2' id='user_tel2'  value='" . $row['user_tel'] . "'>";
                                        echo "<input class='form-control' type='hidden' name='user_email2' id='user_email2'  value='" . $row['user_email'] . "'>";   
                                        echo "<hr class='bg-dark' >";
                                       
                                        echo "<p class='text-center'>";
                                        echo "<button type='button' id='chk'  class='btn btn-lg btn-primary me-md-2'>บันทึก</button>";
                                        echo "<a class='btn btn-lg btn-danger' href='users.php'>ยกเลิก</a>";
                                        echo "</p>";
                                    }
                                    ?>
                            </center>
                            
                            <!--ยืนยันแก้ไขข้อมูล -->
                            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">บันทึกข้อมูลสมาชิก</h5>
                                        </div>
                                        <div class="modal-body">คุณต้องการบันทึกข้อมูลสมาชิก?</div>
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

        $( "#user_tel" ).keyup(function(event) {
    
    var tel =  $( this ).val();
    var tel2 =  $('#user_tel2').val();
    if(tel==tel2)
    {
        $('#showtel').show();
        $('#showtel').html("<td><input type='hidden' id='chktel' value='1'></td><td><div class='text-primary fs-4 mb-2'>เบอร์โทรศัพท์นี้สามารถใช้งานได้</div></td>"); 
    }
    else
    {
        $.ajax({
        type: "POST",
        url: "ajaxselect.php",
        data: {id:tel,function:'user_tel'},
        success: function(data){
            $('#showtel').show();
            $('#showtel').html(data); 
           
            }
        });
    }

});

$( "#user_email" ).keyup(function(event) {
    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    var email =  $( this ).val();
    var email1 =  $('#user_email2').val();
    if (!regex.test($('#user_email').val())) {
                    $('#showtel').show();
                    var text = "<td><input type='hidden' id='chktel' value=''></td><td><div class='text-danger fs-4 mb-2'>*กรุณากรอกรูปแบบอีเมล์ให้ถูกต้อง</div></td>";
                    $('#showemail').html(text);
    }
    else if(email == email1)
    {
        $('#showemail').show();
        $('#showemail').html("<td><input type='hidden' id='chkemail' value='1'></td><td><div class='text-primary fs-4 mb-2'>อีเมล์นี้สามารถใช้งานได้</div></td>");         
    }
    else{
        $.ajax({
        type: "POST",
        url: "ajaxselect.php",
        data: {id:email,function:'user_email'},
        success: function(data){
            $('#showemail').show();
            $('#showemail').html(data); 
           
        }
    });
    }

});
    </script>
    <script>
        $('#showuser_password').hide(); 
        $('#showuser_title').hide(); 
        $('#showuser_firstname').hide(); 
        $('#showuser_surname').hide(); 
        $('#showuser_nickname').hide();
        $('#showuser_sex').hide();       
        $('#showuser_address').hide(); 
        $('#showusertype_id').hide(); 
        $('#showtel').hide(); 
        $('#showemail').hide(); 
        $('#showuser_birthdate').hide();
        $('#chk').on('click', function() {
            $('#showuser_password').hide(); 
            $('#showuser_title').hide(); 
            $('#showuser_firstname').hide(); 
            $('#showuser_surname').hide(); 
            $('#showuser_nickname').hide();
            $('#showuser_sex').hide();       
            $('#showuser_address').hide(); 
            $('#showusertype_id').hide(); 
            $('#showtel').hide(); 
            $('#showemail').hide(); 
            $('#showuser_birthdate').hide();
            if ($('#user_password').val() != '' && $('#user_title').val() != '' && $('#user_firstname').val() != '' && $('#user_surname').val() != '' &&
                $('#user_nickname').val() != '' && $('#user_sex').val() != '' && $('#user_tel').val() != '' &&
                $('#user_email').val() != '' && $('#user_birthdate').val() != '' &&
                $('#user_address').val() != ''  && $('#usertype_id').val() != '' && $('#chktel').val() != '' && $('#chkemail').val() != '') {
                var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                if (!regex.test($('#user_email').val())) {
                    $('#showemail').show(); 
                    $('#showemail').html("<td><input type='hidden' id='chkemail' value=''></td><td><div class='text-danger fs-4 mb-2'>*รูปแบบอีเมล์ไม่ถูกต้อง</div></td>"); 
                    window.location.href = '#showuser_email'
                   
                } else {
                    $('#editModal').modal('show');
                }

            } else {
                if ($('#user_password').val() == '') {
                    $('#showuser_password').show();
                    window.location.href = '#user_password'  
           
                }
                else if ($('#user_title').val() == '') {
                    $('#showuser_title').show();
                    window.location.href = '#user_title' 
           
                }
                else if ($('#user_firstname').val() == '') {
                    $('#showuser_firstname').show(); 
                    window.location.href = '#user_firstname' 
           
                }
                else if ($('#user_surname').val() == '') {
                    $('#showuser_surname').show();
                    window.location.href = '#user_surname' 
           
                }
                else if ($('#user_nickname').val() == '') {
                    $('#showuser_nickname').show();
                    window.location.href = '#user_nickname' 
            
                }
                else if ($('#user_sex').val() == '') {
                    $('#showuser_sex').show();
                    window.location.href = '#user_sex'  
           
                }
                else if ($('#user_tel').val() == '') {

                    $('#showtel').show(); 
                    $('#showtel').html("<td><input type='hidden' id='chktel' value=''></td><td><div class='text-danger fs-4 mb-2'>*กรุณากรอกเบอร์โทรศัพท์</div></td>");
                    window.location.href = '#user_tel'
           
                }

                else if ($('#user_email').val() == '') {
                    $('#showemail').show();
                    $('#showemail').html("<td><input type='hidden' id='chkemail' value=''></td><td><div class='text-danger fs-4 mb-2'>*กรุณากรอกอีเมล์</div></td>");
                    window.location.href = '#user_email'
                
                }
                else if ($('#user_birthdate').val() == '') {
                    $('#showuser_birthdate').show(); 
                    window.location.href = '#user_birthdate'
                 
                }

                else if ($('#user_address').val() == '') {
                    $('#showuser_address').show(); 
                    window.location.href = '#user_address'
                }
                else if ($('#usertype_id').val() == '') {
                    $('#showusertype_id').show();
                    window.location.href = '#usertype_id'

                }

            }
        })
        $('#dis').on('click', function() {
            $('#editModal').modal('hide');
        })

    </script>
    


</body>

</html>