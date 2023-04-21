<?php
    session_start();
    include('../../assets/connect/conn.php');
    $order_id=$_GET['id'];
    $employee_id=$_SESSION['employee_id'];
    ///อนุมัติแจ้งชำระเงิน
    $sql="UPDATE tb_payment_notification SET payment_status='อนุมัติการสั่งซื้อ',employee_id='$employee_id' WHERE order_id='$order_id'";
    mysqli_query($connect,$sql);
    ///อนุมัติการสั่งซื้อ
    $sqlorder="UPDATE tb_order SET order_status='ได้รับอาหารแล้ว',employee_id='$employee_id',order_expiration_date=NULL WHERE order_id='$order_id'";
    if (mysqli_query($connect,$sqlorder) === TRUE) 
    {
        $_SESSION['edit_status']= "2"; //กรอกข้อมูลไม่ครบ
        echo "<script type ='text/javascript'>";
        echo "window.opener.location='paymentpage.php';";
        echo "window.close();";
        echo "</script>";
    }     
?>
      