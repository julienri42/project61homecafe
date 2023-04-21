<?php 
    session_start();
    include('../../assets/connect/conn.php');


    if(isset($_POST['product_stock_id'])&&isset($_POST['product_stock_quantity'])&&isset($_POST['product_stock_remaining'])&&isset($_POST['product_stock_expiry_date'])){
        $product_stock_id=$_POST['product_stock_id'];
        $product_stock_quantity=$_POST['product_stock_quantity'];
        $product_stock_remaining=$_POST['product_stock_remaining'];
        $product_stock_expiry_date=$_POST['product_stock_expiry_date'];
        $sql ="UPDATE tb_product_stock_list SET product_stock_quantity='$product_stock_quantity',product_stock_remaining='$product_stock_remaining'
        ,product_stock_expiry_date='$product_stock_expiry_date' WHERE product_stock_id='$product_stock_id'";
        if ($connect->query($sql) === TRUE)
         {
            echo "Record updated successfully";
            $_SESSION['edit_status']= "2";//ลบข้อมูลสำเร็จ
            header('Location: product_stock.php');

        } else {
        echo "Error updating record: " . $connect->error;
        }
      
    } else{
        $_SESSION['edit_status']= "1"; //กรอกข้อมูลไม่ครบ
        //header('Location: product_stock.php');
        
    }
?>