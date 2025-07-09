<?php



	$error=0;
	if(substr($_GET['_nodesforum_node'],0,1)=='s' && substr($_GET['_nodesforum_node'],1)==$_SESSION[$_nodesforum_external_user_system_uniqueID_session_name])
	{
		$preletter='s';
		$containing_folder_or_post=$addslashed_node;
		//check if user already has a post for signature
		$result = mysql_query("SELECT fapID FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts WHERE containing_folder_or_post = '$addslashed_node'");
		while($row = mysql_fetch_array($result))
		{$error=1; $_nodesforum_already_haveapostfor_signature=1;}
	}
	else
	{
		if($_nodesforum_folder_or_post==1)
		{$preletter='f';}
		else if($_nodesforum_folder_or_post==2)
		{$preletter='p';}
		$containing_folder_or_post=$preletter.$addslashed_node;
	}
	if(isset($_SESSION[$_nodesforum_external_user_system_uniqueID_session_name]))
	{$my_uniqueID=$_SESSION[$_nodesforum_external_user_system_uniqueID_session_name];}
	else
	{$my_uniqueID=0;}
	$addslashed_newtitle=_nodesforum_my_custom_addslashes($_POST['_nodesforum_new_post_title']);
	//$addslashed_newpost=my_custom_addslashes($_POST['_nodesforum_new_post']);
	$addslashed_allow_guest_reply=_nodesforum_my_custom_addslashes($_POST['_nodesforum_allow_guest_reply']);
	$disable_auto_smileys=0;
	if(isset($_POST['_nodesforum_disable_auto_smileys']))
	{$disable_auto_smileys=1;}
	$disable_auto_links=0;
	if(isset($_POST['_nodesforum_disable_auto_links']))
	{$disable_auto_links=1;}





	//verify validity of strict quotes
	$string=_nodesforum_my_custom_stripslashes($_POST['_nodesforum_new_post']);
	require($_nodesforum_code_path.'pre_verify_validity_of_strict_quotes.php');
	$_POST['_nodesforum_new_post']=$string;
	$addslashed_newpost=mysql_real_escape_string($_POST['_nodesforum_new_post']);





	if($_nodesforum_folder_or_post==1)
	{
		if(strlen($_POST['_nodesforum_new_post'])<$_nodesforum_minimum_post_length)
		{$error=1; $_nodesforum_post_too_short=1;}
	}
	else if($_nodesforum_folder_or_post==2)
	{
		if(strlen($_POST['_nodesforum_new_post'])<$_nodesforum_minimum_reply_length)
		{$error=1; $_nodesforum_reply_too_short=1;}
	}
	if(!isset($_SESSION[$_nodesforum_external_user_system_uniqueID_session_name]) && $_nodesforum_image_verification_on_guest_reply=='yes')
	{
		if(md5(strtolower($_POST['_nodesforum_numbazx']))!=$_SESSION['img_ver_gpost'])
		{$error=1; $_nodesforum_img_ver_invalid=1;}
	}
	if($_nodesforum_folder_or_post==1)
	{
		if($_POST['_nodesforum_new_post_title']=='')
		{$error=1; $_nodesforum_create_post_namecannotbeblank=1;}
	}
	if($error==0)
	{
		// if(substr($_GET['_nodesforum_node'],0,1)=='s' && substr($_GET['_nodesforum_node'],1)==$_SESSION[$_nodesforum_external_user_system_uniqueID_session_name])
		// {$new_ancestry='';}
		// else
		{$new_ancestry=$_nodesforum_ancestry.$addslashed_node.$_nodesforum_ancestry_separator;}
		
		$audited=0;
		if($_nodesforum_righttoaudit==1){
			$audited=1;
		}
		$myquery="INSERT INTO ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts (
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
			disable_auto_smileys,
			disable_auto_links,
			audited
		) VALUES (
			'2',
			'$containing_folder_or_post',
			'$my_uniqueID',
			'$_nodesforum_enc_ip',
			'$nowtime',
			'$addslashed_newtitle',
			'$addslashed_newpost',
			'0',
			'$addslashed_allow_guest_reply',
			'$new_ancestry',
			'0',
			'0',
			'0',
			'0',
			'0',
			'0',
			'$nowtime',
			'0',
			'$disable_auto_smileys',
			'$disable_auto_links',
			'$audited'
		)";
		if(mysql_query($myquery))
		{

			
			if(substr($_GET['_nodesforum_node'],0,1)=='s' && substr($_GET['_nodesforum_node'],1)==$_SESSION[$_nodesforum_external_user_system_uniqueID_session_name])
			{
				//if is a signature post:
				
				
				//retrieve newly created post fapID
				$myquery="SELECT fapID FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts WHERE containing_folder_or_post = '$containing_folder_or_post' && creator_uniqueID = '$my_uniqueID' && creation_time = '$nowtime'";
				$result = mysql_query($myquery);
				while($row = mysql_fetch_array($result))
				{$retrieved_fapID=$row['fapID'];}
				//write it down in user_data
				$hasuserdata=0;
				$result = mysql_query("SELECT avatar, signature FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_user_data WHERE uniqueID = '$my_uniqueID'");
				while($row = mysql_fetch_array($result))
				{$hasuserdata=1;}
				if($hasuserdata==0)
				{mysql_query("INSERT INTO ".$_nodesforum_db_table_name_modifier."_nodesforum_user_data (uniqueID, signature) VALUES ('$my_uniqueID', '$retrieved_fapID')");}
				else
				{mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_user_data SET signature = '$retrieved_fapID' WHERE uniqueID = '$my_uniqueID'");}
				//change vars to goback to forum options page
				unset($_GET['_nodesforum_add_post']);
				$_GET['_nodesforum_forum_options']=1;
				$_nodesforum_willread_user_data_for_forumoptionspage=1;
			}
			else
			{
				$_nodesforum_youarehere=$_nodesforum_original_youarehere;
				unset($_GET['_nodesforum_add_post']);
				$_GET['_nodesforum_page']='last';
				if($_nodesforum_folder_or_post==1)
				{
					//update amount of posts in parent folder
					$queryRows=mysql_query("SELECT COUNT(fapID) FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts WHERE folder_or_post = 2 && containing_folder_or_post = 'f$addslashed_node' && deletion_time = 0");
					$numRows=mysql_fetch_array($queryRows);
					$totalpostsincontainingfolder=$numRows[0];
					mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts SET posts = $totalpostsincontainingfolder WHERE fapID = $addslashed_node");
					//get fapID of new post (will be needed to record "last post" on all parents)
					//$result = mysql_query("SELECT fapID FROM _nodesforum_folders_and_posts WHERE folder_or_post = 2 && containing_folder_or_post = '$containing_folder_or_post' && title = '$addslashed_newtitle'");
					//while($row = mysql_fetch_array($result))
					//{$last_post_node=$row['fapID'];}

					//add 1 post to user_data for this user
					$useralreadyhasuserdata=0;
					if($result = mysql_query("SELECT uniqueID FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_user_data WHERE uniqueID = '$my_uniqueID'"))
					{
						while($row = mysql_fetch_array($result))
						{$useralreadyhasuserdata=1;}
						if($useralreadyhasuserdata==1)
						{mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_user_data SET total_posts = (total_posts + 1) WHERE uniqueID = '$my_uniqueID'");}
						else
						{mysql_query("INSERT INTO ".$_nodesforum_db_table_name_modifier."_nodesforum_user_data (uniqueID, total_posts) VALUES ('$my_uniqueID', 1)");}
					}
				}
				else if($_nodesforum_folder_or_post==2)
				{
					//update amount of replies in this post
					$myquery="SELECT COUNT(fapID) FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts WHERE folder_or_post = 2 && containing_folder_or_post = 'p$addslashed_node' && deletion_time = 0";
					$queryRows=mysql_query($myquery);
					$numRows=mysql_fetch_array($queryRows);
					$totalreplies=$numRows[0];
					$myquery="UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts SET replies = $totalreplies WHERE fapID = $addslashed_node";
					//echo htmlspecialchars($myquery).'<br />';
					mysql_query($myquery);
					//$last_post_node=$addslashed_node;

					//add 1 reply to user_data for this user
					$useralreadyhasuserdata=0;
					if($result = mysql_query("SELECT uniqueID FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_user_data WHERE uniqueID = '$my_uniqueID'"))
					{
						while($row = mysql_fetch_array($result))
						{$useralreadyhasuserdata=1;}
						if($useralreadyhasuserdata==1)
						{mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_user_data SET total_replies = (total_replies + 1) WHERE uniqueID = '$my_uniqueID'");}
						else
						{mysql_query("INSERT INTO ".$_nodesforum_db_table_name_modifier."_nodesforum_user_data (uniqueID, total_replies) VALUES ('$my_uniqueID', 1)");}
					}
				}
				//record "last post" on all parents
				$exploded_ancestry=explode($_nodesforum_ancestry_separator,$_nodesforum_ancestry);
				$wherer="'".$addslashed_node."'";
				foreach($exploded_ancestry as $key => $value)
				{
					if($value!='' && $value!=0)
					{$wherer=$wherer.", '".mysql_real_escape_string($value)."'";}
				}



			
			
			
				//get fapID of new post (will be needed to record "last post" on all parents)
				//$myquery="SELECT fapID FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts WHERE folder_or_post = 2 && containing_folder_or_post = '$containing_folder_or_post' && title = '$addslashed_newtitle'";
				$myquery="SELECT fapID FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts WHERE folder_or_post = 2 && containing_folder_or_post = '$containing_folder_or_post' && creator_uniqueID = '$my_uniqueID' && creation_time = '$nowtime'";
				//echo htmlspecialchars($myquery).'<br />';
				$result = mysql_query($myquery);
				while($row = mysql_fetch_array($result))
				{$last_post_node=$row['fapID'];}

				$myquery="UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts SET last_post_postID = '$last_post_node' WHERE fapID in ($wherer)";
				//echo htmlspecialchars($myquery).'<br />';
				mysql_query($myquery);
				mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts SET last_post_user_uniqueID = $my_uniqueID WHERE fapID in ($wherer)");
				mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts SET last_post_time = $nowtime WHERE fapID in ($wherer)");
				//now redirect to lose vars in URL
				$location='Location: ?_nodesforum_node='.$_GET['_nodesforum_node'].'&_nodesforum_page='.$_GET['_nodesforum_page'];
				header($location);
			}
		}
		else
		{$_nodesforum_create_post_dberror=1; $_nodesforum_remember_wtf=mysql_error();}
	}

