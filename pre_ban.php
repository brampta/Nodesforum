<?php



$error=0;
$addslashed_moderee=_nodesforum_my_custom_addslashes($_POST['_nodesforum_banned_uniqueID']);
$addslashed_reason=_nodesforum_my_custom_addslashes($_POST['_nodesforum_banned_reason']);
if($addslashed_moderee==$_nodesforum_creator_uniqueID)
{
	$error=1;
	$_nodesforum_ban_cannotchangeowner=1;
}
if($_POST['_nodesforum_banned_reason']=='')
{
	$error=1;
	$_nodesforum_ban_reason_is_blank=1;
}
$userisfound=0;
$result = mysql_query("SELECT $_nodesforum_external_user_system_user_uniqueID_rowname, $_nodesforum_external_user_system_publicname_rowname FROM $_nodesforum_external_user_system_table_name WHERE $_nodesforum_external_user_system_user_uniqueID_rowname = '$addslashed_moderee'");
while($row = mysql_fetch_array($result))
{
	$userisfound=1;
	$remembermoddedpublicname=$row[$_nodesforum_external_user_system_publicname_rowname];
}
if($userisfound!=1)
{
	$error=1;
	$_nodesforum_ban_usernotfound=1;
}
$isalreadybannedonthisfold=0;
$result = mysql_query("SELECT modID FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_mods WHERE mod_uniqueID = '$addslashed_moderee' && folderID = '$addslashed_node' && mod_level = -13");
while($row = mysql_fetch_array($result))
{$isalreadybannedonthisfold=1;}
if($isalreadybannedonthisfold==1)
{
	$error=1;
	$_nodesforum_ban_already_banned=1;
}
if($error==0)
{
	mysql_query("INSERT INTO ".$_nodesforum_db_table_name_modifier."_nodesforum_mods (mod_uniqueID, folderID, mod_level, promotion_time, reason) VALUES ('$addslashed_moderee', '$addslashed_node', '-13', '$nowtime', '$addslashed_reason')");





	//write to mods log
	$addslashed_ancestry=mysql_real_escape_string($_nodesforum_ancestry);
	$persondoingshit=$_SESSION[$_nodesforum_external_user_system_uniqueID_session_name];
	$addslashed_authority=mysql_real_escape_string($_nodesforum_modship_authoritative_folder);

	$action='banned';


	$myquery="INSERT INTO ".$_nodesforum_db_table_name_modifier."_nodesforum_mods_log (fapID, ancestry, mod_uniqueID, moded_uniqueID, authoritative_folderID, subaction_of, action_time, action_code, action) VALUES ('$addslashed_node', '$addslashed_ancestry', '$persondoingshit', '$addslashed_moderee', '$addslashed_authority', '0', '$nowtime', 'BAN', '$action')";
	mysql_query($myquery);









	$_nodesforum_remember_grant_moderee=$addslashed_moderee;
	$_nodesforum_ban_banned=1;
}

?>
