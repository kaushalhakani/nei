<?php require_once("../inc/common_inc.php"); ?>
<?php require_once("../inc/func/member_func.php"); ?>

<?php
if(isset($_SESSION['ID']))
{
	$temp[] = @split("=",$_SERVER['REQUEST_URI']);
	
	$result = get_list("tbl_member","member_id=".$temp[0][1],"*");
	$institute_temp = get_list("tbl_institute","institute_id=".$result[0]['institute_id'],"institute_name");
	
	$member_id=$result[0]['member_id'];
	$first_name=$result[0]['first_name'];
	$last_name=$result[0]['last_name'];
	$institute=$institute_temp[0]['institute_name'];
	$email1=$result[0]['email'];
	$email= "<a href=\"mailto:$email1\"><u><i><font colour =\"#006600\">$email1</font></i></u></a>";
	$city=$result[0]['city'];
	$country=$result[0]['country'];
	$description=$result[0]['description'];
	
	//to seee picture
	$check_pic="images/".$member_id.".jpg";
	$default_pic="images/default_pic.jpg";
	
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
    <?php echo "Ph.D. students should be shown their recent uploads for review."; ?>
	<div>
	<table width="700" height="175" style="font-size:16px" cellspacing="20px" cellpadding="10px">
	<tr><td valign="top" align="right"><?php echo $picture;?></td>
	<td valign="top">
	<table width="300px" cellpadding="5px" style="font-size:16px">
		<tr><th>Name : </th><td><?php echo $first_name." ".$last_name;?></td></tr>
		<tr><th>Institute : </th><td><?php echo $institute; ?></td></tr>
		<tr><th>Email ID : </th><td><?php echo $email;?></td></tr>
		<tr><th>City : </th><td><?php echo $city;?></td></tr>
		<tr><th>Country : </th><td><?php echo $country;?></td></tr>
		<tr><th>About Me : </th><td><?php echo $description;?></td></tr>
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
	
