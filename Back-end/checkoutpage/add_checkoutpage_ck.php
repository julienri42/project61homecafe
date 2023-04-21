<?php 
    session_start();
    include('../../assets/connect/conn.php');    
        ///////
    $time=date("Y-m-d H:i:s",time());
        if(isset($_POST['pid']))
        {
            $sqlorder="SELECT * FROM tb_order";
            $resultorder=$connect->query($sqlorder);
            $total=$_POST['total']; 
            while($roworder = $resultorder->fetch_array()){
                $order_id=$roworder['order_id'];
            }
            $order_id=$order_id+1;  
            $employee_id=$_SESSION['employee_id'];
            if(isset($_SESSION['member_id']))
            {
                $member_id=$_SESSION['member_id'];
                $discountnumber=$_POST['discountnumber'];
            }
            else{
                $member_id=0;
                $discountnumber=0;  
            }
            
            $sql ="INSERT INTO tb_order(order_id,employee_id,user_id
            ,order_receipt_no,order_total,order_discount
            ,order_date_added,order_status)
            VALUES('$order_id','$employee_id','$member_id','$order_id','$total','$discountnumber','$time','พนักงาน')";
            $connect->query($sql);


            $pid=$_POST['pid'];
            $amount=$_POST['amount'];
            $totalprice=$_POST['totalprice'];
            for($i=0;$i<count($pid);$i++)
            {
                $product_id=$pid[$i];
                $product_amount=$amount[$i];
                $stock_amount=$product_amount;
                $totalprice2=$totalprice[$i];
                $sql1 ="INSERT INTO tb_orderdetail(order_id,product_id,orderdetail_quantity,orderdetail_price)
                VALUES('$order_id','$product_id','$product_amount','$totalprice2')";
                $connect->query($sql1);

                $sql3="SELECT * FROM tb_product_stock_list WHERE product_id='$product_id' AND product_stock_remaining!='0' 
                AND product_stock_expiry_date>='$time' ORDER BY product_stock_expiry_date ";
                $result3 = $connect->query($sql3);
                while($row3 = $result3->fetch_array()){
                    if($stock_amount>0)
                    {
                        $product_stock_id=$row3['product_stock_id'];
                        $product_stock_remaining=$row3['product_stock_remaining']-$stock_amount;
                        if($product_stock_remaining<0){
                            $product_stock_remaining=0;
                        }
                        $sql2 ="UPDATE tb_product_stock_list SET product_stock_remaining='$product_stock_remaining' WHERE product_stock_id ='$product_stock_id'";
                        $connect->query($sql2);
                        $stock_amount=$stock_amount-$row3['product_stock_remaining'];
                    }
                }
                
            }
            $_SESSION['order_id']=$order_id;
            unset($_SESSION['pid']);
            unset($_SESSION['amount']);
            unset($_SESSION['member_id']); 
            unset($_SESSION['member_nickname']); 
            unset($_SESSION['userstatus_discount']);
            $_SESSION['edit_status']= "4";//เพิ่มข้อมูลสำเร็จ
            header('Location:checkoutpage.php');
        }else{

            $_SESSION['edit_status']= "1"; //กรอกข้อมูลไม่ครบ
            header('Location: checkoutpage.php');
        }
    mysqli_close($connect);
    
?>