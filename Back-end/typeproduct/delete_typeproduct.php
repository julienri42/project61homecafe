<?php 
    session_start();
    include('../../assets/connect/conn.php');
         
        $typeproduct_id=$_GET['id'];
        $sql ="DELETE FROM tb_typeproduct WHERE typeproduct_id='$typeproduct_id'";
        if ($connect->query($sql) === TRUE) {
            echo "Record updated successfully";
            $_SESSION['edit_status']= "3";//ลบข้อมูลสำเร็จ
            header('Location: typeproduct.php');
    
          } else {
            echo "Error updating record: " . $connect->error;
          }
       
    mysqli_close($connect);
    
?>


<!-- แก้ไข -->
<!-- $typeproduct_id=$_GET['id'];
        $sql ="UPDATE  tb_typeproduct SET typeproduct_delete='1' WHERE typeproduct_id='$typeproduct_id'";
        if ($connect->query($sql) === TRUE) {
            echo "Record updated successfully";
            $_SESSION['edit_status']= "3";//ลบข้อมูลสำเร็จ
            header('Location: typeproduct.php');
    
          } else {
            echo "Error updating record: " . $connect->error;
          } -->