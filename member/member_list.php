<?php require_once("../inc/common_inc.php"); ?>
<?php require_once('../inc/top.php'); ?> 
<?php require_once("../inc/func/member_func.php"); ?>

<?php						
$temp = $_SERVER['REQUEST_URI'];
$temp = explode("=",$temp);
if($temp[1] == "phd")
{
	echo "<p><b><u>Ph.D. students:</u></b><ul>";
	$result = get_list("tbl_member","member_type='PHD'","member_id,first_name,last_name");
}
else
{
	echo "<p><b><u>Workshop students:</u></b><ul>";
	$result = get_list("tbl_member","member_type='WORKSHOP'","member_id,first_name,last_name");
}


$i = 0;

for($i = 0 ;$i < count($result); $i++)
{
	$temp = $result[$i]['member_id'];
	echo "<li><a href=\"Profile.php?id=$temp\">".$result[$i]['first_name']." ".$result[$i]['last_name']."</a></li>";
}
?> 
</ul>
</p>

<?php require_once('../inc/bottom.php'); ?>