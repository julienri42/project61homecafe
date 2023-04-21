<?php 
    session_start();
    include('../../assets/connect/conn.php');
         
        $information_id=$_GET['id'];

        if(isset($_GET['information_img2'])){
          $information_img2=$_GET['information_img2'];
          unlink("../../assets/img/information/$information_img2");
        }
        $sql ="UPDATE informations SET information_delete='1' , information_img=''  WHERE information_id='$information_id'";
        if ($connect->query($sql) === TRUE) {
            $_SESSION['edit_status']= "3";//ลบข้อมูลสำเร็จ
            header('Location: information.php');
    
          } else {
            echo "Error updating record: " . $connect->error;
          }
       
    mysqli_close($connect);
    
?>