<?php 
    session_start();
    include('../../assets/connect/conn.php');
    
    
    if(isset($_POST['typeproduct_name']))
        {
            $typeproduct_id=$_POST['typeproduct_id'];
            $typeproduct_name = $_POST['typeproduct_name'];
            $sql ="UPDATE tb_typeproduct SET typeproduct_name='$typeproduct_name' WHERE typeproduct_id='$typeproduct_id'";
        if ($connect->query($sql) === TRUE) {
            echo "Record updated successfully";
            $_SESSION['edit_status']= "2";//เพิ่มข้อมูลสำเร็จ
            header('Location: typeproduct.php');
    
          } else {
            echo "Error updating record: " . $connect->error;
          }
    }
    else{
        $_SESSION['edit_status']= "1"; //กรอกข้อมูลไม่ครบ
        header('Location: typeproduct.php');
    }
    
    mysqli_close($connect);
    
?>