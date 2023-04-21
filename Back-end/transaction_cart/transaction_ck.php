<?php 
    session_start();
    include('../../assets/connect/conn.php');
    $time=date("Y-m-d H:i:s",time());
    if (empty($_SESSION['cart'])) {
        $_SESSION['register_status'] = "กรุณาเลือกสินค้า";
        header('Location: ../index.php');   
    }
    else{
        
        ///ทำรายการ
        $mysqlorderid=mysqli_query($connect,"SELECT matbuy_id FROM materialbuyers ORDER BY matbuy_id DESC limit 1");
        list($matbuy_id)=mysqli_fetch_row($mysqlorderid); 
        $matbuy_id+=1;
   

        $mysqlorder="INSERT INTO materialbuyers (matbuy_receipt_no,matbuy_date_added,matbuy_status)
        VALUES('$matbuy_id','$time','รอการซื้อของเข้าร้าน')";
        if (mysqli_query($connect,$mysqlorder) === TRUE) {
            foreach ($_SESSION['cart'] as $key => $value) { 
                $id=$value['id'];
                $name=$value['name'];
                $quantity=$value['quantity'];
  
                ///เพิ่ม
                $mysqlorderdetail="INSERT INTO materialbuyers_detail (matbuy_id,material_id,matbuy_detail_quantity)
                VALUES('$matbuy_id','$id','$quantity')";
                mysqli_query($connect,$mysqlorderdetail);
                
             

            }
            unset($_SESSION['cart']);
            $_SESSION['register_status'] = "ทำรายการสำเร็จ";
            header("Location: transaction_succeed.php?id=$matbuy_id"); 
        } else {
            echo "Error updating record: " . $connect->error;
        }
       


    }
?>