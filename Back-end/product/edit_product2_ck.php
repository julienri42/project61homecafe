<?php 
    session_start();
    include('../../assets/connect/conn.php');    

        if(isset($_POST['mid']))
        {
            $product_id= $_SESSION["product_id"];
            $sql="DELETE FROM  tb_listmaterial_to_product WHERE product_id='$product_id'";
            if ($connect->query($sql) === TRUE) {

            }
            $mid=$_POST['mid'];
            $amount=$_POST['amount'];
            for($i=0;$i<count($mid);$i++)
            {
                $material_id=$mid[$i];
                $listmaterial_quantity=$amount[$i];
                $sql1 ="INSERT INTO tb_listmaterial_to_product(product_id,material_id,listmaterial_quantity)
                VALUES('$product_id','$material_id','$listmaterial_quantity')";
                if ($connect->query($sql1) === TRUE) {

                }
            }
            unset ($_SESSION["mid"]);
            unset ($_SESSION["amount"]);
            $_SESSION['edit_status']= "2";//แก้ไขข้อมูลสำเร็จ
            header('Location:product.php');
        }
        
    mysqli_close($connect);
    
?>