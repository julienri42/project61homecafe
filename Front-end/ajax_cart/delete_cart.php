<?php 
     session_start();
     if (isset($_POST['function']) && $_POST['function'] == 'delete_all') {
        unset($_SESSION['cart']);
     }
     if (isset($_POST['function']) && $_POST['function'] == 'delete') {
        $cart_id = array_column($_SESSION['cart'], "id");
        $position=array_search($_POST['id'],$cart_id);
        unset($_SESSION['cart'][$position]);
    }
?>