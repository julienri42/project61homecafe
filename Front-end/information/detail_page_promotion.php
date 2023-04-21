<?php
session_start();
include('../../assets/connect/conn.php');
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
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="../css/styles.css" rel="stylesheet">
    <link href="../css/index1.css" rel="stylesheet">
    <link rel="stylesheet" href="../../style.css" />
    <style>
      body {font-family: "Times New Roman", Georgia, Serif;}
      h1, h2, h3, h4, h5, h6 {
        font-family: "Playfair Display";
        letter-spacing: 5px;
      }
      * {box-sizing: border-box;}
      body {font-family: Verdana, sans-serif;}
      .mySlides {display: none;}
      img {vertical-align: middle;}
</style>

</head>

<body>
<!-- Navbar (sit on top) -->
<div class="w3-top">
    <div class="w3-bar w3-white w3-padding w3-card">
      <a href="../../index.php" class="w3-bar-item w3-button">
          <img src="../../img/logo.png" class="logo">
      </a>
      <!-- Right-sided navbar links. Hide them on small screens -->
      <div class="w3-left w3-hide-small">
        <a href="../../index.php" class="w3-bar-item w3-button">เมนูเเนะนำ</a>
        <a href="information.php" class="w3-bar-item w3-button">ข่าวสารประชาสัมพันธ์</a>
        <a href="promotion.php" class="w3-bar-item w3-button">โปรโมชั่น</a>
      </div>
      <div class="w3-right w3-hide-small">
          <a href="../../Back-end/index.php" class="w3-bar-item w3-button">เข้าสู่ระบบ</a>
        </div>
    </div>
  </div>
  

    <!-- Section-->
    <section class="py-5 ">
        <div class="container px-4 px-lg-5 mt-5">

            <!--เปิด-->
            <?php
            $sql = "SELECT * FROM promotions WHERE promotion_id='$proid'";
            $result = mysqli_query($connect, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {

            ?>
                    <div class="container px-4 px-lg-5 my-5">
                        <div class="row gx-4 gx-lg-5 align-items-center ">
                            <div class="col-md-6">
                                <?php
                                if (!empty($row['promotion_img'])) {
                                    echo "<img class='card-img-top mb-5 mb-md-0 item1' src='../../assets/img/promotion/" . $row['promotion_img'] . "'   />";
                                } else {
                                    echo "<img class='card-img-top mb-5 mb-md-0' src='../../assets/img/promotion/nopromotion.png'  />";
                                }
                                ?>
                            </div>
                            <div class="col-md-6">

                                <h1 class="display-5 fw-bolder"><?php echo $row['promotion_name'];  ?></h1>
                                <div class="fs-5 mb-5">
                                    <!-- <span> <?php echo " <div id='price'>฿" . $row['product_price'] . "</div>"; ?> </span>
                                    <?php echo "<input type='hidden' id='price0' value='" . $row['product_price'] . "'>";  ?> -->
                                </div>
                                <p class="lead">รายละเอียดโปรโมชั่น : <?php echo $row['promotion_details']; ?></p>
                                วันเวลา: <?php echo $row['promotion_date'] ?>


                                <?php
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
    <footer class="w3-center w3-light-grey w3-padding-32">
    <a href="../../modules/home/about.php" class="w3-bar-item w3-button">เกี่ยวกับเรา</a>
<a href="../../modules/home/Contact.php" class="w3-bar-item w3-button">ติดต่อเรา :</a>
<a href="https://www.facebook.com/lalanattapong" class="w3-bar-item w3-button">
    <img src="../../img/facebook.png" class="w3-round w3-image w3-opacity-min" alt="Table Setting" width="50" height="100">
</a>
<!-- <a href="#" class="w3-bar-item w3-button">
    <img src="../../img/line.png" class="w3-round w3-image w3-opacity-min" alt="Table Setting" width="50" height="100">
</a> -->
</div>
</footer>
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