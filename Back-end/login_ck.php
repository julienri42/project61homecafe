<?php
   session_start();
   include('../assets/connect/conn.php');
   if(empty($_POST['username'])&&empty($_POST['password'])){
            session_destroy();
        session_start();
        $_SESSION['result']="กรุณากรอก username และ password";
        echo "<script type ='text/javascript'>";
        echo "window.location='index.php';";
        echo "</script>";
   }
   else{
        $username=$_POST["username"];
        $password=$_POST["password"];
        $sql ="SELECT * FROM tb_employee WHERE employee_username='$username' AND employee_password='$password' AND employee_delete='0'";
        $result = mysqli_query($connect,$sql);
        if (mysqli_num_rows($result)>0) {
        while($row = mysqli_fetch_assoc($result))
        {

            $_SESSION['employee_id']= $row["employee_id"];
            $_SESSION['employee_firstname']= $row["employee_firstname"];
            $_SESSION['employee_surname']=$row["employee_surname"];
            $_SESSION['employee_img']=$row["employee_img"];
            $_SESSION['page'] ="admin_home.php";
            $_SESSION['employee_position']=$row['employee_position'];
            echo "<script type ='text/javascript'>";
            echo "window.location='admin_home.php';";
            echo "</script>";

           
        }
     }
     else{
            $_SESSION['result']="คุณกรอก username หรือ password ผิด";
            echo "<script type ='text/javascript'>";
            echo "window.location='index.php';";
            echo "</script>";
     }
   }
   mysqli_free_result($result);
   mysqli_close($connect);
?>