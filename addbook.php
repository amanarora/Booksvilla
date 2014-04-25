<?php require_once('session_start.php'); ?>
<?php 
include'header.php'; 
require_once('classes/database.class.php');
require_once('classes/users.class.php');
?>
<div id="main-content">
<?php include'left-sidebar.php'; ?>
<?php
$db =new database();
$user=new user();
$book=new books();
$user->getdetails();
if(!isset($_GET['action']))
{
	$_GET['action']='';
}
if($user->is_active($_SESSION['uid'])):
switch($_GET['action'])
{
	case 'add':
		if($user->checkprofile($_SESSION['uid']))
		{
			$live=true;
		}
		else{
			$live=false;
		}
		$db->connect();
		$isbn=mysql_real_escape_string($_POST['isbn']);
		$title=mysql_real_escape_string($_POST['btitle']);
		$author=mysql_real_escape_string($_POST['bauthor']);
		$price=mysql_real_escape_string($_POST['bprice']);
		$desc=mysql_real_escape_string($_POST['bdesc']);
		$condition=mysql_real_escape_string($_POST['bcondition']);
		$category=mysql_real_escape_string($_POST['category']);
		$pubdate=mysql_real_escape_string($_POST['pbdate']);
		$memprice=mysql_real_escape_string($_POST['memprice']);
		if(strlen($isbn)<10)
		{
			while(strlen($isbn)!=10)
			{
				$isbn="0".$isbn;
			}
		}
		$cover_uploaded=false;
		if(strlen($_FILES["cover"]["tmp_name"])>0)
		{
			
			if ((($_FILES["cover"]["type"] == "image/gif")
			|| ($_FILES["cover"]["type"] == "image/jpeg")
			|| ($_FILES["cover"]["type"] == "image/pjpeg"))
			&& ($_FILES["cover"]["size"] < 300000))
			  {
			  if ($_FILES["cover"]["error"] > 0)
				{
				echo "Return Code: " . $_FILES["cover"]["error"] . "<br />";
				}
			  else
				{
				 if (!file_exists("images/covers/" . $isbn .".jpg"))
				  {
				  move_uploaded_file($_FILES["cover"]["tmp_name"],
				  "images/covers/" . $isbn .".jpg" );
				  $cover_uploaded=true;
				  }
				}
			  }
			else
			  {
			  echo "Invalid file<br/>";
			  }
		}
		$query="INSERT into books VALUES('','$isbn','".$_SESSION['uid']."','".$user->email()."','$title','$author','','$price','$desc','','$pubdate','$memprice','','$condition','','$category','available','0','$cover_uploaded','$live')";
		$result=$db->query($query);
		if($result)
		{
			echo "You book has been added to the database";
			if(!$live):?>
				<br/>Your books isn't live yet. Please update your account information to make it live.
				<br/><a id="various3" href="#inline1" title="Update Account Information">Click Here</a> To Update It Now.	
			<div style="display: none;">
				<div style="display: none;">	
				<div id="inline1" style="width:500px;height:600px;overflow:auto;">
				<form method='post' action="updateinfo.php" class="form"> 
				<table border='0' width='400'>
				<tbody>
						<tr>
							<td><h3>Personal </h3></td>
							<td><h3>Information</h3></td>
						</tr>
						<tr height="50px">
							<td>First Name</td>
							<td><input type="text" name="fname" class="validate[required]" id="fname" value="<?php if($user->lname()){echo $user->fname();}?>"/></td>
						</tr>
						<tr>
							<td>Last Name</td>
							<td><input type="text" name="lname" class="validate[required]" id="lname" value="<?php if($user->lname()){echo $user->lname();}?>"/></td>
						</tr>
						<tr>
							<td>Mobile Number</td>
							<td><input type="text" name="mob_num" id="mob_num" class="validate[required]" value="<?php if($user->lname()){echo $user->mob_num();}?>"/></td>
						</tr>
						<tr>
							<td>Gender</td>
							<td><select name="gender" class="validate[required]" id="gender"><option value="male">Male</option><option value="female">Female</option></select></td>
						</tr>
						<tr>
							<td><h3>Shipping </h3></td>
							<td><h3>Information</h3></td>
						</tr>
						<tr height="50px">
							<td>Name</td>
							<td><input type="text" name="name" class="validate[required]" id="name" value="<?php if($user->ship_name()){echo $user->ship_name();}?>"/></td>
						</tr>
						<tr>
							<td>Street Address</td>
							<td><textarea name="address" class="validate[required]" id="address"><?php if($user->ship_address()){echo $user->ship_address();}?></textarea></td>
						</tr>
						<tr>
							<td>City</td>
							<td><input type="text" name="city" class="validate[required]" id="city" value="<?php if($user->ship_city()){echo $user->ship_city();}?>"/></td>
						</tr>
						<tr>
							<td>State</td>
							<td><input type="text" name="state" class="validate[required]" id="state" value="<?php if($user->ship_state()){echo $user->ship_state();}?>"/></td>
						</tr>
						<tr>
							<td>Country</td>
							<td>India<i>(We only ship to India)</i></td>
						</tr>
						<tr>
							<td>Pincode</td>
							<td><input type="text" name="pincode" class="validate[required]" id="pincode" value="<?php if($user->ship_pincode()){echo $user->ship_pincode();}?>"/></td>
						</tr>
						<tr>
							<td>Phone Number</td>
							<td><input type="text" name="ship_num" class="validate[required]" id="phn_num" value="<?php if($user->ship_phn_number()){echo $user->ship_phn_number();}?>"/></td>
						</tr>
						<tr>
							<td></td>
							<td><input type="submit" value="Save Changes"/></td>
						</tr>
				</tbody>
				</table>
				</form>
			</div>
		</div>
			<?php endif;
		}
		else
		{echo "Could not add your book to our database";}
	break;
	case 'isbncheck':
	if(isset($_POST['isbn'])):
		$isbn=$_POST['isbn'];
		$book->fetchbook($isbn);
?>
<img src='http://content-3.powells.com/cgi-bin/imageDB.cgi?isbn=<?php echo $isbn;?>' height='120px' width='100px'/>
<?php 	endif; ?>
<form method='post' class="form" action="addbook.php?action=add" enctype="multipart/form-data"> 
<label for="cover">Book Image</label>
	<table border='0' width='600'>
		<tbody>
		<?php if(isset($_POST['isbn'])): ?>
			<tr>
				<td>I.S.B.N.*</td>
				<td><input name='isbn' size='40' type='text' class="validate[required]" id="isbn" value='<?php echo $isbn;?>' /></td>
			</tr>
		<?php endif;?>
			<tr>
				<td>Book's Title*</td>
				<td><input id='btitle' name='btitle' size='40' type='text' class="validate[required]" value='<?php $title=$book->title(); if(isset($title)){echo $book->title();}?>' /></td>
			</tr>
			<tr>
				<td>Book's Author*</td>
				<td><input id='bauthor' name='bauthor' size='40' type='text' class="validate[required]" id="bauthor" value='<?php $author=$book->author(); if(isset($author)){echo $book->author();}?>' /></td>
			</tr>
			<tr>
				<td>Book's Publication Date</td>
				<td><input id='pbdate' name='pbdate' size='40' type='text' class="validate[required]" id="pubdate" value='<?php $dt=$book->pubdate(); if(isset($dt)){echo $book->pubdate();} ?>'/></td>
			</tr>
			<tr>
				<td>Book's Price</td>
				<td>
					<?php
						if($book->price())
						{
							echo $book->price();
							echo "<input id='bprice' name='bprice' size='40' type='text' class='validate[required]' id='bprice' value='".$book->price()."' hidden/>";
						}
						else{
							echo "<input id='bprice' name='bprice' size='40' type='text' class='validate[required]' id='price' />";
						}
					?>
				</td>
			</tr>
			<tr>
				<td>Book's Image</td>
				<td><input type="file" name="cover" id="cover" /></td>
			</tr>
			<tr>
				<td>Book's Description</td>
				<td><textarea name="bdesc" cols="32" rows="5" class="validate[required]" id="bdesc" ><?php $desc=$book->description(); if(isset($desc)){echo $book->description();} ?></textarea></td>
			</tr>
			<tr>
				<td>Condition*</td>
				<td><select id='bcondition' name='bcondition' class="validate[required]" >
					<option value="Bad">Bad</option>
					<option value="Fine">Fine</option>
					<option value="Good">Good</option>
					<option value="Excellent">Excellent</option>
				</select></td>
			</tr>
			<tr>
				<td>Category</td>
				<td>
					<select name="category" class="validate[required]" id="category">
						<?php $book->categoryselectlist() ?>
					</select>
				</td>
			</tr>
				<tr>
				<td>Your Price</td>
				<td><input id='memprice' name='memprice' size='40' type='text' class="validate[required]" id="memprice" /><br/>In Hand You Will Get Rs. <span id="inhand-price"></span><br/> (10% Deducted)</td>
				<script>
				$(document).ready(function(){
			 
					//iterate through each textboxes and add keyup
					//handler to trigger sum event
					$("#memprice").each(function() {
			 
						$(this).keyup(function(){
							calculateSum();
						});
					});
			 
				});
			 
				function calculateSum() {
			 
					var sum = 0;
					//iterate through each textboxes and add the values
					$("#memprice").each(function() {
			 
						//add only if the value is number
						if(!isNaN(this.value) && this.value.length!=0) {
							sum = parseFloat(this.value)-(parseFloat(this.value)*0.10);
						}
			 
					});
					//.toFixed() method will roundoff the final sum to 2 decimal places
					$("#inhand-price").html(sum.toFixed(2));
				}
			</script>
			</tr>
			<tr>
				<td><input type='submit' value='Add' /></td>
				<td></td>
			</tr>

		</tbody>
	</table>
</form>
<?php
	break;
	default:
?>

<form method='post' action=addbook.php?action=isbncheck> 
	<table border='0' width='400'>
		<tbody>
			<tr>
				<td width='150'>I.S.B.N.*</td>
				<td width='240'><input name='isbn' size='20' type='text' /><input type=submit value='Get Details'></td>
			</tr>
		</tbody>
	</table>
</form>

<?php
break;
}
else:
?>
You haven't yet activated your account. You must activate your account before using this feature. Check your email for an activation link from booksvilla.com
<?php
endif;
?>
</div><!--End of main-content-->
<div class="clr"></div>
<?php include'footer.php'; ?>