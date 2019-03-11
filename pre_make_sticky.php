<?php


		$error=0;
		$addslashed_sticking_node=_nodesforum_my_custom_addslashes($_GET['_nodesforum_make_sticky']);
		//make sure that folder to make sticky really has current node for container
		$result = mysql_query("SELECT containing_folder_or_post, ancestry, folder_or_post, creator_uniqueID, skeleton FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts WHERE fapID = '$addslashed_sticking_node'");
		while($row = mysql_fetch_array($result))
		{
			if($row['containing_folder_or_post']!='f'.$_GET['_nodesforum_node'])
			{$error=1;}
			$remember_ancestryz=$row['ancestry'];
			$remember_folder_or_post=$row['folder_or_post'];
			$remember_creator_uniqueID=$row['creator_uniqueID'];
			$remember_skeleton=$row['skeleton'];
		}
		$cantmoveskeleton=1;
		if($remember_skeleton==0 || $_nodesforum_power_on_skeleton==1)
		{$cantmoveskeleton=0;}
		if($cantmoveskeleton==1)
		{$error=1;}
		if($error==0)
		{
			//find highest sticky number in this container to give that + 1
			$highest=0;
			$result = mysql_query("SELECT sticky FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts WHERE containing_folder_or_post = 'f$addslashed_node' ORDER BY sticky DESC LIMIT 0, 1");
			while($row = mysql_fetch_array($result))
			{$highest=$row['sticky'];}
			$new_sticky_number=$highest+1;
			mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts SET sticky = '$new_sticky_number' WHERE fapID = '$addslashed_sticking_node'");


			//write to mods log
			if($remember_folder_or_post==1)
			{$isa='folder';}
			else
			{$isa='post';}
			$addslashed_authority=mysql_real_escape_string($_nodesforum_modship_authoritative_folder);
			$persondoingshit=$_SESSION[$_nodesforum_external_user_system_uniqueID_session_name];
			$addslashed_moderee=mysql_real_escape_string($remember_creator_uniqueID);
			$action='made '.$isa.' sticky';
			$myquery="INSERT INTO ".$_nodesforum_db_table_name_modifier."_nodesforum_mods_log (fapID, ancestry, mod_uniqueID, moded_uniqueID, authoritative_folderID, subaction_of, action_time, action_code, action) VALUES ('$addslashed_sticking_node', '".mysql_real_escape_string($remember_ancestryz)."', '$persondoingshit', '$addslashed_moderee', '$addslashed_authority', '0', '$nowtime', 'STK', '$action')";
			mysql_query($myquery);


			//redirect
			$location='Location: ?_nodesforum_node='.$_GET['_nodesforum_node'].'&_nodesforum_page='.$_GET['_nodesforum_page'];
			header($location);
		}




?>
