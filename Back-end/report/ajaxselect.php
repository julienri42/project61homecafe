<?php 
     include('../../assets/connect/conn.php');

     if (isset($_POST['function']) && $_POST['function'] == 'chart-line') {
        $sql = "SELECT MONTH(order_date_added) as mon ,sum(order_total-order_discount) as sumprice  FROM tb_order GROUP BY MONTH(order_date_added) ,YEAR(order_date_added) ORDER BY MONTH(order_date_added),YEAR(order_date_added) ASC ";
        $query = mysqli_query($connect, $sql);
        if (mysqli_num_rows($query)>0) {
            foreach ($query as $value) {
                $strMonthCut = array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
                $strMonthThai = $strMonthCut[$value['mon']];
                $item_array = array(
                    "mon" => $strMonthThai,
                    "sumprice" => $value['sumprice']
                 );
                $array[]=$item_array;
                
            }
            
            echo json_encode($array);    
        }

        

        mysqli_free_result($query);
    }

   
    
    mysqli_close($connect);
