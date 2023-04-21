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
                    <span>สารสนเทศการสั่งซื้อสินค้า  <?php
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
                        <th>อันดับคนสั่งซื้อ</th>
                        <th>ชื่อ</th>
                        <th>จำนวนที่การสั่งซื้อ</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                <?php
                    if(empty($_GET['id']))
                    {
                        
                        $sql = "SELECT user_img,user_firstname,user_surname,count(order_id) as sumorder FROM tb_order as o
                        INNER JOIN tb_user as u ON o.user_id=u.user_id
                        GROUP BY o.user_id ORDER BY sumorder DESC
                        ";
                    }
                    else{
                        $month = $_GET['id'];
                        $sql = "SELECT user_img,user_firstname,user_surname,count(order_id) as sumorder FROM tb_order as o
                        INNER JOIN tb_user as u ON o.user_id=u.user_id
                        WHERE order_date_added LIKE '$month%'
                        GROUP BY o.user_id ORDER BY sumorder DESC
                        ";
                        
                    }
                   
                    $result = $connect->query($sql);
                    if (mysqli_num_rows($result) > 0) {
                    while($row = $result->fetch_array()){
                        echo "<tr>";
                        $num++;
                        echo "<td>" . $num . "</td>";
                        echo "<td>" . $row['user_firstname'] . " " . $row['user_surname'] . "</td>";
                      
                        echo "<td>" . $row['sumorder'] . " ครั้ง</td>";
                        echo "</tr>";
                         } 
                            }
                            else{
                                echo "<tr><td colspan='3' class='text-center'>ไม่มีข้อมูลในวันที่เลือก</td></tr>";
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