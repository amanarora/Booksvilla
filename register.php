<?php require_once('session_start.php'); ?>
<?php
include 'classes/database.class.php';
include 'classes/users.class.php';
$db=new database();
$db->connect();
$user=new user();
$username=$db->mysql_prep($_POST['username']);
$email=$db->mysql_prep($_POST['email']);
$password=$db->mysql_prep($_POST['password']);
$hashed_password=sha1($password);
$activation_key=mt_rand() . mt_rand() . mt_rand() . mt_rand() . mt_rand();
$query="INSERT into users(username,email,hashed_password,registration_date,activation_key,status) values ('".$username."','".$email."','".$hashed_password."',NOW(),'".$activation_key."','verify')";
if($db->query($query))
{
	
	$to      = $_POST['email'];
	$subject = "Booksvilla.com Registration | Activation Link";
	$message = "Welcome to our website!\r\rYou, or someone using your email address, has completed registration at Booksvilla.com. You can complete registration by clicking the following link:\rhttp://www.booksvilla.com/booksvilla/verify.php?$activation_key\r\rIf this is an error, ignore this email and you will be removed from our mailing list.\r\rRegards,\ Booksvilla.com Team";
	$headers = 'From: noreply@ booksvilla.com' . "\r\n" .
    'Reply-To: noreply@ booksvilla.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
	if(mail($to, $subject, $message, $headers))
	{
		$_SESSION['msg']="An email has been sent to your provided email address with the activation link";
	}
	else
	{
		$_SESSION['msg']="Error sending activation email";
	}
	
}
else{
	$_SESSION['msg']="Registration Failed";
}
header('location:index.php');
?>