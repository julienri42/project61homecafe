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
?>
    
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ใบเสร็จสั่งซื้อ(หน้าร้าน)</title>
    <!-- Custom fonts for this template-->
 
    <!-- Custom styles for this template-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <div class="container-fluid">
            <div id="outprint_receipt">
                <?php 
                    $order_id = $_GET['id'];
                    $sql="SELECT * FROM tb_order AS o 
                    INNER JOIN tb_employee AS e ON o.employee_id =e.employee_id 
                    WHERE order_id ='$order_id'";
                    $result = $connect->query($sql);
                    while($row = $result->fetch_array()){
                ?>
                <div class="text-center fw-bold lh-1 border-top border-bottom border-dark">
                    <br>
                    <span>ใบเสร็จการสั่งซื้อสินค้า</span><br>
                    <small>61 home cafe</small><br>
                    <small>ที่ตั้ง 61 บ้านหนองเต่าคำใหม่ หมู่ที่9 อำเภอสันทราย เชียงใหม่ 50210</small><br>
                    <small>โทร. 098 414 4998</small>
                    <br>
                    <br>
                </div>

                <br>
                 <div class="text-end">
                    <span class="col-auto pe-2">วันที่:</span>
                    <span class="border-bottom border-dark flex-grow-1"><?php echo DateThai($row['order_date_added']); ?></span>
                 </div>   
                 <div class="text-end">
                    <span class="col-auto pe-2">เลขที่ใบเสร็จ:</span> 
                    <span class="border-bottom border-dark flex-grow-1"><?php echo $row['order_receipt_no']; ?></span>
                 </div> 
                 <br>
                <?php 
                    if($row['user_id']!=0)
                    {
                        $sql3= "SELECT * FROM tb_user WHERE user_id='".$row['user_id']."'";
                        $result3=$connect->query($sql3);
                        while($row3 = $result3->fetch_array()){
                        echo ' <div class="fs-6 fs-light d-flex w-100 mb-3">
                                <span class="col-auto pe-2">ชื่อสมาชิกผู้ซื้อ : </span> 
                                <span class="border-bottom border-dark flex-grow-1">'.$row3['user_firstname'].' '.$row3['user_surname'].'</span>
                            </div>';
                        }
                    }
                    $order_totaltrue=$row['order_total']-$row['order_discount'];
                ?>

                <table class="table table-striped">
                    <colgroup>
                        <col width="40%">
                        <col width="15%">
                        <col width="15%">
                        <col width="20%">
                        <col width="10%">
                    </colgroup>  
                    <thead>
                        <tr class="text-dark border border-dark">
                            <th class="py-0 px-1">ชื่อสินค้า</th>
                            <th class="py-0 px-1">จำนวน</th>
                            <th class="py-0 px-1">หน่วยสินค้า</th>
                            <th class="py-0 px-1 text-end">ราคารวม</th>
                            <th class="py-0 px-1">หน่วย</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $sql2="SELECT * FROM tb_orderdetail AS d
                             INNER JOIN tb_product_list AS b ON d.product_id  =b.product_id  
                            WHERE order_id='$order_id'";
                            $result2 = $connect->query($sql2);
                            while($row2 = $result2->fetch_array()){
                           
                        ?>
                        <tr>
                            <td class="px-1 py-0"> <?php echo $row2['product_name'];  ?></td>
                            <td class="px-1 py-0 align-middle ">
                                <?php echo $row2['orderdetail_quantity'];  ?>
                            </td>
                            <td class="px-1 py-0 align-middle ">
                                <?php echo $row2['product_unit']; ?>
                            </td>
                            <td class="px-1 py-0 align-middle  text-end">  <?php echo $row2['orderdetail_price'];  ?> </td>
                            <td class="px-1 py-0 align-middle ">
                                บาท
                            </td>
                        </tr>
                        <?php   } ?>
                    </tbody>
                    <tfoot>
                    <tr>
                            <th class="px-1 py-0" colspan="3">ราคา:</th>
                            <th class="px-1 py-0 text-end"><?php  echo $row['order_total'];  ?></th>
                           
                            <th class="px-1 py-0 ">บาท</th>
                        </tr>
                        <tr>
                            <th class="px-1 py-0" colspan="3">ลดราคา:</th>
                            <th class="px-1 py-0 text-end"><?php  echo $row['order_discount'];  ?></th>
                            <th class="px-1 py-0 ">บาท</th>
                        </tr>
                        <tr>
                            <th class="px-1 py-0" colspan="3">รวมราคา :</th>
                            <th class="px-1 py-0 text-end"><?php  echo number_format($order_totaltrue,2);  ?></th>
                            <th class="px-1 py-0 ">บาท</th>
                        </tr>
                    </tfoot>
                </table>
                <div class='text-center fw-bold lh-1 border-top border-bottom border-dark'>
                    <br>
                    <center>
                        <div class="border-top border-bottom border-dark col-3 ">
                            <br>
                            <br>
                            <br>
                        </div>
                    <center>
                   <br>
                    (<?php echo $row['employee_firstname']." ".$row['employee_surname']  ?>)
                    <br>
                        ผู้รับเงิน
                    <br><br>
                    วันที่รับเงิน : <?php echo DateThai($row['order_date_added']); ?>
                    <br><br>
                </div>
                <br><br>  
                <center> <button id="hide" class="btn btn-success">ปริ้นท์ใบเสร็จ</button> </center>
            </div>
        </div>               
    </div>
    <?php 
        }
    ?>
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