<?php 
    session_start();
    include('../../assets/connect/conn.php');    
        ///////
        
        if(isset($_POST['mid']))
        {
            $product_name=$_SESSION['$product_name'];    
            $sql ="SELECT * FROM tb_product_list WHERE product_name='$product_name'";
            $result = $connect->query($sql);
            while($row = $result->fetch_array())
            {
                $product_id=$row['product_id'];
            }
            $mid=$_POST['mid'];
            $amount=$_POST['amount'];
            for($i=0;$i<count($mid);$i++)
            {
                $material_id=$mid[$i];
                $listmaterial_quantity=$amount[$i];
                $sql1 ="INSERT INTO tb_listmaterial_to_product(product_id,material_id,listmaterial_quantity)
                VALUES('$product_id','$material_id','$listmaterial_quantity')";
                if ($connect->query($sql1) === TRUE) 
                {

                }
            }
            unset ($_SESSION['$product_name']);
            unset ($_SESSION["mid"]);
            unset ($_SESSION["amount"]);
            $_SESSION['edit_status']= "4";//เพิ่มข้อมูลสำเร็จ
            header('Location:product.php');
        }else{

            $_SESSION['edit_status']= "1"; //กรอกข้อมูลไม่ครบ
            header('Location: add_product2_detail.php');
        }
        
    mysqli_close($connect);
    
?>