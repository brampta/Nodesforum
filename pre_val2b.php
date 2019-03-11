<?php


$_nodesforum_val2_suxxess=0;
$_nodesforum_val2_already_taken=0;
$_nodesforum_val2_remember_email='';
$_nodesforum_val2_remember_public_name='';


$error=0;

$addslashed_get_u=_nodesforum_my_custom_addslashes($_GET['u']);
$addslashed_get_key=_nodesforum_my_custom_addslashes($_GET['key']);
$addslashed_get_em=_nodesforum_my_custom_addslashes($_GET['em']);

$result = mysql_query("SELECT newemailID FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_newemails WHERE uniqueID = '$addslashed_get_u' && validation_key = '$addslashed_get_key' && email = AES_ENCRYPT('$addslashed_get_em','$addslashed_get_em')");
while($row = mysql_fetch_array($result))
{
	mysql_query("DELETE FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_newemails WHERE newemailID = '$row[newemailID]'");
	$result2 = mysql_query("SELECT public_name, uniqueID FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_users WHERE uniqueID = '$addslashed_get_u' || email = AES_ENCRYPT('$addslashed_get_em','$addslashed_get_em')");
	while($row2 = mysql_fetch_array($result2))
	{
		if($row2['uniqueID']==$_GET['u'])
		{$_nodesforum_val2_remember_public_name=$row2['public_name'];}
		else
		{$error=1; $_nodesforum_val2_already_taken=1;}
	}



	if($error==0)
	{
		mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_users SET email = AES_ENCRYPT('$addslashed_get_em','$addslashed_get_em') WHERE uniqueID = '$addslashed_get_u'");
		$_SESSION[$_nodesforum_external_user_system_uniqueID_session_name]=$addslashed_get_u;
		$_SESSION[$_nodesforum_external_user_system_loginusername_session_name]=$_GET['em'];
		$_nodesforum_val2_suxxess=1;
                $_nodesforum_fhf_update_master_amdin_email=$addslashed_get_em;
	}


}


?>
