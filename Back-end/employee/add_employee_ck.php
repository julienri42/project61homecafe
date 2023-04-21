<?php 
    session_start();
    include('../../assets/connect/conn.php');
    


        if(empty($_FILES['employee_img']['name']))
        {
            $employee_img="";
        }
        else
        {
            $pic_name=$_FILES['employee_img']['name'];
            $employee_img=str_shuffle(date("dmYHIs"))."_".$pic_name;
            $pic_temp=$_FILES['employee_img']['tmp_name'];
            copy($pic_temp,"../../assets/img/employee/$employee_img");
        }

        $employee_username=$_POST['employee_username'];
        $employee_password=$_POST['employee_password'];
        $employee_title=$_POST['employee_title'];
        $employee_firstname=$_POST['employee_firstname'];
        $employee_surname=$_POST['employee_surname'];
        $employee_tel=$_POST['employee_tel'];
        $employee_email=$_POST['employee_email'];
        $employee_workdate=$_POST['employee_workdate'];
        $employee_position=$_POST['employee_position'];
        $sql ="INSERT INTO tb_employee(employee_username,employee_password,employee_title,
                            employee_firstname,employee_surname,employee_tel,employee_email,
                            employee_workdate,employee_img,
                            employee_position) 
                            VALUES('$employee_username','$employee_password','$employee_title',
                            '$employee_firstname','$employee_surname','$employee_tel','$employee_email',
                            '$employee_workdate','$employee_img','$employee_position')";
        if ($connect->query($sql) === TRUE) {
            echo "Record updated successfully";
            $_SESSION['edit_status']= "4";//เพิ่มข้อมูลสำเร็จ
            header('Location: employee.php');
    
          } else {
            echo "Error updating record: " . $connect->error;
          }
   
    mysqli_close($connect);
