<?php


$_nodesforum_chpass_goodkey=0;


$addslashed_get_u=_nodesforum_my_custom_addslashes($_GET['u']);
$addslashed_get_key=_nodesforum_my_custom_addslashes($_GET['key']);
$addslashed_get_em=_nodesforum_my_custom_addslashes($_GET['em']);



//delete reset requests older than 24h
$twenyfour_hours_ago=$nowtime-(24*3600);
mysql_query("DELETE FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_pss_rst_req WHERE time < '$twenyfour_hours_ago'");



$result = mysql_query("SELECT reqID FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_pss_rst_req WHERE uniqueID = '$addslashed_get_u' && request_key = '$addslashed_get_key' && email = AES_ENCRYPT('$addslashed_get_em','$addslashed_get_em')");
while($row = mysql_fetch_array($result))
{
	$_nodesforum_val_remember_email=$_GET['em'];
	$result2 = mysql_query("SELECT public_name FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_users WHERE uniqueID = '$addslashed_get_u'");
	while($row2 = mysql_fetch_array($result2))
	{$_nodesforum_val_remember_public_name=$row2['public_name'];}



	//generate new random password
	$possible = "0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_";
	$array_of_possible_chars=str_split($possible);
	$number_of_elements_in_array=count($array_of_possible_chars);
	$numbers_of_char_in_rand_pass=16;
	$new_pass='';
	$count_steps=0;
	while($count_steps<$numbers_of_char_in_rand_pass)
	{
		$count_steps++;
		$random_charkey=rand(0,$number_of_elements_in_array-1);
		$random_char=$array_of_possible_chars[$random_charkey];
		$new_pass=$new_pass.$random_char;
	}



	//change password in users db
	mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_users SET password = AES_ENCRYPT('$new_pass','$new_pass') WHERE uniqueID = '$addslashed_get_u'");


	//email password to person
	$to=$_GET['em'];
	$subject=$_nodesforum_forum_name.' new password';
	$message='Hi '.$this_public_name.' we have just reset your password '.$_nodesforum_forum_name_at_or_at_the.' '.$_nodesforum_forum_name.'.
		
		your new password is: '.$new_pass.'

		this is not a temporary password it will be good for as long as you like but for greater security we recommend that once you have logged in with your new password, you first go to your profile options and chose a new password that you will be able to remember and that will not be written in your email (cos the ppl who run your email could read your email...). but thats up to you.

		have a good day.
		
		'.$_nodesforum_forum_name.'
		'.$_nodesforum_instance_asolute_URL.'

		';
	//$headers = "From: ".$_nodesforum_validate_resend_password_from;
	//mail($to,$subject,$message,$headers);
	send_mail($to, null, $_nodesforum_validate_resend_password_from, null, $subject, $message, null);


	//erase request key from db
	mysql_query("DELETE FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_pss_rst_req WHERE reqID = '$row[reqID]'");






	$_nodesforum_chpass_goodkey=1;

	
}



?>
