<?php


$error=0;
$addslashed_demoderee=_nodesforum_my_custom_addslashes($_GET['_nodesforum_remove_p']);

if(!$_nodesforum_risky_bbcode_title[$addslashed_node])
{die('error');}


$result = mysql_query("SELECT modID FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_mods WHERE mod_uniqueID = '$addslashed_demoderee' && folderID = '$addslashed_node'");
while($row = mysql_fetch_array($result))
{$error=1; $_nodesforum_remove_p_ismod=1; echo 'test1';}
if($_nodesforum_remove_p_ismod==0)
{
	$_nodesforum_remove_p_usernopower=1;
	$result = mysql_query("SELECT user_dataID FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_user_data WHERE uniqueID = '$addslashed_demoderee' && $addslashed_node = 1");
	while($row = mysql_fetch_array($result))
	{$_nodesforum_remove_p_usernopower=0;}
	if($_nodesforum_remove_p_usernopower==1)
	{$error=1;}
}




if($error==0)
{
	mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_user_data SET $addslashed_node = 0 WHERE uniqueID = '$addslashed_demoderee'");
	$_nodesforum_remove_p_suxxess=0;




	//write to mods log
	$addslashed_ancestry=mysql_real_escape_string($_nodesforum_ancestry);
	$persondoingshit=$_SESSION[$_nodesforum_external_user_system_uniqueID_session_name];
	$addslashed_authority=mysql_real_escape_string($_nodesforum_modship_authoritative_folder);


	$action='removed '.$_nodesforum_risky_bbcode_title[$addslashed_node];
	


	$myquery="INSERT INTO ".$_nodesforum_db_table_name_modifier."_nodesforum_mods_log (fapID, ancestry, mod_uniqueID, moded_uniqueID, authoritative_folderID, subaction_of, action_time, action_code, action) VALUES ('$addslashed_node', '$addslashed_ancestry', '$persondoingshit', '$addslashed_demoderee', '$addslashed_authority', '0', '$nowtime', 'MOD', '$action')";
	mysql_query($myquery);









}



?>

