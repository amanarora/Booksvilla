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
$bid=$db->mysql_prep($_GET['id']);
?>
<div id="main-content">
		<?php include'left-sidebar.php'; ?>
		<div id="centercol">
			<h2>Book Details </h2>
			<div class="books-details">
			<a href="checkout.php?bookid=<?php echo $bid?>" class="buy-link">Buy It Now</a>
				<img height='120px' width='100px' src='<?php echo $book->image_url($bid); ?>'/>
				<p><b><?php echo $book->gettitle($bid); ?></b><br/><?php echo $book->getauthor($bid); ?><br/><br/><span class="desc">Description</span><br/><?php echo $book->getdesc($bid); ?></p>
				
				<div class="clr"></div>
			</div><!--End of Books Display-->
			<table>
				<tr>
					<td>User Review</td>
					<td><a href="userreviews.php?action=show&uid=<?php echo $book->getselleruid($bid);?>">View all reviews (<?php echo $review->gettotalnum($book->getselleruid($bid)); ?>)</a> | <a href="userreviews.php?action=write&uid=<?php echo $book->getselleruid($bid);?>">Review this item</a></td>
				</tr>
				<tr>
					<td>Years Released</td>
					<td>2006-2010</td>
				</tr>
				<tr>
					<td>Format</td>
					<td>Print (also available in <a href="#">audio book</a>)</td>
				</tr>
				<tr>
					<td>Publisher</td>
					<td>Penguin USA</td>
				</tr>
				<tr>
					<td>Category</td>
					<td><a href="books.php?category=<?php echo $book->getcategory($bid)?>"><?php echo $book->getcatname($book->getcategory($bid))?></a></td>
				</tr>
			</table>
		</div><!--End of centercol-->
		<div id="right-sidebar">
			<div id="user-info">
				<h4>Seller's Info</h4>
				<a href="profile.php?uid=<?php echo $book->getselleruid($bid); ?>"><?php echo $book->getseller($bid) ?></a> <a href="userreviews.php?action=show&uid=<?php echo $book->getselleruid($bid);?>">(<?php echo $review->getnetnum($book->getselleruid($bid)); ?>)</a>
				<p>99.7% Positive Feedback</p>
				<hr/>
				<a href="message.php?action=write&uid=<?php echo $book->getselleruid($bid)?>">Ask a Question</a><br/>
				<a href="#">Save this seller</a><br/>
				<a href="userbooks.php?uid=<?php echo $book->getselleruid($bid); ?>">See other items</a>
			</div><!--End of User-Info-->
			<div id="item-info">
				<h4>Other Item Info</h4>
				<table border='0'>

					<tr>
						<td>Item Number</td>
						<td>6746783209</td>
					</tr>
					<tr>
						<td rowspan='3'>Item Location</td>
						<td>Mumbai</td>
					</tr>
					<tr>
						
						<td>Maharastra</td>
					</tr>
					<tr>
						
						<td>India</td>
					</tr>
					<tr>
						<td>Ships To</td>
						<td>India</td>
					</tr>
				</table>
			</div><!--End of Item-Info-->
		</div><!--End of right sidebar-->
		<div class="clr"></div>
	</div><!--End of main-content--><?php
endif;
?>
<?php include 'footer.php'; ?>