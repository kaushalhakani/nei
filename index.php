<?php require_once('inc/common_inc.php'); ?>
<?php require_once('inc/func/admin_func.php'); ?>
<?php require_once('inc/func/member_func.php'); ?>
<?php 

$result = get_limited_list("tbl_workshop","1 ORDER BY start_date DESC","*",0,3);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/bg_index.css" rel="stylesheet" type="text/css" />
<title>NEI - Network Of Engineering Institutions</title>
</head>

<script type="text/javascript">
var timeout	= 500;
var closetimer	= 0;
var ddmenuitem	= 0;

// open hidden layer
function mopen(id)
{	
	// cancel close timer
	mcancelclosetime();

	// close old layer
	if(ddmenuitem) ddmenuitem.style.visibility = 'hidden';

	// get new layer and show it
	ddmenuitem = document.getElementById(id);
	ddmenuitem.style.visibility = 'visible';

}
// close showed layer
function mclose()
{
	if(ddmenuitem) ddmenuitem.style.visibility = 'hidden';
}

// go close timer
function mclosetime()
{
	closetimer = window.setTimeout(mclose, timeout);
}

// cancel close timer
function mcancelclosetime()
{
	if(closetimer)
	{
		window.clearTimeout(closetimer);
		closetimer = null;
	}
}

// close layer when click-out
document.onclick = mclose; 
</script>

<body>
<center>
	<div align="center">
		<div id="body">
		  <div id="header">
				<div style="width:477px; float:left; padding:36px 0 20px 0" align="right"><a href="#"><img src="images/logo.gif" alt="" /></a></div>
				<div class="clear"><img src="images/spacer.gif" alt="" /></div>
                
                <div id="nav">
					<ul>
						<ul id="sddm">
                    <li style="padding-left:86px; background:none"></li> 	
                        <li><a href="index.php">Home</a></li>
                        <li><a href="#" 
                            onmouseover="mopen('m2')" 
                            onmouseout="mclosetime()">Institute</a>
                            <div id="m2" 
                                onmouseover="mcancelclosetime()" 
                                onmouseout="mclosetime()">
                            <a href="institute/about_nei.php">About NEI</a>
                            <a href="institute/vision.php">Vision</a>
                            <a href="institute/member_colleges.php">Member Colleges</a>
                            <a href="institute/governing_council.php">Governing Council</a>
                            </div>
                        </li>
                        <li><a href="#" 
                            onmouseover="mopen('m3')" 
                            onmouseout="mclosetime()">Members</a>
                            <div id="m3" 
                                onmouseover="mcancelclosetime()" 
                                onmouseout="mclosetime()">
                            <a href="member/expert_panel.php">Expert Panel</a>
                            <a href="member/member_list.php?type=phd">Phd students</a>
                            <a href="member/member_list.php?type=workshop">Workshop Students</a>
                            <a href="member/professors.php">Professors</a>
                            </div>
                        </li>
                       <li><a href="#" 
                            onmouseover="mopen('m4')" 
                            onmouseout="mclosetime()">Programs</a>
                            <div id="m4" 
                                onmouseover="mcancelclosetime()" 
                                onmouseout="mclosetime()">
                            <a href="courses/phd_ps.php">PHD Program Structure</a>
                            <a href="courses/workshop.php">Workshop Series</a>
                            <a href="courses/regular.php">Courses Offered</a>
                            </div>
                        </li>
                        <li><a href="#" 
                            onmouseover="mopen('m5')" 
                            onmouseout="mclosetime()">Workshop</a>
                            <div id="m5" 
                                onmouseover="mcancelclosetime()" 
                                onmouseout="mclosetime()">
                            <a href="workshop/workshopdetails.php">Upcoming Workshops</a>
                            <a href="workshop/reviews.php">Workshop Reviews</a>
                            
                            </div></li>
                        <li><a href="#" 
                            onmouseover="mopen('m6')" 
                            onmouseout="mclosetime()">Research</a>
                            <div id="m6" 
                                onmouseover="mcancelclosetime()" 
                                onmouseout="mclosetime()">
                            <a href="research/research_nei.php">Research at NEI</a>
	
                            <a href="research/research_groups.php">Research Groups</a>
                            <a href="research/publications.php">Recent Publication</a>
                            </div>
                        </li>
                        <?php
						if(isset($_SESSION['ID']))
                        {
							echo "<li><a href=\"#\" 
                            onmouseover=\"mopen('m7')\" 
                            onmouseout=\"mclosetime()\">Forum</a>
                            <div id=\"m7\" 
                                onmouseover=\"mcancelclosetime()\" 
                                onmouseout=\"mclosetime()\">
                            <a href=\"discussion/Discuss.php\">Discussion Forum</a>
                            <a href=\"review/review.php\">Review Forum</a>
                            </div>
                        	</li>";
						}
						?>
                    	<?php
						 	if(!isset($_SESSION['ID']))
								echo "<li><a href=\"login.php\">  Login </a></li>";
							else
							{
								?>
								<li><a href="member/Profile.php?id=<?php echo $_SESSION['ID'];?>"
								onmouseover="mopen('m8')" 
								onmouseout=\"mclosetime()">Account</a>
								<div id="m8" 
									onmouseover="mcancelclosetime()" 
									onmouseout="mclosetime()">
								<a href="member/Profile.php?id=<?php echo $_SESSION['ID'];?>">Edit Profile</a>
								<a href="login.php"> Logout </a>
								</div>
							</li>
                            <?php
							}
						?>
					</ul>
                    </div>

				<div class="clear"><img src="images/spacer.gif" alt="" /></div>
				<div style="font-size:0px"><img src="images/big_img.jpg" alt="" /></div>
				<div style="padding:10px 29px 0 21px">
					<div style="width:311px; float:left; background:url(images/left_bg1.gif) repeat-x left top">
						<div style="font-size:0px"><img src="images/left_top.gif" alt="" /></div>
						<div style="padding:0 34px 0 34px">
							<div style="font-size:14px; color:#343433; text-transform:uppercase; font-weight:bold; padding:25px 0 15px 0">Lates News &amp; Events</div>
                         <?php
						 for($i = 0; $i < 3 ; $i++)
						 {
							$temp = $result[$i];
							$temp_date = strtotime($result[$i]['start_date']);
							echo "<b>".date("d-F",$temp_date)." - ".$temp['workshop_title']."</b><br />".$temp['workshop_details']."<br />&nbsp;<br />";
						 }
						 ?>
						</div>					</div>
					<div style="width:590px; float:right">
						<div style="font-size:24px; color:#343433; padding-top:45px"><strong>Welcome NEIs website</strong></div>
						<div style="font-size:16px; color:#2f2d2d; padding-top:10px"><strong>Introduction</strong></div>
						<img src="images/spacer.gif" alt="" align="left" style="padding:0 28px 25px 0" /><div align="justify"><br />
The Network Of Engineering Institutions (NEI) has been founded with a collaborative effort of the participating institutions to promote cutting edge research in the field of VLSI for achieving indigenous chip designing and fabrication capabilities in India. The cooperative research program envisages a network of engineering colleges, universities and other institutes coupled to a networked panel of experts, who would be responsible for continous monitoring and guidance of the research program.


</div>

<div class="clear"><img src="images/spacer.gif" alt="" /></div>
					</div>
					<div class="clear" style="height:37px"><img src="images/spacer.gif" alt="" /></div>
				</div>

<div style="background:#c1c1c1; border-top:1px #FFFFFF solid" align="center">
		  <div style="padding:10px 0 6px 0"><a href="bottom_links/FAQ_senupdated.php" style="text-transform:uppercase">FAQ</a>  |   <a href="#" style="text-transform:uppercase">Achievements</a>  |   <a href="#" style="text-transform:uppercase">Forum</a>  |   <a href="bookshelf/search1.php" style="text-transform:uppercase">Bookshelf</a>  |   <a href="#" style="text-transform:uppercase">Webmasters</a>  |   <a href="#" style="text-transform:uppercase">Academic Calender</a>  |   <a href="#" style="text-transform:uppercase">contact us</a></div>
					<div style="padding-bottom:5px; font-size:11px; color:#3c3c3c">NEI     COPYRIGHT    2012 (C).   ALL    RIGHTS     RESERVED</div>
                <div title="member_images">
               	<a href="http://www.daiict.ac.in"><img src="memberlogo/DAIICT.bmp" alt="DA-IICT" height="40" title="DA-IICT"/></a>
                <a href="http://www.mitsuniversity.ac.in/"><img src="memberlogo/MODY.bmp" alt="MODY" width="40" height="40" title="MODY" /></a>
                <a href="http://www.ycce.edu/"><img src="memberlogo/YCCE.bmp" alt="YCCE" width="40" height="40" title="YCCE" /></a>
                <a href="http://www.lnmiit.ac.in/"><img src="memberlogo/LNMIIT.bmp" alt="LNMIIT" height="40" title="LNMIIT" /></a></div>
				
			</div>
</body>
</html>