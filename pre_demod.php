<?php


$error=0;
$addslashed_demoderee=_nodesforum_my_custom_addslashes($_GET['_nodesforum_demod']);
if($addslashed_demoderee==$_nodesforum_creator_uniqueID)
{
	$error=1;
	$_nodesforum_demod_cannotdemodowner=1;
}
$isalreadymodonthisfold=0;
$result = mysql_query("SELECT mod_level FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_mods WHERE mod_uniqueID = '$addslashed_demoderee' && folderID = '$addslashed_node' && mod_level != -13");
while($row = mysql_fetch_array($result))
{
	$isalreadymodonthisfold=1;
	$current_mod_level=$row['mod_level'];
}
if($isalreadymodonthisfold==0)
{
	$error=1;
	$_nodesforum_demod_usernotmodhere=1;
}
else if($_nodesforum_mod_level>=$current_mod_level)
{
	$error=1;
	$_nodesforum_demod_cannotdemodmorepowerful=1;
}
if($error==0)
{




	//write to mods log
	$addslashed_ancestry=mysql_real_escape_string($_nodesforum_ancestry);
	$persondoingshit=$_SESSION[$_nodesforum_external_user_system_uniqueID_session_name];
	$addslashed_authority=mysql_real_escape_string($_nodesforum_modship_authoritative_folder);


	$action='removed moderator powers';
	


	$myquery="INSERT INTO ".$_nodesforum_db_table_name_modifier."_nodesforum_mods_log (fapID, ancestry, mod_uniqueID, moded_uniqueID, authoritative_folderID, subaction_of, action_time, action_code, action) VALUES ('$addslashed_node', '$addslashed_ancestry', '$persondoingshit', '$addslashed_demoderee', '$addslashed_authority', '0', '$nowtime', 'MOD', '$action')";
	mysql_query($myquery);





	mysql_query("DELETE FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_mods WHERE mod_uniqueID = '$addslashed_demoderee' && folderID = '$addslashed_node'");
	$_nodesforum_demod_suxxess=0;
}




?>
