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
////
if(isset($_GET['mid']))
    {
        if(!empty($_SESSION['mid'])){
            $chk=array_search($_GET['mid'],$_SESSION['mid']); 
            if($chk!== false){
                $_SESSION['amount'][$chk]+=$_GET['amount'];
            }
            else{
                $_SESSION['mid'][]=$_GET['mid'];
                $_SESSION['amount'][]=$_GET['amount'];
            }
        }
        else{
            $_SESSION['mid'][]=$_GET['mid'];
            $_SESSION['amount'][]=$_GET['amount'];
        }  
    }
    if(isset($_GET['delete']))
    {
        $_SESSION["mid"]= array_values(array_diff($_SESSION['mid'], array($_GET['delete'])));
       
    }
    if(isset($_GET['deleteamount']))
    {
        unset($_SESSION["amount"][$_GET['deleteamount']]);
        $_SESSION["amount"] = array_values($_SESSION["amount"]);
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
        เลือกวัตถุดิบทำที่สินค้า
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
                                <h2 class='col-6'>เลือกวัตถุดิบทำที่สินค้า</h2>
                            </div>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2 pl-2">
                            
                        <?php
                        echo "<hr class='bg-dark'>";
                    if (isset($_SESSION['edit_status'])) {
                        if ($_SESSION['edit_status'] == "1") {
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <h5 class="alert-heading">กรุณาเลือกข้อมูลวัตถุดิบให้ครบ</h5>
                                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>';
                        }
                        $_SESSION['edit_status'] = "";
                    }
                    ?>
                    <div class="row">
                        <!--col-->
                        <div class="col-6">
                            <h3 class='p-2'>เลือกวัตถุดิบที่ใช้ในการทำสินค้า</h3>
                            <div class="table-responsive p-2">
                                <table class="table" cellspacing="0">
                                    <thead class="thead-secondary">
                                        <tr>
                                           
                                            <th>ชื่อ</th>
                                            <th>ประเภท</th>
                                            <th>จำนวน</th>
                                            <th>หน่วย</th>
                                            <th>เพิ่ม</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM tb_material_list as m
                                         INNER JOIN tb_typematerial AS t ON m.typematerial_id=t.typematerial_id
                                         WHERE material_delete = '0'
                                        ";
                                        $result = $connect->query($sql);
                                        while ($row = $result->fetch_array()) {

                                            echo "<tr>";
                                            echo " <form action='add_product2_detail.php' method='GET'>";
                                            echo "<td>" . $row['material_name'] . "</td>";
                                            echo "<td>" . $row['typematerial_name'] . "</td>";
                                            echo "<td> <input type='number' name='amount' class='form-control' min='1'></td>";
                                            echo "<td>" . $row['material_usedunit'] . "</td>";
                                            echo "<input type='hidden' name='mid' value='" . $row['material_id'] . "'>";
                                            echo "<td><input type='submit' value='เพิ่มวัตถุดิบ' class='btn btn-secondary'></td>";
                                            echo " </form>";
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--col-->
                        <div class="col-6">
                            <h3>วัตถุดิบที่ใช้ในการทำสินค้า</h3>
                            <form action="add_product2_ck.php" method="POST">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="notable" width="100%" cellspacing="0">
                                        <thead class="thead-secondary">
                                            <tr>
                                                
                                                <th>ชื่อสินค้า</th>
                                                <th>ประเภทสินค้า</th>
                                                <th>จำนวน</th>
                                                <th>หน่วย</th>
                                                <th>ลบ</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            if (!empty($_SESSION['mid'])) {
                                                for ($i = 0; $i < count($_SESSION['mid']); $i++) {
                                                    $sql = "SELECT * FROM tb_material_list as m
                                                        INNER JOIN tb_typematerial AS t ON m.typematerial_id=t.typematerial_id
                                                        WHERE material_id='" . $_SESSION['mid'][$i] . "'";
                                                    $result = $connect->query($sql);
                                                    while ($row = $result->fetch_array()) {
                                                        echo "<tr>";
                                                        echo "<td>" . $row['material_name'] . "</td>";
                                                        echo "<td>" . $row['typematerial_name'] . "</td>";
                                                        echo "<td>" . $_SESSION['amount'][$i] . "</td>";
                                                        echo "<td>" . $row['material_usedunit'] . "</td>";
                                                        echo "<input type='hidden' name='amount[]' value='" . $_SESSION['amount'][$i] . "'>";
                                                        echo "<input type='hidden' name='mid[]' value='" . $row['material_id'] . "'>";
                                                        echo "<td> <a href='add_product2_detail.php?delete=" . $row['material_id'] . "&deleteamount=" . $i . "' class='btn btn-secondary'>ลบวัตถุดิบ</a></td>";
                                                        echo "</tr>";
                                                    }
                                                }
                                            } else {
                                                echo "<tr><td colspan='6'><center>ไม่มีข้อมูล</center></td></tr>";
                                            }

                                            ?>

                                        </tbody>
                                    </table>
                                    <center>
                                        <a href="#" data-toggle="modal" data-target="#add" class="btn btn-primary">เพิ่มข้อมูลสินค้า</a>
                                        <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">เพิ่มข้อมูลวัตถุดิบที่ทำสินค้า</h5>
                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">คุณต้องการเพิ่มข้อมูลวัตถุดิบที่ทำสินค้า?</div>
                                                    <div class="modal-footer">
                                                        <input class="btn btn-primary text-light" type="submit" value="เพิ่ม">
                                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">ยกเลิก</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="product.php" class="btn btn-danger">ยกเลิก</a>
                                    </center>
                                </div>

                        </div>


                        </form>

                    </div>
                    <div>
                        <!--ส่วนต่อไปพน -->
                    </div>

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
        $('#chk').on('click', function() {
            $('#editModal').modal('show');
        })
        $('#dis').on('click', function() {
            $('#editModal').modal('hide');
        })

       

    </script>
    


</body>

</html>