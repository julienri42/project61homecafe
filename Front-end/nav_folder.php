<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light bg-light navbar-fixed-top">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="../index.php">61Homecafe</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="../index.php">หน้าหลัก</a></li>
                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">เกี่ยวกับ</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                           
                            <?php 
                            if(!empty($_SESSION['user_id']))
                            {
                                echo ' <li><a class="dropdown-item" href="../transaction_cart/payment_confirmation.php">แจ้งชำระเงิน</a></li>';
                            }  
                            ?>
                           
                        </ul>
                    </li> -->
                    
                </ul>
                <div class="d-flex">
                <div id='cartnum'>
                
                </div>

                    <br>

                    <div class="topbar-divider"></div>
                    <?php
                    if (empty($_SESSION['user_id'])) {
                        echo "<a class='btn btn-outline-dark' href='../Back-end/index.php'>เข้าสู่ระบบสมาชิก</a>";
                    } else {



                    ?>
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link " id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?php
                                    if (empty($_SESSION['user_img'])) {
                                        echo "<img class='img-profile rounded-circle' width='25px'  src='../../assets/img/user/user.png'>";
                                    } else {
                                        echo "<img class='img-profile rounded-circle' width='25px'  src='../../assets/img/user/" . $_SESSION['user_img'] . "'>";
                                    }

                                    ?>

                                    <span class="mr-2 "><?php echo $_SESSION['user_firstname'] . " " . $_SESSION['user_surname']; ?></span>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="../user.php">ข้อมูลสมาชิก</a></li>
                                    <li><a class="dropdown-item" href="../order_history/order_history.php">ประวัติการสั่งซื้อสินค้า</a></li>
                                    <?php 
                            // if(!empty($_SESSION['user_id']))
                            // {
                            //     echo ' <li><a class="dropdown-item" href="../transaction_cart/payment_confirmation.php">แจ้งชำระเงิน</a></li>';
                            // }  
                            ?>
                                    <li>
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                            ล็อกเอาท์
                                        </a>

                                    </li>
                                </ul>
                            </li>

                        </ul>
                    <?php


                    } //ปิดเช็คการล็อคอิน
                    ?>




                </div>
            </div>
        </div>
    </nav>
  