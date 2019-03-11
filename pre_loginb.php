<?php


$_nodesforum_emailandpassworddontmatch=0;
$_nodesforum_login_notvalidated=0;
$_nodesforum_login_suxxess=0;

$error=0;
$addslashed_email=_nodesforum_my_custom_addslashes($_POST['_nodesforum_login_email']);
$addslashed_password=_nodesforum_my_custom_addslashes($_POST['_nodesforum_login_password']);
if($_POST['_nodesforum_login_email']=='' || $_POST['_nodesforum_login_password']=='')
{$error=1;}
$email_and_passwords_matching=0;
$result = mysql_query("SELECT uniqueID, validation_key FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_users WHERE email = AES_ENCRYPT('$addslashed_email','$addslashed_email') && password = AES_ENCRYPT('$addslashed_password','$addslashed_password')");
while($row = mysql_fetch_array($result))
{
	$email_and_passwords_matching=1;
	$resulting_uniqueID=$row['uniqueID'];
	$resulting_key=$row['validation_key'];
}
if($email_and_passwords_matching==0)
{$error=1; $_nodesforum_emailandpassworddontmatch=1;}
if($error==0)
{
	if($resulting_key==1)
	{
		$_SESSION[$_nodesforum_external_user_system_uniqueID_session_name]=$resulting_uniqueID;
		$_SESSION[$_nodesforum_external_user_system_loginusername_session_name]=$_POST['_nodesforum_login_email'];
		if(isset($_POST['_nodesforum_login_remember_me']))
		{
			//wants to be remembered add row in remember token and give user cookie
			$token=$resulting_uniqueID.'_'.$nowtime.'_'.rand(111111111,999999999).rand(111111111,999999999).rand(111111111,999999999).rand(111111111,999999999);
			$email_encryption_key=rand(111111111,999999999);
			$cookie_for_user=$token.':'.$email_encryption_key;
			$two_weeks_ago=$nowtime-(3600*24*14);
			mysql_query("DELETE FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_remember_tokens WHERE time < '$two_weeks_ago'");
			mysql_query("INSERT INTO ".$_nodesforum_db_table_name_modifier."_nodesforum_remember_tokens (email, uniqueID, token, time) VALUES (AES_ENCRYPT('$addslashed_email','$email_encryption_key'),'$resulting_uniqueID','$token','$nowtime')");
			setcookie($_nodesforum_db_table_name_modifier."_nodesforum_remember_token", $cookie_for_user, time()+(3600*24*14));
		}
		$_nodesforum_login_suxxess=1;
	}
	else
	{
		$_nodesforum_remember_uniqueID=$resulting_uniqueID;
		$_nodesforum_login_notvalidated=1;

		$_nodesforum_title='resend validation email - '.$_nodesforum_forum_name;
		$_nodesforum_youarehere='<img src="'.$_nodesforum_home_icon.'" style="vertical-align:text-bottom;border:none;" /> <a href="?">root</a> => <img src="'.$_nodesforum_lock_icon.'" style="vertical-align:text-bottom;border:none;" /> <a href="?_nodesforum_login">login</a> => <img src="'.$_nodesforum_home_icon.'" style="vertical-align:text-bottom;border:none;" /> resend validation email';




	}
}


?>
