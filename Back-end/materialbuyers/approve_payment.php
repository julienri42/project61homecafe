<?php
    session_start();
    include('../../assets/connect/conn.php');
    $matbuy_id=$_GET['id'];
    $employee_id=$_SESSION['employee_id'];
    ///อนุมัติแจ้งชำระเงิน
    // $sql="UPDATE tb_payment_notification SET payment_status='อนุมัติการสั่งซื้อ',employee_id='$employee_id' WHERE order_id='$order_id'";
    mysqli_query($connect,$sql);
    ///อนุมัติการสั่งซื้อ
    $sqlorder="UPDATE materialbuyers SET matbuy_status='ซื้อของเข้าร้านเรียบร้อยแล้ว',employee_id='$employee_id' WHERE matbuy_id ='$matbuy_id '";
    if (mysqli_query($connect,$sqlorder) === TRUE) 
    {
        $_SESSION['edit_status']= "2"; //กรอกข้อมูลไม่ครบ
        echo "<script type ='text/javascript'>";
        echo "window.opener.location='matbuypage.php';";
        echo "window.close();";
        echo "</script>";
    }     
?>
      