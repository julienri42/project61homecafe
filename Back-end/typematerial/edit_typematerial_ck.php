<?php 
    session_start();
    include('../../assets/connect/conn.php');
    
    
    if(isset($_POST['typematerial_name']))
        {
            $typematerial_id=$_POST['typematerial_id'];
            $typematerial_name = $_POST['typematerial_name'];
            $sql ="UPDATE tb_typematerial SET typematerial_name='$typematerial_name' WHERE typematerial_id='$typematerial_id'";
        if ($connect->query($sql) === TRUE) {
            echo "Record updated successfully";
            $_SESSION['edit_status']= "2";//เพิ่มข้อมูลสำเร็จ
            header('Location: typematerial.php');
    
          } else {
            echo "Error updating record: " . $connect->error;
          }
    }
    else{
        $_SESSION['edit_status']= "1"; //กรอกข้อมูลไม่ครบ
        header('Location: typematerial.php');
    }
    
    mysqli_close($connect);
    
?>