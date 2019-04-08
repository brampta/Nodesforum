<?php
//if(isset($argv[0])){
	//include('config.php');
	//include('pre_output.php');
//}

_nodesforum_db_conn();

$query="SELECT fapID, ancestry, folder_or_post, containing_folder_or_post, skeleton, creator_uniqueID FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts WHERE deletion_time = 0";
//echo $query."<br>";
$result = mysql_query($query);
while($row = mysql_fetch_array($result)){
	//echo '#'.$row['fapID'].', ancestry: '.$row['ancestry'].'<br>';
	$this_folder_or_post=$row['this_folder_or_post'];
	$this_containing_folder_or_post=$row['containing_folder_or_post'];
    $first_letter_of_containing_folder_or_post=substr($this_containing_folder_or_post,0,1);
    $parent_fapID=substr($this_containing_folder_or_post,1);
    $this_skeleton=$row['skeleton'];
	$explode_ancestry=explode('|',substr($row['ancestry'],1,strlen($row['ancestry'])-2));
	$query2="SELECT fapID, deletion_time FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts WHERE fapID IN(".implode(',',$explode_ancestry).") && deletion_time > 0 order by deletion_time LIMIT 1";
	//echo $query2."<br>";
	$result2 = mysql_query($query2);
	while($row2 = mysql_fetch_array($result2)){
		echo '=========#'.$row['fapID'].' has deleted parent <a href="?_nodesforum_node='.$row2['fapID'].'" target="_blank">#'.$row2['fapID'].'</a> (deletion time: '.$row2['deletion_time'].')<br>';
		$updatequery="UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts SET deletion_time = ".$row2['deletion_time']." WHERE fapID = ".$row['fapID'];
		echo $updatequery."<br>";
		mysql_query($updatequery);
		
		//TODO
		//find info about the parent deletion in mods log
		$query3="SELECT
			mod_uniqueID,
			moded_uniqueID,
			authoritative_folderID,
			subaction_of,
			action_time,
			action_code,
			action,
			retrieval_number
		FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_mods_log WHERE fapID = '$row2[fapID]'";
		//echo $query3."<br>";
		$result3 = mysql_query($query2);
		while($row3 = mysql_fetch_array($result3)){
			$mod_uniqueID=$row3['mod_uniqueID'];
			
			//create new entry for this new deleted accordingly
			$addslashed_ancestry=$row['ancestry'];
			$myquery="INSERT INTO ".$_nodesforum_db_table_name_modifier."_nodesforum_mods_log (
				fapID,
				ancestry,
				mod_uniqueID,
				moded_uniqueID,
				authoritative_folderID,
				subaction_of,
				action_time,
				action_code,
				action,
				retrieval_number
			) VALUES (
				'$row[fapID]',
				'$row[ancestry]',
				'$row3[mod_uniqueID]',
				'$row3[moded_uniqueID]',
				'$row3[authoritative_folderID]',
				'$row3[subaction_of]',
				'$row3[action_time]',
				'$row3[action_code]',
				'$row3[action]',
				'$row3[retrieval_number]'
			)";
			mysql_query($myquery);
		}
		
		//make -1 posts or folders at the rupture point
        if($this_folder_or_post==1)
        {
			mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts SET subfolders = (subfolders - 1) WHERE fapID = '$parent_fapID'");
			if(!$folders_stat_todecrease[$row['creator_uniqueID']]){
				$folders_stat_todecrease[$row['creator_uniqueID']]=1;
			}else{
				$folders_stat_todecrease[$row['creator_uniqueID']]++;
			}
		}
        else if($this_folder_or_post==2)
        {
            if($first_letter_of_containing_folder_or_post=='f')
            {
				mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts SET posts = (posts - 1) WHERE fapID = '$parent_fapID'");
				if(!$posts_stat_todecrease[$row['creator_uniqueID']]){
					$posts_stat_todecrease[$row['creator_uniqueID']]=1;
				}else{
					$posts_stat_todecrease[$row['creator_uniqueID']]++;
				}
			}
            else if($first_letter_of_containing_folder_or_post=='p')
            {
				mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts SET replies = (replies - 1) WHERE fapID = '$parent_fapID'");
				if(!$replies_stat_todecrease[$row['creator_uniqueID']]){
					$replies_stat_todecrease[$row['creator_uniqueID']]=1;
				}else{
					$replies_stat_todecrease[$row['creator_uniqueID']]++;
				}
			}
        }
        
		
		break; //after the first (deleted parent) dont continue (we've already deleted this post or folder now, no need to continue looking for another reason to)
	}
}

//modify user stats
if($folders_stat_todecrease)
{
	foreach($folders_stat_todecrease as $key => $value)
	{mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_user_data SET total_folders = (total_folders - $value) WHERE uniqueID = '$key'");}
}
if($posts_stat_todecrease)
{
	foreach($posts_stat_todecrease as $key => $value)
	{mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_user_data SET total_posts = (total_posts - $value) WHERE uniqueID = '$key'");}
}
if($replies_stat_todecrease)
{
	foreach($replies_stat_todecrease as $key => $value)
	{mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_user_data SET total_replies = (total_replies - $value) WHERE uniqueID = '$key'");}
}
