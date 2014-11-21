<?php require_once("../inc/common_inc.php"); ?>
<?php require_once("../inc/func/member_func.php"); ?>

<?php
if(isset($_SESSION['ID']))
{
	$temp[] = @split("=",$_SERVER['REQUEST_URI']);
	
	$result = get_list("tbl_bookshelf","book_id=".$temp[0][1],"*");
	$book_id=$result[0]['book_id'];
	$book_title=$result[0]['book_title'];
	$book_authors=$result[0]['book_authors'];
	$book_publisher=$result[0]['book_publisher'];
	$edition=$result[0]['edition'];
	//$email= "<a href=\"mailto:$email1\"><u><i><font colour =\"#006600\">$email1</font></i></u></a>";
	$overview=$result[0]['overview'];
	$book_address=$result[0]['book_address'];
	$keywords=$result[0]['book_keywords'];

	
	//to seee picture
	$check_pic="book_images/".$book_id.".jpg";
	$default_pic="book_images/default.jpg";
	
	if(file_exists($check_pic))
	{
		$size = getimagesize($check_pic);
		if($size['0'] <= $size['1'])
			$picture="<img src=\"$check_pic\" height=\"100px\" align=\"absmiddle\" id=\"profile_image\"/>"; 
		else
			$picture="<img src=\"$check_pic\" width=\"100px\" align=\"absmiddle\"/>";
	}
	else
		$picture="<img src=\"$default_pic\" width=\"100px\" height=\"100px\" align=\"absmiddle\"/>";
	
	?>
	<?php include_once('../inc/top.php'); ?>
	<p>&nbsp;</p>
	<div>
	<table width="700" height="175" style="font-size:16px" cellspacing="20px" cellpadding="10px">
	<tr><td valign="top" align="right"><?php echo $picture;?></td>
	<td valign="top">
	<table width="600px" cellpadding="5px" style="font-size:16px">
		<tr><th>Book Title : </th><td><?php echo $book_title;?></td></tr>
		<tr><th>Authors : </th><td><?php echo $book_authors; ?></td></tr>
		<tr><th>Publisher : </th><td><?php echo $book_publisher;?></td></tr>
		<tr><th>Edition : </th><td><?php echo $edition;?></td></tr>
		<tr><th>Overview : </th><td><?php echo $overview;?></td></tr>
		<tr><th>Book Address : </th><td><?php echo $book_address;?></td></tr>
		<tr><th>Keywords : </th><td><?php echo $keywords;?></td></tr>
		</table>
		</td>
	  </tr>
	</table>
	</div>
	  </p>
	  <?php include_once('../inc/bottom.php');
}
else 
{
	include_once('../inc/top.php');
	?>
    <div style="padding-top:20px; font-size:18px; white-space:pre">
	<center>Please <a href="../login.php" style="color:#FF0000; font-size:18px;">Login</a> to View Profile!</center>
    </div>
	<?php
}
?>
	
