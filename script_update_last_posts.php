<?php

//update post and folder stats
//Update: subfolders, posts, replies, last_post_postID, last_post_user_uniqueID, last_post_time
$query="SELECT fapID, ancestry, folder_or_post, containing_folder_or_post FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts WHERE deletion_time = 0";
echo $query."<br>";
$result = mysql_query($query);
while($row = mysql_fetch_array($result)){
	//now just select all posts (fapID, folder_or_post, creator_uniqueID, creation_time) that have this post in their ancestry, order them by creation_time DESC
	//count folders and posts, tough if item were updating is a post its posts are replies, if its a folder its posts are posts (I know its a weird design but its too late to change that for the moment...)
	//for first one only remember fapID, creator_uniqueID and creation_time
	
	//then you have all the data, write to item we're updating
}

//update user stats (xxx_nodesforum_user_data)
//Update: total_folders, total_posts, total_replies
$query="SELECT uniqueID FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_user_data";
echo $query."<br>";
$result = mysql_query($query);
while($row = mysql_fetch_array($result)){
	//now just select all posts (folder_or_post,containing_folder_or_post) that have this user's uniqueID for creator_uniqueID
	//count them by folders, posts and replies (use folder_or_post and containing_folder_or_post to determine which is which)
	
	//then you have all the data, write to user were updating
}
