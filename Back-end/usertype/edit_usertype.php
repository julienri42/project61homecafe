<?php
session_start();
include('../../assets/connect/conn.php');
$_SESSION['page'] = "usertype.php";
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
    จัดการข้อมูลประเภทสมาชิก
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
  <link href="../../assets/css/admin_home.css" rel="stylesheet">
  <link href="../../assets/css/body.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
  <link href="../../assets/css/employee.css" rel="stylesheet">
  
 

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
                <h2 class='col-6'>จัดการข้อมูลประเภทสมาชิก</h2>
               
                
              </div>
                

              
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <!-- เนื้อหา -->
              <center>
              <form action='edit_usertype_ck.php' method='post' enctype='multipart/form-data'>
                <?php

                echo "<hr class='bg-dark'>";
                $usertype_id = $_GET['id'];
                $sql = "SELECT * FROM tb_usertype  WHERE usertype_id='$usertype_id'";
                $result = mysqli_query($connect, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<table class=''>";
                    echo " <colgroup>
                            <col width='50%'>
                            <col width=''>
                            <col width=''>
                            </colgroup> ";
                    echo "<tr class=''>";
                    echo "<td class=''><p class='p-3 fs-4 text-dark text-end'>ชื่อประเภทสมาชิก :</p></td>";
                    echo "<td class=''><p class=' fs-4 text-dark col-6'>" . $row['usertype_name'] . "</p></td>";
                    echo "</tr>";
                    echo "<tr class=''>";
                    echo "<td class=''><p class='p-3 fs-4 text-dark text-end'>ลดราคาเฉพาะสมาชิก :</p></td>";
                    echo "<td class=''><p class=' fs-4 text-dark col-6'><input id='usertype_discount' class='form-control fs-4' type='number' name='usertype_discount'  value='" . $row['usertype_discount'] . "'></p></td>";
                    echo "</tr>";
                    echo "</table>";
                    echo "<input class='form-control' type='hidden' name='usertype_id'  value='" . $row['usertype_id'] . "'>";
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
                    echo "<a class='btn btn-lg btn-danger' href='usertype.php'>ยกเลิก</a>";
                    echo "</p>";

                }
                ?>
                
              </center>
                <!--ยืนยันแก้ไขข้อมูล -->
                <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">แก้ไขข้อมูลประเภทสมาชิก</h5>
                                        </div>
                                        <div class="modal-body">คุณต้องการบันทึกข้อมูลประเภทสมาชิก?</div>
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
        $(document).ready( function () {
    $('#dataTable').DataTable();
} );
      </script>
      <script>
        $('#alertchk').hide();
        $('#chk').on('click', function() {
            if ($('#usertype_discount').val() != '') {
                    $('#alertchk').hide();
                    $('#editModal').modal('show');
              
            } else {
                $('#alertchk').show();
                var text = "กรุณากรอกลดราคาเฉพาะ ";
                $('#alerttext').html(text);

            }
        })
        $('#dis').on('click', function() {
            $('#editModal').modal('hide');
        })
      </script>


</body>

</html>