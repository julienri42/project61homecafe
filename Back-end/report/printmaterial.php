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
                    <span>สารสนเทศวัตถุดิบคงเหลือ  <?php
                   
                     ?></span><br>
                    
                    <br>
                    <br>
                </div>
            <table class="table table-striped table-bordered">
                    <colgroup>
                        
                       
                    </colgroup>  
                    <thead>
                        <tr class="text-dark border border-dark">
                            <th>อันดับวัตถุดิบคงเหลือ</th>
                            <th>ชื่อวัตถุดิบ</th>
                            <th>จำนวนที่คงเหลือหน่วยรับ</th>
                            <th>จำนวนที่คงเหลือหน่วยใช้</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                <?php
                    
                    $sql = "SELECT material_name,material_usedunit,material_buyconversionused,material_buyunit,sum(material_stock_remaining)as material_re FROM tb_material_stock_list as d
                                 INNER JOIN tb_material_list as b  ON b.material_id=d.material_id
                                 WHERE material_stock_expiry_date >='$time'
                                 GROUP BY d.material_id  ORDER BY material_re DESC ";
                        
                    
                   
                    $result = $connect->query($sql);
                    while($row = $result->fetch_array()){
                        echo "<tr>";
                        $num++;
                        echo "<td>" . $num . "</td>";
                        echo "<td>" . $row['material_name'] . "</td>";

                        $material_unit = $row['material_usedunit'];
                        if (empty($row['material_buyunit'])) {
                            echo "<td>ไม่มีหน่วยรับเข้า</td>";
                        } else {
                            $material_buyconversionused = $row['material_buyconversionused'];
                            $material_buyunit = $row['material_buyunit'];
                            $material_stock_remaining = $row['material_re'];
                            $remaining = $material_stock_remaining / $material_buyconversionused;
                            echo "<td>" . number_format($remaining, 2) . " " . $material_buyunit . "</td>";
                        }

                        echo "<td>" . $row['material_re'] . " " . $material_unit . "</td>";


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