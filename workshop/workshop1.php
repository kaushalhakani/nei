<?php require_once('../inc/func/member_func.php'); ?>
<?php require_once('../inc/common_inc.php'); ?>
<?php
$temp[] = @split("=",$_SERVER['REQUEST_URI']);

$result = get_list("tbl_workshop","workshop_id=".$temp[0][1],"*,DATE_FORMAT(start_date, '%W, %M %e, %Y') AS w_start_date,DATE_FORMAT(end_date, '%W, %M %e, %Y') AS w_end_date");
$course_result = get_list("tbl_workshop_course NATURAL JOIN tbl_course","workshop_id=".$temp[0][1],"course_id, course_name");
$member_result = get_list("tbl_workshop_attendes NATURAL JOIN tbl_member","workshop_id=".$temp[0][1],"member_id, first_name, last_name");
//print_r($result);
//print_r($course_result);
//print_r($member_result);
//exit;
?>


<?php include_once('../inc/top.php'); ?>
	<p>&nbsp;</p>
	<div>
	<table width="400px" cellpadding="5px" style="font-size:14px">
		<tr><th width="124"> Name : </th><td width="400"><?php echo strtoupper($result[0]['workshop_title']); ?></td></tr>
		<th>Courses : </th>
          <td>
		  	<?php 
				if($member_result)
				{
					echo "<a href=\"../course/profile.php?id=".$course_result[0]['course_id']."\">".$course_result[0]['course_name']."</a>";
					for($i = 1 ; $i < count($course_result); $i++)
						echo " , <a href=\"../course/profile.php?id=".$course_result[$i]['course_id']."\">".$course_result[$i]['course_name']."</a>";
				}
				else
				 echo "No course for the workshop.";
		  	?>
          </td>
        <tr>
		  <th>Start Date : </th><td><?php echo $result[0]['w_start_date'];?></td></tr>
		<tr>
		  <th>End Date : </th><td><?php echo $result[0]['w_end_date'];?></td></tr>
		<tr>
		  <th> Details :</th><td><?php echo $result[0]['workshop_details']; ?></td></tr>
		<tr>
		  <th>Attendies : </th>
          <td valign="top">
		  	<?php 
				if($member_result)
				{
					echo "<table>";
					for($i = 0; $i < count($member_result); $i++)
						echo "<tr><td><a href=\"../member/Profile.php?id=".$member_result[$i]['member_id']."\">".$member_result[$i]['first_name']." ".$member_result[$i]['last_name']."</a></tr></td>";
					echo "</table>";
				}
				else
				 echo "No registration yet. # link of workshop registration page#";
		  	?>
          </td>
         </tr>          
		</table>
	</div>
	  </p>
	  <?php include_once('../inc/bottom.php');
?>
	
</body>
</html>
