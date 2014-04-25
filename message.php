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
	if(isset($_GET['uid']))
	{
		$uid=$db->mysql_prep($_GET['uid']);
	}
	else
	{
		$uid="";
	}
	if(isset($_GET['mid']))
	{
		$mid=$db->mysql_prep($_GET['mid']);
	}
	else
	{
		$mid="";
	}
	if(!isset($_GET['action']))
	{
		$_GET['action']="";
	}
?>
<div id="main-content">
		<?php include'left-sidebar.php'; ?>
		<div id="centercol">
			<h2>Private Messaging : Inbox</h2>
			<div id="message">
			<?php 
				switch($_GET['action'])	
				{
					case "send":
						$message->sendmessage($_SESSION['uid'],$uid,$_POST['subject'],$_POST['body']);
					break;
					case "write":
					
			?>
			<form action="message.php?action=send&uid=<?php echo $uid; ?>" method="post">
				Subject : <input type="text" name="subject" size="40"/><br/>
				Message : <textarea name="body" cols="32" rows="5"></textarea><br/>
				<input type="submit" value="Send"/>
			</form>
			<?php
					break;
					case "read":
					if($message->readMessage($mid)):
			?>
				<div class="heading">
					Subject : <?php echo $message->subject(); ?><br/>
					Sent By : <?php echo $user->name($message->sender_id());?>
				</div>
				<?php echo $message->body(); ?>
			<?php
					endif;
					break;
					default:
			?>
				<div id="subject">
					<ul>
						<li class="heading">Subject</li>
						<?php $message->subjectlist($_SESSION['uid']); ?>
					<ul>
				</div>
				<div id="sender">
					<ul>
						<li class="heading">Sender</li>
						<?php $message->senderlist($_SESSION['uid']); ?>
					<ul>
				</div>
				<div id="time">
					<ul>
						<li class="heading">Date</li>
						<?php $message->timelist($_SESSION['uid']); ?>
					<ul>
				</div>
			<?php
					break;
				}
			?>
			</div><!--End of message-->
		</div><!--End of centercol-->
		<div class="clr"></div>
	</div><!--End of main-content-->
<?php
endif;
?>
<?php include 'footer.php'; ?>