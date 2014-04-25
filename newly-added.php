<?php require_once('session_start.php'); ?>
<?php
if(!isset($_SESSION['login_state'])):
	include 'home.php';	
else:
	include 'header.php';
?>
<?php
	$book=new books();
	$db=new database();
	$user=new user();
	if(isset($_GET['uid']))
	{
		$uid=$db->mysql_prep($_GET['uid']);
	}
	else{
		$uid=$_SESSION['uid'];
	}
	
?>
<div id="main-content">
		<?php include'left-sidebar.php'; ?>
		<div id="centercol">
			<h2>Newly Added Books</h2>
			<div class="books-display">
				<?php 
					if(isset($_GET['page']))
					{
						$pagenum=$db->mysql_prep($_GET['page']);
					}
					else
					{
						$pagenum=1;
					}
					$book->getrecentlyadded($pagenum,false);
				?>
				<div class="clr"></div>
			</div><!--End of Books Display-->
					</div><!--End of centercol-->
		<div class="clr"></div>
	</div><!--End of main-content-->
<?php
endif;
?>
<?php include 'footer.php'; ?>