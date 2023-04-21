<?php
session_start();
include('../../assets/connect/conn.php');
$time = date("Y-m-d H:i:s", time());



                               
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
    <link rel="icon" type="image/x-icon" href="../assets/favicon.ico" />
    <link href="../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../css/styles.css" rel="stylesheet">
    <link href="../css/index1.css" rel="stylesheet">


</head>

<body>
    <?php include("../nav_folder.php"); ?>
    <!-- Section-->
    <section class="py-5 ">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="card shadow mb-4">
                <h5 class="card-header bg-secondary text-white">
                    <div class="float-left mt-2">
                        รายละเอียดการสั่งซื้อออนไลน์
                    </div>
                </h5>
                <div class="card-body" id='body'>
                    <!-- -->
                    

                </div>


            </div>

        </div>
    </section>
    <?php
    include("../footer_folder.php");
    ?>
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
     bodytransaction();
     function bodytransaction() {
        $.ajax({
            method: "POST",
            url: "transaction_body.php",
            success: function(data) {
                $("#body").html(data);
            }
        });
     }

    function show_cart() {
        $.ajax({
            method: "POST",
            url: "../ajax_cart/show_cart_folder.php",
            success: function(data) {
                $("#show_cart").html(data);
                cartnum();
            }
        });
    }
    $(document).on("click", "#cartModaltest", function() {
        show_cart();
    });

    $(document).on("click", ".plus", function() {
        var id = $(this).attr("id");
        $.ajax({
            method: "POST",
            url: "../ajax_cart/plus_minus_cart.php",
            data: {
                id: id,
                function: "plus"
            },
            success: function(data) {
                show_cart();
                bodytransaction();
                cartnum();
            }
        });
    });

    $(document).on("click", ".minus", function() {
        var id = $(this).attr("id");
        $.ajax({
            method: "POST",
            url: "../ajax_cart/plus_minus_cart.php",
            data: {
                id: id,
                function: "minus"
            },
            success: function(data) {
                show_cart();
                bodytransaction();
                cartnum();
            }
        });

    });

    $(document).on("click", "#delete_all", function() {
        $.ajax({
            method: "POST",
            url: "../ajax_cart/delete_cart.php",
            data: {
                function: "delete_all"
            },
            success: function(data) {
                show_cart();
                bodytransaction();
                cartnum();
            }
        });
    });
    $(document).on("click", ".delete", function() {
        var id = $(this).attr("id");
        $.ajax({
            method: "POST",
            url: "../ajax_cart/delete_cart.php",
            data: {
                id: id,
                function: "delete"
            },
            success: function(data) {
                show_cart();
                bodytransaction();
                cartnum();
            }
        });
    });
</script>