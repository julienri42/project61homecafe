<?php
session_start();
include('../assets/connect/conn.php');
$time=date("Y-m-d H:i:s",time());
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>61Homecafe</title>
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
    <?php  include("nav.php"); ?>
      <!-- Header-->
      <header class="bg-secondary py-5  ">
        <div class="container pt-5">
            <div class="text-center text-white">
                <!--หัวlogo-->
                <center><img src="../img/logo.png" class="rounded-circle" alt="" width=250></center>
                <h1 class="display-4 fw-bolder">61Homecafe</h1>
                <p class="lead fw-normal text-white-50 mb-0">Bakery & Drinking Enjoy.</p>
            </div>
        </div>
    </header>
    <!-- Section-->
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
                $sql = "SELECT * FROM tb_product_list WHERE product_delete='0'";
                $result = mysqli_query($connect, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {

                ?>
                    
                        <div class="col mb-5 ">
                            <div class="card h-100 hover">
                                <!-- Sale badge-->

                                <!-- Product image-->
                                
                                <?php
                                echo "<a href='detail_page.php?proid=".$row['product_id']."'>";
                                if (!empty($row['product_img'])) {
                                    echo "<img class='card-img-top1' src='../assets/img/product/" . $row['product_img'] . "'   alt='item1'/>";
                                } else {
                                    echo "<img class='card-img-top1' src='../assets/img/product/noproduct.png' alt='item1' />";
                                }
                                ?>

                                <!-- Product details-->
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <!-- Product name-->
                                        <h5 class="fw-bolder"><?php echo $row['product_name'];  ?></h5>
                                        <!-- Product price-->
                                        ราคา <?php echo $row['product_price'] ?> บาท
                                    </div>
                                </div>
                                </a>
                                <!-- Product actions-->
                                <?php 
                                   
                                    //เช็คจำนวนสินค้า
                                    $mysqlchkprice="SELECT sum(product_stock_remaining)  FROM tb_product_stock_list WHERE product_id='".$row['product_id']."' AND product_stock_expiry_date>='$time'";
                                    $resultchkprice= mysqli_query($connect,$mysqlchkprice);
                                    list($chkprice)=mysqli_fetch_row($resultchkprice);
                                    if($chkprice<="0")
                                    {
                                        echo "<div class='card-footer p-4 pt-0 border-top-0 bg-transparent'>
                                                <div class='text-center text-danger'>สินค้าหมด</div>
                                            </div>";
                                    }
                                    else{
                                        echo "
                                            
                                            <button type='button' name='add_to_cart' class='btn btn-outline-dark btn-sm add my-btn col-6 align-self-center'  id ='".$row['product_id']."'>   
                                                        Add to cart
                                            </button>
                                            <br>
                                               ";
                                    }
                                    ///ค่าที่เก็บในตะกร้า
                                    echo "
                                    <input type='hidden' name='price' id='price".$row['product_id']."' value='".$row['product_price']."'>
                                    <input type='hidden' name='name' id='name".$row['product_id']."' value='".$row['product_name']."'>
                                    <input type='hidden' name='quantity' id='quantity".$row['product_id']."' class='form-control' value='1'>
                                    <input type='hidden' name='max' id='max".$row['product_id']."' class='form-control' value='$chkprice'>
                                    <input type='hidden' name='img' id='img".$row['product_id']."' class='form-control' value='".$row['product_img']."'>
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
     $(document).on("click",".add",function(){
         var id = $(this).attr("id");
         var name = $("#name"+id+"").val();
         var price = $("#price"+id+"").val();
         var quantity = $("#quantity"+id+"").val();
         var max = $("#max"+id+"").val();
         var img = $("#img"+id+"").val();
         $.ajax({
            method:"POST",
            url: "ajax_cart/add_to_cart.php",
            data:{id:id,name:name,price:price,quantity:quantity,max:max,img:img},
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

