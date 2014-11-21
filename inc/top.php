<?php require_once('common_inc.php'); ?>
<?php require_once('func/admin_func.php'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/bg_top.css" rel="stylesheet" type="text/css" />
<title>NEI - Network Of Engineering Institutions</title>

</head>
<script type="text/javascript">
    function alternate(ID){
      if(document.getElementsByTagName){ 
        var table = document.getElementById('table-style');  
        var rows = table.getElementsByTagName("tr");
        for(i = 0; i < rows.length; i++){ 
          if(i % 2 == 0){ 
            rows[i].className = "even"; 
          }
		  else{
            rows[i].className = "odd";  
          }  
        } 
      }  
    } 
</script>

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

<body style="min-height:100%;">
<center>
	<div align="center">
		<div id="body">
		  <div id="header">
				<div style="width:477px; float:left; padding:36px 0 20px 0" align="right"><a href="../index.php"><img src="../images/logo.gif" alt="" /></a></div>
                
				<div class="clear"><img src="../images/spacer.gif" alt="" /></div>
                
                <div id="nav">
					<ul>
						<ul id="sddm">
                    <li style="padding-left:86px; background:none"></li> 	
                        <li><a href="../index.php">Home</a></li>
                        <li><a href="#" 
                            onmouseover="mopen('m2')" 
                            onmouseout="mclosetime()">Institute</a>
                            <div id="m2" 
                                onmouseover="mcancelclosetime()" 
                                onmouseout="mclosetime()">
                            <a href="../institute/about_nei.php">About NEI</a>
                            <a href="../institute/vision.php">Vision</a>
                            <a href="../institute/member_colleges.php">Member Colleges</a>
                            <a href="../institute/governing_council.php">Governing Council</a>
                            </div>
                        </li>
                        <li><a href="#" 
                            onmouseover="mopen('m3')" 
                            onmouseout="mclosetime()">Members</a>
                            <div id="m3" 
                                onmouseover="mcancelclosetime()" 
                                onmouseout="mclosetime()">
                            <a href="../member/expert_panel.php">Expert Panel</a>
                            <a href="../member/member_list.php?type=phd">Phd students</a>
                            <a href="../member/member_list.php?type=workshop">Workshop Students</a>
                            <a href="../member/professors.php">Professors</a>
                            </div>
                        </li>
                        <li><a href="#" 
                            onmouseover="mopen('m4')" 
                            onmouseout="mclosetime()">Programs</a>
                            <div id="m4" 
                                onmouseover="mcancelclosetime()" 
                                onmouseout="mclosetime()">
                            <a href="../courses/phd_ps.php">PHD Program Structure</a>
                            <a href="../courses/workshop.php">Workshop Series</a>
                            <a href="../courses/regular.php">Courses Offered</a>
                            </div>
                        </li>
                        <li><a href="#" 
                            onmouseover="mopen('m5')" 
                            onmouseout="mclosetime()">Workshop</a>
                            <div id="m5" 
                                onmouseover="mcancelclosetime()" 
                                onmouseout="mclosetime()">
                            <a href="../workshop/workshopdetails.php">Upcoming Workshops</a>
                            <a href="../workshop/reviews.php">Workshop Reviews</a>
                            
                            </div></li>
                        <li><a href="#" 
                            onmouseover="mopen('m6')" 
                            onmouseout="mclosetime()">Research</a>
                            <div id="m6" 
                                onmouseover="mcancelclosetime()" 
                                onmouseout="mclosetime()">
                            <a href="../research/research_nei.php">Research at NEI</a>
                            <a href="../research/research_groups.php">Research Groups</a>
                            <a href="../research/publications.php">Recent Publication</a>
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
                            <a href=\"../discussion/Discuss.php\">Discussion Forum</a>
                            <a href=\"../review/review.php\">Review Forum</a>
                            </div>
                        	</li>";
						}
						?>
                        <?php
						 	if(!isset($_SESSION['ID']))
								echo "<li><a href=\"../login.php\">  Login </a></li>";
							else
							{
								?>
								<li><a href="../member/Profile.php?id=<?php echo $_SESSION['ID'];?>"
								onmouseover="mopen('m8')" 
								onmouseout=\"mclosetime()">Account</a>
								<div id="m8" 
									onmouseover="mcancelclosetime()" 
									onmouseout="mclosetime()">
								<a href="../member/Profile.php?id=<?php echo $_SESSION['ID'];?>">Edit Profile</a>
								<a href="../login.php"> Logout </a>
								</div>
							</li>
                            <?php
							}
						?>
					</ul>
                    </div>