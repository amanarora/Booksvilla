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

		<div id="account-right-sidebar">

			<ul>
				<li><a href="account.php">My Account</a></li>
				<li><a href="#">My Shopping Cart</a></li>
				<li><a href="#">My Orders</a></li>
				<li><a href="search.php">Search Books</a></li>
				<li><a href="#">Sold Till Date</a></li>
				<li><a href="#">Bought Till Date</a></li>
				<li><a href="userreviews.php?action=show&uid=<?php echo $_SESSION['uid']?>">User Reviews : <?php echo $review->getnetnum($_SESSION['uid']); ?></a></li>
			</ul>
		</div><!--End of account-right-sidebar-->
		<div id="centercol">
		<?php include'templates/update_account_info.tpl.php' ?>
		</div><!--End of centercol-->
		
		<div class="clr"></div>
	</div><!--End of main-content-->
				<div class="clr"></div>
<?php
endif;
?>
<?php include 'footer.php'; ?>