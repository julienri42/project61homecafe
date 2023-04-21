<?php 
    session_start();
    include('../../assets/connect/conn.php');
    
    
    if(isset($_POST['material_name'])&&isset($_POST['typematerial_id'])
    &&isset($_POST['material_description']))
    {
            $material_id= $_POST['material_id'];
            $material_name = $_POST['material_name'];
            $typematerial_id = $_POST['typematerial_id'];
            $material_description = $_POST['material_description'];
            $material_usedunit=$_POST['material_usedunit'];
            if(!empty($_POST['material_buyunit']))
            {
              $material_buyunit=$_POST['material_buyunit'];
            }else{
              $material_buyunit="";
            }
            if(!empty($_POST['material_buyconversionused']))
            {
              $material_buyconversionused=$_POST['material_buyconversionused'];
            }else{
              $material_buyconversionused="";
            }
            if($material_usedunit=="อื่นๆ")
            {
              $material_usedunit=$_POST['otherusedunit'];
            }
            if($material_buyunit=="อื่นๆ")
            {
              $material_buyunit=$_POST['otherbuyunit'];
            }
            $material_date_updated=date("Y-m-d H:i:s",time());
            $sql ="UPDATE tb_material_list SET material_name='$material_name',typematerial_id='$typematerial_id',material_description='$material_description'
            ,material_date_updated='$material_date_updated',material_usedunit='$material_usedunit',material_buyunit='$material_buyunit',material_buyconversionused='$material_buyconversionused'
            WHERE material_id='$material_id'";
        if ($connect->query($sql) === TRUE) {
            echo "Record updated successfully";
            $_SESSION['edit_status']= "2";//เพิ่มข้อมูลสำเร็จ
            header('Location: material.php');
    
          } else {
            echo "Error updating record: " . $connect->error;
          }
         
    }
    else{
        $_SESSION['edit_status']= "1"; //กรอกข้อมูลไม่ครบ
        //header('Location: material.php');
        
    }
    
    mysqli_close($connect);
    
?>