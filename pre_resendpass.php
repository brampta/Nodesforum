<?php


$_nodesforum_img_ver_invalid=0;
$_nodesforum_resendpass_suxxess=0;
$_nodesforum_email_found=0;
$_nodesforum_email_not_found=0;

$error=0;
$addslashed_email=_nodesforum_my_custom_addslashes($_POST['_nodesforum_resend_email']);
if($_nodesforum_image_verification_on_forgotten_pass=='yes')
{
	if(md5($_POST['_nodesforum_numbaz'])!=$_SESSION['img_ver_forgotpass'])
	{$error=1; $_nodesforum_img_ver_invalid=1;}
	unset($_SESSION['img_ver_forgotpass']);
}
if($error==0)
{
	$result = mysql_query("SELECT uniqueID, public_name FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_users WHERE email = AES_ENCRYPT('$addslashed_email','$addslashed_email')");
	while($row = mysql_fetch_array($result))
	{
		$_nodesforum_email_found=1;

		$this_uniqueID=$row['uniqueID'];
		$addslashed_uniqueID=mysql_real_escape_string($row['uniqueID']);
		$this_public_name=$row['public_name'];
		$addslashed_public_name=mysql_real_escape_string($row['public_name']);


		//generate random key
		$key=rand(111111111,999999999).rand(111111111,999999999).rand(111111111,999999999).rand(111111111,999999999);

		//store reset password request in _nodesforum_pss_rst_req
		mysql_query("INSERT INTO ".$_nodesforum_db_table_name_modifier."_nodesforum_pss_rst_req (email, uniqueID, request_key, time) VALUES (AES_ENCRYPT('$addslashed_email','$addslashed_email'),'$addslashed_uniqueID',$key,$nowtime)");



		//email link with key to confirm the request
		$to=$_POST['_nodesforum_resend_email'];
		$subject=$_nodesforum_forum_name.' password reset request';
		$message='Hi '.$this_public_name.' there was a request to have your password reset '.$_nodesforum_forum_name_at_or_at_the.' '.$_nodesforum_forum_name.'.
			
			click the following link to reset your password '.$_nodesforum_forum_name_at_or_at_the.' '.$_nodesforum_forum_name.':

			'.$_nodesforum_instance_asolute_URL.'?_nodesforum_reset_password=1&u='.$this_uniqueID.'&key='.$key.'&em='.urlencode($_POST['_nodesforum_resend_email']).'


			note that this link is only good for 24 hours since the time the message was sent and for only one time.

		
			'.$_nodesforum_forum_name.'
			'.$_nodesforum_instance_asolute_URL.'
	
			';
		//$headers = "From: ".$_nodesforum_validate_resend_password_from;
		//mail($to,$subject,$message,$headers);
		nodesforum_send_mail($to, null, $_nodesforum_validate_resend_password_from, null, $subject, $message, null);

		$_nodesforum_resendpass_suxxess=1;
	}


	if($_nodesforum_email_found==0)
	{$_nodesforum_email_not_found=1;}
	
}

?>
