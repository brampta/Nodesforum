<?php


$error=0;
$addslashed_ip_AES=mysql_real_escape_string(base64_decode($_GET['_nodesforum_unban_ip']));
$isalreadybannedonthisfold=0;
$myquery="SELECT modID FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_mods WHERE ip = '$addslashed_ip_AES' && folderID = '$addslashed_node' && mod_level = -13";
$result = mysql_query($myquery);
while($row = mysql_fetch_array($result))
{$isalreadybannedonthisfold=1;}
if($isalreadybannedonthisfold==0)
{
	$error=1;
	$_nodesforum_unban_ip_notbanned_here=1;
}
if($error==0)
{


	//write to mods log
	$addslashed_ancestry=mysql_real_escape_string($_nodesforum_ancestry);
	$persondoingshit=$_SESSION[$_nodesforum_external_user_system_uniqueID_session_name];
	$addslashed_authority=mysql_real_escape_string($_nodesforum_modship_authoritative_folder);


	$action='unbanned IP <input type="text" value="'.mysql_real_escape_string($_GET['_nodesforum_unban_ip']).'" readonly="readonly" onmouseup="highlight(this)" />';
	


	$myquery="INSERT INTO ".$_nodesforum_db_table_name_modifier."_nodesforum_mods_log (fapID, ancestry, mod_uniqueID, moded_uniqueID, authoritative_folderID, subaction_of, action_time, action_code, action) VALUES ('$addslashed_node', '$addslashed_ancestry', '$persondoingshit', '0', '$addslashed_authority', '0', '$nowtime', 'BANIP', '$action')";
	mysql_query($myquery);





	mysql_query("DELETE FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_mods WHERE ip = '$addslashed_ip_AES' && folderID = '$addslashed_node' && mod_level = -13");
	$_nodesforum_unban_ip_suxxess=0;
}




?>
