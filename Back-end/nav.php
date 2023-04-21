    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">

          </div>
          <ul class="navbar-nav justify-content-end">
            <li class="nav-item d-flex align-items-center dropdown">
              <a class="nav-link dropdown-toggle text-white font-weight-bold px-0" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                <?php 
                   if(!empty($_SESSION['employee_img'])){
                    echo '  <img class="img-profile rounded-circle" src="../assets/img/employee/'.$_SESSION['employee_img'].'" width="30" height="30">';
                }  
                else{  
                    echo ' <img class="img-profile rounded-circle" src="../assets/img/employee/user.png"  width="30" height="30">'; 
                }   
                ?>
               
                <span class="d-sm-inline d-none"><?php echo $_SESSION['employee_firstname']." ".$_SESSION['employee_surname']; ?></span>
              </a>
              <!-- Dropdown - User Information -->
              <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="edit_employee.php?id=<?php  echo $_SESSION["employee_id"]; ?>">ข้อมูลส่วนตัว</a></li>
                <li><a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">ออกจากระบบ</a></li>
              
              </ul>
            </li>

            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                </div>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
     <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ออกจากระบบ</h5>

                </div>
                <div class="modal-body">คุณต้องการออกจากระบบใช่หรือไม่ ?</div>
                <div class="modal-footer">
                    <a class="btn btn-danger" href="logout.php">ออกจากระบบ</a>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">ยกเลิก</button>
                    
                </div>
            </div>
        </div>
    </div>
