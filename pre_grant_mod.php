<?php



$error=0;
$addslashed_moderee=_nodesforum_my_custom_addslashes($_POST['_nodesforum_moderated_uniqueID']);
$given_level=abs($_POST['_nodesforum_moderated_given_level']);
if($given_level<=$_nodesforum_mod_level)
{
	$error=1;
	$_nodesforum_grant_cannotgivethatmodstren=1;
}
if($addslashed_moderee==$_nodesforum_creator_uniqueID || $given_level==0)
{
	$error=1;
	$_nodesforum_grant_cannotchangeowner=1;
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
	$_nodesforum_grant_usernotfound=1;
}
$isalreadymodonthisfold=0;
$result = mysql_query("SELECT mod_level FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_mods WHERE mod_uniqueID = '$addslashed_moderee' && folderID = '$addslashed_node' && mod_level != -13");
while($row = mysql_fetch_array($result))
{
	$isalreadymodonthisfold=1;
	$current_mod_level=$row['mod_level'];
}
if($isalreadymodonthisfold==1 && $current_mod_level<=$_nodesforum_mod_level)
{
	$error=1;
	$_nodesforum_grant_personyouwannamodisalreadyhigher=1;
}
if($error==0)
{
	if($isalreadymodonthisfold==1)
	{mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_mods SET mod_level = '$given_level' WHERE mod_uniqueID = '$addslashed_moderee' && folderID = '$addslashed_node'");}
	else
	{mysql_query("INSERT INTO ".$_nodesforum_db_table_name_modifier."_nodesforum_mods (mod_uniqueID, folderID, mod_level, promotion_time) VALUES ('$addslashed_moderee', '$addslashed_node', '$given_level', '$nowtime')");}





	//write to mods log
	$addslashed_ancestry=mysql_real_escape_string($_nodesforum_ancestry);
	$persondoingshit=$_SESSION[$_nodesforum_external_user_system_uniqueID_session_name];
	$addslashed_authority=mysql_real_escape_string($_nodesforum_modship_authoritative_folder);

	if($isalreadymodonthisfold==0)
	{$action='granted a moderator level of '.$given_level;}
	else
	{$action='changed moderator level from '.$current_mod_level.' to '.$given_level;}
	


	$myquery="INSERT INTO ".$_nodesforum_db_table_name_modifier."_nodesforum_mods_log (fapID, ancestry, mod_uniqueID, moded_uniqueID, authoritative_folderID, subaction_of, action_time, action_code, action) VALUES ('$addslashed_node', '$addslashed_ancestry', '$persondoingshit', '$addslashed_moderee', '$addslashed_authority', '0', '$nowtime', 'MOD', '$action')";
	mysql_query($myquery);








	if($_nodesforum_risky_bbcode_title[$addslashed_node])
	{
		$hasuserdata=0;
		$alreadyhaspower=0;
		$result = mysql_query("SELECT $addslashed_node FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_user_data WHERE uniqueID = '$addslashed_moderee'");
		while($row = mysql_fetch_array($result))
		{
			$hasuserdata=1;
			if($row[$addslashed_node]==1)
			{$alreadyhaspower=1;}
		}
		if($alreadyhaspower==0)
		{
			if($hasuserdata==1)
			{
				mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_user_data SET $addslashed_node = 1 WHERE uniqueID = '$addslashed_moderee'");
				mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_user_data SET ".$addslashed_node."_time = '$nowtime' WHERE uniqueID = '$addslashed_moderee'");
			}
			else
			{mysql_query("INSERT INTO ".$_nodesforum_db_table_name_modifier."_nodesforum_user_data (uniqueID, $addslashed_node, ".$addslashed_node."_time) VALUES ('$my_uniqueID', 1, $nowtime)");}




			//write to mods log
		
			$action='automatically granted the '.htmlspecialchars($_nodesforum_risky_bbcode_title[$addslashed_node]).' by granting moderator powers on the '.htmlspecialchars($_nodesforum_risky_bbcode_title[$addslashed_node]);
			
		
		
			$myquery="INSERT INTO ".$_nodesforum_db_table_name_modifier."_nodesforum_mods_log (fapID, ancestry, mod_uniqueID, moded_uniqueID, authoritative_folderID, subaction_of, action_time, action_code, action) VALUES ('$addslashed_node', '$addslashed_ancestry', '$persondoingshit', '$addslashed_moderee', '$addslashed_authority', '0', '".($nowtime+1)."', 'POW', '$action')";
			mysql_query($myquery);




		}
	}




	$_nodesforum_remember_grant_given_level=$given_level;
	$_nodesforum_remember_grant_moderee=$addslashed_moderee;
	$_nodesforum_grant_modmodded=1;
}

?>
