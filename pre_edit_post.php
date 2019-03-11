<?php


$error=0;








$addslashed_newtitle=_nodesforum_my_custom_addslashes($_POST['_nodesforum_new_post_title']);
//$addslashed_newpost=_nodesforum_my_custom_addslashes($_POST['_nodesforum_new_post']);
$addslashed_allow_guest_reply=_nodesforum_my_custom_addslashes($_POST['_nodesforum_allow_guest_reply']);
$disable_auto_smileys=0;
if(isset($_POST['_nodesforum_disable_auto_smileys']))
{$disable_auto_smileys=1;}
$disable_auto_links=0;
if(isset($_POST['_nodesforum_disable_auto_links']))
{$disable_auto_links=1;}










//verify validity of strict quotes
$string=_nodesforum_my_custom_stripslashes($_POST['_nodesforum_new_post']);
$_nodesforum_verifstrquotes_editmode=1;
$_nodesforum_oldpost_to_compare=$_nodesforum_edit_post;
require($_nodesforum_code_path.'pre_verify_validity_of_strict_quotes.php');
$_POST['_nodesforum_new_post']=$string;
$addslashed_newpost=mysql_real_escape_string($_POST['_nodesforum_new_post']);







if($_SESSION[$_nodesforum_external_user_system_uniqueID_session_name]==$_nodesforum_edit_creator_uniqueID || ($_nodesforum_edit_creator_uniqueID==0 && $_nodesforum_edit_creator_ip==$_nodesforum_enc_ip && $nowtime<$oldestacceptabletimeforguesteditbyip))
{
	if($_nodesforum_edit_firstletterof_containing_folder_or_post=='f')
	{
		if(strlen($_POST['_nodesforum_new_post'])<$_nodesforum_minimum_post_length)
		{$error=1; $_nodesforum_post_too_short=1;}
	}
	else if($_nodesforum_edit_firstletterof_containing_folder_or_post=='p')
	{
		if(strlen($_POST['_nodesforum_new_post'])<$_nodesforum_minimum_reply_length)
		{$error=1; $_nodesforum_reply_too_short=1;}
	}
}
if(!isset($_SESSION[$_nodesforum_external_user_system_uniqueID_session_name]))
{
	if(md5($_POST['_nodesforum_numbazx'])!=$_SESSION['img_ver_gpost'])
	{$error=1; $_nodesforum_img_ver_invalid=1;}
}
if($_nodesforum_edit_firstletterof_containing_folder_or_post=='f')
{
	if($_POST['_nodesforum_new_post_title']=='')
	{$error=1; $_nodesforum_create_post_namecannotbeblank=1;}
}
if($error==0)
{
	if($_nodesforum_ismod==1)
	{$delete_authority=$_nodesforum_modship_authoritative_folder;}
	else if($this_creator_uniqueID==$_SESSION[$_nodesforum_external_user_system_uniqueID_session_name] || ($this_creator_uniqueID==0 && $this_creator_ip==$_nodesforum_enc_ip && $nowtime<$oldestacceptabletimeforguesteditbyip))
	{$delete_authority=$addslashed_edit_node;}

	$persondoingshit=$_SESSION[$_nodesforum_external_user_system_uniqueID_session_name];
	$this_creator_uniqueID=mysql_real_escape_string($_nodesforum_edit_creator_uniqueID);
	if($_SESSION[$_nodesforum_external_user_system_uniqueID_session_name]==$_nodesforum_edit_creator_uniqueID || ($_nodesforum_edit_creator_uniqueID==0 && $_nodesforum_edit_creator_ip==$_nodesforum_enc_ip && $nowtime<$oldestacceptabletimeforguesteditbyip))
	{
		if($_POST['_nodesforum_new_post']!=$_nodesforum_edit_post)
		{
			mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts SET post = '$addslashed_newpost' WHERE fapID = '$addslashed_edit_node'");
			$action='changed post from <hr style="text-align:center;width:80%;" />'.mysql_real_escape_string(nl2br(htmlspecialchars($_nodesforum_edit_post))).'<hr style="text-align:center;width:80%;" />to<hr style="text-align:center;width:80%;" />'._nodesforum_my_custom_addslashes(nl2br(htmlspecialchars($_POST['_nodesforum_new_post'])));
			$myquery="INSERT INTO ".$_nodesforum_db_table_name_modifier."_nodesforum_mods_log (fapID, ancestry, mod_uniqueID, moded_uniqueID, authoritative_folderID, subaction_of, action_time, action_code, action) VALUES ('$addslashed_edit_node', '$_nodesforum_edit_ancestry', '$persondoingshit', '$this_creator_uniqueID', '$delete_authority', '0', '$nowtime', 'PEP', '$action')";
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
	}
	if($_nodesforum_edit_firstletterof_containing_folder_or_post=='f')
	{
		if($_POST['_nodesforum_new_post_title']!=$_nodesforum_remember_post_name)
		{
			mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts SET title = '$addslashed_newtitle' WHERE fapID = '$addslashed_edit_node'");
			$action='changed title from '.mysql_real_escape_string(htmlspecialchars($_nodesforum_remember_post_name)).' to '._nodesforum_my_custom_addslashes(htmlspecialchars($_POST['_nodesforum_new_post_title']));
			$myquery="INSERT INTO ".$_nodesforum_db_table_name_modifier."_nodesforum_mods_log (fapID, ancestry, mod_uniqueID, moded_uniqueID, authoritative_folderID, subaction_of, action_time, action_code, action) VALUES ('$addslashed_edit_node', '$_nodesforum_edit_ancestry', '$persondoingshit', '$this_creator_uniqueID', '$delete_authority', '0', '$nowtime', 'PET', '$action')";
			mysql_query($myquery);
		}
		if($_POST['_nodesforum_allow_guest_reply']!=$_nodesforum_edit_allow_guest_reply)
		{
			mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts SET allow_guest_reply = '$addslashed_allow_guest_reply' WHERE fapID = '$addslashed_edit_node'");
			$action='changed allow_guest_reply from '.mysql_real_escape_string(htmlspecialchars($_nodesforum_edit_allow_guest_reply)).' to '._nodesforum_my_custom_addslashes(htmlspecialchars($_POST['_nodesforum_new_post_title']));
			$myquery="INSERT INTO ".$_nodesforum_db_table_name_modifier."_nodesforum_mods_log (fapID, ancestry, mod_uniqueID, moded_uniqueID, authoritative_folderID, subaction_of, action_time, action_code, action) VALUES ('$addslashed_edit_node', '$_nodesforum_edit_ancestry', '$persondoingshit', '$this_creator_uniqueID', '$delete_authority', '0', '$nowtime', 'PEAGR', '$action')";
			mysql_query($myquery);
		}
	}
	$_nodesforum_youarehere=$_nodesforum_original_youarehere;
	unset($_GET['_nodesforum_edit_post']);
	if(substr($_GET['_nodesforum_node'],0,1)=='s' && substr($_GET['_nodesforum_node'],1)==$_SESSION[$_nodesforum_external_user_system_uniqueID_session_name])
	{
		$_GET['_nodesforum_forum_options']=1;
		$_nodesforum_willread_user_data_for_forumoptionspage=1;
	}
	else
	{
		//now redirect to lose vars in URL
		$location='Location: ?_nodesforum_node='.$_GET['_nodesforum_node'].'&_nodesforum_page='.$_GET['_nodesforum_page'];
	}
	header($location);
}


?>
