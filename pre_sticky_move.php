<?php



		$error=0;
		$addslashed_sticking_node1=_nodesforum_my_custom_addslashes($_GET['_nodesforum_sticky_move']);
		$addslashed_sticking_node2=_nodesforum_my_custom_addslashes($_GET['_nodesforum_sticky_switcher']);
		//make sure that both concerned elements have current node for container
		$result = mysql_query("SELECT fapID, sticky, containing_folder_or_post, ancestry, folder_or_post, creator_uniqueID, skeleton FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts WHERE fapID = '$addslashed_sticking_node1' || fapID = '$addslashed_sticking_node2'");
		while($row = mysql_fetch_array($result))
		{
			if($row['fapID']==$_GET['_nodesforum_sticky_move'])
			{
				$pos_of1=$row['sticky'];
				$remember_ancestryz=$row['ancestry'];
				$remember_folder_or_post=$row['folder_or_post'];
				$remember_creator_uniqueID=$row['creator_uniqueID'];
				$remember_skeleton=$row['skeleton'];
			}
			if($row['fapID']==$_GET['_nodesforum_sticky_switcher'])
			{$pos_of2=$row['sticky'];}
			if($row['containing_folder_or_post']!='f'.$_GET['_nodesforum_node'])
			{$error=1;}
		}
		$cantmoveskeleton=1;
		if($remember_skeleton==0 || $_nodesforum_power_on_skeleton==1)
		{$cantmoveskeleton=0;}
		if($cantmoveskeleton==1)
		{$error=1;}
		if($error==0)
		{
			//exchange sticky positions
			mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts SET sticky = '$pos_of2' WHERE fapID = '$addslashed_sticking_node1'");
			mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts SET sticky = '$pos_of1' WHERE fapID = '$addslashed_sticking_node2'");


			//write to mods log
			if($remember_folder_or_post==1)
			{$isa='folder';}
			else
			{$isa='post';}
			$addslashed_authority=mysql_real_escape_string($_nodesforum_modship_authoritative_folder);
			$persondoingshit=$_SESSION[$_nodesforum_external_user_system_uniqueID_session_name];
			$addslashed_moderee=mysql_real_escape_string($remember_creator_uniqueID);
			if($pos_of1<$pos_of2)
			{$direction='down';}
			else if($pos_of1>$pos_of2)
			{$direction='up';}
			$action='moved sticky '.$isa.' '.$direction;
			$myquery="INSERT INTO ".$_nodesforum_db_table_name_modifier."_nodesforum_mods_log (fapID, ancestry, mod_uniqueID, moded_uniqueID, authoritative_folderID, subaction_of, action_time, action_code, action) VALUES ('$addslashed_sticking_node1', '".mysql_real_escape_string($remember_ancestryz)."', '$persondoingshit', '$addslashed_moderee', '$addslashed_authority', '0', '$nowtime', 'STK', '$action')";
			mysql_query($myquery);


			//redirect
			$location='Location: ?_nodesforum_node='.$_GET['_nodesforum_node'].'&_nodesforum_page='.$_GET['_nodesforum_page'].'#_nodesforum_anchor_'.$addslashed_sticking_node1.'';
			header($location);
		}

?>
