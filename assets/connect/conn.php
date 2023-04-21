
<?php
    $connect=mysqli_connect("localhost","root","1234","61homedatabase");
    $connect->set_charset("utf8");
    $selectadb=mysqli_select_db($connect,"61homedatabase");
    if(!$connect){
        echo "ไม่สามารถเชื่อมต่อได้";
    }

?>