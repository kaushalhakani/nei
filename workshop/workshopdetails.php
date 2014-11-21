<?php 
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("nei", $con);

$result = mysql_query("SELECT workshop_title, workshop_id FROM tbl_workshop",$con);
$temp = mysql_num_rows($result);
$i = 0;


//$id = array("0", "0", "0", "0");
$id1 = array("0", "0", "0", "0");
echo "<ul>";

//$row = mysql_fetch_array($result);
//$id1=$row['workshop_title'];
// $workshop_title="<a href=\"workshop1.php?id=".$row['workshop_id']."\">".$row['workshop_title']."</a>";
 
/*while($i < $temp)
{
	$row = mysql_fetch_array($result);
	echo "<<a href=\"workshop1.php?id=".$row['workshop_id']."\">".$row['workshop_title']."</a>";
	$i = $i + 1;

}//while
echo "</ul>";*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<?php include_once('../inc/top.php'); ?>
	<p>&nbsp;</p>
	<div>
	<table width="500px" cellpadding="5px" style="font-size:36px">
		<?php
while($i < $temp)
{
	$row = mysql_fetch_array($result);
	echo "<tr><td><a href=\"workshop1.php?id=".$row['workshop_id']."\">".$row['workshop_title']."</a></td></tr>";
	$i = $i + 1;
}
?>
		</table>
	  </td>
	  </tr>
	</table>
	</div>
	  </p>
	  <?php include_once('../inc/bottom.php');
?>

</body>
</html>
