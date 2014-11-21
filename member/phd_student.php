<?php require_once("../inc/common_inc.php"); ?>
<?php require_once('../inc/top.php'); ?> 
<?php require_once("../inc/func/member_func.php"); ?>
							
<p> 
<b><u>Phd students:</u></b>
<ul>
<?php
$result = get_list("tbl_member","1","member_id,first_name,last_name");

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