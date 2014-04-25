<link type="text/css" href="css/smoothness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />	
<script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript">
	$(function(){

		// Tabs
		$('#tabs').tabs();
		
		//hover states on the static widgets
		
	
	});
</script>
<?php
$user=new user();
$user->getdetails();
?>
<div id="tabs">
			<ul>
				<li><a href="#tabs-1">Personal Information</a></li>
				<li><a href="#tabs-2">Change Password</a></li>
				<li><a href="#tabs-3">Address</a></li>
			</ul>
			<div id="tabs-1">
				<form class="form" action="updateinfo.php?action=personal" method="post">
				<table>
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
						<td><input type="text" name="mob_num" id="mob_num" value="<?php if($user->lname()){echo $user->mob_num();}?>"/></td>
					</tr>
					<tr>
						<td>Gender</td>
						<td><select name="gender" class="validate[required]" id="gender"><option value="male">Male</option><option value="female">Female</option></select></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" value="Save Changes"/></td>
					</tr>
				</table>
				</form>
			</div>
			<div id="tabs-2">
				<form>
				<table>
					<tr height="50px">
						<td>Email Address</td>
						<td><?php echo $user->email();?></td>
					</tr>
					<tr>
						<td>Old Password</td>
						<td><input type="text" name="oldpass"/></td>
					</tr>
					<tr>
						<td>New Password</td>
						<td><input type="text" name="newpass"/></td>
					</tr>
					<tr>
						<td>Confirm New Password</td>
						<td><input type="text" name="confirmnewpass"/></td>
					</tr>
				</table>
				</form>
			</div>
			<div id="tabs-3">
				<form class="form" action="updateinfo.php?action=shipping" method="post">
				<table>
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
				</table>
				</form>
			</div>
