<?php


$addslashed_edit_node=_nodesforum_my_custom_addslashes($_GET['_nodesforum_edit_folder']);
//read info about folder to edit
$result = mysql_query("SELECT containing_folder_or_post, title, post, disable_auto_smileys, disable_auto_links, allow_posting, creator_uniqueID, ancestry, skeleton FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts WHERE fapID = '$addslashed_edit_node'");
while($row = mysql_fetch_array($result))
{
	if(!isset($_POST['_nodesforum_new_folder_name']))
	{$_POST['_nodesforum_new_folder_name']=$row['title'];}
	if(!isset($_POST['_nodesforum_new_folder_description']))
	{
		$_POST['_nodesforum_new_folder_description']=$row['post'];
		if($row['disable_auto_smileys']==1)
		{$_POST['_nodesforum_disable_auto_smileys']=1;}
		if($row['disable_auto_links']==1)
		{$_POST['_nodesforum_disable_auto_links']=1;}
	}
	if(!isset($_POST['_nodesforum_new_folder_allow_posting']))
	{$_POST['_nodesforum_new_folder_allow_posting']=$row['allow_posting'];}
	if(!isset($_POST['_nodesforum_new_folder_skeleton']))
	{$_POST['_nodesforum_new_folder_skeleton']=$row['skeleton'];}
	$_nodesforum_remember_folder_name=$row['title'];
	$_nodesforum_remember_folder_description=$row['post'];
	$_nodesforum_edit_disable_auto_smileys=$row['disable_auto_smileys'];
	$_nodesforum_edit_disable_auto_links=$row['disable_auto_links'];
	$_nodesforum_remember_allow_posting=$row['allow_posting'];
	$_nodesforum_edit_creator_uniqueID=$row['creator_uniqueID'];
	$_nodesforum_edit_ancestry=$row['ancestry'];
	$_nodesforum_edit_skeleton=$row['skeleton'];
	if($_GET['_nodesforum_node']!=substr($row['containing_folder_or_post'],1))
	{die('error');}
}

?>
