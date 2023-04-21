<?php
session_start();
include('../../assets/connect/conn.php');


if (isset($_GET['id'])) {
    $order_id=$_GET['id'];
    $order_service_id=$_SESSION['employee_id'];
    $sql = "UPDATE tb_order SET order_service_id='$order_service_id' WHERE order_id='$order_id'";

    if ($connect->query($sql) === TRUE) {
        echo "Record updated successfully";
        $_SESSION['edit_status'] = "4"; //แก้ไขข้อมูลสำเร็จ
        header('Location: service_input.php');
    } else {
        echo "Error updating record: " . $connect->error;
    }
} else {
    $_SESSION['edit_status'] = "3"; //กรอกข้อมูลไม่ครบ
    header('Location: service_input.php');
}

mysqli_close($connect);
