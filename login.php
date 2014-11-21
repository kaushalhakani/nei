<?php require_once('inc/func/admin_func.php'); ?>
<?php require_once('inc/common_inc.php'); ?>
<?php 
if(isset($_SESSION['ID']))
	unset($_SESSION['ID']); 
?>

<?php require_once('inc/common_inc.php'); ?>
<?php require_once('inc/func/admin_func.php'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/bg_top.css" rel="stylesheet" type="text/css" />
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
                            <a href="member/phd_student.php">Phd students</a>
                            <a href="member/workshop_students.php">Workshop Students</a>
                            <a href="member/supervisors.php">Supervisors</a>
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
                        <li><a href="#">  Workshop  </a></li>
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
                        	echo "<li><a href=\"discussion/discuss.php\">  Discussion  </a></li>";
						?>
                    	<?php
							
						 	if(!isset($_SESSION['ID']))
								echo "<li><a href=\"login.php\">  Login </a></li>";
							else 
								echo "<li><a href=\"login.php\">  Logout </a></li>";
						?>
                        
                        
					</ul>
				</div><!--<div class="login_logo">-->

<section id="login_area">
  
  <div id="login_container">
  	<div class="form_title" align="center">
  	  <h3><center>LOGIN</center></h3>
  	</div>
    <div class="inner">
      <form action="login.php" method="post">
        <p>
          <label>	Username:</label>
          <input name="email" type="text" class="txtbox" id="name" value="<?php if(isset($_COOKIE['email'])) {echo $_COOKIE['email'];}?>" autofocus="autofocus"/>
        </p>
        <p>
          <label> Password :   </label>
          <input type="password" id="password" class="txtbox" name="password" value="<?php if(isset($_COOKIE['password'])) {echo $_COOKIE['password'];}?>">
        </p>
        <div class="form_text">
            <p> ( <a href="forgot_password.php">Forgot Username / Password?</a> ) </p>
            <p class="chkbox">
              <input type="checkbox" name="checkbox" id="checkbox" />
              Remember me on this computer </p>
            <div class="sep_blue"><!-- --></div>
            <p class="signin">
              <input type="submit" name="button" id="button" value="Login" class="button"/>
        </div>
      </form>
    </div>
  </div>
</section>

<?php
if(isset($_POST['email']) && isset($_POST['password']))
{
	if(verify_login())
	{
		if(isset($_POST['checkbox']) && !(isset($_COOKIE['email']) || isset($_COOKIE['password'])))
		{
			setcookie("email",$_POST['email'],time()+3600); 
			setcookie("password",$_POST['password'],time()+3600);
		}
		header("Location:index.php");
	}
}
?>
</body>
</html> 
