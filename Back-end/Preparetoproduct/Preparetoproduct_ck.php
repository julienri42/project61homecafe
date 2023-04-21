<?php
    session_start();
    include('../../assets/connect/conn.php');
    $order_id=$_GET['id'];
    $employee_id=$_SESSION['employee_id'];
    ///อนุมัติการสั่งซื้อ
    $sqlorder="UPDATE tb_order SET order_status='รออาหารสักครู่'WHERE order_id='$order_id'";
    if (mysqli_query($connect,$sqlorder) === TRUE) 
    {
        $_SESSION['edit_status']= "1"; 
        echo "<script type ='text/javascript'>";
        echo "window.opener.location='Preparetoproduct.php';";
        echo "window.close();";
        echo "</script>";
    }     
?>
      