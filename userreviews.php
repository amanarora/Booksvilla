<?php require_once('session_start.php'); ?>
<?php
if(!isset($_SESSION['login_state'])):
	include 'home.php';	
else:
	include 'header.php';
?>
<?php
$book=new books();
$user=new user();
$db=new database();
$review=new review();
if(isset($_GET['uid']))
{
	$uid=$db->mysql_prep($_GET['uid']);
}
else{
	$uid=$_SESSION['uid'];
}
if(isset($_GET['action']))
{
	$action=$db->mysql_prep($_GET['action']);
}
else{
	$action="show";
}
?>
<div id="main-content">
		<?php include'left-sidebar.php'; ?>
		<div id="centercol">
			<h2>User Reviews : <?php echo $user->name($uid); ?></h2>
			<div id="userreviews">
			<?php 
			switch($action)
			{	
				case "show":
			?>
				<p>
					<b>Total Reviews : <?php echo $review->gettotalnum($uid); ?><br/>Net Review : <?php echo $review->getnetnum($uid); ?></b><br/><br/>
					<font color="#00d61e">Positive Reviews : <?php echo $review->getnumofpos($uid); ?></font><br/>
					<font color="#ff0000">Negative Reviews : <?php echo $review->getnumofneg($uid); ?></font><br/>
					<font color="#424242">Neutral Reviews : <?php echo $review->getnumofneutral($uid); ?></font><br/><br/>
				</p>
				<span class="writereview"><a href="userreviews.php?action=write&uid=<?php echo $uid;?>">Write a review</a></span>
				<div class="clr"></div>
				<ul>
					<?php $review->getallreviews($uid);?>
				</ul>
			<?php
				break;
				case "write":
			?>
				<form action="userreviews.php?action=add&uid=<?php echo $uid; ?>" method="post">
					<select name="type">
						<option value="positive">Positive (+1)</option>
						<option value="negative">Negative (-1)</option>
						<option value="neutral">Neutral (0)</option>
					</select><br/>
					<textarea name="review" cols="50" rows="5"></textarea><br/>
					<input type="submit" value="Add Review"/>
				</form>
			<?php 
				break;
				case "add":
					$review->addreview($uid);
					echo "<br/><a href='userreviews.php?action=show&uid=$uid'>Click to view</a>";
				break;
				default:
				echo "Invalid Input";	
				break;
			}
			?>
			</div><!--End of user reviews-->
		</div><!--End of centercol-->

		<div class="clr"></div>
	</div><!--End of main-content--><?php
endif;
?>
<?php include 'footer.php'; ?>