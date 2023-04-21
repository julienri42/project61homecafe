<?php 
     include('../../assets/connect/conn.php');

     if (isset($_POST['function']) && $_POST['function'] == 'checkusername') {
        $id = $_POST['id'];
        $sql = "SELECT * FROM tb_user WHERE user_username ='$id'";
        $query = mysqli_query($connect, $sql);
        if (mysqli_num_rows($query)>0) {
            echo "<td><input type='hidden' id='chkusers' value=''></td>";
            echo "<td><div class='text-danger fs-4 mb-2'>*มีusername ที่ซ้ำกัน</div></td>";

        }
        else{
            echo "<td><input type='hidden' id='chkusers' value='1'></td>";
            echo "<td><div class='text-primary fs-4 mb-2'>usernameนี้สามารถใช้งานได้</div></td>";
        }

        mysqli_free_result($query);
    }
    if (isset($_POST['function']) && $_POST['function'] == 'user_tel') {
        $id = $_POST['id'];
        $sql = "SELECT * FROM tb_user WHERE user_tel ='$id'";
        $query = mysqli_query($connect, $sql);
        if (mysqli_num_rows($query)>0) {
            echo "<td><input type='hidden' id='chktel' value=''></td>";
            echo "<td><div class='text-danger fs-4 mb-2'>*เบอร์โทรศัพท์ที่ซ้ำกันกรุณาเปลี่ยน</div></td>";

        }
        else{
            echo "<td><input type='hidden' id='chktel' value='1'></td>";
            echo "<td><div class='text-primary fs-4 mb-2'>เบอร์โทรศัพท์นี้สามารถใช้งานได้</div></td>";
        }

        mysqli_free_result($query);
    }
    if (isset($_POST['function']) && $_POST['function'] == 'user_email') {
        $id = $_POST['id'];
        $sql = "SELECT * FROM tb_user WHERE user_email ='$id'";
        $query = mysqli_query($connect, $sql);
        if (mysqli_num_rows($query)>0) {
            echo "<td><input type='hidden' id='chkemail' value=''></td>";
            echo "<td><div class='text-danger fs-4 mb-2'>*อีเมล์ซ้ำกันกรุณาเปลี่ยน</div></td>";

        }
        else{
            
            echo "<td><input type='hidden' id='chkemail' value='1'></td>";
            echo "<td><div class='text-primary fs-4 mb-2'>อีเมล์นี้สามารถใช้งานได้</div></td>";
        }

        mysqli_free_result($query);
    }

   
    
    mysqli_close($connect);
