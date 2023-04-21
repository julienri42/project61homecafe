<?php 
    session_start();
    include('../../assets/connect/conn.php');
    
    if(empty($_FILES['information_img']['name']))
    {
        $information_img="";
    }
    else
    {
        $pic_name=$_FILES['information_img']['name'];
        $information_img=str_shuffle(date("dmYHIs"))."_".$pic_name;
        $pic_temp=$_FILES['information_img']['tmp_name'];
        copy($pic_temp,"../../assets/img/information/$information_img");
    }
    if(isset($_POST['information_name'])&&isset($_POST['information_details']))
    {
        $information_name=$_POST['information_name'];
        $information_details=$_POST['information_details'];
        $information_date=date("Y-m-d H:i:s",time());

        $sql ="INSERT INTO informations(information_name,information_details
        ,information_date,information_img) 
        VALUES('$information_name','$information_details','$information_date','$information_img')";
        
        if ($connect->query($sql) === TRUE) {
            echo "Record updated successfully";
            header('Location: information.php');
          } else {
            echo "Error updating record: " . $connect->error;
          }
    }
    else{
        $_SESSION['edit_status']= "1"; //กรอกข้อมูลไม่ครบ
        header('Location: information.php');
        
    }
    
    mysqli_close($connect);

    $sToken = "LMd6pGK4ruVzX61NuBaXq7NeVNS2glrTxeKuvJ54gqj";
	$sMessage = "ข่าวสารประชาสัมพันธ์!\n";
    $sMessage .= "ชื่อข่าวสาร: " . $information_name . "\n";
    $sMessage .= "รายละเอียดข่าวสาร: " . $information_details . "\n";
    $sMessage .= "วันเวลา: " . $information_date . "\n";

	
	$chOne = curl_init(); 
	curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
	curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
	curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
	curl_setopt( $chOne, CURLOPT_POST, 1); 
	curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
	$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
	curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
	curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
	$result = curl_exec( $chOne ); 

	//Result error 
	if(curl_error($chOne)) 
	{ 
		echo 'error:' . curl_error($chOne); 
	} 
	else { 
		$result_ = json_decode($result, true); 
		echo "status : ".$result_['status']; echo "message : ". $result_['message'];
	} 
	curl_close( $chOne );  
    
?>