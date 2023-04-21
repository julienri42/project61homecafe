<?php 
    session_start();
    include('../../assets/connect/conn.php');
        $usertype_discount=$_POST['usertype_discount'];
        $usertype_id=$_POST['usertype_id'];
        $sql ="UPDATE tb_usertype SET usertype_discount='$usertype_discount'  WHERE usertype_id ='$usertype_id'";
        if ($connect->query($sql) === TRUE) {
            echo "Record updated successfully";
            $_SESSION['edit_status']= "2";//แก้ไขข้อมูลสำเร็จ
            header('Location: usertype.php');
            if(empty($employee_img))
            {

            }
            else{

            }
            
          } else {
            echo "Error updating record: " . $connect->error;
          }

    
    mysqli_close($connect);
    
?>