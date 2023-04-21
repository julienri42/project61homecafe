<?php 
    session_start();
    include('../../assets/connect/conn.php');
    
   
    
    if(isset($_POST['information_name'])&&isset($_POST['information_details']))
    {
        if(empty($_FILES['information_img']['name']))
        {
            $information_img="";
        }
        else
        {
            $pic_name=$_FILES['information_img']['name'];
            $information_img=str_shuffle(date("dmYHIs"))."_".$pic_name;
            $pic_temp=$_FILES['information_img']['tmp_name'];
            copy($pic_temp,"../../assets/img/information/$information_img");
          
            // if(isset($_POST['information_img2'])){
            //     $information_img2=$_POST['information_img2'];
            //     unlink("../../assets/img/information/$information_img2");
            // }
        }

        $information_id=$_POST['information_id'];
        $information_name=$_POST['information_name'];
        $information_details=$_POST['information_details'];

        $sql ="UPDATE informations SET information_name='$information_name',information_details='$information_details'";
         if($information_img=="")
         {
 
         }
         else{
            $sql= $sql.",information_img='$information_img'";
         }
         $sql =$sql."WHERE information_id='$information_id'";
        if ($connect->query($sql) === TRUE) {
            echo "Record updated successfully";
            header('Location: information.php');
          } else {
            echo "Error updating record: " . $connect->error;
          }
    }
    else{
        $_SESSION['edit_status']= "1"; //กรอกข้อมูลไม่ครบ
        header('Location: information.php');
        
    }
   
    mysqli_close($connect);
    
?>