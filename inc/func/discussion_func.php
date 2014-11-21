<?php 

function get_author_name($author_id)
{
	$sql = "SELECT first_name, last_name, member_type FROM tbl_member WHERE member_id =".$author_id; 
	$query = mysql_query($sql);
	$temp_result = mysql_fetch_array($query);
	return $temp_result;
}

function get_admin_id()
{
	$sql = "SELECT member_id FROM tbl_member WHERE member_type = 'ADMIN'";
	$query = mysql_query($sql);
	$temp_result = mysql_fetch_array($query);
	return $temp_result;
}

function redirectTo( $url )
{
	// fire out the header
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");    // Date in the past
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
	header("Cache-Control: no-store, no-cache, must-revalidate");  // HTTP/1.1
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");                          // HTTP/1.0

	$head = "Location: $url";
	header($head);
	exit;
}

function PageHeader()
{
	require_once('../inc/top.php');
}

function PageFooter()
{
	require_once('../inc/bottom.php');
}

function PrintStandardFooter($above)
{
	global $g_ThisPage;

	print "<hr />\n";
	if( strlen($above) > 0 )
		print "$above\n";
	print "<br />View <a href=\"$g_ThisPage\" style=\"color:#FF0000\">Recent Topics</a>\n";
	print "<p></p>\n";
	PageFooter();	
}

function OpenSQLConnection()
{
	global $g_HostName, $g_UserName, $g_DatabaseName, $g_MySQLPassword;
	
	// Connecting, selecting database
	$link = mysql_connect($g_HostName, $g_UserName, $g_MySQLPassword)
		or DBError("Could not connect to the database");

	mysql_select_db($g_DatabaseName)
		or DBError("Could not select specified database");
	    
	return $link;
}

function CloseSQLConnection($link)
{
	mysql_close($link);
}

function DoQuery($query)
{
	$result = mysql_query($query)
		or DBError("SQL Query Failed - Oh dear.");
}

function HTMLEncode($text) 
{ 
	$searcharray = array( 
		"'([-_\w\d.]+@[-_\w\d.]+)'", 
		"'((?:(?!://).{3}|^.{0,2}))(www\.[-\d\w\.\/?=]+)'", 
		"'(http[s]?:\/\/[-_~\w\d\.\/?=]+)'"); 

	$replacearray = array( 
		" <a href=\"mailto:\\1\">\\1</a> ", 
		"\\1http://\\2", 
		" <a href=\"\\1\"> \\1</a> "); 

	return nl2br(preg_replace($searcharray, $replacearray, stripslashes($text) )); 
}

function StripHTML($str)
{
	// replace all tags with the appropriate characters
	$str = str_replace("<", "&lt;", $str); 
	$str = str_replace(">", "&gt;", $str); 
	
	// replace all lines with paragraphs
	$str = str_replace("\n", "</p> <p>", $str); 
	$str = str_replace("\r", "", $str); 

	// Add in hyperlinks where we can
	$str = HTMLEncode($str);

	// Break up long words
	list ($words) = array (split (" ", $str)); 
	$str = ''; 
	foreach ($words as $c => $word) 
	{ 
		if (strlen ($word) > 45 and !ereg("^href=", $word) and !ereg ("[\[|\]|\/\/]", $word)) 
			$word = chunk_split ($word, 45, " "); 

		if ($c) 
			$str .= ' '; 

		$str .= $word; 
	}

	return addslashes($str);
}

function StripHTMLSimple($str)
{
	// add spaces to very long strings
	list ($words) = array (split (" ", $str)); 
	$str = ''; 
	foreach ($words as $c => $word) 
	{ 
		if (strlen ($word) > 45 and !ereg ("[\[|\]|\/\/]", $word)) 
			$word = chunk_split ($word, 45, " "); 

		if ($c) 
			$str .= ' '; 

		$str .= $word; 
	}

	// replace all tags with the appropriate characters
	$str = str_replace("<", "&lt;", $str); 
	$str = str_replace(">", "&gt;", $str); 
	
	// replace all lines with spaces
	$str = str_replace("\n", " ", $str); 
	$str = str_replace("\r", "", $str); 
	return $str;
}

function PrintTitle($title)
{
	print "<span class=\"pageHeadline\"><h2>$title</h2></span><p></p>\n";
}

function PrintError($error)
{
	print "<p class=\"errorText\">$error</p>\n";
}

function ShowLoginPage($error_message,$method,$to_post,$title)
{
	global $g_ThisPage;
	
	PageHeader();
	print "<span class=pageHeadline>$title</span><p></p>";
	if( strlen( $error_message ) > 0 )
		print "<p><strong>Error: $error_message</strong></p>\n";
?>
<link href="../../css/style.css" rel="stylesheet" type="text/css" />

<P>Please enter the password to proceed:</P>
<form method="<?php print $method ?>" action="<?php print "$g_ThisPage" ?>">
 <div align="left">
  <table border="0" cellpadding="0" cellspacing="0" width="440">
   <tr>
    <td width="100" valign="top" align="left">Password:</td>
    <td width="340" valign="top" align="left"><input class="formBox" style="width: 175px" type="password" name="password" size="51" value="" /></td>
   </tr>
   <tr>
    <td valign="top" align="left"></td>
    <td valign="top" align="left">&nbsp;</td>
   </tr>
   <tr>
    <td valign="top" align="left"></td>
    <td valign="top" align="left"><input type="submit" value="Confirm" /></td>
   </tr>
  </table>
 </div>
 <input type="hidden" name="cmd" value="<?php print $to_post ?>" />
</form>
<?php
	PrintStandardFooter("");
}

function DeleteThisThread( $thread )
{
	global $g_MessageListTableName, $g_ThreadListTableName;
	
	$query1 = "DELETE FROM $g_ThreadListTableName WHERE ThreadID = '$thread'";
	$query2 = "DELETE FROM $g_MessageListTableName WHERE ThreadID = '$thread'";
	DoQuery( $query1 );
	DoQuery( $query2 );
}

function DeleteThisPost( $thread, $message )
{
	global $g_MessageListTableName, $g_ThreadListTableName;
	
	$query = "SELECT Posts FROM $g_ThreadListTableName WHERE ThreadID = $thread";
	$result = mysql_query($query)
	    or DBError("Failed while trying to delete post");
	    
	if( mysql_num_rows($result) == 1 )
	{
		$line = mysql_fetch_row($result);
		if( $line[0] == "1" )
			$query1 = "DELETE FROM $g_ThreadListTableName WHERE ThreadID = '$thread'";
		else
			$query1 = "UPDATE $g_ThreadListTableName set Posts=Posts-1 WHERE ThreadID = '$thread'";

		$query2 = "DELETE FROM $g_MessageListTableName WHERE MessageID = '$message'";
		DoQuery( $query1 );
		DoQuery( $query2 );
	}
}

function ShowThisThread( $thread, $password )
{
	global $g_ThisPage, $g_MessageListTableName;
	
	$title = PrintThreadName($thread);
	PageHeader();
	PrintTitle( "Manage Thread" );
	print "<p>Manage thread '$title'</p>";

	// perform an SqL query
	$query = "SELECT * FROM $g_MessageListTableName WHERE ThreadID = $thread ORDER BY CreationDate";
	$result = mysql_query($query)
	    or DBError("Failed while trying to show thread", false);
	    
	if( mysql_num_rows($result) < 1 )
	{
		// topic not found
		print "<p>Topic $thread either doesn't exist or has been deleted.</p>\n";
		PrintStandardFooter("View <a href=\"$g_ThisPage?cmd=postmanage&amp;password=$password\" style=\"color:#FF0000\">Management Page</a>");
		return;
	}

	// Printing results in HTML
	print "<div><table border=\"1\" cellpadding=\"4\" cellspacing=\"0\">\n";
	print "<tr><th>ID</th><th>Action</th><th>Message</th><th>Author</th></tr>\n";

	while ($line = mysql_fetch_row($result)) 
	{
		print "<tr><td>$line[0]</td><td><a href=\"$g_ThisPage?cmd=manage_deletePost&amp;password=$password&amp;&amp;thread=$line[5]&amp;message=$line[0]\"";
		print "onclick=\"return confirm('Delete this post?')\">";
		print "delete</a></td><td>$line[1]</td><td>$line[2]</td></tr>\n";
	}
	
	print "</table><p></p></div>\n";
	PrintStandardFooter("View <a href=\"$g_ThisPage?cmd=postmanage&amp;password=$password\" style=\"color:#FF0000\">Management Page</a>");
}

function ShowTopicManagementList($password)
{
	global $g_ThisPage, $g_ThreadListTableName;
	PageHeader();
	PrintTitle("Manage Discussion Forum");
	print "<p>Manage the topics and posts below:</p>";
	
	// Performing SQL query
	$query = "SELECT * FROM $g_ThreadListTableName ORDER BY ThreadID DESC";
	$result = mysql_query($query)
	    or DBError("Failed while trying to show topic management list", false);

	if( mysql_num_rows($result) > 0 )
	{
		// Printing results in HTML
		print "<div><table border=\"1\" cellpadding=\"4\" cellspacing=\"0\">\n";
		print "<tr><th>Thread</th><th>Action</th><th>Title</th><th>Author</th><th>Posts</th></tr>\n";
		while ($line = mysql_fetch_row($result)) 
		{
			print "<tr><td>$line[0]</td><td><a href=\"$g_ThisPage?cmd=manage_deleteThread&amp;password=$password&amp;thread=$line[0]\" ";
			print "onclick=\"return confirm('Delete this thread?')\">delete</a></td>";
			print "<td><a href=\"$g_ThisPage?cmd=manage_showThread&amp;password=$password&amp;thread=$line[0]\">$line[1]</a></td><td>$line[2]</td><td>$line[4]</td></tr>\n";
		}
	
		// Closing connection
		print "</table><p></p></div>\n";
	}
	else
	{
		// if nothing there
		print "<p>There are no entries in the discussion forum.</p>\n";
	}

	PrintStandardFooter("View <a href=\"$g_ThisPage?cmd=postmanage&amp;password=$password\" style=\"color:#FF0000\">Management Page</a>");
}

function PrintThreadList($page=0)
{
	global $g_ThisPage, $g_Title, $g_DisablePostsInURLs, $g_TopicsPerPage, $g_ThreadListTableName;

	PageHeader();
	PrintTitle("$g_Title");
	
	$cond = "";
	if($_GET['cmd'] == "")
	{
		$temp = explode("=",$_SERVER['REQUEST_URI']);
		if($temp[1])
			$cond = "WHERE Author_id=".$temp[1];
	}
	
	// Performing SQL query
	$query = "SELECT * FROM $g_ThreadListTableName ".$cond." ORDER BY ThreadID DESC";
	$result = mysql_query($query)
	    or DBError("Failed while trying to show thread list", false);

	$rows = mysql_num_rows($result);
	if( $rows > 0 &&
		$rows > $g_TopicsPerPage )
	{
		while( $rows < $page * $g_TopicsPerPage + 1 )
		{
			$page--;
		}
		
		if( $page > 0 )
		{
			// shift results pointer forward to correct place
			mysql_data_seek( $result, $page * $g_TopicsPerPage );
		}
	}

	if( mysql_num_rows($result) > 0 )
	{
		// Printing results in HTML
		print "<div><table border=\"0\" cellpadding=\"0\" cellspacing=\"1\">\n";
		$count = 0;
		while ($count < $g_TopicsPerPage and $line = mysql_fetch_row($result)) 
		{
			$author_name = get_author_name($line[2]);
			$to_print = "\t<tr><td width=\"10\">&nbsp;</td><td><a href=\"$g_ThisPage?cmd=show&amp;thread=$line[0]";
			if( $g_DisablePostsInURLs != "1" )
				$to_print .= "&amp;posts=$line[4]";
			$to_print .= "\"><big><b>$line[1]</b></big></a> ";
			print "$to_print";
			print "<br /><small><i>".$author_name['first_name']." ".$author_name['last_name'];
			print " (".strtolower($author_name['member_type']).")<br />";
			print "($line[4]";
			if( $count == 0 )
			{
				if( $line[4] == "1" )
					print " post";
				else
					print " posts";
			}
			print ")</small>";
				
			$to_print = "\t<td width=\"80%\" align=\"right\">&nbsp;</td><td><a href=\"$g_ThisPage?cmd=deleteThread&amp;thread=$line[0]";
			if( $g_DisablePostsInURLs != "1" )
				$to_print .= "&amp;posts=$line[4]";
			$to_print .= "\">";
			
			$admin_id = get_admin_id();
			if($_SESSION['ID'] == $line[2] || $_SESSION['ID'] == $admin_id['member_id'])
				$to_print .= "<i>delete</i>";
			
			$to_print .= "</a>";
			print "$to_print";
			
			$count = $count + 1;
		}
	
		print "</table><p></p></div>\n";
		
		// show previous / next links if necessary
		if( $rows > $g_TopicsPerPage )
		{
			print "<br /><div class=\"subtle\">";
			if( $page > 0 )
			{
				$prev = $page - 1;
				print "<a href=\"$g_ThisPage?cmd=offset&amp;page=$prev\">&lt; Previous $g_TopicsPerPage topics</a> ";
			}
			if( $rows > ( $page + 1 ) * $g_TopicsPerPage )
			{
				$next = $page + 1;
				print " <a href=\"$g_ThisPage?cmd=offset&amp;page=$next\">Next $g_TopicsPerPage topics &gt;</a>";
			}
			
			print "</div>";
		}
	}
	else
	{
		// if nothing there
		print "<p>There are no entries in the discussion forum. Why not create a new one below?</p>\n";
	}
	if($cond == "" && mysql_num_rows($result) == 0)
	{}
	else
	{
		//sql
		$query1 = "SELECT DISTINCT author_id, first_name, last_name FROM $g_ThreadListTableName NATURAL JOIN tbl_member";
		$result1 = mysql_query($query1);
		
		// Add a link to post a new topic with
		echo "<form method=\"get\" name=\"author_select\" id=\"author_select\" action=\"\">
				View Posts by : <select name=\"auhtor\" onchange=\"thread_submit()\">";
				
		if(!isset($temp[1]) || $temp[1] == "")
		{	
			echo "<option value=\"\">All </option>";
		}
		else
		{
			$author_name = get_author_name($temp[1]);
			echo "<option value=\"".$temp[1]."\">".$author_name['first_name']." ".$author_name['last_name']."</option>";
		}
		
		$flag = 0;
		for($i= 0; $i< mysql_num_rows($result1); $i++)
		{
			$result2 = mysql_fetch_row($result1);
			if($result2[0] != $temp[1])
				echo "<option value=\"".$result2[0]."\">".$result2[1]." ".$result2[2]."</option>";
			else
				$flag = 1;
		}
		
		if($flag == 1)
			echo "<option value=\"\">All </option>";
			
		echo "</select></form>";
	}
	
	PrintStandardFooter("Start a <a href=\"$g_ThisPage?cmd=new\"style=\"color:#FF0000\">New Topic</a>");

}

function PrintThreadName($thread)
{
	global $g_ThreadListTableName;
	
	$query = "SELECT Title FROM $g_ThreadListTableName WHERE ThreadID = $thread";
	$result = mysql_query($query)
	    or DBError("Failed while trying to find the thread name");

	$line = mysql_fetch_row($result);
	if ($line)
		$title = $line[0];
		
	return $title;
}

function PrintSingleThread($thread,$error)
{
	global $g_ThisPage, $g_MessageListTableName;
	
	$cond = " ";
	if($_GET['cmd'] == "show")
	{
		$temp = explode("=",$_SERVER['REQUEST_URI']);
		if($temp[4])
			$cond = " AND Author_id=".$temp[4];
	}
	
	if( strlen($error) > 0 )
		PrintError($error);
	
	// perform an SqL query
	$query = "SELECT *,DATE_FORMAT(CreationDate, '%W, %M %e, %Y') AS mydatestring FROM $g_MessageListTableName WHERE ThreadID = $thread". $cond." ORDER BY CreationDate";
	$result = mysql_query($query)
	    or DBError("Failed while trying to find the thread in the database");
	    
	if( mysql_num_rows($result) < 1 )
	{
		// topic not found
		PageHeader();
		PrintTitle( "Message doesn't exist" );
		print "<p>Topic $thread either doesn't exist or has been deleted.</p>\n";
		PrintStandardFooter("Post <a href=\"$g_ThisPage?cmd=new\" style=\"color:#FF0000\">New Topic</a>");
		return;
	}
	
	// print out a heading
	$title = PrintThreadName($thread);
	PageHeader();
	PrintTitle($title);

	// Printing results in HTML
	while ($line = mysql_fetch_row($result)) 
	{	
		print "<div>$line[1]</div><div align=\"right\">";
		
		$author_name = get_author_name($line[2]);
		$admin_id = get_admin_id();
		if($_SESSION['ID'] == $line[2] || $_SESSION['ID'] == $admin_id['member_id'])
			print "<a href=\"$g_ThisPage?cmd=deletePost&amp;thread=$line[5]&amp;message=$line[0]\" /> delete</a>";
		
		print "<small><i><br />";
		if ($line[2] == "")
			$line[2] = "anon.";
			
		if ($line[3] == "")
			print "$line[2]";
		else
			print "<a title=\"Click to send private email\" href=\"$g_ThisPage?cmd=newmailform&amp;message=$line[0]\">".$author_name['first_name']." ".$author_name['last_name']."(".strtolower($author_name['member_type']).")</a>";

		print "<br />$line[6]</i></small></div>\n";
	}

	if($cond == "" && mysql_num_rows($result) == 0)
	{}
	else
	{
		//sql
		$query1 = "SELECT DISTINCT author_id, first_name, last_name FROM $g_MessageListTableName NATURAL JOIN tbl_member WHERE ThreadID = $thread";
		$result1 = mysql_query($query1);
	
		// Add a link to post a new topic with
		echo "<form method=\"get\" name=\"author_comment_select\" id=\"author_comment_select\" action=\"\">
				<input type=\"hidden\" name=\"cmd\" value=".$_GET['cmd'].">
				<input type=\"hidden\" name=\"thread\" value=".$_GET['thread'].">
				<input type=\"hidden\" name=\"posts\" value=".$_GET['posts'].">
				View Posts by : <select name=\"comment_auhtor\" onchange=\"comment_submit()\">";
				
		if(!isset($temp[4]) || $temp[4] == "")	
			echo "<option value=\"\">All </option>";
		else
		{
			$author_name = get_author_name($temp[4]);
			echo "<option value=\"".$temp[4]."\">".$author_name['first_name']." ".$author_name['last_name']."</option>";
		}
		
		$flag = 0;
		for($i= 0; $i< mysql_num_rows($result1); $i++)
		{
			$result2 = mysql_fetch_row($result1);
			if($result2[0] != $temp[4])
				echo "<option value=\"".$result2[0]."\">".$result2[1]." ".$result2[2]."</option>";
			else
				$flag = 1;
		}
		
		if($flag == 1)
			echo "<option value=\"\">All </option>";
			
		echo "</select></form>";
	}
	
	// Add a link to post a reply with
	PrintStandardFooter("<a href=\"$g_ThisPage?cmd=reply&amp;thread=$thread\" style=\"color:#FF0000\">Reply</a> to this topic");

}

function CreateNewThread($title, $author_id, $email)
{
	global $g_ThreadListTableName;
	
	// Performing SQL query
	$datetime = date("Y-m-d H:i:s");
	$title = StripHTMLSimple($title);
	//$fullname = StripHTMLSimple($fullname);
	$email = StripHTMLSimple($email);
	$messagecount = 0;

	// tidy up user name
	//$fullname = trim($fullname);
	
	// See if the thread has already been created
	$query = "SELECT * FROM $g_ThreadListTableName";

	$result = mysql_query($query)
	    or DBError("Failed to query the thread list");
	
	// Examine each row looking for a match
	while ($line = mysql_fetch_row($result)) 
	{
		// if the title and the author match, assume it is a duplicate
		if (($line[1] == $title) and ($line[2]==$author_id))
			return $line[0];
	}
	
	// We did not find the thread, so start a new one
	$query = "INSERT INTO $g_ThreadListTableName VALUES (NULL, '$title', '$author_id', '$email', '$messagecount', '$datetime', '$datetime')";
	echo $query;
	$result = mysql_query($query)
	    or DBError("Failed to add a new thread");
	    
	return mysql_insert_id();
}

function CreateNewMessage($msg, $author_id, $email, $thread)
{
	global $g_MessageListTableName, $g_ThreadListTableName;

	// Performing SQL query
	$datetime = date("Y-m-d H:i:s");
	$msg = StripHTML($msg);
	//$fullname = StripHTMLSimple($fullname);
	$email = StripHTMLSimple($email);

	// tidy up user name
	//$fullname = trim($fullname);
	
	// See if the thread has already been created
	$query = "SELECT * FROM $g_MessageListTableName WHERE ThreadID = $thread";
	$result = mysql_query($query)
	    or DBError("Failed to search the database for threads");

	// Examine each row looking for a match
	while ($line = mysql_fetch_row($result)) 
	{
		// if the message and the author match, assume it is a duplicate
		if (($line[1] == $msg) and ($line[2]==$author_id))
			return;
	}

	// was not a duplicate, so add it
	$query = "INSERT INTO $g_MessageListTableName VALUES (NULL, '$msg', '$author_id', '$email', '$datetime', '$thread')";
	$result = mysql_query($query)
	    or DBError("Failed to add a new message");
	    
	// update the thread message count
	$query = "UPDATE $g_ThreadListTableName set Posts=Posts+1 WHERE ThreadID = $thread";
	$result = mysql_query($query)
	    or DBError("Failed to update the posts counter");
	    
	// update last posted date
	$query = "UPDATE $g_ThreadListTableName set LastPostedTo='$datetime' WHERE ThreadID = $thread";
	$result = mysql_query($query)
	    or DBError("Failed to update the last posted to date");
	    
	return GetPostsCount($thread);
}

function GetPostsCount($thread)
{
	// find out how many posts there now are
	global $g_ThreadListTableName;
	
	$query = "SELECT Posts FROM $g_ThreadListTableName WHERE ThreadID = $thread";
	$result = mysql_query($query)
		or DBError("Failed to find out how many posts there are");

	if( mysql_num_rows($result) == 1 )
	{
		$line = mysql_fetch_row($result);
		return $line[0];
	}
		
	return 0;
}

function ShowNewTopicForm($pageTitle, $title, $message, $error)
{
	global $g_ThisPage, $_COOKIE;
	$cookie_fullname = $_COOKIE['cookie_fullname'];
	$cookie_email = $_COOKIE['cookie_email'];
	$cookie_website = $_COOKIE['cookie_website'];
	
	PageHeader();
	PrintTitle($pageTitle);
	if( strlen($error) > 0 )
		PrintError($error);	
	?>
	<form method="post" action="<?php print $g_ThisPage; ?>">
	  <div align="left">
	    <table border="0" cellpadding="0" cellspacing="0" width="440">
	      <tr>
	        <td width="100" valign="top" align="left">Title<span class="requiredWarning"> * </span> <b>:</b> </td>
	        <td width="340" valign="top" align="left"><input class="formBox" type="text" name="title" size="51" value="<?php print "$title" ?>" /></td>
	      </tr>
	      <tr>
	        <td valign="top" align="left">Message<span class="requiredWarning"> * </span> <b>:</b> </td>
	        <td valign="top" align="left"><textarea class="formBox" rows="7" name="msg" cols="43"><?php print "$message" ?></textarea></td>
	      </tr>
	      <tr>
                <td valign="top" align="left"></td>
                <td valign="top" align="left"><span class="subtle">Do not use HTML tags. Surround URLs with spaces.</span></td>
              </tr>
	      <tr>
	        <td valign="top" align="left"></td>
	        <td valign="top" align="left">&nbsp;</td>
	      </tr>
	      <tr>
	        <!--<td valign="top" align="left">Full Name<span class="requiredWarning">*</span>:</td>-->
	        <td valign="top" align="left"><input class="formBox" type="hidden" name="fullname" value="<?php print $_SESSION['FIRST_NAME']." ".$_SESSION['LAST_NAME']; ?>" size="64" /></td>
	      </tr>
	      <tr>
	       <!-- <td valign="top" align="left">E-mail:</td>-->
	        <td valign="top" align="left"><input class="formBox" type="hidden" name="email" value="<?php print $_SESSION['EMAIL_ID']; ?>" size="64" /></td>
	      </tr>
	      <tr>
                <td valign="top" align="left"></td>
                <td valign="top" align="left"><span class="requiredWarning"><b>*</span> - Required for processing</b></td>
              </tr>
	      <tr>
                <td valign="top" align="left"></td>
                <td valign="top" align="left">&nbsp;</td>
              </tr>
	      <tr>
	        <td valign="top" align="left"></td>
	        <td valign="top" align="left"><input type="submit" value="Post Message" /></td>
	      </tr>
	    </table>
	  </div>
	  <input type="hidden" name="cmd" value="submitnew" />
	</form>
	<?php
	
	PrintStandardFooter("");
}

function ShowReplyForm($msg, $thread, $error)
{
	global $g_ThisPage, $_COOKIE;
	$cookie_fullname = $_COOKIE['cookie_fullname'];
	$cookie_email = $_COOKIE['cookie_email'];
	$cookie_website = $_COOKIE['cookie_website'];

	if( strlen($error) > 0 )
		PrintError($error);
	?>
	<form method="post" action="<?php print "$g_ThisPage" ?>">
	  <div align="left">
	    <table border="0" cellpadding="0" cellspacing="0" width="440">
	      <tr>
	        <td valign="top" align="left">Message<span class="requiredWarning"> * </span> <b>:</b> </td>
	        <td valign="top" align="left"><textarea class="formBox" rows="7" name="msg" cols="43"><?php print "$msg" ?></textarea></td>
	      </tr>
	      <tr>
                <td valign="top" align="left"></td>
                <td valign="top" align="left"><span class="subtle">Do not use HTML tags. Surround URLs with spaces.</span></td>
              </tr>
	      <tr>
	        <td valign="top" align="left"></td>
	        <td valign="top" align="left">&nbsp;</td>
	      </tr>
	      <tr>
	        <!--<td valign="top" align="left">Full Name<span class="requiredWarning">*</span>:</td>-->
	        <td valign="top" align="left"><input class="formBox" type="hidden" name="fullname" value="<?php print $_SESSION['FIRST_NAME']." ".$_SESSION['LAST_NAME']; ?>" size="64" /></td>
	      </tr>
	      <tr>
	        <!--<td valign="top" align="left">E-mail:</td>-->
	        <td valign="top" align="left"><input class="formBox" type="hidden" name="email" value="<?php print $_SESSION['EMAIL_ID']; ?>" size="64" /></td>
	      </tr>
	      <tr>
                <td valign="top" align="left"></td>
                <td valign="top" align="left"><span class="requiredWarning"><b>*</span> - Required for processing</b></td>
              </tr>
	      <tr>
                <td valign="top" align="left"></td>
                <td valign="top" align="left">&nbsp;</td>
              </tr>
	      <tr>
	        <td valign="top" align="left"></td>
	        <td valign="top" align="left"><input type="submit" value="Post Reply" /></td>
	      </tr>
	    </table>
	  </div>
	  <input type="hidden" name="thread" value="<?php print "$thread" ?>" />
	  <input type="hidden" name="cmd" value="submitreply" />
	</form>
	<?php
	
	PrintStandardFooter("");
}

function ShowNewMailForm($message, $msg, $error)
{
	global $g_ThisPage, $_COOKIE, $g_MessageListTableName, $g_ThreadListTableName;
	$cookie_fullname = $_COOKIE['cookie_fullname'];
	$cookie_email = $_COOKIE['cookie_email'];
	$cookie_website = $_COOKIE['cookie_website'];
	
	$reply_to = "";
	$subject = "";
	
	$query = "SELECT $g_MessageListTableName.Author_id,$g_ThreadListTableName.Title from $g_MessageListTableName LEFT JOIN $g_ThreadListTableName ON $g_MessageListTableName.ThreadID = $g_ThreadListTableName.ThreadID WHERE $g_MessageListTableName.MessageID = $message";
	$result = mysql_query($query)
	    or DBError("Failed while accessing thread information from the database");
	    
	if( mysql_num_rows($result) == 1 )
	{
		$line = mysql_fetch_row($result);
		$author_name = get_author_name($line[0]);
		$reply_to = $author_name['first_name']." ".$author_name['last_name'];
		$subject = "$line[1]";
	}
	else
	{
		PageHeader();
		PrintError("Unable to find message $message. The topic may have been deleted.");
		PrintStandardFooter("");
		return;
	}
	
	PageHeader();
	if( strlen($error) > 0 )
		PrintError($error);
		
	?>
	<form method="post" action="<?php print "$g_ThisPage" ?>">
	  <div align="left">
	    <table border="0" cellpadding="0" cellspacing="0" width="440">
	      <tr>
	        <td valign="top" align="left">Reply To:</td>
	        <td valign="top" align="left"><strong><?php print "$reply_to" ?></strong></td>
	      </tr>
	      <tr>
	        <td valign="top" align="left">Subject:</td>
	        <td valign="top" align="left"><strong><?php print "$subject" ?></strong></td>
	      </tr>
	      <tr>
	        <td valign="top" align="left"></td>
	        <td valign="top" align="left">&nbsp;</td>
	      </tr>
	      <tr>
	        <td valign="top" align="left">Message<span class="requiredWarning">*</span>:</td>
	        <td valign="top" align="left"><textarea class="formBox" rows="10" name="msg" cols="43"><?php print "$msg" ?></textarea></td>
	      </tr>
	      <tr>
                <td valign="top" align="left"></td>
                <td valign="top" align="left"><span class="subtle">Do not use HTML tags. Surround URLs with spaces.</span></td>
              </tr>
	      <tr>
	        <td valign="top" align="left"></td>
	        <td valign="top" align="left">&nbsp;</td>
	      </tr>
	      <tr>
	        <td valign="top" align="left">Full Name<span class="requiredWarning">*</span>:</td>
	        <td valign="top" align="left"><input class="formBox" type="text" name="fullname" value="<?php print "$cookie_fullname" ?>" size="64" /></td>
	      </tr>
	      <tr>
	        <td valign="top" align="left">E-mail<span class="requiredWarning">*</span>:</td>
	        <td valign="top" align="left"><input class="formBox" type="text" name="email" value="<?php print "$cookie_email" ?>" size="64" /></td>
	      </tr>
	      <tr>
                <td valign="top" align="left"></td>
                <td valign="top" align="left"><span class="requiredWarning">* - Required for processing</span></td>
              </tr>
	      <tr>
                <td valign="top" align="left"></td>
                <td valign="top" align="left">&nbsp;</td>
              </tr>
	      <tr>
	        <td valign="top" align="left"></td>
	        <td valign="top" align="left"><input type="submit" value="Send Email" /></td>
	      </tr>
	    </table>
	  </div>
	  <input type="hidden" name="message" value="<?php print "$message" ?>" />
	  <input type="hidden" name="cmd" value="submitnewmail" />
	</form>
	<?php
	
	PrintStandardFooter("");
}

function SendMail2( $toname, $toaddress, $fromname, $fromaddress, $subject, $message )
{
	$MP = "/usr/sbin/sendmail -t"; 
	$spec_envelope = 1; 
	// Access Sendmail
	// Conditionally match envelope address
	if($spec_envelope)
	{
		$MP .= " -f $fromaddress";
	}
	$fd = popen($MP,"w"); 
	fputs($fd, "To: $toname <$toaddress>\n"); 
	fputs($fd, "From: $fromname <$fromaddress>\n");
	fputs($fd, "Subject: $subject\n"); 
	fputs($fd, "X-Mailer: PHP4\n"); 
	fputs($fd, $message); 
	pclose($fd);
}

function SendEmailToPoster( $message, $msg, $fullname, $email )
{
	global $g_Title, $g_URL, $g_ThisPage, $g_ContactEmail, $g_MessageListTableName, $g_ThreadListTableName;
	
	$query = "SELECT $g_MessageListTableName.Author_id,$g_MessageListTableName.Email,$g_ThreadListTableName.Title,$g_MessageListTableName.ThreadID from $g_MessageListTableName LEFT JOIN $g_ThreadListTableName ON $g_MessageListTableName.ThreadID = $g_ThreadListTableName.ThreadID WHERE $g_MessageListTableName.MessageID = $message";
	$result = mysql_query($query)
	    or DBError("Failed to find poster information from the database");
	    
	if( mysql_num_rows($result) == 1 )
	{
		$line = mysql_fetch_row($result);
		
		$msg .= "\n\n";
		$msg .= "-------------------------------------------------\n\n";
		$msg .= "This message was sent on behalf of $email, from \"$g_Title\" in reply to your posting:\n\n";
		$msg .= "$g_URL";
		$msg .= "$g_ThisPage?cmd=show&thread=$line[3]\n\n";
		$msg .= "Your email address is never revealed to the sender. Please report abuse to $g_ContactEmail.\n"; 
		
		$author_name = get_author_name($line[0]);
		SendMail2( $author_name['first_name']." ".$author_name['last_name'], $line[1], $fullname, $email, $line[2], $msg );
		return $line[3];
	}
	
	return 0;
}
