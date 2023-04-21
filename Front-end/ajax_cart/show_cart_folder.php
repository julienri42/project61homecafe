<?php

session_start();
$total_price = 0;
if (empty($_SESSION['cart'])) {
    echo "<h5 class='text-center'>ไม่มีสินค้าในตะกร้า</h5>";
}
else{
    foreach ($_SESSION['cart'] as $key => $value) { 
       
?>
<div class="row p-2">
    <div class="col-4">
        <?php 
            if(empty($value['img']))
            {
                echo "<img class='card-img-top' height='125px' src='../../assets/img/product/noproduct.png' />";
            }
            else{
                echo "<img class='card-img-top' height='125px' src='../../assets/img/product/".$value['img']."' />";
            }
        ?>
        
    </div>
    <div class="col-8 ">
        <div class="d-flex justify-content-between mt-3">
            <h5> <?php echo $value['name']; ?></h5>
            <h4><?php echo $value['price']*$value['quantity']; ?> บาท</h4>
        </div>
        <div class="d-flex justify-content-between mt-3">
            <div class="d-flex justify-content-between border rounded ">
                <div class="p-1 flex-fill"><button type='submit' class="btn plus" name='plus_cart' id='<?php echo $value['id'] ?>'>+</button></div>
                <div class="p-2 flex-fill text-center mt-1"><?php echo $value['quantity']; ?></div>
                <div class="p-1 flex-fill"><button type='submit' class="btn minus" name='minus_cart' id='<?php echo $value['id'] ?>'>-</button></div>
            </div>
            <button class="btn btn-danger delete" type='submit' name='delete' id='<?php echo $value['id'] ?>'> <i class="fa fa-times-circle" aria-hidden="true"></i> ลบ</button>
        </div>
    </div>
</div>
<?php
    $total_price+= $value['price']*$value['quantity'];
    }
    echo "<div class='d-flex justify-content-between mt-3'>";
    echo "<h5>ราคารวมทั้งหมด : </h5>";
    echo "<h5>$total_price บาท</h5>";
    echo "</div>";
}
?>