<?php 
    session_start();
    include('../assets/connect/conn.php');
    $time=date("Y-m-d H:i:s",time());
    if(isset($_POST['user_password'])&&$_POST['user_title']!="0"
        &&isset($_POST['user_firstname'])&&isset($_POST['user_surname'])
        &&isset($_POST['user_tel'])&&isset($_POST['user_email'])
        &&$_POST['usertype_id']!="0")
    {

        if(empty($_FILES['user_img']['name']))
        {
            $user_img="";
        }
        else
        {
            $pic_name=$_FILES['user_img']['name'];
            $user_img=str_shuffle(date("dmYHIs"))."_".$pic_name;
            $pic_temp=$_FILES['user_img']['tmp_name'];
            copy($pic_temp,"../assets/img/user/$user_img");
    
            if(isset($_POST['user_img2'])){
                $user_img2=$_POST['user_img2'];
                unlink("../assets/img/user/$user_img2");
            }
        }
        
       
        $user_password=$_POST['user_password'];
        $user_title=$_POST['user_title'];
        $user_firstname=$_POST['user_firstname'];
        $user_surname=$_POST['user_surname'];
        $user_tel=$_POST['user_tel'];
        $user_email=$_POST['user_email'];
        $user_id=$_POST['user_id'];
        $sql ="UPDATE tb_user SET  user_password ='$user_password'
        ,user_title='$user_title',user_firstname='$user_firstname',user_surname ='$user_surname'
        ,user_tel='$user_tel',user_email='$user_email'";
        if($user_img=="")
        {

        }
        else{
            $sql =$sql.",user_img='".$user_img."'";
        }
       
        $sql =$sql."WHERE user_id ='$user_id'";
        if ($connect->query($sql) === TRUE) {
            $_SESSION['user_id']= $user_id;
            $_SESSION['user_firstname']= $user_firstname;
            $_SESSION['user_surname']=$user_surname;
            if($user_img=="")
            {

            }
            else
            {
                $_SESSION['user_img']=$user_img;
            }
            echo "Record updated successfully";
            $_SESSION['edit_status']= "2";//แก้ไขข้อมูลสำเร็จ
            header('Location: user.php');
          
            
          } else {
            echo "Error updating record: " . $connect->error;
          }
    }
    else{
        $_SESSION['edit_status']= "1"; //กรอกข้อมูลไม่ครบ
        header('Location: user.php');
        
    }
    
    mysqli_close($connect);
    ?>