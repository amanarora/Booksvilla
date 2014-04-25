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
?>
<div id="main-content">
		<?php include'left-sidebar.php'; ?>
		<div id="centercol">
			<h2>Top New Releases : </h2>
			<div class="books-display">
				<?php $book->getrecentlyadded(false,3);?>
				<a href="newly-added.php" class="more">More...</a>
			</div><!--End of Books Display-->
			<div class="clr">
			</div><!--End of Clr-->
			<h2>Featured : </h2>
			<div class="books-display">
				<?php $book->getrecentlyadded(false,3);?>
				<a href="newly-added.php" class="more">More...</a>
			</div><!--End of Books Display-->
			<div class="clr">
			</div><!--End of Clr-->
			<h2>Recently Sold : </h2>
			<div class="books-display">
				<?php $book->getrecentlyadded(false,3);?>
				<a href="newly-added.php" class="more">More...</a>
			</div><!--End of Books Display-->
		</div><!--End of centercol-->
	
		<div class="clr"></div>
	</div><!--End of main-content-->
<?php
endif;
?>
<?php include 'footer.php'; ?>