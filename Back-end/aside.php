<?php 
    if(empty($_SESSION['employee_id']))
    {
        $_SESSION['result'] ="กรุณาเข้าสู่ระบบใหม่";
        
        header('Location: index.php');
        
    }
?>
<div class="h-100 bg-secondary position-absolute w-100" ></div>
  <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="admin_home.php">
        <img src="../assets/img/logos.png" class="navbar-brand-img w-20 h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold">61 Home Cafe</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
     <!--admin -->
    <?php   if($_SESSION['employee_position']=='admin') {    ?>
    <div class="collapse navbar-collapse w-auto h-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link  <?php if($_SESSION['page']=="admin_home.php") {echo "active";} ?>" href="admin_home.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-address-card text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">ข้อมูลส่วนตัว</span>
          </a>
        </li>
        <hr class="horizontal dark mt-0">
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">พนักงาน</h6>
        </li>
      
        <li class="nav-item">
          <a class="nav-link <?php if($_SESSION['page']=="employee.php") {echo "active";} ?>" href="employee/employee.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-user  text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">จัดการข้อมูลพนักงาน</span>
          </a>
        </li>
        <hr class="horizontal dark mt-0">
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">สมาชิก</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if($_SESSION['page']=="users.php") {echo "active";} ?>" href="users/users.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-users text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">จัดการข้อมูลสมาชิก</span>
          </a>
        </li>
        <hr class="horizontal dark mt-0">
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">สารสนเทศ</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if($_SESSION['page']=="information.php") {echo "active";} ?>" href="information/information.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-file-signature text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">จัดการข้อมูลข่าวสาร</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if($_SESSION['page']=="promotion.php") {echo "active";} ?>" href="information/promotion.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-gift text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">จัดการข้อมูลโปรโมชั่น</span>
          </a>
        </li>
        <hr class="horizontal dark mt-0">
      </ul>
    </div>
    <?php }?>
    <!--พนักงาน -->
    <?php   if($_SESSION['employee_position']=='พนักงาน') {   ?>
      <div class="collapse navbar-collapse w-auto h-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
        <a class="nav-link  <?php if($_SESSION['page']=="admin_home.php") {echo "active";} ?>" href="admin_home.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-address-card text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">ข้อมูลส่วนตัว</span>
          </a>
        </li>
        <hr class="horizontal dark mt-0">
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">ชำระเงิน(พนักงาน)</h6>
        </li>
      
        <li class="nav-item">
          <a class="nav-link <?php if($_SESSION['page']=="checkoutpage.php") {echo "active";} ?>" href="checkoutpage/checkoutpage.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-book  text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">หน้าออเดอร์(พนักงาน)</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if($_SESSION['page']=="receipt_checkoutpage.php") {echo "active";} ?>" href="checkoutpage/receipt_checkoutpage.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-book  text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">ออกใบเสร็จ (พนักงาน)</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if($_SESSION['page']=="paymentpage.php") {echo "active";} ?>" href="paymentpage/paymentpage.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-users text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">ข้อมูลการสั่งออเดอร์</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if($_SESSION['page']=="receipt_online.php") {echo "active";} ?>" href="receipt_online/receipt_online.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-book text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">ออกใบเสร็จ(สมาชิก)</span>
          </a>
        </li>
        <hr class="horizontal dark mt-0">
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">สินค้า</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if($_SESSION['page']=="product.php") {echo "active";} ?>" href="product/product.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-boxes  text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">จัดการข้อมูลสินค้า</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if($_SESSION['page']=="typeproduct.php") {echo "active";} ?>" href="typeproduct/typeproduct.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-book text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">จัดการประเภทสินค้า</span>
          </a>
        </li>
        <hr class="horizontal dark mt-0">
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">วัตถุดิบ</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if($_SESSION['page']=="material.php") {echo "active";} ?>" href="material/material.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-box text-danger text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">จัดการข้อมูลวัตถุดิบ</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if($_SESSION['page']=="typematerial.php") {echo "active";} ?>" href="typematerial/typematerial.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-book text-danger text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">จัดการประเภทวัตถุดิบ</span>
          </a>
        </li>
        <hr class="horizontal dark mt-0">
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">สต็อกสินค้า</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if($_SESSION['page']=="product_stock.php") {echo "active";} ?>" href="product_stock/product_stock.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-boxes  text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">ข้อมูลสต็อกสินค้า</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if($_SESSION['page']=="material_stock.php") {echo "active";} ?>" href="material_stock/material_stock.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-book text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">ข้อมูลสต็อกวัตถุดิบ</span>
          </a>
        </li>
        <hr class="horizontal dark mt-0">
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">เงินเดือน</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if($_SESSION['page']=="index.php") {echo "active";} ?>" href="EmployeeAttendance_CI/index.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-file-invoice-dollar text-danger text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">เงินเดือน</span>
          </a>
        </li>
        <hr class="horizontal dark mt-0">
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">:ซื้อของเข้าร้าน</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if($_SESSION['page']=="materialbuyer.php") {echo "active";} ?>" href="materialbuyers/materialbuyer.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-cart-plus text-danger text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">ซื้อของเข้าร้าน</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if($_SESSION['page']=="matbuypage.php") {echo "active";} ?>" href="materialbuyers/matbuypage.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-cart-plus text-danger text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">ข้อมูลซื้อของเข้าร้าน</span>
          </a>
        </li>
        <hr class="horizontal dark mt-0">
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">รายงาน</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if($_SESSION['page']=="reportinventories.php") {echo "active";} ?>" href="report/reportinventories.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-book text-danger text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">รายงานสินค้าคงเหลือ</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if($_SESSION['page']=="reportmaterial.php") {echo "active";} ?>" href="report/reportmaterial.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-book text-danger text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">รายงานวัตถุดิบคงเหลือ</span>
          </a>
        </li>
      </ul>
    </div>
    <?php  }?>
    <!--เจ้าของร้าน -->
    <?php    if($_SESSION['employee_position']=='เจ้าของร้าน') {    ?>
      <div class="collapse navbar-collapse w-auto h-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
        <a class="nav-link  <?php if($_SESSION['page']=="admin_home.php") {echo "active";} ?>" href="admin_home.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-address-card text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">ข้อมูลส่วนตัว</span>
          </a>
        </li>
        <hr class="horizontal dark mt-0">
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">สารสนเทศ</h6>
        </li>
        <li class="nav-item">
        <a class="nav-link <?php if($_SESSION['page']=="Dashboard.php") {echo "active";} ?>" href="report/dashboard.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-book  text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
        <a class="nav-link <?php if($_SESSION['page']=="reportproduct.php") {echo "active";} ?>" href="report/reportproduct.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-book  text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">รายงานสินค้าขายดี</span>
          </a>
        </li>
        <li class="nav-item">
        <a class="nav-link <?php if($_SESSION['page']=="reportinventories.php") {echo "active";} ?>" href="report/reportinventories.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-book  text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">รายงานสินค้าคงเหลือ</span>
          </a>
        </li>
        <li class="nav-item">
        <a class="nav-link <?php if($_SESSION['page']=="reportmaterial.php") {echo "active";} ?>" href="report/reportmaterial.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-book  text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">รายงานวัตถุดิบคงเหลือ</span>
          </a>
        </li>
        <li class="nav-item">
        <a class="nav-link <?php if($_SESSION['page']=="reportorder.php") {echo "active";} ?>" href="report/reportorder.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-book  text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">รายงานการสั่งซื้อสินค้า</span>
          </a>
        </li>
        <!-- <li class="nav-item">
        <a class="nav-link <?php if($_SESSION['page']=="reportstoresales.php") {echo "active";} ?>" href="report/reportstoresales.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-book  text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">รายงานยอดขาย(พนักงาน)</span>
          </a>
        </li> -->
        <li class="nav-item">
        <a class="nav-link <?php if($_SESSION['page']=="reportonlinesales.php") {echo "active";} ?>" href="report/reportonlinesales.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-book  text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">รายงานยอดขาย</span>
          </a>
        </li>
        <!-- <li class="nav-item">
        <a class="nav-link <?php if($_SESSION['page']=="reportservice.php") {echo "active";} ?>" href="report/reportservice.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-book  text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">รายงานการเสริฟ</span>
          </a>
        </li> -->
        <li class="nav-item">
        <a class="nav-link <?php if($_SESSION['page']=="reportincome_expenses.php") {echo "active";} ?>" href="report/reportincome_expenses.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-book  text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">รายงานรายรับ-รายจ่าย</span>
          </a>
        </li>
        <hr class="horizontal dark mt-0">
        <li class="nav-item">
        <a class="nav-link <?php if($_SESSION['page']=="index.php") {echo "active";} ?>" href="EmployeeAttendance_CI/index.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-book  text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">จัดการเงินเดือนพนักงาน</span>
          </a>
        </li>
        <hr class="horizontal dark mt-0">
        <li class="nav-item">
        <a class="nav-link <?php if($_SESSION['page']=="forecast.php") {echo "active";} ?>" href="Forecast/forecast.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-book  text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">พยากรณ์วัตถุดิบ</span>
          </a>
        </li>
        <hr class="horizontal dark mt-0">
        <li class="nav-item">
        <a class="nav-link <?php if($_SESSION['page']=="matbuy_receipt_online.php") {echo "active";} ?>" href="matbuy_receipt_online/matbuy_receipt_online.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-book  text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">สั่งซื้อของเข้าร้าน</span>
          </a>
        </li>
        <hr class="horizontal dark mt-0">
        
      </ul>
    </div>
    <?php  }?>
  </aside>