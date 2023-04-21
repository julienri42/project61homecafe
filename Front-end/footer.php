<!-- Footer-->
    <footer class="py-5 bg-secondary">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; project 61Homecafe</p>
        </div>
    </footer>
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ออกจากระบบ</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">คุณต้องการออกจากระบบใช่หรือไม่ ?</div>
                <div class="modal-footer">
                    <a class="btn btn-danger" href="logout.php">ออกจากระบบ</a>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">ยกเลิก</button>
                </div>
            </div>
        </div>
    </div>
    <!-- ตะกร้า Modal-->
    <div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ตะกร้าสินค้า</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" id="show_cart">
                    <!-- -->
                    
                   <!-- -->
                </div>
                <div class="modal-footer">
                    <?php 
                        if(empty($_SESSION['user_id']))
                        {
                            echo "<div class='col-12 bg-danger text-white text-center'>กรุณาล็อคอินเข้าสู่ระบบเพื่อสั่งซื้อเบเกอรี่</div>";
                            echo " <a class='btn btn-info' href='../Back-end/index.php'>เข้าสู่ระบบสมาชิก</a>";
                        }
                        else
                        {
                            echo " <a class='btn btn-success' href='transaction_cart/transaction_detail.php'>สั่งซื้อสินค้า</a>
                            <button class='btn btn-danger' type='button' id='delete_all'>ลบสินค้าในตะกร้าทั้งหมด</button>";
                        }
                    ?>
                   
                </div>
                 
            </div>
        </div>
    </div>