<?php
$db= new database();
$db->connect();
$book=new books();
class search 
{
	function checkinput($q)
	{
		if(strlen($q)<3)
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	function dosearchbytitle($q,$pagenum=1)
	{
		if($this->checkinput($q))
		{
			global $book;
			global $db;
			$data = mysql_query("SELECT bid from books WHERE title like '%".$q."%'") or die(mysql_error()); 
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
			$q=$db->mysql_prep($q);
			$query="SELECT bid from books WHERE title like '%".$q."%' ".$max;
			if($result=$db->query($query))
			{
				$num_rows=mysql_num_rows($result);
				if($num_rows!=0)
				{
					while($data=mysql_fetch_array($result,MYSQL_ASSOC))
					{
						$book->getalldetails($data['bid']);
					}
					echo "<div class='pagination'>Page $pagenum of $last";
					if ($pagenum == 1) 
					{
					} 
					else 
					{
						echo " <a class='page-link' href='{$_SERVER['PHP_SELF']}?searchby=title&q=".$q."&page=1'>«« First</a> ";
						echo " ";
						$previous = $pagenum-1;
						echo " <a class='page-link' href='{$_SERVER['PHP_SELF']}?searchby=title&q=".$q."&page=$previous'>« Previous</a> ";
					} 
					if ($pagenum == $last) 
					{
					} 
					else
					{
						$next = $pagenum+1;
						echo " <a class='page-link' href='{$_SERVER['PHP_SELF']}?searchby=title&q=".$q."&page=$next'>Next »</a> ";
						echo " ";
						echo " <a class='page-link' href='{$_SERVER['PHP_SELF']}?searchby=title&q=".$q."&page=$last'>Last »»</a> ";
					} 
					echo "</div>";
				}
				else
				{
					echo "No books found matching your query";
				}
			}
			else{
				echo "Cannot execute Query";
			}
		}
		else
		{
			echo "search term too short";
		}
	}
	function dosearchbyauthor($q,$pagenum=1)
	{
		if($this->checkinput($q))
		{
			global $book;
			global $db;
			$data = mysql_query("SELECT bid from books WHERE author like '%".$q."%'") or die(mysql_error()); 
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
			$q=$db->mysql_prep($q);
			$query="SELECT bid from books WHERE author like '%".$q."%' ".$max;
			if($result=$db->query($query))
			{
				$num_rows=mysql_num_rows($result);
				if($num_rows!=0)
				{
					while($data=mysql_fetch_array($result,MYSQL_ASSOC))
					{
						$book->getalldetails($data['bid']);
					}
					if ($pagenum == 1) 
					{
					} 
					else 
					{
						echo " <a class='page-link' href='{$_SERVER['PHP_SELF']}?searchby=author&q=".$q."&page=1'>«« First</a> ";
						echo " ";
						$previous = $pagenum-1;
						echo " <a class='page-link' href='{$_SERVER['PHP_SELF']}?searchby=author&q=".$q."&page=$previous'>« Previous</a> ";
					} 
					if ($pagenum == $last) 
					{
					} 
					else
					{
						$next = $pagenum+1;
						echo " <a class='page-link' href='{$_SERVER['PHP_SELF']}?searchby=author&q=".$q."&page=$next'>Next »</a> ";
						echo " ";
						echo " <a class='page-link' href='{$_SERVER['PHP_SELF']}?searchby=author&q=".$q."&page=$last'>Last »»</a> ";
					} 
					echo "</div>";

				}
				else
				{
					echo "No books found matching your query";
				}
			}
			else{
				echo "Cannot execute Query";
			}
		}
		else
		{
			echo "search term too short";
		}
	}
}
?>