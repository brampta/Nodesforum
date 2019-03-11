<?php


//read list of moderator actions on this folder or post and its children
$addslashed_node=mysql_real_escape_string(substr($_GET['_nodesforum_node'],1));

$moderator_clause='';
if(isset($_GET['_nodesforum_log_mod']))
{$moderator_clause=" && mod_uniqueID = '"._nodesforum_my_custom_addslashes($_GET['_nodesforum_log_mod'])."' ";}
$moderated_clause='';
if(isset($_GET['_nodesforum_log_moded']))
{$moderated_clause=" && moded_uniqueID = '"._nodesforum_my_custom_addslashes($_GET['_nodesforum_log_moded'])."' ";}
$moderated_ip_clause='';
if(isset($_GET['_nodesforum_log_moded_ip']))
{$moderated_ip_clause=" && action LIKE '%value=".'"'._nodesforum_my_custom_addslashes($_GET['_nodesforum_log_moded_ip']).'"'."%' ";}
$code_clause='';
if(isset($_GET['_nodesforum_log_code']))
{$code_clause=" && action_code = '"._nodesforum_my_custom_addslashes($_GET['_nodesforum_log_code'])."' ";}
$exclude_self_clause='';
if($_GET['_nodesforum_log_exclude_self']==1)
{$exclude_self_clause=" && mod_uniqueID != moded_uniqueID ";}



$queryRows=mysql_query("SELECT COUNT(logID) FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_mods_log WHERE (fapID = '$addslashed_node' || (ancestry LIKE '%".$_nodesforum_ancestry_separator.$addslashed_node.$_nodesforum_ancestry_separator."%' && subaction_of = 0))".$moderator_clause.$moderated_clause.$moderated_ip_clause.$code_clause.$exclude_self_clause);
$numRows=mysql_fetch_array($queryRows);
$_nodesforum_totallog=$numRows[0];
$_nodesforum_totalpages=ceil($_nodesforum_totallog/$_nodesforum_howmany_moderator_actions_perpage);
if($_GET['_nodesforum_page']=='last')
{$_GET['_nodesforum_page']=$_nodesforum_totalpages;}
$startat=($_GET['_nodesforum_page']-1)*$_nodesforum_howmany_moderator_actions_perpage;
//first select info from all needed logs to make page
$_nodesforum_count_log_results=0;
$main_actions_wherer='';
$count_main_action_to_get=0;
$myquery="SELECT logID, fapID, mod_uniqueID, moded_uniqueID, authoritative_folderID, subaction_of, action_time, action_code, action FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_mods_log WHERE (fapID = '$addslashed_node' || (ancestry LIKE '%".$_nodesforum_ancestry_separator.$addslashed_node.$_nodesforum_ancestry_separator."%' && subaction_of = 0)) ".$moderator_clause.$moderated_clause.$moderated_ip_clause.$code_clause.$exclude_self_clause." ORDER BY action_time DESC LIMIT $startat, $_nodesforum_howmany_moderator_actions_perpage";
$result = mysql_query($myquery);
while($row = mysql_fetch_array($result))
{
	$_nodesforum_count_log_results++;
	$_nodesforum_display_logID[$_nodesforum_count_log_results]=$row['logID'];
	$this_fapID=$row['fapID'];
	$_nodesforum_display_fapID[$_nodesforum_count_log_results]=$this_fapID;
	$_nodesforum_folder_and_post_titles[$this_fapID]='yes';
	$this_mod_uniqueID=$row['mod_uniqueID'];
	$_nodesforum_display_mod_uniqueID[$_nodesforum_count_log_results]=$this_mod_uniqueID;
	if(!$_nodesforum_user_publicname[$this_mod_uniqueID])
	{$_nodesforum_user_publicname[$this_mod_uniqueID]='yes';}
	$this_moded_uniqueID=$row['moded_uniqueID'];
	$_nodesforum_display_moded_uniqueID[$_nodesforum_count_log_results]=$this_moded_uniqueID;
	if(!$_nodesforum_user_publicname[$this_moded_uniqueID])
	{$_nodesforum_user_publicname[$this_moded_uniqueID]='yes';}
	$this_authoritative_folderID=$row['authoritative_folderID'];
	$_nodesforum_display_authoritative_folderID[$_nodesforum_count_log_results]=$this_authoritative_folderID;
	$_nodesforum_folder_and_post_titles[$this_authoritative_folderID]='yes';
	$_nodesforum_display_subaction_of[$_nodesforum_count_log_results]=$row['subaction_of'];
	if($row['subaction_of']!=0 && $row['subaction_of']!=-1)
	{
		$this_main_action=$row['subaction_of'];
		if(!$getmainactions[$this_main_action])
		{
			$getmainactions[$this_main_action]='queued';
			$count_main_action_to_get++;
			if($count_main_action_to_get>1)
			{$main_actions_wherer=$main_actions_wherer.", ";}
			$main_actions_wherer=$main_actions_wherer."'$this_main_action'";
		}
	}
	$_nodesforum_display_action_time[$_nodesforum_count_log_results]=$row['action_time'];
	$_nodesforum_display_action_code[$_nodesforum_count_log_results]=$row['action_code'];
	$_nodesforum_display_action[$_nodesforum_count_log_results]=$row['action'];
}
//second select info from main actions of shown subactions if any
if($count_main_action_to_get>=1)
{
	$myquery="SELECT logID, fapID, mod_uniqueID, moded_uniqueID, authoritative_folderID, subaction_of, action_time, action_code, action FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_mods_log WHERE logID in ($main_actions_wherer)";
	$result = mysql_query($myquery);
	while($row = mysql_fetch_array($result))
	{
		$thislogID=$row['logID'];
		$this_key_for_array='main_'.$thislogID;
		$_nodesforum_display_logID[$this_key_for_array]=$row['logID'];
		$this_fapID=$row['fapID'];
		$_nodesforum_display_fapID[$this_key_for_array]=$this_fapID;
		$_nodesforum_folder_and_post_titles[$this_fapID]='yes';
		$this_mod_uniqueID=$row['mod_uniqueID'];
		$_nodesforum_display_mod_uniqueID[$this_key_for_array]=$this_mod_uniqueID;
		if(!$_nodesforum_user_publicname[$this_mod_uniqueID])
		{$_nodesforum_user_publicname[$this_mod_uniqueID]='yes';}
		$this_moded_uniqueID=$row['moded_uniqueID'];
		$_nodesforum_display_moded_uniqueID[$this_key_for_array]=$this_moded_uniqueID;
		if(!$_nodesforum_user_publicname[$this_moded_uniqueID])
		{$_nodesforum_user_publicname[$this_moded_uniqueID]='yes';}
		$this_authoritative_folderID=$row['authoritative_folderID'];
		$_nodesforum_display_authoritative_folderID[$this_key_for_array]=$this_authoritative_folderID;
		$_nodesforum_folder_and_post_titles[$this_authoritative_folderID]='yes';
		$_nodesforum_display_subaction_of[$this_key_for_array]=$row['subaction_of'];
		$_nodesforum_display_action_time[$this_key_for_array]=$row['action_time'];
		$_nodesforum_display_action_code[$this_key_for_array]=$row['action_code'];
		$_nodesforum_display_action[$this_key_for_array]=$row['action'];
	}
}

		


//get all needed folder and post titles
$countturns=0;
while($countturns<2)
{
	$countturns++;
	if($_nodesforum_folder_and_post_titles)
	{
		$wherer='';
		$countzz=0;
		foreach($_nodesforum_folder_and_post_titles as $key => $value)
		{
			$firstletterof_fapID=substr($key,0,1);
			if($firstletterof_fapID=='u')
			{
				$this_user_uniqueID=substr($key,1);
				$_nodesforum_user_publicname[$this_user_uniqueID]='yes';
			}
			else if($firstletterof_fapID=='p')
			{
				//do nothing
			}
			else if($key!=0 && $value=='yes')
			{
				$countzz++;
				if($countzz>1)
				{$wherer=$wherer.", ";}
				$wherer=$wherer."'".$key."'";
			}
		}
		if($countzz>=1)
		{
			$myquery="SELECT fapID, title, folder_or_post, containing_folder_or_post, ancestry, deletion_time FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts WHERE fapID in ($wherer)";
			$result = mysql_query($myquery);
			while($row = mysql_fetch_array($result))
			{
				$this_fapID=$row['fapID'];
				$_nodesforum_display_folder_and_post_titles[$this_fapID]=$row['title'];
				$_nodesforum_display_folder_and_post_folder_or_posts[$this_fapID]=$row['folder_or_post'];
				$_nodesforum_display_folder_and_post_containing_folder_or_posts[$this_fapID]=$row['containing_folder_or_post'];
				$_nodesforum_display_folder_and_post_ancestry[$this_fapID]=$row['ancestry'];
				$_nodesforum_folder_and_post_titles[$this_fapID]='ok';
				if($row['folder_or_post']==2 && substr($row['containing_folder_or_post'],0,1)=='p')
				{
					$containing_fapID=substr($row['containing_folder_or_post'],1);
					if(!$_nodesforum_folder_and_post_titles[$containing_fapID])
					{$_nodesforum_folder_and_post_titles[$containing_fapID]='yes';}
				}
                                $_nodesforum_display_folder_and_post_deletion_time[$this_fapID]=$row['deletion_time'];
			}
		}
	}
}
$_nodesforum_display_folder_and_post_titles[0]='root';


//get all needed public names
if($_nodesforum_user_publicname)
{
	$wherer='';
	$countzz=0;
	foreach($_nodesforum_user_publicname as $key => $value)
	{
		if($key!='0' && $key!=$_nodesforum_uniqueID_of_deleted_user)
		{
			$countzz++;
			if($countzz>1)
			{$wherer=$wherer.", ";}
			$wherer=$wherer." "."'".$key."'";
		}
	}
	if($countzz>=1)
	{
		$myquery="SELECT $_nodesforum_external_user_system_user_uniqueID_rowname, $_nodesforum_external_user_system_publicname_rowname FROM $_nodesforum_external_user_system_table_name WHERE $_nodesforum_external_user_system_user_uniqueID_rowname in ($wherer)";
		$result = mysql_query($myquery);
		while($row = mysql_fetch_array($result))
		{
			$this_creator_uniqueID=$row[$_nodesforum_external_user_system_user_uniqueID_rowname];
			$_nodesforum_display_user_publicname[$this_creator_uniqueID]=$row[$_nodesforum_external_user_system_publicname_rowname];
		}
	}
}
$_nodesforum_display_user_publicname[0]='a guest';
$_nodesforum_display_user_publicname[$_nodesforum_uniqueID_of_deleted_user]='deleted user';

?>
