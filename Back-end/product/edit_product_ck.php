<?php 
    session_start();
    include('../../assets/connect/conn.php');
    
   
    
    if(isset($_POST['product_name'])&&$_POST['typeproduct_id']!="0"&&isset($_POST['product_description'])
    &&isset($_POST['product_price'])&&$_POST['product_unit']!="0"&&$_POST['product_make']!="0")
    {
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
          
            if(isset($_POST['product_img2'])){
                $product_img2=$_POST['product_img2'];
                unlink("../../assets/img/product/$product_img2");
            }
        }

        $product_id=$_POST['product_id'];
        $product_name=$_POST['product_name'];
        $typeproduct_id=$_POST['typeproduct_id'];
        $product_description=$_POST['product_description'];
        $product_price=$_POST['product_price'];
        $product_status=$_POST['product_status'];
        $product_date_updated=date("Y-m-d H:i:s",time());

        $product_unit=$_POST['product_unit'];
        $product_make=$_POST['product_make'];
        if($product_unit=="อื่นๆ")
        {
            $product_unit=$_POST['otherunit'];
        }

        
        $sql ="UPDATE tb_product_list SET product_name='$product_name',typeproduct_id='$typeproduct_id'
        ,product_description='$product_description',product_price='$product_price',product_unit='$product_unit',product_make='$product_make'
        ,product_status='$product_status',product_date_updated='$product_date_updated' ";
         if($product_img=="")
         {
 
         }
         else{
            $sql= $sql.",product_img='$product_img'";
         }
         $sql =$sql."WHERE product_id='$product_id'";
        if ($connect->query($sql) === TRUE) {
            echo "Record updated successfully";
            if($product_make=="รับมาขาย")
            {
                $sql2="SELECT * FROM tb_listmaterial_to_product WHERE product_id='$product_id'";
                $result2 = mysqli_query($connect,$sql2);
                if (mysqli_num_rows($result2)>0) 
                {
                   $sql3="DELETE FROM tb_listmaterial_to_product WHERE product_id='$product_id'";
                   mysqli_query($connect,$sql3);
                } 
                mysqli_free_result($result2);
                header('Location:product.php');
            }

            if($product_make=="ทำเอง")
            {
                header("Location:edit_product2_detail.php?id=$product_id");
            }
            $_SESSION['edit_status']= "2";//แก้ไขข้อมูลสำเร็จ
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