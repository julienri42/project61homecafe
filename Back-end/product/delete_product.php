<?php 
    session_start();
    include('../../assets/connect/conn.php');
         
        $product_id=$_GET['id'];

        if(isset($_GET['product_img2'])){
          $product_img2=$_GET['product_img2'];
          unlink("../../assets/img/product/$product_img2");
        }
        if(isset($_GET['make'])){
            $sql="DELETE FROM  tb_listmaterial_to_product WHERE product_id='$product_id'";
            if ($connect->query($sql) === TRUE) {

            }
        }
        $sql ="UPDATE tb_product_list SET product_delete='1' , product_img=''  WHERE product_id='$product_id'";
        if ($connect->query($sql) === TRUE) {
            $_SESSION['edit_status']= "3";//ลบข้อมูลสำเร็จ
            header('Location: product.php');
    
          } else {
            echo "Error updating record: " . $connect->error;
          }
       
    mysqli_close($connect);
    
?>