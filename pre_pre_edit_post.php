<?php


$addslashed_edit_node=_nodesforum_my_custom_addslashes($_GET['_nodesforum_edit_post']);
//read info about post to edit
$result = mysql_query("SELECT containing_folder_or_post, title, post, disable_auto_smileys, disable_auto_links, allow_guest_reply, creator_uniqueID, creator_ip, creation_time, ancestry FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts WHERE fapID = '$addslashed_edit_node'");
while($row = mysql_fetch_array($result))
{
	if(!isset($_POST['_nodesforum_new_post_title']))
	{$_POST['_nodesforum_new_post_title']=$row['title'];}
	if(!isset($_POST['_nodesforum_new_post']))
	{
		$_POST['_nodesforum_new_post']=$row['post'];
		if($row['disable_auto_smileys']==1)
		{$_POST['_nodesforum_disable_auto_smileys']=1;}
		if($row['disable_auto_links']==1)
		{$_POST['_nodesforum_disable_auto_links']=1;}
	}
	if(!isset($_POST['_nodesforum_allow_guest_reply']))
	{$_POST['_nodesforum_allow_guest_reply']=$row['allow_guest_reply'];}
	$_nodesforum_remember_post_name=$row['title'];
	$_nodesforum_edit_post=$row['post'];
	$_nodesforum_edit_disable_auto_smileys=$row['disable_auto_smileys'];
	$_nodesforum_edit_disable_auto_links=$row['disable_auto_links'];
	$_nodesforum_edit_allow_guest_reply=$row['allow_guest_reply'];
	$_nodesforum_edit_containing_folder_or_post=$row['containing_folder_or_post'];
	$_nodesforum_edit_firstletterof_containing_folder_or_post=substr($_nodesforum_edit_containing_folder_or_post,0,1);
	$_nodesforum_edit_creator_uniqueID=$row['creator_uniqueID'];
	$_nodesforum_edit_creator_ip=$row['creator_ip'];
	$_nodesforum_edit_creation_time=$row['creation_time'];
	$_nodesforum_edit_ancestry=$row['ancestry'];
	if($_GET['_nodesforum_node']!=substr($row['containing_folder_or_post'],1) && $_GET['_nodesforum_node']!=$_GET['_nodesforum_edit_post'] && !(substr($_GET['_nodesforum_node'],0,1)=='s' && substr($_GET['_nodesforum_node'],1)==$_SESSION[$_nodesforum_external_user_system_uniqueID_session_name]))
	{die('error');}
}



?>
