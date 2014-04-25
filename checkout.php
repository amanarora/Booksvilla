<script type="text/javascript">
$.document.ready(function(){
	$("#shipping").click(function(){
		var bill_name=$("#bill_name").val();
		if (this.checked==true)
    	$("#ship_name").val(bill_name);

	});
});
</script>
<?php require_once('session_start.php'); ?>
<?php 
include'header.php'; 
$db=new database();
$book=new books();
$user=new user();
$user->getdetails();
?>
<div id="main-content">
			<div id="checkout">
				<h2>Checkout</h2>
				<p>Fill in the details below to complete your purchase! Enter your pincode to see cash on delivery option.</p>
				<p>Already Registered?<a href="#">Click here to login</a></p><hr/>
				<div id="step1">
					<h2>BILLING ADDRESS</h2>
					<form name="billing" mathod="post" action="https://secure.ebs.in/pg/ma/sale/pay/">
						<table width="250">
							<tr>
								<td colspan="2">Name : <input id="bill_name" type="text" name="name" value="<?php if($user->ship_name()){echo $user->ship_name();}?>"></td>
							</tr>
							<tr>
								<td>Email Address : <input type="email" name="email" value="<?php if($user->email()){echo $user->email();}?>"></td>
								<td>Telephone : <input type="text" name="phone" value="<?php if($user->mob_num()){echo $user->mob_num();}?>"></td>
							</tr>
							<tr>
								<td colspan=2>
									Address : <br/><textarea name="address"><?php if($user->ship_address()){echo $user->ship_address();}?></textarea>
								</td>
							</tr>
							<tr>
								<td colspan=2>
									City : <input name="city" type="text" size="42" value="<?php if($user->ship_city()){echo $user->ship_city();}?>"/>
								</td>
							</tr>
							<tr>
								<td colspan=2>
									Country : <select name="country">
												  
												  
												  <option value="IND">India</option>
												  
												</select>    

								</td>
							</tr>
							<tr>
								<td>Zip/Pin Code: <input type="text" name="postal_code" value="<?php if($user->ship_pincode()){echo $user->ship_pincode();}?>"></td>
								<td>State : <input type="text" name="state" value="<?php if($user->ship_state()){echo $user->ship_state();}?>"></td>
							</tr>

						</table>

					<center>Ship to same address</center>
				</div><!--End of step 1-->
				<div id="step2">
					<h2>SHIPPING ADDRESS</h2>
						<input type="checkbox" id="shipping"/>
						<table width="250">
							<tr>
								<td colspan="2">Name : <input id="ship_name" type="text" name="ship_name" value="<?php if($user->ship_name()){echo $user->ship_name();}?>"></td>
								
							</tr>
							<tr>
								<td>Email Address : <input type="email" name="ship_email" value="<?php if($user->email()){echo $user->email();}?>"></td>
								<td>Telephone : <input type="text" name="ship_phone" value="<?php if($user->ship_phn_number()){echo $user->ship_phn_number();}?>"></td>
							</tr>
							<tr>
								<td colspan=2>
									Address : <br/><textarea name="ship_address"><?php if($user->ship_address()){echo $user->ship_address();}?></textarea>
								</td>
							</tr>
							<tr>
								<td colspan=2>
									City : <input name="ship_city" type="text" size="42" value="<?php if($user->ship_city()){echo $user->ship_city();}?>"/>
								</td>
							</tr>
							<tr>
								<td colspan=2>
									Country : <select name="ship_country">
												  
												  
												  <option value="IND">India</option>
												  
												</select>    
								</td>
							</tr>
							<tr>
								<td>Zip/Pin Code: <input type="text" name="ship_postal_code" value="<?php if($user->ship_pincode()){echo $user->ship_pincode();}?>"></td>
								<td>State : <input type="text" name="ship_state" value="<?php if($user->ship_state()){echo $user->ship_state();}?>"></td>
							</tr>

						</table>
					
				</div><!--End of step 2-->
				<div id="step3">
					<h2>PAYMENT INFO</h2>
					<?php 
						if(isset($_GET['bookid'])):
$num=$_GET['bookid'];
$num=($num*12)+2709;
						$book_id=$db->mysql_prep($_GET['bookid']);
					?>
					<b>Book Title : </b> <?php echo $book->gettitle($book_id);?><br/>
					<b>Price : </b> Rs. <?php echo $book->getuserprice($book_id);?><br/>
					<b>Quantity : </b> 1<br/>
					<b>Order Number : </b> <?php echo $num;?><br/><br/>
					<input type="hidden" name="account_id" value="5645"/>
					<input type="hidden" name="reference_no" value="<?php echo $num;?>"/>
					<input type="hidden" name="amount" value="<?php echo $book->getuserprice($book_id);?>"/>
					<input type="hidden" name="mode" value="TEST"/>
					<input type="hidden" name="description" value="Payement for book. Title : <?php echo $book->gettitle($book_id);?>"/>
					<input type="hidden" name="return_url" value="http://booksvilla.com/booksvilla/response.php?DR={DR}"/>
					<input type="submit" value="Checkout"/>
					</form>
					<?php
					else:
					?>
					No book selected
					<?php
					endif;
					?>
					<p></p>
				</div><!--End of step 3-->
				<div class="clr"></div>
			</div>	<!--End of checkout-->

</div><!--End of main-content-->
<div class="clr"></div>
<?php include'footer.php'; ?>