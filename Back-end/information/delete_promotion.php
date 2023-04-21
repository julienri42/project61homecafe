<?php 
    session_start();
    include('../../assets/connect/conn.php');
         
        $promotion_id=$_GET['id'];

        if(isset($_GET['promotion_img2'])){
          $promotion_img2=$_GET['promotion_img2'];
          unlink("../../assets/img/promotion/$promotion_img2");
        }
        $sql ="UPDATE promotions SET promotion_delete='1' , promotion_img=''  WHERE promotion_id='$promotion_id'";
        if ($connect->query($sql) === TRUE) {
            $_SESSION['edit_status']= "3";//ลบข้อมูลสำเร็จ
            header('Location: promotion.php');
    
          } else {
            echo "Error updating record: " . $connect->error;
          }
       
    mysqli_close($connect);
    
?>