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
                    <span>สารสนเทศสินค้าขายดี  <?php
                    if(!empty($_GET['id']))
                    {
                        echo "(เดือน ".MonThai($_GET['id'])." )" ;
                    }
                     ?></span><br>
                    
                    <br>
                    <br>
                </div>
            <table class="table table-striped table-bordered">
                    <colgroup>
                        <col width="20%">
                        <col width="60%">
                        <col width="20%">
                       
                    </colgroup>  
                    <thead>
                        <tr class="text-dark border border-dark">
                            <th class="py-0 px-1">อันดับสินค้า</th>
                            <th class="py-0 px-1">ชื่อสินค้า</th>
                            <th class="py-0 px-1 ">จำนวนที่ขาย</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                <?php
                    if(empty($_GET['id']))
                    {
                        $sql = "SELECT  d.product_id,product_name,sum(orderdetail_quantity) as ranker ,product_unit FROM tb_orderdetail  as d
                         INNER JOIN tb_order as o  ON d.order_id=o.order_id
                        INNER JOIN tb_product_list as b  ON d.product_id=b.product_id
                        GROUP BY product_id ORDER BY ranker DESC";
                    }
                    else{
                        $month = $_GET['id'];
                        $sql="SELECT d.product_id,product_name,sum(orderdetail_quantity) as ranker ,product_unit FROM tb_orderdetail as d
                        INNER JOIN tb_order as o  ON d.order_id=o.order_id
                        INNER JOIN tb_product_list as b  ON d.product_id=b.product_id
                        WHERE o.order_date_added LIKE '$month%' 
                        GROUP BY d.product_id 
                        ORDER BY ranker DESC";
                        
                    }
                   
                    $result = $connect->query($sql);
                    while($row = $result->fetch_array()){
                ?>
                
                    
                        <tr>
                            <?php 
                                $num++;
                            ?>
                            <td class="px-1 py-0"> <?php echo $num;  ?></td>
                            <td class="px-1 py-0 align-middle ">
                                <?php echo $row['product_name'];  ?>
                            </td>
                            <td class="px-1 py-0 align-middle ">
                                    <?php  echo $row['ranker'] . " " . $row['product_unit'];?>
                            </td>
                              
                        </tr>
                        <?php   } ?>
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