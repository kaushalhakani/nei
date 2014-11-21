<?php
if(isset($_GET['field']))
{
	$field = $_GET['field'];
	$sorting[$field] = $_GET['sort'];
	if($sorting[$field] == 'ASC')
		$sorting[$field] = 'DESC';
	else
		$sorting[$field] = 'ASC';
}

		
function field_sort($a, $b)
{
	$temp=strtok(basename($_SERVER['REQUEST_URI']),"?"); 

	$field = $_GET['field'];
	if( $_GET['sort'] == 'ASC')
	{
		if($a[$field] == $b[$field])
			return ($a[$main_field] < $b[$main_field]) ? -1 : 1;
		return ($a[$field] < $b[$field]) ? -1 : 1;
	}
	else
	{
		if($a[$field] == $b[$field])
			return ($a[$main_field] < $b[$main_field]) ? -1 : 1;
		return ($a[$field] < $b[$field]) ? 1 : -1;
	}
}
?>