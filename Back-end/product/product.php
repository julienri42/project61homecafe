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
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../../assets/img/logoicon.ico">
  <title>
    จัดการข้อมูลสินค้า
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
  <style type="text/css">

  </style>
 

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
                <h2 class='col-6'>จัดการข้อมูลสินค้า</h2>
                <div class='col-6 text-end'><a class='btn btn-success' href='add_product.php'><i class="fas fa-plus"></i>  เพิ่มข้อมูลสินค้า</a></div>
                
              </div>
                

              
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <!-- เนื้อหา -->
              <center>
                <?php

                echo "<hr class='bg-dark'>";
                if (isset($_SESSION['edit_status'])) {
                  if($_SESSION['edit_status']=="4")
                  {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                      <span class="fs-4 text-white"> เพิ่มข้อมูลสินค้าสำเร็จ</span>
                      <button type="button" class="close mt-2" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                  </div>';
                  }
                  if($_SESSION['edit_status']=="3")
                  {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <span class="fs-4 text-white"> ลบข้อมูลสินค้าสำเร็จ</span>
                    <button type="button" class="close mt-2" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
                    
                  }
                  if($_SESSION['edit_status']=="2")
                  {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <span class="fs-4 text-white"> แก้ไขข้อมูลสินค้าสำเร็จ</span>
                    <button type="button" class="close mt-2" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
                    
                  }
                  
                  unset($_SESSION['edit_status']);
                }
                ?>
                <div class="table-responsive p-3">
                <table class="table table-striped table-hover" id="dataTable">

                                    <thead class="thead-secondary">
                                        <tr>
                                            <th>รหัสสินค้า</th>
                                            <th>ชื่อสินค้า</th>
                                            <!--<th>รหัสประเภทสินค้า(สินค้า)</th> -->
                                            <th>ราคา<br>สินค้า(บาท)</th>
                                            <th>หน่วย</th>
                                            <th>สถานะ</th>
                                            <th>รูปสินค้า</th>
                                            <th>รูปแบบสินค้า</th>
                                            <th>แก้ไข</th>
                                            <th>แก้ไขวัตถุดิบ</th>
                                            <th>ลบ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        $sql ="SELECT * FROM tb_product_list AS b 
                                             INNER JOIN tb_typeproduct AS p ON b.typeproduct_id=p.typeproduct_id
                                             WHERE product_delete='0'
                                            ";
                                        $result = mysqli_query($connect,$sql);
                                        while($row = mysqli_fetch_assoc($result))
                                        {
                                            echo "<tr>";
                                            echo "<td>".$row['product_id']."</td>";
                                            echo "<td>".$row['product_name']."</td>";
                                            // echo "<td>".$row['typeproduct_name']."</td>";
                                            echo "<td>".$row['product_price']." บาท</td>";
                                            echo "<td>".$row['product_unit']."</td>";
                                            echo "<td>".$row['product_status']."</td>";
                                            if(empty($row['product_img']))
                                            {
                                                echo "<td>ไม่มีรูปภาพ</td>";
                                            }
                                            else{
                                                echo "<td><img src='../../assets/img/product/".$row['product_img']."' height='100' width='100'></td>";
                                            }
                                            echo "<td>".$row['product_make']."</td>";
                                            echo "<td><a href='edit_product.php?id=".$row['product_id']."' class='btn btn-primary'><i class='fas fa-edit mr-2'></i> แก้ไข<br>ข้อมูลสินค้า</a></td>";
                                            if($row['product_make']=="ทำเอง")
                                            { 
                                                echo "<td><a href='edit_product2_detail.php?id=".$row['product_id']."' class='btn btn-info'><i class='fas fa-edit mr-2'></i> แก้ไขข้อมูล<br>วัตถุดิบที่ใช้ในสินค้า</a></td>";
                                            }
                                            else{
                                                echo "<td><center>-</center></td>";
                                            }
                      
                                            echo "<td><a href='#' data-toggle='modal' data-target='#delete".$row['product_id']."' class='btn btn-danger'><i class='fas fa-eraser'></i>  ลบ</a></td>";
                                            echo ' <div class="modal fade" id="delete'.$row['product_id'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">ลบข้อมูลสินค้า </h5>
                                                                        </div>
                                                                        <div class="modal-body">คุณต้องการลบข้อมูลสินค้า?</div>
                                                                        <div class="modal-footer">';
                                                                        if($row['product_make']=="ทำเอง")
                                                                        {
                                                                          echo  '<a class="btn btn-danger" href="delete_product.php?id='.$row['product_id'].'&product_img2=' . $row['product_img'] . '&make='.$row['product_make'].'">ลบ</a>';
                                                                        }
                                                                        else
                                                                        {
                                                                          echo  '<a class="btn btn-danger" href="delete_product.php?id='.$row['product_id'].'&product_img2=' . $row['product_img'] . '">ลบ</a>';
                                                                        }
                                                                         
                                                                         echo '<button class="btn btn-secondary" type="button" data-dismiss="modal">ยกเลิก</button>
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
        order: [
          [0, 'desc']
        ],
      });
    });
      </script>


</body>

</html>