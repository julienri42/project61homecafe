<?php 
    session_start();
    include('../../assets/connect/conn.php');
    function DateThai($strDate)
    {
      $strYear = date("Y", strtotime($strDate)) + 543;
      $strMonth = date("n", strtotime($strDate));
      $strDay = date("j", strtotime($strDate));
      $strSeconds = date("s", strtotime($strDate));
    
      $strtime = date("H:i", strtotime($strDate));
    
      $strMonthCut = array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
      $strMonthThai = $strMonthCut[$strMonth];
      return "$strDay $strMonthThai $strYear $strtime";
    } 
    function MonThai($strDate)
    {
        
        $strYear = date("Y", strtotime($strDate)) + 543;
        $strMonth = date("n", strtotime($strDate));
        $strMonthCut = array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
        $strMonthThai = $strMonthCut[$strMonth];
        return "$strMonthThai $strYear";
    }
    $num=0;
    $time = date("Y-m-d", time());
?>
    
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ใบเสร็จสั่งซื้อ(พนักงาน)</title>
    <!-- Custom fonts for this template-->
 
    <!-- Custom styles for this template-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <div class="container-fluid">
            <div id="outprint_receipt">
            <div class="text-center fw-bold lh-1 border-top border-bottom border-dark">
                    <br>
                    <span>61 home cafe</span><br><br>
                    <span>สารสนเทศสินค้าคงเหลือ <?php
                   
                     ?></span><br>
                    
                    <br>
                    <br>
                </div>
            <table class="table table-striped table-bordered">
                    <colgroup>
                        
                       
                    </colgroup>  
                    <thead>
                        <tr class="text-dark border border-dark">
                        <th>อันดับสินค้าคงเหลือ</th>    
                        <th>ชื่อสินค้า</th>
                        <th>จำนวนที่คงเหลือ</th>
                        <th>หมายเหตุ</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                <?php
                    
                    $sql = "SELECT product_name,product_img,product_unit,sum(product_stock_remaining)as product_re FROM tb_product_stock_list as d
                    INNER JOIN tb_product_list as b  ON b.product_id=d.product_id
                    WHERE product_stock_expiry_date >='$time'
                    GROUP BY d.product_id  ORDER BY product_re DESC ";
                        
                    
                   
                    $result = $connect->query($sql);
                    while($row = $result->fetch_array()){
                        echo "<tr>";
                        $num++;
                        echo "<td>" . $num . "</td>";
                        echo "<td>" . $row['product_name'] . "</td>";
                       
                        $product_unit = $row['product_unit'];
                        echo "<td>" . $row['product_re'] . " " . $product_unit . "</td>";
                        if ($row['product_re'] >= 50) {
                            echo "<td class='text-center text-primary'>สินค้าคงเหลือมาก</td>";
                        } else if ($row['product_re'] >= 11 && $row['product_re'] <= 49) {
                            echo "<td class='text-center text-info'>สินค้าคงเหลือปกติ</td>";
                        } else if ($row['product_re'] >= 1 && $row['product_re'] <= 9) {
                            echo "<td class='text-center text-danger'>สินค้าใกล้จะหมดแล้วควรสั่งซื้อ</td>";
                        } else {
                            echo "<td class='text-center text-danger'>สินค้าหมดแล้วควรสั่งซื้อ</td>";
                        }

                        echo "</tr>";
                    }
                    ?>
                    </tbody>
                  
                </table>
                
                <center> <button id="hide" class="btn btn-success">ปริ้นท์ใบเสร็จ</button> </center>
            </div>
        </div>               
    </div>
 
    <!-- End of Page Wrapper -->
</body>

</html>
<!-- Bootstrap core JavaScript-->
<script src="../../assets/vendor/jquery/jquery.js"></script>
    <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../assets/vendor/jquery-easing/jquery.easing.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../assets/js/sb-admin-2.js"></script>
<script>
    $("#hide").click(function(){
        $("button").hide();
        window.print();
        $("button").show();
    });
</script>
<?php 
   
    mysqli_close($connect);
?>