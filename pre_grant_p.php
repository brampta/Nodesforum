<?php


$error=0;
$addslashed_moderee=_nodesforum_my_custom_addslashes($_POST['_nodesforum_moderated_uniqueIDb']);
$_nodesforum_remember_grant_moderee=$addslashed_moderee;

if(!$_nodesforum_risky_bbcode_title[$addslashed_node])
{die('error');}

$userisfound=0;
$result = mysql_query("SELECT $_nodesforum_external_user_system_user_uniqueID_rowname, $_nodesforum_external_user_system_publicname_rowname FROM $_nodesforum_external_user_system_table_name WHERE $_nodesforum_external_user_system_user_uniqueID_rowname = '$addslashed_moderee'");
while($row = mysql_fetch_array($result))
{
	$userisfound=1;
	$remembermoddedpublicname=$row[$_nodesforum_external_user_system_publicname_rowname];
}
if($userisfound!=1)
{$error=1; $_nodesforum_grantp_usernotfound=1;}
$hasuserdata=0;
$alreadyhaspower=0;
if($_POST['_nodesforum_moderated_uniqueIDb']==$_nodesforum_main_mod_uniqueID)
{$alreadyhaspower=1;}
else
{
	$result = mysql_query("SELECT $addslashed_node FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_user_data WHERE uniqueID = '$addslashed_moderee'");
	while($row = mysql_fetch_array($result))
	{
		$hasuserdata=1;
		if($row[$addslashed_node]==1)
		{$alreadyhaspower=1;}
	}
}
if($alreadyhaspower==1)
{$error=1; $_nodesforum_grantp_alreadyhve=1;}
if($error==0)
{
	if($hasuserdata==1)
	{
		mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_user_data SET $addslashed_node = 1 WHERE uniqueID = '$addslashed_moderee'");
		mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_user_data SET ".$addslashed_node."_time = '$nowtime' WHERE uniqueID = '$addslashed_moderee'");
	}
	else
	{mysql_query("INSERT INTO ".$_nodesforum_db_table_name_modifier."_nodesforum_user_data (uniqueID, $addslashed_node, ".$addslashed_node."_time) VALUES ('$addslashed_moderee', 1, $nowtime)");}
	$_nodesforum_grantp_modmodded=1;







	//write to mods log
	$addslashed_ancestry=mysql_real_escape_string($_nodesforum_ancestry);
	$persondoingshit=$_SESSION[$_nodesforum_external_user_system_uniqueID_session_name];
	$addslashed_authority=mysql_real_escape_string($_nodesforum_modship_authoritative_folder);

	$action='granted the '.htmlspecialchars($_nodesforum_risky_bbcode_title[$addslashed_node]);
	


	$myquery="INSERT INTO ".$_nodesforum_db_table_name_modifier."_nodesforum_mods_log (fapID, ancestry, mod_uniqueID, moded_uniqueID, authoritative_folderID, subaction_of, action_time, action_code, action) VALUES ('$addslashed_node', '$addslashed_ancestry', '$persondoingshit', '$addslashed_moderee', '$addslashed_authority', '0', '$nowtime', 'POW', '$action')";
	mysql_query($myquery);





}

?>

