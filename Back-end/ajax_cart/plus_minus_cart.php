<?php 
    session_start();
    if (isset($_POST['function']) && $_POST['function'] == 'plus') {
        $cart_id = array_column($_SESSION['cart'], "id");
        $position=array_search($_POST['id'],$cart_id);
        $max=$_SESSION['cart'][$position]['max'];
        $quantity=$_SESSION['cart'][$position]['quantity'];
        if($max=$quantity)
        {
            $_SESSION['cart'][$position]['quantity']+=1;
        }
        else{

        }
         
    }
    if (isset($_POST['function']) && $_POST['function'] == 'minus') {
        $cart_id = array_column($_SESSION['cart'], "id");
        $position=array_search($_POST['id'],$cart_id);
        $quantity=$_SESSION['cart'][$position]['quantity'];
        if($quantity>"1")
        {
            $_SESSION['cart'][$position]['quantity']-=1; 
        }
        else{
           
        }
        
    }
?>