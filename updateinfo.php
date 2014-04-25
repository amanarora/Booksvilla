<?php require_once('session_start.php'); ?>
<?php 
include'header.php'; 
require_once('classes/database.class.php');
require_once('classes/users.class.php');
$db=new database();
$db->connect();
if(isset($_SERVER['HTTP_REFERER']))
{
	$redirect_url=$_SERVER['HTTP_REFERER'];
}

?>
<div id="main-content">
<?php include'left-sidebar.php'; ?>
<?php
if(isset($_GET['action'])){$action=$_GET['action'];}else{ $action="";}
switch($action)
{
	case "shipping":
	$name=$db->mysql_prep($_POST['name']);
	$address=$db->mysql_prep($_POST['address']);
	$city=$db->mysql_prep($_POST['city']);
	$state=$db->mysql_prep($_POST['state']);
	$pincode=$db->mysql_prep($_POST['pincode']);
	$ship_num=$db->mysql_prep($_POST['ship_num']);
	$uid=$_SESSION['uid'];
	$query="UPDATE users set ship_name='".$name."', ship_address='".$address."', ship_city='".$city."', ship_state='".$state."',ship_pincode='".$pincode."',ship_phn_number='".$ship_num."' WHERE id=".$uid;
	$result=$db->query($query);
	if($result)
	{
		echo "Infomation Updated";
		echo "<br/><a href='".$redirect_url."'>Click To Visit Previous Page</a>";
	}
	else
	{
		echo "Not able to update the information".mysql_error();
	}
	break;
	case "personal":
	$fname=$db->mysql_prep($_POST['fname']);
	$lname=$db->mysql_prep($_POST['lname']);
	$mob_num=$db->mysql_prep($_POST['mob_num']);
	$gender=$db->mysql_prep($_POST['gender']);
	$uid=$_SESSION['uid'];
	
	$query="SELECT mob_number,mob_active from users WHERE id=".$uid;
	$result=$db->query($query);
	$code_sent=false;
	if($result)
	{
		$data=mysql_fetch_array($result,MYSQL_ASSOC);
		$mob_number=$data['mob_number'];
		$mob_active=$data['mob_active'];
		if($mob_number==$mob_num)
		{
			if(!$mob_active)
			{
				$user->verify_mob($mob_num,$uid);
				echo "Verification code has been sent to your mobile phone<br/>";
				echo "<a href='verify.php?action=mobile'>Click here</a> to verify your mobile<br/><br/>";
			}
		}
		else
		{
			$user->verify_mob($mob_num,$uid);
			echo "Verification code has been sent to your mobile phone<br/>";
			echo "<a href='verify.php?action=mobile'>Click here</a> to verify your mobile<br/><br/>";
		}
	}
	else
	{
		echo  mysql_error();
	}
	
	$query="UPDATE users set fname='".$fname."', lname='".$lname."', mob_number='".$mob_num."' WHERE id=".$uid;
	$result=$db->query($query);
	if($result)
	{
			if($code_sent)
			{
				
			}
			echo "Infomation Updated";
			echo "<br/><a href='".$redirect_url."'>Click To Visit Previous Page</a>";
		
	}
	else
	{
		echo "Not able to update the information".mysql_error();
	}
	break;
	default:
	$fname=$db->mysql_prep($_POST['fname']);
	$lname=$db->mysql_prep($_POST['lname']);
	$mob_num=$db->mysql_prep($_POST['mob_num']);
	$gender=$db->mysql_prep($_POST['gender']);
	$name=$db->mysql_prep($_POST['name']);
	$address=$db->mysql_prep($_POST['address']);
	$city=$db->mysql_prep($_POST['city']);
	$state=$db->mysql_prep($_POST['state']);
	$pincode=$db->mysql_prep($_POST['pincode']);
	$ship_num=$db->mysql_prep($_POST['ship_num']);
	$uid=$_SESSION['uid'];
	
	$query="SELECT mob_num,mob_active from users WHERE id=".$uid;
	$result=$db->query($query);
	$code_sent=false;
	if($result)
	{
		$data=mysql_fetch_array($result,MYSQL_ASSOC);
		$mob_number=$data['mob_number'];
		$mob_active=$data['mob_active'];
		if($mob_number==$mob_num)
		{
			if(!mob_active)
			{
				$user->verify_mob($mob_num,$uid);
				$code_sent=true;
			}
		}
		else
		{
			$user->verify_mob($mob_num,$uid);
			$code_sent=true;
		}
	}
	
	$query="UPDATE users set fname='".$fname."', lname='".$lname."', mob_number='".$mob_num."',ship_name='".$name."', ship_address='".$address."', ship_city='".$city."', ship_state='".$state."',ship_pincode='".$pincode."',ship_phn_number='".$ship_num."' WHERE id=".$uid;
	$result=$db->query($query);
	$query="UPDATE books set live=true WHERE uid=".$uid;
	$result=$db->query($query);
	if($result)
	{
		if($code_sent)
		{
			echo "Verification code has been sent to your mobile phone<br/>";
		}
		echo "Infomation Updated";
		echo "<br/><a href='".$redirect_url."'>Click To Visit Previous Page</a>";
	}
	else
	{
		echo "Not able to update the information".mysql_error();
	}
	break;
}
?>
</div><!--End of main-content-->
<div class="clr"></div>
<?php include'footer.php'; ?>