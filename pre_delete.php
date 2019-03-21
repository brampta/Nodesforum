<?php



$addslashed_delete=_nodesforum_my_custom_addslashes($_GET['_nodesforum_delete']);
//get info about post or folder to delete
$result = mysql_query("SELECT creator_uniqueID, creator_ip, creation_time, folder_or_post, containing_folder_or_post, ancestry, skeleton FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts WHERE fapID = '$addslashed_delete'");
while($row = mysql_fetch_array($result))
{
    $this_creator_uniqueID=$row['creator_uniqueID'];
    $this_creator_ip=$row['creator_ip'];
    $this_creation_time=$row['creation_time'];
    $this_folder_or_post=$row['folder_or_post'];
    if($this_folder_or_post==1)
    {$parent_isa='folder';}
    else if($this_folder_or_post==2)
    {$parent_isa='post';}
    $this_containing_folder_or_post=$row['containing_folder_or_post'];
    $first_letter_of_containing_folder_or_post=substr($this_containing_folder_or_post,0,1);
    $parent_fapID=substr($this_containing_folder_or_post,1);
    $parent_ancestry_plus_node=$row['ancestry'];
    $this_skeleton=$row['skeleton'];
}
$oldestacceptabletimeforguesteditbyip=$this_creation_time+($_nodesforum_allow_guests_to_edit_their_posts_for_x_hours*3600);

$issure=0;
if(!isset($_GET['_nodesforum_delete_user']) && !isset($_GET['_nodesforum_delete_ip']))
{$issure=1;}
else
{
    if(isset($_GET['_nodesforum_delete_imsure']))
    {$issure=1;}
}




//if has the right to delete..
if(
(
        (($_nodesforum_ismod==1 && $_GET['_nodesforum_node']==$parent_fapID) || ($_GET['_nodesforum_node']==$_GET['_nodesforum_delete'] && (isset($_GET['_nodesforum_delete_user']) || isset($_GET['_nodesforum_delete_ip']))))
                ||
                $this_creator_uniqueID==$_SESSION[$_nodesforum_external_user_system_uniqueID_session_name]
                ||
                ($this_creator_uniqueID=='0' && $this_creator_ip==$_nodesforum_enc_ip && $nowtime<$oldestacceptabletimeforguesteditbyip)
        )
        &&
        ($this_skeleton==0 || $_nodesforum_power_on_skeleton==1 || $this_creator_uniqueID==$_SESSION[$_nodesforum_external_user_system_uniqueID_session_name])
        &&
        $issure==1
)
{
    if($_nodesforum_ismod==1)
    {$delete_authority=$_nodesforum_modship_authoritative_folder;}
    else if($this_creator_uniqueID==$_SESSION[$_nodesforum_external_user_system_uniqueID_session_name] || ($this_creator_uniqueID=='0' && $this_creator_ip==$_nodesforum_enc_ip && $nowtime<$oldestacceptabletimeforguesteditbyip))
    {$delete_authority=$addslashed_delete;}
    $persondoingshit=$_SESSION[$_nodesforum_external_user_system_uniqueID_session_name];

    $mods_log_retrieval_number=rand(111111111,999999999);
    if(isset($_GET['_nodesforum_delete_user']))
    {$mods_log_retrieval_number='spcus_'.$mods_log_retrieval_number;}
    else if(isset($_GET['_nodesforum_delete_ip']))
    {$mods_log_retrieval_number='spcip_'.$mods_log_retrieval_number;}


    //get data bout this folder or post and all posts and folders that have this post or folder in their ancestry (are children)



    if((isset($_GET['_nodesforum_delete_user']) || isset($_GET['_nodesforum_delete_ip'])) && ($_GET['_nodesforum_delete']=='0' || substr($_GET['_nodesforum_delete'],0,1)=='u' || substr($_GET['_nodesforum_delete'],0,1)=='p'))
    {
        $isa='folder';
        if(isset($_GET['_nodesforum_delete_user']))
        {
            $action_explanor='deleted all posts from user '._nodesforum_my_custom_addslashes($_GET['_nodesforum_delete_user']).' in this '.$isa;
            $this_modded=_nodesforum_my_custom_addslashes($_GET['_nodesforum_delete_user']);
        }
        if(isset($_GET['_nodesforum_delete_ip']))
        {
            $action_explanor='deleted all posts from ip <input type="text" value="'._nodesforum_my_custom_addslashes($_GET['_nodesforum_delete_ip']).'" readonly="readonly" onmouseup="highlight(this)" /> in this '.$isa.'<span style="display:none;">toip</span>';
            $this_modded=0;
        }
        if($_GET['_nodesforum_delete']=='0')
        {$addslashed_ancestry='';}
        else
        {$addslashed_ancestry=$_nodesforum_ancestry_separator.'0'.$_nodesforum_ancestry_separator;}
        $myquery_explanor_pre_action="INSERT INTO ".$_nodesforum_db_table_name_modifier."_nodesforum_mods_log (fapID, ancestry, mod_uniqueID, moded_uniqueID, authoritative_folderID, subaction_of, action_time, action_code, action, retrieval_number) VALUES ('".$addslashed_delete."', '$addslashed_ancestry', '$persondoingshit', '$this_modded', '$delete_authority', '0', '$nowtime', 'DEL', '";
        $myquery_explanor_post_action="', '$mods_log_retrieval_number')";
    }




    $count_deleted=0;
    $myquery="SELECT fapID, creator_uniqueID, AES_ENCRYPT(creator_ip,creator_ip) AS AES_ip, folder_or_post, containing_folder_or_post, ancestry, title FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts WHERE (fapID = '$addslashed_delete' || ancestry LIKE '%".$_nodesforum_ancestry_separator.$addslashed_delete.$_nodesforum_ancestry_separator."%') && deletion_time = 0";
    $result = mysql_query($myquery);
    while($row = mysql_fetch_array($result))
    {
        $this_creator_uniqueID=$row['creator_uniqueID'];
        $this_AES_ip=$row['AES_ip'];
        if($row['fapID']==$_GET['_nodesforum_delete'] && (isset($_GET['_nodesforum_delete_user']) || isset($_GET['_nodesforum_delete_ip'])))
        {
            $subaction_of=0;
            if($row['folder_or_post']==1)
            {$isa='folder';}
            else if($row['folder_or_post']==2)
            {$isa='post';}
            if(isset($_GET['_nodesforum_delete_user']))
            {
                $action_explanor='deleted all posts from user '._nodesforum_my_custom_addslashes($_GET['_nodesforum_delete_user']).' in this '.$isa;
                $this_modded=_nodesforum_my_custom_addslashes($_GET['_nodesforum_delete_user']);
            }
            if(isset($_GET['_nodesforum_delete_ip']))
            {
                $action_explanor='deleted all posts from ip <input type="text" value="'._nodesforum_my_custom_addslashes($_GET['_nodesforum_delete_ip']).'" readonly="readonly" onmouseup="highlight(this)" /> in this '.$isa.'<span style="display:none;">toip</span>';
                $this_modded=0;
            }
            $addslashed_ancestry=$row['ancestry'];
            $myquery_explanor_pre_action="INSERT INTO ".$_nodesforum_db_table_name_modifier."_nodesforum_mods_log (fapID, ancestry, mod_uniqueID, moded_uniqueID, authoritative_folderID, subaction_of, action_time, action_code, action, retrieval_number) VALUES ('$row[fapID]', '$addslashed_ancestry', '$persondoingshit', '$this_modded', '$delete_authority', '0', '$nowtime', 'DEL', '";
            $myquery_explanor_post_action="', '$mods_log_retrieval_number')";
        }
        else if((!isset($_GET['_nodesforum_delete_user']) && !isset($_GET['_nodesforum_delete_ip'])) || (!isset($_GET['_nodesforum_delete_ip']) && (isset($_GET['_nodesforum_delete_user']) && $this_creator_uniqueID==$_GET['_nodesforum_delete_user'])) || (!isset($_GET['_nodesforum_delete_user']) && (isset($_GET['_nodesforum_delete_ip']) && $this_AES_ip==base64_decode($_GET['_nodesforum_delete_ip']))))
        {
            $first_letterof_containing_folder_or_post=substr($row['containing_folder_or_post'],0,1);
            $containing_node=substr($row['containing_folder_or_post'],1);
            //add a count to array of stats to decrease
            $isa='error';
            if($row['folder_or_post']==1)
            {
                if(!$folders_stat_todecrease[$this_creator_uniqueID])
                {$folders_stat_todecrease[$this_creator_uniqueID]=1;}
                else
                {$folders_stat_todecrease[$this_creator_uniqueID]++;}
                $isa='folder';

                if(!$parent_stats_decrease_folders[$containing_node])
                {$parent_stats_decrease_folders[$containing_node]=1;}
                else
                {$parent_stats_decrease_folders[$containing_node]++;}

                if(!$parent_reget_last_post[$containing_node])
                {
                    $parent_reget_last_post[$containing_node]='reget';
                    $parent_reget_last_post_ancestry_plus_node[$containing_node]=$row['ancestry'];
                }
            }
            else if($row['folder_or_post']==2 && $first_letterof_containing_folder_or_post=='f')
            {
                if(!$posts_stat_todecrease[$this_creator_uniqueID])
                {$posts_stat_todecrease[$this_creator_uniqueID]=1;}
                else
                {$posts_stat_todecrease[$this_creator_uniqueID]++;}
                $isa='post';

                if(!$parent_stats_decrease_posts[$containing_node])
                {$parent_stats_decrease_posts[$containing_node]=1;}
                else
                {$parent_stats_decrease_posts[$containing_node]++;}

                if(!$parent_reget_last_post[$containing_node])
                {
                    $parent_reget_last_post[$containing_node]='reget';
                    $parent_reget_last_post_ancestry_plus_node[$containing_node]=$row['ancestry'];
                }
            }
            else if($row['folder_or_post']==2 && $first_letterof_containing_folder_or_post=='p')
            {
                if(!$replies_stat_todecrease[$this_creator_uniqueID])
                {$replies_stat_todecrease[$this_creator_uniqueID]=1;}
                else
                {$replies_stat_todecrease[$this_creator_uniqueID]++;}
                $isa='reply';

                if(!$parent_stats_decrease_replies[$containing_node])
                {$parent_stats_decrease_replies[$containing_node]=1;}
                else
                {$parent_stats_decrease_replies[$containing_node]++;}

                if(!$parent_reget_last_post[$containing_node])
                {
                    $parent_reget_last_post[$containing_node]='reget';
                    $parent_reget_last_post_ancestry_plus_node[$containing_node]=$row['ancestry'];
                }
            }
            //save info about lost post or folder in mods log
            if($row['fapID']==$addslashed_delete)
            {
                $subaction_of=0;
                $action='deleted '.$isa;
            }
            else
            {
                $subaction_of=-1;
                $action='automatically deleted '.$isa.' by deleting parent';
                if(isset($_GET['_nodesforum_delete_user']))
                {$action='automatically deleted '.$isa.' by deleting all posts from user '.$_GET['_nodesforum_delete_user'].' in parent '.$parent_isa;}
                if(isset($_GET['_nodesforum_delete_ip']))
                {$action='deleted all posts from ip <input type="text" value="'._nodesforum_my_custom_addslashes($_GET['_nodesforum_delete_ip']).'" readonly="readonly" onmouseup="highlight(this)" /> in this '.$parent_isa;}
            }
            $addslashed_ancestry=$row['ancestry'];
            $myquery="INSERT INTO ".$_nodesforum_db_table_name_modifier."_nodesforum_mods_log (fapID, ancestry, mod_uniqueID, moded_uniqueID, authoritative_folderID, subaction_of, action_time, action_code, action, retrieval_number) VALUES ('$row[fapID]', '$addslashed_ancestry', '$persondoingshit', '$this_creator_uniqueID', '$delete_authority', '$subaction_of', '$nowtime', 'DEL', '$action', '$mods_log_retrieval_number')";
            mysql_query($myquery);
            $count_deleted++;
        }
    }


    if(isset($_GET['_nodesforum_delete_user']) || isset($_GET['_nodesforum_delete_ip']))
    {
        $action_explanor=$action_explanor.' ('.$count_deleted.')';
        $myquery_explanor=$myquery_explanor_pre_action.$action_explanor.$myquery_explanor_post_action;
        mysql_query($myquery_explanor);
    }


    //retrieve logID of main action
    $main_action_logID=0;
    $result = mysql_query("SELECT logID FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_mods_log WHERE mod_uniqueID = '$persondoingshit' && action_time = '$nowtime' && retrieval_number = '$mods_log_retrieval_number' && subaction_of = 0");
    while($row = mysql_fetch_array($result))
    {$main_action_logID=$row['logID'];}
    //set this logID as subaction_of on all residual actions
    if($main_action_logID!=0)
    {mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_mods_log SET subaction_of = '$main_action_logID' WHERE mod_uniqueID = '$persondoingshit' && action_time = '$nowtime' && retrieval_number = '$mods_log_retrieval_number' && subaction_of = -1");}



    if(!isset($_GET['_nodesforum_delete_user']) && !isset($_GET['_nodesforum_delete_ip']) && $_GET['_nodesforum_delete']!=0)
    {
        //delete this folder or post and all folder and posts that have this folder or post in their ancestry (are children)
        mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts SET deletion_time = '$nowtime' WHERE fapID = '$addslashed_delete' || ancestry LIKE '%".$_nodesforum_ancestry_separator.$addslashed_delete.$_nodesforum_ancestry_separator."%' && deletion_time = 0");
        //make element be not skeleton
        mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts SET skeleton = '0' WHERE fapID = '$addslashed_delete'");


        //make -1 posts or folders at the rupture point
        if($this_folder_or_post==1)
        {mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts SET subfolders = (subfolders - 1) WHERE fapID = '$parent_fapID'");}
        else if($this_folder_or_post==2)
        {
            if($first_letter_of_containing_folder_or_post=='f')
            {mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts SET posts = (posts - 1) WHERE fapID = '$parent_fapID'");}
            else if($first_letter_of_containing_folder_or_post=='p')
            {mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts SET replies = (replies - 1) WHERE fapID = '$parent_fapID'");}
        }


        //new reget last posts
        $exploded_ancestry=explode($_nodesforum_ancestry_separator,$parent_ancestry_plus_node);
        foreach($exploded_ancestry as $key => $value)
        {
            if($value!='')
            {
                $last_fapID=0;
                $last_creatorID=0;
                $last_post_time=0;
                $result = mysql_query("SELECT fapID, creator_uniqueID, creation_time FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts WHERE ancestry LIKE '%".$_nodesforum_ancestry_separator.mysql_real_escape_string($value).$_nodesforum_ancestry_separator."%' && folder_or_post = 2 && deletion_time = 0 ORDER BY creation_time DESC LIMIT 0, 1");
                while($row = mysql_fetch_array($result))
                {
                    $last_fapID=$row['fapID'];
                    $last_creatorID=mysql_real_escape_string($row['creator_uniqueID']);
                    $last_post_time=$row['creation_time'];
                }
                mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts SET last_post_postID = '$last_fapID' WHERE fapID = ".mysql_real_escape_string($value));
                mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts SET last_post_user_uniqueID = '$last_creatorID' WHERE fapID = ".mysql_real_escape_string($value));
                mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts SET last_post_time = '$last_post_time' WHERE fapID = ".mysql_real_escape_string($value));
            }
        }
    }
    else
    {


        //delete the stuff
        if($_GET['_nodesforum_delete_user'])
        {$specific_user_or_ip_clause=" creator_uniqueID = '"._nodesforum_my_custom_addslashes($_GET['_nodesforum_delete_user'])."' ";}
        else if($_GET['_nodesforum_delete_ip'])
        {$specific_user_or_ip_clause=" AES_ENCRYPT(creator_ip,creator_ip) = '".mysql_real_escape_string(base64_decode($_GET['_nodesforum_delete_ip']))."' ";}
        else
        {die('malformed request');}
        mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts SET deletion_time = '$nowtime' WHERE ancestry LIKE '%".$_nodesforum_ancestry_separator.$addslashed_delete.$_nodesforum_ancestry_separator."%' && $specific_user_or_ip_clause && deletion_time = 0");



        //modify post and folder stats
        if($parent_stats_decrease_folders)
        {
            foreach($parent_stats_decrease_folders as $key => $value)
            {mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts SET subfolders = (subfolders - $value) WHERE fapID = '$key'");}
        }
        if($parent_stats_decrease_posts)
        {
            foreach($parent_stats_decrease_posts as $key => $value)
            {mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts SET posts = (posts - $value) WHERE fapID = '$key'");}
        }
        if($parent_stats_decrease_replies)
        {
            foreach($parent_stats_decrease_replies as $key => $value)
            {mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts SET replies = (replies - $value) WHERE fapID = '$key'");}
        }



        //reget last posts
        if($parent_reget_last_post)
        {
            foreach($parent_reget_last_post as $key => $value)
            {



                //new reget last posts
                $exploded_ancestry=explode($_nodesforum_ancestry_separator,$parent_reget_last_post_ancestry_plus_node[$key]);
                foreach($exploded_ancestry as $key2 => $value2)
                {
                    if($value2!='' && !$_nodesforum_already_done[$value2])
                    {
                        $_nodesforum_already_done[$value2]='done';
                        $last_fapID=0;
                        $last_creatorID=0;
                        $last_post_time=0;
                        $result = mysql_query("SELECT fapID, creator_uniqueID, creation_time FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts WHERE ancestry LIKE '%".$_nodesforum_ancestry_separator.mysql_real_escape_string($value2).$_nodesforum_ancestry_separator."%' && folder_or_post = 2 && deletion_time = 0 ORDER BY creation_time DESC LIMIT 0, 1");
                        while($row = mysql_fetch_array($result))
                        {
                            $last_fapID=$row['fapID'];
                            $last_creatorID=mysql_real_escape_string($row['creator_uniqueID']);
                            $last_post_time=$row['creation_time'];
                        }
                        mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts SET last_post_postID = '$last_fapID' WHERE fapID = ".mysql_real_escape_string($value2));
                        mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts SET last_post_user_uniqueID = '$last_creatorID' WHERE fapID = ".mysql_real_escape_string($value2));
                        mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts SET last_post_time = '$last_post_time' WHERE fapID = ".mysql_real_escape_string($value2));
                    }
                }
            }
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


	if(isset($_GET['format']) && $_GET['format']=='json'){
		$json_data['request_number']=$_GET['request_number'];
		$json_data['method']='delete';
		$json_data['result']='ok';
	}else{
		//now redirect to lose vars in URL
		$location='Location: ?_nodesforum_node='.$_GET['_nodesforum_node'].'&_nodesforum_page='.$_GET['_nodesforum_page'];
		header($location);
	}
}






?>
