<?php



$error=0;
$addslashed_ip_AES=mysql_real_escape_string(base64_decode($_POST['_nodesforum_banned_ip']));
$addslashed_reason=_nodesforum_my_custom_addslashes($_POST['_nodesforum_banned_ip_reason']);
if($_POST['_nodesforum_banned_ip_reason']=='')
{
	$error=1;
	$_nodesforum_ban_ip_reason_is_blank=1;
}
$ipisfound=0;
$result = mysql_query("SELECT fapID FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts WHERE AES_ENCRYPT(creator_ip,creator_ip) = '$addslashed_ip_AES' LIMIT 0, 1");
while($row = mysql_fetch_array($result))
{$ipisfound=1;}
if($ipisfound!=1)
{
	$error=1;
	$_nodesforum_ban_ip_notfound=1;
}
$isalreadybannedonthisfold=0;
$myquery="SELECT modID FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_mods WHERE ip = '$addslashed_ip_AES' && folderID = '$addslashed_node' && mod_level = -13";
$result = mysql_query($myquery);
while($row = mysql_fetch_array($result))
{$isalreadybannedonthisfold=1;}
if($isalreadybannedonthisfold==1)
{
	$error=1;
	$_nodesforum_ban_ip_already_banned=1;
}
if($error==0)
{
	mysql_query("INSERT INTO ".$_nodesforum_db_table_name_modifier."_nodesforum_mods (mod_uniqueID, folderID, mod_level, promotion_time, reason, ip) VALUES ('0', '$addslashed_node', '-13', '$nowtime', '$addslashed_reason', '$addslashed_ip_AES')");





	//write to mods log
	$addslashed_ancestry=mysql_real_escape_string($_nodesforum_ancestry);
	$persondoingshit=$_SESSION[$_nodesforum_external_user_system_uniqueID_session_name];
	$addslashed_authority=mysql_real_escape_string($_nodesforum_modship_authoritative_folder);

	$action='banned IP <input type="text" value="'._nodesforum_my_custom_addslashes($_POST['_nodesforum_banned_ip']).'" readonly="readonly" onmouseup="highlight(this)" />';


	$myquery="INSERT INTO ".$_nodesforum_db_table_name_modifier."_nodesforum_mods_log (fapID, ancestry, mod_uniqueID, moded_uniqueID, authoritative_folderID, subaction_of, action_time, action_code, action) VALUES ('$addslashed_node', '$addslashed_ancestry', '$persondoingshit', '0', '$addslashed_authority', '0', '$nowtime', 'BANIP', '$action')";
	mysql_query($myquery);









	$_nodesforum_remember_grant_moderee=$addslashed_moderee;
	$_nodesforum_ban_banned=1;
}

?>
