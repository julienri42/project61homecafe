<?php
session_start();
?>
<button class="btn btn-outline-dark cart" id="cartModaltest" data-toggle="modal" data-target="#cartModal">

    <i class="bi-cart-fill me-1"></i>
    ตะกร้าซื้อของเข้าร้าน
    <?php
    if (empty($_SESSION['cart'])) {
        echo " <span class='badge bg-dark text-white ms-1 rounded-pill'>0</span>";
    } else {
        echo " <span class='badge bg-dark text-white ms-1 rounded-pill'>" . count($_SESSION['cart']) . "</span>";
    }
    ?>

</button>