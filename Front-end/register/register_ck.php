<?php 
    session_start();
    include('../../assets/connect/conn.php');
    if(empty($_POST['user_username'])||empty($_POST['user_password'])||
    $_POST['user_title']=="0"||empty($_POST['user_firstname'])||empty($_POST['user_surname'])
    ||empty($_POST['user_tel'])||empty($_POST['user_email'])){

        $_SESSION['register_status'] = "กรุณากรอกข้อมูลให้ครบ"; //กรอกข้อมูลไม่ครบ
        header('Location: register.php');
    }
    else
    {
        $user_username=$_POST['user_username'];
        $user_password=$_POST['user_password'];
        $user_title=$_POST['user_title'];
        $user_firstname=$_POST['user_firstname'];
        $user_surname=$_POST['user_surname'];
        $user_tel=$_POST['user_tel'];
        $user_email=$_POST['user_email'];

        $sqlcheck ="SELECT * FROM tb_user WHERE user_username ='$user_username'";
        $resulcheck = mysqli_query($connect,$sqlcheck);
        if(mysqli_num_rows($resulcheck)==0)
        {
            if (empty($_FILES['user_img']['name'])) {
                $user_img = "";
            } else {
                $pic_name = $_FILES['user_img']['name'];
                $user_img = str_shuffle(date("dmYHIs")) . "_" . $pic_name;
                $pic_temp = $_FILES['user_img']['tmp_name'];
                copy($pic_temp, "../../assets/img/user/$user_img");
            }

            $sql = "INSERT INTO tb_user(user_username,user_password,user_title,
                            user_firstname,user_surname,user_tel,user_email,usertype_id,user_img) 
                            VALUES('$user_username','$user_password','$user_title',
                            '$user_firstname','$user_surname','$user_tel','$user_email','1',
                            '$user_img')";
            if (mysqli_query($connect,$sql) === TRUE) {
                echo "Record updated successfully";
                $_SESSION['register_status'] = "สมัครสมาชิกสำเร็จ"; //เพิ่มข้อมูลสำเร็จ
                $login= mysqli_query($connect,$sqlcheck);
                while($row = mysqli_fetch_assoc($login))
                {
                    $_SESSION['user_id']= $row["user_id"];
                    $_SESSION['user_firstname']= $row["user_firstname"];
                    $_SESSION['user_surname']=$row["user_surname"];
                    $_SESSION['user_img']=$row["user_img"];
                    $_SESSION['usertype_id']=$row['usertype_id'];
                    $_SESSION['page'] ="index.php";
                }
                $_SESSION['edit_status']="4";
                header('Location: ../user.php');

            } else {
                echo "Error updating record: " . $connect->error;
            }

        }
        mysqli_free_result($resulcheck);
    }
    mysqli_close($connect);
?>