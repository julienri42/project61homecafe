<?php 
    session_start();
    include('../../assets/connect/conn.php');
    $time=date("Y-m-d H:i:s",time());
    if($_POST['order_id']=="0"||empty($_POST['payment_name'])||empty($_POST['payment_price'])||empty($_POST['payment_date']))
    {
        $_SESSION['register_status'] = "กรุณากรอกช้อมูลให้ครบ";
        header('Location: payment_confirmation.php'); 
    }
    else
    {
        if (empty($_FILES['payment_img']['name'])) {
            $payment_img = "";
        } else {
            $pic_name = $_FILES['payment_img']['name'];
            $payment_img = str_shuffle(date("dmYHIs")) . "_" . $pic_name;
            $pic_temp = $_FILES['payment_img']['tmp_name'];
            copy($pic_temp, "../../assets/img/payment/$payment_img");
        }
        $order_id=$_POST['order_id'];
        $payment_name=$_POST['payment_name'];
        $payment_price=$_POST['payment_price'];
        $payment_date=$_POST['payment_date'];
        if(isset($_POST['payment_detail']))
        {
            $payment_detail=$_POST['payment_detail'];
        }
        else{
            $payment_detail="";
        }
        $user_id=$_SESSION['user_id'];
        $insertpayment="INSERT INTO tb_payment_notification(user_id,order_id,payment_name
        ,payment_price,payment_date,payment_detail,payment_img,payment_status,payment_added)
        VALUES('$user_id','$order_id','$payment_name','$payment_price','$payment_date','$payment_detail'
        ,'$payment_img','กำลังรอการอนุมัติ','$time')";
         if (mysqli_query($connect,$insertpayment) === TRUE) {
            $_SESSION['register_status'] = "ส่งการแจ้งชำระเงินสำเร็จ รอการอนุมัติการสั่งซื้อ";
            header('Location: ../index.php');
         }
        
    }    

       


    
?>