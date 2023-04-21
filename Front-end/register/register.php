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
    <title>ล็อคอินเข้าสู่ระบบสมาชิก 61 home cafe</title>
    <link rel="icon" type="image/x-icon" href="../assets/favicon.ico" />
    <link href="../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../css/styles.css" rel="stylesheet">
    <link href="../css/index.css" rel="stylesheet">
    <link rel="stylesheet" href="../../style.css" />


</head>

<body>
<div class="container">
    <div class="row">
      <div class="col-lg-10 col-xl-9 mx-auto">
        <div class="card flex-row my-5 border-0 shadow rounded-3 overflow-hidden">
          <div class="card-img-left d-none d-md-flex">
            <!-- Background image for card set in CSS! -->
          </div>
          <div class="cardbody-color card-body p-4 p-sm-5">
            <h5 class="card-title text-center mb-5 fw-light fs-5">Register</h5>
            <form class="form-signin" action="register_ck.php" method="POST" enctype='multipart/form-data'>
                                <?php
                                if (isset($_SESSION['register_status'])) {
                                    echo '<div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                                <h5 class="alert-heading">' . $_SESSION['register_status'] . '</h5>    
                                </div>';
                                    unset($_SESSION['register_status']);
                                }
                                ?>
                                <div class="form-label-group">
                                    <label for="inputusername" class='mb-2'>username : </label>
                                    <input type="text" id="checkusername" class="form-control" placeholder="กรุณากรอกUsername" name="user_username">
                                </div>
                                <div class="form-label-group  mt-2" id='showusername'>

                                </div>
                                <div class="form-label-group mt-2">
                                    <label for="inputPassword" class='mb-2'>Password :</label>
                                    <input type="password" id="user_password" class="form-control" placeholder="กรุณากรอกPassword" name="user_password">
                                </div>
                                <div class="form-label-group mt-2" id='showpassword'>

                                </div>
                                <div class="form-label-group mt-2">
                                    <label for="user_title" class='mb-2'>คำนำหน้า :</label>
                                    <select name="user_title" id='user_title' class="form-select ">
                                        <option value="">กรุณาเลือกคำนำหน้า</option>
                                        <option>นาย</option>
                                        <option>นาง</option>
                                        <option>นางสาว</option>
                                    </select>
                                </div>
                                <div class="form-label-group mt-2" id='showuser_title'>

                                </div>
                                <div class="form-label-group mt-2">
                                    <label for="inputfirstname" class="mb-2">ชื่อ :</label>
                                    <input type="text" id="inputfirstname" class="form-control" placeholder="กรุณากรอกชื่อ" name="user_firstname">
                                </div>
                                <div class="form-label-group mt-2" id='showuser_firstname'>

                                </div>
                                <div class="form-label-group mt-2">
                                    <label for="inputsurname" class="mb-2">นามสกุล</label>
                                    <input type="text" id="user_surname" class="form-control" placeholder="กรุณากรอกนามสกุล" name="user_surname">
                                </div>
                                <div class="form-label-group mt-2" id='showuser_surname'>

                                </div>
                        
                                <div class="form-label-group mt-2">
                                    <label for="inputtel" class='mb-2'>เบอร์โทรศัพท์ :</label>
                                    <input type='tel' minlength='9' maxlength='10' onKeyPress='CheckNum()' id="user_tel" class="form-control" placeholder="กรุณากรอกเบอร์โทรศัพท์" name="user_tel">

                                </div>
                                <div class="form-label-group mt-2" id='showtel'>

                                </div>
                                <div class="form-label-group mt-2">
                                    <label for="inputemail" class='mb-2'>email :</label>
                                    <input type="email" id="user_email" class="form-control" placeholder="กรุณากรอกemail" name="user_email">
                                </div>
                                <div class="form-label-group mt-2" id='showemail'>

                                </div>
                                
                                <div class="form-label-group mt-2">
                                    <label for="inputimg" class='mb-2'>อัพโหลดไฟล์ภาพ :</label>
                                    <input type="file" id="inputimg" class="form-control" placeholder="img" name="user_img">
                                </div>
                                <br><br>
                                <center>
                                    <button class="btn btn-lg btn-success btn-block text-uppercase text-light" type="button" id='chk'>สมัครสมาชิก</button>
                                    <a class="btn btn-lg btn-danger btn-block text-uppercase text-light" href='../../index.php'>ยกเลิก</a>
                                </center>

                                <br>
                                <!--ยืนยันแก้ไขข้อมูล -->
                                <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">เพิ่มข้อมูลสมาชิก</h5>
                                            </div>
                                            <div class="modal-body">คุณต้องการเพิ่มข้อมูลสมาชิก?</div>
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
<script src="js/flyto.js"></script>
<script>
    $('.items').flyto({
        item: '.item1',
        target: '#cartnum',
        button: '.my-btn'
    });
</script>
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
            url: "../ajax_cart/show_cart.php",
            success: function(data) {
                $("#show_cart").html(data);
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
<script language="javascript">
    function CheckNum() {
        if (event.keyCode < 48 || event.keyCode > 57) {
            event.returnValue = false;
        }
    }
</script>
<script>
    $("#checkusername").keyup(function(event) {

        var username = $(this).val();
        if (username != "") {
            $.ajax({
                type: "POST",
                url: "ajaxselect.php",
                data: {
                    id: username,
                    function: 'checkusername'
                },
                success: function(data) {
                    $('#showusername').show();
                    $('#showusername').html(data);

                }
            });
        }


    });

    $("#user_tel").keyup(function(event) {

        var tel = $(this).val();
        if (tel != "") {
            $.ajax({
                type: "POST",
                url: "ajaxselect.php",
                data: {
                    id: tel,
                    function: 'user_tel'
                },
                success: function(data) {
                    $('#showtel').show();
                    $('#showtel').html(data);

                }
            });
        }

    });

    $("#user_email").keyup(function(event) {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        var email = $(this).val();
        if (!regex.test($('#user_email').val())) {
            $('#showemail').show();
            var text = "<div class='text-danger'>*กรุณากรอกรูปแบบอีเมล์ให้ถูกต้อง</div>";
            $('#showemail').html(text);
        } else {
            $.ajax({
                type: "POST",
                url: "ajaxselect.php",
                data: {
                    id: email,
                    function: 'user_email'
                },
                success: function(data) {
                    $('#showemail').show();
                    $('#showemail').html(data);

                }
            });
        }

    });
</script>
<script>
    $('#showusername').hide();
    $('#showpassword').hide();
    $('#showuser_title').hide();
    $('#showuser_firstname').hide();
    $('#showuser_surname').hide();
    $('#showuser_nickname').hide();
    $('#showuser_sex').hide();
    $('#showemail').hide();
    $('#showuser_birthdate').hide();
    $('#showuser_address').hide();
    $('#showtel').hide();

    $('#chk').on('click', function() {
        $('#showusername').hide();
        $('#showpassword').hide();
        $('#showuser_title').hide();
        $('#showuser_firstname').hide();
        $('#showuser_surname').hide();
        $('#showuser_nickname').hide();
        $('#showuser_sex').hide();
        $('#showemail').hide();
        $('#showuser_birthdate').hide();
        $('#showuser_address').hide();
        $('#showtel').hide();

        if ($('#user_password').val() != '' && $('#user_title').val() != '' && $('#user_firstname').val() != '' && $('#user_surname').val() != '' &&
            $('#user_nickname').val() != '' && $('#user_sex').val() != '' && $('#user_tel').val() != '' &&
            $('#user_email').val() != '' && $('#user_birthdate').val() != '' &&
            $('#user_address').val() != '' && $('#checkusername').val() != '') {
            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!regex.test($('#user_email').val())) {
                $('#alertchk').show();
                var text = "กรุณากรอกรูปแบบอีเมล์ให้ถูกต้อง";

                $('#alerttext').html(text);
            } else {
                $('#alertchk').hide();
                $('#editModal').modal('show');
            }

        } else {
            if ($('#checkusername').val() == '') {
                $('#showusername').show();
                $('#showusername').html("<div class='text-danger'>กรุณากรอกusername</div>");
                window.location.href = '#checkusername';
            } else if ($('#user_password').val() == '') {
                $('#showpassword').show();
                $('#showpassword').html("<div class='text-danger'>กรุณากรอกpassword</div>");
                window.location.href = '#user_password';
            } else if ($('#user_title').val() == '') {
                $('#showuser_title').show();
                $('#showuser_title').html("<div class='text-danger'>กรุณากรอกคำนำหน้าชื่อ</div>");
                window.location.href = '#user_title';
            } else if ($('#user_firstname').val() == '') {
                $('#showuser_firstname').show();
                $('#showuser_firstname').html("<div class='text-danger'>กรุณากรอกชื่อ</div>");
                window.location.href = '#user_firstname';
            } else if ($('#user_surname').val() == '') {
                $('#showuser_surname').show();
                $('#showuser_surname').html("<div class='text-danger'>กรุณากรอกนามสกุล</div>");
                window.location.href = '#user_surname';
            } else if ($('#user_nickname').val() == '') {
                $('#showuser_nickname').show();
                $('#showuser_nickname').html("<div class='text-danger'>กรุณากรอกชื่อเล่น</div>");
                window.location.href = '#user_nickname';
            } else if ($('#user_sex').val() == '') {
                $('#showuser_sex').show();
                $('#showuser_sex').html("<div class='text-danger'>กรุณากรอกเพศ</div>");
                window.location.href = '#user_sex';
            } else if ($('#user_tel').val() == '') {
                $('#showuser_tel').show();
                $('#showuser_tel').html("<div class='text-danger'>กรุณากรอกเบอร์โทร</div>");
                window.location.href = '#user_tel';
            } else if ($('#user_address').val() == '') {
                $('#showuser_address').show();
                $('#showuser_address').html("<div class='text-danger'>กรุณากรอกที่อยู่</div>");
                window.location.href = '#user_address';

            } else if ($('#user_email').val() == '') {
                $('#showemail').show();
                $('#showemail').html("<div class='text-danger'>กรุณากรอกอีเมล์</div>");
                window.location.href = '#user_email';
            } else if ($('#user_birthdate').val() == '') {
                $('#showuser_birthdate').show();
                $('#showuser_birthdate').html("<div class='text-danger'>กรุณากรอกวันเดือนปีเกิด</div>");
                window.location.href = '#user_birthdate';
            }

        }
    })
    $('#dis').on('click', function() {
        $('#editModal').modal('hide');
    })
</script>