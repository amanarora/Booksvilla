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
	$cid=$db->mysql_prep($_GET['category']);
?>
<div id="main-content">
		<?php include'left-sidebar.php'; ?>
		<div id="centercol">
			<h2>Showing Books In Category "<?php echo $book->getcatname($cid); ?>"</h2>
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
					$book->showbooksbycat($cid,$pagenum);
				?>
				<div class="clr">
				</div>
			</div><!--End of Books Display-->
					</div><!--End of centercol-->
		<div class="clr"></div>
	</div><!--End of main-content-->
<?php
endif;
?>
<?php include 'footer.php'; ?>
