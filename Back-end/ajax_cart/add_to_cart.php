<?php 

session_start();



  if (isset($_SESSION['cart'])) {

  	
       $cart_id = array_column($_SESSION['cart'], "id");

       $chk=array_search($_POST['id'],$cart_id);

  	if ($chk!== false) {
               $max=$_SESSION['cart'][$chk]['max'];
               $quantity=$_SESSION['cart'][$chk]['quantity'];
               if($max>$quantity)
               {
                    $_SESSION['cart'][$chk]['quantity']+=1; 
               }
               else{
                   //alert
               }
                
  	}
       else{
              $item_array = array(
                     "id" => $_POST['id'],
                     "name" => $_POST['name'],
                     "quantity" => $_POST['quantity'],
                     "max" => $_POST['max'],
                     );
            
            
                   $_SESSION['cart'][] = $item_array;
       }
  	
  }else{

  	$item_array = array(
         "id" => $_POST['id'],
         "name" => $_POST['name'],
         "quantity" => $_POST['quantity'],
         "max" => $_POST['max'],
  	);


  $_SESSION['cart'][] = $item_array;
  }




 ?>