<?php 
     session_start();
     include('../../assets/connect/conn.php');
     if(isset($_GET['users_img2'])){
      $users_img2=$_GET['users_img2'];
      unlink("../../assets/img/user/$users_img2");
      
    }
    $employee_id=$_GET['id'];
    $sql ="UPDATE tb_user SET user_delete='1',user_img='' WHERE user_id=$employee_id";
    if ($connect->query($sql) === TRUE) {
        echo "Record updated successfully";
        $_SESSION['edit_status']= "3";//แก้ไขข้อมูลสำเร็จ
        header('Location: users.php');
      } else {
        echo "Error updating record: " . $connect->error;
      }
      mysqli_close($connect);
?>