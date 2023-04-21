<?php 
    session_start();
    include('../../assets/connect/conn.php');


    if(isset($_POST['product_stock_id'])&&isset($_POST['product_stock_quantity'])&&isset($_POST['product_stock_remaining'])&&isset($_POST['product_stock_expiry_date'])){


        $product_stock_id=$_POST['product_stock_id'];
        $product_id=$_POST['product_id'];
        $total=$_POST['total'];
        $product_stock_date_added=date("Y-m-d H:i:s",time());
        $product_stock_quantity=$_POST['product_stock_quantity'];
        $product_stock_remaining=$_POST['product_stock_remaining'];
        $product_stock_expiry_date=$_POST['product_stock_expiry_date'];
        if($product_stock_quantity==$total)
        {
            $product_stock_remaining2=$product_stock_remaining;

        }
        elseif($product_stock_quantity>$total){
            $amountplusproduct=$product_stock_quantity-$total;
            $product_stock_remaining2=$product_stock_remaining+$amountplusproduct;
            $sql1 ="SELECT * FROM tb_listmaterial_to_product WHERE product_id='$product_id'";
            $result1 = $connect->query($sql1);
            while($row1 = $result1->fetch_array()){
                $material_id=$row1['material_id'];
                $totalmaterial_quantity=$amountplusproduct*$row1['listmaterial_quantity'];

                $sql2 ="SELECT * FROM tb_material_stock_list WHERE material_id='$material_id' AND material_stock_expiry_date>='$product_stock_date_added' 
                AND material_stock_remaining!='0' ORDER BY material_stock_expiry_date "; 
                $result2 = $connect->query($sql2);
                while($row2 = $result2->fetch_array()){
                if($totalmaterial_quantity>0){
                    $material_stock_id=$row2['material_stock_id']; 
                    $material_stock_remaining=$row2['material_stock_remaining']-$totalmaterial_quantity;

                    if($material_stock_remaining<0){
                        $material_stock_remaining=0;
                        $listmaterial_quantity2=$row2['material_stock_remaining']; 
                    }else{
                        $listmaterial_quantity2=$totalmaterial_quantity;
                    }

                    $sql3="UPDATE tb_material_stock_list SET material_stock_remaining='$material_stock_remaining' WHERE material_stock_id='$material_stock_id'";
                    $connect->query($sql3);
                    /////////////////////
                    $totalmaterial_quantity=$totalmaterial_quantity-$row2['material_stock_remaining']; 
                }
            }    

        }

            
        }
        elseif($product_stock_quantity<$total){
            $amountplusproduct=$total-$product_stock_quantity;
            if($amountplusproduct!=0){
                $product_stock_remaining2=$product_stock_remaining-$amountplusproduct;
            }
            else{
                $product_stock_remaining2=$product_stock_remaining;
           }
            $sql1 ="SELECT * FROM tb_listmaterial_to_product WHERE product_id='$product_id'";
            $result1 = $connect->query($sql1);
            while($row1 = $result1->fetch_array()){
                $material_id=$row1['material_id'];
                $totalmaterial_quantity=$amountplusproduct*$row1['listmaterial_quantity'];

                $sql2 ="SELECT * FROM tb_material_stock_list WHERE material_id='$material_id' AND material_stock_expiry_date>='$product_stock_date_added' 
                AND material_stock_remaining!='0' ORDER BY material_stock_expiry_date "; 
                $result2 = $connect->query($sql2);
                while($row2 = $result2->fetch_array()){
                if($totalmaterial_quantity>0){
                    $material_stock_id=$row2['material_stock_id']; 
                    $material_stock_remaining=$row2['material_stock_remaining']+$totalmaterial_quantity;

                    if($material_stock_remaining<0){
                        $material_stock_remaining=0;
                        $listmaterial_quantity2=$row2['material_stock_remaining']; 
                    }else{
                        $listmaterial_quantity2=$totalmaterial_quantity;

                    }

                    $sql3="UPDATE tb_material_stock_list SET material_stock_remaining='$material_stock_remaining' WHERE material_stock_id='$material_stock_id'";
                    $connect->query($sql3);
                    /////////////////////
                    $totalmaterial_quantity=$totalmaterial_quantity-$row2['material_stock_remaining']; 
                }
            }    

        }
                
        }

        $sql ="UPDATE tb_product_stock_list SET product_stock_quantity='$product_stock_quantity',product_stock_remaining='$product_stock_remaining2'
        ,product_stock_expiry_date='$product_stock_expiry_date' WHERE product_stock_id='$product_stock_id'";
        if ($connect->query($sql) === TRUE)
         {
            echo "Record updated successfully";
            $_SESSION['edit_status']= "2";//แก้ไขข้อมูลสำเร็จ
            header('Location: product_stock.php');

        } else {
        echo "Error updating record: " . $connect->error;
        }
      
    } else{
        $_SESSION['edit_status']= "1"; //กรอกข้อมูลไม่ครบ
        //header('Location: product_stock.php');
        
    }
?>