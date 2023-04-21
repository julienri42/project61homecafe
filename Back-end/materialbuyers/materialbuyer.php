<?php
session_start();
include('../../assets/connect/conn.php');
$time=date("Y-m-d H:i:s",time());
$_SESSION['page'] = "materialbuyer.php";
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
    ซื้อของเข้าร้าน
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
                <h2 class='col-6'>ซื้อของเข้าร้าน</h2>
                <div id='cartnum'></div>
              </div> 
            </div>
        <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <?php
            if (isset($_SESSION['register_status'])) {


                echo '<div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                                <h5 class="alert-heading">' . $_SESSION['register_status'] . '</h5>  
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                                </div>';

                unset($_SESSION['register_status']);
            }
            ?>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-3 justify-content-center items">
           <!--เปิด-->
           <?php
                $sql = "SELECT * FROM tb_material_list WHERE material_delete='0'";
                $result = mysqli_query($connect, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {

                ?>
                    
                        <div class="col mb-5 ">
                            <div class="card h-100 hover">
                                <!-- Sale badge-->
  
                                <!-- Product details-->
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <!-- Product name-->
                                        <h5 class="fw-bolder"><?php echo $row['material_name'];  ?></h5>
                                        <!-- Product price-->
                                        <!-- ราคา <?php echo $row['product_price'] ?> บาท -->
                                    </div>
                                </div>
                                </a>
                                <!-- Product actions-->
                                <?php 
                                   
                                    //เช็คจำนวนสินค้า
                                    $mysqlchkprice="SELECT sum(material_stock_remaining)  FROM tb_material_stock_list WHERE material_id='".$row['material_id']."' AND material_stock_expiry_date>='$time'";
                                    $resultchkprice= mysqli_query($connect,$mysqlchkprice);
                                    list($chkprice)=mysqli_fetch_row($resultchkprice);
                                    if($chkprice<="0")
                                    {
                                        echo "<div class='card-footer p-4 pt-0 border-top-0 bg-transparent'>
                                                <div class='text-center text-danger'>วัตถุดิบหมด</div>
                                            </div>";
                                            echo "
                                            
                                            <button type='button' name='add_to_cart' class='btn btn-outline-dark btn-sm add my-btn col-6 align-self-center'  id ='".$row['material_id']."'>   
                                                        Add to cart
                                            </button>
                                            <br>
                                               ";
                                    }
                                    else{
                                        echo "
                                            
                                            <button type='button' name='add_to_cart' class='btn btn-outline-dark btn-sm add my-btn col-6 align-self-center'  id ='".$row['material_id']."'>   
                                                        Add to cart
                                            </button>
                                            <br>
                                               ";
                                    }
                                    ///ค่าที่เก็บในตะกร้า
                                    echo "
                                    <input type='hidden' name='name' id='name".$row['material_id']."' value='".$row['material_name']."'>
                                    <input type='hidden' name='quantity' id='quantity".$row['material_id']."' class='form-control' value='1'>
                                    <input type='hidden' name='max' id='max".$row['material_id']."' class='form-control' value='$chkprice'>
                                ";
                                ?>


                            </div>
                        </div>
                <?php
                    }
                }
                ?>
                <!--ปิด-->
                </div>
                </div>
                </section>
                <?php 
        include("../footer.php");
    ?>
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
            item      : '.item1',
            target    : '#cartnum',
            button    : '.my-btn'
        });
    </script>
<script type="text/javascript">
   
     function cartnum(){
        $.ajax({
           method: "POST",
           url:"../ajax_cart/button_cart.php",
           success:function(data){
             $("#cartnum").html(data);
           }
		});
    }
    cartnum();
    function show_cart(){
        $.ajax({
           method: "POST",
           url:"../ajax_cart/show_cart.php",
           success:function(data){
             $("#show_cart").html(data);
           }
		});
    }
    $(document).on("click","#cartModaltest",function(){
        show_cart();
    });
     $(document).on("click",".add",function(){
         var id = $(this).attr("id");
         var name = $("#name"+id+"").val();
         var quantity = $("#quantity"+id+"").val();
         var max = $("#max"+id+"").val();
         $.ajax({
            method:"POST",
            url: "../ajax_cart/add_to_cart.php",
            data:{id:id,name:name,quantity:quantity,max:max},
            success:function(data){
                cartnum();
            	//alert("you have add new item");
            }
         });
       
    });
    $(document).on("click",".plus",function(){
        var id = $(this).attr("id");
        $.ajax({
            method:"POST",
            url: "../ajax_cart/plus_minus_cart.php",
            data:{id:id,function:"plus"},
            success:function(data){
            	show_cart();
                cartnum();
            }
         });
    });
    $(document).on("click",".minus",function(){
        var id = $(this).attr("id");
        $.ajax({
            method:"POST",
            url: "../ajax_cart/plus_minus_cart.php",
            data:{id:id,function:"minus"},
            success:function(data){
            	show_cart();
                cartnum();
            }
         });
        
    });
	$(document).on("click","#delete_all",function(){
        $.ajax({
            method:"POST",
            url: "../ajax_cart/delete_cart.php",
            data:{function:"delete_all"},
            success:function(data){
            	show_cart();
                cartnum();
            }
         });
    });
    $(document).on("click",".delete",function(){
        var id = $(this).attr("id");
        $.ajax({
            method:"POST",
            url: "../ajax_cart/delete_cart.php",
            data:{id:id,function:"delete"},
            success:function(data){
            	show_cart();
                cartnum();
            }
         });
    });

</script>

