<?php
include "classes/database.class.php";
$db=new database();
$db->connect();
/* RECEIVE VALUE */
$validateValue=$_GET['fieldValue'];
$validateId=$_GET['fieldId'];
$query="SELECT email from users where username='".$validateValue."'";
$result=$db->query($query);
if(mysql_num_rows($result)>0)
{
	$available=false;
}
else
{
	$available=true;
}

$validateError= "This username is already taken";
$validateSuccess= "This username is available";



	/* RETURN VALUE */
	$arrayToJs = array();
	$arrayToJs[0] = $validateId;

if($available){		// validate??
	$arrayToJs[1] = true;			// RETURN TRUE
	echo json_encode($arrayToJs);			// RETURN ARRAY WITH success
}else{
	for($x=0;$x<1000000;$x++){
		if($x == 990000){
			$arrayToJs[1] = false;
			echo json_encode($arrayToJs);		// RETURN ARRAY WITH ERROR
		}
	}
	
}

?>