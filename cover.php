<?php
include 'classes/Snoopy.class.php';
$snoopy=new Snoopy();
$snoopy->fetch('http://covers.openlibrary.org/b/isbn/0552770043-S.jpg?default=false');

if(strstr($snoopy->response_code,"404"))
{
	echo "Not found";
}
else
{
	echo "Found";
}
		

?>