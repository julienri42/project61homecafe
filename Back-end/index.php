<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <meta charset="utf-8">
    <title>  ล็อคอินเข้าสู่ระบบจัดการร้าน 61 home cafe</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/index.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css" />
    <link rel="stylesheet" href="../stylelogin.css" />
    <link href="../Front-end/css/styles.css" rel="stylesheet">
    <link href="../Front-end/css/index.css" rel="stylesheet">
  </head>
  <body>
  <div class="container login-container">
            <div class="row">
            <center><img src="../img/logo.png" alt="" width=250></center>
                <div class="col-md-6 login-form-1">
                    <h3>Login for สมาชิก</h3>
                    <form class="card-body cardbody-color p-lg-5" action="../Front-end/login_ck.php" method="POST">
                        <div class="form-group">
                          <input type="text" id="inputEmail" class="form-control" placeholder="Username" name="username" >
                        </div>
                        <div class="form-group">
                          <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" >
                        </div>
                        <div class="form-group">
                        <button class="btn btn-lg btn-primary btn-block text-uppercase text-light" type="submit">เข้าสู่ระบบ</button>
                        </div>
                        <div class="form-group">
                        <a class="btn btn-lg btn-dark btn-block text-uppercase text-light" href='../Front-end/register/register.php'>สมัครสมาชิก</a>
                        </div>
                    </form>
                </div>
                <div class="col-md-6 login-form-2">
                    <h3>Login for จัดการ</h3>
                    <form class="form-signin" action="login_ck.php" method="POST">
                        <div class="form-group">
                        <input type="text" id="inputEmail" class="form-control" placeholder="Username" name="username" >
                        </div>
                        <div class="form-group">
                        <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" >
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btnSubmit" value="Login" />
                        </div>
                        <div class="form-group">
                        </div>
                    </form>
                </div>
            </div>
          <div class="row">
        <div class="col-4 bg-light">
            <?php
              if(isset($_SESSION['result']))
              {
                echo "<center><h5>".$_SESSION['result']."</h5></center>";
                session_destroy();
              }
            ?>
        </div>
      </div>
        </div>
  </body>
</html>



<!-- <div class="container">
      <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-6 mx-auto">
          <div class="card card-signin my-5">
            <div class="card-body">
              <center><img src="../img/logo.png" alt="" width=250></center>
              <h3 class="card-title text-center">ล็อคอินเข้าสู่ระบบจัดการร้าน</h3>
              <form class="form-signin" action="login_ck.php" method="POST">

                <div class="form-label-group">
                  <input type="text" id="inputEmail" class="form-control" placeholder="Username" name="username" >
                  <label for="inputEmail">Username</label>
                </div>
                <div class="form-label-group">
                  <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" >
                  <label for="inputPassword">Password</label>
                </div>
                <button class="btn btn-color px-5 mb-5 w-100" type="submit">เข้าสู่ระบบ</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-4">
        </div>
        <div class="col-4 bg-light">
            <?php
              if(isset($_SESSION['result']))
              {
                echo "<center><h5>".$_SESSION['result']."</h5></center>";
                session_destroy();
              }
            ?>
        </div>
        <div class="col-4">
        </div>
      </div>
    </div> -->
