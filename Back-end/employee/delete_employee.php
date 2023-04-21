<?php 
     session_start();
     include('../../assets/connect/conn.php');
     if(isset($_GET['employee_img2'])){
      $employee_img2=$_GET['employee_img2'];
      unlink("../../assets/img/employee/$employee_img2");
      
    }
    $employee_id=$_GET['id'];
    $sql ="UPDATE tb_employee SET employee_delete='1',employee_img='' WHERE employee_id=$employee_id";
    if ($connect->query($sql) === TRUE) {
        echo "Record updated successfully";
        $_SESSION['edit_status']= "3";//แก้ไขข้อมูลสำเร็จ
        header('Location: employee.php');
      } else {
        echo "Error updating record: " . $connect->error;
      }
      mysqli_close($connect);
?>