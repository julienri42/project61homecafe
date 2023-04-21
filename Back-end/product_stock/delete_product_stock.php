<?php 
    session_start();
    include('../../assets/connect/conn.php');
         
        $product_stock_id =$_GET['id'];
        $product_id=$_GET['product_id'];
        $product_name=$_GET['product_name'];
        $sql ="DELETE FROM tb_product_stock_list WHERE product_stock_id ='$product_stock_id '";
        if ($connect->query($sql) === TRUE) {
            echo "Record updated successfully";
            $_SESSION['edit_status']= "3";//ลบข้อมูลสำเร็จ
            header("Location: product_stock2.php?id=$product_id&&name=$product_name");
    
          } else {
            echo "Error updating record: " . $connect->error;
          }
       
    mysqli_close($connect);
    
?>