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
    $strMonthCut = array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
?>
    
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>สารสนเทศการรายรับ-รายจ่าย</title>
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
                    <span>สารสนเทศการรายรับ-รายจ่าย <?php
                    if(!empty($_GET['id']))
                    {
                        echo "(เดือน ".MonThai($_GET['id'])." )" ;
                    }
                     ?></span><br>
                    
                    <br>
                    <br>
                </div>
            <table class="table table-striped table-bordered">
                  
                    <thead>
                        <tr class="text-dark border border-dark">
                            <th>#</th>
                            <th>เดือน/ปี</th>
                            <th>รายรับ</th>
                            <th>รายจ่าย</th>
                            <th>กำไร</th>
                            
                            
                        </tr>
                    </thead>
                    <tbody>
                <?php
                    if(empty($_GET['id']))
                    {
                        $sql = "SELECT MONTH(order_date_added) as mon ,year(order_date_added) as year ,sum(order_total-order_discount) as sumprice  FROM tb_order 
                        GROUP BY MONTH(order_date_added) ,YEAR(order_date_added) ORDER BY  YEAR(order_date_added),MONTH(order_date_added) DESC ";
                    }
                    else{
                        $month = $_GET['id'];
                        $sql = "SELECT MONTH(order_date_added) as mon ,year(order_date_added) as year ,sum(order_total-order_discount) as sumprice  FROM tb_order
                        WHERE order_date_added LIKE '$month%' 
                        GROUP BY MONTH(order_date_added) ,YEAR(order_date_added) ORDER BY  YEAR(order_date_added),MONTH(order_date_added) DESC ";
                        
                    }
                                             $result = $connect->query($sql);
                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = $result->fetch_array()) {
                                                    echo "<tr>";
                                                    $num++;
                                                    echo "<td>$num</td>";
                                                    $strMonthThai = $strMonthCut[$row['mon']];
                                                    $mon=$row['mon'];
                                                    $year=$row['year'];
                                                    echo "<td> $strMonthThai $year </td>";
                                                    $sumprice = $row['sumprice'];
                                                    echo "<td> $sumprice บาท</td>";
                                                    $sqlmaterial="SELECT sum(material_stock_price) as materialprice  FROM tb_material_stock_list 
                                                    WHERE  material_stock_date_added>='$year-$mon-1' AND material_stock_date_added<='$year-$mon-31 23:59:00'";
                                                    $resultmaterial = mysqli_query($connect, $sqlmaterial);
                                                    if (mysqli_num_rows($resultmaterial) > 0) {

                                                        while ($row2 = $resultmaterial->fetch_array()) {

                                                            $materialprice=$row2['materialprice'];

                                                        }
                                                    }
                                                    else
                                                    {
                                                        $materialprice=0;
                                                    }

                                                    $sqlproduct="SELECT sum(product_stock_price) as productprice  FROM tb_product_stock_list 
                                                    WHERE  product_stock_date_added>='$year-$mon-1' AND product_stock_date_added<='$year-$mon-31 23:59:00'";
                                                    $resultproduct = mysqli_query($connect, $sqlproduct);
                                                    if (mysqli_num_rows($resultproduct) > 0) {

                                                        while ($row2 = $resultproduct->fetch_array()) {

                                                            $productprice=$row2['productprice'];

                                                        }
                                                    }
                                                    else
                                                    {
                                                        $productprice=0;
                                                    }
                                                    $expenses=$materialprice+$productprice;
                                                    echo "<td>$expenses บาท</td>";
                                                    $sum=$sumprice-$expenses;
                                                    echo "<td>$sum บาท</td>";
                                                    echo "</tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='4' class='text-center'>ไม่มีข้อมูลในวันที่เลือก</td></tr>";
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