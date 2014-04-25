<?php require_once('session_start.php'); ?>
<?php

if(!isset($_SESSION['uid']))
{
	$_SESSION['uid']="";
}
include 'header.php';
$user=new user();
$db= new database();
$db->connect();
$uid=$_SESSION['uid'];
?>
<div id="main-content">
		<div id="centercol">
			<h2>Activate Account</h2>
			<?php 
				switch($_GET['action'])
				{
					case 'verifymobile':
					$verification_code=$db->mysql_prep($_POST['mob_verification_code']);
					if($user->verifymobile($uid,$verification_code))
					{
						echo "Mobile is verified";
					}
					else
					{
						echo "Error verifying your mobile phone, please check your verification code and try again";
					}
					break;
					case 'mobile':
					echo "<br/><form action='verify.php?action=verifymobile' method=post>";
					echo "<input type='text' name='mob_verification_code'/>";
					echo "<br/><input type='submit' value='Verify' name='submit'><br/>";
					break;
					default:
					if(isset($_SERVER['QUERY_STRING']))
					{
						$queryString = $_SERVER['QUERY_STRING'];
					}
					else
					{
						$queryString="";
					}
					if(strlen($queryString)>0)
					{
						if(!$user->activate($queryString))
						{
							echo "Invalid Activation Key";
						}
					}
					else
					{
						echo "Invalid Activation Key";
					}
					break;
				}
				
			?>
		</div><!--End of centercol-->
		<div class="clr"></div>
	</div><!--End of main-content-->
<?php include 'footer.php';?>