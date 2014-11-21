<?php require_once('../inc/top.php'); ?>
<?php require_once("../inc/common_inc.php"); ?>
<?php require_once("../inc/func/member_func.php"); ?>
<h2>Regular Courses:</h2>
<p>Following Courses are offered at NEI under different Workshops.</p>
The courses are divided into three categories.
<?php
	$i=1;
	for($i=1;$i<4;$i++)
	{
		$result = get_list("tbl_course","course_type=".$i,"*");?>
		<b><br> Type <?php echo $result[0]['course_type']?> courses</b>
		<?php 
		$j=0;
		for($j=0;$j<count($result);$j++)
		{
		 ?>

			<li><b><?php echo $result[$j]['course_id'];?>
			 <?php echo $result[$j]['course_name'];?></b>
	 		: <?php echo $result[$j]['basic_info']; ?> </li>
<?php
		}
	}
exit;
?>

<?php require_once('../inc/bottom.php'); ?>