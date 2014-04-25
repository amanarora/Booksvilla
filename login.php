<?php require_once('session_start.php'); ?>
<?php
include 'classes/database.class.php';
$db=new database();
$db->connect();
$username=$db->mysql_prep($_POST['username']);
$password=$db->mysql_prep($_POST['password']);
$hashed_password=sha1($password);
$query="SELECT id from users where username='".$username."' and hashed_password='".$hashed_password."'";
$r=$db->query($query);
$data=mysql_fetch_array($r,MYSQL_ASSOC);
if($data)
{
	$_SESSION['login_state']=true;
	$_SESSION['uid']=$data['id'];
}
header('location:index.php');
?>