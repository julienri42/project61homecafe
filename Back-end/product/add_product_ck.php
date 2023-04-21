<?php 
    session_start();
    include('../../assets/connect/conn.php');
    
    if(empty($_FILES['product_img']['name']))
    {
        $product_img="";
    }
    else
    {
        $pic_name=$_FILES['product_img']['name'];
        $product_img=str_shuffle(date("dmYHIs"))."_".$pic_name;
        $pic_temp=$_FILES['product_img']['tmp_name'];
        copy($pic_temp,"../../assets/img/product/$product_img");
    }
    if(isset($_POST['product_name'])&&$_POST['typeproduct_id']!="0"&&isset($_POST['product_description'])
    &&isset($_POST['product_price'])&&$_POST['product_unit']!='0'&&$_POST['product_make']!='0')
    {
        $product_name=$_POST['product_name'];
        $typeproduct_id=$_POST['typeproduct_id'];
        $product_description=$_POST['product_description'];
        $product_price=$_POST['product_price'];
        $product_status=$_POST['product_status'];
        $product_date_created=date("Y-m-d H:i:s",time());
        $product_date_updated=date("Y-m-d H:i:s",time());

        $product_unit=$_POST['product_unit'];
        $product_make=$_POST['product_make'];
        
        if($product_unit=="อื่นๆ")
        {
            $product_unit=$_POST['otherunit'];
        }
        $sql ="INSERT INTO tb_product_list(product_name,typeproduct_id,product_description
        ,product_price,product_status,product_date_created,product_date_updated
        ,product_img,product_make,product_unit) 
        VALUES('$product_name','$typeproduct_id','$product_description','$product_price'
        ,'$product_status','$product_date_created',' $product_date_updated','$product_img','$product_make','$product_unit')";
        
        if ($connect->query($sql) === TRUE) {
            echo "Record updated successfully";
            if($product_make=="ทำเอง")
            {
                
                $_SESSION['$product_name']=$product_name;
                unset ($_SESSION["mid"]);
                unset ($_SESSION["amount"]);
                header('Location:add_product2_detail.php'); 

            }
            if($product_make=="รับมาขาย")
            {
                $_SESSION['edit_status']= "4";//เพิ่มข้อมูลสำเร็จ
                header('Location:product.php');
            }
           
          } else {
            echo "Error updating record: " . $connect->error;
          }
    }
    else{
        $_SESSION['edit_status']= "1"; //กรอกข้อมูลไม่ครบ
        header('Location: product.php');
        
    }
    
    mysqli_close($connect);
    
?>