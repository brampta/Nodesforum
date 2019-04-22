<?php
//TO BE TESTED (the whole script)

_nodesforum_db_conn();

//update post and folder stats
//Update: subfolders, posts, replies, last_post_postID, last_post_user_uniqueID, last_post_time
$query="SELECT fapID, ancestry, folder_or_post, containing_folder_or_post FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts WHERE deletion_time = 0";
echo $query."<br>";
$result = mysql_query($query);
while($row = mysql_fetch_array($result)){
	echo "counting for element #".$row['fapID']."<br>";
	//now just select all posts (fapID, folder_or_post, creator_uniqueID, creation_time) that have this post in their ancestry (and are not deleted lol, thats the whole point!), order them by creation_time DESC
	//count folders and posts, tough if item were updating is a post its posts are replies, if its a folder its posts are posts (I know its a weird design but its too late to change that for the moment...)
	//for first one only remember fapID, creator_uniqueID and creation_time
	if($row['folder_or_post']==1){
		$parents_first_letter='f';
	}else if($row['folder_or_post']==2){
		$parents_first_letter='p';
	}
	$total_subfolders=0;
	$total_posts=0;
	$total_replies=0;
	$last_post_id=0;
	$last_post_user_uniqueID=0;
	$last_post_time=0;
	$found_first_post=false;
	$query2="SELECT fapID, folder_or_post, creator_uniqueID, ancestry FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts WHERE /*ancestry LIKE '%".$_nodesforum_ancestry_separator.$addslashed_delete.$_nodesforum_ancestry_separator."%'*/ containing_folder_or_post = '".$parents_first_letter.$row['fapID']."' && deletion_time = 0 ORDER BY creation_time DESC";
	echo "....".$query2."<br>";
	$result2 = mysql_query($query2);
	while($row2 = mysql_fetch_array($result2)){
		echo "post ".$row2['fapID']."(folder_or_post: ".$row['folder_or_post'].", ancestry)";
		if($row2['folder_or_post']==2 && !$found_first_post){
			$last_post_id=$row2['fapID'];
			$last_post_user_uniqueID=$row2['creator_uniqueID'];
			$last_post_time=$row2['creator_uniqueID'];
			$found_first_post=true;
		}
		if($row['folder_or_post']==1 && $row2['folder_or_post']==1){
			$total_subfolders++;
		}else if($row['folder_or_post']==1 && $row2['folder_or_post']==2){
			$total_posts++;
		}else if($row['folder_or_post']==2 && $row2['folder_or_post']==2){
			$total_replies++;
		}
	}
	
	//then you have all the data, write to item we're updating
	$updatequery="UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts SET 
	subfolders = '".$total_subfolders."',
	posts = '".$total_posts."',
	replies = '".$total_replies."',
	last_post_postID = '".$last_post_id."',
	last_post_user_uniqueID = '".$last_post_user_uniqueID."',
	last_post_time = '".$last_post_time."'
	WHERE fapID = '".$row['fapID']."'";
	echo "++++".$updatequery."<br>";
	//mysql_query($updatequery);
}

//update user stats (xxx_nodesforum_user_data)
//Update: total_folders, total_posts, total_replies
$query="SELECT uniqueID FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_user_data";
echo $query."<br>";
$result = mysql_query($query);
while($row = mysql_fetch_array($result)){
	//now just select all posts (folder_or_post,containing_folder_or_post) that have this user's uniqueID for creator_uniqueID (and are not deleted)
	//count them by folders, posts and replies (use folder_or_post and containing_folder_or_post to determine which is which)
	$total_folders=0;
	$total_posts=0;
	$total_replies=0;
	$query2="SELECT fapID, folder_or_post, creator_uniqueID, containing_folder_or_post FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts WHERE creator_uniqueID = '".$row['uniqueID']."' && deletion_time = 0 ORDER BY creation_time DESC";
	echo "....".$query2."<br>";
	$result2 = mysql_query($query2);
	while($row2 = mysql_fetch_array($result2)){
		$firstletterof_containing_folder_or_post=substr($row2['containing_folder_or_post'],0,1);
		if($row2['folder_or_post']==1){
			$total_folders++;
		}else if($row['folder_or_post']==2 && $firstletterof_containing_folder_or_post=='p'){
			$total_replies++;
		}else if($row['folder_or_post']==2){
			$total_posts++;
		}
	}
	
	//then you have all the data, write to user were updating
	$updatequery="UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_user_data SET 
	total_folders = '.$total_subfolders.',
	total_posts = '.$total_posts.',
	total_replies = '.$total_replies.'
	WHERE uniqueID = ".$row['uniqueID'];
	echo "++++".$updatequery."<br>";
	//mysql_query($updatequery);
}
