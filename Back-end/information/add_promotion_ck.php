<?php 
    session_start();
    include('../../assets/connect/conn.php');
    
    if(empty($_FILES['promotion_img']['name']))
    {
        $promotion_img="";
    }
    else
    {
        $pic_name=$_FILES['promotion_img']['name'];
        $promotion_img=str_shuffle(date("dmYHIs"))."_".$pic_name;
        $pic_temp=$_FILES['promotion_img']['tmp_name'];
        copy($pic_temp,"../../assets/img/promotion/$promotion_img");
    }
    if(isset($_POST['promotion_name'])&&isset($_POST['promotion_details']))
    {
        $promotion_name=$_POST['promotion_name'];
        $promotion_details=$_POST['promotion_details']; 
        $promotion_date=date("Y-m-d H:i:s",time());

        $sql ="INSERT INTO promotions(promotion_name,promotion_details
        ,promotion_date,promotion_img) 
        VALUES('$promotion_name','$promotion_details','$promotion_date','$promotion_img')";
        
        if ($connect->query($sql) === TRUE) {
            echo "Record updated successfully";
            header('Location: promotion.php');
          } else {
            echo "Error updating record: " . $connect->error;
          }
    }
    else{
        $_SESSION['edit_status']= "1"; //กรอกข้อมูลไม่ครบ
        header('Location: promotion.php');
        
    }
    
    mysqli_close($connect);

    $sToken = "LMd6pGK4ruVzX61NuBaXq7NeVNS2glrTxeKuvJ54gqj";
	$sMessage = "โปรโมชั่น!\n";
    $sMessage .= "ชื่อโปรโมชั่น: " . $promotion_name . "\n";
    $sMessage .= "รายละเอียดโปรโมชั่น: " . $promotion_details . "\n";
    $sMessage .= "วันเวลา: " . $promotion_date . "\n";

	
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