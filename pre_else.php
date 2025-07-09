<?php
a_function_that_is_only_in_the_pre_output();










$_nodesforum_enc_ip=hash($_nodesforum_php_encyption_for_IP_addresses,$_SERVER['REMOTE_ADDR']);






function _nodesforum_make_ancestryz($_nodesforum_ancestry)
{
    global $_nodesforum_show_how_deep_of_you_are_here;
    global $_nodesforum_external_user_system_publicname_rowname;
    global $_nodesforum_external_user_system_table_name;
    global $_nodesforum_external_user_system_user_uniqueID_rowname;
    global $_nodesforum_ancestry_separator;
    global $_nodesforum_max_word_length_in_titles;
    global $_nodesforum_risky_bbcode_title;
    global $_nodesforum_uniqueID_of_deleted_user;
    global $_nodesforum_db_table_name_modifier;

    global $_nodesforum_home_icon;
    global $_nodesforum_userhome_icon;
    global $_nodesforum_userhome_grey_icon;
    global $_nodesforum_reply_icon;
    global $_nodesforum_folder_icon;
    global $_nodesforum_post_icon;
    global $_nodesforum_power_icon;
    global $_nodesforum_warn_icon;

    $_nodesforum_youarehere='';
    //dynamically build ancestry by name
    $exploded_ancestry=explode($_nodesforum_ancestry_separator,$_nodesforum_ancestry);
    $total_elements_in_array=count($exploded_ancestry);
    $total_elements_in_ancestry=$total_elements_in_array-2;
    //build $ancestor_fapID array
    if($total_elements_in_ancestry<=$_nodesforum_show_how_deep_of_you_are_here)
    {
        $element_number=1;
        while($element_number<=$total_elements_in_ancestry)
        {
            $ancestor_fapID[$element_number]=$exploded_ancestry[$element_number];
            $element_number++;
        }
    }
    else
    {
        $startatz=$_nodesforum_show_how_deep_of_you_are_here;
        $substractor=2;
        while($startatz>0)
        {
            $chosenarray_key=$total_elements_in_array-$substractor;
            $ancestor_fapID[$startatz]=$exploded_ancestry[$chosenarray_key];
            $substractor++;
            $startatz--;
        }
        ksort($ancestor_fapID);
    }
    //build $ancestor_name and $ancestor_icon array
    $numberoffolderorpoststogetname=0;
    $folderandpostnamegetter_wherer='';
    foreach($ancestor_fapID as $key => $value)
    {
        $elname='not found';
        $elicon=$_nodesforum_warn_icon;
        if(substr($value,0,1)=='u')
        {
            if(substr($value,1)==$_nodesforum_uniqueID_of_deleted_user)
            {
                //deleted user
                $elname="deleted user's forum page";
                $elicon=$_nodesforum_userhome_grey_icon;
            }
            else
            {
                //get name of guy
                $addslashed_uniqueID=mysql_real_escape_string(substr($value,1));
                $result2 = mysql_query("SELECT $_nodesforum_external_user_system_publicname_rowname FROM $_nodesforum_external_user_system_table_name WHERE $_nodesforum_external_user_system_user_uniqueID_rowname = '$addslashed_uniqueID'");
                while($row2 = mysql_fetch_array($result2))
                {
                    $guysname=$row2[$_nodesforum_external_user_system_publicname_rowname];
                    $lastletterofguyname=substr($guysname,strlen($guysname)-1);
                    $proprietaryS='s';
                    if($lastletterofguyname=='s' || $lastletterofguyname=='z')
                    {$proprietaryS='';}
                    $elname=$guysname."'".$proprietaryS." forum page";
                    $elicon=$_nodesforum_userhome_icon;
                }
            }
        }
        else if(substr($value,0,1)=='p')
        {
            $elname=$_nodesforum_risky_bbcode_title[$value];
            $elicon=$_nodesforum_power_icon;
        }
        else if($value=='0')
        {
            $elname='root';
            $elicon=$_nodesforum_home_icon;
        }
        else
        {
            $numberoffolderorpoststogetname++;
            $addslashed_fapID=mysql_real_escape_string($value);
            $orer='';
            if($numberoffolderorpoststogetname>1)
            {$orer=', ';}
            $folderandpostnamegetter_wherer=$folderandpostnamegetter_wherer.$orer."'".$addslashed_fapID."'";
            $elname='..to be gathered..';
            $elicon='..to be gathered..';
        }
        $ancestor_name[$key]=$elname;
        $ancestor_icon[$key]=$elicon;
    }
    //gather title and folder_or_post for each needed fapID
    if($numberoffolderorpoststogetname>=1)
    {
        $myquery="SELECT fapID, title, folder_or_post FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts WHERE fapID in ($folderandpostnamegetter_wherer)";
        $result2 = mysql_query("SELECT fapID, title, folder_or_post FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts WHERE fapID in ($folderandpostnamegetter_wherer)");
        while($row2 = mysql_fetch_array($result2))
        {
            $needed_key=0;
            foreach($ancestor_fapID as $key => $value)
            {
                if($value==$row2['fapID'])
                {$needed_key=$key;}
            }
            $ancestor_name[$needed_key]=$row2['title'];
            $elicon=$_nodesforum_folder_icon;
            if($row2['folder_or_post']==2)
            {$elicon=$_nodesforum_post_icon;}
            $ancestor_icon[$needed_key]=$elicon;
        }
    }
    //build $_nodesforum_youarehere from values in arrays
    $countermz=0;
    foreach($ancestor_fapID as $key => $value)
    {
        $countermz++;
        $arrow='';
        if($countermz>1)
        {$arrow=' => ';}
        $thisicon='<img src="'.$ancestor_icon[$key].'" style="vertical-align:text-bottom;border:none;" />';
        $show_title=_nodesforum_display_title($ancestor_name[$key],$_nodesforum_max_word_length_in_titles);
        $_nodesforum_youarehere=$_nodesforum_youarehere.$arrow.$thisicon.' <a href="?_nodesforum_node='.$value.'">'.$show_title.'</a>';
    }
    return $_nodesforum_youarehere;
}






//permalink
$get_ghost_permalink_page=0;
if(isset($_GET['_nodesforum_permalink']))
{include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path.'pre_permalink.php'));}








if(!isset($_GET['_nodesforum_node']))
{$_GET['_nodesforum_node']=0;}

if(!isset($_GET['_nodesforum_page']))
{$_GET['_nodesforum_page']=1;}


$addslashed_node=_nodesforum_my_custom_addslashes($_GET['_nodesforum_node']);

if(isset($_GET['_nodesforum_edit_folder']))
{include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path.'pre_pre_edit_folder.php'));}
if(isset($_GET['_nodesforum_edit_post']))
{include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path.'pre_pre_edit_post.php'));}
if(isset($_GET['_nodesforum_move']))
{include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path.'pre_pre_move.php'));}







//read info about folder or post


$temporary_remove_modslog_l=0;
if(substr($_GET['_nodesforum_node'],0,1)=='l')
{
    $temporary_remove_modslog_l=1;
    $_GET['_nodesforum_node']=substr($_GET['_nodesforum_node'],1);
    $addslashed_node=substr($addslashed_node,1);
}

$temporary_remove_history_h=0;
if(substr($_GET['_nodesforum_node'],0,1)=='h')
{
    $temporary_remove_history_h=1;
    $_GET['_nodesforum_node']=substr($_GET['_nodesforum_node'],1);
    $addslashed_node=substr($addslashed_node,1);
}

$temporary_remove_audit_a=0;
if(substr($_GET['_nodesforum_node'],0,1)=='a')
{
    $temporary_remove_audit_a=1;
    $_GET['_nodesforum_node']=substr($_GET['_nodesforum_node'],1);
    $addslashed_node=substr($addslashed_node,1);
}






$_nodesforum_postfound=0;
$_nodesforum_is_skeleton=0;
$_nodesforum_creator_uniqueID=-1;
if(substr($_GET['_nodesforum_node'],0,1)=='s' && substr($_GET['_nodesforum_node'],1)==$_SESSION[$_nodesforum_external_user_system_uniqueID_session_name])
{
    $_nodesforum_title='edit signature - forum options - '.$_nodesforum_forum_name;
    $_nodesforum_youarehere='<img src="'.$_nodesforum_home_icon.'" style="vertical-align:text-bottom;border:none;" /> <a href="?">root</a> => <img src="'.$_nodesforum_tool_icon.'" style="vertical-align:text-bottom;border:none;" /> <a href="?_nodesforum_forum_options">forum options</a> => <img src="'.$_nodesforum_tool_icon.'" style="vertical-align:text-bottom;border:none;" /> edit signature';
    $_nodesforum_postorreply='signature';

    $_nodesforum_ancestry=$_nodesforum_ancestry_separator.'0'.$_nodesforum_ancestry_separator;
}
else if(substr($_GET['_nodesforum_node'],0,1)=='h')
{
    $_nodesforum_postfound=1;

    $_nodesforum_folder_or_post=3;

    $this_user_uniqueID=substr($_GET['_nodesforum_node'],1);
    $addslashed_user_uniqueID=mysql_real_escape_string($this_user_uniqueID);


    if($this_user_uniqueID==$_nodesforum_uniqueID_of_deleted_user)
    {
        $_nodesforum_postfound=2;
        $_nodesforum_this_user_publicname='deleted user';
        $this_iconz=$_nodesforum_userhome_grey_icon;
    }
    else
    {
        //get user publicname
        $result = mysql_query("SELECT $_nodesforum_external_user_system_publicname_rowname FROM $_nodesforum_external_user_system_table_name WHERE $_nodesforum_external_user_system_user_uniqueID_rowname = '$addslashed_user_uniqueID'");
        while($row = mysql_fetch_array($result))
        {
            $_nodesforum_postfound=2;
            $_nodesforum_this_user_publicname=$row[$_nodesforum_external_user_system_publicname_rowname];
            $this_iconz=$_nodesforum_userhome_icon;
        }
    }

    $last_letter_of_publicname=substr($_nodesforum_this_user_publicname,strlen($_nodesforum_this_user_publicname)-1,1);
    $user_s_proprietary_s='s';
    if($last_letter_of_publicname=='s' || $last_letter_of_publicname=='z')
    {$user_s_proprietary_s='';}

    $_nodesforum_title=$_nodesforum_this_user_publicname."'".$user_s_proprietary_s.' posting history';
    $_nodesforum_youarehere='<img src="'.$_nodesforum_home_icon.'" style="vertical-align:text-bottom;border:none;" /> <a href="?">root</a> => <img src="'.$this_iconz.'" style="vertical-align:text-bottom;border:none;" /> <a href="?_nodesforum_node=u'.$this_user_uniqueID.'">'._nodesforum_display_title($_nodesforum_this_user_publicname,$_nodesforum_max_word_length_in_titles)."'".$user_s_proprietary_s.' forum page</a> => <img src="'.$_nodesforum_history_icon.'" style="vertical-align:text-bottom;border:none;" /> '._nodesforum_display_title($_nodesforum_this_user_publicname,$_nodesforum_max_word_length_in_titles)."'".$user_s_proprietary_s.' posting history';

    $_nodesforum_ancestry=$_nodesforum_ancestry_separator.'0'.$_nodesforum_ancestry_separator;
}
else if(substr($_GET['_nodesforum_node'],0,1)=='p')
{
    $_nodesforum_postfound=1;
    $this_node=$_GET['_nodesforum_node'];
    if($_nodesforum_risky_bbcode_title[$this_node])
    {$_nodesforum_postfound=2;}
    $_nodesforum_folder_or_post=1;
    $_nodesforum_title=$_nodesforum_risky_bbcode_title[$this_node];
    $_nodesforum_title_for_ancestry=$_nodesforum_risky_bbcode_title[$this_node];
    $_nodesforum_folder_description=$_nodesforum_risky_bbcode_description[$this_node];
    $_nodesforum_folder_description_disable_auto_smileys=1;
    $_nodesforum_folder_description_disable_auto_links=1;
    $_nodesforum_allow_posting=2;
    $_nodesforum_ancestry=$_nodesforum_ancestry_separator.'0'.$_nodesforum_ancestry_separator;
    $_nodesforum_creator_uniqueID=$_nodesforum_main_mod_uniqueID;

    foreach($_nodesforum_risky_bbcode_title as $key => $value)
    {$_nodesforum_display_pn[$key]=1;}
    $_nodesforum_folder_p_inf_str=implode('!',$_nodesforum_display_pn);


    $_nodesforum_youarehere='<img src="'.$_nodesforum_home_icon.'" style="vertical-align:text-bottom;border:none;" /> <a href="?_nodesforum_node=0">root</a>';
    $thisicon='<img src="'.$_nodesforum_power_icon.'" style="vertical-align:text-bottom;border:none;" />';
    $_nodesforum_original_youarehere=$_nodesforum_youarehere.' => '.$thisicon.' '._nodesforum_display_title($_nodesforum_title,$_nodesforum_max_word_length_in_titles);
    if(isset($_GET['_nodesforum_add_folder']))
    {
        $_nodesforum_youarehere=$_nodesforum_youarehere.' => '.$thisicon.' <a href="?_nodesforum_node='.$_GET['_nodesforum_node'].'">'._nodesforum_display_title($_nodesforum_title,$_nodesforum_max_word_length_in_titles).'</a> => <img src="'.$_nodesforum_tool_icon.'" style="vertical-align:text-bottom;border:none;" /> add folder';
        $_nodesforum_title=$_nodesforum_title.' - add folder';
    }
    else if(isset($_GET['_nodesforum_edit_folder']))
    {
        $_nodesforum_youarehere=$_nodesforum_youarehere.' => '.$thisicon.' <a href="?_nodesforum_node='.$_GET['_nodesforum_node'].'">'._nodesforum_display_title($_nodesforum_title,$_nodesforum_max_word_length_in_titles).'</a> => <img src="'.$_nodesforum_tool_icon.'" style="vertical-align:text-bottom;border:none;" /> edit folder (<img src="'.$_nodesforum_folder_icon.'" style="vertical-align:text-bottom;border:none;" /> <a href="?_nodesforum_node='.$_GET['_nodesforum_edit_folder'].'">'._nodesforum_display_title($_nodesforum_remember_folder_name,$_nodesforum_max_word_length_in_titles).'</a>)';
        $_nodesforum_title=$_nodesforum_title.' - edit folder';
    }
    else if(isset($_GET['_nodesforum_add_post']))
    {
        $_nodesforum_youarehere=$_nodesforum_youarehere.' => '.$thisicon.' <a href="?_nodesforum_node='.$_GET['_nodesforum_node'].'">'._nodesforum_display_title($_nodesforum_title,$_nodesforum_max_word_length_in_titles).'</a> => <img src="'.$_nodesforum_tool_icon.'" style="vertical-align:text-bottom;border:none;" /> add post';
        $_nodesforum_title=$_nodesforum_title.' - add post';
    }
    else if(isset($_GET['_nodesforum_edit_post']))
    {
        $_nodesforum_youarehere=$_nodesforum_youarehere.' => '.$thisicon.' <a href="?_nodesforum_node='.$_GET['_nodesforum_node'].'">'._nodesforum_display_title($_nodesforum_title,$_nodesforum_max_word_length_in_titles).'</a> => <img src="'.$_nodesforum_tool_icon.'" style="vertical-align:text-bottom;border:none;" /> edit post';
        if($_nodesforum_folder_or_post==1)
        {$_nodesforum_youarehere=$_nodesforum_youarehere.' (<img src="'.$_nodesforum_post_icon.'" style="vertical-align:text-bottom;border:none;" /> <a href="?_nodesforum_node='.$_GET['_nodesforum_edit_post'].'">'._nodesforum_display_title($_nodesforum_remember_post_name,$_nodesforum_max_word_length_in_titles).'</a>)';}
        $_nodesforum_title=$_nodesforum_title.' - edit post';
    }
    else if(isset($_GET['_nodesforum_move']))
    {        
        if($_nodesforum_move_folder_or_post==1)
        {
            $_nodesforum_action_icon=$_nodesforum_folder_icon;
            $iscalled='folder';
        }
        else if($_nodesforum_move_folder_or_post==2)
        {
            $_nodesforum_action_icon=$_nodesforum_post_icon;
            $iscalled='post';
        }
        $_nodesforum_youarehere=$_nodesforum_youarehere.' => '.$thisicon.' <a href="?_nodesforum_node='.$_GET['_nodesforum_node'].'">'._nodesforum_display_title($_nodesforum_title,$_nodesforum_max_word_length_in_titles).'</a> => <img src="'.$_nodesforum_move_icon.'" style="vertical-align:text-bottom;border:none;" /> move '.$iscalled.' (<img src="'.$_nodesforum_action_icon.'" style="vertical-align:text-bottom;border:none;" /> <a href="?_nodesforum_node='.$_GET['_nodesforum_move'].'">'._nodesforum_display_title($_nodesforum_move_title,$_nodesforum_max_word_length_in_titles).'</a>)';
        $_nodesforum_title=$_nodesforum_title.' - move '.$iscalled;
    }
    else
    {$_nodesforum_youarehere=$_nodesforum_original_youarehere;}
}
else if(substr($_GET['_nodesforum_node'],0,1)=='u')
{
    $_nodesforum_postfound=1;
    $this_user_uniqueID=substr($_GET['_nodesforum_node'],1);
    $addslashed_user_uniqueID=mysql_real_escape_string($this_user_uniqueID);


    if(substr($_GET['_nodesforum_node'],1)==$_nodesforum_uniqueID_of_deleted_user)
    {
        $_nodesforum_postfound=2;
        $_nodesforum_this_user_publicname='deleted user';
        $thisicon='<img src="'.$_nodesforum_userhome_grey_icon.'" style="vertical-align:text-bottom;border:none;" />';
    }
    else
    {
        $thisicon='<img src="'.$_nodesforum_userhome_icon.'" style="vertical-align:text-bottom;border:none;" />';


        //get user publicname
        $regtime_selector='';
        if($_nodesforum_external_user_system_show_registration_time=='yes')
        {$regtime_selector=', '.$_nodesforum_external_user_system_registration_time_rowname;}
        $result = mysql_query("SELECT $_nodesforum_external_user_system_publicname_rowname $regtime_selector FROM $_nodesforum_external_user_system_table_name WHERE $_nodesforum_external_user_system_user_uniqueID_rowname = '$addslashed_user_uniqueID'");
        while($row = mysql_fetch_array($result))
        {
            $_nodesforum_postfound=2;
            $_nodesforum_this_user_publicname=$row[$_nodesforum_external_user_system_publicname_rowname];
            $_nodesforum_this_user_registration_time=0;
            if($_nodesforum_external_user_system_show_registration_time=='yes')
            {$_nodesforum_this_user_registration_time=$row[$_nodesforum_external_user_system_registration_time_rowname];}
        }
        //read user user_data to show on page
        $hasuserdata=0;
        $read_p_part='';
        foreach($_nodesforum_risky_bbcode_title as $key => $value)
        {$read_p_part=$read_p_part.', '.$key;}
        $result = mysql_query("SELECT avatar, signature, allow_posting_on_personal_page, total_folders, total_posts, total_replies $read_p_part FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_user_data WHERE uniqueID = '$addslashed_user_uniqueID'");
        while($row = mysql_fetch_array($result))
        {
            $hasuserdata=1;
            $_nodesforum_userpage_avatar=$row['avatar'];
            $_nodesforum_userpage_signature=$row['signature'];
            if($_nodesforum_userpage_signature!=0)
            {
                $myquery="SELECT post, disable_auto_smileys, disable_auto_links FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts WHERE fapID = '$_nodesforum_userpage_signature'";
                $result2 = mysql_query($myquery);
                while($row2 = mysql_fetch_array($result2))
                {
                    $_nodesforum_userpage_signature_post=$row2['post'];
                    $_nodesforum_userpage_signature_post_disable_auto_smileys=$row2['disable_auto_smileys'];
                    $_nodesforum_userpage_signature_post_disable_auto_links=$row2['disable_auto_links'];
                }
            }
            $_nodesforum_userpage_allow_posting_on_personal_page=$row['allow_posting_on_personal_page'];
            $_nodesforum_userpage_total_folders=$row['total_folders'];
            $_nodesforum_userpage_total_posts=$row['total_posts'];
            $_nodesforum_userpage_total_replies=$row['total_replies'];
            foreach($_nodesforum_risky_bbcode_title as $key => $value)
            {$_nodesforum_userpage_pn[$key]=$row[$key];}
        }

    }



    if($hasuserdata==0)
    {
        $_nodesforum_userpage_avatar='';
        $_nodesforum_userpage_signature=0;
        $_nodesforum_userpage_allow_posting_on_personal_page=0;
        $_nodesforum_userpage_total_folders=0;
        $_nodesforum_userpage_total_posts=0;
        $_nodesforum_userpage_total_replies=0;
        foreach($_nodesforum_risky_bbcode_title as $key => $value)
        {$_nodesforum_userpage_pn[$key]=0;}
    }
    if($this_user_uniqueID==$_nodesforum_main_mod_uniqueID)
    {
        foreach($_nodesforum_risky_bbcode_title as $key => $value)
        {$_nodesforum_userpage_pn[$key]=1;}
    }

    if($_nodesforum_userpage_allow_posting_on_personal_page==0)
    {$_nodesforum_userpage_allow_posting_on_personal_page=2;}


    //-----------------
    $last_letter_of_publicname=substr($_nodesforum_this_user_publicname,strlen($_nodesforum_this_user_publicname)-1,1);
    $user_s_proprietary_s='s';
    if($last_letter_of_publicname=='s' || $last_letter_of_publicname=='z')
    {$user_s_proprietary_s='';}
    $_nodesforum_folder_or_post=1;
    $_nodesforum_title=$_nodesforum_this_user_publicname."'".$user_s_proprietary_s.' forum page';
    $_nodesforum_title_for_ancestry=$_nodesforum_title;
    $_nodesforum_allow_posting=$_nodesforum_userpage_allow_posting_on_personal_page;
    $_nodesforum_allow_guest_reply=0;
    $_nodesforum_ancestry=$_nodesforum_ancestry_separator.'0'.$_nodesforum_ancestry_separator;
    $_nodesforum_creator_uniqueID=$this_user_uniqueID;

    $_nodesforum_folder_p_inf_str=implode('!',$_nodesforum_userpage_pn);


    $_nodesforum_youarehere='<img src="'.$_nodesforum_home_icon.'" style="vertical-align:text-bottom;border:none;" /> <a href="?_nodesforum_node=0">root</a>';
    $_nodesforum_original_youarehere=$_nodesforum_youarehere.' => '.$thisicon.' '._nodesforum_display_title($_nodesforum_title,$_nodesforum_max_word_length_in_titles);
    if(isset($_GET['_nodesforum_add_folder']))
    {
        $_nodesforum_youarehere=$_nodesforum_youarehere.' => '.$thisicon.' <a href="?_nodesforum_node='.$_GET['_nodesforum_node'].'">'._nodesforum_display_title($_nodesforum_title,$_nodesforum_max_word_length_in_titles).'</a> => <img src="'.$_nodesforum_tool_icon.'" style="vertical-align:text-bottom;border:none;" /> add folder';
        $_nodesforum_title=$_nodesforum_title.' - add folder';
    }
    else if(isset($_GET['_nodesforum_edit_folder']))
    {
        $_nodesforum_youarehere=$_nodesforum_youarehere.' => '.$thisicon.' <a href="?_nodesforum_node='.$_GET['_nodesforum_node'].'">'._nodesforum_display_title($_nodesforum_title,$_nodesforum_max_word_length_in_titles).'</a> => <img src="'.$_nodesforum_tool_icon.'" style="vertical-align:text-bottom;border:none;" /> edit folder (<img src="'.$_nodesforum_folder_icon.'" style="vertical-align:text-bottom;border:none;" /> <a href="?_nodesforum_node='.$_GET['_nodesforum_edit_folder'].'">'._nodesforum_display_title($_nodesforum_remember_folder_name,$_nodesforum_max_word_length_in_titles).'</a>)';
        $_nodesforum_title=$_nodesforum_title.' - edit folder';
    }
    else if(isset($_GET['_nodesforum_add_post']))
    {
        $_nodesforum_youarehere=$_nodesforum_youarehere.' => '.$thisicon.' <a href="?_nodesforum_node='.$_GET['_nodesforum_node'].'">'._nodesforum_display_title($_nodesforum_title,$_nodesforum_max_word_length_in_titles).'</a> => <img src="'.$_nodesforum_tool_icon.'" style="vertical-align:text-bottom;border:none;" /> add post';
        $_nodesforum_title=$_nodesforum_title.' - add post';
    }
    else if(isset($_GET['_nodesforum_edit_post']))
    {
        $_nodesforum_youarehere=$_nodesforum_youarehere.' => '.$thisicon.' <a href="?_nodesforum_node='.$_GET['_nodesforum_node'].'">'._nodesforum_display_title($_nodesforum_title,$_nodesforum_max_word_length_in_titles).'</a> => <img src="'.$_nodesforum_tool_icon.'" style="vertical-align:text-bottom;border:none;" /> edit post';
        if($_nodesforum_folder_or_post==1)
        {$_nodesforum_youarehere=$_nodesforum_youarehere.' (<img src="'.$_nodesforum_post_icon.'" style="vertical-align:text-bottom;border:none;" /> <a href="?_nodesforum_node='.$_GET['_nodesforum_edit_post'].'">'._nodesforum_display_title($_nodesforum_remember_post_name,$_nodesforum_max_word_length_in_titles).'</a>)';}
        $_nodesforum_title=$_nodesforum_title.' - edit post';
    }
    else if(isset($_GET['_nodesforum_move']))
    {
        if($_nodesforum_move_folder_or_post==1)
        {
            $_nodesforum_action_icon=$_nodesforum_folder_icon;
            $iscalled='folder';
        }
        else if($_nodesforum_move_folder_or_post==2)
        {
            $_nodesforum_action_icon=$_nodesforum_post_icon;
            $iscalled='post';
        }
        $_nodesforum_youarehere=$_nodesforum_youarehere.' => '.$thisicon.' <a href="?_nodesforum_node='.$_GET['_nodesforum_node'].'">'._nodesforum_display_title($_nodesforum_title,$_nodesforum_max_word_length_in_titles).'</a> => <img src="'.$_nodesforum_move_icon.'" style="vertical-align:text-bottom;border:none;" /> move '.$iscalled.' (<img src="'.$_nodesforum_action_icon.'" style="vertical-align:text-bottom;border:none;" /> <a href="?_nodesforum_node='.$_GET['_nodesforum_move'].'">'._nodesforum_display_title($_nodesforum_move_title,$_nodesforum_max_word_length_in_titles).'</a>)';
        $_nodesforum_title=$_nodesforum_title.' - move '.$iscalled;
    }
    else
    {$_nodesforum_youarehere=$_nodesforum_original_youarehere;}
}
else if($_GET['_nodesforum_node']=='0')
{
    //get info about root folder
    $_nodesforum_folder_or_post=1;
    $_nodesforum_title=$_nodesforum_forum_name;
    $_nodesforum_title_for_ancestry='root';
    $_nodesforum_folder_description=$_nodesforum_forum_description;
    $_nodesforum_folder_description_disable_auto_smileys=1;
    $_nodesforum_folder_description_disable_auto_links=1;
    $_nodesforum_allow_posting=1;
    $_nodesforum_ancestry=$_nodesforum_ancestry_separator;
    $_nodesforum_creator_uniqueID=$_nodesforum_main_mod_uniqueID;

    foreach($_nodesforum_risky_bbcode_title as $key => $value)
    {$_nodesforum_display_pn[$key]=1;}
    $_nodesforum_folder_p_inf_str=implode('!',$_nodesforum_display_pn);

    $_nodesforum_original_youarehere='<img src="'.$_nodesforum_home_icon.'" style="vertical-align:text-bottom;border:none;" /> root';
    if(isset($_GET['_nodesforum_add_folder']))
    {
        $_nodesforum_youarehere='<img src="'.$_nodesforum_home_icon.'" style="vertical-align:text-bottom;border:none;" /> <a href="?">root</a> => <img src="'.$_nodesforum_tool_icon.'" style="vertical-align:text-bottom;border:none;" /> add folder';
        $_nodesforum_title=$_nodesforum_title.' - add folder';
    }
    else if(isset($_GET['_nodesforum_edit_folder']))
    {
        $_nodesforum_youarehere='<img src="'.$_nodesforum_home_icon.'" style="vertical-align:text-bottom;border:none;" /> <a href="?">root</a> => <img src="'.$_nodesforum_tool_icon.'" style="vertical-align:text-bottom;border:none;" /> edit folder (<img src="'.$_nodesforum_folder_icon.'" style="vertical-align:text-bottom;border:none;" /> <a href="?_nodesforum_node='.$_GET['_nodesforum_edit_folder'].'">'._nodesforum_display_title($_nodesforum_remember_folder_name,$_nodesforum_max_word_length_in_titles).'</a>)';
        $_nodesforum_title=$_nodesforum_title.' - edit folder';
    }
    else if(isset($_GET['_nodesforum_add_post']))
    {
        $_nodesforum_youarehere='<img src="'.$_nodesforum_home_icon.'" style="vertical-align:text-bottom;border:none;" /> <a href="?">root</a> => <img src="'.$_nodesforum_tool_icon.'" style="vertical-align:text-bottom;border:none;" /> add post';
        $_nodesforum_title=$_nodesforum_title.' - add post';
    }
    else if(isset($_GET['_nodesforum_edit_post']))
    {
        $_nodesforum_youarehere='<img src="'.$_nodesforum_home_icon.'" style="vertical-align:text-bottom;border:none;" /> <a href="?">root</a> => <img src="'.$_nodesforum_tool_icon.'" style="vertical-align:text-bottom;border:none;" /> edit post (<img src="'.$_nodesforum_post_icon.'" style="vertical-align:text-bottom;border:none;" /> <a href="?_nodesforum_node='.$_GET['_nodesforum_edit_post'].'">'._nodesforum_display_title($_nodesforum_remember_post_name,$_nodesforum_max_word_length_in_titles).'</a>)';
        $_nodesforum_title=$_nodesforum_title.' - edit post';
    }
    else if(isset($_GET['_nodesforum_move']))
    {
        if($_nodesforum_move_folder_or_post==1)
        {
            $_nodesforum_action_icon=$_nodesforum_folder_icon;
            $iscalled='folder';
        }
        else if($_nodesforum_move_folder_or_post==2)
        {
            $_nodesforum_action_icon=$_nodesforum_post_icon;
            $iscalled='post';
        }
        $_nodesforum_title=$_nodesforum_title.' - move '.$iscalled;
        $_nodesforum_youarehere='<img src="'.$_nodesforum_home_icon.'" style="vertical-align:text-bottom;border:none;" /> <a href="?">root</a> => <img src="'.$_nodesforum_move_icon.'" style="vertical-align:text-bottom;border:none;" /> move '.$iscalled.' (<img src="'.$_nodesforum_action_icon.'" style="vertical-align:text-bottom;border:none;" /> <a href="?_nodesforum_node='.$_GET['_nodesforum_move'].'">'._nodesforum_display_title($_nodesforum_move_title,$_nodesforum_max_word_length_in_titles).'</a>)';
    }
    else
    {$_nodesforum_youarehere=$_nodesforum_original_youarehere;}
}
else
{
    //read info about folder or post
    $_nodesforum_postfound=1;

    //read about post or folder in db
    $myquery="SELECT folder_or_post, title, post, disable_auto_smileys, disable_auto_links, allow_posting, allow_guest_reply, ancestry, creator_uniqueID, skeleton FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts WHERE fapID = '$addslashed_node'";
    $result = mysql_query($myquery);
    while($row = mysql_fetch_array($result))
    {
        $_nodesforum_postfound=2;
        $_nodesforum_folder_or_post=$row['folder_or_post'];
        $_nodesforum_title=$row['title'];
        $_nodesforum_title_for_ancestry=$_nodesforum_title;
        $_nodesforum_folder_description=$row['post'];
        $_nodesforum_folder_description_disable_auto_smileys=$row['disable_auto_smileys'];
        $_nodesforum_folder_description_disable_auto_links=$row['disable_auto_links'];
        $_nodesforum_allow_posting=$row['allow_posting'];
        $_nodesforum_allow_guest_reply=$row['allow_guest_reply'];
        $_nodesforum_ancestry=$row['ancestry'];
        $_nodesforum_creator_uniqueID=$row['creator_uniqueID'];
        $_nodesforum_is_skeleton=$row['skeleton'];


        //if is folder define creator risky code powers..
        if($_nodesforum_folder_or_post==1)
        {
            //first init to all powers off
            foreach($_nodesforum_risky_bbcode_title as $key => $value)
            {$_nodesforum_display_pn[$key]=0;}
            //if creator is main mod, turn all powers on
            if($_nodesforum_creator_uniqueID==$_nodesforum_main_mod_uniqueID)
            {
                foreach($_nodesforum_risky_bbcode_title as $key => $value)
                {$_nodesforum_display_pn[$key]=1;}
            }
            //else check if creator has user data and set powers accordingly if he does
            else if($_nodesforum_folder_description!='')
            {
                $read_p_part='';
                foreach($_nodesforum_risky_bbcode_title as $key => $value)
                {$read_p_part=$read_p_part.', '.$key;}
                $result = mysql_query("SELECT avatar, signature, allow_posting_on_personal_page, total_folders, total_posts, total_replies $read_p_part FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_user_data WHERE uniqueID = '$addslashed_user_uniqueID'");
                while($row = mysql_fetch_array($result))
                {
                    foreach($_nodesforum_risky_bbcode_title as $key => $value)
                    {$_nodesforum_userpage_pn[$key]=$row[$key];}
                }
            }
            $_nodesforum_folder_p_inf_str=implode('!',$_nodesforum_display_pn);
        }



        $_nodesforum_youarehere=_nodesforum_make_ancestryz($_nodesforum_ancestry);

        $thisicon='<img src="'.$_nodesforum_folder_icon.'" style="vertical-align:text-bottom;border:none;" />';
        if($_nodesforum_folder_or_post==2)
        {$thisicon='<img src="'.$_nodesforum_post_icon.'" style="vertical-align:text-bottom;border:none;" />';}
        $_nodesforum_original_youarehere=$_nodesforum_youarehere.' => '.$thisicon.' '._nodesforum_display_title($_nodesforum_title,$_nodesforum_max_word_length_in_titles);
        if(isset($_GET['_nodesforum_add_folder']))
        {
            $_nodesforum_youarehere=$_nodesforum_youarehere.' => '.$thisicon.' <a href="?_nodesforum_node='.$_GET['_nodesforum_node'].'">'._nodesforum_display_title($_nodesforum_title,$_nodesforum_max_word_length_in_titles).'</a> => <img src="'.$_nodesforum_tool_icon.'" style="vertical-align:text-bottom;border:none;" /> add folder';
            $_nodesforum_title=$_nodesforum_title.' - add folder';
        }
        else if(isset($_GET['_nodesforum_edit_folder']))
        {
            $_nodesforum_youarehere=$_nodesforum_youarehere.' => '.$thisicon.' <a href="?_nodesforum_node='.$_GET['_nodesforum_node'].'">'._nodesforum_display_title($_nodesforum_title,$_nodesforum_max_word_length_in_titles).'</a> => <img src="'.$_nodesforum_tool_icon.'" style="vertical-align:text-bottom;border:none;" /> edit folder (<img src="'.$_nodesforum_folder_icon.'" style="vertical-align:text-bottom;border:none;" /> <a href="?_nodesforum_node='.$_GET['_nodesforum_edit_folder'].'">'._nodesforum_display_title($_nodesforum_remember_folder_name,$_nodesforum_max_word_length_in_titles).'</a>)';
            $_nodesforum_title=$_nodesforum_title.' - edit folder';
        }
        else if(isset($_GET['_nodesforum_add_post']))
        {
            $_nodesforum_postorreply='post';
            if($_nodesforum_folder_or_post==2)
            {$_nodesforum_postorreply='reply';}
            $_nodesforum_youarehere=$_nodesforum_youarehere.' => '.$thisicon.' <a href="?_nodesforum_node='.$_GET['_nodesforum_node'].'">'._nodesforum_display_title($_nodesforum_title,$_nodesforum_max_word_length_in_titles).'</a> => <img src="'.$_nodesforum_tool_icon.'" style="vertical-align:text-bottom;border:none;" /> add '.$_nodesforum_postorreply;
            $_nodesforum_title=$_nodesforum_title.' - add '.$_nodesforum_postorreply;
        }
        else if(isset($_GET['_nodesforum_edit_post']))
        {
            $_nodesforum_postorreply='post';
            if($_nodesforum_edit_firstletterof_containing_folder_or_post=='p')
            {$_nodesforum_postorreply='reply';}
            $_nodesforum_youarehere=$_nodesforum_youarehere.' => '.$thisicon.' <a href="?_nodesforum_node='.$_GET['_nodesforum_node'].'">'._nodesforum_display_title($_nodesforum_title,$_nodesforum_max_word_length_in_titles).'</a> => <img src="'.$_nodesforum_tool_icon.'" style="vertical-align:text-bottom;border:none;" /> edit '.$_nodesforum_postorreply;
            if($_nodesforum_folder_or_post==1)
            {$_nodesforum_youarehere=$_nodesforum_youarehere.' (<img src="'.$_nodesforum_post_icon.'" style="vertical-align:text-bottom;border:none;" /> <a href="?_nodesforum_node='.$_GET['_nodesforum_edit_post'].'">'._nodesforum_display_title($_nodesforum_remember_post_name,$_nodesforum_max_word_length_in_titles).'</a>)';}
            $_nodesforum_title=$_nodesforum_title.' - edit '.$_nodesforum_postorreply;
        }
        else if(isset($_GET['_nodesforum_move']))
        {
            if($_nodesforum_move_folder_or_post==1)
            {
                $_nodesforum_action_icon=$_nodesforum_folder_icon;
                $iscalled='folder';
            }
            else if($_nodesforum_move_folder_or_post==2)
            {
                $_nodesforum_action_icon=$_nodesforum_post_icon;
                $iscalled='post';
            }
            $_nodesforum_youarehere=$_nodesforum_youarehere.' => '.$thisicon.' <a href="?_nodesforum_node='.$_GET['_nodesforum_node'].'">'._nodesforum_display_title($_nodesforum_title,$_nodesforum_max_word_length_in_titles).'</a> => <img src="'.$_nodesforum_move_icon.'" style="vertical-align:text-bottom;border:none;" /> move '.$iscalled.' (<img src="'.$_nodesforum_action_icon.'" style="vertical-align:text-bottom;border:none;" /> <a href="?_nodesforum_node='.$_GET['_nodesforum_move'].'">'._nodesforum_display_title($_nodesforum_move_title,$_nodesforum_max_word_length_in_titles).'</a>)';
            $_nodesforum_title=$_nodesforum_title.' - move '.$iscalled;
        }
        else
        {$_nodesforum_youarehere=$_nodesforum_original_youarehere;}
    }
}

if($_nodesforum_postfound==1)
{
    $_nodesforum_title='post or folder not found - '.$_nodesforum_forum_name;
    $_nodesforum_youarehere='<img src="'.$_nodesforum_home_icon.'" style="vertical-align:text-bottom;border:none;" /> <a href="?">root</a> => <img src="'.$_nodesforum_warn_icon.'" style="vertical-align:text-bottom;border:none;" /> not found!';
}








//decide if mod or not
$_nodesforum_ismod=0;
$_nodesforum_explain_modship='';
$_nodesforum_modship_authoritative_folder=-1;
$_nodesforum_modship_authority_depth=9999999999999;
$_nodesforum_mod_level=9999999999999;

$_nodesforum_righttoaudit=0;
$_nodesforum_explain_righttoaudit='';
$_nodesforum_righttoaudit_authoritative_folder=-1;
$_nodesforum_righttoaudit_authority_depth=9999999999999;

$_nodesforum_isbanned=0;
$_nodesforum_explain_banship='';
$_nodesforum_banship_authoritative_folder=-1;
$_nodesforum_banship_authority_depth=9999999999999;
$_nodesforum_ban_reason='';

if($_nodesforum_folder_or_post==1)
{$thinger='folder';}
else if($_nodesforum_folder_or_post==2)
{$thinger='post';}

if($_SESSION[$_nodesforum_external_user_system_uniqueID_session_name]==$_nodesforum_main_mod_uniqueID)
{
    $_nodesforum_ismod=1;
    $_nodesforum_mod_level=-2;
    $_nodesforum_explain_modship=' (main forum moderator)';
    $_nodesforum_modship_authoritative_folder=0;
    $_nodesforum_remember_modership_folders[0]='rememeber';
    foreach($_nodesforum_risky_bbcode_title as $key => $value)
    {$_nodesforum_remember_modership_folders[$key]='rememeber';}

    $_nodesforum_righttoaudit=1;
    $_nodesforum_explain_righttoaudit=' (main forum moderator)';
    $_nodesforum_righttoaudit_authoritative_folder=0;
    $_nodesforum_remember_righttoaudit_folders[0]='rememeber';
    $_nodesforum_remember_righttoaudit_folders_audited[0]=1;
}
else
{
    if($_nodesforum_folder_or_post==1)
    {$thinger='folder';}
    else if($_nodesforum_folder_or_post==2)
    {$thinger='post';}



    $ancestry_plus_node=$_nodesforum_ancestry.$_GET['_nodesforum_node'].$_nodesforum_ancestry_separator;
    $exploded_ancestry_plus_node=explode($_nodesforum_ancestry_separator,$ancestry_plus_node);
    //remove empty elements
    $exploded_ancestry_plus_node=array_filter($exploded_ancestry_plus_node, function($value) { return $value !== ''; });

    //"limit to relevant" clause to make mod power check lighter
    if(isset($_GET['_nodesforum_move']) || isset($_GET['_nodesforum_restore']))
    {
        //do not limit to relevant in the case of a move operation
        $limit_to_relevant_clause_for_mods="";
        $limit_to_relevant_clause_for_fap="";
    }
    else
    {
        $limit_to_relevant_clause_for_mods=" && folderID in (";
        $limit_to_relevant_clause_for_fap=" && fapID in (";
        $countem=0;
        foreach($exploded_ancestry_plus_node as $key => $value)
        {
            if($value!='')
            {
                $countem++;
                if($countem>1)
                {
                    $limit_to_relevant_clause_for_mods=$limit_to_relevant_clause_for_mods.', ';
                    $limit_to_relevant_clause_for_fap=$limit_to_relevant_clause_for_fap.', ';
                }
                $limit_to_relevant_clause_for_mods=$limit_to_relevant_clause_for_mods."'".$value."'";
                $limit_to_relevant_clause_for_fap=$limit_to_relevant_clause_for_fap."'".$value."'";
            }
        }
        $limit_to_relevant_clause_for_mods=$limit_to_relevant_clause_for_mods.")";
        $limit_to_relevant_clause_for_fap=$limit_to_relevant_clause_for_fap.")";
        if($countem==0)
        {
            $limit_to_relevant_clause_for_mods='';
            $limit_to_relevant_clause_for_fap='';
        }
    }







    if(isset($_SESSION[$_nodesforum_external_user_system_uniqueID_session_name]))
    {


        //find if user is mod on this folder or a parent folder
        $my_uniqueID=$_SESSION[$_nodesforum_external_user_system_uniqueID_session_name];
        $myquery="SELECT mod_uniqueID, folderID, mod_level, ip, reason, AES_ENCRYPT('$_nodesforum_enc_ip','$_nodesforum_enc_ip') as enc_ip FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_mods WHERE (mod_uniqueID = '$my_uniqueID' || ip = AES_ENCRYPT('$_nodesforum_enc_ip','$_nodesforum_enc_ip')) $limit_to_relevant_clause_for_mods";
        $result = mysql_query($myquery);
        while($row = mysql_fetch_array($result))
        {
            $_nodesforum_your_AES_encip=$row['enc_ip'];
            $this_folderID=$row['folderID'];
            $this_mod_level=$row['mod_level'];
            if($this_mod_level==-13)
            {
                $_nodesforum_remember_bannership_folders[$this_folderID]='rememeber';
                $_nodesforum_remember_bannership_folder_reason[$this_folderID]=$row['reason'];
                if($row['ip']=='')
                {$_nodesforum_remember_bannership_folder_user_or_ip[$this_folderID]='user';}
                else if($row['mod_uniqueID']=='0')
                {$_nodesforum_remember_bannership_folder_user_or_ip[$this_folderID]='ip';}
            }
            else
            {
                $_nodesforum_remember_modership_folders[$this_folderID]='rememeber';
                $_nodesforum_remember_modership_folder_modlevel[$this_folderID]=$this_mod_level;
            }
        }
        $myquery="SELECT fapID, audited FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts WHERE creator_uniqueID = '$my_uniqueID' $limit_to_relevant_clause_for_fap";
        $result = mysql_query($myquery);
        while($row = mysql_fetch_array($result))
        {
            $this_folderID=$row['fapID'];
            $_nodesforum_remember_modership_folders[$this_folderID]='rememeber';
            $this_audited = $row['audited'];
            $_nodesforum_remember_righttoaudit_folders_audited[$this_folderID]=$this_audited;
        }
        $_nodesforum_remember_modership_folders['u'.$my_uniqueID]='rememeber';



        //here we must find all the keys of _nodesforum_remember_modership_folders
        //that do not start with a letter (so are actual folders)
        //and dont already have a corresponding $_nodesforum_remember_righttoaudit_folders_audited
        //we need to make a request to get the audited value of all the missing posts and folders!
        //so first find the _nodesforum_remember_modership_folders missing their _nodesforum_remember_righttoaudit_folders_audited
        $_missing_nodesforum_remember_righttoaudit_folders_audited = array();
        foreach($exploded_ancestry_plus_node as $key => $value)
        {
            if(substr($value,0,1)!='u' && substr($value,0,1)!='p' && substr($value,0,1)!='f' && !isset($_nodesforum_remember_righttoaudit_folders_audited[$value]))
            {
                $_missing_nodesforum_remember_righttoaudit_folders_audited[$value]='rememeber';
            }
        }
        //now make a request to get the audited value of all the missing posts and folders
        if(count($_missing_nodesforum_remember_righttoaudit_folders_audited)>0)
        {
            $missing_fapIDs = implode(',',array_keys($_missing_nodesforum_remember_righttoaudit_folders_audited));
            $myquery="SELECT fapID, audited FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts WHERE fapID IN ($missing_fapIDs)";
            $result = mysql_query($myquery);
            while($row = mysql_fetch_array($result))
            {
                $this_folderID=$row['fapID'];
                $_nodesforum_remember_righttoaudit_folders_audited[$this_folderID]=$row['audited'];
            }
        }


        if($_nodesforum_remember_modership_folders || $_nodesforum_remember_bannership_folders)
        {



            //find if guy has mod power running ancestors from the root
            //and if he has the right to audit!
            $depth=0;
            foreach($exploded_ancestry_plus_node as $key => $value)
            {
                if($value!='')
                {
                    $depth++;
                    if($_nodesforum_remember_modership_folders[$value])
                    {

                        //maybe give mod power here
                        if($_nodesforum_ismod==0){
                            $_nodesforum_ismod=1;
                            if($value==$_GET['_nodesforum_node'])
                            {
                                if($_SESSION[$_nodesforum_external_user_system_uniqueID_session_name]==$_nodesforum_creator_uniqueID)
                                {
                                    $_nodesforum_mod_level=0;
                                    $_nodesforum_explain_modship=' (creator of this '.$thinger.')';
                                    if(substr($_GET['_nodesforum_node'],0,1)=='u')
                                    {$_nodesforum_explain_modship=' (this is your own forum page)';}
                                }
                                else if(substr($_GET['_nodesforum_node'],0,1)!='p')
                                {
                                    $_nodesforum_mod_level=$_nodesforum_remember_modership_folder_modlevel[$value];
                                    $_nodesforum_explain_modship=' (moderator level '.$_nodesforum_mod_level.')';
                                }
                            }
                            else
                            {
                                $_nodesforum_mod_level=-1;
                                $_nodesforum_explain_modship=' (moderator of <a href="?_nodesforum_node='.$value.'">parent folder</a>)';
                            }
                            $_nodesforum_modship_authoritative_folder=$value;
                            $_nodesforum_modship_authority_depth=$depth;
                            //break;
                        }

                        //maybe give right to audit here
                        if(
                            $_nodesforum_remember_modership_folders[$value] // is mod on this folder
                            && $_nodesforum_remember_righttoaudit_folders_audited[$value]==1 // and this folder is already audited
                            && $_nodesforum_righttoaudit==0 // and does not already have right to audit
                        ){
                            $_nodesforum_righttoaudit=1;
                            if($value==$_GET['_nodesforum_node'])
                            {
                                $_nodesforum_explain_righttoaudit=' (you have the right to audit this '.$thinger.')';
                            }
                            else
                            {
                                $_nodesforum_explain_righttoaudit=' (you have the right to audit <a href="?_nodesforum_node='.$value.'">parent folder</a>)';
                            }
                            $_nodesforum_righttoaudit_authoritative_folder=$value;
                            $_nodesforum_righttoaudit_authority_depth=$depth;
                        }

                        //if already mod and has right to audit, no need to check further
                        if($_nodesforum_ismod==1 && $_nodesforum_righttoaudit==1){
                            break;
                        }
                    }
                }
            }

            //find if guy is banned running ancestors from the root
            $depth=0;
            foreach($exploded_ancestry_plus_node as $key => $value)
            {
                if($value!='')
                {
                    $depth++;
                    if($_nodesforum_remember_bannership_folders[$value])
                    {
                        $_nodesforum_isbanned=1;
                        $_nodesforum_ban_reason=$_nodesforum_remember_bannership_folder_reason[$value];
                        $your_iper='';
                        if($_nodesforum_remember_bannership_folder_user_or_ip[$value]=='ip')
                        {$your_iper='your IP address <input type="text" value="'.mysql_real_escape_string(base64_encode($_nodesforum_your_AES_encip)).'" readonly="readonly" onmouseup="highlight(this)" /> (encrypted) is ';}
                        if($value==$_GET['_nodesforum_node'])
                        {$_nodesforum_explain_banship=' ('.$your_iper.'banned from this '.$thinger.', reason: '._nodesforum_display_title($_nodesforum_ban_reason,$_nodesforum_max_word_length_in_titles).')';}
                        else
                        {$_nodesforum_explain_banship=' ('.$your_iper.'banned from <a href="?_nodesforum_node='.$value.'">parent folder</a>, reason: '._nodesforum_display_title($_nodesforum_ban_reason,$_nodesforum_max_word_length_in_titles).')';}
                        $_nodesforum_banship_authoritative_folder=$value;
                        $_nodesforum_banship_authority_depth=$depth;
                        break;
                    }
                }
            }



        }
    }
    else if(isset($_POST['_nodesforum_create_post']) || isset($_POST['_nodesforum_edit_post']) || isset($_GET['_nodesforum_delete']))
    {


        $myquery="SELECT folderID, ip, reason, AES_ENCRYPT('$_nodesforum_enc_ip','$_nodesforum_enc_ip') AS enc_ip FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_mods WHERE ip = AES_ENCRYPT('$_nodesforum_enc_ip','$_nodesforum_enc_ip') && mod_level = -13 $limit_to_relevant_clause_for_mods";
        $result = mysql_query($myquery);
        while($row = mysql_fetch_array($result))
        {
            $_nodesforum_your_AES_encip=$row['enc_ip'];
            $this_folderID=$row['folderID'];
            $_nodesforum_remember_bannership_folders[$this_folderID]='rememeber';
            $_nodesforum_remember_bannership_folder_reason[$this_folderID]=$row['reason'];
        }


        //find if guy is banned running ancestors from the root
        foreach($exploded_ancestry_plus_node as $key => $value)
        {
            if($value!='')
            {
                if($_nodesforum_remember_bannership_folders[$value])
                {
                    $_nodesforum_isbanned=1;
                    $_nodesforum_ban_reason=$_nodesforum_remember_bannership_folder_reason[$value];
                    if($value==$_GET['_nodesforum_node'])
                    {$_nodesforum_explain_banship=' (your IP address <input type="text" value="'.mysql_real_escape_string(base64_encode($_nodesforum_your_AES_encip)).'" readonly="readonly" onmouseup="highlight(this)" /> (encrypted) is banned from this '.$thinger.', reason: '._nodesforum_display_title($_nodesforum_ban_reason,$_nodesforum_max_word_length_in_titles).')';}
                    else
                    {$_nodesforum_explain_banship=' (your IP address <input type="text" value="'.mysql_real_escape_string(base64_encode($_nodesforum_your_AES_encip)).'" readonly="readonly" onmouseup="highlight(this)" /> (encrypted) is banned from <a href="?_nodesforum_node='.$value.'">parent folder</a>, reason: '._nodesforum_display_title($_nodesforum_ban_reason,$_nodesforum_max_word_length_in_titles).')';}
                    $_nodesforum_banship_authoritative_folder=$value;
                    break;
                }
            }
        }




    }
}



if($_nodesforum_ismod==1 && $_nodesforum_isbanned==1)
{
    if($_nodesforum_banship_authority_depth<$_nodesforum_modship_authority_depth)
    {$_nodesforum_ismod=0;}
    else
    {$_nodesforum_isbanned=0;}
}
if($_nodesforum_righttoaudit==1 && $_nodesforum_isbanned==1)
{
    if($_nodesforum_banship_authority_depth<$_nodesforum_righttoaudit_authority_depth)
    {$_nodesforum_righttoaudit=0;}
    else
    {$_nodesforum_isbanned=0;}
}



//if right to audit, find folders or posts needing auditing inside of the current folder or post
//show a count and a link to the audit page
//only if in folder or post view
$_nodesforum_mod_audit_count=0;
$_nodesforum_mod_audit_notification_html='';
if($_nodesforum_folder_or_post==1 || $_nodesforum_folder_or_post==2)
{
    if($_nodesforum_righttoaudit==1){
        
        //find all folders or posts where audited == 0 and that are inside of the current folder or post
        //ancestry like '%|'.$_GET['_nodesforum_node'].'|%'
        $ancestry_clause = "ancestry LIKE '%|".mysql_real_escape_string($_GET['_nodesforum_node'])."|%' &&";
        if($_GET['_nodesforum_node']=='0'){
            //if root folder, ancestry is empty
            $ancestry_clause = "";
        }
        $check_need_audit_query="SELECT fapID FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts WHERE $ancestry_clause audited = 0 && deletion_time = 0";
        $result = mysql_query($check_need_audit_query);
        while($row = mysql_fetch_array($result)){
            $this_fapID=$row['fapID'];
            $_nodesforum_mod_audit_count++;
        }
    }
}



//decide if power on skeleton
$_nodesforum_power_on_skeleton=0;
if($_SESSION[$_nodesforum_external_user_system_uniqueID_session_name]==$_nodesforum_main_mod_uniqueID || $_SESSION[$_nodesforum_external_user_system_uniqueID_session_name]==$_nodesforum_creator_uniqueID)
{$_nodesforum_power_on_skeleton=1;}
else if($_nodesforum_ismod==1)
{
    $exploded_ancestry=explode($ancestry_plus_node,$_nodesforum_ancestry);
    if($_nodesforum_is_skeleton==0)
    {
        if($_nodesforum_mod_level==-1)
        {$_nodesforum_power_on_skeleton=1;}
    }
    else
    {
        //make array of all ancestor that are skeleton with 1 db query
        $countem=0;
        $in_array_string='';
        foreach($exploded_ancestry as $key => $value)
        {
            if($value!='')
            {
                $countem++;
                if($countem>1)
                {$in_array_string=$in_array_string.', ';}
                $in_array_string=$in_array_string."'".mysql_real_escape_string($value)."'";
            }
        }
        $result = mysql_query("SELECT fapID FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts WHERE fapID in ($in_array_string) && skeleton = 1");
        while($row = mysql_fetch_array($result))
        {
            $this_fapID=$row['fapID'];
            $_nodesforum_ancestor_is_skeleton[$this_fapID]=1;
        }
        //run down ancestry from the end to find if power on skeleton
        $reverse_exploded_ancestry=$exploded_ancestry;
        array_reverse($reverse_exploded_ancestry);
        $hit_a_non_skeleton=0;
        foreach($reverse_exploded_ancestry as $key => $value)
        {
            if($value!='')
            {
                if($_nodesforum_remember_modership_folders[$value] && $hit_a_non_skeleton==1)
                {
                    $_nodesforum_power_on_skeleton=1;
                    break;
                }
                if(!$_nodesforum_ancestor_is_skeleton[$value])
                {$hit_a_non_skeleton=1;}
            }
        }
    }
}






//before re-adding the l, h or a, remember the actual node
$remember_actual_node=$addslashed_node;

if($temporary_remove_modslog_l==1)
{
    $_nodesforum_folder_or_post=4;
    //adjust history nav
    $cutlastword_pos=strripos($_nodesforum_youarehere,' /> ')+4;
    $_nodesforum_youarehere=substr($_nodesforum_youarehere,0,$cutlastword_pos).'<a href="?_nodesforum_node='.$_GET['_nodesforum_node'].'">'.substr($_nodesforum_youarehere,$cutlastword_pos).'</a> => <img src="'.$_nodesforum_history_icon.'" style="vertical-align:text-bottom;border:none;" /> '.$_nodesforum_title.' mods log';
    //put l back
    $_GET['_nodesforum_node']='l'.$_GET['_nodesforum_node'];
    $addslashed_node='l'.$addslashed_node;
}


if($temporary_remove_history_h==1)
{
    $_nodesforum_folder_or_post=3;
    //adjust history nav
    $cutlastword_pos=strripos($_nodesforum_youarehere,' /> ')+4;
    $_nodesforum_youarehere=substr($_nodesforum_youarehere,0,$cutlastword_pos).'<a href="?_nodesforum_node='.$_GET['_nodesforum_node'].'">'.substr($_nodesforum_youarehere,$cutlastword_pos).'</a> => <img src="'.$_nodesforum_history_icon.'" style="vertical-align:text-bottom;border:none;" /> '.$_nodesforum_title.' posts history';
    //put l back
    $_GET['_nodesforum_node']='h'.$_GET['_nodesforum_node'];
    $addslashed_node='h'.$addslashed_node;
}

if($temporary_remove_audit_a==1)
{
    $_nodesforum_folder_or_post=7;
    //adjust history nav
    $cutlastword_pos=strripos($_nodesforum_youarehere,' /> ')+4;
    $_nodesforum_youarehere=substr($_nodesforum_youarehere,0,$cutlastword_pos).'<a href="?_nodesforum_node='.$_GET['_nodesforum_node'].'">'.substr($_nodesforum_youarehere,$cutlastword_pos).'</a> => <img src="'.$_nodesforum_audit_icon.'" style="vertical-align:text-bottom;border:none;" /> '.$_nodesforum_title.' audit';
    //put l back
    $_GET['_nodesforum_node']='a'.$_GET['_nodesforum_node'];
    $addslashed_node='a'.$addslashed_node;
}











//search
if(isset($_GET['_nodesforum_search']))
{
    include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path.'pre_search.php'));
    $cutlastword_pos=strripos($_nodesforum_youarehere,' /> ')+4;
    $_nodesforum_youarehere=substr($_nodesforum_youarehere,0,$cutlastword_pos).'<a href="?_nodesforum_node='.$_GET['_nodesforum_node'].'">'.substr($_nodesforum_youarehere,$cutlastword_pos).'</a> => <img src="'.$_nodesforum_magnif_icon.'" style="vertical-align:text-bottom;border:none;" /> '.$search_title;
}















$_nodesforum_power_to_post=0;
if($_nodesforum_folder_or_post==1)
{
    //determine the right to post or not
    if($_nodesforum_allow_posting==1)
    {
        if($_nodesforum_ismod==1)
        {$_nodesforum_power_to_post=1;}
    }
    else if($_nodesforum_allow_posting==2)
    {
        if(isset($_SESSION[$_nodesforum_external_user_system_uniqueID_session_name]))
        {$_nodesforum_power_to_post=1;}
    }
}
else if($_nodesforum_folder_or_post==2)
{
    //increment views on this post
    mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts SET views = (views + 1) WHERE fapID = '$addslashed_node'");
}










//change 3rd party tag limit
if($_GET['_nodesforum_node']=='p4' && $_nodesforum_ismod==1 && isset($_POST['_nodesforum_set_new_3rd_party_tag_limit']))
{include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path.'pre_3rd_party_limits.php'));}




//delete folder or post
if(isset($_GET['_nodesforum_delete']) && $_nodesforum_isbanned==0)
{include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path.'pre_delete.php'));}

//audit folder or post
if(isset($_GET['_nodesforum_audit']) && $_nodesforum_isbanned==0)
{include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path.'pre_audit.php'));}
//unaudit folder or post
if(isset($_GET['_nodesforum_unaudit']) && $_nodesforum_isbanned==0)
{include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path.'pre_unaudit.php'));}


//move
$_nodesforum_move_folder_doesnt_exist=0;
$_nodesforum_move_folder_no_permission=0;
$_nodesforum_move_folder_not_folder=0;
$_nodesforum_move_banned_from_destination=0;
if((isset($_POST['_nodesforum_move']) && ($_nodesforum_ismod==1 || $_SESSION[$_nodesforum_external_user_system_uniqueID_session_name]==$_nodesforum_move_creator_uniqueID) && ($_nodesforum_move_skeleton==0 || $_nodesforum_power_on_skeleton==1 || $_nodesforum_move_creator_uniqueID==$_SESSION[$_nodesforum_external_user_system_uniqueID_session_name])) && $_nodesforum_isbanned==0)
{include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path.'pre_move.php'));}





//restore post or folder
$_nodesforum_restore_post_or_folder_has_no_right=0;
$_nodesforum_restore_cannot_restore_reply_if_post_is_deleted=0;
$_nodesforum_restore_node_noexist=0;
$_nodesforum_gofor_move_and_restore=0;
if(isset($_GET['_nodesforum_restore']) && isset($_GET['_nodesforum_main_actionID']) && isset($_GET['_nodesforum_handling_fapID']) && $_nodesforum_isbanned==0)
{include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path.'pre_restore.php'));}












//edit folder
$_nodesforum_create_folder_namecannotbeblank=0;
$_nodesforum_create_folder_dberror=0;
if((isset($_POST['_nodesforum_edit_folder']) && ($_nodesforum_ismod==1 || $_SESSION[$_nodesforum_external_user_system_uniqueID_session_name]==$_nodesforum_edit_creator_uniqueID) && ($_nodesforum_edit_skeleton==0 || $_nodesforum_power_on_skeleton==1 || $_nodesforum_edit_creator_uniqueID==$_SESSION[$_nodesforum_external_user_system_uniqueID_session_name])) && $_nodesforum_isbanned==0)
{include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path.'pre_edit_folder.php'));}



//add folder
if(isset($_POST['_nodesforum_create_folder']) && $_nodesforum_power_to_post==1 && $_nodesforum_isbanned==0)
{include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path.'pre_add_folder.php'));}



//edit post
$_nodesforum_create_post_namecannotbeblank=0;
$_nodesforum_img_ver_invalid=0;
$_nodesforum_post_too_short=0;
$_nodesforum_reply_too_short=0;
$_nodesforum_create_post_dberror=0;
$_nodesforum_already_haveapostfor_signature=0;
$_nodesforum_contains_invalid_strict_quotes='';
$oldestacceptabletimeforguesteditbyip=$_nodesforum_edit_creation_time+($_nodesforum_allow_guests_to_edit_their_posts_for_x_hours*3600);
if(isset($_POST['_nodesforum_edit_post']) && ($_nodesforum_ismod==1 || $_SESSION[$_nodesforum_external_user_system_uniqueID_session_name]==$_nodesforum_edit_creator_uniqueID || ($_nodesforum_edit_creator_uniqueID==0 && $_nodesforum_edit_creator_ip==$_nodesforum_enc_ip && $nowtime<$oldestacceptabletimeforguesteditbyip)) && $_nodesforum_isbanned==0)
{include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path.'pre_edit_post.php'));}


//add post
if(isset($_POST['_nodesforum_create_post']) && ($_nodesforum_power_to_post==1 || ($_nodesforum_folder_or_post==2 && (isset($_SESSION[$_nodesforum_external_user_system_uniqueID_session_name]) || ($_nodesforum_allow_guest_replies=='yes' && $_nodesforum_allow_guest_reply==1))) || (substr($_GET['_nodesforum_node'],0,1)=='s' && substr($_GET['_nodesforum_node'],1)==$_SESSION[$_nodesforum_external_user_system_uniqueID_session_name])) && $_nodesforum_isbanned==0)
{include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path.'pre_add_post.php'));}





//mod powers scripts
if(($_nodesforum_folder_or_post==1 || $_nodesforum_folder_or_post==2) && $_nodesforum_postfound!=1 && $_nodesforum_isbanned==0)
{
    //grant mod powers
    $_nodesforum_grant_cannotgivethatmodstren=0;
    $_nodesforum_grant_usernotfound=0;
    $_nodesforum_grant_personyouwannamodisalreadyhigher=0;
    $_nodesforum_grant_cannotchangeowner=0;
    $_nodesforum_grant_modmodded=0;
    if(isset($_POST['_nodesforum_grant_mod']) && $_nodesforum_ismod==1)
    {include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path.'pre_grant_mod.php'));}
    //remove mod powers
    $_nodesforum_demod_cannotdemodowner=0;
    $_nodesforum_demod_usernotmodhere=0;
    $_nodesforum_demod_cannotdemodmorepowerful=0;
    $_nodesforum_demod_suxxess=0;
    if(isset($_GET['_nodesforum_demod']) && $_nodesforum_ismod==1)
    {include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path.'pre_demod.php'));}




    //ban
    $_nodesforum_ban_usernotfound=0;
    $_nodesforum_ban_cannotchangeowner=0;
    $_nodesforum_ban_already_banned=0;
    $_nodesforum_ban_reason_is_blank=0;
    $_nodesforum_ban_banned=0;
    if(isset($_POST['_nodesforum_ban']) && $_nodesforum_ismod==1)
    {include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path.'pre_ban.php'));}
    //unban
    $_nodesforum_unban_usernotmodhere=0;
    $_nodesforum_unban_suxxess=0;
    if(isset($_GET['_nodesforum_unban']) && $_nodesforum_ismod==1)
    {include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path.'pre_unban.php'));}


    //ban ip
    $_nodesforum_ban_ip_notfound=0;
    $_nodesforum_ban_ip_already_banned=0;
    $_nodesforum_ban_ip_reason_is_blank=0;
    $_nodesforum_ban_ip_banned=0;
    if(isset($_POST['_nodesforum_ban_ip']) && $_nodesforum_ismod==1)
    {include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path.'pre_ban_ip.php'));}
    //unban ip
    $_nodesforum_unban_ip_notbanned_here=0;
    $_nodesforum_unban_ip_suxxess=0;
    if(isset($_GET['_nodesforum_unban_ip']) && $_nodesforum_ismod==1)
    {include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path.'pre_unban_ip.php'));}



    //grant power
    $_nodesforum_grantp_usernotfound=0;
    $_nodesforum_grantp_alreadyhve=0;
    $_nodesforum_grantp_modmodded=0;
    if(isset($_POST['_nodesforum_grant_p']) && $_nodesforum_ismod==1)
    {include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path.'pre_grant_p.php'));}
    //remove power
    $_nodesforum_remove_p_usernopower=0;
    $_nodesforum_remove_p_ismod=0;
    $_nodesforum_remove_p_suxxess=0;
    if(isset($_GET['_nodesforum_remove_p']) && $_nodesforum_ismod==1)
    {include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path.'pre_remove_p.php'));}
}



//folder, history or audit view
if($_nodesforum_folder_or_post==1 || $_nodesforum_folder_or_post==3 || $_nodesforum_folder_or_post==7)
{include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path.'pre_folder_view.php'));}
//post view
else if($_nodesforum_folder_or_post==2)
{include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path.'pre_post_view.php'));}
//mods log view
else if($_nodesforum_folder_or_post==4 && ($_nodesforum_ismod==1 || (isset($_SESSION[$_nodesforum_external_user_system_uniqueID_session_name]) && $_SESSION[$_nodesforum_external_user_system_uniqueID_session_name]==$_GET['_nodesforum_log_moded'])))
{include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path.'pre_mods_log_view.php'));}




