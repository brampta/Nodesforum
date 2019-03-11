<?php



$_nodesforum_title='profile options - '.$_nodesforum_forum_name;
if($_nodesforum_use_external_user_system=='no' && isset($_SESSION[$_nodesforum_external_user_system_uniqueID_session_name]))
{
	$my_uniqueID=$_SESSION[$_nodesforum_external_user_system_uniqueID_session_name];
	$_nodesforum_po_public_name_taken=0;
	$_nodesforum_po_public_name_taken_public_name='';
	$_nodesforum_po_public_name_changed=0;
	if(isset($_POST['_nodesforum_submit_change_public_name']) && $_POST['_nodesforum_change_public_name']!='')
	{
		$addslashed_public_name=_nodesforum_my_custom_addslashes($_POST['_nodesforum_change_public_name']);
		$result = mysql_query("SELECT uniqueID, public_name FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_users WHERE public_name = '$addslashed_public_name'");
		while($row = mysql_fetch_array($result))
		{
			$_nodesforum_po_public_name_taken=$row['uniqueID'];
			$_nodesforum_po_public_name_taken_public_name=$row['public_name'];
		}
		if($_nodesforum_po_public_name_taken==0)
		{
			mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_users SET public_name = '$addslashed_public_name' WHERE uniqueID = '$my_uniqueID'");
			$_nodesforum_po_public_name_changed=1;
		}
	}
	$_nodesforum_po_password_oldbad=0;
	$_nodesforum_po_password_newshort=0;
	$_nodesforum_po_password_retypebad=0;
	$_nodesforum_po_password_changed=0;
	if(isset($_POST['_nodesforum_submit_change_password']) && $_POST['_nodesforum_old_password']!='' && $_POST['_nodesforum_new_password1']!='' && $_POST['_nodesforum_new_password2']!='')
	{
		$error=0;
		$addslashed_old_password=_nodesforum_my_custom_addslashes($_POST['_nodesforum_old_password']);
		$addslashed_new_password1=_nodesforum_my_custom_addslashes($_POST['_nodesforum_new_password1']);
		$addslashed_new_password2=_nodesforum_my_custom_addslashes($_POST['_nodesforum_new_password2']);
		$old_pass_is_good=0;
		$result = mysql_query("SELECT uniqueID FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_users WHERE uniqueID = '$my_uniqueID' && password = AES_ENCRYPT('$addslashed_old_password','$addslashed_old_password')");
		while($row = mysql_fetch_array($result))
		{$old_pass_is_good=1;}
		if($old_pass_is_good==0)
		{$error=1; $_nodesforum_po_password_oldbad=1;}
		if(strlen($_POST['_nodesforum_new_password1'])<$_nodesforum_minimum_password_length)
		{$error=1; $_nodesforum_po_password_newshort=1;}
		if($_POST['_nodesforum_new_password1']!=$_POST['_nodesforum_new_password2'])
		{$error=1; $_nodesforum_po_password_retypebad=1;}
		if($error==0)
		{
			mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_users SET password = AES_ENCRYPT('$addslashed_new_password1','$addslashed_new_password1') WHERE uniqueID = '$my_uniqueID'");
			$_POST['_nodesforum_old_password']=$_POST['_nodesforum_new_password1'];
			$_nodesforum_po_password_changed=1;
		}
	}
	$_nodesforum_po_email_taken=0;
	$_nodesforum_po_email_validation_send=0;
	$_nodesforum_po_email_changed=0;
	if(isset($_POST['_nodesforum_submit_change_email']) && $_POST['_nodesforum_change_email']!='')
	{
		$error=0;
		$addslashed_new_email=_nodesforum_my_custom_addslashes($_POST['_nodesforum_change_email']);
		$result = mysql_query("SELECT uniqueID, public_name FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_users WHERE email = AES_ENCRYPT('$addslashed_new_email','$addslashed_new_email')");
		while($row = mysql_fetch_array($result))
		{$error=1; $_nodesforum_po_email_taken=1;}
		if($error==0)
		{
			if($_nodesforum_validate_email=='yes')
			{
				//create a validation key
				$validation_key=rand(111111,999999).rand(111111,999999).rand(111111,999999).rand(111111,999999).rand(111111,999999);
				//delete older than 24h days from _nodesforum_newemails
				$oldest_acceptable_time=$nowtime-(24*3600);
				mysql_query("DELETE FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_newemails WHERE time < $oldest_acceptable_time");
				//add to _nodesforum_newemails
				mysql_query("INSERT INTO ".$_nodesforum_db_table_name_modifier."_nodesforum_newemails (email, uniqueID, validation_key, time) VALUE (AES_ENCRYPT('$addslashed_new_email','$addslashed_new_email'), '$my_uniqueID', '$validation_key', '$nowtime')");
				//send validation mail
				$to=$_POST['_nodesforum_change_email'];
				$subject=$_nodesforum_forum_name.' email validification';
				$result = mysql_query("SELECT public_name FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_users WHERE uniqueID = '$my_uniqueID'");
				while($row = mysql_fetch_array($result))
				{$_nodesforum_remember_public_name=$row['public_name'];}
				$message='Hi '.$_nodesforum_remember_public_name.' and thank you for using '.$_nodesforum_forum_name_the_or_not.' '.$_nodesforum_forum_name.'. You have requested to change the email address associated with your profile '.$_nodesforum_forum_name_at_or_at_the.' '.$_nodesforum_forum_name.' and email addresses must be validated '.$_nodesforum_forum_name_at_or_at_the.' '.$_nodesforum_forum_name.'. Please click the following link to validate your new email address and this will complete the email address change procedure:
				'.$_nodesforum_instance_asolute_URL.'?_nodesforum_val2=shiz&u='.$my_uniqueID.'&key='.$validation_key.'&em='.urlencode($_POST['_nodesforum_change_email']).'

				'.$_POST['_nodesforum_change_email'].' will become the new email address associated with your account '.$_nodesforum_forum_name_at_or_at_the.' '.$_nodesforum_forum_name.' once you will have clicked the validation link. note that you have 24h from the moment where this email was sent to validate the email.

				'.$_nodesforum_forum_name.'
				'.$_nodesforum_instance_asolute_URL.'
				
				';
				$headers = "From: ".$_nodesforum_validate_email_address_from;
				mail($to,$subject,$message,$headers);
				$_nodesforum_po_email_validation_send=1;
			}
			else
			{
				mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_users SET email = '$addslashed_new_email' WHERE uniqueID = '$my_uniqueID'");
				$_nodesforum_po_email_changed=1;
			}
		}
	}
	$result = mysql_query("SELECT public_name FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_users WHERE uniqueID = '$my_uniqueID'");
	while($row = mysql_fetch_array($result))
	{$_nodesforum_remember_public_name=$row['public_name'];}
}
$_nodesforum_youarehere='<img src="'.$_nodesforum_home_icon.'" style="vertical-align:text-bottom;border:none;" /> <a href="?">root</a> => <img src="'.$_nodesforum_tool_icon.'" style="vertical-align:text-bottom;border:none;" /> profile options';

?>
