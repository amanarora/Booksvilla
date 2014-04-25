<?php
include 'db_config.php';
	class database{
		function mysql_prep($input)
		{
			$input=htmlentities($input);
			$input=mysql_real_escape_string($input);
			return $input;
		}
		function connect()
		{
			global $link;
			$link = mysql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD) or die(mysql_error());
			if (!$link) 
			{
				die('Could not connect: ' . mysql_error());
			}
			$db=mysql_select_db(DB_NAME,$link)  or die(mysql_error());
			if(!$db)
			{
				die('Could not select database: '.mysql_error());
			}
			return $db;
		}
		function query($query)
		{
			global $link;
			$result=mysql_query($query,$link);
			if($result)
			{
				return $result;
			}
			else
			{
				return false;
			}
		}
	}
	
		
?>