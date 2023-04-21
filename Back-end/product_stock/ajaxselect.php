<?php 
     include('../../assets/connect/conn.php');
    $num=0;
     if (isset($_POST['function']) && $_POST['function'] == 'typeproduct') {
        $id = $_POST['id'];
        $sql = "SELECT * FROM tb_product_list WHERE typeproduct_id ='$id'";
        $query = mysqli_query($connect, $sql);
        echo "<option value='0'>กรุณาเลือกข้อมูลสินค้า</option>";
        foreach ($query as $value) {
            echo '<option value="'.$value['product_id'].'">'.$value['product_name'].'</option>';
        }
        mysqli_free_result($query);
    }
    if (isset($_POST['function']) && $_POST['function'] == 'product') {
        $id = $_POST['id'];
        $sql = "SELECT * FROM tb_listmaterial_to_product AS m
        INNER JOIN tb_material_list AS t ON m.material_id=t.material_id 
        INNER JOIN tb_product_list AS b ON m.product_id=b.product_id
        WHERE m.product_id ='$id'";
        $query = mysqli_query($connect, $sql);
        if (mysqli_num_rows($query)>0) {
            $time=date("Y-m-d",time());
            $numtotal=0;
            $ranger=mysqli_num_rows($query);
            echo "<input type='hidden' id='ranger' value='$ranger'>";
            echo "<table class='table table-bordered'>";
            echo "<thead class='thead-pink'>";
            echo "<tr>";
            echo "<th>ชื่อวัตถุดิบที่ใช้</th>";
            echo "<th>จำนวนทั้งหมดของวัตถุดิบ</th>";
            echo "<th>จำนวนที่ใช้</th>";    
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            foreach ($query as $value) {
                $num++;
                $listmaterial_quantity=$value['listmaterial_quantity'];
                $material_id=$value['material_id'];
                echo "<tr>";
                echo "<td>".$value['material_name']."</td>";
                
                $material_stock_remaining=0;
                $sql3 ="SELECT * FROM tb_material_stock_list WHERE material_id='$material_id' AND material_stock_expiry_date>='$time'";
                $result3 = mysqli_query($connect, $sql3);
                while($row3 = mysqli_fetch_assoc($result3))
                {   
                    $material_stock_remaining= $material_stock_remaining +$row3['material_stock_remaining'];
                }
                echo "<td>".number_format($material_stock_remaining,2)." ".$value['material_usedunit']."</td>";
               
                $nummaterial=$material_stock_remaining/$listmaterial_quantity;
                if($nummaterial<$numtotal||$numtotal==0)
                {
                    $numtotal=$nummaterial;
                }
                $material_stock_remaining=0;
                echo "<td id='mat$num'>".number_format($listmaterial_quantity,2)." ".$value['material_usedunit']."ต่อ".$value['product_unit']."</td>";
                echo "<input type='hidden' id='m$num' value='$listmaterial_quantity'>";
                $material_usedunit=$value['material_usedunit'];
                $product_unit=$value['product_unit'];
                echo "<input type='hidden' id='use$num' value='$material_usedunit'>";
                echo "</tr>";
            }
            echo "<tr><td colspan='3'> <center>สามารถทำได้ ".floor($numtotal)." ".$value['product_unit']."</center></td></tr>";
            echo "<input type='hidden'  value='$numtotal' id='numtotal' name='numtotal'>";
            
            echo "</tbody>";
            echo "</table>";
            echo "<table width='100%'>";
            echo "<tr>
                    <td width='35%'><p class='mt-2 mb-2 mr-3 float-right' >จำนวน: </p></td>
                    <td><p class='mt-2 mb-2'><input type='number' value='1' name='product_stock_quantity' id='quantity' class='form-control' min='1' max='".floor($numtotal)."' placeholder='กรุณาจำนวนต่อชิ้น'></p></td>
                </tr>";
            echo "</table>";
            mysqli_free_result($result3);
        }
        else
        {
            echo "<table width='100%'>";
            echo "<tr>
                    <td width='35%'><p class='mt-2 mb-2 mr-3 float-right' >จำนวน: </p></td>
                    <td><p class='mt-2 mb-2'><input type='number' value='1' name='product_stock_quantity' class='form-control' min='1' max='9999' placeholder='กรุณาจำนวนต่อชิ้น'></p></td>
                </tr>";
            echo "</table>";
        }
       
        mysqli_free_result($query);
    }
    mysqli_close($connect);
?>
<script>
  $( "#quantity" )
  .keyup(function() {
    
    var value =  $( this ).val();
    var ranger = $("#ranger").val();

    for(i=1;i<=ranger;i++)
    {
        var qu = $("#m"+i).val();
        var use = $("#use"+i).val();
        var sum = value*qu;
        $( "#mat"+i).html(sum.toFixed(2)+" "+use);
    }
   
  })
  .keyup();
</script>