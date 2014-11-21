<script type="text/javascript">
function thread_submit()
{
	document.forms["author_select"].submit();
}
function comment_submit()
{
	document.forms["author_comment_select"].submit();
}
</script>
<?php
require_once('../inc/common_inc.php');
require_once('../inc/func/discussion_func.php');
require_once('../inc/class/database_class.php');
$db = new Database("localhost","root","","nei","");


// only show errors
error_reporting(E_ERROR);

// you need to set these value to match your configuration
$g_Title = "NEI - Discussion Forum";	// The title of this discussion forum
$g_URL = "http://www.mysite.com/";		// Where this script lives (combined with $g_ThisPage)
$g_ContactEmail = "me@mysite.com";		// Contact email address
$g_DisablePostCountInURLs = "0";		// set to "1" to stop topic URLs changing when new posts are added
$g_TopicsPerPage = 10;				// default number of topics to show per page
$g_ThisPage = "discuss.php";			// the name of this page
$g_Password = "password";			// to run database script
$g_HostName = "localhost";			// for mySQL connection, normally localhost
$g_UserName = "root";			// for mySQL connection
$g_DatabaseName = "nei";			// for mySQL connection
$g_MySQLPassword = "";		// for mySQL connection
$g_MessageListTableName = "tbl_comment";	// the message list table name in the database
$g_ThreadListTableName = "tbl_discussion";		// the thread list table name in the database

// kill off the session cookie - don't need it
/*session_start();
$_SESSION = array();
session_destroy();*/


if( $_POST['cmd'] == "submitreply" || $_POST['cmd'] == "submitnew" || $_POST['cmd'] == "submitnewmail" )
{
	$expire = time() + 1296000;
	setcookie("cookie_fullname", $_POST['fullname'], $expire);
	setcookie("cookie_email", $_POST['email'], $expire);
}
?>
<?php

$cmd = $_POST['cmd'];
if( strlen($cmd) == 0 )
	$cmd = $_GET['cmd'];

if(!isset($_SESSION['ID']))
		header("Location: ../login.php");
else if ($cmd == "new")
{
	ShowNewTopicForm("Start a New Topic", "", "", "");
}
else if ($cmd == "submitnew")
{
	$title = $_POST['title'];
	$msg = $_POST['msg'];
	$email = $_POST['email'];
	$thread = $_POST['thread'];
	
	if( strlen($title) == 0 || strlen($msg) == 0 )
	{
		ShowNewTopicForm("Start a New Topic", $title, $msg, "Please complete all the required fields.");
	}
	else
	{
		$link = OpenSQLConnection()
			or DBError( "Unable to open a connection to the database" );
		if ($title != "" and $msg != "")
		{
			$thread = CreateNewThread($title, $_SESSION['ID'], $email);
			CreateNewMessage($msg, $_SESSION['ID'], $email, $thread);
		}
		CloseSQLConnection($link);
		redirectTo( $g_ThisPage );
	}
}
else if ($cmd == "reply")
{
	$thread = $_GET['thread'];
	$link = OpenSQLConnection()
		or DBError( "Unable to open a connection to the database" );
	$title = "Reply to \"";
	$title .= PrintThreadName($thread);
	$title .= "\"";
	PageHeader();
	PrintTitle($title);
	CloseSQLConnection($link);
	ShowReplyForm($msg, $thread, "");
}
else if ($cmd == "submitreply")
{
	$msg = $_POST['msg'];
	$email = $_POST['email'];
	$thread = $_POST['thread'];
	
	if( strlen($msg) == 0)
	{
		$link = OpenSQLConnection()
			or DBError( "Unable to open a connection to the database" );
		$title = "Reply to \"";
		$title .= PrintThreadName($thread);
		$title .= "\"";
		PageHeader();
		PrintTitle($title);
		CloseSQLConnection($link);
		
		ShowReplyForm($msg, $thread, "Please complete all the required fields.");
	}
	else
	{	
		$link = OpenSQLConnection()
			or DBError( "Unable to open a connection to the database" );
		$posts = CreateNewMessage($msg, $_SESSION['ID'], $email, $thread);
		CloseSQLConnection($link);
		redirectTo( $g_ThisPage . "?cmd=show&thread=$thread&posts=$posts" );
	}
}
else if ($cmd == "show")
{
	$thread = $_GET['thread'];
	$link = OpenSQLConnection()
		or DBError( "Unable to open a connection to the database" );
	PrintSingleThread($thread, "");
	CloseSQLConnection($link);
}
else if ($cmd == "manage" )
{
	ShowLoginPage("", "get", "postmanage", "Manage Posts");
}
else if ($cmd == "postmanage" )
{
	$password = $_GET['password'];
	if( $password != $g_Password )
		ShowLoginPage( "Incorrect Password!", "get", "postmanage", "Manage Posts" );
	else
	{
		$link = OpenSQLConnection()
			or DBError( "Unable to open a connection to the database" );
		ShowTopicManagementList($password);
		CloseSQLConnection($link);
	}
}
else if ($cmd == "deleteThread" )
{
	$thread = $_GET['thread'];
	$link = OpenSQLConnection()
		or DBError( "Unable to open a connection to the database" );
	DeleteThisThread( $thread );
	PrintThreadList();
	/*ShowTopicManagementList($password);*/
	CloseSQLConnection($link);
}
else if ($cmd == "manage_showThread" )
{
	$password = $_GET['password'];
	$thread = $_GET['thread'];
	if( $password != $g_Password )
		ShowLoginPage( "Incorrect Password!", "get", "postmanage", "Manage Posts" );
	else
	{
		$link = OpenSQLConnection()
			or DBError( "Unable to open a connection to the database" );
		ShowThisThread( $thread, $password );
		CloseSQLConnection($link);
	}
}
else if ($cmd == "deletePost" )
{
	/*$password = $_GET['password'];*/
	$thread = $_GET['thread'];
	$message = $_GET['message'];
	$link = OpenSQLConnection()
		or DBError( "Unable to open a connection to the database" );
	DeleteThisPost( $thread, $message );
	PrintSingleThread($thread, "");
	CloseSQLConnection($link);
}
else if ($cmd == "newmailform" )
{
	$message = $_GET['message'];
	$link = OpenSQLConnection()
		or DBError( "Unable to open a connection to the database" );
	ShowNewMailForm($message, "", "");
	CloseSQLConnection($link);
}
else if ($cmd == "submitnewmail" )
{
	$message = $_POST['message'];
	$msg = $_POST['msg'];
	$fullname = $_POST['fullname'];
	$email = $_POST['email'];
	
	$link = OpenSQLConnection()
		or DBError( "Unable to open a connection to the database" );
	
	if( strlen($msg) == 0 || strlen($fullname) == 0 || strlen($email) == 0 )
		ShowNewMailForm($message, $msg, "Please complete all required fields!");
	else
	{
		$thread = SendEmailToPoster( $message, $msg, $fullname, $email );
		if( $thread > 0 )
		{
			$posts = GetPostsCount($thread);
			redirectTo( $g_ThisPage . "?cmd=show&thread=$thread&posts=$posts" );
		}
		else
		{
			PageHeader();
			PrintError( "An error has occurred. Sorry about that." );
			PrintStandardFooter("");
		}
	}
	
	CloseSQLConnection($link);
}
else if( $cmd == "offset" )
{
	if(!isset($_SESSION['ID']))
		header("Location: ../login.php");
	else
	{
		$page = $_GET['page'];
		$link = OpenSQLConnection()
			or DBError( "Unable to open a connection to the database" );
		PrintThreadList( $page );
		CloseSQLConnection($link);
	}
}
else
{
	if(!isset($_SESSION['ID']))
		header("Location: ../login.php");
	else
	{	
		$link = OpenSQLConnection()
			or DBError( "Unable to open a connection to the database" );
		PrintThreadList();
		CloseSQLConnection($link);
	}
}
?>