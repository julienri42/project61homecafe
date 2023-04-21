<?php 
    session_start();
    include('../assets/connect/conn.php');
   
    if(empty($_FILES['employee_img']['name']))
    {
        $employee_img="";
    }
    else
    {
        $pic_name=$_FILES['employee_img']['name'];
        $employee_img=str_shuffle(date("dmYHIs"))."_".$pic_name;
        $pic_temp=$_FILES['employee_img']['tmp_name'];
        copy($pic_temp,"../assets/img/employee/$employee_img"); 
        if(isset($_POST['employee_img2'])){
            $employee_img2=$_POST['employee_img2'];
            unlink("../assets/img/employee/$employee_img2");
        }
    }
        $sql ="UPDATE tb_employee SET employee_password ='".$_POST['employee_password']."'
        ,employee_title='".$_POST['employee_title']."',employee_firstname='".$_POST['employee_firstname']."',employee_surname ='".$_POST['employee_surname']."',employee_tel='".$_POST['employee_tel']."'
        ,employee_email='".$_POST['employee_email']."',employee_workdate='".$_POST['employee_workdate']."'";
        if($employee_img=="")
        {

        }
        else{
            $sql =$sql.",employee_img='".$employee_img."'";
        }
       
        $sql =$sql." WHERE employee_id =".$_POST['employee_id']."";
        if ($connect->query($sql) === TRUE) {
            echo "Record updated successfully";
            $_SESSION['edit_status']= "2";//แก้ไขข้อมูลสำเร็จ
            $_SESSION['employee_firstname']= $_POST['employee_firstname'];
            $_SESSION['employee_surname']=$_POST["employee_surname"];
            header('Location: admin_home.php');
            if(empty($employee_img))
            {

            }
            else{
                $_SESSION['employee_img']=$employee_img;
            }
            
          } else {
            echo "Error updating record: " . $connect->error;
          }

    
    mysqli_close($connect);
    
?>