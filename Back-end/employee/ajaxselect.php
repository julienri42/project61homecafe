<?php 
     include('../../assets/connect/conn.php');

     if (isset($_POST['function']) && $_POST['function'] == 'checkusername') {
        $id = $_POST['id'];
        $sql = "SELECT * FROM tb_employee WHERE employee_username ='$id'";
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

   
    
    mysqli_close($connect);
