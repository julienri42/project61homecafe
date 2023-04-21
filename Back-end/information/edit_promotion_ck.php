<?php 
    session_start();
    include('../../assets/connect/conn.php');
    
   
    
    if(isset($_POST['promotion_name'])&&isset($_POST['promotion_details']))
    {
        if(empty($_FILES['promotion_img']['name']))
        {
            $promotion_img="";
        }
        else
        {
            $pic_name=$_FILES['promotion_img']['name'];
            $promotion_img=str_shuffle(date("dmYHIs"))."_".$pic_name;
            $pic_temp=$_FILES['promotion_img']['tmp_name'];
            copy($pic_temp,"../../assets/img/promotion/$promotion_img");
          
            // if(isset($_POST['promotion_img2'])){
            //     $promotion_img2=$_POST['promotion_img2'];
            //     unlink("../../assets/img/promotion/$promotion_img2");
            // }
        }

        $promotion_id=$_POST['promotion_id'];
        $promotion_name=$_POST['promotion_name'];
        $promotion_details=$_POST['promotion_details'];

        $sql ="UPDATE promotions SET promotion_name='$promotion_name',promotion_details='$promotion_details'";
         if($promotion_img=="")
         {
 
         }
         else{
            $sql= $sql.",promotion_img='$promotion_img'";
         }
         $sql =$sql."WHERE promotion_id='$promotion_id'";
        if ($connect->query($sql) === TRUE) {
            echo "Record updated successfully";
            header('Location: promotion.php');
          } else {
            echo "Error updating record: " . $connect->error;
          }
    }
    else{
        $_SESSION['edit_status']= "1"; //กรอกข้อมูลไม่ครบ
        header('Location: promotion.php');
        
    }
   
    mysqli_close($connect);
    
?>