<?php
$db= new database();
$db->connect();
class user{
	private $email;
	private $fname;
	private $lname;
	private $mob_num;
	private $ship_name;
	private $ship_address;
	private $ship_city;
	private $ship_state;
	private $ship_pincode;
	private $ship_phn_number;
	function id()
	{
		return $id=$_SESSION['uid'];
	}

	function name($uid)
	{
		global $db;
		$query="SELECT fname,lname from users where id=".$uid;
		$result=$db->query($query);
		$data=mysql_fetch_array($result,MYSQL_ASSOC);
		$name=$data['fname']." ".$data['lname'];
		return $name;
	}
	function getphnnumber($uid)
	{
		global $db;
		$query="SELECT mob_number from users where id=".$uid;
		$result=$db->query($query);
		$data=mysql_fetch_array($result,MYSQL_ASSOC);
		$number=$data['mob_number'];
		return $number;
	}
	
	function username($uid)
	{
		global $db;
		$query="SELECT username from users where id=".$uid;
		$result=$db->query($query);
		$data=mysql_fetch_array($result,MYSQL_ASSOC);
		$username=$data['username'];
		return $username;
	}
	function regdate($uid)
	{
		global $db;
		$query="SELECT registration_date from users where id=".$uid;
		$result=$db->query($query);
		$data=mysql_fetch_array($result,MYSQL_ASSOC);
		$reg_date=$data['registration_date'];
		return $reg_date;
	}
	function activate($activation_key)
	{
		global $db;
		$query = "SELECT id,username,activation_key FROM users";
		$result = $db->query($query) or die(mysql_error());
		while($row = mysql_fetch_array($result))
		{
			if ($activation_key == $row["activation_key"])
			{
				echo "Congratulations! " . $row["username"] . " .Your account has been activated";
				unset($_SESSION['msg']);
				$sql="UPDATE users SET activation_key = '', status='activated' WHERE (id = $row[id])";
				if (!mysql_query($sql))
				{
					die('Error: ' . mysql_error());
				}
				return true;
			}
			else
			{
				$flag=false;
			}
		}
		return $flag;
	}
	function is_active($uid)
	{
		global $db;
		$query="SELECT status from users where id=".$uid;
		$result=$db->query($query);
		$data=mysql_fetch_array($result,MYSQL_ASSOC);
		if($data['status']=="verify")
		{
			return false;
		}
		else if($data['status']=="activated")
		{
			return true;
		}
	}
	function login_state()
	{
		if(isset($_SESSION['uid']))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function sendwelcomesms($phn_number)
	{
		require_once('Snoopy.class.php');
		$snoopy=new Snoopy();
		$snoopy->httpmethod = "GET";
		$submit_vars["username"] = "booksvilla";
		$submit_vars["password"] = "963471122";
		$submit_vars["sendername"] = "BksVilla";
		$submit_vars["mobileno"] = $phn_number;
		$submit_vars["message"] = "Welcome to Booksvilla. Thanks for registering.";
		$url="http://bulksms.mysmsmantra.com:8080/WebSMS/SMSAPI.jsp";
		$snoopy->submit($url,$submit_vars);
	}
	function sendsms($phn_number,$message)
	{
		require_once('Snoopy.class.php');
		$snoopy=new Snoopy();
		$snoopy->httpmethod = "GET";
		$submit_vars["username"] = "booksvilla";
		$submit_vars["password"] = "963471122";
		$submit_vars["sendername"] = "BksVilla";
		$submit_vars["mobileno"] = $phn_number;
		$submit_vars["message"] = $message;
		$url="http://bulksms.mysmsmantra.com:8080/WebSMS/SMSAPI.jsp";
		$snoopy->submit($url,$submit_vars);
	}
	function checkprofile($uid)
	{
		global $db;
		$query="SELECT fname,lname,mob_number,ship_name,ship_city,ship_address,ship_state,ship_pincode,ship_phn_number from users WHERE id=".$uid;
		$result=$db->query($query);
		if($result)
		{
			$data=mysql_fetch_array($result,MYSQL_ASSOC);
			if(strlen($data['fname'])>1 and strlen($data['lname'])>1 and strlen($data['mob_number'])==10 and strlen($data['ship_name'])>1 and strlen($data['ship_city'])>1 and strlen($data['ship_state'])>1 and strlen($data['ship_address'])>1 and strlen($data['ship_pincode'])>1 and strlen($data['ship_phn_number'])>1)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			echo mysql_error();
		}
	}
	function getdetails()
	{
		global $db;
		$id=$_SESSION['uid'];
		$query="SELECT fname,lname,mob_number,email,ship_name,ship_address,ship_city,ship_state,ship_pincode,ship_phn_number from users where id=".$id;
		$result=$db->query($query);
		if($result)
		{
			$data=mysql_fetch_array($result,MYSQL_ASSOC);
			$this->email=$data['email'];
			$this->fname=$data['fname'];
			$this->lname=$data['lname'];
			$this->mob_num=$data['mob_number'];
			$this->ship_name=$data['ship_name'];
			$this->ship_address=$data['ship_address'];
			$this->ship_city=$data['ship_city'];
			$this->ship_state=$data['ship_state'];
			$this->ship_pincode=$data['ship_pincode'];
			$this->ship_phn_number=$data['ship_phn_number'];
		}
		else
		{
			echo mysql_error();
		}
		
	}
	function verify_mob($phn_number,$uid)
	{
		global $db;
		$code=rand(10000,99999);
		$query="UPDATE users SET mob_verification_code=".$code.",mob_active=0 WHERE id=".$uid;
		$result=$db->query($query);
		if($result)
		{
			$message="Your mobile verification code is ".$code;
			$this->sendsms($phn_number,$message);
		}
		else
		{
			echo mysql_error();
		}
	}
	function verifymobile($uid,$code)
	{
		global $db;
		$query="SELECT mob_verification_code FROM users WHERE id=".$uid;
		$result=$db->query($query);
		if($result)
		{
			$data=mysql_fetch_array($result,MYSQL_ASSOC);
			$ver_code=$data['mob_verification_code'];
			if($ver_code==$code)
			{
				$query="UPDATE users SET mob_active=true WHERE id=".$uid;
				$result=$db->query($query);
				if($result)
				{
					return true;
				}
				else
				{
					return false;
				}
			}
			else
			{
				return false;
			}
		}
		else
		{
			echo mysql_error();
		}
	}
	function email()
	{
		return $this->email;
	}
	function fname()
	{
		return $this->fname;
	}
	function lname()
	{
		return $this->lname;
	}
	function mob_num()
	{
		return $this->mob_num;
	}
	function ship_name()
	{
		return $this->ship_name;
	}
	function ship_city()
	{
		return $this->ship_city;
	}
	function ship_state()
	{
		return $this->ship_state;
	}
	function ship_address()
	{
		return $this->ship_address;
	}	
	function ship_pincode()
	{
		return $this->ship_pincode;
	}
	function ship_phn_number()
	{
		return $this->ship_phn_number;
	}
}
?>