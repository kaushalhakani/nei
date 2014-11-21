<?php include_once("../inc/common_inc.php"); ?>
<?php include_once("../inc/func/member_func.php"); ?>
<?php include_once("../inc/func/paging.php"); ?>
<?php require_once('../inc/top.php'); ?>

<br /><br />

<table width="900px">
<form action="" method="post">
<tr><td>Title:</td> <td><input type="text" name="a" value="<?php if(isset($_POST['a'])) echo $_POST['a']; ?>"/></td>
<td>Author:</td> <td><input type="text" name="b" value="<?php if(isset($_POST['b'])) echo $_POST['b']; ?>"/></td>
<td>Keywords (seperated by commas):</td><td> <input type="text" name="c" value="<?php if(isset($_POST['c'])) echo $_POST['c']; ?>"/></td>
<td><input type="submit" name="submit" value="Submit" /></td>
</form>
</tr>
</table>
<?php
/*mysql_connect ("localhost", "root","")  or die (mysql_error());
mysql_select_db ("nei");*/

if($_SERVER['REQUEST_METHOD'] == "POST") 
{
	$a = $_POST['a'];
	$b = $_POST['b'];
	$c = $_POST['c'];
	$d = explode(',',$c);
	if(isset($d[0]))
	{
		$j=$d[0];
	}
	else
	{
		$j="0";	
	}
	
	if(isset($d[1]))
	{
		$k=$d[1];
	}
	else
	{
		$k="0";	
	}
	
	if(isset($d[2]))
	{
		$l=$d[2];
	}
	else
	{
		$l="0";	
	}
	
	if($_POST['a'] == "" && $_POST['b'] == "" && $_POST['c'] == "")
	{
		$query = "select * from tbl_bookshelf WHERE 1";
	}
	
	else if ($_POST['b'] == "" && $_POST['c'] == "")
	{
		$query = "select * from tbl_bookshelf where book_title like '%$a%'";
	}
	
	else if ($_POST['a'] == "" && $_POST['c'] == "")
	{
		$query = "select * from tbl_bookshelf where book_authors like '%$b%'"; 
	}
	
	else if ($_POST['a'] == "" && $_POST['b'] == "")
	{
		$query = "select * from tbl_bookshelf where (book_keywords like '%$j%') or (book_keywords like '%$k%') or (book_keywords like '%$l%')";
	}
	
	
	else if($_POST['c'] == "")
	{
		$query = "select * from tbl_bookshelf where (book_title like '%$a%') or (book_authors like'%$b%')";
	}
	
	else if($_POST['b'] == "")
	{
		$query = "select * from tbl_bookshelf where (book_title like '%$a%') or ((book_keywords like '%$j%') or (book_keywords like '%$k%') or (book_keywords like '%$l%'))";
	}
	
	else if($_POST['a'] == "")
	{
		$query = "select * from tbl_bookshelf where ((book_keywords like '%$j%') or (book_keywords like '%$k%') or (book_keywords like '%$l%')) or (book_authors like'%$b%')";
	}
	
	else
	{
		$query = "select * from tbl_bookshelf where ((book_keywords like '%$j%') or (book_keywords like '%$k%') or (book_keywords like '%$l%')) or (book_authors like'%$b%') or (book_title like '%$a%')";
	}
	 
	
	/*or (book_authors like '%$b%') or (book_keywords like '%$d[0]%')";
	$query2 = "select * from tbl_bookshelf where (book_authors like '%$b%');*/
	//echo $query;
	$sql = mysql_query($query);
	//echo $query;
	//echo mysql_num_rows($sql);
	/*foreach($row as $key => $value)
	{
		echo $key."<br />";
		echo $value."<br />";
	}*/
	
	echo "<br /><strong>Results</strong>";
	for($i = 0 ; $i < mysql_num_rows($sql); $i++)
	{
		$row = mysql_fetch_row($sql);
		$abc=$row[0];
		echo "<li><b><a href=\"book_profile.php?id=$abc\">".$row[1]."</a></b></li>";
		echo '<br/> Title: '.$row[1];
		echo '<br/> Author: '.$row[2];
		echo '<br/> Overview: '.$row[3];
		echo '<br/><br/>';
	}
}
/*	
	$i = 0;

for($i = 0 ;$i < mysql_num_rows($sql); $i++)
{
	$temp = $sql[$i]['book_id'];
	echo "<li><a href=\"Profile.php?id=$temp\">".$sql[$i]['book_title']."</a></li>";
	echo '<br/> Title: '.$sql[$i]['book_title'];
	echo '<br/> Author: '.$sql[$i]['book_authors'];
	echo '<br/> Overview: '.$sql[$i]['overview'];
	
}*/
?>

<?php /*require_once('../inc/bottom.php'); */?>