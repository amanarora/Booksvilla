<?php
$db= new database();
$db->connect();
class books{
	private $isbn;
	private $title;
	private $author;
	private $price;
	private $description;
	private $pages;
	private $pubdate;
	function getisbn($bid)
	{
		global $db;
		$query="SELECT isbn from books where bid=".$bid;
		$result=$db->query($query);
		$data=mysql_fetch_array($result,MYSQL_ASSOC);
		$isbn=$data['isbn'];
		return $isbn;
	}
	function getdesc($bid)
	{
		global $db;
		$query="SELECT description from books where bid=".$bid;
		$result=$db->query($query);
		$data=mysql_fetch_array($result,MYSQL_ASSOC);
		$desc=$data['description'];
		return $desc;
	}
	function gettitle($bid)
	{
		global $db;
		$query="SELECT title from books where bid=".$bid;
		$result=$db->query($query);
		$data=mysql_fetch_array($result,MYSQL_ASSOC);
		$title=$data['title'];
		return $title;
	}
	function getauthor($bid)
	{
		global $db;
		$query="SELECT author from books where bid=".$bid;
		$result=$db->query($query);
		$data=mysql_fetch_array($result,MYSQL_ASSOC);
		$author=$data['author'];
		return $author;
	}
	function getcategory($bid)
	{
		global $db;
		$query="SELECT category_id from books where bid=".$bid;
		$result=$db->query($query);
		$data=mysql_fetch_array($result,MYSQL_ASSOC);
		$cid=$data['category_id'];
		return $cid;
	}
	function getuserprice($bid)
	{
		global $db;
		$query="SELECT memprice from books where bid=".$bid;
		$result=$db->query($query);
		$data=mysql_fetch_array($result,MYSQL_ASSOC);
		$memprice=$data['memprice'];
		return $memprice;
	}
	function getalldetails($bid)
	{
		global $db;
		$query="SELECT isbn,title,author,description,bid,memprice from books WHERE bid=".$bid;
		$result=$db->query($query);
		$data=mysql_fetch_array($result,MYSQL_ASSOC);
		echo "<div class='book'>
					<a href='bookdetails.php?id=".$data['bid']."'><img src='".$this->image_url($data['bid'])."' height='120px' width='100px'/></a>
					<ul>
						<li><b>".substr($data['title'],0,35)."...</b></li>
						<li><b>Author : </b> ".substr($data['author'],0,10)."..</li>
						<li><b>Price : </b>Rs ".$data['memprice']."</li>
						<li><a href='checkout.php?bookid=".$data['bid']."' class='buy-now'>Buy Now</a></li>
					</ul>
				</div><!--End Of Book-->";
	}
	function listallcategories()
	{
		global $db;
		$query="SELECT id,name from categories";
		$result=$db->query($query);
		while($data=mysql_fetch_array($result,MYSQL_ASSOC))
		{
			echo "<li><a href='books.php?category=".$data['id']."'>".$data['name']."</a></li>";
		}
	}
	function categoryselectlist()
	{
		global $db;
		$query="SELECT id,name from categories";
		$result=$db->query($query);
		while($data=mysql_fetch_array($result,MYSQL_ASSOC))
		{
			echo "<option value='".$data['id']."'>".$data['name']."</option>";
		}
	}
	function showbooksbycat($cid,$pagenum=1)
	{
		global $db;
		$data = mysql_query("SELECT * FROM books  WHERE category_id=".$cid ." AND live = true") or die(mysql_error()); 
		$rows = mysql_num_rows($data); 
		$page_rows = 12;
		$last = ceil($rows/$page_rows); 
		if ($pagenum < 1) 
		{ 
			$pagenum = 1; 
		} 
		elseif ($pagenum > $last) 
		{ 
			$pagenum = $last; 
		} 
		$max = 'limit ' .($pagenum - 1) * $page_rows .',' .$page_rows;
		$query="SELECT isbn,title,author,description,bid,memprice from books WHERE live = true AND category_id=".$cid." ".$max;
		$result=$db->query($query);
		if($result)
		{
			$num_rows=mysql_num_rows($result);
			if($num_rows!=0)
			{
				while($data=mysql_fetch_array($result,MYSQL_ASSOC))
				{
					echo "<div class='book'>
						<a href='bookdetails.php?id=".$data['bid']."'><img src='".$this->image_url($data['bid'])."' height='120px' width='100px'/></a>
						<ul>
							<li><b>".substr($data['title'],0,35)."...</b></li>
							<li><b>Author : </b> ".substr($data['author'],0,10)."..</li>
							<li><b>Price : </b>Rs ".$data['memprice']."</li>
							<li><a href='checkout.php?bookid=".$data['bid']."' class='buy-now'>Buy Now</a></li>
						</ul>
					</div><!--End Of Book-->";
					
				}
				echo "<div class='pagination'>Page $pagenum of $last";
				if ($pagenum == 1) 
				{
				} 
				else 
				{
					echo " <a class='page-link' href='{$_SERVER['PHP_SELF']}?page=1&category=".$cid."'>«« First</a> ";
					echo " ";
					$previous = $pagenum-1;
					echo " <a class='page-link' href='{$_SERVER['PHP_SELF']}?page=$previous&category=".$cid."'>« Previous</a> ";
				} 
				//just a spacer
				//This does the same as above, only checking if we are on the last page, and then generating the Next and Last links
				if ($pagenum == $last) 
				{
				} 
				else
				{
					$next = $pagenum+1;
					echo " <a class='page-link' href='{$_SERVER['PHP_SELF']}?page=$next&category=".$cid."'>Next »</a> ";
					echo " ";
					echo " <a class='page-link' href='{$_SERVER['PHP_SELF']}?page=$last&category=".$cid."'>Last »»</a> ";
				} 
				echo "</div>";
	
			}
			else{
				echo "No books found in this category.";
			}
		}
		else{
				echo "No books found in this category.";
			}
	}
	function getcatname($cid)
	{
		global $db;
		$query="SELECT name from categories where id=".$cid;
		$result=$db->query($query);
		$data=mysql_fetch_array($result,MYSQL_ASSOC);
		$catname=$data['name'];
		return  $catname;
	}
	function getbooksbyuser($uid,$pagenum=0)
	{
		global $db;
		$data = mysql_query("SELECT isbn,title,author,description,bid,memprice from books WHERE live=true and uid=".$uid) or die(mysql_error()); 
		$rows = mysql_num_rows($data); 
		$page_rows = 12;
		$last = ceil($rows/$page_rows); 
		if ($pagenum < 1) 
		{ 
			$pagenum = 1; 
		} 
		elseif ($pagenum > $last) 
		{ 
			$pagenum = $last; 
		}
		$max = 'limit ' .($pagenum - 1) * $page_rows .',' .$page_rows;
		$query="SELECT isbn,title,author,description,bid,memprice from books WHERE live=true and uid=".$uid." ".$max;
		$result=$db->query($query);
		$num_rows=mysql_num_rows($result);
		if($num_rows!=0)
		{
			while($data=mysql_fetch_array($result,MYSQL_ASSOC))
			{
				echo "<div class='book'>
					<a href='bookdetails.php?id=".$data['bid']."'><img src='".$this->image_url($data['bid'])."' height='120px' width='100px'/></a>
					<ul>
						<li><b>".substr($data['title'],0,35)."...</b></li>
						<li><b>Author : </b> ".substr($data['author'],0,10)."..</li>
						<li><b>Price : </b>Rs ".$data['memprice']."</li>
						<li><a href='checkout.php?bookid=".$data['bid']."' class='buy-now'>Buy Now</a></li>
					</ul>
				</div><!--End Of Book-->";
			}
			echo "<div class='pagination'>Page $pagenum of $last";
			if ($pagenum == 1) 
			{
			} 
			else 
			{
				echo " <a class='page-link' href='{$_SERVER['PHP_SELF']}?page=1&uid=".$uid."'>«« First</a> ";
				echo " ";
				$previous = $pagenum-1;
				echo " <a class='page-link' href='{$_SERVER['PHP_SELF']}?page=$previous&uid=".$uid."'>« Previous</a> ";
			} 
			if ($pagenum == $last) 
			{
			} 
			else
			{
				$next = $pagenum+1;
				echo " <a class='page-link' href='{$_SERVER['PHP_SELF']}?page=$next&uid=".$uid."'>Next »</a> ";
				echo " ";
				echo " <a class='page-link' href='{$_SERVER['PHP_SELF']}?page=$last&uid=".$uid."'>Last »»</a> ";
			} 
			echo "</div>";
		}
		else{
			echo "No books found from this user.";
		}
	}
	function getselleruid($bid)
	{
		global $db;
		$query="SELECT uid from books WHERE bid=".$bid;
		$result=$db->query($query);
		$data=mysql_fetch_array($result,MYSQL_ASSOC);
		$uid=$data['uid'];
		return $uid;
	}
	function gettotalbyuser($uid)
	{
		global $db;
		$query="SELECT uid from books WHERE uid=".$uid;
		if($result=$db->query($query))
		{
			$num=mysql_num_rows($result);
		}
		else
		{
			$num=0;
		}
		return $num;
	}
	function getseller($bid)
	{
		$book=new books();
		$uid=$book->getselleruid($bid);
		$user=new user();
		$name=$user->name($uid);
		return $name;
	}
	function getrecentlyadded($pagenum,$limit)
	{
		global $db;
		if($pagenum)
		{
			$data = mysql_query("SELECT isbn from books where live=true") or die(mysql_error()); 
			$rows = mysql_num_rows($data); 
			$page_rows = 12;
			$last = ceil($rows/$page_rows); 
			if ($pagenum < 1) 
			{ 
				$pagenum = 1; 
			} 
			elseif ($pagenum > $last) 
			{ 
				$pagenum = $last; 
			}
		}
		if($limit)
		{
			$max = 'limit 0,'.$limit;
		}
		else
		{
			$max = 'limit ' .($pagenum - 1) * $page_rows .',' .$page_rows;
		}
		
		$query="SELECT isbn,title,author,description,bid,memprice from books WHERE live=true ORDER BY bid DESC ".$max;
		$result=$db->query($query);
		$num_rows=mysql_num_rows($result);
		if($num_rows!=0)
		{
			while($data=mysql_fetch_array($result,MYSQL_ASSOC))
			{
				echo "<div class='book'>
					<a href='bookdetails.php?id=".$data['bid']."'><img src='".$this->image_url($data['bid'])."' height='120px' width='100px'/></a>
					<ul>
						<li><b>".substr($data['title'],0,35)."...</b></li>
						<li><b>Author : </b> ".substr($data['author'],0,10)."..</li>
						<li><b>Price : </b>Rs ".$data['memprice']."</li>
						<li><a href='checkout.php?bookid=".$data['bid']."' class='buy-now'>Buy Now</a></li>
					</ul>
				</div><!--End Of Book-->";
			}
			if(!$limit)
			{
				echo "<div class='pagination'>Page $pagenum of $last";
				if ($pagenum == 1) 
				{
				} 
				else 
				{
					echo " <a class='page-link' href='{$_SERVER['PHP_SELF']}?page=1'>«« First</a> ";
					echo " ";
					$previous = $pagenum-1;
					echo " <a class='page-link' href='{$_SERVER['PHP_SELF']}?page=$previous'>« Previous</a> ";
				} 
				if ($pagenum == $last) 
				{
				} 
				else
				{
					$next = $pagenum+1;
					echo " <a class='page-link' href='{$_SERVER['PHP_SELF']}?page=$next'>Next »</a> ";
					echo " ";
					echo " <a class='page-link' href='{$_SERVER['PHP_SELF']}?page=$last'>Last »»</a> ";
				} 
				echo "</div>";
			}
		}
		else{
			echo "No books found from this user.";
		}
	}
	function fetchbook($isbn)
	{
		$this->isbn=$isbn;
		$feed = file_get_contents("http://www.google.com/books/feeds/volumes?q=".$isbn);
		$xml = new SimpleXmlElement($feed);
		foreach ($xml->entry as $entry)
		{
		  $namespaces = $entry->getNameSpaces(true);
		  $dc = $entry->children($namespaces['dc']); 
		  $this->pages=$dc->format;
		  $this->pubdate=$dc->pubdate;
		  $this->description=$dc->description;
		  $this->author=$dc->creator;
		  $this->title=$dc->title;
		}
		$xml = simplexml_load_file("http://isbndb.com/api/books.xml?access_key=3ZCNXBTL&results=prices&index1=isbn&value1=".$isbn);
		$prices = $xml->BookList[0]->BookData[0]->Prices[0]->Price;
		if($prices)
		{
			foreach ($prices as $price)
			{
				if($price['store_id']=='amazon')
				{
					$p=$price['price']+0;
					$p=$p*46;
					$this->price=$p;
				}
			}
		}
	}
	function image_url($bid)
	{
		global $db;
		$query="SELECT isbn,cover_uploaded from books WHERE bid=".$bid;
		$result=$db->query($query);
		if($result)
		{
			$data=mysql_fetch_array($result,MYSQL_ASSOC);
			if($data['cover_uploaded'])
			{
				$url="images/covers/".$data['isbn'].".jpg";
			}
			else{
				$url="http://content-3.powells.com/cgi-bin/imageDB.cgi?isbn=".$data['isbn'];
			}
			return $url;
		}
		else
		{
			echo mysql_error();
		}
		
	}
	function isbn()
	{
		return $this->isbn;
	}
	function title()
	{
		return $this->title;
	}
	function author()
	{
		return $this->author;
	}
	function description()
	{
		return $this->description;
	}
	function pages()
	{
		return $this->pages;
	}
	function price()
	{
		return $this->price;
	}
	function pubdate()
	{
		return $this->pubdate;
	}
}
?>