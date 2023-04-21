<?php
   session_start();
   include('../assets/connect/conn.php');
   if(empty($_POST['username'])&&empty($_POST['password'])){
        $_SESSION['result']="กรุณากรอก username และ password";
        echo "<script type ='text/javascript'>";
        echo "window.location='../Back-end/index.php';";
        echo "</script>";
   }
   else{
        $username=$_POST["username"];
        $password=$_POST["password"];
        $sql ="SELECT * FROM tb_user WHERE user_username='$username' AND user_password='$password'";
        $result = mysqli_query($connect,$sql);
        if (mysqli_num_rows($result)>0) {
        while($row = mysqli_fetch_assoc($result))
        {

            $_SESSION['user_id']= $row["user_id"];
            $_SESSION['user_firstname']= $row["user_firstname"];
            $_SESSION['user_surname']=$row["user_surname"];
            $_SESSION['user_img']=$row["user_img"];
            $_SESSION['page'] ="index.php";
            $_SESSION['usertype_id']=$row['usertype_id'];
            $sql2="SELECT * FROM tb_usertype WHERE usertype_id='".$_SESSION['usertype_id']."'";
            $result2 = mysqli_query($connect,$sql2);
            while($row2 = mysqli_fetch_assoc($result2))
            {
                $_SESSION['usertype_name']=$row2['usertype_name'];
                $_SESSION['usertype_discount']=$row2['usertype_discount'];
            }
           
            echo "<script type ='text/javascript'>";
            echo "window.location='index.php';";
            echo "</script>";
            

           
        }
     }
     else{
            $_SESSION['result']="คุณกรอก username หรือ password ผิด";
            echo "<script type ='text/javascript'>";
            echo "window.location='../Back-end/index.php';";
            echo "</script>";
     }
     mysqli_free_result($result);
     mysqli_close($connect);
   }
  
?>