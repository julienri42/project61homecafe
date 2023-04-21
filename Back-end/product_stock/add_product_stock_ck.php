<?php 
    session_start();
    include('../../assets/connect/conn.php');
  
    if(isset($_POST['product_id'])&&isset($_POST['product_stock_quantity'])&&isset($_POST['product_stock_expiry_date'])){

        $product_id=$_POST['product_id'];
        $product_stock_quantity=$_POST['product_stock_quantity'];
        $product_stock_price=$_POST['product_stock_price'];
        $product_stock_expiry_date=$_POST['product_stock_expiry_date'];
        $product_stock_date_added=date("Y-m-d H:i:s",time());
        $sql ="INSERT INTO tb_product_stock_list (product_id,product_stock_quantity,product_stock_remaining,product_stock_expiry_date,product_stock_date_added,product_stock_price)
        VALUES('$product_id','$product_stock_quantity','$product_stock_quantity','$product_stock_expiry_date','$product_stock_date_added','$product_stock_price')";
        
        if ($connect->query($sql) === TRUE)
         {
            echo "Record updated successfully";
            $_SESSION['edit_status']= "4";//เพิ่มข้อมูลสำเร็จ
            header('Location: product_stock.php');

        } else {
        echo "Error updating record: " . $connect->error;
        }
     /////////////////
        $sql2 = "SELECT * FROM tb_listmaterial_to_product WHERE product_id='$product_id'";
        $result2=mysqli_query($connect, $sql2);
        if (mysqli_num_rows($result2)>0) {
            while($row = mysqli_fetch_assoc($result2)){
                $material_id=$row['material_id'];
                $totalmaterial_quantity=$product_stock_quantity*$row['listmaterial_quantity'];
                $sql3 ="SELECT * FROM tb_material_stock_list WHERE material_id='$material_id' AND material_stock_expiry_date>='$product_stock_date_added' 
                AND material_stock_remaining!='0' ORDER BY material_stock_expiry_date "; 
                $result3=mysqli_query($connect, $sql3);
                while($row1 = mysqli_fetch_assoc($result3))
                {
                    if($totalmaterial_quantity>0){
                        $material_stock_id=$row1['material_stock_id']; 
                        $material_stock_remaining=$row1['material_stock_remaining']-$totalmaterial_quantity;
                        if($material_stock_remaining<0){
                            $material_stock_remaining=0;
                            $listmaterial_quantity2=$row1['material_stock_remaining']; 
                        }else{
                            $listmaterial_quantity2=$totalmaterial_quantity;
                        }
                        $sql4="UPDATE tb_material_stock_list SET material_stock_remaining='$material_stock_remaining' WHERE material_stock_id='$material_stock_id'";
                        $connect->query($sql4);
                        $totalmaterial_quantity=$totalmaterial_quantity-$row1['material_stock_remaining']; 
                    }
                }


            }
        }
        

    } else{
        $_SESSION['edit_status']= "1"; //กรอกข้อมูลไม่ครบ
        //header('Location: product_stock.php');
        
    }
?>