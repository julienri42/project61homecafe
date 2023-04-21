<?php 
    session_start();
    include('../../assets/connect/conn.php');
         
        $typematerial_id=$_GET['id'];
        $sql ="DELETE FROM tb_typematerial WHERE typematerial_id='$typematerial_id'";
        if ($connect->query($sql) === TRUE) {
            echo "Record updated successfully";
            $_SESSION['edit_status']= "3";//ลบข้อมูลสำเร็จ
            header('Location: typematerial.php');
    
          } else {
            echo "Error updating record: " . $connect->error;
          }
       
    mysqli_close($connect);
    
?>

<!-- แก้ไข -->
<!-- $typematerial_id=$_GET['id'];
        $sql ="UPDATE  tb_typematerial SET typematerial_delete='1' WHERE typematerial_id='$typematerial_id'";
        if ($connect->query($sql) === TRUE) {
            echo "Record updated successfully";
            $_SESSION['edit_status']= "3";//ลบข้อมูลสำเร็จ
            header('Location: typematerial.php');
    
          } else {
            echo "Error updating record: " . $connect->error;
          } -->