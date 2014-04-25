<?php
	 $secret_key = "ebskey";	 // Your Secret Key
	if(isset($_GET['DR'])) {
	 require('Rc43.php');
	 $DR = preg_replace("/\s/","+",$_GET['DR']);

	 $rc4 = new Crypt_RC4($secret_key);
 	 $QueryString = base64_decode($DR);
	 $rc4->decrypt($QueryString);
	 $QueryString = split('&',$QueryString);

	 $response = array();
	 foreach($QueryString as $param){
	 	$param = split('=',$param);
		$response[$param[0]] = urldecode($param[1]);
	 }
	 $order_no=$response['MerchantRefNo'];
	$transaction_id=$response['TransactionID'];
	$book_id=($order_no-2709)/12;
	$amount=$response['Amount'];
	$response_code=$response['ResponseCode'];
	
}

?>
<?php 
include 'header.php';
$book=new books();
$user=new user();
$user_price=$book->getuserprice($book_id);
?>
<div id="main-content">
<?php include'left-sidebar.php'; ?>
<?php 
	if($response_code==0)
	{
		if($amount==$userprice)
		{
			echo "<br/>Transaction Completed Successfully. Seller Has Been Notified About The Order";
			echo "<br/>Your Order Number : ".$order_no;
			echo "<br/>Your Transaction Id : ".$transaction_id;
			$user->sendwelcomesms($user->getphnnumber($book->getselleruid($book_id)));
		}
		else
		{
			echo "Amnount of your payment wasn't correct. Please contact our support for help.";
		}
	}
	else
	{
		echo "Transaction Failed";
		$user->sendwelcomesms($user->getphnnumber($book->getselleruid($book_id)));
	}
?>
</div><!--End of main-content-->
<div class="clr"></div>
<?php include 'footer.php'?>