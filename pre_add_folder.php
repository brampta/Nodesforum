<?php


$error=0;
$my_uniqueID=$_SESSION[$_nodesforum_external_user_system_uniqueID_session_name];













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
	$audited=0;
	if($_nodesforum_righttoaudit==1){
		$audited=1;
	}
	$new_ancestry=$_nodesforum_ancestry.$addslashed_node.$_nodesforum_ancestry_separator;
	if(mysql_query("INSERT INTO ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts (
		folder_or_post,
		containing_folder_or_post,
		creator_uniqueID,
		creator_ip,
		creation_time,
		title,
		post,
		allow_posting,
		allow_guest_reply,
		ancestry,
		subfolders,
		posts,
		replies,
		views,
		last_post_postID,
		last_post_user_uniqueID,
		last_post_time,
		sticky,
		skeleton,
		disable_auto_smileys,
		disable_auto_links,
		audited
	) VALUES (
		'1',
		'f$addslashed_node',
		'$my_uniqueID',
		'$_nodesforum_enc_ip',
		'$nowtime',
		'$addslashed_newname',
		'$addslashed_newdescription',
		'$addslashed_allow_posting',
		'0',
		'$new_ancestry',
		'0',
		'0',
		'0',
		'0',
		'0',
		'0',
		'$nowtime',
		'0',
		'$skeleton',
		'$disable_auto_smileys',
		'$disable_auto_links',
		'$audited'
		)"))
	{
		$_nodesforum_youarehere=$_nodesforum_original_youarehere;
		unset($_GET['_nodesforum_add_folder']);
		$_GET['_nodesforum_page']='last';
		//update amount of folders in parent folder
		$queryRows=mysql_query("SELECT COUNT(fapID) FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts WHERE folder_or_post = 1 && containing_folder_or_post = 'f$addslashed_node' && deletion_time = 0");
		$numRows=mysql_fetch_array($queryRows);
		$totalfolderincontainingfolder=$numRows[0];
		mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts SET subfolders = $totalfolderincontainingfolder WHERE fapID = $addslashed_node");
		//add 1 folder to user_data for this user
		$useralreadyhasuserdata=0;
		if($result = mysql_query("SELECT uniqueID FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_user_data WHERE uniqueID = '$my_uniqueID'"))
		{
			while($row = mysql_fetch_array($result))
			{$useralreadyhasuserdata=1;}
			if($useralreadyhasuserdata==1)
			{mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_user_data SET total_folders = (total_folders + 1) WHERE uniqueID = '$my_uniqueID'");}
			else
			{mysql_query("INSERT INTO ".$_nodesforum_db_table_name_modifier."_nodesforum_user_data (uniqueID, total_folders) VALUES ('$my_uniqueID', 1)");}
		}
		//now redirect to lose vars in URL
		$location='Location: ?_nodesforum_node='.$_GET['_nodesforum_node'].'&_nodesforum_page='.$_GET['_nodesforum_page'];
		header($location);
	}
	else
	{$_nodesforum_create_folder_dberror=1; $_nodesforum_remember_wtf=mysql_error();}
}


