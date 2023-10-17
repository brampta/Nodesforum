<?php



$_nodesforum_email_invalid=0;
$_nodesforum_email_taken=0;
$_nodesforum_password_too_short=0;
$_nodesforum_password_dont_match=0;
$_nodesforum_public_name_invalid=0;
$_nodesforum_public_name_taken=0;
$_nodesforum_img_ver_invalid=0;
$_nodesforum_register_suxxess=0;
$_nodesforum_register_suxxess_and_validated=0;


$twenyfour_hours_ago=$nowtime-(24*3600);
mysql_query("DELETE FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_users WHERE validation_key != 1 && registration_time < '$twenyfour_hours_ago'");


$error=0;
$addslashed_email=_nodesforum_my_custom_addslashes($_POST['_nodesforum_email']);
$addslashed_password=_nodesforum_my_custom_addslashes($_POST['_nodesforum_password']);
$addslashed_public_name=_nodesforum_my_custom_addslashes($_POST['_nodesforum_public_name']);
if($_POST['_nodesforum_email']=='')
{$error=1; $_nodesforum_email_invalid=1;}
if($_nodesforum_email_invalid==0)
{
	//check if this email is already registered
	$result = mysql_query("SELECT uniqueID FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_users WHERE email = AES_ENCRYPT('$addslashed_email','$addslashed_email')");
	while($row = mysql_fetch_array($result))
	{$error=1; $_nodesforum_email_taken=1;}
}
if(strlen($_POST['_nodesforum_password'])<$_nodesforum_minimum_password_length)
{$error=1; $_nodesforum_password_too_short=1;}
if($_POST['_nodesforum_password']!=$_POST['_nodesforum_password2'])
{$error=1; $_nodesforum_password_dont_match=1;}
if($_POST['_nodesforum_public_name']=='')
{$error=1; $_nodesforum_public_name_invalid=1;}
else if($_nodesforum_public_name_invalid==0)
{
	//check if this public name is already registered
	$result = mysql_query("SELECT uniqueID FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_users WHERE public_name = '$addslashed_public_name'");
	while($row = mysql_fetch_array($result))
	{$error=1; $_nodesforum_public_name_taken=1;}
}
if($_nodesforum_image_verification_on_registration=='yes')
{
	if(md5($_POST['_nodesforum_numba'])!=$_SESSION['img_ver_registro'])
	{$error=1; $_nodesforum_img_ver_invalid=1;}
}
if($error==0)
{
	$validation_key=1;
	if($_nodesforum_validate_email=='yes')
	{$validation_key=rand(111111,999999).rand(111111,999999).rand(111111,999999);}
	if(mysql_query("INSERT INTO ".$_nodesforum_db_table_name_modifier."_nodesforum_users (email, password, validation_key, public_name, registration_time) VALUES (AES_ENCRYPT('$addslashed_email','$addslashed_email'), AES_ENCRYPT('$addslashed_password','$addslashed_password'), '$validation_key', '$addslashed_public_name', '$nowtime')"))
	{
		//get userID either to login or send in email
		$retrieved_uniqueID=0;
		$result = mysql_query("SELECT uniqueID FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_users WHERE email = AES_ENCRYPT('$addslashed_email','$addslashed_email')");
		while($row = mysql_fetch_array($result))
		{$retrieved_uniqueID=$row['uniqueID'];}
		if($_nodesforum_validate_email=='yes')
		{
			$to=$_POST['_nodesforum_email'];
			$subject=$_nodesforum_forum_name.' email validation';
			$message='Hi '.$_POST['_nodesforum_public_name'].' and thank you for registering to'.$_nodesforum_forum_name_the_or_not.' '.$_nodesforum_forum_name.'. Please validate your email address by clicking the following link:
				'.$_nodesforum_instance_asolute_URL.'?_nodesforum_val=shiz&u='.$retrieved_uniqueID.'&key='.$validation_key.'&em='.urlencode($_POST['_nodesforum_email']).'

			'.$_nodesforum_forum_name.'
			'.$_nodesforum_instance_asolute_URL.'
			
			';
			//$headers = "From: ".$_nodesforum_validate_email_address_from;
			//mail($to,$subject,$message,$headers);
			nodesforum_send_mail($to, null, $_nodesforum_validate_email_address_from, null, $subject, $message, null);
			$_nodesforum_register_suxxess=1;
		}
		else
		{
			$_SESSION[$_nodesforum_external_user_system_uniqueID_session_name]=$retrieved_uniqueID;
			$_SESSION[$_nodesforum_external_user_system_loginusername_session_name]=$_POST['_nodesforum_email'];
			$_nodesforum_register_suxxess_and_validated=1;
		}
	}
}




?>
