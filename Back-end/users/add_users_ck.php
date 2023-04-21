<?php 
    session_start();
    include('../../assets/connect/conn.php');
    
    if (empty($_FILES['user_img']['name'])) {
        $user_img = "";
    } else {
        $pic_name = $_FILES['user_img']['name'];
        $user_img = str_shuffle(date("dmYHIs")) . "_" . $pic_name;
        $pic_temp = $_FILES['user_img']['tmp_name'];
        copy($pic_temp, "../../assets/img/user/$user_img");
    }
    $user_username = $_POST['user_username'];
    $user_password = $_POST['user_password'];
    $user_title = $_POST['user_title'];
    $user_firstname = $_POST['user_firstname'];
    $user_surname = $_POST['user_surname'];
    $user_tel = $_POST['user_tel'];
    $user_email = $_POST['user_email'];
    $usertype_id = $_POST['usertype_id'];
    $sql = "INSERT INTO tb_user(user_username,user_password,user_title,
                            user_firstname,user_surname,user_tel,user_email,usertype_id,user_img) 
                            VALUES('$user_username','$user_password','$user_title',
                            '$user_firstname','$user_surname','$user_tel','$user_email','$usertype_id','$user_img')";

    if ($connect->query($sql) === TRUE) {
        echo "Record updated successfully";
        $_SESSION['edit_status'] = "4"; //แก้ไขข้อมูลสำเร็จ
        header('Location: users.php');
    } else {
        echo "Error updating record: " . $connect->error;
    }
   
    mysqli_close($connect);
