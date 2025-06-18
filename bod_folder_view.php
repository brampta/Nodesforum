<?php
a_function_that_is_only_in_the_pre_output();


//userpage header
if(substr($_GET['_nodesforum_node'],0,1)=='u')
{include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path.'bod_userpage.php'));}
else if($_GET['_nodesforum_node']=='p4' && $_GET['_nodesforum_node']!='0')
{include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path.'bod_3rd_party_limits.php'));}



//add folder or post buttons
$postingbuttonz='';
if($_nodesforum_power_to_post==1 && $_nodesforum_isbanned==0)
{
    $postingbuttonz=$postingbuttonz.'<img src="'.$_nodesforum_folder_icon.'" style="vertical-align:text-bottom;border:none;" /> <a href="?_nodesforum_node='.$_GET['_nodesforum_node'].'&_nodesforum_add_folder">add new folder</a> | <img src="'.$_nodesforum_post_icon.'" style="vertical-align:text-bottom;border:none;" /> <a href="?_nodesforum_node='.$_GET['_nodesforum_node'].'&_nodesforum_add_post">add new post</a>';
}
if($postingbuttonz!='')
{echo '<div style="height:4px;"><!-- --></div><div style="width:100%;"><table class="class_nodesforum_bgcolor3" style="width:100%;"><tr><td class="class_nodesforum_bgcolor2"><div class="class_nodesforum_inner">'.$postingbuttonz.'</div></td></tr></table></div>';}



//show all posts and folders inside:


$pagination='';
if($_nodesforum_totalpages>1)
{
    $extra_vars='';
    if(isset($_GET['_nodesforum_history_user']))
    {$extra_vars=$extra_vars.'&_nodesforum_history_user='.$_GET['_nodesforum_history_user'];}
    if(isset($_GET['_nodesforum_history_ip']))
    {$extra_vars=$extra_vars.'&_nodesforum_history_ip='.$_GET['_nodesforum_history_ip'];}

    $previouspage='';
    if($_GET['_nodesforum_page']>1)
    {$previouspage='<a href="?_nodesforum_node='.$_GET['_nodesforum_node'].$extra_vars.'&_nodesforum_page='.($_GET['_nodesforum_page']-1).'">previous</a> | ';}
    $nextpage='';
    if($_GET['_nodesforum_page']<$_nodesforum_totalpages)
    {$nextpage=' | <a href="?_nodesforum_node='.$_GET['_nodesforum_node'].$extra_vars.'&_nodesforum_page='.($_GET['_nodesforum_page']+1).'">next</a>';}
    $pagination='<div style="height:4px;"><!-- --></div><div style="width:100%;"><table class="class_nodesforum_bgcolor3" style="width:100%;"><tr><td class="class_nodesforum_bgcolor2"><div class="class_nodesforum_inner">'.$previouspage.'page '.$_GET['_nodesforum_page'].' of '.$_nodesforum_totalpages.$nextpage.'</div></td></tr></table></div>';
}



if($_nodesforum_folder_description!='')
{
    $user_or_guest=1;
    if($_nodesforum_creator_uniqueID==$_nodesforum_uniqueID_of_deleted_user)
    {$user_or_guest=0;}

    $maxheight=6000;


    echo '<div style="height:4px;"><!-- --></div><div style="width:100%;"><table class="class_nodesforum_bgcolor3" style="width:100%;table-layout:fixed;"><tr><td class="class_nodesforum_bgcolor2" style="overflow:hidden;"><div class="class_nodesforum_inner" style="width:100%;overflow:hidden;padding:0px;">';

    echo '<table style="width:100%;table-layout:fixed;"><tr><td>
            <div style="width:100%;overflow:auto;overflow-y:visible;">
            <div style="color:'.$_nodesforum_text_color.';max-height:'.$maxheight.'px;overflow-y:auto;height:expression( this.scrollHeight > '.$maxheight.'? '."'".''.$maxheight.'px'."'".' : '."'".'auto'."'".' );">';

    echo display_bb($_nodesforum_folder_description,$_nodesforum_folder_p_inf_str,$user_or_guest,$_nodesforum_folder_description_disable_auto_smileys,$_nodesforum_folder_description_disable_auto_links,0);

    echo '</div>
            </div>
            </td></tr></table>';

    echo '</div></td></tr></table></div>';




}



echo '<div style="height:4px;"><!-- --></div><div style="width:100%;"><table style="width:100%;table-layout: fixed;" class="class_nodesforum_bgcolor3">';
if($_nodesforum_display_fapID)
{
    foreach($_nodesforum_display_fapID as $key => $value)
    {
        $this_creator_uniqueID=$_nodesforum_display_creator_uniqueID[$key];
        $modstring='';
        $link_liner='';
        $title_cell_class='class_nodesforum_bgcolor1';
        if($_nodesforum_display_deletion_time[$key]!=0)
        {
            $link_liner='style="text-decoration:line-through;"';
            $title_cell_class='class_nodesforum_bgcolor2';
        }
        if($_nodesforum_display_audited[$key]!=1)
        {
            //$link_liner='style="text-decoration:line-through;"';
            $title_cell_class='class_nodesforum_bgcolor2';
        }
        $show_title=_nodesforum_display_title($_nodesforum_display_title[$key],$_nodesforum_max_word_length_in_titles);
        $this_link='<a href="?_nodesforum_node='.$value.'" name="_nodesforum_anchor_'.$value.'" '.$link_liner.'>'.$show_title.'</a>';
        if($_nodesforum_display_folder_or_post[$key]==1)
        {
            $last_post_string='no posts yet';
            $this_icon='<img src="'.$_nodesforum_folder_icon.'" style="vertical-align:text-bottom;border:none;" />';
            $subfoldersS='s';
            if($_nodesforum_display_subfolders[$key]==1)
            {$subfoldersS='';}
            $postsS='s';
            if($_nodesforum_display_posts[$key]==1)
            {$postsS='';}
            if($_nodesforum_display_subfolders[$key]==0 && $_nodesforum_display_posts[$key]==0)
            {$contains_string='<i>empty</i>';}
            else
            {
                $contains_string='';
                if($_nodesforum_display_subfolders[$key]!=0)
                {
                    $contains_string=$_nodesforum_display_subfolders[$key].' subfolder'.$subfoldersS;
                }
                if($_nodesforum_display_posts[$key]!=0)
                {
                    if($_nodesforum_display_subfolders[$key]!=0)
                        {$contains_string=$contains_string.', ';}
                        $contains_string=$contains_string.$_nodesforum_display_posts[$key].' post'.$postsS;
                }
                //$contains_string=$_nodesforum_display_subfolders[$key].' subfolder'.$subfoldersS.', '.$_nodesforum_display_posts[$key].' post'.$postsS;
            }

            //if were in audit view, show the parent folder
            if($_nodesforum_folder_or_post==7){
                $container_fapID=substr($_nodesforum_display_containing_folder_or_post[$key],1);
                $show_title=_nodesforum_display_title($_nodesforum_remember_titles[$container_fapID],$_nodesforum_max_word_length_in_titles);
                $parent_link_liner='';
                if($_nodesforum_display_deletion_time[$container_fapID]!=0)
                {$parent_link_liner='style="text-decoration:line-through;"';}
                $this_link.=' (in: <a href="?_nodesforum_node='.$container_fapID.'" '.$parent_link_liner.'>'.$show_title.'</a>)';
            }

            if(($_nodesforum_ismod==1 || $_nodesforum_display_creator_uniqueID[$key]==$_SESSION[$_nodesforum_external_user_system_uniqueID_session_name]) && ($_nodesforum_display_skeleton[$key]==0 || $_nodesforum_power_on_skeleton==1 || $_nodesforum_display_creator_uniqueID==$_SESSION[$_nodesforum_external_user_system_uniqueID_session_name]) && $_nodesforum_isbanned==0 && substr($_GET['_nodesforum_node'],0,1)!='h')
            {
                $sticky_buttons='';
                if($_nodesforum_ismod==1)
                {
                    if($_nodesforum_display_sticky[$key]==0)
                    {$sticky_buttons='<acronym title="make sticky" style="border:none;"><a href="?_nodesforum_node='.$_GET['_nodesforum_node'].'&_nodesforum_page='.$_GET['_nodesforum_page'].'&_nodesforum_make_sticky='.$value.'"><img src="'.$_nodesforum_clip_icon.'" style="vertical-align:text-bottom;border:none;" /></a></acronym>';}
                    else
                    {
                        $sticky_up_button='';
                        $we_have_smaller_sticky=0;
                        foreach($_nodesforum_display_sticky as $key2 => $value2)
                        {
                            if($value2<$_nodesforum_display_sticky[$key] && $value2!=0)
                            {
                                $we_have_smaller_sticky=1;
                                $fapID_to_switch_with=$_nodesforum_display_fapID[$key2];
                            }
                        }
                        if($we_have_smaller_sticky==1)
                        {$sticky_up_button='<acronym title="move sticky up" style="border:none;"><a href="?_nodesforum_node='.$_GET['_nodesforum_node'].'&_nodesforum_page='.$_GET['_nodesforum_page'].'&_nodesforum_sticky_move='.$value.'&_nodesforum_sticky_switcher='.$fapID_to_switch_with.'#_nodesforum_anchor_'.$value.'"><img src="'.$_nodesforum_up_icon.'" style="vertical-align:text-bottom;border:none;" /></a></acronym>';}
                        $sticky_down_button='';
                        $we_have_bigger_sticky=0;
                        foreach($_nodesforum_display_sticky as $key2 => $value2)
                        {
                            if($value2>$_nodesforum_display_sticky[$key])
                            {
                                $we_have_bigger_sticky=1;
                                $fapID_to_switch_with=$_nodesforum_display_fapID[$key2];
                                break;
                            }
                        }
                        if($we_have_bigger_sticky==1)
                        {$sticky_down_button='<acronym title=move sticky down" style="border:none;"><a href="?_nodesforum_node='.$_GET['_nodesforum_node'].'&_nodesforum_page='.$_GET['_nodesforum_page'].'&_nodesforum_sticky_move='.$value.'&_nodesforum_sticky_switcher='.$fapID_to_switch_with.'#_nodesforum_anchor_'.$value.'"><img src="'.$_nodesforum_down_icon.'" style="vertical-align:text-bottom;border:none;" /></a></acronym>';}
                        $make_unsticky_button='<acronym title="make unsticky" style="border:none;"><a href="?_nodesforum_node='.$_GET['_nodesforum_node'].'&_nodesforum_page='.$_GET['_nodesforum_page'].'&_nodesforum_make_unsticky='.$value.'"><img src="'.$_nodesforum_declip_icon.'" style="vertical-align:text-bottom;border:none;" /></a></acronym>';
                        $sticky_buttons=$sticky_up_button.$sticky_down_button.$make_unsticky_button;
                    }
                }

                $edit_button='<acronym title="edit folder" style="border:none;"><a href="?_nodesforum_node='.$_GET['_nodesforum_node'].'&_nodesforum_page='.$_GET['_nodesforum_page'].'&_nodesforum_edit_folder='.$value.'"><img src="'.$_nodesforum_tool_icon.'" style="vertical-align:text-bottom;border:none;" /></a></acronym>';
                $move_button='<acronym title="move folder" style="border:none;"><a href="?_nodesforum_node='.$_GET['_nodesforum_node'].'&_nodesforum_page='.$_GET['_nodesforum_page'].'&_nodesforum_move='.$value.'"><img src="'.$_nodesforum_move_icon.'" style="vertical-align:text-bottom;border:none;" /></a></acronym>';
                $delete_button='';
                if($_nodesforum_display_deletion_time[$key]==0)
                {$delete_button='<acronym title="delete folder" style="border:none;"><a onclick="delete_node('.$value.',1,'."'".urlencode($_nodesforum_display_creator_publicname[$this_creator_uniqueID])."'".','.$_nodesforum_display_subfolders[$key].','.$_nodesforum_display_posts[$key].','."'".$_GET['_nodesforum_node']."'".','.$_GET['_nodesforum_page'].')" style="cursor:pointer;"><img src="'.$_nodesforum_delete_icon.'" style="vertical-align:text-bottom;border:none;" /></a></acronym>';}

                $audit_button='';
                $unaudit_button='';
                if($_nodesforum_display_audited[$key]==0){
                    if($_nodesforum_righttoaudit==1)$audit_button='<acronym title="approve folder" style="border:none;"><a href="?_nodesforum_node='.$_GET['_nodesforum_node'].'&_nodesforum_page='.$_GET['_nodesforum_page'].'&_nodesforum_audit='.$value.'"><img src="'.$_nodesforum_audit_icon.'" style="vertical-align:text-bottom;border:none;" /></a></acronym>';
                    $this_link .= ' <span class="class_nodesforum_unnaproved">..[Awaiting Approval]..</span>';
                }else{
                    if($_nodesforum_righttoaudit==1)$unaudit_button='<acronym title="unapprove folder" style="border:none;"><a href="?_nodesforum_node='.$_GET['_nodesforum_node'].'&_nodesforum_page='.$_GET['_nodesforum_page'].'&_nodesforum_unaudit='.$value.'"><img src="'.$_nodesforum_unaudit_icon.'" style="vertical-align:text-bottom;border:none;" /></a></acronym>';
                }
                
                //spam purge button!
				if($_nodesforum_ismod==1 && $_nodesforum_display_creator_uniqueID[$key]!=$_SESSION[$_nodesforum_external_user_system_uniqueID_session_name]){
					$spam_purge_button='<acronym title="purge spammer" style="border:none;"><a onclick="purgeSpammer(\''.$this_creator_uniqueID.'\',\''.base64_encode($_nodesforum_display_enc_ip[$key]).'\')" style="cursor:pointer;"><img src="'.$_nodesforum_power_icon.'" style="vertical-align:text-bottom;border:none;" /></a></acronym>';
				}
                
                $modstring=' '.$sticky_buttons.$edit_button.$move_button.$delete_button.$audit_button.$unaudit_button.$spam_purge_button;
            }
        }
        else if($_nodesforum_display_folder_or_post[$key]==2)
        {
            $last_post_string='no replies yet';
            $this_icon='<img src="'.$_nodesforum_post_icon.'" style="vertical-align:text-bottom;border:none;" />';
            if(substr($_nodesforum_display_containing_folder_or_post[$key],0,1)=='p')
            {
                $this_icon='<img src="'.$_nodesforum_reply_icon.'" style="vertical-align:text-bottom;border:none;" />';
                $container_fapID=substr($_nodesforum_display_containing_folder_or_post[$key],1);
                $show_title=_nodesforum_display_title($_nodesforum_remember_titles[$container_fapID],$_nodesforum_max_word_length_in_titles);
                $parent_link_liner='';
                if($_nodesforum_display_deletion_time[$container_fapID]!=0)
                {$parent_link_liner='style="text-decoration:line-through;"';}
                // if($_nodesforum_display_audited[$container_fapID]!=1)
                // {$parent_link_liner='style="text-decoration:line-through;"';}
                $this_link='<a href="?_nodesforum_permalink='.$value.'#_nodesforum_anchor_'.$value.'" '.$link_liner.'>reply</a> on: <a href="?_nodesforum_node='.$container_fapID.'" name="_nodesforum_anchor_'.$container_fapID.'" '.$parent_link_liner.'>'.$show_title.'</a>';
                $_nodesforum_display_replies[$key]=$_nodesforum_remember_replies[$container_fapID];
                $_nodesforum_display_views[$key]=$_nodesforum_remember_views[$container_fapID];
                $_nodesforum_display_last_post_postID[$key]=$_nodesforum_remember_last_post_postID[$container_fapID];
                $_nodesforum_display_last_post_user_uniqueID[$key]=$_nodesforum_remember_last_post_user_uniqueID[$container_fapID];
                $_nodesforum_display_last_post_time[$key]=$_nodesforum_remember_last_post_time[$container_fapID];
            }else if($_nodesforum_folder_or_post==7 && substr($_nodesforum_display_containing_folder_or_post[$key],0,1)=='f'){
                $container_fapID=substr($_nodesforum_display_containing_folder_or_post[$key],1);
                $show_title=_nodesforum_display_title($_nodesforum_remember_titles[$container_fapID],$_nodesforum_max_word_length_in_titles);
                $parent_link_liner='';
                if($_nodesforum_display_deletion_time[$container_fapID]!=0)
                {$parent_link_liner='style="text-decoration:line-through;"';}
                $this_link.=' (in: <a href="?_nodesforum_node='.$container_fapID.'" '.$parent_link_liner.'>'.$show_title.'</a>)';
            }

            //if is post or reply, and in audit view, show the post contents overview
            if($_nodesforum_folder_or_post==7){
                //show post contents overview
                $this_link.= '<div style="width:100%;padding:0px;"><div style="width:100%;padding:0px;margin:0px;'.$link_liner.'color:'.$_nodesforum_text_color.';max-height:200px;overflow-y:auto;" class="class_nodesforum_bgcolorinherit">'.display_bb($_nodesforum_display_post[$key],$_nodesforum_display_p_inf_str[$this_creator_uniqueID],$user_or_guest,$_nodesforum_display_disable_auto_smileys[$key],$_nodesforum_display_disable_auto_links[$key],0).'</div></div>';

            }

            $replyend='ies';
            if($_nodesforum_display_replies[$key]==1)
            {$replyend='y';}
            $replynum=$_nodesforum_display_replies[$key];
            if($_nodesforum_display_replies[$key]==0)
            {$replynum='no';}
            $viewsS='s';
            if($_nodesforum_display_views[$key]==1)
            {$viewsS='';}
            $viewsnum=$_nodesforum_display_views[$key];
            if($_nodesforum_display_views[$key]==0)
            {$viewsnum='no';}
            $contains_string=$replynum.' repl'.$replyend.', '.$viewsnum.' view'.$viewsS;
            if(($_nodesforum_ismod==1 || $_nodesforum_display_creator_uniqueID[$key]==$_SESSION[$_nodesforum_external_user_system_uniqueID_session_name]) && $_nodesforum_isbanned==0 && substr($_GET['_nodesforum_node'],0,1)!='h')
            {
                $sticky_buttons='';
                if($_nodesforum_ismod==1)
                {
                    if($_nodesforum_display_sticky[$key]==0)
                    {$sticky_buttons='<acronym title="make sticky" style="border:none;"><a href="?_nodesforum_node='.$_GET['_nodesforum_node'].'&_nodesforum_page='.$_GET['_nodesforum_page'].'&_nodesforum_make_sticky='.$value.'"><img src="'.$_nodesforum_clip_icon.'" style="vertical-align:text-bottom;border:none;" /></a></acronym>';}
                    else
                    {
                        $sticky_up_button='';
                        $we_have_smaller_sticky=0;
                        foreach($_nodesforum_display_sticky as $key2 => $value2)
                        {
                            if($value2<$_nodesforum_display_sticky[$key] && $value2!=0)
                            {
                                $we_have_smaller_sticky=1;
                                $fapID_to_switch_with=$_nodesforum_display_fapID[$key2];
                            }
                        }
                        if($we_have_smaller_sticky==1)
                        {$sticky_up_button='<acronym title="move sticky up" style="border:none;"><a href="?_nodesforum_node='.$_GET['_nodesforum_node'].'&_nodesforum_page='.$_GET['_nodesforum_page'].'&_nodesforum_sticky_move='.$value.'&_nodesforum_sticky_switcher='.$fapID_to_switch_with.'"><img src="'.$_nodesforum_up_icon.'" style="vertical-align:text-bottom;border:none;" /></a></acronym>';}
                        $sticky_down_button='';
                        $we_have_bigger_sticky=0;
                        foreach($_nodesforum_display_sticky as $key2 => $value2)
                        {
                            if($value2>$_nodesforum_display_sticky[$key])
                            {
                                $we_have_bigger_sticky=1;
                                $fapID_to_switch_with=$_nodesforum_display_fapID[$key2];
                                break;
                            }
                        }
                        if($we_have_bigger_sticky==1)
                        {$sticky_down_button='<acronym title=move sticky down" style="border:none;"><a href="?_nodesforum_node='.$_GET['_nodesforum_node'].'&_nodesforum_page='.$_GET['_nodesforum_page'].'&_nodesforum_sticky_move='.$value.'&_nodesforum_sticky_switcher='.$fapID_to_switch_with.'"><img src="'.$_nodesforum_down_icon.'" style="vertical-align:text-bottom;border:none;" /></a></acronym>';}
                        $make_unsticky_button='<acronym title="make unsticky" style="border:none;"><a href="?_nodesforum_node='.$_GET['_nodesforum_node'].'&_nodesforum_page='.$_GET['_nodesforum_page'].'&_nodesforum_make_unsticky='.$value.'"><img src="'.$_nodesforum_declip_icon.'" style="vertical-align:text-bottom;border:none;" /></a></acronym>';
                        $sticky_buttons=$sticky_up_button.$sticky_down_button.$make_unsticky_button;
                    }
                }

                $edit_button='<acronym title="edit post" style="border:none;"><a href="?_nodesforum_node='.$_GET['_nodesforum_node'].'&_nodesforum_page='.$_GET['_nodesforum_page'].'&_nodesforum_edit_post='.$value.'"><img src="'.$_nodesforum_tool_icon.'" style="vertical-align:text-bottom;border:none;" /></a></acronym>';
                $move_button='<acronym title="move post" style="border:none;"><a href="?_nodesforum_node='.$_GET['_nodesforum_node'].'&_nodesforum_page='.$_GET['_nodesforum_page'].'&_nodesforum_move='.$value.'"><img src="'.$_nodesforum_move_icon.'" style="vertical-align:text-bottom;border:none;" /></a></acronym>';
                $delete_button='';
                if($_nodesforum_display_deletion_time[$key]==0)
                {$delete_button='<acronym title="delete post" style="border:none;"><a onclick="delete_node('.$value.',2,'."'".urlencode($_nodesforum_display_creator_publicname[$this_creator_uniqueID])."'".','.$_nodesforum_display_replies[$key].','.$_nodesforum_display_views[$key].','."'".$_GET['_nodesforum_node']."'".','.$_GET['_nodesforum_page'].')" style="cursor:pointer;"><img src="'.$_nodesforum_delete_icon.'" style="vertical-align:text-bottom;border:none;" /></a></acronym>';}
                
                $audit_button='';
                $unaudit_button='';
                if($_nodesforum_display_audited[$key]==0){
                    if($_nodesforum_righttoaudit==1)$audit_button='<acronym title="approve post" style="border:none;"><a href="?_nodesforum_node='.$_GET['_nodesforum_node'].'&_nodesforum_page='.$_GET['_nodesforum_page'].'&_nodesforum_audit='.$value.'"><img src="'.$_nodesforum_audit_icon.'" style="vertical-align:text-bottom;border:none;" /></a></acronym>';
                    $this_link .= ' <span class="class_nodesforum_unnaproved">..[Awaiting Approval]..</span>';
                }else{
                    if($_nodesforum_righttoaudit==1)$unaudit_button='<acronym title="unapprove post" style="border:none;"><a href="?_nodesforum_node='.$_GET['_nodesforum_node'].'&_nodesforum_page='.$_GET['_nodesforum_page'].'&_nodesforum_unaudit='.$value.'"><img src="'.$_nodesforum_unaudit_icon.'" style="vertical-align:text-bottom;border:none;" /></a></acronym>';
                }

                //spam purge button!
				if($_nodesforum_ismod==1 && $_nodesforum_display_creator_uniqueID[$key]!=$_SESSION[$_nodesforum_external_user_system_uniqueID_session_name]){
					$spam_purge_button='<acronym title="purge spammer" style="border:none;"><a onclick="purgeSpammer(\''.$this_creator_uniqueID.'\',\''.base64_encode($_nodesforum_display_enc_ip[$key]).'\')" style="cursor:pointer;"><img src="'.$_nodesforum_power_icon.'" style="vertical-align:text-bottom;border:none;" /></a></acronym>';
				}
                
                $modstring=' '.$sticky_buttons.$edit_button.$move_button.$delete_button.$audit_button.$unaudit_button.$spam_purge_button;
            }
        }
        if($_nodesforum_display_last_post_postID[$key]!=0)
        {
            $this_last_poster_uniqueID=$_nodesforum_display_last_post_user_uniqueID[$key];
            $last_post_string='<a href="?_nodesforum_permalink='.$_nodesforum_display_last_post_postID[$key].'#_nodesforum_anchor_'.$_nodesforum_display_last_post_postID[$key].'">last post by '.htmlspecialchars($_nodesforum_display_creator_publicname[$this_last_poster_uniqueID]).'<script type="text/javascript">
			var writness = " on " + _nodesforum_maketimus('.$_nodesforum_display_last_post_time[$key].');
			document.write(writness);
			</script></a>';
        }


        if($this_creator_uniqueID==$_nodesforum_uniqueID_of_deleted_user)
        {$creatorz_link='<i>deleted user</i>';}
        else
        {$creatorz_link='<a href="?_nodesforum_node=u'.$this_creator_uniqueID.'">'.htmlspecialchars($_nodesforum_display_creator_publicname[$this_creator_uniqueID]).'</a>';}


        $sticky_icon='';
        if($_nodesforum_display_sticky[$key]!=0)
        {$sticky_icon='<img src="'.$_nodesforum_clip_icon.'" style="vertical-align:text-bottom;border:none;" />';}

        $skeleton_icon='';
        if($_nodesforum_display_skeleton[$key]==1)
        {$skeleton_icon='<img src="'.$_nodesforum_skeleton_icon.'" style="vertical-align:text-bottom;border:none;" />';}

        $mycellpadding=10;
        echo '<tr>

			<td style="text-align:left;vertical-align:top;width:33%" class="'.$title_cell_class.'"><div class="class_nodesforum_inner" style="padding:'.$mycellpadding.'px;">'.$sticky_icon.$skeleton_icon.$this_icon.' '.$this_link.$modstring.'</div></td>

			<td style="text-align:left;vertical-align:top;" class="class_nodesforum_bgcolor2"><div class="class_nodesforum_inner" style="padding:'.$mycellpadding.'px;">created by '.$creatorz_link.'<script type="text/javascript">
			var writness = " on " + _nodesforum_maketimus('.$_nodesforum_display_creation_time[$key].');
			document.write(writness);
			</script></div></td>

			<td style="text-align:left;vertical-align:top;" class="class_nodesforum_bgcolor2"><div class="class_nodesforum_inner" style="padding:'.$mycellpadding.'px;">'.$contains_string.'</div></td>

			<td style="text-align:left;vertical-align:top;" class="class_nodesforum_bgcolor2"><div class="class_nodesforum_inner" style="padding:'.$mycellpadding.'px;">'.$last_post_string.'</div></td>

			</tr>';
    }
}
else
{echo '<tr><td style="text-align:center;vertical-align:top;" class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner">empty</div></td></tr>';}
echo '</table></div>'.$pagination;

