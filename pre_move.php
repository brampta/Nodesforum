<?php


$error=0;
$_nodesforum_move_destination=_nodesforum_my_custom_addslashes($_POST['_nodesforum_move_destination']);
//get info about destination
$destination_exists=0;
$destination_is_folder=0;
$destination_is_allowing_posts=0;
$youhave_mods_rights_on_destination=0;
$destination_ancestry='none';
if($_POST['_nodesforum_move_destination']=='0')
{
    $destination_exists=1;
    $destination_is_folder=1;
    if($_SESSION[$_nodesforum_external_user_system_uniqueID_session_name]==$_nodesforum_main_mod_uniqueID || $_nodesforum_remember_modership_folders[0])
    {$youhave_mods_rights_on_destination=1;}
//	if($_nodesforum_move_folder_or_post==2)
//	{$error=1; $_nodesforum_move_cannot_move_post_on_root=1;}
    $destination_ancestry=$_nodesforum_ancestry_separator;
}
else if(substr($_POST['_nodesforum_move_destination'],0,1)=='p')
{
    if($_nodesforum_risky_bbcode_title[$_nodesforum_move_destination])
    {$destination_exists=1;}
    $destination_is_folder=1;
    $destination_is_allowing_posts=1;

    //find if is banned
    $this_dest=$_POST['_nodesforum_move_destination'];
    if($_nodesforum_remember_bannership_folders[0] || ($_nodesforum_remember_bannership_folders[$this_dest] && !$_nodesforum_remember_modership_folders[$this_dest]))
    {$error=1; $_nodesforum_move_banned_from_destination=1;}
}
else if(substr($_POST['_nodesforum_move_destination'],0,1)=='u')
{
    $this_user_uniqueID=substr($_POST['_nodesforum_move_destination'],1);
    $addslashed_user_uniqueID=mysql_real_escape_string($this_user_uniqueID);
    $result = mysql_query("SELECT $_nodesforum_external_user_system_user_uniqueID_rowname FROM $_nodesforum_external_user_system_table_name WHERE $_nodesforum_external_user_system_user_uniqueID_rowname = '$addslashed_user_uniqueID'");
    while($row = mysql_fetch_array($result))
    {$destination_exists=1;}
    $destination_is_folder=1;




    $hasuserdata=0;
    $result = mysql_query("SELECT allow_posting_on_personal_page FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_user_data WHERE uniqueID = '$addslashed_user_uniqueID'");
    while($row = mysql_fetch_array($result))
    {$_nodesforum_userpage_allow_posting_on_personal_page=$row['allow_posting_on_personal_page'];}
    if($hasuserdata==0)
    {$_nodesforum_userpage_allow_posting_on_personal_page=2;}
    if($_nodesforum_userpage_allow_posting_on_personal_page==0 || $_nodesforum_userpage_allow_posting_on_personal_page==2)
    {$destination_is_allowing_posts=1;}

    if($_SESSION[$_nodesforum_external_user_system_uniqueID_session_name]==$this_user_uniqueID || $_nodesforum_remember_modership_folders['u'.$this_user_uniqueID] || $_nodesforum_remember_modership_folders[0])
    {$youhave_mods_rights_on_destination=1;}

    $destination_ancestry=$_nodesforum_ancestry_separator.'0'.$_nodesforum_ancestry_separator;


    //find if is banned
    $this_dest=$_POST['_nodesforum_move_destination'];
    if($_nodesforum_remember_bannership_folders[0] || ($_nodesforum_remember_bannership_folders[$this_dest] && (!$_nodesforum_remember_modership_folders[0] && !$_nodesforum_remember_modership_folders[$this_dest])))
    {$error=1; $_nodesforum_move_banned_from_destination=1;}

}
else
{
    $result = mysql_query("SELECT creator_uniqueID, ancestry, folder_or_post, allow_posting FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts WHERE fapID = '$_nodesforum_move_destination'");
    while($row = mysql_fetch_array($result))
    {
        if($row['folder_or_post']==1)
        {$destination_is_folder=1;}
        if($row['allow_posting']==2)
        {$destination_is_allowing_posts=1;}
        $destination_exists=1;
        if($_SESSION[$_nodesforum_external_user_system_uniqueID_session_name]==$row['creator_uniqueID'])
        {$youhave_mods_rights_on_destination=1;}
        else
        {
            $exploded_ancestry=explode($_nodesforum_ancestry_separator,$row['ancestry']);
            foreach($exploded_ancestry as $key => $value)
            {
                if($value!='')
                {
                    if($_nodesforum_remember_modership_folders[$value])
                    {
                        $youhave_mods_rights_on_destination=1;
                        break;
                    }
                }
            }
        }
        $destination_ancestry=$row['ancestry'];
    }


    //find if is banned
    $ancestry_plus_node=$destination_ancestry.$_nodesforum_move_destination.$_nodesforum_ancestry_separator;
    $exploded_ancestry_plus_node=explode($_nodesforum_ancestry_separator,$ancestry_plus_node);
    foreach($exploded_ancestry_plus_node as $key => $value)
    {
        if($value!='')
        {
            if($_nodesforum_remember_modership_folders[$value])
            {break;}
            else if($_nodesforum_remember_bannership_folders[$value])
            {
                $error=1; $_nodesforum_move_banned_from_destination=1;
                break;
            }
        }
    }



}
if($destination_exists==0)
{$error=1; $_nodesforum_move_folder_doesnt_exist=1;}
if($destination_is_folder==0)
{$error=1; $_nodesforum_move_folder_not_folder=1;}
if($destination_is_allowing_posts==0 && $youhave_mods_rights_on_destination==0)
{$error=1; $_nodesforum_move_folder_no_permission=1;}


if($error==0 && $destination_ancestry!='none' && $_nodesforum_move_destination!=$addslashed_node && $_nodesforum_move_destination!=$addslashed_move_node)
{
    //perform move operation and log to mods log!

    //step1 change the containing_folder_or_post of the moved element
    $final_container='f'.$_nodesforum_move_destination;
    $myquery="UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts SET containing_folder_or_post = '$final_container' WHERE fapID = '$addslashed_move_node'";
    mysql_query($myquery);
    //step1b make moved element unsticky
    mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts SET sticky = 0 WHERE fapID = '$addslashed_move_node'");
    //step1c make moved element not skeleton
    mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts SET skeleton = 0 WHERE fapID = '$addslashed_move_node'");
    //step2 change the ancestry of the moved element
    $new_history_of_element=$destination_ancestry.$_nodesforum_move_destination.$_nodesforum_ancestry_separator;
    $myquery="UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts SET ancestry = '$new_history_of_element' WHERE fapID = '$addslashed_move_node'";
    mysql_query($myquery);
    //step3 change the ancestry of the children
    $oldstyle_ancestry=$_nodesforum_move_ancestry.$addslashed_move_node.$_nodesforum_ancestry_separator;
    $newstyle_ancestry=$new_history_of_element.$addslashed_move_node.$_nodesforum_ancestry_separator;
    $myquery="UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts SET ancestry = REPLACE(ancestry, '$oldstyle_ancestry', '$newstyle_ancestry')";
    mysql_query($myquery);


    //added step, adjust number posts and subfolders on new and old container
    if($_nodesforum_move_deletion_time==0)
    {
        if($_nodesforum_move_folder_or_post==1)
        {
            //echo 'moved is folder.<br />';
            //echo '$addslashed_node: '.$addslashed_node.'<br />';
            if(substr($addslashed_node,0,1)!='u' && substr($addslashed_node,0,1)!='p' && $addslashed_node!='0')
            {
                $myquery="UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts SET subfolders = (subfolders - 1) WHERE fapID = '$addslashed_node'";
                //echo $myquery.'<br />';
                mysql_query($myquery);
            }
            //echo '$_nodesforum_move_destination: '.$_nodesforum_move_destination.'<br />';
            if(substr($_nodesforum_move_destination,0,1)!='u' && substr($_nodesforum_move_destination,0,1)!='p' && $_nodesforum_move_destination!='0')
            {
                $myquery="UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts SET subfolders = (subfolders + 1) WHERE fapID = '$_nodesforum_move_destination'";
                //echo $myquery.'<br />';
                mysql_query($myquery);
            }
        }
        else if($_nodesforum_move_folder_or_post==2)
        {
            //echo 'moved is post.<br />';
            //echo '$addslashed_node: '.$addslashed_node.'<br />';
            if(substr($addslashed_node,0,1)!='u' && substr($addslashed_node,0,1)!='p' && $addslashed_node!='0')
            {
                $myquery="UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts SET posts = (posts - 1) WHERE fapID = '$addslashed_node'";
                mysql_query($myquery);
            }
            //echo '$_nodesforum_move_destination: '.$_nodesforum_move_destination.'<br />';
            if(substr($_nodesforum_move_destination,0,1)!='u' && substr($_nodesforum_move_destination,0,1)!='p' && $_nodesforum_move_destination!='0')
            {
                $myquery="UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts SET posts = (posts + 1) WHERE fapID = '$_nodesforum_move_destination'";
                mysql_query($myquery);
            }
        }
    }


    //step4 run all concerned element and record operation to mods log about it
    if($_nodesforum_ismod==1)
    {$delete_authority=$_nodesforum_modship_authoritative_folder;}
    else if($_nodesforum_move_creator_uniqueID==$_SESSION[$_nodesforum_external_user_system_uniqueID_session_name])
    {$delete_authority=$addslashed_move_node;}
    $persondoingshit=$_SESSION[$_nodesforum_external_user_system_uniqueID_session_name];
    $mods_log_retrieval_number=rand(111111111,999999999);
    $myquery="SELECT fapID, creator_uniqueID, ancestry, title, folder_or_post FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts WHERE (fapID = '$addslashed_move_node' || ancestry LIKE '%".$_nodesforum_ancestry_separator.$addslashed_move_node.$_nodesforum_ancestry_separator."%')";
    $result = mysql_query($myquery);
    while($row = mysql_fetch_array($result))
    {
        $this_creator_uniqueID=$row['creator_uniqueID'];
        if($row['folder_or_post']==1)
        {$isa='folder';}
        else if($row['folder_or_post']==2)
        {$isa='post';}
        if($row['fapID']==$addslashed_move_node)
        {
            $subaction_of=0;
            $action='moved '.$isa.' from <a href="?_nodesforum_node='.$addslashed_node.'">folder #'.$addslashed_node.'</a> to <a href="?_nodesforum_node='.$_nodesforum_move_destination.'">folder #'.$_nodesforum_move_destination.'</a>';
            $addslashed_old_ancestry=$_nodesforum_move_ancestry;
        }
        else
        {
            $subaction_of=-1;
            $action='automatically moved '.$isa.' by moving parent';
            $addslashed_old_ancestry=str_replace($newstyle_ancestry,$oldstyle_ancestry,$row['ancestry']);
        }
        $addslashed_new_ancestry=$row['ancestry'];
        $dual_ancestry_for_move_mods_log=$addslashed_old_ancestry.':'.$addslashed_new_ancestry;
        $myquery="INSERT INTO ".$_nodesforum_db_table_name_modifier."_nodesforum_mods_log (fapID, ancestry, mod_uniqueID, moded_uniqueID, authoritative_folderID, subaction_of, action_time, action_code, action, retrieval_number) VALUES ('$row[fapID]', '$dual_ancestry_for_move_mods_log', '$persondoingshit', '$this_creator_uniqueID', '$delete_authority', '$subaction_of', '$nowtime', 'MOV', '$action', '$mods_log_retrieval_number')";
        mysql_query($myquery);
    }
    //retrieve logID of main action
    $main_action_logID=0;
    $result = mysql_query("SELECT logID FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_mods_log WHERE mod_uniqueID = '$persondoingshit' && action_time = '$nowtime' && retrieval_number = '$mods_log_retrieval_number' && subaction_of = 0");
    while($row = mysql_fetch_array($result))
    {$main_action_logID=$row['logID'];}
    //set this logID as subaction_of on all residual actions
    if($main_action_logID!=0)
    {mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_mods_log SET subaction_of = '$main_action_logID' WHERE mod_uniqueID = '$persondoingshit' && action_time = '$nowtime' && retrieval_number = '$mods_log_retrieval_number' && subaction_of = -1");}



    $_nodesforum_youarehere=$_nodesforum_original_youarehere;
    unset($_GET['_nodesforum_move']);
    //now redirect to lose vars in URL
    if(!isset($_GET['_nodesforum_restore']))
    {
        $location='Location: ?_nodesforum_node='.$_GET['_nodesforum_node'].'&_nodesforum_page='.$_GET['_nodesforum_page'];
        header($location);
    }
}



?>
