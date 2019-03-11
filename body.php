<?php
a_function_that_is_only_in_the_pre_output();



echo '<script type="text/javascript" src="'.$_nodesforum_code_path.'_nodesforum_js.js"></script>';



echo '<style type="text/css">

.class_nodesforum_bgcolor1 {color:'.$_nodesforum_text_color.';background-color:'.$_nodesforum_background_color1.';background-image:url("'.$_nodesforum_mysterypath.'/gradios2.png");background-position:bottom;background-repeat:repeat-x;vertical-align:top;}
.class_nodesforum_bgcolor2 {color:'.$_nodesforum_text_color.';background-color:'.$_nodesforum_background_color2.';background-image:url("'.$_nodesforum_mysterypath.'/gradios2.png");background-position:bottom;background-repeat:repeat-x;vertical-align:top;}
.class_nodesforum_inner {padding-left:4px;padding-right:4px;background-image:url("'.$_nodesforum_mysterypath.'/gradios.png");background-repeat:repeat-x;}
.class_nodesforum_bgcolor3 {color:'.$_nodesforum_text_color.';background-color:'.$_nodesforum_frames_color.';}
.class_nodesforum_bgcolor4 {color:'.$_nodesforum_text_color.';background-color:'.$_nodesforum_bottom_color.';}
.class_nodesforum_bgcolorinherit {color:inherit;}


.class_nodesforum_bgcolor1 a, .class_nodesforum_bgcolor2 a, .class_nodesforum_bgcolor3 a, .class_nodesforum_bgcolor4 a, .class_nodesforum_bgcolorinherit a {color:'.$_nodesforum_link_color.';}
.class_nodesforum_bgcolor1 a:hover, .class_nodesforum_bgcolor2 a:hover, .class_nodesforum_bgcolor3 a:hover, .class_nodesforum_bgcolor4 a:hover, .class_nodesforum_bgcolorinherit a:hover, .class_nodesforum_bgcolor1 a:hover:visited, .class_nodesforum_bgcolor2 a:hover:visited, .class_nodesforum_bgcolor3 a:hover:visited, .class_nodesforum_bgcolor4 a:hover:visited, .class_nodesforum_bgcolorinherit a:hover:visited {color:'.$_nodesforum_link_hover_color.';}
.class_nodesforum_bgcolor1 a:visited, .class_nodesforum_bgcolor2 a:visited, .class_nodesforum_bgcolor3 a:visited, .class_nodesforum_bgcolor4 a:visited, .class_nodesforum_bgcolorinherit a:visited {color:'.$_nodesforum_link_visited_color.';}


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
if($_nodesforum_ismod==1)
{
	if($_nodesforum_mod_level<1)
	{$showmodlevel='&infin;';}
	else
	{$showmodlevel=$_nodesforum_mod_level;}
	echo '<div style="height:4px;"><!-- --></div><div style="width:100%;"><table class="class_nodesforum_bgcolor3" style="width:100%;"><tr><td class="class_nodesforum_bgcolor2"><div class="class_nodesforum_inner"><img src="'.$_nodesforum_tool_icon.'" style="vertical-align:text-bottom;border:none;" /> your moderator level here: '.$showmodlevel.$_nodesforum_explain_modship.'</div></td></tr></table></div>';
}
//--------------YOUR MOD LEVEL

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
if(isset($_GET['_nodesforum_node']) && !isset($_GET['_nodesforum_add_folder']) && !isset($_GET['_nodesforum_add_post']) && !isset($_GET['_nodesforum_edit_folder']) && !isset($_GET['_nodesforum_edit_post']) && !isset($_GET['_nodesforum_move']) && ($_nodesforum_folder_or_post==1 || $_nodesforum_folder_or_post==3) && $_nodesforum_postfound!=1 && $_nodesforum_folder_or_post!=6)
{
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










?>
