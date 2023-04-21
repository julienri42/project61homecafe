<?php
session_start();
include('../../assets/connect/conn.php');
$_SESSION['page'] = "information.php";
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
        เพิ่มข้อมูลข่าวสารประชาสัมพันธ์
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
                                <h2 class='col-6'>เพิ่มข้อมูลข่าวสารประชาสัมพันธ์</h2>
                            </div>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <!-- เนื้อหา -->
                            <center>
                                <form action='edit_information_ck.php' method='post' enctype='multipart/form-data'>
                                    <?php
                                    echo "<hr class='bg-dark'>";
                                    $information_id = $_GET['id'];
                                    $sql = "SELECT * FROM informations  WHERE information_id='$information_id'";
                                    $result = mysqli_query($connect, $sql);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<table class=''>";
                                    echo " <colgroup>
                                             <col width='50%'>
                                             <col width=''>
                                           </colgroup> ";
                                    echo "<tr class=''>";
                                    echo "<td class=''><p class='p-3 fs-4 text-dark text-end'>ชื่อข่าวสาร: :</p></td>";
                                    echo "<td class=''><p class=' fs-4 text-dark col-6'><input type='text' value='".$row['information_name']."' id='information_name' class='form-control fs-4'  name='information_name' placeholder='กรุณากรอกชื่อข่าวสาร'></p></td>";
                                    echo "</tr>";
                                    echo "<tr id='showinformation_name'>";
                                    echo "<td></td>";
                                    echo "<td><div class='text-danger fs-4 mb-2'>*กรุณากรอกชื่อข่าวสาร</div></td>";
                                    echo "</tr>";
                                   
                                    echo "<tr>";
                                    echo "<td ><p class='p-3 fs-4 text-dark text-end'>รายละเอียดข่าวสาร :</p></td>";
                                    echo "<td ><p class='fs-4 text-dark col-6'> <textarea id='information_details'  name='information_details' rows='4' cols='50' class='form-control  fs-4' placeholder='กรุณากรอกรายละเอียด' >".$row['information_details']." </textarea></p></td>";
                                    echo "</tr>";
                                    echo "<tr id='showinformation_details'>";
                                    echo "<td></td>";
                                    echo "<td><div class='text-danger fs-4 mb-2'>*กรุณากรอกรายละเอียด</div></td>";
                                    echo "</tr>";

                                    // echo "<tr>";
                                    // echo "<td><p class='p-3 fs-4 text-dark text-end'>วันเวลา:</p></td>";
                                    // echo "<td ><p class='mt-1 mb-1'> <textarea id='information_date'  name='information_date' rows='4' cols='50' class='form-control  fs-4' placeholder='กรุณากรอกรายละเอียด' >".$row['information_date']." </textarea></p></td>";
                                    // echo " <td><p class='mt-1 mb-1'><input type='date' id='product_stock_expiry_date' name='product_stock_expiry_date' class='form-control' ></p></td>";
                                    // echo "</tr>";

                                    echo "<tr>";
                                    echo "<td></td>";
                                    if (!empty($row['information_img'])) {
                                        echo "<td><img src='../../assets/img/information/" . $row['information_img'] . "' class='img-profile rounded-circle' height='200' width='200'></td>";
                                    } else {
                                        echo "<td><img src='../../assets/img/information/noinformation.png' class='img-profile rounded-circle ' height='200' width='200'></td>";
                                    }
                                    echo "</tr>";
                                    echo "<tr>";
                                    echo "<td ><p class='p-3 fs-4 text-dark text-end'>รูปภาพข่าวสาร :</p></td>";
                                    echo "<td ><p class='fs-4 text-dark col-6'> <input class='form-control' type='file' name='information_img' ></p></td>";
                                    echo "</tr>";
                                    echo "</table>";
                                    echo "<hr class='bg-dark' >";
                                    echo "<p class='text-center'>";
                                    echo "<button type='button' id='chk'  class='btn btn-lg btn-primary me-md-2'>เพิ่ม</button>";
                                    echo "<a class='btn btn-lg btn-danger' href='information.php'>ยกเลิก</a>";
                                    echo "</p>";
                                    echo "<input type='hidden' name='information_id'  value='".$row['information_id']."'>";
                                    echo "<input type='hidden' name='information_img2'  value='".$row['information_img']."'>";
                                }
                                    ?>
                            </center>

                            <!--ยืนยันแก้ไขข้อมูล -->
                            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">แก้ไขข้อมูลข่าวสาร</h5>
                                        </div>
                                        <div class="modal-body">คุณต้องการแก้ไขข้อมูลข่าวสาร?</div>
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
        $('#showinformation_name').hide(); 
        $('#showtypeinformation_id').hide(); 
        $('#showinformation_details').hide();
        $('#showinformation_price').hide();
        $('#showinformation_unit').hide();
        $('#showinformation_make').hide();
        if($('#information_unit').val()=="อื่นๆ")
        {
            $('#typeunit').show();
        }
        else
        {
            $('#typeunit').hide();
        }
        

        $('#information_unit').change(function() {
            var information_unit = $(this).val();
            if(information_unit=="อื่นๆ")
            {
                $('#typeunit').show();
            }
            else{
                $('#typeunit').hide();
            }
        });

        $('#chk').on('click', function() {
            $('#showinformation_name').hide(); 
        $('#showtypeinformation_id').hide(); 
        $('#showinformation_details').hide();
        $('#showinformation_price').hide();
        $('#showinformation_unit').hide();
        $('#showinformation_make').hide();
            if ($('#information_name').val() != '' && $('#typeinformation_id').val() != ''
                &&  $('#information_details').val() != '' && $('#information_price').val() != ''
                && $('#information_unit').val() != ''    && $('#information_make').val() != '' 
                ) {
                    $('#editModal').modal('show');
            } else {
                if ($('#information_name').val() == '') {
                    $('#showinformation_name').show();
                    window.location.href = '#information_name'
                }
                else if ($('#typeinformation_id').val() == ''){
                    $('#showtypeinformation_id').show();
                    window.location.href = '#typeinformation_id'
                }
                else if ($('#information_details').val() == ''){
                    $('#showinformation_details').show();
                    window.location.href = '#information_details'
                }
                else if ($('#information_price').val() == ''){
                    $('#showinformation_price').show();
                    window.location.href = '#information_price'
                }
                else if ($('#information_unit').val() == ''){
                    $('#showinformation_unit').show();
                    window.location.href = '#information_unit'
                }
                else if ($('#information_make').val() == ''){
                    $('#showinformation_make').show();
                    window.location.href = '#information_make'
                }

            }
        })
        $('#dis').on('click', function() {
            $('#editModal').modal('hide');
        })

       

    </script>
    


</body>

</html>