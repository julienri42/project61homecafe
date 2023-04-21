<?php 
    session_start();
    include('../../assets/connect/conn.php');
         
        $material_stock_id =$_GET['id'];
        $product_id=$_GET['product_id'];
        $product_name=$_GET['product_name'];
        $sql ="DELETE FROM tb_material_stock_list WHERE material_stock_id ='$material_stock_id '";
        if ($connect->query($sql) === TRUE) {
            echo "Record updated successfully";
            $_SESSION['edit_status']= "3";//ลบข้อมูลสำเร็จ
            header('Location: material_stock.php');
    
          } else {
            echo "Error updating record: " . $connect->error;
          }
       
    mysqli_close($connect);
    
?>