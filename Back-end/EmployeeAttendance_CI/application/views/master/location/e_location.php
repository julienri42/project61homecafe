        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

          <a href="<?= base_url('master/location'); ?>" class="btn btn-secondary btn-icon-split mb-4">
            <span class="icon text-white">
              <i class="fas fa-chevron-left"></i>
            </span>
            <span class="text">กลับ</span>
          </a>

          <form action="" method="POST" class="col-lg-5  p-0">
            <div class="card">
              <h5 class="card-header">แก้ไขสถานที่</h5>
              <div class="card-body">
                <div class="form-group">
                  <label class="col-form-label-lg">สถานที่ ID</label>
                  <input type="text" readonly class="form-control-plaintext form-control-lg" name="l_id" value="<?= $l_old['id']; ?>">
                </div>
                <div class="form-group">
                  <label for="l_name" class="col-form-label-lg">ชื่อสถานที่</label>
                  <input type="text" class="form-control form-control-lg" name="l_name" id="l_name" value="<?= $l_old['name']; ?>">
                  <?= form_error('l_name', '<small class="text-danger">', '</small>') ?>
                </div>
                <button type="submit" class="btn btn-success btn-icon-split mt-4 float-right">
                  <span class="icon text-white">
                    <i class="fas fa-check"></i>
                  </span>
                  <span class="text">ยืนยัน</span>
                </button>
          </form>
        </div>
        </div>
        </form>
        </div>
        <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->