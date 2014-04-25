<?php
$db= new database();
$db->connect();
class review
{
	function addreview($uid)
	{
		if($uid==$_SESSION['uid'])
		{
			echo "You cannot add an review for yourself";
		}
		else
		{
			global $db;
			$query="INSERT into reviews values ('','".$_SESSION['uid']."','".$uid."','".$_POST['review']."','".$_POST['type']."')";
			$result=$db->query($query);
			if($result)
			{
				echo "Your review has been added successfully";
			}
			else
			{
				echo "Error adding your review. Please try again later.".mysql_error();
			}
		}
	}
	function gettotalnum($uid)
	{
		global $db;
		$query="SELECT type from reviews where review_for=".$uid;
		$result=$db->query($query);
		$num_rows=mysql_num_rows($result);
		return $num_rows;
	}
	function getnumofpos($uid)
	{
		global $db;
		$query="SELECT type from reviews where type='positive' and review_for=".$uid;
		$result=$db->query($query);
		$num_rows=mysql_num_rows($result);
		return $num_rows;
	}
	function getnumofneg($uid)
	{
		global $db;
		$query="SELECT type from reviews where type='negative' and review_for=".$uid;
		$result=$db->query($query);
		$num_rows=mysql_num_rows($result);
		return $num_rows;
	}
	function getnumofneutral($uid)
	{
		global $db;
		$query="SELECT type from reviews where type='neutral' and review_for=".$uid;
		$result=$db->query($query);
		$num_rows=mysql_num_rows($result);
		return $num_rows;
	}
	function getallreviews($uid)
	{
		global $db;
		$query="SELECT review,type from reviews where review_for=".$uid;
		$result=$db->query($query);
		$num_rows=mysql_num_rows($result);
		if($num_rows!=0)
		{
			while($data=mysql_fetch_array($result,MYSQL_ASSOC))
			{
				if($data['type']=="positive")
				{
					$class="green";
					$type="Positive (+1)";
				}
				else if($data['type']=="negative")
				{
					$class="red";
					$type="Negative (-1)";
				}
				else
				{
					$class="grey";
					$type="Neutral (0)";
				}
				echo "<li class='".$class."'>".$type." : ".$data['review']."</li>";
			}
		}
		else{
			echo "No reviews for this user yet.";
		}
	}
	function getnetnum($uid)
	{
		global $db;
		$net_review=0;
		$query="SELECT type from reviews where review_for=".$uid;
		$result=$db->query($query);
		while($data=mysql_fetch_array($result,MYSQL_ASSOC))
		{
			if($data['type']=="positive")
			{
				$net_review=$net_review+1;
			}
			else if($data['type']=="negative")
			{
				$net_review=$net_review-1;
			}
		}
		return $net_review;
	}
}
?>