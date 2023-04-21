<?php
session_start();
include('../assets/connect/conn.php');
$time = date("Y-m-d H:i:s", time());
$proid = $_GET['proid'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>61 home cafe </title>
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

            <!--เปิด-->
            <?php
            $sql = "SELECT * FROM tb_product_list WHERE product_id='$proid'";
            $result = mysqli_query($connect, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {

            ?>
                    <div class="container px-4 px-lg-5 my-5">
                        <div class="row gx-4 gx-lg-5 align-items-center ">
                            <div class="col-md-6">
                                <?php
                                if (!empty($row['product_img'])) {
                                    echo "<img class='card-img-top mb-5 mb-md-0 item1' src='../assets/img/product/" . $row['product_img'] . "'   />";
                                } else {
                                    echo "<img class='card-img-top mb-5 mb-md-0' src='../assets/img/product/noproduct.png'  />";
                                }
                                ?>
                            </div>
                            <div class="col-md-6">

                                <h1 class="display-5 fw-bolder"><?php echo $row['product_name'];  ?></h1>
                                <div class="fs-5 mb-5">
                                    <span> <?php echo " <div id='price'>฿" . $row['product_price'] . "</div>"; ?> </span>
                                    <?php echo "<input type='hidden' id='price0' value='" . $row['product_price'] . "'>";  ?>
                                </div>
                                <p class="lead">รายละเอียดสินค้า : <?php echo $row['product_description']; ?></p>


                                <?php

                                //เช็คจำนวนสินค้า
                                $mysqlchkprice = "SELECT sum(product_stock_remaining)  FROM tb_product_stock_list WHERE product_id ='" . $row['product_id'] . "' AND product_stock_expiry_date>='$time'";
                                $resultchkprice = mysqli_query($connect, $mysqlchkprice);
                                list($chkprice) = mysqli_fetch_row($resultchkprice);
                                if ($chkprice >= "1") {
                                echo "<p>จำนวนสินค้าคงเหลือ : $chkprice</p>";
                                }
                                ?>
                                <div class="d-flex">
                                    <?php
                                    if ($chkprice <= "0") {
                                        echo "<div class='card-footer p-4 pt-0 border-top-0 bg-transparent'>
                                               <div class='text-center text-danger'>สินค้าหมด</div>
                                           </div>";
                                    } else {

                                        echo "<div class='p-2'>จำนวน </div>
                                                <input class='form-control text-center me-3 ' name='quantity' id='quantity' type='number' value='1' max='$chkprice' min='1'  style='max-width: 5rem' />" . "
                                             <div class='p-2'>" . $row['product_unit'] . "</div>";
                                        echo "
                                           <button type='button' name='add_to_cart' class='btn btn-outline-dark btn-md add cart-btn'  id ='" . $row['product_id'] . "'>   
                                                       Add to cart
                                           </button>
                                        
                                           <br>
                                          
                                              ";
                                    }
                                    ///ค่าที่เก็บในตะกร้า
                                    echo "
                                   <input type='hidden' name='price' id='price" . $row['product_id'] . "' value='" . $row['product_price'] . "'>
                                   <input type='hidden' name='name' id='name" . $row['product_id'] . "' value='" . $row['product_name'] . "'>
                                   <input type='hidden' name='max' id='max" . $row['product_id'] . "' class='form-control' value='$chkprice'>
                                   <input type='hidden' name='img' id='img" . $row['product_id'] . "' class='form-control' value='" . $row['product_img'] . "'>
                               ";
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

            <?php
                }
            }
            ?>
            <!--ปิด-->

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
<script>
    let count = 0;
    //if add to cart btn clicked
    $('.cart-btn').on('click', function() {
        let cart = $('.cart');
        // find the img of that card which button is clicked by user
        let imgtodrag = $('.card-img-top');
        if (imgtodrag) {
            // duplicate the img
            var imgclone = imgtodrag.clone().offset({
                top: imgtodrag.offset().top,
                left: imgtodrag.offset().left
            }).css({
                'opacity': '0.8',
                'position': 'absolute',
                'height': '150px',
                'width': '150px',
                'z-index': '100'
            }).appendTo($('body')).animate({
                'top': cart.offset().top + 20,
                'left': cart.offset().left + 30,
                'width': 75,
                'height': 75
            }, 1000, 'easeInOutExpo');

            imgclone.animate({
                'width': 0,
                'height': 0
            }, function() {
                $(this).detach()
            });
        }
    });
</script>
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
    $("#quantity").keyup(function() {

            var value = $(this).val() * $("#price0").val();
            $("#price").text("฿ " + value);
        })
        .keyup();
    $(':input[type="number"]').click(function() {

        var value = $('#quantity').val() * $("#price0").val();
        $("#price").text("฿ " + value);
    });

    function show_cart() {
        $.ajax({
            method: "POST",
            url: "ajax_cart/show_cart.php",
            success: function(data) {
                $("#show_cart").html(data);
            }
        });
    }
    $(document).on("click", "#cartModaltest", function() {
        show_cart();
    });
    $(document).on("click", ".add", function() {
        var id = $(this).attr("id");
        var name = $("#name" + id + "").val();
        var price = $("#price" + id + "").val();
        var quantity = $("#quantity").val();
        var max = $("#max" + id + "").val();
        var img = $("#img" + id + "").val();
        $.ajax({
            method: "POST",
            url: "ajax_cart/add_to_cart.php",
            data: {
                id: id,
                name: name,
                price: price,
                quantity: quantity,
                max: max,
                img: img
            },
            success: function(data) {
                //alert("you have add new item");
                cartnum();
            }
        });

    });
    $(document).on("click", ".plus", function() {
        var id = $(this).attr("id");
        $.ajax({
            method: "POST",
            url: "ajax_cart/plus_minus_cart.php",
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
            url: "ajax_cart/plus_minus_cart.php",
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
            url: "ajax_cart/delete_cart.php",
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
            url: "ajax_cart/delete_cart.php",
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