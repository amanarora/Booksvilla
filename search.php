<?php require_once('session_start.php'); ?>
<?php
if(!isset($_SESSION['login_state'])):
	include 'home.php';	
else:
	include 'header.php';
?>
<?php
	$search=new search();
	$db=new database();
	if(isset($_GET['q']))
	{
		$q=$db->mysql_prep($_GET['q']);
	}
	else
	{
		$q="";
	}
	if(isset($_GET['searchby']))
	{
		$searchby=$db->mysql_prep($_GET['searchby']);
	}
	else
	{
		$searchby="";
	}
?>
<div id="main-content">
		<?php include'left-sidebar.php'; ?>
		<div id="centercol">
					<form action="search.php" method="get">
					<select name="searchby">
						<option value="title">Title</option>
						<option value="author">Author</option>
					</select>
					<input type="text" name="q" value="<?php if(isset($q)){echo $q;}?>"/>
					<input type="submit" value="Search"/>
				</form>
				<h2>You Searched For "<?php echo $q; ?>"</h2>
				<div class="books-display">
					<?php 
						switch($searchby)
						{
							case "title":
							if(isset($_GET['page']))
							{
								$pagenum=$db->mysql_prep($_GET['page']);
							}
							else
							{
								$pagenum=1;
							}
							$search->dosearchbytitle($q,$pagenum); 
							break;
							case "author":
							if(isset($_GET['page']))
							{
								$pagenum=$db->mysql_prep($_GET['page']);
							}
							else
							{
								$pagenum=1;
							}
							$search->dosearchbyauthor($q,$pagenum); 
							break;
							default:
							$search->dosearchbytitle($q); 
							break;
						}
					?>
					<div class="clr"></div>
				</div><!--End of Books Display-->
				<div class="clr"></div>
				
		</div><!--End of centercol-->
		<div class="clr"></div>
	</div><!--End of main-content-->
<?php
endif;
?>
<?php include 'footer.php'; ?>