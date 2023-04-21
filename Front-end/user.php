<?php
session_start();
include('../assets/connect/conn.php');
$time = date("Y-m-d H:i:s", time());
$rownum = 0;
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
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>61 home cafe</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet">
    <link href="css/index1.css" rel="stylesheet">


</head>

<body>
    <?php include("nav.php"); ?>
    <!-- Section-->
    <section class="py-5 ">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="card shadow mb-4">
                <h5 class="card-header bg-secondary text-white">
                    <div class="float-left mt-2">
                        ประวัติการสั่งซื้อ
                    </div>
                </h5>
                <div class="card-body" id='body'>
                     <!-- alerts -->
                     <?php 
                                if(isset($_SESSION['edit_status']))
                                {
                                    if($_SESSION['edit_status']=="4")
                                    {
                                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <h5 class="alert-heading">สมัครสมาชิกสำเร็จ</h5>

                                            </div>';
                                      
                                    }
                                    if($_SESSION['edit_status']=="3")
                                    {
                                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <h5 class="alert-heading">ลบข้อมูลสมาชิกสำเร็จ</h5>
                                              <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>';
                                      
                                    }
                                    if($_SESSION['edit_status']=="2")
                                    {
                                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <h5 class="alert-heading">แก้ไขข้อมูลสมาชิกสำเร็จ</h5>
                                            </div>';
                                      
                                    }
                                    if($_SESSION['edit_status']=="1")
                                    {
                                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <h5 class="alert-heading">กรุณากรอกข้อมูลให้ครบ</h5>
                                            </div>';
                                        
                                    }
                                    unset($_SESSION['edit_status']);
                                }
                            ?>
                    <?php
                    $user_id = $_SESSION['user_id'];
                    $sql ="SELECT * FROM tb_user AS u 
                            INNER JOIN tb_usertype AS p ON u.usertype_id=p.usertype_id 
                            WHERE user_id='$user_id'";
                                    
                                    $result = $connect->query($sql);
                                    while($row = $result->fetch_array())
                                    {
                                        if(!empty($row['user_img'])){
                                            echo "<center><img src='../assets/img/user/".$row['user_img']."' class='img-profile rounded-circle mb-5' height='200' width='200'> </center>";
                                        }
                                        else{
                                            echo "<center><img src='../assets/img/user/user.png' class='img-profile rounded-circle mb-5' height='200' width='200'></center>";
                                        }
                                        
                                        echo "<div class='row'>";
                                                echo "<div class ='col-6' style='text-align: right; font-weight: bold;' >
                                                    <p class='p-2'>username:</p>
                                                    <p class='p-2'>password:</p>
                                                    <p class= 'p-2'>ชื่อ -นามสกุล:</p>
                                                    <p class= 'p-2'>เบอร์โทร:</p>
                                                    <p class= 'p-2'>อีเมล:</p>
                                                    <p class= 'p-2'>ระดับสมาชิก:</p>
                                                   
                                                </div>";
                                                echo "<div class ='col-6' style='text-align:left;' >";
                                                    echo "<p class='card-text p-2'>".$row['user_username']." </p>";
                                                    echo "<p class='card-text p-2'>".$row['user_password']." </p>";
                                                    echo "<p class='card-text p-2'> ".$row['user_title']." ".$row['user_firstname']." ".$row['user_surname']."</p>"; 
                                                    echo "<p class='card-text p-2'>".$row['user_tel']." </p>";
                                                    echo "<p class='card-text p-2'>  ".$row['user_email']."</p>";
                                                    echo "<p class='card-text p-2'>".$row['usertype_name']." </p>";
                                                echo "</div>";
                                        echo "</div>"; /*ปิด row */ 
                                        echo "<hr>";
                                        echo '<center>
                                                <a href="edit_user.php" class="btn btn-danger">แก้ไขข้อมูลสมาชิก</a>
                                                
                                                <a href="index.php" class="btn btn-warning">กลับหน้าหลัก</a>
                                                </center>';
                                        
                                                                              
                                    }   
                                ?>

                </div>
            </div>

        </div>
    </section>
    <?php
    include("footer.php");
    ?>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <!-- Bootstrap core JavaScript-->
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../assets/vendor/datatables/jquery.dataTables.js"></script>
    <script src="../assets/vendor/datatables/dataTables.bootstrap4.js"></script>

</body>

</html>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

<script type="text/javascript">

    /////
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

    // เรียกใช้งาน Datatable function

    $('table').DataTable();
</script>
<script type="text/javascript">
   
     function cartnum(){
        $.ajax({
           method: "POST",
           url:"ajax_cart/button_cart.php",
           success:function(data){
             $("#cartnum").html(data);
           }
		});
    }
    cartnum();
    function show_cart(){
        $.ajax({
           method: "POST",
           url:"ajax_cart/show_cart.php",
           success:function(data){
             $("#show_cart").html(data);
           }
		});
    }
    $(document).on("click","#cartModaltest",function(){
        show_cart();
    });
    $(document).on("click",".plus",function(){
        var id = $(this).attr("id");
        $.ajax({
            method:"POST",
            url: "ajax_cart/plus_minus_cart.php",
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
            url: "ajax_cart/plus_minus_cart.php",
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
            url: "ajax_cart/delete_cart.php",
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
            url: "ajax_cart/delete_cart.php",
            data:{id:id,function:"delete"},
            success:function(data){
            	show_cart();
                cartnum();
            }
         });
    });

</script>