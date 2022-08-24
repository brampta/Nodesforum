<?php


echo '<script type="text/javascript">
var _nodesforum_remember_fapID=new Array();
</script>';


//show the post and the replies, ordered by creation_time:


$pagination='';
if($_nodesforum_totalpages>1)
{
    $previouspage='';
    if($_GET['_nodesforum_page']>1)
    {$previouspage='<a href="?_nodesforum_node='.$_GET['_nodesforum_node'].'&_nodesforum_page='.($_GET['_nodesforum_page']-1).'">previous</a> | ';}
    $nextpage='';
    if($_GET['_nodesforum_page']<$_nodesforum_totalpages)
    {$nextpage=' | <a href="?_nodesforum_node='.$_GET['_nodesforum_node'].'&_nodesforum_page='.($_GET['_nodesforum_page']+1).'">next</a>';}
    $pagination='<div style="height:4px;"><!-- --></div><div style="width:100%;"><table class="class_nodesforum_bgcolor3" style="width:100%;"><tr><td class="class_nodesforum_bgcolor2"><div class="class_nodesforum_inner">'.$previouspage.'page '.$_GET['_nodesforum_page'].' of '.$_nodesforum_totalpages.$nextpage.'</div></td></tr></table></div>';
}


echo $pagination;
if($_nodesforum_display_fapID)
{
    $countemz=0;
    $doonce=0;
    foreach($_nodesforum_display_fapID as $key => $value)
    {
        $countemz++;
        $this_creator_uniqueID=$_nodesforum_display_creator_uniqueID[$key];
        echo '<a name="_nodesforum_anchor_'.$value.'"></a><div style="height:4px;"><!-- --></div><div style="width:100%;"><table style="width:100%;table-layout:fixed;" class="class_nodesforum_bgcolor3"><tr>
				<td style="width:180px;text-align:center;vertical-align:top;" class="class_nodesforum_bgcolor2" rowspan="3"><div class="class_nodesforum_inner"><center>';



        if($_nodesforum_display_avatar[$this_creator_uniqueID] && $_nodesforum_display_avatar[$this_creator_uniqueID]!='')
        {echo '<table class="class_nodesforum_bgcolor3"><tr><td><img src="'.$_nodesforum_mysterypath.'/avatars/'.$_nodesforum_display_avatar[$this_creator_uniqueID].'" style="width:140px;height:140px;" id="post_avatar_'.$key.'" onload="resize_pic(140, 140, '."'post_avatar_".$key."'".')" /></td></tr></table>';}


        echo '<div style="padding:10px;">';
        if($this_creator_uniqueID!='0' && $this_creator_uniqueID!=$_nodesforum_uniqueID_of_deleted_user)
        {echo '<a href="?_nodesforum_node=u'.$this_creator_uniqueID.'" style="font-weight:bold;">';}
        else
        {echo '<i>';}
        echo _nodesforum_display_title($_nodesforum_display_creator_publicname[$this_creator_uniqueID],$_nodesforum_max_word_length_in_titles);
        if($this_creator_uniqueID!='0' && $this_creator_uniqueID!=$_nodesforum_uniqueID_of_deleted_user)
        {echo'</a>';}
        else
        {echo '</i>';}
        echo '</div>';






        if($_nodesforum_display_has_folderstuff[$this_creator_uniqueID])
        {
            echo '<div style="width:100%;"><table style="font-size:80%;width:100%;" class="class_nodesforum_bgcolor3">';


            if($_nodesforum_external_user_system_show_registration_time=='yes' && $this_creator_registration_time[$this_creator_uniqueID])
            {
                echo '<tr><td class="class_nodesforum_bgcolor2"><div class="class_nodesforum_inner">member since:</div></td><td class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner"><script type="text/javascript">
					var writness = _nodesforum_maketimus('.$this_creator_registration_time[$this_creator_uniqueID].');
					document.write(writness);
					</script></div></td></tr>';
            }


            echo '<tr><td class="class_nodesforum_bgcolor2"><div class="class_nodesforum_inner"><img src="'.$_nodesforum_folder_icon.'" style="vertical-align:text-bottom;border:none;" /> folders:</div></td><td class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner">'.$_nodesforum_display_total_folders[$this_creator_uniqueID].'</div></td></tr>
				<tr><td class="class_nodesforum_bgcolor2"><div class="class_nodesforum_inner"><img src="'.$_nodesforum_post_icon.'" style="vertical-align:text-bottom;border:none;" /> posts:</div></td><td class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner">'.$_nodesforum_display_total_posts[$this_creator_uniqueID].'</div></td></tr>
				<tr><td class="class_nodesforum_bgcolor2"><div class="class_nodesforum_inner"><img src="'.$_nodesforum_reply_icon.'" style="vertical-align:text-bottom;border:none;" /> replies:</div></td><td class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner">'.$_nodesforum_display_total_replies[$this_creator_uniqueID].'</div></td></tr>
				<tr><td class="class_nodesforum_bgcolor1" colspan="2"><div class="class_nodesforum_inner"><img src="'.$_nodesforum_history_icon.'" style="vertical-align:text-bottom;border:none;" /> <a href="?_nodesforum_node=h0&_nodesforum_history_user='.$this_creator_uniqueID.'">posting history</a></div></td></tr>
				</table></div>
				';
        }
        else
        {echo '<div style="width:100%;"><table style="font-size:80%;width:100%;display:none;" class="class_nodesforum_bgcolor3"><tr><td class="class_nodesforum_bgcolor2"><div class="class_nodesforum_inner">test</div></td></tr></table></div>';}



        echo '</div></center></td>
			<td style="text-align:left;vertical-align:top;height:1%;font-size:80%;" class="class_nodesforum_bgcolor2"><div class="class_nodesforum_inner" id="_nodesforum_time_div_'.$value.'">';



        echo '<script type="text/javascript">
			var writness = _nodesforum_maketimus('.$_nodesforum_display_creation_time[$key].');
			document.write(writness);
			</script>';


        echo '</div>';

//        echo '<script type="text/javascript">
//var _nodesforum_div_width = document.getElementById("_nodesforum_time_div_'.$value.'").offsetWidth;
//if(_nodesforum_div_width < 400)
//{_nodesforum_div_width=400;}
//</script>';

        echo '</td></tr>';


        $link_liner='';
        $text_cell_class='class_nodesforum_bgcolor1';
        if($_nodesforum_display_deletion_time[$key]!=0)
        {
            $link_liner='text-decoration:line-through;';
            $text_cell_class='class_nodesforum_bgcolor2';
        }

        $user_or_guest=1;
        if($this_creator_uniqueID=='0' || $this_creator_uniqueID==$_nodesforum_uniqueID_of_deleted_user)
        {$user_or_guest=0;}


        $maxheight=6000;




        echo '<tr><td class="'.$text_cell_class.'" style="overflow:hidden;"><div class="class_nodesforum_inner" style="width:100%;overflow:hidden;padding:0px;">';
        echo '<table style="width:100%;table-layout:fixed;color:'.$_nodesforum_text_color.';"><tr><td>
            <div style="width:100%;overflow:auto;overflow-y:visible;">
            <div style="max-height:'.$maxheight.'px;overflow-y:auto;height:expression( this.scrollHeight > '.$maxheight.'? '."'".''.$maxheight.'px'."'".' : '."'".'auto'."'".' );">
            <div style="padding:16px;padding-bottom:30px;">';
        if($countemz==1 && $_GET['_nodesforum_page']==1)
        {echo '<h2 style="color:'.$_nodesforum_text_color.';margin:0px;padding-bottom:16px;">'._nodesforum_display_title($_nodesforum_display_title[$key],$_nodesforum_max_word_length_in_titles,false).'</h2>';}
        echo '<div style="width:100%;padding:0px;"><div style="width:100%;padding:0px;margin:0px;'.$link_liner.'color:'.$_nodesforum_text_color.';" class="class_nodesforum_bgcolorinherit">'.display_bb($_nodesforum_display_post[$key],$_nodesforum_display_p_inf_str[$this_creator_uniqueID],$user_or_guest,$_nodesforum_display_disable_auto_smileys[$key],$_nodesforum_display_disable_auto_links[$key],0).'</div></div>';
        if($_nodesforum_display_signature[$this_creator_uniqueID] && $_nodesforum_display_signature[$this_creator_uniqueID]!='' && $_nodesforum_display_signature[$this_creator_uniqueID]!='0')
        {echo '<hr style="width:50%;" /><div style="padding:0px;"><div style="width:100%;font-size:80%;padding:0px;margin:0px;color:'.$_nodesforum_text_color.';" class="class_nodesforum_bgcolorinherit">'.display_bb($_nodesforum_display_signature[$this_creator_uniqueID],$_nodesforum_display_p_inf_str[$this_creator_uniqueID],1,$_nodesforum_display_signature_disable_auto_smileys[$this_creator_uniqueID],$_nodesforum_display_signature_disable_auto_links[$this_creator_uniqueID],0).'</div></div>';}
        echo '</div>
            </div>
            </div>
            </td></tr></table>';
        echo '</div></td></tr>';


        echo '<tr><td class="class_nodesforum_bgcolor2" style="height:28px;" id="_nodesforum_bottom_cell_'.$value.'"><div class="class_nodesforum_inner" style="height:100%;vertical-align:bottom;position:relative;">';



        $oldestacceptabletimeforguesteditbyip=$_nodesforum_display_creation_time[$key]+($_nodesforum_allow_guests_to_edit_their_posts_for_x_hours*3600);
        echo '<div style="width:100%;"><table style="width:100%;color:'.$_nodesforum_text_color.';" class="class_nodesforum_bgcolorinherit"><tr><td style="text-align:left;vertical-align:bottom;">';
        //mod buttons
        if($_nodesforum_display_creator_uniqueID[$key]=='0' && $_nodesforum_display_creator_ip[$key]==$_nodesforum_enc_ip && $nowtime<$oldestacceptabletimeforguesteditbyip)
        {
            $counter_id='js_timer_'.$value;
            echo '<span id="'.$counter_id.'_remove">';
        }
        if((($countemz==1 && $_GET['_nodesforum_page']==1 && $_nodesforum_ismod==1) || $_nodesforum_display_creator_uniqueID[$key]==$_SESSION[$_nodesforum_external_user_system_uniqueID_session_name] || ($_nodesforum_display_creator_uniqueID[$key]=='0' && $_nodesforum_display_creator_ip[$key]==$_nodesforum_enc_ip && $nowtime<$oldestacceptabletimeforguesteditbyip)) && $_nodesforum_isbanned==0)
        {echo '<acronym title="edit post" style="border:none;"><a href="?_nodesforum_node='.$_GET['_nodesforum_node'].'&_nodesforum_page='.$_GET['_nodesforum_page'].'&_nodesforum_edit_post='.$value.'"><img src="'.$_nodesforum_tool_icon.'" style="vertical-align:text-bottom;border:none;" /></a></acronym>';}
        if((($countemz!=1 || $_GET['_nodesforum_page']!=1) && ($_nodesforum_ismod==1 || $_nodesforum_display_creator_uniqueID[$key]==$_SESSION[$_nodesforum_external_user_system_uniqueID_session_name] || ($_nodesforum_display_creator_uniqueID[$key]=='0' && $_nodesforum_display_creator_ip[$key]==$_nodesforum_enc_ip && $nowtime<$oldestacceptabletimeforguesteditbyip)) && $_nodesforum_display_deletion_time[$key]==0) && $_nodesforum_isbanned==0)
        {
            echo '<acronym title="delete post" style="border:none;"><a onclick="delete_node('.$value.',3,'."'".urlencode($_nodesforum_display_creator_publicname[$this_creator_uniqueID])."'".',0,0,'."'".$_GET['_nodesforum_node']."'".','.$_GET['_nodesforum_page'].')" style="cursor:pointer;"><img src="'.$_nodesforum_delete_icon.'" style="vertical-align:text-bottom;border:none;" /></a></acronym>';
            if($_nodesforum_display_creator_uniqueID[$key]=='0' && $_nodesforum_display_creator_ip[$key]==$_nodesforum_enc_ip && $nowtime<$oldestacceptabletimeforguesteditbyip)
            {
                $post_age=$nowtime-$_nodesforum_display_creation_time[$key];
                $time_left=($_nodesforum_allow_guests_to_edit_their_posts_for_x_hours*3600)-$post_age;
                echo ' <span id="'.$counter_id.'">time left: '.$time_left.' seconds</span><script type="text/javascript">show_countdown('.$time_left.',"'.$counter_id.'")</script>';
            }
        }
        if($_nodesforum_ismod==1 && $_nodesforum_display_enc_ip[$key]!='')
        {echo ' <span style="font-size:80%;">IP (encrypted): <input type="text" value="'.base64_encode($_nodesforum_display_enc_ip[$key]).'" readonly="readonly" onmouseup="highlight(this)" /></span>';}
        
        if($_nodesforum_display_creator_uniqueID[$key]=='0' && $_nodesforum_display_creator_ip[$key]==$_nodesforum_enc_ip && $nowtime<$oldestacceptabletimeforguesteditbyip)
        {echo '</span>';}
        
        //spam purge button!
        if($_nodesforum_ismod==1 && $_nodesforum_display_creator_uniqueID[$key]!=$_SESSION[$_nodesforum_external_user_system_uniqueID_session_name]){
			echo '<acronym title="purge spammer" style="border:none;"><a onclick="purgeSpammer(\''.$this_creator_uniqueID.'\',\''.base64_encode($_nodesforum_display_enc_ip[$key]).'\')" style="cursor:pointer;"><img src="'.$_nodesforum_power_icon.'" style="vertical-align:text-bottom;border:none;" /></a></acronym>';
		}
		
        echo '</td><td style="text-align:right;vertical-align:bottom;">';
        echo 'post #'.$value.' ';
        //quote button
        if(isset($_SESSION[$_nodesforum_external_user_system_uniqueID_session_name]) || ($_nodesforum_allow_guest_replies=='yes' && $_nodesforum_allow_guest_reply==1))
        {echo '<form action="?_nodesforum_node='.$_GET['_nodesforum_node'].'&_nodesforum_add_post" method="post" style="display:inline;"><input type="hidden" name="_nodesforum_quote_post" value="'.urlencode($_nodesforum_display_post[$key]).'" /><input type="hidden" name="_nodesforum_quote_postID" value="'.$value.'" /><input type="hidden" name="_nodesforum_quote_userID" value="'.urlencode($this_creator_uniqueID).'" /><input type="hidden" name="_nodesforum_quote_publicname" value="'.urlencode($_nodesforum_display_creator_publicname[$this_creator_uniqueID]).'" /><input type="hidden" name="_nodesforum_quote_time" value="'.$nowtime.'" /><acronym title="quote this post" style="border:none;"><input type="image" src="'.$_icons_path.'/minipics/bbcode/quote2.gif" alt="quote" style="vertical-align:text-bottom;background:none;" /></acronym></form> ';}
        echo '<a href="?_nodesforum_permalink='.$value.'#_nodesforum_anchor_'.$value.'">permalink</a>';
        echo '</td></tr></table></div>';



        echo '</div></td>
				</tr></table></div>';
        if($countemz==1 && $_GET['_nodesforum_page']==1 && $_nodesforum_isbanned==0)
        {
            if(isset($_SESSION[$_nodesforum_external_user_system_uniqueID_session_name]) || ($_nodesforum_allow_guest_replies=='yes' && $_nodesforum_allow_guest_reply==1))
            {echo '<div style="width:100%;padding-top:4px;" class="class_nodesforum_bgcolor4"><center><div style="width:10%;"><table style="width:100%" class="class_nodesforum_bgcolor3"><tr><td style="text-align:center;" class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner"><a href="?_nodesforum_node='.$_GET['_nodesforum_node'].'&_nodesforum_add_post">reply</a></div></td></tr></table></div></center></div>';}
            else
            {echo '<div style="width:100%;padding-top:4px;" class="class_nodesforum_bgcolor4"><center><div style="width:10%;"><table style="width:100%" class="class_nodesforum_bgcolor3"><tr><td style="text-align:center;" class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner">please <a href="'.$_nodesforum_external_user_system_login_link.'">login</a> to reply</div></td></tr></table></div></center></div>';}
        }
        //else
        //{echo '<div style="height:4px;"><!-- --></div>';}


        //ad after first post
        if($countemz==1 && $_GET['_nodesforum_page']==1 && $_nodesforum_code_of_ad_after_first_post!='')
        {
            echo '<div style="height:4px;"><!-- --></div>'.$_nodesforum_code_of_ad_after_first_post;
        }

    }
}
else
{echo '<div style="width:100%;"><table style="width:100%;" class="class_nodesforum_bgcolor3"><tr><td style="text-align:center;vertical-align:top;" class="class_nodesforum_bgcolor1">'; if($_GET['_nodesforum_page']==1){echo 'this post has been deleted'; if($_nodesforum_ismod==1){echo ' click <a href="?_nodesforum_node='.$_GET['_nodesforum_node'].'&ghost=1">here</a> to see its contents in ghost mode';}}else{echo 'this page is empty';} echo '</td></tr></table></div>';}
if(($countemz>=2 || $_GET['_nodesforum_page']!=1) && $_nodesforum_display_fapID && $_nodesforum_isbanned==0)
{
    if(isset($_SESSION[$_nodesforum_external_user_system_uniqueID_session_name]) || ($_nodesforum_allow_guest_replies=='yes' && $_nodesforum_allow_guest_reply==1))
    {echo '<div style="width:100%;padding-top:4px;" class="class_nodesforum_bgcolor4"><center><div style="width:10%;"><table style="width:100%" class="class_nodesforum_bgcolor3"><tr><td style="text-align:center;" class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner"><a href="?_nodesforum_node='.$_GET['_nodesforum_node'].'&_nodesforum_add_post">reply</a></div></td></tr></table></div></center></div>';}
    else
    {echo '<div style="width:100%;padding-top:4px;" class="class_nodesforum_bgcolor4"><center><div style="width:10%;"><table style="width:100%" class="class_nodesforum_bgcolor3"><tr><td style="text-align:center;" class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner">please <a href="'.$_nodesforum_external_user_system_login_link.'">login</a> to reply</div></td></tr></table></div></center></div>';}
}
echo $pagination;





?>
