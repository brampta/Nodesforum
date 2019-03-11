<?php

$error=0;













$addslashed_newname=_nodesforum_my_custom_addslashes($_POST['_nodesforum_new_folder_name']);
//$addslashed_newdescription=my_custom_addslashes($_POST['_nodesforum_new_folder_description']);
$addslashed_allow_posting=_nodesforum_my_custom_addslashes($_POST['_nodesforum_new_folder_allow_posting']);
$disable_auto_smileys=0;
if(isset($_POST['_nodesforum_disable_auto_smileys']))
{$disable_auto_smileys=1;}
$disable_auto_links=0;
if(isset($_POST['_nodesforum_disable_auto_links']))
{$disable_auto_links=1;}




	



//verify validity of strict quotes
$string=_nodesforum_my_custom_stripslashes($_POST['_nodesforum_new_folder_description']);
$_nodesforum_verifstrquotes_editmode=1;
$_nodesforum_oldpost_to_compare=$_nodesforum_remember_folder_description;
require($_nodesforum_code_path.'pre_verify_validity_of_strict_quotes.php');
$_POST['_nodesforum_new_folder_description']=$string;
$addslashed_newdescription=mysql_real_escape_string($_POST['_nodesforum_new_folder_description']);






if($_POST['_nodesforum_new_folder_name']=='')
{$error=1; $_nodesforum_create_folder_namecannotbeblank=1;}
$skeleton=0;
if($_POST['_nodesforum_new_folder_skeleton']==1 && $_nodesforum_power_on_skeleton==1)
{$skeleton=1;}
if($error==0)
{
	$persondoingshit=$_SESSION[$_nodesforum_external_user_system_uniqueID_session_name];
	$this_creator_uniqueID=mysql_real_escape_string($_nodesforum_edit_creator_uniqueID);
		
	if($_nodesforum_ismod==1)
	{$delete_authority=$_nodesforum_modship_authoritative_folder;}
	else if($_SESSION[$_nodesforum_external_user_system_uniqueID_session_name]==$_nodesforum_edit_creator_uniqueID)
	{$delete_authority=$addslashed_edit_node;}
	if($_POST['_nodesforum_new_folder_name']!=$_nodesforum_remember_folder_name)
	{
		mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts SET title = '$addslashed_newname' WHERE fapID = '$addslashed_edit_node'");
		$action='changed title from '.mysql_real_escape_string(htmlspecialchars($_nodesforum_remember_folder_name)).' to '._nodesforum_my_custom_addslashes(htmlspecialchars($_POST['_nodesforum_new_folder_name']));
		$myquery="INSERT INTO ".$_nodesforum_db_table_name_modifier."_nodesforum_mods_log (fapID, ancestry, mod_uniqueID, moded_uniqueID, authoritative_folderID, subaction_of, action_time, action_code, action) VALUES ('$addslashed_edit_node', '$_nodesforum_edit_ancestry', '$persondoingshit', '$this_creator_uniqueID', '$delete_authority', '0', '$nowtime', 'FET', '$action')";
		mysql_query($myquery);
	}
	if($_POST['_nodesforum_new_folder_description']!=$_nodesforum_remember_folder_description)
	{
		mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts SET post = '$addslashed_newdescription' WHERE fapID = '$addslashed_edit_node'");
		$action='changed description from <hr />'.mysql_real_escape_string(htmlspecialchars($_nodesforum_remember_folder_description)).'<hr /> to <hr />'._nodesforum_my_custom_addslashes(htmlspecialchars($_POST['_nodesforum_new_folder_description'])).'<hr />';
		$myquery="INSERT INTO ".$_nodesforum_db_table_name_modifier."_nodesforum_mods_log (fapID, ancestry, mod_uniqueID, moded_uniqueID, authoritative_folderID, subaction_of, action_time, action_code, action) VALUES ('$addslashed_edit_node', '$_nodesforum_edit_ancestry', '$persondoingshit', '$this_creator_uniqueID', '$delete_authority', '0', '$nowtime', 'FED', '$action')";
		mysql_query($myquery);
	}
	if($disable_auto_smileys!=$_nodesforum_edit_disable_auto_smileys)
	{
		mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts SET disable_auto_smileys = '$disable_auto_smileys' WHERE fapID = '$addslashed_edit_node'");
		if($disable_auto_smileys==1)
		{$action='disabled auto-smileys';}
		else
		{$action='enabled auto-smileys';}
		$myquery="INSERT INTO ".$_nodesforum_db_table_name_modifier."_nodesforum_mods_log (fapID, ancestry, mod_uniqueID, moded_uniqueID, authoritative_folderID, subaction_of, action_time, action_code, action) VALUES ('$addslashed_edit_node', '$_nodesforum_edit_ancestry', '$persondoingshit', '$this_creator_uniqueID', '$delete_authority', '0', '$nowtime', 'PEP', '$action')";
		mysql_query($myquery);
	}
	if($disable_auto_links!=$_nodesforum_edit_disable_auto_links)
	{
		mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts SET disable_auto_links = '$disable_auto_links' WHERE fapID = '$addslashed_edit_node'");
		if($disable_auto_links==1)
		{$action='disabled auto-links';}
		else
		{$action='enabled auto-links';}
		$myquery="INSERT INTO ".$_nodesforum_db_table_name_modifier."_nodesforum_mods_log (fapID, ancestry, mod_uniqueID, moded_uniqueID, authoritative_folderID, subaction_of, action_time, action_code, action) VALUES ('$addslashed_edit_node', '$_nodesforum_edit_ancestry', '$persondoingshit', '$this_creator_uniqueID', '$delete_authority', '0', '$nowtime', 'PEP', '$action')";
		mysql_query($myquery);
	}
	if($_POST['_nodesforum_new_folder_allow_posting']!=$_nodesforum_remember_allow_posting)
	{
		mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts SET allow_posting = '$addslashed_allow_posting' WHERE fapID = '$addslashed_edit_node'");
		$action='changed allow_posting from '.mysql_real_escape_string($_nodesforum_remember_allow_posting).' to '.$addslashed_allow_posting;
		$myquery="INSERT INTO ".$_nodesforum_db_table_name_modifier."_nodesforum_mods_log (fapID, ancestry, mod_uniqueID, moded_uniqueID, authoritative_folderID, subaction_of, action_time, action_code, action) VALUES ('$addslashed_edit_node', '$_nodesforum_edit_ancestry', '$persondoingshit', '$this_creator_uniqueID', '$delete_authority', '0', '$nowtime', 'FEAP', '$action')";
		mysql_query($myquery);
	}
	if($skeleton!=$_nodesforum_edit_skeleton)
	{
		mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts SET skeleton = '$skeleton' WHERE fapID = '$addslashed_edit_node'");
		$skeleton_or_not[0]='not skeleton';
		$skeleton_or_not[1]='skeleton';
		$action='changed folder from '.$skeleton_or_not[$_nodesforum_edit_skeleton].' to '.$skeleton_or_not[$skeleton];
		$myquery="INSERT INTO ".$_nodesforum_db_table_name_modifier."_nodesforum_mods_log (fapID, ancestry, mod_uniqueID, moded_uniqueID, authoritative_folderID, subaction_of, action_time, action_code, action) VALUES ('$addslashed_edit_node', '$_nodesforum_edit_ancestry', '$persondoingshit', '$this_creator_uniqueID', '$delete_authority', '0', '$nowtime', 'FESK', '$action')";
		mysql_query($myquery);
	}
	$_nodesforum_youarehere=$_nodesforum_original_youarehere;
	unset($_GET['_nodesforum_edit_folder']);
	//now redirect to lose vars in URL
	$location='Location: ?_nodesforum_node='.$_GET['_nodesforum_node'].'&_nodesforum_page='.$_GET['_nodesforum_page'];
	header($location);
}


?>
