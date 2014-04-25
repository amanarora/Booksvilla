<?php
$db=new database();
$db->connect();
$user=new user();
class message{
	private $subject;
	private $body;
	private $sender;
	private $reciever;
	private $sent_time;
	function sendmessage($sender,$reciever,$subject,$body)
	{
		global $db;
		$query="INSERT into messages VALUES ('','".$sender."','".$reciever."','".$subject."','".$body."',NOW()) ";
		$result=$db->query($query);
		if($result)
		{	
			echo "Message Sent";
		}
		else
		{
			echo "Not able to sent the message";
		}
	}
	function readmessage($messageID)
	{
		if($this->getreciever($messageID)==$_SESSION['uid'])
		{
			global $db;
			$query="SELECT * from messages WHERE id=".$messageID;
			$result=$db->query($query);
			if($result)
			{
				if(mysql_num_rows($result)>0)
				{
					$data=mysql_fetch_array($result,MYSQL_ASSOC);
					$this->subject=$data['subject'];
					$this->body=$data['body'];
					$this->sent_time=$data['sent_time'];
					$this->sender_id=$data['sender_id'];
					$this->reciever_id=$data['reciever_id'];
					return true;
				}
			}
			else
			{
				return false;
			}
		}
		else
		{
			echo "You don't have permissions to view this message";
			return false;
		}
		
	}
	function subjectlist($reciever_id)
	{
		global $db;
		$query="SELECT id,subject from messages WHERE reciever_id=".$reciever_id." ORDER BY id DESC";
		$result=$db->query($query);
		if($result)
		{
			if(mysql_num_rows($result)>0)
			{
				while($data=mysql_fetch_array($result,MYSQL_ASSOC))
				{
					echo "<li><a href='message.php?action=read&mid=".$data['id']."'>".$data['subject']."</a></li>";
				}
			}
			else
			{
				echo "No Messages";
			}
		}
		else
		{
			echo  "Eror Occured".mysql_error();
		}
	}
	function senderlist($reciever_id)
	{
		global $db;
		global $user;
		$query="SELECT sender_id from messages WHERE reciever_id=".$reciever_id." ORDER BY id DESC";
		$result=$db->query($query);
		if($result)
		{
			if(mysql_num_rows($result)>0)
			{
				while($data=mysql_fetch_array($result,MYSQL_ASSOC))
				{
					echo "<li>".$user->name($data['sender_id'])."</li>";
				}
			}
		}
	}
	function timelist($reciever_id)
	{
		global $db;
		$query="SELECT sent_time from messages WHERE reciever_id=".$reciever_id." ORDER BY id DESC";
		$result=$db->query($query);
		if($result)
		{
			if(mysql_num_rows($result)>0)
			{
				while($data=mysql_fetch_array($result,MYSQL_ASSOC))
				{
					echo "<li>".$data['sent_time']."</li>";
				}
			}
		}
	}
	function getreciever($messageID)
	{
		global $db;
		$query="SELECT reciever_id from messages WHERE id=".$messageID;
		$result=$db->query($query);
		if($result)
		{
			if(mysql_num_rows($result)>0)
			{
				$data=mysql_fetch_array($result,MYSQL_ASSOC);
				return $data['reciever_id'];
			}else{echo "No messages found";}
		}
		else{echo "Cannot Execute Query";}
	}
	function subject()
	{
		return $this->subject;
	}
	function body()
	{
		return $this->body;
	}
	function sent_time()
	{
		return $this->sent_time;
	}
	function sender_id()
	{
		return $this->sender_id;
	}
	function reciever_id()
	{
		return $this->reciever_id;
	}
}
?>