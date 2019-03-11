<?php


$addslashed_wanted_element=_nodesforum_my_custom_addslashes($_GET['_nodesforum_permalink']);
//get containing folder of wanted element
$result = mysql_query("SELECT folder_or_post, containing_folder_or_post, last_post_time, creation_time FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts WHERE fapID = '$addslashed_wanted_element'");
while($row = mysql_fetch_array($result))
{
	$firstletterof_containing_folder_or_post=substr($row['containing_folder_or_post'],0,1);
	if($row['folder_or_post']==2 && $firstletterof_containing_folder_or_post=='f')
	{
		$_GET['_nodesforum_node']=$addslashed_wanted_element;
		$_GET['_nodesforum_page']=1;
	}
	else
	{
		$fapID_containing_folder_or_post=substr($row['containing_folder_or_post'],1);
		$_GET['_nodesforum_node']=$fapID_containing_folder_or_post;
		if($firstletterof_containing_folder_or_post=='f')
		{
			$myquery="SELECT COUNT(fapID) FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts WHERE containing_folder_or_post = '$row[containing_folder_or_post]' && deletion_time = 0 && (last_post_time > $row[last_post_time] || (last_post_time = $row[last_post_time] && creation_time < $row[creation_time]))";
			$queryRows = mysql_query($myquery);
			$numRows=mysql_fetch_array($queryRows);
			$totalelementsbefore=$numRows[0];
			$_GET['_nodesforum_page']=ceil(($totalelementsbefore+1)/$_nodesforum_howmany_posts_perpage);
			if($_GET['ghost']==1)
			{
				$myquery="SELECT COUNT(fapID) FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts WHERE containing_folder_or_post = '$row[containing_folder_or_post]' && (last_post_time > $row[last_post_time] || (last_post_time = $row[last_post_time] && creation_time < $row[creation_time]))";
				$queryRows = mysql_query($myquery);
				$numRows=mysql_fetch_array($queryRows);
				$totalelementsbefore=$numRows[0];
				$ghost_permalink_page=ceil(($totalelementsbefore+1)/$_nodesforum_howmany_posts_perpage);
				$get_ghost_permalink_page=1;
			}
		}
		else if($firstletterof_containing_folder_or_post=='p')
		{
			$queryRows = mysql_query("SELECT COUNT(fapID) FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts WHERE containing_folder_or_post = '$row[containing_folder_or_post]' && deletion_time = 0 && creation_time < $row[creation_time]");
			$numRows=mysql_fetch_array($queryRows);
			$totalelementsbefore=$numRows[0]+1;
			$_GET['_nodesforum_page']=ceil(($totalelementsbefore+1)/$_nodesforum_howmany_replies_perpage);
			if($_GET['ghost']==1)
			{
				$queryRows = mysql_query("SELECT COUNT(fapID) FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts WHERE containing_folder_or_post = '$row[containing_folder_or_post]' && creation_time < $row[creation_time]");
				$numRows=mysql_fetch_array($queryRows);
				$totalelementsbefore=$numRows[0]+1;
				$ghost_permalink_page=ceil(($totalelementsbefore+1)/$_nodesforum_howmany_replies_perpage);
				$get_ghost_permalink_page=1;
			}
		}
	}
}





?>
