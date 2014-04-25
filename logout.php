<?php
session_start();
unset($_SESSION['login_state']);
session_unset();
header('location:index.php');
?>