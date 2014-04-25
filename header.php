<?php require_once('session_start.php'); ?>
<?php
require_once('classes/database.class.php');
require_once('classes/users.class.php');
require_once('classes/books.class.php');
require_once('classes/reviews.class.php');
require_once('classes/search.class.php');
require_once('classes/message.class.php');
$user=new user();
if(!$user->login_state())
{
	header("Location: index.php");
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Books Villa</title>
<link type="text/css" rel="stylesheet" href="css/style.css"/>
<link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.js" type="text/javascript"></script>
<script src="js/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script src="js/jquery.searchbox.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="./js/jqplugins/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="./js/jqplugins/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="./js/jqplugins/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<script type="text/javascript">
	$(document).ready(function() {
		$("#various3").fancybox({
			'width'				: '75%',
			'height'			: '75%',
			'autoScale'			: false,
			'transitionIn'		: 'elastic',
			'transitionOut'		: 'none',
				
		});
				$("#various4").fancybox({
			'width'				: '75%',
			'height'			: '75%',
			'autoScale'			: false,
			'transitionIn'		: 'elastic',
			'transitionOut'		: 'none',
				
		});
	});
</script>


<script>
	jQuery(document).ready(function(){
    // binds form submission and fields to the validation engine
	jQuery(".form").validationEngine();
		});
            
</script>
</head>

<body>
<div id="wrap">
	<div id="topbar">
		<h2>Welcome <?php echo $user->name($_SESSION['uid'])?>,</h2>
		<ul>
			<li><a href="logout.php">Logout</a></li>
			<li><a href="account.php">Account</a></li>
		</ul>
	</div><!--End of Topbar-->
	<div id="main">
		<div id="header">
			<img src="images/logo.gif" />
		</div><!--End of Header-->
	</div><!--End of Main-->
		
	<div id="top-items">
		<div id="buttons">
			<a href="message.php"><img src="images/message.jpg" /></a>
			<a href="index.php"><img src="images/home.jpg" /></a>
		</div><!--End of buttons-->
		

	</div><!--End of top-items -->
	<div class="clr"></div><!--End of clr-->
	<div id="nav">
		<ul>
			<li><a href="index.php">Home</a></li>
			<li><a href="userbooks.php">Your Books</a></li>
			<li><a id="various4" href="#inline2" title="Sell Your Book">Sell Your Book</a></li>
			<li><a href="message.php">Inbox</a></li>
		</ul>
					<div id="search">
			<form name="search" method="get" action="search.php">
				<input type="text" name="q" value="" id="searchbox"/>
				<input id="searchbutton" type="submit" value="."/>
			</form>
			</div><!--End of Search-->
	</div><!--End of Nav-->
	<div style="display: none;">
		<div id="inline2" style="width:500px;height:120px;overflow:auto;">
		<?php if($user->is_active($_SESSION['uid'])):?>
			<form method='post' action="addbook.php?action=isbncheck"> 
			<table border='0' width='400'>
			<tbody>
				<tr>
					<td width='150'>I.S.B.N.*</td>
					<td width='240'><input name='isbn' size='20' type='textbox' /><input type=submit value='Get Details'></td>
				</tr>
				<tr>
					<td width='240'>Don't have an I.S.B.N Number</td>
					<td width='150'><a href="addbook.php?action=isbncheck">Click Here</a></td>
				</tr>
			</tbody>
			</table>
			</form>
		<?php else:?>
			<h3>Please active your account before adding your book</h3>
		<?php endif;?>

		</div>

	</div>
	
