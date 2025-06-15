<?php




$addslashed_main_actionID=_nodesforum_my_custom_addslashes($_GET['_nodesforum_main_actionID']);
$addslashed_handling_fapID=_nodesforum_my_custom_addslashes($_GET['_nodesforum_handling_fapID']);
$error=0;




//get retrieval_number associated with this main_actionID to see if this was spcfc_ delete or normal
$myquery="SELECT retrieval_number FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_mods_log WHERE logID = '$addslashed_main_actionID'";
$result = mysql_query($myquery);
while($row = mysql_fetch_array($result))
{$retrieval_number=$row['retrieval_number'];}




//read info about this node
$node_exist=0;

if($addslashed_handling_fapID=='0')
{
    $node_exist=1;
    $this_ancestry='';
    $first_letter_of_containing_folder_or_post='f';
    $this_containing_folder_or_post='';
    $this_folder_or_post=1;
    $_nodesforum_move_title='root';
    $_nodesforum_move_creator_uniqueID=$_nodesforum_main_mod_uniqueID;
    $_nodesforum_move_ancestry=$this_ancestry;
    $_nodesforum_move_folder_or_post=1;
    $_nodesforum_move_from='';
}
else if(substr($addslashed_handling_fapID,0,1)=='u')
{
    if(substr($addslashed_handling_fapID,0,1)=='0')
    {
        $node_exist=1;
        $_nodesforum_move_title='guests forum page';
    }
    else if(substr($addslashed_handling_fapID,0,1)==$_nodesforum_uniqueID_of_deleted_user)
    {
        $node_exist=1;
        $_nodesforum_move_title='deleted users forum page';
    }
    else
    {
        $myquery="SELECT $_nodesforum_external_user_system_publicname_rowname FROM $_nodesforum_external_user_system_table_name WHERE $_nodesforum_external_user_system_user_uniqueID_rowname = '"._nodesforum_my_custom_addslashes(substr($addslashed_handling_fapID,0,1))."'";
        $result = mysql_query($myquery);
        while($row = mysql_fetch_array($result))
        {
            $node_exist=1;
            $lastcharofpubname=substr($row[$_nodesforum_external_user_system_publicname_rowname],strlen($row[$_nodesforum_external_user_system_publicname_rowname])-1);
            $proprietary_s='s';
            if($lastcharofpubname=='s' || $lastcharofpubname=='z')
            {$proprietary_s='';}
            $_nodesforum_move_title=_nodesforum_display_title($row[$_nodesforum_external_user_system_publicname_rowname])."'".$proprietary_s." forum page";
        }
    }
    $this_ancestry=$_nodesforum_ancestry_separator.'0'.$_nodesforum_ancestry_separator;
    $first_letter_of_containing_folder_or_post='f';
    $this_containing_folder_or_post='0';
    $this_folder_or_post=1;
    $_nodesforum_move_creator_uniqueID=substr($addslashed_handling_fapID,0,1);
    $_nodesforum_move_ancestry=$this_ancestry;
    $_nodesforum_move_folder_or_post=1;
    $_nodesforum_move_from=_nodesforum_make_ancestryz($_nodesforum_move_ancestry);
}
else if(substr($addslashed_handling_fapID,0,1)=='p')
{
    $_nodesforum_elnode=substr($addslashed_handling_fapID,0,1);
    if($_nodesforum_risky_bbcode_title[$_nodesforum_elnode])
    {
        $node_exist=1;
        $_nodesforum_move_title=$_nodesforum_risky_bbcode_title[$_nodesforum_elnode];
    }
    $this_ancestry=$_nodesforum_ancestry_separator.'0'.$_nodesforum_ancestry_separator;
    $first_letter_of_containing_folder_or_post='f';
    $this_containing_folder_or_post='0';
    $this_folder_or_post=1;
    $_nodesforum_move_creator_uniqueID=$_nodesforum_main_mod_uniqueID;
    $_nodesforum_move_ancestry=$this_ancestry;
    $_nodesforum_move_folder_or_post=1;
    $_nodesforum_move_from=_nodesforum_make_ancestryz($_nodesforum_move_ancestry);
}


$myquery="SELECT ancestry, containing_folder_or_post, folder_or_post, title, creator_uniqueID FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts WHERE fapID = '$addslashed_handling_fapID'";
$result = mysql_query($myquery);
while($row = mysql_fetch_array($result))
{
    $node_exist=1;
    $this_ancestry=$row['ancestry'];
    $first_letter_of_containing_folder_or_post=substr($row['containing_folder_or_post'],0,1);
    $this_containing_folder_or_post=substr($row['containing_folder_or_post'],1);
    $this_folder_or_post=$row['folder_or_post'];
    if(substr($retrieval_number,0,6)!='spcfc_')
    {
        //set some vars about this node just in case we decide to offer to "move and restore" it
        $_nodesforum_move_title=$row['title'];
        $_nodesforum_move_creator_uniqueID=$row['creator_uniqueID'];
        $_nodesforum_move_ancestry=$row['ancestry'];
        $_nodesforum_move_folder_or_post=$row['folder_or_post'];
        $_nodesforum_move_from=_nodesforum_make_ancestryz($_nodesforum_move_ancestry);
    }
}
if($node_exist==0)
{$error=1; $_nodesforum_restore_node_noexist=1;}
//decide if user has the right to restore this element
$has_the_right=0;
$delete_authority=-1;
$exploded_ancestry=explode($_nodesforum_ancestry_separator,$this_ancestry);
foreach($exploded_ancestry as $key => $value)
{
    if($value!='' && $_nodesforum_remember_modership_folders[$value])
    {
        $has_the_right=1;
        $delete_authority=$value;
        break;
    }
}
if($has_the_right==0 && $_nodesforum_remember_modership_folders[$addslashed_handling_fapID])
{
    $has_the_right=1;
    $delete_authority=$addslashed_handling_fapID;
}
if($has_the_right==0)
{$error=1; $_nodesforum_restore_post_or_folder_has_no_right=1;}



if(substr($retrieval_number,0,6)!='spcus_' || substr($retrieval_number,0,6)!='spcip_')
{
    //check if container is active
    $container_active=0;
    if($this_containing_folder_or_post==0)
    {$container_active=1;}
    else if(substr($this_containing_folder_or_post,0,1)=='p')
    {
        if($_nodesforum_risky_bbcode_title[$_nodesforum_move_destination])
        {$container_active=1;}
    }
    if(substr($this_containing_folder_or_post,0,1)=='u')
    {
        $this_uniqueID=mysql_real_escape_string(substr($this_containing_folder_or_post,1));
        $myquery="SELECT $_nodesforum_external_user_system_user_uniqueID_rowname FROM $_nodesforum_external_user_system_table_name WHERE $_nodesforum_external_user_system_user_uniqueID_rowname = '$this_uniqueID'";
        $result = mysql_query($myquery);
        while($row = mysql_fetch_array($result))
        {
            $container_active=1;
        }
    }
    else
    {
        $myquery="SELECT fapID FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts WHERE fapID = '$this_containing_folder_or_post' && deletion_time = 0";
        $result = mysql_query($myquery);
        while($row = mysql_fetch_array($result))
        {
            $container_active=1;
        }
    }
    if($container_active==0)
    {
        if($this_folder_or_post==2 && $first_letter_of_containing_folder_or_post=='p')
        {$error=1; $_nodesforum_restore_cannot_restore_reply_if_post_is_deleted=1;}
        else
        {
            //if no other errors, will trigger "move and restore"
            if($error==0)
            {
                $_nodesforum_gofor_move_and_restore=1;
                //set some vars for the move to work
                if(!isset($_GET['_nodesforum_remember_node_togobackto']))
                {
                    $_GET['_nodesforum_remember_node_togobackto']=$_GET['_nodesforum_node'];
                    $_GET['_nodesforum_remember_page_togobackto']=$_GET['_nodesforum_page'];
                }
                $_GET['_nodesforum_node']=$this_containing_folder_or_post;
                $_GET['_nodesforum_page']=1;
                $_GET['_nodesforum_move']=$_GET['_nodesforum_handling_fapID'];
            }
            $error=1;
        }
    }
}




//perform restore if no errors
if($error==0)
{
    //get tree of fapID to restore from the mods log
    $_nodesforum_ismass_restore=0;
    $myquery="SELECT fapID, subaction_of, moded_uniqueID, action FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_mods_log WHERE (logID = '$addslashed_main_actionID' || subaction_of = '$addslashed_main_actionID') && (fapID = '$addslashed_handling_fapID' || ancestry LIKE '%".$_nodesforum_ancestry_separator.$addslashed_handling_fapID.$_nodesforum_ancestry_separator."%')";
    $result = mysql_query($myquery);
    while($row = mysql_fetch_array($result))
    {
        if((substr($retrieval_number,0,6)=='spcus_' || substr($retrieval_number,0,6)=='spcip_') && $row['subaction_of']==0)
        {
            $_nodesforum_ismass_restore=1;
            $action_triggering_fapID=$row['fapID'];
            if($row['moded_uniqueID']==0)
            {
                $user_or_ip='ip';
                $startofip=stripos($row['action'],'value="')+7;
                $endofip=stripos($row['action'],'"',$startofip+1);
                $lenofip=$endofip-$startofip;
                $the_userorip=substr($row['action'],$startofip,$lenofip);
                $xplain_it='ip <input type="text" value="'._nodesforum_my_custom_addslashes($the_userorip).'" readonly="readonly" onmouseup="highlight(this)" />';
            }
            else
            {
                $user_or_ip='user';
                $the_userorip=$row['moded_uniqueID'];
                $xplain_it='user '.$the_userorip;
            }
        }
        else
        {
            $this_fapID=$row['fapID'];
            $affected_node[$this_fapID]='yes';
        }
    }



    //run the node and all of its children and restore them while writting it down in the mods log

    $timeofaction=$nowtime;
    if(isset($_GET['_nodesforum_move']))
    {$timeofaction=$nowtime+1;}
    $persondoingshit=$_SESSION[$_nodesforum_external_user_system_uniqueID_session_name];
    $mods_log_retrieval_number=rand(111111111,999999999);




    if($_nodesforum_ismass_restore==1 && ($action_triggering_fapID=='0' || substr($action_triggering_fapID,0,1)=='u' || substr($action_triggering_fapID,0,1)=='p'))
    {
        $isa='folder';
        if($user_or_ip=='ip')
        {
            $affected_user=0;
            $change_user_to_ip_in_mods_log_sign='<span style="display:none;">toip</span>';
        }
        else
        {
            $affected_user=$the_userorip;
            $change_user_to_ip_in_mods_log_sign='';
        }
        if($action_triggering_fapID=='0')
        {$addslashed_ancestry='';}
        else
        {$addslashed_ancestry=$_nodesforum_ancestry_separator.'0'.$_nodesforum_ancestry_separator;}
        $action_explanor='restored all posts from '.$xplain_it.' in this '.$isa.$change_user_to_ip_in_mods_log_sign;
        $myquery_explanor_pre_action="INSERT INTO ".$_nodesforum_db_table_name_modifier."_nodesforum_mods_log (fapID, ancestry, mod_uniqueID, moded_uniqueID, authoritative_folderID, subaction_of, action_time, action_code, action, retrieval_number) VALUES ('$action_triggering_fapID', '$addslashed_ancestry', '$persondoingshit', '$affected_user', '$delete_authority', '0', '$timeofaction', 'RES', '";
        $myquery_explanor_post_action="', '$mods_log_retrieval_number')";
    }



    $count_restored=0;


    $alsoreadmainerevenifnotdeleted_addtoclause='';
    if(substr($retrieval_number,0,6)=='spcus_' || substr($retrieval_number,0,6)=='spcip_')
    {$alsoreadmainerevenifnotdeleted_addtoclause=" || fapID = '".$action_triggering_fapID."'";}
    $myquery="SELECT fapID, ancestry, creator_uniqueID, folder_or_post, containing_folder_or_post FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts WHERE (fapID = '$addslashed_handling_fapID' || ancestry LIKE '%".$_nodesforum_ancestry_separator.$addslashed_handling_fapID.$_nodesforum_ancestry_separator."%') && (deletion_time != 0".$alsoreadmainerevenifnotdeleted_addtoclause.")";
    $result = mysql_query($myquery);
    while($row = mysql_fetch_array($result))
    {
        $this_fapID=$row['fapID'];
        $this_creator_uniqueID=$row['this_creator_uniqueID'];
        $first_letterof_containing_folder_or_post=substr($row['containing_folder_or_post'],0,1);
        $containing_node=substr($row['containing_folder_or_post'],1);
        if($this_fapID==$action_triggering_fapID)
        {
            $isa='error';
            if($row['folder_or_post']==1)
            {$isa='folder';}
            else if($row['folder_or_post']==2 && $first_letterof_containing_folder_or_post=='f')
            {$isa='post';}
            else if($row['folder_or_post']==2 && $first_letterof_containing_folder_or_post=='p')
            {$isa='reply';}

            if($user_or_ip=='ip')
            {
                $affected_user=0;
                $change_user_to_ip_in_mods_log_sign='<span style="display:none;">toip</span>';
            }
            else
            {
                $affected_user=$the_userorip;
                $change_user_to_ip_in_mods_log_sign='';
            }

            $action_explanor='restored all posts from '.$xplain_it.' in this '.$isa.$change_user_to_ip_in_mods_log_sign;
            $myquery_explanor_pre_action="INSERT INTO ".$_nodesforum_db_table_name_modifier."_nodesforum_mods_log (fapID, ancestry, mod_uniqueID, moded_uniqueID, authoritative_folderID, subaction_of, action_time, action_code, action, retrieval_number) VALUES ('$this_fapID', '$row[ancestry]', '$persondoingshit', '$affected_user', '$delete_authority', '0', '$timeofaction', 'RES', '";
            $myquery_explanor_post_action="', '$mods_log_retrieval_number')";
            //mysql_query($myquery);
        }
        else if($affected_node[$this_fapID])
        {
            //restore node
            mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts SET deletion_time = 0 WHERE fapID = '$this_fapID'");
            //add a count to array of stats to increase
            $isa='error';
            if($row['folder_or_post']==1)
            {
                if(!$folders_stat_toincrease[$this_creator_uniqueID])
                {$folders_stat_toincrease[$this_creator_uniqueID]=1;}
                else
                {$folders_stat_toincrease[$this_creator_uniqueID]++;}
                $isa='folder';

                if(!$parent_stats_increase_folders[$containing_node])
                {$parent_stats_increase_folders[$containing_node]=1;}
                else
                {$parent_stats_increase_folders[$containing_node]++;}

                if(!$parent_reget_last_post[$containing_node])
                {
                    $parent_reget_last_post[$containing_node]='reget';
                    $parent_reget_last_post_ancestry_plus_node[$containing_node]=$row['ancestry'];
                }
            }
            else if($row['folder_or_post']==2 && $first_letterof_containing_folder_or_post=='f')
            {
                if(!$posts_stat_toincrease[$this_creator_uniqueID])
                {$posts_stat_toincrease[$this_creator_uniqueID]=1;}
                else
                {$posts_stat_toincrease[$this_creator_uniqueID]++;}
                $isa='post';

                if(!$parent_stats_increase_posts[$containing_node])
                {$parent_stats_increase_posts[$containing_node]=1;}
                else
                {$parent_stats_increase_posts[$containing_node]++;}

                if(!$parent_reget_last_post[$containing_node])
                {
                    $parent_reget_last_post[$containing_node]='reget';
                    $parent_reget_last_post_ancestry_plus_node[$containing_node]=$row['ancestry'];
                }
            }
            else if($row['folder_or_post']==2 && $first_letterof_containing_folder_or_post=='p')
            {
                if(!$replies_stat_toincrease[$this_creator_uniqueID])
                {$replies_stat_toincrease[$this_creator_uniqueID]=1;}
                else
                {$replies_stat_toincrease[$this_creator_uniqueID]++;}
                $isa='reply';

                if(!$parent_stats_increase_replies[$containing_node])
                {$parent_stats_increase_replies[$containing_node]=1;}
                else
                {$parent_stats_increase_replies[$containing_node]++;}

                if(!$parent_reget_last_post[$containing_node])
                {
                    $parent_reget_last_post[$containing_node]='reget';
                    $parent_reget_last_post_ancestry_plus_node[$containing_node]=$row['ancestry'];
                }
            }
            //write action to mods log
            if($this_fapID==$_GET['_nodesforum_handling_fapID'])
            {
                $subaction_of=0;
                if(substr($retrieval_number,0,6)=='spcus_' || substr($retrieval_number,0,6)=='spcip_')
                {$action='restored all posts from '.$xplain_it.' in this '.$isa;}
                else
                {$action='restored '.$isa;}
            }
            else
            {
                $subaction_of=-1;
                if(substr($retrieval_number,0,6)=='spcus_' || substr($retrieval_number,0,6)=='spcip_')
                {$action='automatically restored '.$isa.' by restoring posts from '.$xplain_it.' that had been deleted at the same time from parent';}
                else
                {$action='automatically restored '.$isa.' by restoring parent that had been deleted at the same time';}
            }
            $myquery="INSERT INTO ".$_nodesforum_db_table_name_modifier."_nodesforum_mods_log (fapID, ancestry, mod_uniqueID, moded_uniqueID, authoritative_folderID, subaction_of, action_time, action_code, action, retrieval_number) VALUES ('$this_fapID', '$row[ancestry]', '$persondoingshit', '$row[creator_uniqueID]', '$delete_authority', '$subaction_of', '$timeofaction', 'RES', '$action', '$mods_log_retrieval_number')";
            mysql_query($myquery);
            $count_restored++;
        }
    }







    if(substr($retrieval_number,0,6)=='spcus_' || substr($retrieval_number,0,6)=='spcip_')
    {
        $action_explanor=$action_explanor.' ('.$count_restored.')';
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





    if(substr($retrieval_number,0,6)=='spcus_' || substr($retrieval_number,0,6)=='spcip_')
    {



        //modify post and folder stats
        if($parent_stats_increase_folders)
        {
            foreach($parent_stats_increase_folders as $key => $value)
            {mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts SET subfolders = (subfolders + $value) WHERE fapID = '$key'");}
        }
        if($parent_stats_increase_posts)
        {
            foreach($parent_stats_increase_posts as $key => $value)
            {mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts SET posts = (posts + $value) WHERE fapID = '$key'");}
        }
        if($parent_stats_increase_replies)
        {
            foreach($parent_stats_increase_replies as $key => $value)
            {mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts SET replies = (replies + $value) WHERE fapID = '$key'");}
        }





        //reget last posts
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
                    $result = mysql_query("SELECT fapID, creator_uniqueID, creation_time FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts WHERE ancestry LIKE '%".$_nodesforum_ancestry_separator.mysql_real_escape_string($value2).$_nodesforum_ancestry_separator."%' && folder_or_post = 2 && deletion_time = 0 && audited = 1 ORDER BY creation_time DESC LIMIT 0, 1");
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
    else
    {

        //make +1 posts or folders at the rupture point
        if($this_folder_or_post==1)
        {mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts SET subfolders = (subfolders + 1) WHERE fapID = '$this_containing_folder_or_post'");}
        else if($this_folder_or_post==2)
        {
            if($first_letter_of_containing_folder_or_post=='f')
            {mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts SET posts = (posts + 1) WHERE fapID = '$this_containing_folder_or_post'");}
            else if($first_letter_of_containing_folder_or_post=='p')
            {mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts SET replies = (replies + 1) WHERE fapID = '$this_containing_folder_or_post'");}
        }






        //new reget last posts
        $exploded_ancestry=explode($_nodesforum_ancestry_separator,$this_ancestry);
        foreach($exploded_ancestry as $key => $value)
        {
            if($value!='')
            {
                $last_fapID=0;
                $last_creatorID=0;
                $last_post_time=0;
                $result = mysql_query("SELECT fapID, creator_uniqueID, creation_time FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts WHERE ancestry LIKE '%".$_nodesforum_ancestry_separator.mysql_real_escape_string($value).$_nodesforum_ancestry_separator."%' && folder_or_post = 2 && deletion_time = 0 && audited = 1 ORDER BY creation_time DESC LIMIT 0, 1");
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








    //modify user stats
    if($folders_stat_toincrease)
    {
        foreach($folders_stat_toincrease as $key => $value)
        {mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_user_data SET total_folders = (total_folders + $value) WHERE uniqueID = '$key'");}
    }
    if($posts_stat_toincrease)
    {
        foreach($posts_stat_toincrease as $key => $value)
        {mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_user_data SET total_posts = (total_posts + $value) WHERE uniqueID = '$key'");}
    }
    if($replies_stat_toincrease)
    {
        foreach($replies_stat_toincrease as $key => $value)
        {mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_user_data SET total_replies = (total_replies + $value) WHERE uniqueID = '$key'");}
    }



    unset($_GET['_nodesforum_restore']);
    if(isset($_GET['_nodesforum_remember_node_togobackto']))
    {
        $_GET['_nodesforum_node']=$_GET['_nodesforum_remember_node_togobackto'];
        $_GET['_nodesforum_page']=$_GET['_nodesforum_remember_page_togobackto'];
    }
    //now redirect to lose vars in URL
    $location='Location: ?_nodesforum_node='.$_GET['_nodesforum_node'].'&_nodesforum_page='.$_GET['_nodesforum_page'];
    header($location);

}

