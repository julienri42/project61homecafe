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
    61 home หน้าหลัก
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
              <h2>ข้อมูลส่วนตัว</h2>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <!-- เนื้อหา -->
              <center>
                <?php

                echo "<hr class='bg-dark'>";
                if (isset($_SESSION['edit_status'])) {
                  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                  <span class="fs-4 text-white"> บันทึกข้อมูลส่วนตัวสำเร็จ</span>
                  <button type="button" class="close mt-2" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>';
                  unset($_SESSION['edit_status']);
                }
                $employee_id = $_SESSION["employee_id"];
                $sql = "SELECT * FROM tb_employee  WHERE employee_id='$employee_id'";
                $result = mysqli_query($connect, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                  if (!empty($_SESSION['employee_img'])) {
                    echo "<center><img src='../assets/img/employee/" . $row['employee_img'] . "' class='img-profile rounded-circle mb-5' height='200' width='200'> </center>";
                } else {
                    echo "<center><img src='../assets/img/user/user.png' class='img-profile rounded-circle mb-5' height='200' width='200'></center>";
                }
                echo "<hr class='bg-dark' >";
                echo "<table class='w-90'>";
                echo " <colgroup>
                        <col width='50%'>
                        <col width=''>
                      </colgroup> ";
                  echo "<tr class=''>";
                    echo "<td class=''><p class='p-3 fs-4 text-dark text-end'>ชื่อ-นามสกุล :</p></td>";
                    echo "<td class=''><p class=' fs-4 text-dark'>" . $row['employee_title'] . " " . $row['employee_firstname'] . " " . $row['employee_surname'] . "</p></td>";
                  echo "</tr>";
                  echo "<tr>";
                    echo "<td ><p class='p-3 fs-4 text-dark text-end'>เบอร์โทร :</p></td>";
                    echo "<td ><p class='fs-4 text-dark'>" . $row['employee_tel'] . "</p></td>";
                  echo "</tr>";
                  echo "<tr>";
                    echo "<td ><p class='p-3 fs-4 text-dark text-end'>อีเมล :</p></td>";
                    echo "<td ><p class='fs-4 text-dark'>" . $row['employee_email'] . "</p></td>";
                  echo "</tr>";
                  echo "<tr>";
                    echo "<td ><p class='p-3 fs-4 text-dark text-end'>วันเดือนปีที่เข้าทำงาน :</p></td>";
                    echo "<td ><p class='fs-4 text-dark'>" . DateThai($row['employee_workdate']) ."</p></td>";
                  echo "</tr>";
                  echo "<tr>";
                  echo "<td ><p class='p-3 fs-4 text-dark text-end'>ตำแหน่ง :</p></td>";
                  echo "<td ><p class='fs-4 text-dark'>" . $row['employee_position'] . "</p></td>";
                  
                echo "</tr>";
                echo "</table>";
                echo "<hr class='bg-dark' >";
                echo '<center><a href="edit_employee.php?id=' . $row['employee_id'] . '" class="btn btn-primary">แก้ไขข้อมูลส่วนตัว</a></center>';
                }
                ?>
              </center>

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

</body>

</html>