<?php
a_function_that_is_only_in_the_pre_output();



echo '<script type="text/javascript" src="'.$_nodesforum_code_path.'_nodesforum_js.js"></script>';



echo '<style type="text/css">

.class_nodesforum_bgcolor1 {color:'.$_nodesforum_text_color.';background-color:'.$_nodesforum_background_color1.';background-image:url("'.$_icons_path.'/gradios2.png");background-position:bottom;background-repeat:repeat-x;vertical-align:top;}
.class_nodesforum_bgcolor2 {color:'.$_nodesforum_text_color.';background-color:'.$_nodesforum_background_color2.';background-image:url("'.$_icons_path.'/gradios2.png");background-position:bottom;background-repeat:repeat-x;vertical-align:top;}
.class_nodesforum_inner {padding-left:4px;padding-right:4px;background-image:url("'.$_icons_path.'/gradios.png");background-repeat:repeat-x;}
.class_nodesforum_bgcolor3 {color:'.$_nodesforum_text_color.';background-color:'.$_nodesforum_frames_color.';}
.class_nodesforum_bgcolor4 {color:'.$_nodesforum_text_color.';background-color:'.$_nodesforum_bottom_color.';}
.class_nodesforum_bgcolorinherit {color:inherit;}


.class_nodesforum_bgcolor1 a, .class_nodesforum_bgcolor2 a, .class_nodesforum_bgcolor3 a, .class_nodesforum_bgcolor4 a, .class_nodesforum_bgcolorinherit a {color:'.$_nodesforum_link_color.';}
.class_nodesforum_bgcolor1 a:hover, .class_nodesforum_bgcolor2 a:hover, .class_nodesforum_bgcolor3 a:hover, .class_nodesforum_bgcolor4 a:hover, .class_nodesforum_bgcolorinherit a:hover, .class_nodesforum_bgcolor1 a:hover:visited, .class_nodesforum_bgcolor2 a:hover:visited, .class_nodesforum_bgcolor3 a:hover:visited, .class_nodesforum_bgcolor4 a:hover:visited, .class_nodesforum_bgcolorinherit a:hover:visited {color:'.$_nodesforum_link_hover_color.';}
.class_nodesforum_bgcolor1 a:visited, .class_nodesforum_bgcolor2 a:visited, .class_nodesforum_bgcolor3 a:visited, .class_nodesforum_bgcolor4 a:visited, .class_nodesforum_bgcolorinherit a:visited {color:'.$_nodesforum_link_visited_color.';}

.class_nodesforum_inner acronym a {
    display: inline-block;
	padding: 0 4px;
	background-color:'.$_nodesforum_background_color2.';
	color:'.$_nodesforum_link_color.';
	border-radius: 3px;
	margin: 4px 2px 0;
	box-shadow: -1px -2px 0 '.$_nodesforum_frames_color.';
	border: 1px solid '.$_nodesforum_frames_color.';
}

.class_nodesforum_unnaproved {
	font-style: italic;
	opacity: 0.5;
}

/* Responsive tables: stack on mobile */
@media (max-width: 900px) {
	.respo, .respo>tbody {
		display: block !important;
		width: 100% !important;
	}
	.respoborder {
		border: 2px solid '.$_nodesforum_frames_color.';
		width: calc(100% - 6px) !important;
	}
	.respohide {
		display: none !important;
	}
	.respohori50 {
		display: inline-block !important;
		width: 50% !important;
	}

	tr.respo.respoborder {
        display: flex !important;
        flex-wrap: wrap;
    }
    .audit-action-td {
        order: 10; /* send to end */
        width: 100% !important;
        flex: 1 1 50%;
        text-align: center;
    }
    .main-content-td {
        order: 1;
        flex: 1 1 100%;
    }
    /* Optionally, make all tds full width on mobile */
    tr.respo.respoborder > td {
        width: 100% !important;
        box-sizing: border-box;
    }
}


/* Audit stuff */
.audit-approve-cell { width: 90px; }
.audit-delete-cell { width: 90px; }
.audit-approve-cell.checked { background: green !important; }
.audit-delete-cell.checked { background: red !important; }
#auditDeleteLogs, #auditResultPopup, #auditDeleteCount {
    background: ' . $_nodesforum_background_color2 . ';
    color: ' . $_nodesforum_text_color . ';
    border: 1px solid ' . $_nodesforum_frames_color . ';
    padding: 10px 14px;
    margin-bottom: 20px;
    font-size: 0.98em;
    max-width: 700px;
    word-break: break-all;
}
#auditDeleteLogs a { color: ' . $_nodesforum_link_color . '; }
#auditDeleteLogs a:visited { color: ' . $_nodesforum_link_visited_color . '; }
#auditDeleteLogs a:hover { color: ' . $_nodesforum_link_hover_color . '; }
#auditResultPopup {
    position:fixed;
    left:50%; top:50%; transform:translate(-50%,-50%);
    z-index:9999;
    min-width:350px;
    max-width:90vw;
    background:' . $_nodesforum_background_color1 . ';
    border:2px solid ' . $_nodesforum_frames_color . ';
    box-shadow:0 0 20px #000;
    padding:32px 24px 24px 24px;
    text-align:center;
	max-height: 90vh;
    overflow-y: auto;
}
#auditResultPopup h2 { margin-top:0; color:' . $_nodesforum_link_color . '; }
#auditResultPopup .btn {
    display:inline-block;
    margin:18px 12px 0 12px;
    padding:14px 36px;
    font-size:1.2em;
    background:' . $_nodesforum_link_color . ';
    color:' . $_nodesforum_text_color . ';
    border:none;
    border-radius:6px;
    cursor:pointer;
    font-weight:bold;
}
#auditResultPopup .btn.close { background:' . $_nodesforum_frames_color . '; color:' . $_nodesforum_text_color . '; }

/* end of Audit stuff */


</style>



<!--[if lte IE 6]>
<style type="text/css">
.class_nodesforum_bgcolor1, .class_nodesforum_bgcolor2, .class_nodesforum_inner {background-image:none;}
</style>
<![endif]-->




';






echo '<div style="width:100%;"><table style="width:100%;" class="class_nodesforum_bgcolor3"><tr><td class="class_nodesforum_bgcolor4" style="padding:4px;">';





//-------------LOGIN/LOGOUT BAR
$gotshiz=0;
if($_nodesforum_show_login_logout_bar=='yes' || $_nodesforum_use_external_user_system=='no')
{
	echo '<div style="width:100%;"><table class="class_nodesforum_bgcolor3" style="width:100%;"><tr><td class="class_nodesforum_bgcolor2"><div class="class_nodesforum_inner">';
	$gotshiz=1;
	if(isset($_SESSION[$_nodesforum_external_user_system_uniqueID_session_name]))
	{$login_logout_bar_text='logged in as '.$_SESSION[$_nodesforum_external_user_system_loginusername_session_name].' | <img src="'.$_nodesforum_lock_icon.'" style="vertical-align:text-bottom;border:none;" /> <a href="'.$_nodesforum_external_user_system_logout_link.'">logout</a> | <img src="'.$_nodesforum_tool_icon.'" style="vertical-align:text-bottom;border:none;" /> <a href="'.$_nodesforum_external_user_system_profile_options_link.'">profile options</a>';}
	else
	{$login_logout_bar_text='<img src="'.$_nodesforum_lock_icon.'" style="vertical-align:text-bottom;border:none;" /> <a href="'.$_nodesforum_external_user_system_login_link.'">login</a> | <img src="'.$_nodesforum_lock_icon.'" style="vertical-align:text-bottom;border:none;" /> <a href="'.$_nodesforum_external_user_system_register_link.'">register</a>';}
	echo $login_logout_bar_text;
	echo '</div></td></tr></table></div>';
}
//-------------LOGIN/LOGOUT BAR

//--------------FORUM OPTIONS LINK
if(isset($_SESSION[$_nodesforum_external_user_system_uniqueID_session_name]))
{
	if($gotshiz==1)
	{echo '<div style="height:4px;"><!-- --></div>';}

	echo '<div style="width:100%;"><table class="class_nodesforum_bgcolor3" style="width:100%;"><tr><td class="class_nodesforum_bgcolor2"><div class="class_nodesforum_inner">';
	echo '<img src="'.$_nodesforum_tool_icon.'" style="vertical-align:text-bottom;border:none;" /> <a href="?_nodesforum_forum_options">forum options</a> | <img src="'.$_nodesforum_userhome_icon.'" style="vertical-align:text-bottom;border:none;" /> <a href="?_nodesforum_node=u'.$_SESSION[$_nodesforum_external_user_system_uniqueID_session_name].'">my forum page</a> | <img src="'.$_nodesforum_history_icon.'" style="vertical-align:text-bottom;border:none;" /> <a href="?_nodesforum_node=h0&_nodesforum_history_user='.$_SESSION[$_nodesforum_external_user_system_uniqueID_session_name].'">my posting history</a> | <img src="'.$_nodesforum_history_icon.'" style="vertical-align:text-bottom;border:none;" /> <a href="?_nodesforum_node=l0&_nodesforum_log_exclude_self=1&_nodesforum_log_moded='.$_SESSION[$_nodesforum_external_user_system_uniqueID_session_name].'">moderation on my things</a>';
	echo '</div></td></tr></table></div>';
}
//--------------FORUM OPTIONS LINK





//--------------SEARCH
echo '<div style="height:4px;"><!-- --></div><div style="width:100%;"><table class="class_nodesforum_bgcolor3" style="width:100%;"><tr><td class="class_nodesforum_bgcolor2" style="text-align:right;"><div class="class_nodesforum_inner"><form style="padding:0px;margin:0px;" method="get">search for: <input type="text" name="_nodesforum_search" value="'.str_replace('"','&quot;',htmlspecialchars($_GET['_nodesforum_search'])).'" />';
if(isset($_GET['_nodesforum_node']) && $_GET['_nodesforum_node']!='0' && ($_nodesforum_folder_or_post==1 || $_nodesforum_folder_or_post==2 || ($_nodesforum_folder_or_post==5 && $wasa!='N.A.')) && $_nodesforum_postfound!=1)
{
    if($_nodesforum_folder_or_post==1)
    {$isa='folder';}
    else if($_nodesforum_folder_or_post==2)
    {$isa='post';}
    else if($_nodesforum_folder_or_post==5)
    {$isa=$wasa;}
    echo ' in: <input type="radio" name="_nodesforum_search_spectre" value="0"'; if(!isset($_GET['_nodesforum_search_spectre']) || $_GET['_nodesforum_search_spectre']==0){echo ' checked="checked"';} echo ' />entire forum <input type="radio" name="_nodesforum_search_spectre" value="1"'; if($_GET['_nodesforum_search_spectre']==1){echo ' checked="checked"';} echo ' />this '.$isa;
 }
 else
 {echo '<input type="hidden" name="_nodesforum_search_spectre" value="0" />';}
 if(isset($_GET['_nodesforum_node']))
{echo '<input type="hidden" name="_nodesforum_node" value="'.urlencode($_GET['_nodesforum_node']).'" />';}
echo ' <input type="submit" value="search" /></form></div></td></tr></table></div>';
//--------------SEARCH








//--------------YOU ARE HERE
echo '<div style="height:4px;"><!-- --></div><div style="width:100%;"><table class="class_nodesforum_bgcolor3" style="width:100%;"><tr><td class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner">you are here: '.$_nodesforum_youarehere.'</div></td></tr></table></div>';
//--------------YOU ARE HERE


//--------------YOUR MOD LEVEL
if($_nodesforum_ismod==1){
	if($_nodesforum_mod_level<1)
	{$showmodlevel='&infin;';}
	else
	{$showmodlevel=$_nodesforum_mod_level;}
	echo '<div style="height:4px;"><!-- --></div><div style="width:100%;"><table class="class_nodesforum_bgcolor3" style="width:100%;"><tr><td class="class_nodesforum_bgcolor2"><div class="class_nodesforum_inner"><img src="'.$_nodesforum_tool_icon.'" style="vertical-align:text-bottom;border:none;" /> your moderator level here: '.$showmodlevel.$_nodesforum_explain_modship.'</div></td></tr></table></div>';
}
//--------------YOUR MOD LEVEL

//--------------YOUR RIGHT TO AUDIT
if($_nodesforum_righttoaudit==1){
	echo '<div style="height:4px;"><!-- --></div><div style="width:100%;"><table class="class_nodesforum_bgcolor3" style="width:100%;"><tr><td class="class_nodesforum_bgcolor2"><div class="class_nodesforum_inner"><img src="'.$_nodesforum_tool_icon.'" style="vertical-align:text-bottom;border:none;" /> you have the right to audit this '.$thinger.' '.$_nodesforum_explain_righttoaudit.'</div></td></tr></table></div>';
	if($_nodesforum_mod_audit_count>0){
		if($last_audit_notification_time==0){
			$last_audit_notification_history_text = 'never';
		}else{
			$last_audit_notification_history_text = 'on <script type="text/javascript">
				var writness = _nodesforum_maketimus('.$last_audit_notification_time.');
				document.write(writness);
				</script>';
		}
        echo
            '<div style="height:4px;"><!-- --></div><div style="width:100%;"><table class="class_nodesforum_bgcolor3" style="width:100%;"><tr><td class="class_nodesforum_bgcolor2"><div class="class_nodesforum_inner">'
            .'<img src="'.$_nodesforum_warn_icon.'" style="vertical-align:middle;margin-right:8px;border:none;" alt="Audit" />'
            .'There are <span style="color:'.$_nodesforum_link_color.'">'.$_nodesforum_mod_audit_count.'</span> folders or posts inside of this '.$thinger.' that need auditing. '
            .'<a href="?_nodesforum_node=a'.$remember_actual_node.'" style="color:'.$_nodesforum_link_color.';text-decoration:underline;font-weight:bold;">Click here to audit them</a>. (last admin notification was sent: '.$last_audit_notification_history_text.')'
            .'</div></td></tr></table></div>';
    }
}
//--------------YOUR RIGHT TO AUDIT

//--------------YOUR BANISSEMENT
if($_nodesforum_isbanned==1)
{
	echo '<div style="height:4px;"><!-- --></div><div style="width:100%;"><table class="class_nodesforum_bgcolor3" style="width:100%;"><tr><td class="class_nodesforum_bgcolor2"><div class="class_nodesforum_inner"><img src="'.$_nodesforum_no2_icon.'" style="vertical-align:text-bottom;border:none;" /> you are banned here '.$_nodesforum_explain_banship.'</div></td></tr></table></div>';
}
//--------------YOUR BANISSEMENT



//---------------LOGIN
if(isset($_GET['_nodesforum_login']))
{include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path.'bod_login.php'));}
//---------------LOGIN


//---------------FORGOT PASSWORD
if(isset($_GET['_nodesforum_forgot_password']))
{include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path.'bod_forgot_password.php'));}
else if(isset($_GET['_nodesforum_reset_password']))
{include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path.'bod_reset_password.php'));}
//---------------FORGOT PASSWORD


//---------------LOGOUT
if(isset($_GET['_nodesforum_logout']))
{include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path.'bod_logout.php'));}
//---------------LOGOUT



//---------------REGISTER
if(isset($_GET['_nodesforum_register']))
{include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path.'bod_register.php'));}
//---------------REGISTER


//---------------VALIDATE EMAIL
if(isset($_GET['_nodesforum_val']))
{include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path.'bod_val.php'));}
//---------------VALIDATE EMAIL



//---------------VALIDATE NEW EMAIL
if(isset($_GET['_nodesforum_val2']))
{include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path.'bod_val2.php'));}
//---------------VALIDATE NEW EMAIL







//---------------PROFILE OPTIONS
if(isset($_GET['_nodesforum_profile_options']))
{include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path.'bod_profile_options.php'));}
//---------------PROFILE OPTIONS



//---------------FORUM OPTIONS
if(isset($_GET['_nodesforum_forum_options']))
{include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path.'bod_forum_options.php'));}
//---------------FORUM OPTIONS








//---------------ADD POST/EDIT POST
if(isset($_GET['_nodesforum_add_post']) || isset($_GET['_nodesforum_edit_post']))
{include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path.'bod_add_post.php'));}
//---------------ADD POST/EDIT POST



//---------------ADD FOLDER/EDIT FOLDER
if(isset($_GET['_nodesforum_add_folder']) || isset($_GET['_nodesforum_edit_folder']))
{include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path.'bod_add_folder.php'));}
//---------------ADD FOLDER/EDIT FOLDER


//---------------MOVE
if(isset($_GET['_nodesforum_move']))
{include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path.'bod_move.php'));}
//---------------MOVE






//---------------FOLDER (or history) VIEW
if(
	isset($_GET['_nodesforum_node'])
	&& !isset($_GET['_nodesforum_add_folder'])
	&& !isset($_GET['_nodesforum_add_post'])
	&& !isset($_GET['_nodesforum_edit_folder'])
	&& !isset($_GET['_nodesforum_edit_post']) 
	&& !isset($_GET['_nodesforum_move'])
	&& (
		$_nodesforum_folder_or_post==1 
		|| $_nodesforum_folder_or_post==3
		|| $_nodesforum_folder_or_post==7
	)
	&& $_nodesforum_postfound!=1
	&& $_nodesforum_folder_or_post!=6
){
	include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path.'bod_folder_view.php'));
	if($_nodesforum_folder_or_post==1)
	{include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path.'bod_mod_forms.php'));}
}
//---------------FOLDER VIEW




//---------------POST VIEW
if(isset($_GET['_nodesforum_node']) && !isset($_GET['_nodesforum_add_folder']) && !isset($_GET['_nodesforum_add_post']) && !isset($_GET['_nodesforum_edit_folder']) && !isset($_GET['_nodesforum_edit_post']) && !isset($_GET['_nodesforum_move']) && $_nodesforum_folder_or_post==2 && $_nodesforum_postfound!=1)
{
	include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path.'bod_post_view.php'));
	include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path.'bod_mod_forms.php'));
}
//---------------POST VIEW







//---------------MODS LOG VIEW
if($_nodesforum_folder_or_post==4 && !isset($_GET['_nodesforum_move']) && $_nodesforum_postfound!=1)
{include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path.'bod_mods_log_view.php'));}
//---------------MODS LOG VIEW






//---------------SEARCH VIEW
if($_nodesforum_folder_or_post==5)
{include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path.'bod_search_view.php'));}
//--------------SEARCH VIEW


//---------------INSTALLER VIEW
if($_nodesforum_folder_or_post==6)
{include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path.'bod_installer_view.php'));}
//--------------INSTALLER VIEW




//----------------NOT FOUND VIEW
if($_nodesforum_postfound==1)
{echo '<div style="width:100%;padding-top:4px;padding-bottom:4px;" class="class_nodesforum_bgcolor4"><center><div style="width:50%;"><table style="width:100%" class="class_nodesforum_bgcolor3"><tr><td style="text-align:center;" class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner"><img src="'.$_nodesforum_warn_icon.'" style="vertical-align:text-bottom;border:none;" /> this post or folder was not found in the database. please click the back button in your browser or click <a href="?_nodesforum_node=0">here</a> to go to the root of this forum.</div></td></tr></table></div></center></div>';}
//----------------






echo '<div style="height:4px;"><!-- --></div><div style="width:100%;"><table class="class_nodesforum_bgcolor3" style="width:100%;"><tr><td class="class_nodesforum_bgcolor2" style="text-align:center;font-size:75%;"><div class="class_nodesforum_inner">powered by <a href="http://nodesforum.com/">Nodesforum</a></div></td></tr></table></div>';







echo '</td></tr></table></div>';



