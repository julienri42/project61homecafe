<?php 
     include('../../assets/connect/conn.php');

     if (isset($_POST['function']) && $_POST['function'] == 'typematerial') {
        $id = $_POST['id'];
        $sql = "SELECT * FROM tb_material_list WHERE typematerial_id ='$id'";
        $query = mysqli_query($connect, $sql);
        echo "<option value='0'>กรุณาเลือกข้อมูลวัตถุดิบ</option>";
        foreach ($query as $value) {
            echo '<option value="'.$value['material_id'].'">'.$value['material_name'].'</option>';
        }
        mysqli_free_result($query);
    }

    if (isset($_POST['function']) && $_POST['function'] == 'material') {
        $id = $_POST['id'];
        $sql = "SELECT * FROM tb_material_list WHERE material_id='$id'";
        $query = mysqli_query($connect, $sql);
        echo "<option value='0'>กรุณาเลือกข้อมูลวัตถุดิบ</option>";
        foreach ($query as $value) {
            if(!empty($value['material_buyunit']))
            {
                echo '<option value="'.$value['material_buyunit'].'"> รับเข้ามาแบบ'.$value['material_buyunit'].'</option>';
            }
            echo '<option value="'.$value['material_usedunit'].'"> รับเข้ามาแบบ'.$value['material_usedunit'].'</option>';
           
        }
        mysqli_free_result($query);
    }
    if (isset($_POST['function']) && $_POST['function'] == 'inputunit') {
        $id = $_POST['id'];
        echo "
        <div class='row'>
            <div class='col-8'><input type='number' name='material_amount' class='form-control' placeholder='กรุณากรอกจำนวน'></div>
            <div class='col-4 mt-2 mb-2'>$id</div>
        </div>
        ";    
    }
    if (isset($_POST['function']) && $_POST['function'] == 'inputunitedit') {
        $id = $_POST['id'];
        $mid=$_POST['mid'];
        $sql = "SELECT * FROM tb_material_stock_list AS m
        INNER JOIN tb_material_list AS t ON m.material_id=t.material_id 
        WHERE material_stock_id='$mid'";
        $query = mysqli_query($connect, $sql);
        foreach ($query as $value) {
            
            if($id==$value['material_usedunit'])
            {
                $material_stock_quantity=$value['material_stock_quantity'];
                echo "
                
                <td><p class='mt-2 mb-2 mr-3 float-right' >จำนวน".$value['material_usedunit'].":</p></td>
                <td><p class='mt-2 mb-2'>
                <div class='row'>
                    <div class='col-8'><input type='number' name='material_amount' value='$material_stock_quantity' class='form-control' placeholder='กรุณากรอกจำนวน'></div>
                    <div class='col-4 mt-2 mb-2'>$id</div>
                </div>
                </p></td>
                ";  
            }
            if(!empty($value['material_buyunit']))
            {
                if($id==$value['material_buyunit'])
                {
                $material_stock_quantity=$value['material_stock_quantity']/$value['material_buyconversionused'];
                echo "
                <td><p class='mt-2 mb-2 mr-3 float-right' >จำนวน".$value['material_buyunit'].":</p></td>
                <td><p class='mt-2 mb-2'>
                <div class='row'>
                    <div class='col-8'><input type='number' name='material_amount' value='".number_format($material_stock_quantity,2)."' class='form-control' placeholder='กรุณากรอกจำนวน'></div>
                    <div class='col-4 mt-2 mb-2'>$id</div>
                </div>
                </p></td>
                ";  
                }
            }
            
        }
          
    }
    
    mysqli_close($connect);
