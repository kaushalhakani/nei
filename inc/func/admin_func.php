<?php
function verify_login()
{
	global $db;
	$email = $_POST['email'];
	$password = $_POST["password"]; 
	$sql = "select member_id, first_name,last_name, email from tbl_member where email = '$email' and password = '$password'";
	$data = $db->fetch_all_array($sql);
	if($data)
	{
		$_SESSION['ID'] = $data[0]['member_id'];
		$_SESSION['FIRST_NAME'] = $data[0]['first_name'];
		$_SESSION['LAST_NAME'] = $data[0]['last_name'];
		$_SESSION['EMAIL_ID'] = $data[0]['email'];
		return 1;
	}
	return 0;
}

function createRandomPassword() { 

    $chars = "abcdefghijkmnopqrstuvwxyz023456789"; 
    srand((double)microtime()*1000000); 
    $i = 0; 
    $pass = '' ; 

    while ($i <= 7) { 
        $num = rand() % 33; 
        $tmp = substr($chars, $num, 1); 
        $pass = $pass . $tmp; 
        $i++; 
    } 

    return $pass; 

} 

function password_reset()
{
	global $db;
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$email = $_POST['email']; 
	$sql = "select member_id from tbl_member where first_name = '$first_name' and last_name = '$last_name' and email = '$email'";
	$data = $db->fetch_all_array($sql);
	if($data)
	{
		forgot_password($email);
		return 1;
	}
	return 0;
}

function email_password($email,$new_password)
{
	global $db;
	
	$URL = /*$res[0]["vSiteUrl"]*/"http://localhost/nei/login.php";
	
	error_reporting(E_STRICT);
	
	date_default_timezone_set('America/Toronto');
	
	require_once('../class/class.phpmailer.php');

	
	$mail             = new PHPMailer();
	
	$body             = "Password :    ".$fpass;
	
	
	$mail->IsSMTP(); 
	
	$mail->SMTPDebug  = 1;                     
											   
										   
	$mail->SMTPAuth   = true;                 
	$mail->SMTPSecure = "ssl";                
	$mail->Host       = "10.100.56.27";      
	$mail->Port       = 465;                
	$mail->Username   = "200901151@daiict.ac.in";  // GMAIL username
	$mail->Password   = "vimepoka";            // GMAIL password
	
	$mail->SetFrom('200901151@daiict.ac.in', 'ADMIN - NEI');
	
	$mail->AddReplyTo("200901151@daiict.ac.in","ADMIN - NEI");
	
	$mail->Subject    = "NEI Password Reset";
	
	$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; 
	
	$mail->MsgHTML($body);
	
	$address = $email;
	$mail->AddAddress($address, "YOU");



	if(!$mail->Send())
	  	echo "Mailer Error: " . $mail->ErrorInfo;
	else
	  	header("Location: login.php");
}

function forgot_password($email)
{
	global $db;
	
	$password = createRandomPassword();
			
	if(email_password($email,$password))
	{	
		$sql = "UPDATE tbl_member SET password='$password' WHERE email='$email'";
		$query = $db->query($sql);
		return 'pwsemailed';
	}
	else
	{	
		return 'erremail' ;
	}
}
?>