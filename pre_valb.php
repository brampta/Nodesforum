<?php



$_nodesforum_val_suxxess=0;
$_nodesforum_val_remember_email='';
$_nodesforum_val_remember_public_name='';

$addslashed_get_u=_nodesforum_my_custom_addslashes($_GET['u']);
$addslashed_get_key=_nodesforum_my_custom_addslashes($_GET['key']);
$addslashed_get_em=_nodesforum_my_custom_addslashes($_GET['em']);

$result = mysql_query("SELECT public_name FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_users WHERE uniqueID = '$addslashed_get_u' && validation_key = '$addslashed_get_key' && email = AES_ENCRYPT('$addslashed_get_em','$addslashed_get_em')");
while($row = mysql_fetch_array($result))
{
	$_nodesforum_val_remember_email=$_GET['em'];
	$_nodesforum_val_remember_public_name=$row['public_name'];
	mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_users SET validation_key = 1 WHERE uniqueID = '$addslashed_get_u'");
	$_SESSION[$_nodesforum_external_user_system_uniqueID_session_name]=$addslashed_get_u;
	$_SESSION[$_nodesforum_external_user_system_loginusername_session_name]=$_nodesforum_val_remember_email;
	$_nodesforum_val_suxxess=1;
}



?>
