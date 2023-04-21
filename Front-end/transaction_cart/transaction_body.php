<?php
session_start();
$price = 0;
if ($_SESSION['usertype_id'] == '1') {
    $service = 0;
    $discount = $_SESSION['usertype_discount'];
} else {
    $service = 0;
    $discount = $_SESSION['usertype_discount'];
}

?>
<table class="table table-bordered ">
    <colgroup>
        <col width="15%">
        <col width="15%">
        <col width="50%">
        <col width="20%">
    </colgroup>
    <thead>
        <tr class="text-white bg-secondary">
            <th class="py-0 px-1">รูปภาพ</th>
            <th class="py-0 px-1">ชื่อสินค้า</th>
            <th class="py-0 px-1">จำนวน</th>
            <th class="py-0 px-1">ราคารวม</th>
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
                    <td>
                        <?php
                        if (empty($value['img'])) {
                            echo "<img class='card-img-top' height='125px' src='../../assets/img/product/noproduct.png' />";
                        } else {
                            echo "<img class='card-img-top' height='125px' src='../../assets/img/product/" . $value['img'] . "' />";
                        }
                        ?>
                    </td>
                    <td class="px-1 py-0 align-middle"> <?php echo $value['name'];  ?></td>
                    <td class="px-1 py-0 align-middle">
                        <?php echo $value['quantity'];  ?>
                    </td>
                    <td class="px-1 py-0 align-middle text-end"> <?php echo number_format($value['price'] * $value['quantity'], 2) . " บาท"; ?> </td>
                </tr>
        <?php
                $price += $value['price'] * $value['quantity'];
            }
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th class="px-1 py-0" colspan="3">ราคา:</th>
            <th class="px-1 py-0 text-end"><?php echo number_format($price, 2) . " บาท"; ?></th>
        </tr>


        <tr>
            <th class="px-1 py-0" colspan="3">ลดราคา:</th>
            <th class="px-1 py-0 text-end">
                <?php
                $discount_bath = (($price + $service) * $discount) / 100;
                $total_price = ($price + $service) - $discount_bath;
                echo number_format($discount_bath, 2) . " บาท";
                ?>
            </th>
        </tr>
        <tr>
            <th class="px-1 py-0" colspan="3">รวมราคา :</th>
            <th class="px-1 py-0 text-end"><?php echo number_format($total_price, 2) . " บาท"; ?></th>
        </tr>
    </tfoot>
</table>
<br>
<form action="transaction_ck.php" method="POST">
    <div class="row">
        <?php
        echo "<input type='hidden' name='order_total' value='$price'>";
        echo "<input type='hidden' name='order_discount' value='$discount_bath'>";
        ?>
    </div>
    <?php
    if (!empty($_SESSION['cart'])) {
    ?>
        <center class="mt-3">
            <a data-toggle="modal" data-target="#order"  class='btn btn-secondary mr-2'>ยืนยันการสั่งซื้อ</a>
            

            <a href="../index.php" class="btn btn-danger">กลับหน้าสั่งซื้อออนไลน์</a>
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