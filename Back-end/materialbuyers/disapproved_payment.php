<?php
    session_start();
    include('../../assets/connect/conn.php');
    $order_id=$_GET['id'];
    $employee_id=$_SESSION['employee_id'];
    ///อนุมัติแจ้งชำระเงิน
    $sql="UPDATE tb_payment_notification SET payment_status='ยกเลิกซิ้อของเข้าร้าน' WHERE order_id='$order_id'"; 
    if (mysqli_query($connect,$sql) === TRUE) 
    {
        $_SESSION['edit_status']= "3"; //กรอกข้อมูลไม่ครบ
        echo "<script type ='text/javascript'>";
        echo "window.opener.location='matbuypage.php';";
        echo "window.close();";
        echo "</script>";
    }     
?>
      