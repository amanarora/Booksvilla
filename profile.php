<?php require_once('session_start.php'); ?>
<?php
if(!isset($_SESSION['login_state'])):
	include 'home.php';	
else:
	include 'header.php';
?>
<?php
	$message=new message();
	$db=new database();
	$user=new user();
	$review=new review();
	$book=new books();
	if(isset($_GET['uid']))
	{
		$uid=$db->mysql_prep($_GET['uid']);
	}
	else if(isset($_SESSION['uid']))
	{
		$uid=$_SESSION['uid'];
	}
?>
<div id="main-content">
		<?php include'left-sidebar.php'; ?>
		<div id="centercol">
		<?php if(isset($uid)):?>
			<h2>User Profile : <?php echo $user->name($uid);?></h2><br/>
			<b>Username : </b><?php echo  $user->username($uid); ?><br/>
			<b>Name : </b><?php echo $user->name($uid);?><br/>
			<b>Registration Date : </b><?php echo  $user->regdate($uid); ?><br/>
			<b>Net Review : </b><a href="userreviews.php?action=show&uid=<?php echo $uid; ?>"><?php echo  $review->getnetnum($uid); ?></a><br/>
			<b>Total Uploaded Books : </b><a href="userbooks.php?uid=<?php echo $uid;?>"><?php echo $book->gettotalbyuser($uid); ?></a><br/>
			<a href="message.php?action=write&uid=<?php echo $uid;?>">Send Message</a><br/>
		<?php else:?>
			You are not allowed to view this page direclty.
		<?php endif;?>
		</div><!--End of centercol-->
		<div class="clr"></div>
	</div><!--End of main-content-->
<?php
endif;
?>
<?php include 'footer.php'; ?>