<?php

function get_list($tbl_name,$filter,$fields)
{
	//$result = get_list("tbl_member","1","first_name,last_name"); (USAGE)
	global $db;
	$sql = "select $fields from $tbl_name where $filter";
	//echo $sql;
	$result = $db->fetch_all_array($sql);
	if(!$result)
		return 0;
	else
		return $result;
}

function get_limited_list($tbl_name,$filter,$fields,$st_rec,$offset)
{
	//$result = get_list("tbl_member","1","first_name,last_name"); (USAGE)
	global $db;
	$max = 'limit ' .$st_rec .',' .$offset;
	$sql = "select $fields from $tbl_name where $filter $max";
	$result = $db->fetch_all_array($sql);
	//print_r($member_result);
	if(!$result)
		return 0;
	else
		return $result;
}

function add_member()
{
	global $db;
	$first_name = $_POST["fname"];
	$last_name = $_POST["lname"];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$status = "Active"; 
	$data = array("first_name" => $first_name, "last_name" => $last_name, "email" => $email, "password" => $password, "status" => $status);
	if($db->query_insert("tbl_member",$data))
	{
		$sql = "select id from tbl_member where email = '$email'";
		$id = $db->fetch_all_array($sql);
		if($_POST['lm'] == 1)
		{
			$data = array("member_id" => $id[0]['id'], "access_id" => "1");
			$db->query_insert("tbl_member_access",$data);
		}
		if($_POST['res'] == 1)
		{
			$data = array("member_id" => $id[0]['id'], "access_id" => "2");
			$db->query_insert("tbl_member_access",$data);
		}
		if($_POST['rep'] == 1)
		{
			$data = array("member_id" => $id[0]['id'], "access_id" => "3");
			$db->query_insert("tbl_member_access",$data);
		}
		if($_POST['pm'] == 1)
		{
			$data = array("member_id" => $id[0]['id'], "access_id" => "4");
			$db->query_insert("tbl_member_access",$data);
		}
		if($_POST['cm'] == 1)
		{
			$data = array("member_id" => $id[0]['id'], "access_id" => "5");
			$db->query_insert("tbl_member_access",$data);
		}
		if($_POST['mm'] == 1)
		{
			$data = array("member_id" => $id[0]['id'], "access_id" => "6");
			$db->query_insert("tbl_member_access",$data);
		}
	}
}

function add_client()
{
	global $db;
	$first_name = $_POST["fname"];
	$last_name = $_POST["lname"];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$status = "Active";
	$data = array("first_name" => $first_name, "last_name" => $last_name, "email" => $email, "password" => $password, "status" => $status);
	if($db->query_insert("tbl_client", $data))
		return 1;
	else
		return 0;
}

function add_project()
{
	global $db;
	$client_id = $_POST["client_id"];
	$project = $_POST["project_name"];
	$category = $_POST['category_id'];
	$description = $_POST['description'];
	$status = "On-going";
	$data = array("client_id" => $client_id, "category_id" => $category, "name" => $project, "description" => $description, "status" => $status);
	if($db->query_insert("tbl_project",$data))
		return 1;
	else
		return 0;
}

function add_link()
{
	global $db;
	$client_id = $_POST['client_id'];
	$project_id = $_POST["project_id"];
	$category_id = $_POST['category_id'];
	$website_type = $_POST['website_type'];
	$partnership_type = $_POST['partnership_type'];
	$url = $_POST['url'];
	$domain_name = explode("/",$url);
	$anchor_text = $_POST['anchor_text'];
	$page_rank = $_POST['page_rank'];
	$do_follow = $_POST['do_follow'];
	$mode = $_POST['mode'];
	if($_POST['approved_url'] != "")
		$approved_url = "http://".$_POST['approved_url'];
	else
		$approved_url = "";
	$link_status = $_POST['link_status'];
	$data = array("client_id" => $client_id, "project_id" => $project_id, "website_type_id" => $website_type, "category_id" => $category_id, "partnership_type_id" => $partnership_type, "url"  => $domain_name[0], "page_rank" => $page_rank, "mode_of_submission" => $mode, "do_follow" => $do_follow, "anchor_text" => $anchor_text, "approved_url" => $approved_url, "link_status"=>$link_status, "Submission_date" => 'Now()');
	if($db->query_insert("tbl_link",$data))
		return 1;
	else
		return 0;
}

function delete_member($member_id)
{
	global $db;
	$where = "id = \"$member_id\"";
	$data = array("status" => "Inactive");
	$query_id = $db->query_update("tbl_member", $data, $where);
	$db->query("DELETE FROM tbl_member_access WHERE member_id = $member_id");
	return $query_id;
}

function delete_client($client_id)
{
	global $db;
	$where = "id = \"$client_id\"";
	$data = array("status" => "Inactive");
	$query_id = $db->query_update("tbl_client", $data, $where);
	return $query_id;
}

function delete_project($project_id)
{
	global $db;
	$where = "id = \"$project_id\"";
	$data = array("status" => "Canceled");
	$query_id = $db->query_update("tbl_project", $data, $where);
	return $query_id;
}

function delete_link($link_id)
{
	echo "HI!!!";
	global $db;
	$where = "id = \"$link_id\"";
	$data = array("link_status" => "Not Working");
	$query_id = $db->query_update("tbl_link", $data, $where);
	return $query_id;
}

function edit_member()
{
	global $db;
	$id = $_POST['member_id'];
	$first_name = $_POST["fname"];
	$last_name = $_POST["lname"];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$status = $_POST['status']; 
	$data = array("first_name" => $first_name, "last_name" => $last_name, "email" => $email, "password" => $password, "status" => $status);
	$sql = "DELETE FROM tbl_member_access WHERE member_id = $id";
	$db->query($sql);
	$db->query_update("tbl_member",$data,"id = $id");
	if($status == 'Active')
	{
		$sql = "select id from tbl_member where email = '$email'";
		$id = $db->fetch_all_array($sql);
		if(isset($_POST['lm']) && $_POST['lm'] == 1)
		{
			$data = array("member_id" => $id[0]['id'], "access_id" => "1");
			$db->query_insert("tbl_member_access",$data);
		}
		if(isset($_POST['res']) && $_POST['res'] == 1)
		{
			$data = array("member_id" => $id[0]['id'], "access_id" => "2");
			$db->query_insert("tbl_member_access",$data);
		}
		if($_POST['rep'] == 1 && isset($_POST['rep']))
		{
			$data = array("member_id" => $id[0]['id'], "access_id" => "3");
			$db->query_insert("tbl_member_access",$data);
		}
		if(isset($_POST['pm']) && $_POST['pm'] == 1)
		{
			$data = array("member_id" => $id[0]['id'], "access_id" => "4");
			$db->query_insert("tbl_member_access",$data);
		}
		if(isset($_POST['cm']) && $_POST['cm'] == 1)
		{
			$data = array("member_id" => $id[0]['id'], "access_id" => "5");
			$db->query_insert("tbl_member_access",$data);
		}
		if(isset($_POST['mm']) && $_POST['mm'] == 1)
		{
			$data = array("member_id" => $id[0]['id'], "access_id" => "6");
			$db->query_insert("tbl_member_access",$data);
		}
	}
}

function edit_client()
{
	global $db;
	$id = $_POST['client_id'];
	$first_name = $_POST["fname"];
	$last_name = $_POST["lname"];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$status = $_POST['status'];
	$data = array("first_name" => $first_name, "last_name" => $last_name, "email" => $email, "password" => $password, "status" => $status);
	if($db->query_update("tbl_client", $data,"id = $id"))
		return 1;
	else
		return 0;
}

function edit_project()
{
	global $db;
	$id = $_POST['proj_id'];
	$client_id = $_POST["client_id"];
	$project = $_POST["project_name"];
	$category = $_POST['category_id'];
	$description = $_POST['description'];
	$status = $_POST['status'];
	$data = array("client_id" => $client_id, "category_id" => $category, "name" => $project, "description" => $description, "status" => $status);
	if($db->query_update("tbl_project",$data,"id = $id"))
		return 1;
	else
		return 0;
}

function edit_link()
{
	global $db;
	$id = $_POST['edit_link_id'];
	$client_id = $_POST['edit_client_id'];
	$project_id = $_POST["edit_project_id"];
	$category_id = $_POST['edit_category_id'];
	$website_type = $_POST['edit_website_type'];
	$partnership_type = $_POST['edit_partnership_type'];
	$url = $_POST['edit_url'];
	$domain_name = explode("/",$url);
	$anchor_text = $_POST['edit_anchor_text'];
	$page_rank = $_POST['edit_page_rank'];
	$do_follow = $_POST['do_follow'];
	$mode = $_POST['mode'];
	if($_POST['approved_url'] != "")
		$approved_url = "http://".$_POST['approved_url'];
	else
		$approved_url = "";
	$link_status = $_POST['link_status'];
	$submission_date = $_POST['orderdate'];
	if($link_status == 'Approved')
		$approved_date = $_POST['duedate'];
	else
		$approved_date = "";
		
	$data = array("client_id" => $client_id, "project_id" => $project_id, "website_type_id" => $website_type, "category_id" => $category_id, "partnership_type_id" => $partnership_type, "url"  => $domain_name[0], "page_rank" => $page_rank, "mode_of_submission" => $mode, "do_follow" => $do_follow, "anchor_text" => $anchor_text, "approved_url" => $approved_url, "link_status"=>$link_status, "submission_date"=>$submission_date,"approved_date"=>$approved_date);

	if($db->query_update("tbl_link",$data,"id = $id"))
		return 1;
	else
		return 0;
}

function my_account()
{
	global $db;
	$id = $_POST['acc_member_id'];
	$first_name = $_POST["acc_fname"];
	$last_name = $_POST["acc_lname"];
	$email = $_POST['acc_email'];
	$password = $_POST['acc_password'];
	$client_id = $_POST['client_id'];
	$project_id = $_POST['project_id'];
	$category_id = $_POST['category_id'];
	$website_type_id = $_POST['website_type'];
	$partnership_type_id = $_POST['partnership_type'];
	$data = array("first_name" => $first_name, "last_name" => $last_name, "email" => $email, "password" => $password, "client_id" => $client_id, "project_id" => $project_id, "category_id" => $category_id, "website_type_id" => $website_type_id, "partnership_type_id" => $partnership_type_id);
	if($db->query_update("tbl_member",$data,"id = $id"))
		return 1;	
	else
		return 0;
}

/*function temporary($temp3, $value)
{
	global $db;
	echo $temp3;
	$sql = "UPDATE sheet1 SET url = $temp3 WHERE url = $value";	
	echo $db->query_update("sheet1",array('url' => $temp3[0]),"url = $value");
}*/
?>