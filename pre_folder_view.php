<?php
a_function_that_is_only_in_the_pre_output();




//make sticky
if(isset($_GET['_nodesforum_make_sticky']) && $_nodesforum_ismod==1)
{include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path.'pre_make_sticky.php'));}
//make unsticky
if(isset($_GET['_nodesforum_make_unsticky']) && $_nodesforum_ismod==1)
{include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path.'pre_make_unsticky.php'));}
//move sticky
if(isset($_GET['_nodesforum_sticky_move']) && $_nodesforum_ismod==1)
{include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path.'pre_sticky_move.php'));}



//read list of folders and posts in this folder
$hideghosts=' && deletion_time = 0';
if($_nodesforum_ismod==1 && $_GET['ghost']==1)
{
    $hideghosts='';
    if($get_ghost_permalink_page==1)
    {$_GET['_nodesforum_page']=$ghost_permalink_page;}
}

$hideunaudited=' && (audited = 1 || (creator_uniqueID = 0 && creator_ip = \''.$_nodesforum_enc_ip.'\') || (creator_uniqueID <> 0 && creator_uniqueID = \''.mysql_real_escape_string($_SESSION[$_nodesforum_external_user_system_uniqueID_session_name]).'\'))';
if($_nodesforum_righttoaudit==1 /*&& $_GET['unaudited']==1*/)
{
    $hideunaudited='';
    if($get_unaudited_permalink_page==1)
    {$_GET['_nodesforum_page']=$unaudited_permalink_page;}
}

if($_nodesforum_folder_or_post==1)
{
    //folder view
    $wherer="containing_folder_or_post = 'f".$addslashed_node."'".$hideghosts.$hideunaudited;
    $orderer="not_sticky, sticky, last_post_time DESC, creation_time";
}else if($_nodesforum_folder_or_post==3){

    //history view
    $ip_wherer='';
    if(isset($_GET['_nodesforum_history_ip']) && $_nodesforum_ismod==1)
    {
        $ip_wherer=" && AES_ENCRYPT(creator_ip, creator_ip) = '".mysql_real_escape_string(base64_decode($_GET['_nodesforum_history_ip']))."' ";
        $_nodesforum_youarehere=$_nodesforum_youarehere.' from ip address (encrypted): <input type="text" value="'.addslashes($_GET['_nodesforum_history_ip']).'" readonly="readonly" onmouseup="highlight(this)" />';
    }

    $user_wherer='';
    if(isset($_GET['_nodesforum_history_user']) && !isset($_GET['_nodesforum_history_ip']))
    {
        if($_GET['_nodesforum_history_user']=='0')
        {$user_identif='guests';}
        else if($_GET['_nodesforum_history_user']==$_nodesforum_uniqueID_of_deleted_user)
        {$user_identif='deleted users';}
        else
        {
            $user_found=0;
            $addslashed_uniqueID=mysql_real_escape_string($_GET['_nodesforum_history_user']);
            $result2 = mysql_query("SELECT $_nodesforum_external_user_system_publicname_rowname FROM $_nodesforum_external_user_system_table_name WHERE $_nodesforum_external_user_system_user_uniqueID_rowname = '$addslashed_uniqueID'");
            while($row2 = mysql_fetch_array($result2))
            {
                $user_found=1;
                $user_name=$row2[$_nodesforum_external_user_system_publicname_rowname];
            }
            if($user_found==0)
            {$user_identif='error, user not found';}
            else
            {$user_identif='user: <a href="?_nodesforum_node=u'.$_GET['_nodesforum_history_user'].'">'._nodesforum_display_title($user_name,$_nodesforum_max_word_length_in_titles).'</a>';}
        }

        $user_wherer=" && creator_uniqueID = '".mysql_real_escape_string($_GET['_nodesforum_history_user'])."' ";
        $_nodesforum_youarehere=$_nodesforum_youarehere.' from '.$user_identif;
    }


    $wherer="ancestry LIKE '%|".$remember_actual_node."|%' ".$ip_wherer." ".$user_wherer." ".$hideghosts.$hideunaudited;
    $orderer="creation_time DESC";
}else if($_nodesforum_folder_or_post==7){

    //audit posts and folders view

    $ancestry_clause = "ancestry LIKE '%|".mysql_real_escape_string($remember_actual_node)."|%' &&";
    if($remember_actual_node=='0'){
        //if root folder, ancestry is empty
        $ancestry_clause = "";
    }
    $wherer="$ancestry_clause audited = 0 ".$hideghosts;
    $orderer="creation_time DESC";
}

$count_query="SELECT COUNT(fapID) FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts WHERE $wherer";
$queryRows=mysql_query($count_query);
$numRows=@mysql_fetch_array($queryRows);
if($numRows==null)
{
    var_dump('Error: '.$count_query.'<br />'.mysql_error());
    $_nodesforum_folder_or_post=6;
    $_nodesforum_youarehere='<img src="'.$_nodesforum_tool_icon.'" style="vertical-align:text-bottom;border:none;" /> installer';

    $_nodesforum_error_creating_tables='';
    $_nodesforum_error_cloning_tables='';
    $_nodesforum_tables_created=0;
    if(isset($_POST['_nodesforum_create_new_tables']) || isset($_POST['_nodesforum_clone_old_tables']))
    {include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path.'pre_create_tables.php'));}

}
else
{


    $_nodesforum_totalfap=$numRows[0];
    $_nodesforum_totalpages=ceil($_nodesforum_totalfap/$_nodesforum_howmany_posts_perpage);

    if($_GET['_nodesforum_page']=='last')
    {$_GET['_nodesforum_page']=$_nodesforum_totalpages;}
    $startat=($_GET['_nodesforum_page']-1)*$_nodesforum_howmany_posts_perpage;
    $_nodesforum_count_fap_results=0;




    $myquery="SELECT fapID, folder_or_post, creator_uniqueID, creator_ip, AES_ENCRYPT(creator_ip,creator_ip) AS enc_ip, creation_time, title, post, subfolders, posts, replies, views, last_post_postID, last_post_user_uniqueID, last_post_time, containing_folder_or_post, deletion_time, audited, sticky, IF(sticky = 0,'True','False') AS not_sticky, skeleton FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts WHERE $wherer ORDER BY $orderer LIMIT $startat, $_nodesforum_howmany_posts_perpage";
    $result = mysql_query($myquery);
    while($row = mysql_fetch_array($result))
    {
		//echo "<pre>".print_r($row,true)."</pre>";
        $_nodesforum_count_fap_results++;
        $this_fapID=$row['fapID'];
        $_nodesforum_display_fapID[$_nodesforum_count_fap_results]=$this_fapID;
        $_nodesforum_display_folder_or_post[$_nodesforum_count_fap_results]=$row['folder_or_post'];
        $_nodesforum_display_creator_uniqueID[$_nodesforum_count_fap_results]=$row['creator_uniqueID'];
        $this_creator_uniqueID=$_nodesforum_display_creator_uniqueID[$_nodesforum_count_fap_results];
        if(!$_nodesforum_creator_publicname[$this_creator_uniqueID])
        {$_nodesforum_creator_publicname[$this_creator_uniqueID]='yes';}
        $_nodesforum_display_creator_ip[$_nodesforum_count_fap_results]=$row['creator_ip'];
        if($row['creator_ip']=='')
        {$_nodesforum_display_enc_ip[$_nodesforum_count_fap_results]='';}
        else
        {$_nodesforum_display_enc_ip[$_nodesforum_count_fap_results]=$row['enc_ip'];}
        $_nodesforum_display_creation_time[$_nodesforum_count_fap_results]=$row['creation_time'];
        $_nodesforum_display_title[$_nodesforum_count_fap_results]=$row['title'];
        $_nodesforum_display_post[$_nodesforum_count_fap_results]=$row['post'];
        $_nodesforum_remember_titles[$this_fapID]=$row['title'];
        $_nodesforum_display_subfolders[$_nodesforum_count_fap_results]=$row['subfolders'];
        $_nodesforum_display_posts[$_nodesforum_count_fap_results]=$row['posts'];
        $_nodesforum_display_replies[$_nodesforum_count_fap_results]=$row['replies'];
        $_nodesforum_remember_replies[$this_fapID]=$row['replies'];
        $_nodesforum_display_views[$_nodesforum_count_fap_results]=$row['views'];
        $_nodesforum_remember_views[$this_fapID]=$row['views'];
        $_nodesforum_display_last_post_postID[$_nodesforum_count_fap_results]=$row['last_post_postID'];
        $_nodesforum_remember_last_post_postID[$this_fapID]=$row['last_post_postID'];
        $_nodesforum_display_last_post_user_uniqueID[$_nodesforum_count_fap_results]=$row['last_post_user_uniqueID'];
        $_nodesforum_remember_last_post_user_uniqueID[$this_fapID]=$row['last_post_user_uniqueID'];
        $this_last_posts_uniqueID=$_nodesforum_display_last_post_user_uniqueID[$_nodesforum_count_fap_results];
        if(!$_nodesforum_creator_publicname[$this_last_posts_uniqueID])
        {$_nodesforum_creator_publicname[$this_last_posts_uniqueID]='yes';}
        $_nodesforum_display_last_post_time[$_nodesforum_count_fap_results]=$row['last_post_time'];
        $_nodesforum_remember_last_post_time[$this_fapID]=$row['last_post_time'];
        $_nodesforum_display_containing_folder_or_post[$_nodesforum_count_fap_results]=$row['containing_folder_or_post'];
        $containing_fapID=substr($_nodesforum_display_containing_folder_or_post[$_nodesforum_count_fap_results],1);
        if(
            //in history view, folders show replies and they need to show their parent post title
            ($_nodesforum_display_folder_or_post[$_nodesforum_count_fap_results]==2 && substr($_nodesforum_display_containing_folder_or_post[$_nodesforum_count_fap_results],0,1)=='p' && !$remember_parent_titles[$containing_fapID])
            //in audit post view, everything needs to show its parent post title
            || $_nodesforum_folder_or_post==7
        ){$remember_parent_titles[$containing_fapID]='get';}
        $_nodesforum_display_deletion_time[$_nodesforum_count_fap_results]=$row['deletion_time'];
        $_nodesforum_display_audited[$_nodesforum_count_fap_results]=$row['audited'];
        $_nodesforum_display_sticky[$_nodesforum_count_fap_results]=$row['sticky'];
        $_nodesforum_display_skeleton[$_nodesforum_count_fap_results]=$row['skeleton'];
    }








//get title of parent posts for replies in history
    if($remember_parent_titles)
    {
        $post_titles_getter_wherer='';
        $countadd=0;
        $countuseradd=0;
        foreach($remember_parent_titles as $key => $value)
        {
            if($key===0){
                //root parent post
                $_nodesforum_remember_titles[0]='root';
            }else if(substr($key,0,1)=='u'){
                //users home folder parent post
                if(!$_nodesforum_remember_titles[$key]){
                    $countuseradd++;
                    if($countuseradd>1)
                    {$usernames_getter_wherer=$usernames_getter_wherer.", ";}
                    $usernames_getter_wherer=$usernames_getter_wherer."'".substr($key,1)."'";
                }
            }else{
                //folder or post parent post
                if(!$_nodesforum_remember_titles[$key]){
                    $countadd++;
                    if($countadd>1)
                    {$post_titles_getter_wherer=$post_titles_getter_wherer.", ";}
                    $post_titles_getter_wherer=$post_titles_getter_wherer."'".$key."'";
                }
            }
            
        }
    }
    if($countadd>=1)
    {
        $myquery="SELECT fapID, title, replies, views, last_post_postID, last_post_user_uniqueID, last_post_time FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts WHERE fapID in ($post_titles_getter_wherer)";
        $result = mysql_query($myquery);
        while($row = mysql_fetch_array($result))
        {
            $this_fapID=$row['fapID'];
            $_nodesforum_remember_titles[$this_fapID]=$row['title'];
            $_nodesforum_remember_replies[$this_fapID]=$row['replies'];
            $_nodesforum_remember_views[$this_fapID]=$row['views'];
            $_nodesforum_remember_last_post_postID[$this_fapID]=$row['last_post_postID'];
            $_nodesforum_remember_last_post_user_uniqueID[$this_fapID]=$row['last_post_user_uniqueID'];
            $_nodesforum_remember_last_post_time[$this_fapID]=$row['last_post_time'];
            $this_last_posts_uniqueID=$_nodesforum_remember_last_post_user_uniqueID[$this_fapID];
            if(!$_nodesforum_creator_publicname[$this_last_posts_uniqueID])
            {$_nodesforum_creator_publicname[$this_last_posts_uniqueID]='yes';}
        }
    }
    if($countuseradd>=1)
    {
        $myquery="SELECT uniqueID, public_name FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_users WHERE uniqueID in ($usernames_getter_wherer)";
        $result = mysql_query($myquery);
        while($row = mysql_fetch_array($result))
        {
            $this_uniqueID=$row['uniqueID'];
            $lastletterofguyname=substr($row['public_name'],strlen($row['public_name'])-1);
            $proprietaryS='s';
            if($lastletterofguyname=='s' || $lastletterofguyname=='z')
            {$proprietaryS='';}
            $_nodesforum_remember_titles['u'.$this_uniqueID]=$row['public_name'].'\''.$proprietaryS.' forum page';
        }
    }
//get list of mods in that folder
    $_nodesforum_count_mod_results=0;
    $_nodesforum_count_banned_results=0;
    $_nodesforum_count_banned_ip_results=0;
    if($_nodesforum_creator_uniqueID!=$_nodesforum_uniqueID_of_deleted_user)
    {
        $_nodesforum_display_mod_uniqueID[1]=$_nodesforum_creator_uniqueID;
        $_nodesforum_display_mod_level[1]=0;
        $remember_modz[$_nodesforum_creator_uniqueID]='remember';
        $this_mod_uniqueID=$_nodesforum_display_mod_uniqueID[1];
        if(!$_nodesforum_creator_publicname[$this_mod_uniqueID])
        {$_nodesforum_creator_publicname[$this_mod_uniqueID]='yes';}
        $_nodesforum_count_mod_results++;
    }
    $result = mysql_query("SELECT mod_uniqueID, mod_level, ip, reason FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_mods WHERE folderID = '$addslashed_node' ORDER BY mod_level, promotion_time LIMIT 1000000");
    while($row = mysql_fetch_array($result))
    {
        $this_uniqueID=$row['mod_uniqueID'];
        if($row['mod_level']==-13)
        {
            if($row['ip']=='')
            {
                $_nodesforum_count_banned_results++;
                $_nodesforum_display_banned_uniqueID[$_nodesforum_count_banned_results]=$this_uniqueID;
                $_nodesforum_display_banned_reason[$_nodesforum_count_banned_results]=$row['reason'];
            }
            else if($row['mod_uniqueID']==0)
            {
                $_nodesforum_count_banned_ip_results++;
                $_nodesforum_display_banned_ip_ip[$_nodesforum_count_banned_ip_results]=$row['ip'];
                $_nodesforum_display_banned_ip_reason[$_nodesforum_count_banned_ip_results]=$row['reason'];
            }
        }
        else
        {
            $_nodesforum_count_mod_results++;
            $_nodesforum_display_mod_uniqueID[$_nodesforum_count_mod_results]=$this_uniqueID;
            $_nodesforum_display_mod_level[$_nodesforum_count_mod_results]=$row['mod_level'];
            $remember_modz[$this_uniqueID]='remember';
        }
        if(!$_nodesforum_creator_publicname[$this_uniqueID])
        {$_nodesforum_creator_publicname[$this_uniqueID]='yes';}
    }














    if(substr($addslashed_node,0,1)=='p')
    {
        //get list of ppl with the power
        $_nodesforum_count_p_results=0;
        $result = mysql_query("SELECT uniqueID FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_user_data WHERE $addslashed_node = 1 ORDER BY ".$addslashed_node."_time LIMIT 1000000");
        while($row = mysql_fetch_array($result))
        {
            $_nodesforum_count_p_results++;
            $this_uniqueID=$row['uniqueID'];
            if(!$remember_modz[$this_uniqueID])
            {
                $_nodesforum_display_poweree[$_nodesforum_count_p_results]=$this_uniqueID;
                if(!$_nodesforum_creator_publicname[$this_uniqueID])
                {$_nodesforum_creator_publicname[$this_uniqueID]='yes';}
            }
        }
    }








//get all needed public names
    if($_nodesforum_creator_publicname)
    {
        $wherer='';
        $countzz=0;
        foreach($_nodesforum_creator_publicname as $key => $value)
        {
            if($key!=$_nodesforum_uniqueID_of_deleted_user && $key!='0')
            {
                $countzz++;
                if($countzz>1)
                {$wherer=$wherer.", ";}
                $wherer=$wherer."'".$key."'";
            }
        }
        if($countzz>=1)
        {
            $myquery="SELECT $_nodesforum_external_user_system_user_uniqueID_rowname, $_nodesforum_external_user_system_publicname_rowname FROM $_nodesforum_external_user_system_table_name WHERE $_nodesforum_external_user_system_user_uniqueID_rowname in ($wherer)";
            $result = mysql_query($myquery);
            while($row = mysql_fetch_array($result))
            {
                $this_creator_uniqueID=$row[$_nodesforum_external_user_system_user_uniqueID_rowname];
                $_nodesforum_display_creator_publicname[$this_creator_uniqueID]=$row[$_nodesforum_external_user_system_publicname_rowname];
            }
        }
        $_nodesforum_display_creator_publicname[$_nodesforum_uniqueID_of_deleted_user]='deleted user';
        $_nodesforum_display_creator_publicname[0]='a guest';
    }







}


