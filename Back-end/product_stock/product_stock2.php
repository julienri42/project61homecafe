<?php
session_start();
include('../../assets/connect/conn.php');
$_SESSION['page'] = "product_stock.php";
function DateThai($strDate)
{
  $strYear = date("Y", strtotime($strDate)) + 543;
  $strMonth = date("n", strtotime($strDate));
  $strDay = date("j", strtotime($strDate));
  $strSeconds = date("s", strtotime($strDate));
  $strtime = date("H:i", strtotime($strDate));
  $strMonthCut = array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
  $strMonthThai = $strMonthCut[$strMonth];
  return "$strDay $strMonthThai $strYear $strtime";
}
$product_id=$_GET['id'];
$product_name=$_GET['name'];
$num=0;
$time=date("Y-m-d H:i:s",time());
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../../assets/img/logoicon.ico">
  <title>
    <?php echo $product_name; ?>
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
  <link href="../../assets/css/body1.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
  <link href="../../assets/css/employee1.css" rel="stylesheet">
  <link href="../../assets/css/table-hover.css" rel="stylesheet">
 

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
                <h2 class='col-6'><?php echo $product_name; ?></h2>
                <div class='col-6 text-end'><a class='btn btn-dark' href='product_stock.php'><i class="far fa-arrow-alt-circle-left"></i> ย้อนกลับ</a></div>
              </div>
                

              
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <!-- เนื้อหา -->
              <center>
                <?php

                echo "<hr class='bg-dark'>";
                if(isset($_SESSION['edit_status']))
                {
                    if($_SESSION['edit_status']=="4")
                    {
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <h5 class="alert-heading">เพิ่มข้อมูลสต็อกสินค้าสำเร็จ</h5>
                              
                            </div>';
                      
                    }
                    if($_SESSION['edit_status']=="3")
                    {
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <h5 class="alert-heading text-white">ลบข้อมูลสต็อกสินค้าสำเร็จ</h5>
                              
                            </div>';
                      
                    }
                    if($_SESSION['edit_status']=="2")
                    {
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <h5 class="alert-heading">แก้ไขข้อมูลสต็อกสินค้าสำเร็จ</h5>
                              
                            </div>';
                      
                    }
                    if($_SESSION['edit_status']=="1")
                    {
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <h5 class="alert-heading">กรุณากรอกข้อมูลให้ครบ</h5>
                              
                            </div>';
                        
                    }
                    $_SESSION['edit_status']="";
                }
                ?>
                <div class="table-responsive p-3">
                <table class="table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-secondary">
                                        <tr>
                                            <th>#</th>
                                            <th>รหัสสต็อกสินค้า</th>
                                            <th>ชื่อสินค้า</th>
                                            <th>จำนวนสต็อก</th>
                                            <th>คงเหลือ</th>
                                            <th>วันหมดอายุ</th>
                                            <th>วันที่สร้างสต็อกสินค้า</th>
                                            <th>หมดอายุ</th>
                                            <th>ลบ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        $sql ="SELECT * FROM tb_product_stock_list as b
                                        INNER JOIN tb_product_list AS l ON b.product_id=l.product_id
                                        WHERE b.product_id='$product_id' 
                                        ORDER BY b.product_stock_id DESC  ";
                                        $result = $connect->query($sql);
                                        while($row = $result->fetch_array())
                                        {
                                            if($time>$row['product_stock_expiry_date'] ||$row['product_stock_remaining']<= 0){
                                                echo "<tr class=''>";
                                            }
                                            else{
                                               
                                                echo "<tr>";
                                            }
                                            
                                            $num+=1;
                                            echo "<td>$num</td>";
                                            echo "<td>".$row['product_stock_id']."</td>";
                                            echo "<td>".$row['product_name']."</td>";
                                            echo "<td>".$row['product_stock_quantity']." ".$row['product_unit']."</td>";
                                            echo "<td>".$row['product_stock_remaining']." ".$row['product_unit']."</td>";
                                            echo "<td>".Datethai($row['product_stock_expiry_date'])."</td>";
                                            echo "<td>".Datethai($row['product_stock_date_added'])."</td>";
                                            if($time>$row['product_stock_expiry_date'] ||$row['product_stock_remaining']<= 0){
                                              echo "<td class='text-danger'>หมดอายุ</td>";
                                          }
                                          else{
                                             
                                            echo "<td>-</td>";
                                          }
                                            echo "<td><a href='#' data-toggle='modal' data-target='#delete".$row['product_stock_id']."' class='btn btn-danger'><i class='fas fa-trash'></i> ลบ</a></td>"; 
                                            echo ' <div class="modal fade" id="delete'.$row['product_stock_id'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">ลบข้อมูลสต็อกวัตถุดิบ </h5>
                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">คุณต้องการลบข้อมูลสต็อกวัตถุดิบ ใช้หรือไม่ ?</div>
                                                    <div class="modal-footer">';
                                                    
                                                    echo '<a class="btn btn-secondary text-light" href="delete_product_stock.php?id='.$row['product_stock_id'].'&&product_id='.$product_id.'&&product_name='.$product_name.'">ใช่</a>';
                                                    
                                                  echo '<button class="btn btn-secondary" type="button" data-dismiss="modal">ไม่</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
                                          
                                            ?>
                                            
                                            <?php
                                            echo "</tr>";
                                        }
                                    ?>
                                    </tbody>
                                </table>      
                </div>
              </center>

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
      $('.table').DataTable({
        
      });
    });
      </script>


</body>

</html>