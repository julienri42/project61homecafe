<?php
    session_start();
//    require("../../required/connect_db.php");
?>
<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="" />
<meta name="author" content="" />
<title>61 HOME CAFE</title>
<!-- Favicon-->
<link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="style.css" />
<link href="Front-end/css/styles.css" rel="stylesheet">
    <link href="Front-end/css/index1.css" rel="stylesheet">
    
<style>
body {font-family: "Times New Roman", Georgia, Serif;}
h1, h2, h3, h4, h5, h6 {
  font-family: "Playfair Display";
  letter-spacing: 5px;
}
* {box-sizing: border-box;}
body {font-family: Verdana, sans-serif;}
.mySlides {display: none;}
img {vertical-align: middle;}

</style>
</head>
<body>

<!-- Navbar (sit on top) -->
<!-- <div class="w3-top">
    <div class="w3-bar w3-white w3-padding w3-card">
      <a href="#home" class="w3-bar-item w3-button">
          <img src="img/logo.png" class="logo">
      </a> -->
      <!-- Right-sided navbar links. Hide them on small screens -->
      <!-- <div class="w3-left w3-hide-small">
        <a href="#menu" class="w3-bar-item w3-button">เมนูเเนะนำ</a>
        <a href="Front-end/information/information.php" class="w3-bar-item w3-button">ข่าวสารประชาสัมพันธ์</a>
        <a href="Front-end/information/promotion.php" class="w3-bar-item w3-button">โปรโมชั่น</a>
      </div>
      <div class="w3-right w3-hide-small">
          <a href="Back-end/index.php" class="w3-bar-item w3-button">เข้าสู่ระบบ</a>
        </div>
    </div>
  </div> -->
  <div class="navbar ">
      <div class="container ">
        <div class="navbar__logo"> <a href="#home" class="w3-bar-item w3-button"> <img src="img/logo.png" class="logo"></div>
        <div class="navbar__links ">
          <a href="#menu" class="navbar__link  w3-bar-item w3-button">เมนูเเนะนำ</a>
          <a href="Front-end/information/information.php" class="navbar__link w3-bar-item w3-button">ข่าวสารประชาสัมพันธ์</a>
          <a href="Front-end/information/promotion.php" class="navbar__link w3-bar-item w3-button">โปรโมชั่น</a>
          <a href="Back-end/index.php" class="navbar__link w3-bar-item w3-button">เข้าสู่ระบบ</a>
        </div>
      </div>
    </div>

<!-- Header -->
<header class="w3-display-container w3-content w3-wide" style="max-width:1600px;min-width:500px" id="home">
</header>
<br><br><br>
<!-- Page content -->
<div class="w3-content" style="max-width:1100px">
    <div class="slideshow-container">

        <div class="mySlides fade">
          <div class="numbertext">1 / 3</div>
          <img src="img/1.png"  width="1000px" height="500px">
        </div>
        
        <div class="mySlides fade">
          <div class="numbertext">2 / 3</div>
          <img src="img/2.png"  width="1000px" height="500px">
        </div>
        
        <div class="mySlides fade">
          <div class="numbertext">3 / 3</div>
          <img src="img/3.png"  width="1000px" height="500px">
        </div>
        
        </div>
        <br>
        
        <div style="text-align:center">
          <span class="dot"></span> 
          <span class="dot"></span> 
          <span class="dot"></span> 
        </div>
        <script>
            let slideIndex = 0;
            showSlides();
            
            function showSlides() {
              let i;
              let slides = document.getElementsByClassName("mySlides");
              let dots = document.getElementsByClassName("dot");
              for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";  
              }
              slideIndex++;
              if (slideIndex > slides.length) {slideIndex = 1}    
              for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
              }
              slides[slideIndex-1].style.display = "block";  
              dots[slideIndex-1].className += " active";
              setTimeout(showSlides, 2000); // Change image every 2 seconds
            }
            </script>
  <!-- About Section -->
  <!-- <div class="w3-row w3-padding-64" id="about">

    <div class="w3-col m6 w3-padding-large">
      <h1 class="w3-center">About Catering</h1><br>
      <h5 class="w3-center">Tradition since 1889</h5>
      <p class="w3-large">The Catering was founded in blabla by Mr. Smith in lorem ipsum dolor sit amet, consectetur adipiscing elit consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute iruredolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.We only use <span class="w3-tag w3-light-grey">seasonal</span> ingredients.</p>
      <p class="w3-large w3-text-grey w3-hide-medium">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod temporincididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    </div>
  </div>
  
  <hr> -->
  
<!-- Menu Section -->
<div class="w3-row w3-padding-64" id="menu">
    <div class="w3-col l6 w3-padding-large">
      <h1 class="w3-center">เมนูใหม่ ขอแนะนำ</h1><br>
      <h4>Strawberry Season</h4>
      <p class="w3-text-grey">มีทั้งหมด 3 เมนู</p><br>

      <h4>Strawberry Latte </h4>
      <p class="w3-text-grey"> สตรอว์เบอร์รี่ ลาเต้ 30฿</p><br>

      <h4>Strawberry Yogurt Smoothies </h4>
      <p class="w3-text-grey">สตรอว์เบอร์รี่ โยเกิร์ต สมูทตี้ 30฿</p><br>

      <h4>Strawberry Iced Soda</h4>
      <p class="w3-text-grey">สตรอว์เบอร์รี่ โซดา 25฿</p><br>
    </div>

    <div class="w3-col l6 w3-padding-large">
      <img src="img/4.jpg" class="w3-round w3-image w3-opacity-min" alt="Menu" style="width:100%">
    </div>
  </div>

  <hr>

<!-- End page content -->
</div>

<!-- Footer -->
<footer class="w3-center w3-light-grey w3-padding-32">
    <a href="modules/home/about.php" class="w3-bar-item w3-button">เกี่ยวกับเรา</a>
<a href="modules/home/Contact.php" class="w3-bar-item w3-button">ติดต่อเรา :</a>
<a href="https://www.facebook.com/lalanattapong" class="w3-bar-item w3-button">
    <img src="img/facebook.png" class="w3-round w3-image w3-opacity-min" alt="Table Setting" width="50" height="100">
</a>
<!-- <a href="#" class="w3-bar-item w3-button">
    <img src="img/line.png" class="w3-round w3-image w3-opacity-min" alt="Table Setting" width="50" height="100">
</a> -->
</div>
</footer>

</body>
</html>
    