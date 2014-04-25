<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Books Villa</title>

<link type="text/css" rel="stylesheet" href="css/style.css"/>
<link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css"/>
<link rel="stylesheet" href="css/template.css" type="text/css"/>

<script src="js/jquery-1.6.min.js" type="text/javascript">
</script>
<script src="js/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8">
</script>
<script src="js/jquery.validationEngine.js" type="text/javascript" charset="utf-8">
</script>

<link rel="stylesheet" type="text/css" media="all" href="css/jqtransform.css" />

<script>
	jQuery(document).ready(function(){
    // binds form submission and fields to the validation engine
	jQuery("#form").validationEngine();
		});
            
            /**
             *
             * @param {jqObject} the field where the validation applies
             * @param {Array[String]} validation rules for this field
             * @param {int} rule index
             * @param {Map} form options
             * @return an error string if validation failed
             */
</script>
<script src="js/jquery.searchbox.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="./js/passwordmask.js"></script>
<script language="Javascript">

$(document).ready(function() {

	$('#pass-clear').show();
	$('#pass').hide();

	$('#pass-clear').focus(function() {
		$('#pass-clear').hide();
		$('#pass').show();
		$('#pass').focus();
	});
	$('#pass').blur(function() {
		if($('#pass').val() == '') {
			$('#pass-clear').show();
			$('#pass').hide();
		}
	});

	$('.default-value').each(function() {
		var default_value = this.value;
		$(this).focus(function() {
			if(this.value == default_value) {
				this.value = '';
			}
		});
		$(this).blur(function() {
			if(this.value == '') {
				this.value = default_value;
			}
		});
	});

});
$(document).ready(function() {

	$('#ccpass-clear').show();
	$('#cpass').hide();

	$('#ccpass-clear').focus(function() {
		$('#ccpass-clear').hide();
		$('#cpass').show();
		$('#cpass').focus();
	});
	$('#cpass').blur(function() {
		if($('#cpass').val() == '') {
			$('#ccpass-clear').show();
			$('#cpass').hide();
		}
	});

	$('.default-value').each(function() {
		var default_value = this.value;
		$(this).focus(function() {
			if(this.value == default_value) {
				this.value = '';
			}
		});
		$(this).blur(function() {
			if(this.value == '') {
				this.value = default_value;
			}
		});
	});

});
</script>

</head>

<body>
<div id="wrap">
	<div id="main">
		<div id="header">
			<img src="images/logo.gif" />
			<h2>Want To Sell A Book? Here Is What You Got To Do</h2>
		</div><!--End of Header-->
		
		<div id="circle">
			<img src="images/circle.gif" />
		</div><!--End of circle-->
	</div><!--End of Main-->
		
	<div id="top-items">
		
		
		
	</div><!--End of top-items -->
	<div class="clr"></div><!--End of clr-->
	<div id="login">
		<h2>Already A User</h2>
		<form action="login.php" method="post" class="jqtransform">
		<label>Username:</label><br/>
		<input type="text" name="username"/><br/>
		<label>Password:</label><br/>
		<input type="password" name="password"/><br/>
		<input type="submit" value="Login">
		</form>
	</div><!--End of Login-->
	<div class="clr"></div>
	<div id="register">
	
		<h2>New To Booksvilla?<br/>Join Today!</h2>
		<?php if(isset($_SESSION['msg'])){echo "<p>".$_SESSION['msg']."</p>";}?>
		<form method="post" action="register.php" id="form" >
				<table border=0>
			<tr>

			  <td height="65"><input class="validate[required,ajax[ajaxUserCallPhp]] text-input" type="text" name="username" id="url" /></td><br/></td>
			</tr>
			<tr>

				<td height="65"><input type="email" name="email" class="validate[required,custom[email]]" id="emailid"/><br/></td>
			</tr>
			<tr>

				<td height="65"><input style="display: inline;" id="pass-clear" value="Password" autocomplete="off" type="text">
    <input style="display: none;" id="pass" name="password" value="" autocomplete="off" type="password" class="validate[required,minSize[6]]"><br/></td>
			</tr>
			<tr>

				<td height="65">    <input style="display: inline;" id="ccpass-clear" value="Confirm Password" autocomplete="off" type="text">
    <input style="display: none;" id="cpass" name="password" value="" autocomplete="off" type="password" class="validate[required,minSize[6]]"><br/></td>
			</tr>
			<tr>

				<td height="65"><input type="submit" value="Sign Up" class="signup-button" id="submit" /></td>
			</tr>
		</form>
	  </table>
	</div><!--end of Register-->
	
	<div class="clr"></div>