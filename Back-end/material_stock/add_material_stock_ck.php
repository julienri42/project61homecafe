<?php 
    session_start();
    include('../../assets/connect/conn.php');
    
    
    if(isset($_POST['material_amount'])&&isset($_POST['material_stock_expiry_date']))
    {
            $material_id = $_POST['material_id'];
            $material_amount = $_POST['material_amount'];
            $sql2="SELECT * FROM tb_material_list WHERE material_id='$material_id'";
            $result2=mysqli_query($connect,$sql2);
            while($row = mysqli_fetch_assoc($result2))
            {
              
              if($_POST['material_inputunit']==$row['material_usedunit'])
              {
                $material_stock_quantity=$material_amount;
              }
              if($_POST['material_inputunit']==$row['material_buyunit'])
              {
                $material_buyconversionused	=$row['material_buyconversionused'];
                $material_stock_quantity=$material_amount*$material_buyconversionused;
              }
            }

            $material_stock_expiry_date=$_POST['material_stock_expiry_date'];
            $material_stock_date_added=date("Y-m-d H:i:s",time());
            $material_stock_price=$_POST['price'];
            $sql ="INSERT INTO tb_material_stock_list(material_id,material_stock_quantity,material_stock_remaining
            ,material_stock_expiry_date,material_stock_date_added,material_stock_price)
            VALUES('$material_id','$material_stock_quantity','$material_stock_quantity','$material_stock_expiry_date','$material_stock_date_added','$material_stock_price')";
        if ($connect->query($sql) === TRUE) {
            echo "Record updated successfully";
            $_SESSION['edit_status']= "4";//เพิ่มข้อมูลสำเร็จ
            header('Location: material_stock.php');
    
          } else {
            echo "Error updating record: " . $connect->error;
          }
         
    }
    else{
        $_SESSION['edit_status']= "1"; //กรอกข้อมูลไม่ครบ
        header('Location: material_stock.php');
        
    }
    mysqli_free_result($result2);
    mysqli_close($connect);
    
?>