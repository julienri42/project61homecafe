<?php 
    session_start();
    include('../../assets/connect/conn.php');
         
        $material_id=$_GET['id'];
        $sql ="UPDATE tb_material_list SET material_delete='1' WHERE material_id='$material_id'";
        if ($connect->query($sql) === TRUE) {
            echo "Record updated successfully";
            $_SESSION['edit_status']= "3";//ลบข้อมูลสำเร็จ
            header('Location: material.php');
    
          } else {
            echo "Error updating record: " . $connect->error;
          }
       
    mysqli_close($connect);
    
?>