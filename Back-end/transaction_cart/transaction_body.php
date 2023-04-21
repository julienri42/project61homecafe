<?php
session_start();
$quantity = 0;

?>
<table class="table table-bordered ">
    <colgroup>
        <col width="50%">
        <col width="50%">
    </colgroup>
    <thead>
        <tr class="text-white bg-secondary">
            <th class="py-2 px-1">ชื่อสินค้า</th>
            <th class="py-2 px-1">จำนวน</th>
        </tr>
    </thead>
    <tbody>
        <?php

        if (empty($_SESSION['cart'])) {
            echo "<tr><td colspan='4'><h5 class='text-center'>ไม่มีสินค้าในตะกร้า</h5></td></tr>";
        } else {
            foreach ($_SESSION['cart'] as $key => $value) {

        ?>
                <tr class='hover'>

                    <td class="px-1 py-0 align-middle"> <?php echo $value['name'];  ?></td>
                    <td class="px-1 py-0 align-middle">
                        <?php echo $value['quantity'];  ?>
                    </td>
                  
                </tr>
        <?php
                $quantity += $value['quantity'];
            }
        }
        ?>
    </tbody>
</table>
<br>
<form action="transaction_ck.php" method="POST">
    <div class="row">
        <?php
        echo "<input type='hidden' name='order_total' value='$quantity'>";
        ?>
    </div>
    <?php
    if (!empty($_SESSION['cart'])) {
    ?>
        <center class="mt-3">
            <a data-toggle="modal" data-target="#order"  class='btn btn-secondary mr-2'>ยืนยันซื้อของเข้าร้าน</a>
            

            <a href="../materialbuyers/materialbuyer.php" class="btn btn-danger">กลับหน้าซื้อของเข้าร้าน</a>
        </center>
    <?php
    } else {
        echo "<center  class='mt-3'><h3>กรุณาสั่งซื้อสินค้าก่อน</h3></center>";
    }
    ?>
    <!-- Logout Modal-->
    <div class="modal fade" id="order" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ยืนยันการสั่งซื้อ</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">คุณยืนยันการสั่งซื้อ?</div>
                <div class="modal-footer">
                    <input type='submit' class='btn btn-secondary mr-2' value="ยืนยันการสั่งซื้อ">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">ยกเลิก</button>
                </div>
            </div>
        </div>
    </div>
</form>