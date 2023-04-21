
<?php
session_start();
include('../../assets/connect/conn.php');
$_SESSION['page'] = "checkoutpage.php";
function DateThai($strDate)
{
    $strYear = date("Y", strtotime($strDate)) + 543;
    $strMonth = date("n", strtotime($strDate));
    $strDay = date("j", strtotime($strDate));
    $strSeconds = date("s", strtotime($strDate));
    $strMonthCut = array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
    $strMonthThai = $strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear";
}
$time = date("Y-m-d H:i:s", time());
$remaining = 0;
$total = 0;
///เพิ่ม
if (isset($_GET['pid'])) {
    if (!empty($_SESSION['pid'])) {
        $chk = array_search($_GET['pid'], $_SESSION['pid']);
        if ($chk !== false) {
            $_SESSION['amount'][$chk] += $_GET['amount'];
        } else {
            $_SESSION['pid'][] = $_GET['pid'];
            $_SESSION['amount'][] = $_GET['amount'];
        }
    } else {
        $_SESSION['pid'][] = $_GET['pid'];
        $_SESSION['amount'][] = $_GET['amount'];
    }
}

///ลบ
if (isset($_GET['delete'])) {
    $_SESSION["pid"] = array_values(array_diff($_SESSION['pid'], array($_GET['delete'])));
}
if (isset($_GET['deleteamount'])) {
    unset($_SESSION["amount"][$_GET['deleteamount']]);
    $_SESSION["amount"] = array_values($_SESSION["amount"]);
}
//ค้นหาสมาชิก
if (isset($_GET['member_email']) || isset($_GET['member_tell'])) {
    $sqluser = "SELECT * FROM tb_user AS u
        INNER JOIN tb_usertype AS s ON u.usertype_id=s.usertype_id
        WHERE user_email ='" . $_GET['member_email'] . "' OR user_tel='" . $_GET['member_tell'] . "'";
    $resultuser = $connect->query($sqluser);
    if (mysqli_num_rows($resultuser) > 0) {
        while ($rowuser = $resultuser->fetch_array()) {
            $_SESSION['member_id'] = $rowuser['user_id'];
            $_SESSION['member_firstname'] = $rowuser['user_firstname'];
            $_SESSION['usertype_discount'] = $rowuser['usertype_discount'];
        }
    } else {
        $_SESSION['alert_member'] = 1;
    }
}
//ยกเลิกสมาชิก
if (isset($_GET['deletemember'])) {
    unset($_SESSION['member_id']);
    unset($_SESSION['member_firstname']);
    unset($_SESSION['usertype_discount']);
}
//ลบทั้งหมด
if (isset($_GET['deleteall'])) {
    unset($_SESSION['pid']);
    unset($_SESSION['amount']);
    unset($_SESSION['member_id']);
    unset($_SESSION['member_firstname']);
    unset($_SESSION['usertype_discount']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../../assets/img/logoicon.ico">
    <title>
        สั่งออเดอร์(พนักงาน)
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="../assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
    <link href="../../assets/css/admin_home.css" rel="stylesheet">
    <link href="../../assets/css/body1.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <link href="../../assets/css/employee1.css" rel="stylesheet">



</head>

<body class="g-sidenav-show">
    <?php
    include("../aside_folder.php");
    ?>
    <main class="main-content position-relative border-radius-lg ">
        <?php
        include("../nav_folder.php");
        ?>
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <div class='row'>
                                <h2 class='col-6'>สั่งออเดอร์(พนักงาน)</h2>
                                <?php echo "<hr class='bg-dark'>"; ?>
                            </div>



                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                        <?php
                        echo "<center>";
                    if (isset($_SESSION['alert_member'])) {
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <h5 class="alert-heading">ค้นหาสมาชิกไม่เจอ</h5>
                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>';
                        unset($_SESSION['alert_member']);
                    }
                    if (isset($_SESSION['edit_status'])) {
                        if ($_SESSION['edit_status'] == "4") {
                            $order_id = $_SESSION['order_id'];
                            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <h5 class="alert-heading text-white">ทำรายการสั่งซื้อเสร็จ</h5>
                                              
                                              <hr>
                                            ';
                                            ?>
                                              <a onClick="window.open('report_checkoutpage.php?id=<?php echo $order_id; ?>','','width=650,height=600,top=100,left=500'); return false;" class="btn btn-success" >พิมพ์ใบเสร็จ</a>
                                            <?php
                                            echo '</div>';
                        }
                        if ($_SESSION['edit_status'] == "1") {
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <h5 class="alert-heading">กรุณาเลือกสินค้า</h5>
                                              
                                            </div>';
                        }
                        unset($_SESSION['order_id']);
                        unset($_SESSION['edit_status']);
                    }
                    echo "</center>";
                    ?>
                    <div class="row p-2">
                        <!--col-->
                        <div class="col-6 overflow-auto" style="height: 500px;">
                            <h3>เลือกสินค้า:</h3>
                            <form action="checkoutpage.php" method="GET">
                                <table width="100%" class="mb-2">
                                    <tr>
                                        <td width='8%'>ค้นหา: </td>
                                        <td><input type="text" name="search" class="form-control" placeholder='ค้นหาชื่อสินค้า'></td>
                                        <td width='5%'><input type="submit" value="ค้นหา" class="btn btn-info mt-3"></td>
                                    </tr>
                                </table>
                            </form>
                            <div class="row">
                                <?php
                                if (isset($_GET['search'])) {
                                    $search = $_GET['search'];
                                    $sqlproduct = "SELECT * FROM tb_product_list WHERE product_name LIKE'%$search%' AND product_status='เปิดขาย' AND product_delete='0' ";
                                } else {
                                    $sqlproduct = "SELECT * FROM tb_product_list WHERE product_status='เปิดขาย' AND product_delete='0'";
                                }

                                $resultproduct = $connect->query($sqlproduct);
                                while ($rowproduct = $resultproduct->fetch_array()) {
                                    echo "<div class='col-6'>";
                                    echo "<form action='checkoutpage.php' method='GET'>";
                                    echo "<table class='table table-hover mt2 mb-2 ml-1 mr-1 bg-white'>";
                                    echo "<tr>";
                                    if (empty($rowproduct['product_img'])) {
                                        echo "<td><img src='../../assets/img/product/noproduct.png' height='125' width='125'></td>";
                                    } else {
                                        echo "<td><img src='../../assets/img/product/" . $rowproduct['product_img'] . "' height='125' width='125'></td>";
                                    }
                                    echo "<td>";
                                    echo "<div class='ml-2'>";
                                    echo "<input type='hidden' name='pid' value='" . $rowproduct['product_id'] . "'>";
                                    echo  "" . $rowproduct['product_name'] . "<br>";
                                    $sql1 = "SELECT * FROM tb_product_stock_list 

                                                    WHERE product_id='" . $rowproduct['product_id'] . "' AND product_stock_expiry_date>='$time'";
                                    $result1 = $connect->query($sql1);
                                    while ($row1 = $result1->fetch_array()) {
                                        $remaining += $row1['product_stock_remaining'];
                                    }
                                    if ($remaining > 0) {
                                        echo  "คงเหลือ: $remaining " . $rowproduct['product_unit'] . "<br>";
                                    } else {
                                        echo  "คงเหลือ: สินค้าหมด<br>";
                                    }

                                    echo  "ราคา :" . $rowproduct['product_price'] . " บาท<br>";
                                    if ($remaining > 0) { 
                                        
                                        echo "<table>";
                                        echo "<td class='w-5'><input onclick='javascript:this.form.amount.value++;' type='button' value='     +     '  max='$remaining'></td>";
                                        echo "<td class='w-5'><input onclick='javascript:this.form.amount.value--;' type='button' value='      -      '  max='$remaining'></td>";
                                        echo  "<td class='w-50'><input type='number' max='$remaining' name='amount' class='form-control'></td>";
                                        echo "<td class='float-left mt-2'>ชิ้น</td>";
                                        echo "</tr>";
                                        echo "</table>";
                                        echo  "<input type='submit' class='btn btn-primary mt-2' value='เลือกสินค้า'>";
                                    }

                                    echo "</div>";
                                    echo "</td>";
                                    echo "</tr>";
                                    echo "</table>";
                                    echo "</form>";
                                    echo "</div>";
                                    $remaining = 0;
                                }
                                ?>
                            </div>
                        </div>
                
                        <!--col-->
                        <div class="col-6">
                            <h3>สินค้าที่เลือก:</h3>
                            <form action="add_checkoutpage_ck.php" method="POST">
                                <div class="table-responsive">
                                    <table class="table table-bordered datatable" id="notable" width="100%" cellspacing="0">
                                        <thead class="thead-secondary">
                                            <tr>
                                                <th>ชื่อสินค้า</th>
                                                <th>จำนวน</th>
                                                <th>ราคารวม</th>
                                                <th>ลบ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (!empty($_SESSION['pid'])) {
                                                for ($i = 0; $i < count($_SESSION['pid']); $i++) {
                                                    $sql = "SELECT * FROM tb_product_list
                                                        WHERE product_id='" . $_SESSION['pid'][$i] . "'";
                                                    $result = $connect->query($sql);
                                                    while ($row = $result->fetch_array()) {
                                                        $amountnum = $_SESSION['amount'][$i];
                                                        $totalprice = $row['product_price'] * $_SESSION['amount'][$i];
                                                        echo "<tr>";
                                                        echo "<td width='30%'>" . $row['product_name'] . "</td>";
                                                        echo "<td>$amountnum " . $row['product_unit'] . " </td>";
                                                        echo "<input type='hidden' name='amount[]' value='" . $_SESSION['amount'][$i] . "' class='form-control'>";
                                                        echo "<input type='hidden' name='pid[]' value='" . $row['product_id'] . "'>";
                                                        echo "<input type='hidden' name='totalprice[]' value='" . $totalprice . "'>";
                                                        echo "<td width='30%'>" . $totalprice . " บาท</td>";
                                                        echo "<td width='20%'><a href='checkoutpage.php?delete=" . $row['product_id'] . "&deleteamount=" . $i . "' class='btn btn-danger'>ลบสินค้า</a> </td>";
                                                        echo "</tr>";
                                                        $total += $totalprice;
                                                    }
                                                }
                                            } else {
                                                echo "<tr><td colspan='6'><center>ไม่มีข้อมูล</center></td></tr>";
                                            }

                                            ?>

                                        </tbody>
                                    </table>
                                    <!-- -->
                                    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">การชำระเงิน</h5>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <fieldset disabled>
                                                        <div class="mb-3">
                                                            <label for="payable_amount" class="form-label">จำนวนเงินที่ต้องชำระ</label>
                                                            <input type="number" class="form-control" id="payable_amount" value='<?php echo $total; ?>'>
                                                        </div>
                                                    </fieldset>
                                                    <div class="mb-3">
                                                        <label for="payable_tendered" class="form-label">จำนวนเงินที่รับมา</label>
                                                        <input type="number" class="form-control" id="payable_tendered">
                                                    </div>
                                                    <fieldset disabled>
                                                        <div class="mb-3">
                                                            <label for="change" class="form-label">เงินทอน</label>
                                                            <input type="number" class="form-control" id="change" value='0'>
                                                        </div>
                                                    </fieldset>


                                                </div>
                                                <div class="modal-footer">
                                                    <input class="btn btn-primary text-light" type="submit" value="ชำระเงิน">
                                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">ปิด</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- -->
                                    <?php
                                    if (isset($_SESSION['member_id'])) {
                                        $discount = $_SESSION['usertype_discount'];
                                        $discountnumber = $total * ($discount / 100);
                                        $total = $total - $discountnumber;
                                        echo " <div class='float-right'><h3>ส่วนลด $discount %: $discountnumber บาท</h3></div> <br><br>";
                                        echo "<input type='hidden' name='discount' value='$discount'>";
                                        echo "<input type='hidden' name='discountnumber' value='$discountnumber'>";
                                    }

                                    echo "<input type='hidden' name='total' value='$total'>";
                                    ?>
                            </form>
                            <!-- -->
                            <div class='float-right'>
                                <h3>ราคารวม : <?php echo $total; ?> บาท</h3>
                            </div>
                            <br>
                            <?php
                            if (empty($_SESSION['member_id'])) {
                                echo "
                                                    <form action='checkoutpage.php' method='GET'>
                                                    <table >
                                                        <tr>
                                                            <td colspan='3'><h3>ค้นหาสมาชิก</h3></td>
                                                        </tr>
                                                        <tr>
                                                            <td ><div class='float-right'>ค้นหาด้วยอีเมล์ :</div></td>
                                                            <td ><input type='text' name='member_email' class='form-control'></td>
                                                            <td ><input type='submit' value='ค้นหา' class='btn btn-primary mt-3'></td>
                                                        </tr>
                                                        <tr>
                                                            <td width='30%'><div class='float-right'>เบอร์โทรศัพท์ :</div></td>
                                                            <td><input type='text' name='member_tell' class='form-control'></td>
                                                            <td><input type='submit' value='ค้นหา' class='btn btn-primary mt-3'></td>
                                                        </tr>
                                                    </table> 
                                                    </form>
                                                    ";
                            } else {
                                echo "<h3>สมาชิกชื่อ :" . $_SESSION['member_firstname'] . "</h3> <a href='checkoutpage.php?deletemember=1' class='btn btn-danger'>ยกเลิกการค้นหาสมาชิก</a>";
                            }
                            ?>


                            <br>
                            <div class='mt-2'>
                                <a href="#" data-toggle="modal" data-target="#add" class="btn btn-primary">ทำรายการ</a>
                                <a href='checkoutpage.php?deleteall=1' class='btn btn-danger'>ยกเลิกรายการ</a>
                            </div>


                        </div>

                    </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </main>

    <!--   Core JS Files   -->
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/chartjs.min.js"></script>

    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/argon-dashboard.min.js?v=2.0.4"></script>



    <!-- Bootstrap core JavaScript-->
    <script src="../../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../assets/js/sb-admin-2.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script>
        // เพิ่มส่วนนี้เข้าไปจะถือว่าเป็นการตั้งค่าให้ Datatable เป็น Default ใหม่เลย
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
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
    <script>
$( "#payable_tendered" )
  .keyup(function() {

    var value = $( this ).val()-$("#payable_amount").val();
    
    $( "#change" ).val(value);
  })
  .keyup();

</script>

</body>

</html>