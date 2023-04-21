<?php 
     include('../../assets/connect/conn.php');

     if (isset($_POST['function']) && $_POST['function'] == 'checkusername') {
        $id = $_POST['id'];
        $sql = "SELECT * FROM tb_user WHERE user_username ='$id'";
        $query = mysqli_query($connect, $sql);
        if (mysqli_num_rows($query)>0) {
            echo "<div class='text-danger'>*มีusername ที่ซ้ำกัน</div>";

        }
        else{
            echo "<div class='text-primary'>usernameนี้สามารถใช้งานได้</div>";
           
        }

        mysqli_free_result($query);
    }
    if (isset($_POST['function']) && $_POST['function'] == 'user_tel') {
        $id = $_POST['id'];
        $sql = "SELECT * FROM tb_user WHERE user_tel ='$id'";
        $query = mysqli_query($connect, $sql);
        if (mysqli_num_rows($query)>0) {
            echo "<div class='text-danger'>*เบอร์โทรศัพท์ที่ซ้ำกันกรุณาเปลี่ยน</div>";

        }
        else{
            echo "<div class='text-primary'>เบอร์โทรศัพท์นี้สามารถใช้งานได้</div>";
        }

        mysqli_free_result($query);
    }
    if (isset($_POST['function']) && $_POST['function'] == 'user_email') {
        $id = $_POST['id'];
        $sql = "SELECT * FROM tb_user WHERE user_email ='$id'";
        $query = mysqli_query($connect, $sql);
        if (mysqli_num_rows($query)>0) {
            echo "<div class='text-danger'>*อีเมล์ซ้ำกันกรุณาเปลี่ยน</div>";

        }
        else{
            echo "<div class='text-primary'>อีเมล์นี้สามารถใช้งานได้</div>";
        }

        mysqli_free_result($query);
    }

   
    
    mysqli_close($connect);
