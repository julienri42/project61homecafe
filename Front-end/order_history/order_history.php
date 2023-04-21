<?php
session_start();
include('../../assets/connect/conn.php');
$time = date("Y-m-d H:i:s", time());
$rownum = 0;



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>61 home cafe</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="../assets/favicon.ico" />
    <link href="../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../css/styles.css" rel="stylesheet">
    <link href="../css/index1.css" rel="stylesheet">
    <link href="../../assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="../assets/css/body1.css" rel="stylesheet">
    <link href="../../assets/css/employee1.css" rel="stylesheet">

</head>

<body>
    <?php include("../nav_folder.php"); ?>
    <!-- Section-->
    <section class="py-5 ">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="card shadow mb-4">
                <h5 class="card-header bg-secondary text-white">
                    <div class="float-left mt-2">
                        ประวัติการสั่งซื้อ
                    </div>
                </h5>
                <div class="card-body" id='body'>
                    <div class="table-responsive">
                        <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                            <thead class="thead-secondary">
                                <tr>
                                    <th>#</th>
                                    <th>เลขที่ใบเสร็จ</th>
                                    <td>สถานะการสั่งซื้อ</td>
                                    <th>วัน/เดือน/ปี</th>
                                    <th>จำนวนสินค้า</th>
                                    <th>ราคา</th>
                                    <th>คนอนุมัติการสั่งซื้อ</th>
                                    <th>แสดงรายละเอียด</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $user_id=$_SESSION['user_id'];
                                    $sql = "SELECT * FROM tb_order as o  
                                            WHERE order_status!='หน้าร้าน' AND user_id='$user_id'
                                            ORDER BY order_receipt_no DESC";
                                
                                $result = $connect->query($sql);
                                while ($row = $result->fetch_array()) {
                                    $rownum += 1;

                                    echo "<tr class='hover'>";
                                    echo "<td> $rownum </td>";
                                    echo "<td>" . $row['order_receipt_no'] . "</td>";
                                   
                                    if($row['order_status']=="รอการชำระเงิน"){
                                        echo "<td class='text-warning'>" . $row['order_status'] . "</td>";
                                        
                                    }
                                    else if($row['order_status']=="จัดเตรียมสินค้า")
                                    {
                                        echo "<td class='text-primary'>" . $row['order_status'] . "</td>";
                                       
                                    }
                                    else if ($row['order_status']=="รออาหารสักครู่")
                                    {
                                        echo "<td class='text-success'>" . $row['order_status'] . "</td>";
                                    }
                                    else if($row['order_status']=="กำลังไปเสริฟ")
                                    {
                                        echo "<td class='text-info'>" . $row['order_status'] . "</td>";
                                    }
                                    else if($row['order_status']=="ได้รับอาหารแล้ว")
                                    {
                                        echo "<td class='text-success'>" . $row['order_status'] . "</td>";
                                    }
                                    else{
                                        echo "<td class='text-danger'>" . $row['order_status'] . "</td>";
                                    }
                                
                                 
                                   
                                    echo "<td>" . $row['order_date_added'] . "</td>";
                                    $sql2 = "SELECT * FROM tb_orderdetail WHERE order_id='" . $row['order_id'] . "'";
                                    $result2 = $connect->query($sql2);
                                    $numitem = mysqli_num_rows($result2);
                                    echo "<td> $numitem </td>";
                                    echo "<td>" . number_format($row['order_total']-$row['order_discount'],2) . " บาท</td>";
                                    if(empty($row['employee_id']))
                                    {
                                        echo "<td>ยังไม่มีคนอนุมัติ</td>";
                                    }
                                    else{
                                        $employee_id= $row['employee_id'];
                                        echo $employee_id; 
                                        $result3=mysqli_query($connect,"SELECT employee_firstname FROM tb_employee WHERE  employee_id='$employee_id'");
                                        list($employee_firstname)=mysqli_fetch_row($result3); 
                                        echo "<td>" . $employee_firstname . "</td>";
                                    }
                                   
                                ?>
                                    <td><a href="order_history_detail.php?id=<?php echo $row['order_id'];?>"  class="text-success">รายละเอียด</a></td>
                                 

                                <?php
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </section>
    <?php
    include("../footer_folder.php");
    ?>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="../js/scripts.js"></script>
    <!-- Bootstrap core JavaScript-->
    <script src="../../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../../assets/vendor/datatables/jquery.dataTables.js"></script>
    <script src="../../assets/vendor/datatables/dataTables.bootstrap4.js"></script>

</body>

</html>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

<script type="text/javascript">
      function cartnum(){
        $.ajax({
           method: "POST",
           url:"../ajax_cart/button_cart.php",
           success:function(data){
             $("#cartnum").html(data);
           }
		});
    }
    cartnum();
    function show_cart() {
        $.ajax({
            method: "POST",
            url: "../ajax_cart/show_cart_folder.php",
            success: function(data) {
                $("#show_cart").html(data);
                cartnum();
            }
        });
    }
    $(document).on("click", "#cartModaltest", function() {
        show_cart();
    });

    $(document).on("click", ".plus", function() {
        var id = $(this).attr("id");
        $.ajax({
            method: "POST",
            url: "../ajax_cart/plus_minus_cart.php",
            data: {
                id: id,
                function: "plus"
            },
            success: function(data) {
                show_cart();
                cartnum();

            }
        });
    });

    $(document).on("click", ".minus", function() {
        var id = $(this).attr("id");
        $.ajax({
            method: "POST",
            url: "../ajax_cart/plus_minus_cart.php",
            data: {
                id: id,
                function: "minus"
            },
            success: function(data) {
                show_cart();
                cartnum();

            }
        });

    });

    $(document).on("click", "#delete_all", function() {
        $.ajax({
            method: "POST",
            url: "../ajax_cart/delete_cart.php",
            data: {
                function: "delete_all"
            },
            success: function(data) {
                show_cart();
                cartnum();
            }
        });
    });
    $(document).on("click", ".delete", function() {
        var id = $(this).attr("id");
        $.ajax({
            method: "POST",
            url: "../ajax_cart/delete_cart.php",
            data: {
                id: id,
                function: "delete"
            },
            success: function(data) {
                show_cart();
                cartnum();
            }
        });
    });
    /////
    $.extend(true, $.fn.dataTable.defaults, {
        "language": {
            "sProcessing": "กำลังดำเนินการ...",
            "sLengthMenu": "แสดง _MENU_  แถว",
            "sZeroRecords": "ไม่พบข้อมูล",
            "sInfo": "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
            "sInfoEmpty": "แสดง 0 ถึง 0 จาก 0 แถว",
            "sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
            "sInfoPostFix": "",
            "sSearch": "ค้นหา:",
            "sUrl": "",
            "oPaginate": {
                "sFirst": "เริ่มต้น",
                "sPrevious": "ก่อนหน้า",
                "sNext": "ถัดไป",
                "sLast": "สุดท้าย"
            }
        }
    });

    // เรียกใช้งาน Datatable function

    $('table').DataTable();


</script>