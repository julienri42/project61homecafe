<?php 
    session_start();
    include('../../assets/connect/conn.php');
    $time=date("Y-m-d H:i:s",time());
    if (empty($_SESSION['cart'])) {
        $_SESSION['register_status'] = "กรุณาเลือกสินค้า";
        header('Location: ../index.php');   
    }
    else{
        ////เช็คจำนวนสินค้าในคลัง
        foreach ($_SESSION['cart'] as $key => $value) { 
            $id=$value['id'];
            $name=$value['name'];
            $quantity=$value['quantity'];

            $check=mysqli_query($connect,"SELECT  sum(product_stock_remaining) FROM  tb_product_stock_list WHERE product_id='$id' AND product_stock_expiry_date>='$time'");
            list($chkmax)=mysqli_fetch_row($check);         
            if($quantity>$chkmax)
            {
                $_SESSION['register_status'] = "$name มีเหลือ $max ชิ้น";
                $cart_id = array_column($_SESSION['cart'], "id");
                $position=array_search($id,$cart_id);
                //$_SESSION['cart'][$position]['quantity']=$max;
                //header('Location: ../index.php');
                exit();
            }
        }
        ///ทำรายการ
        $mysqlorderid=mysqli_query($connect,"SELECT order_id FROM tb_order ORDER BY order_id DESC limit 1");
        list($order_id)=mysqli_fetch_row($mysqlorderid); 
        $order_id+=1;
        $user_id=$_SESSION['user_id'];

        $order_total=$_POST['order_total'];
        $order_discount=$_POST['order_discount'];
        $order_expiration_date=date("Y-m-d H:i:s",strtotime('+3 day'));
        $mysqlorder="INSERT INTO tb_order (user_id,order_receipt_no,order_total,order_discount
        ,order_date_added,order_expiration_date,order_status)
        VALUES('$user_id','$order_id','$order_total','$order_discount'
        ,'$time','$order_expiration_date','รอการชำระเงิน')";
        if (mysqli_query($connect,$mysqlorder) === TRUE) {
            foreach ($_SESSION['cart'] as $key => $value) { 
                $id=$value['id'];
                $name=$value['name'];
                $quantity=$value['quantity'];
                $price=$value['price'];
                $total=$quantity*$price;
                ///เพิ่ม
                $mysqlorderdetail="INSERT INTO tb_orderdetail (order_id,product_id ,orderdetail_quantity,orderdetail_price)
                VALUES('$order_id','$id','$quantity','$total')";
                mysqli_query($connect,$mysqlorderdetail);
                ///หักสินค้าในคลัง
                $selectproductstock="SELECT 	product_stock_id,product_stock_remaining FROM tb_product_stock_list 
                WHERE product_id='$id' AND product_stock_remaining!='0' AND product_stock_expiry_date>='$time' ORDER BY product_stock_expiry_date";
                $result = mysqli_query($connect,$selectproductstock);
                while ($row = mysqli_fetch_assoc($result)) {
                    if($quantity>0)
                    {
                        $product_stock_id=$row['product_stock_id'];
                        $product_stock_remaining=$row['product_stock_remaining']-$quantity;
                        if($product_stock_remaining<0){
                            $product_stock_remaining=0;
                        }
                        $updateproduct="UPDATE tb_product_stock_list SET 	product_stock_remaining='$product_stock_remaining' WHERE product_stock_id ='$product_stock_id'";
                        if (mysqli_query($connect,$updateproduct) === TRUE) {
                            $quantity=$quantity-$row['product_stock_remaining'];
                        }
                    }
                } 
             

            }
            unset($_SESSION['cart']);
            $_SESSION['register_status'] = "ทำรายการสำเร็จ";
            header("Location: transaction_succeed.php?id=$order_id"); 
        } else {
            echo "Error updating record: " . $connect->error;
        }
       


    }
?>