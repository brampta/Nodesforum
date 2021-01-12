<?php






echo '<div style="height:4px;"><!-- --></div><div style="width:100%;"><table class="class_nodesforum_bgcolor3" style="width:100%;"><tr><td class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner">';



if($_nodesforum_create_post_namecannotbeblank==1)
{echo '<img src="'.$_nodesforum_warn_icon.'" style="vertical-align:text-bottom;border:none;" /> the title of the post cannot be blank.<br />';}
if($_nodesforum_post_too_short==1)
{
	$charactersS='';
	if(strlen($_POST['_nodesforum_new_post'])!=1)
	{$charactersS='s';}
	echo '<img src="'.$_nodesforum_warn_icon.'" style="vertical-align:text-bottom;border:none;" /> posts on this forum must be at least '.$_nodesforum_minimum_post_length.' characters long but your post is only '.strlen($_POST['_nodesforum_new_post']).' character'.$charactersS.' long.<br />';
}
if($_nodesforum_reply_too_short==1)
{
	$charactersS='';
	if(strlen($_POST['_nodesforum_new_post'])!=1)
	{$charactersS='s';}
	echo '<img src="'.$_nodesforum_warn_icon.'" style="vertical-align:text-bottom;border:none;" /> replies on this forum must be at least '.$_nodesforum_minimum_reply_length.' characters long but your reply is only '.strlen($_POST['_nodesforum_new_post']).' character'.$charactersS.' long.<br />';
}
if($_nodesforum_img_ver_invalid==1)
{echo '<img src="'.$_nodesforum_warn_icon.'" style="vertical-align:text-bottom;border:none;" /> The the number that you have written in the box for the image verification did not match the number shown in the picture.<br />';}
if($_nodesforum_create_post_dberror==1)
{echo '<img src="'.$_nodesforum_warn_icon.'" style="vertical-align:text-bottom;border:none;" /> there was an error creating the new post in the database, please notify the admin of the forum of this problem.<br /><b>'.$_nodesforum_remember_wtf.'</b><br />';}
if($_nodesforum_already_haveapostfor_signature==1)
{echo '<img src="'.$_nodesforum_warn_icon.'" style="vertical-align:text-bottom;border:none;" /> error, you already have a post for signature, do not try to add a new one but edit the one you already have instead.<br />';}
if($_nodesforum_contains_invalid_strict_quotes!='')
{echo '<img src="'.$_nodesforum_warn_icon.'" style="vertical-align:text-bottom;border:none;" /> error, 1 or more strict quotes in your post could not be successfully validated:'.nl2br($_nodesforum_contains_invalid_strict_quotes).'.<br />';}





//auto quote?
if(!isset($_GET['_nodesforum_edit_post']) && isset($_POST['_nodesforum_quote_post']))
{
	$chars_to_esc=']"';
	$chars_to_esc2='/';
	$_POST['_nodesforum_new_post']='[quote strict="'.$_POST['_nodesforum_quote_postID'].'"'._nodesforum_different_escape_certain_chars(urldecode($_POST['_nodesforum_quote_userID']),$chars_to_esc).'"'._nodesforum_different_escape_certain_chars(urldecode($_POST['_nodesforum_quote_publicname']),$chars_to_esc).'"'.$_POST['_nodesforum_quote_time'].'"]'._nodesforum_different_escape_certain_chars(urldecode($_POST['_nodesforum_quote_post']),$chars_to_esc2).'[/quote]
';
}







$addoredit='edit';
if(isset($_GET['_nodesforum_add_post']) && substr($_GET['_nodesforum_node'],0,1)!='s')
{$addoredit='add a';}
echo '<h4 style="margin:0px;">'.$addoredit.' '.$_nodesforum_postorreply.':</h4>';
echo '<form action="?_nodesforum_node='.$_GET['_nodesforum_node'].'&';
if(isset($_GET['_nodesforum_add_post']))
{echo '_nodesforum_add_post';}
else if(isset($_GET['_nodesforum_edit_post']))
{echo '_nodesforum_edit_post='.$_GET['_nodesforum_edit_post'].'&_nodesforum_page='.$_GET['_nodesforum_page'].'#_nodesforum_anchor_'.$_GET['_nodesforum_edit_post'];}
echo '" method="post">';
if((isset($_GET['_nodesforum_add_post']) && $_nodesforum_folder_or_post==1) || (isset($_GET['_nodesforum_edit_post']) && $_nodesforum_edit_firstletterof_containing_folder_or_post=='f'))
{echo 'post title:<br />
<input type="text" name="_nodesforum_new_post_title" value="'.htmlspecialchars($_POST['_nodesforum_new_post_title']).'" style="width:400px;" /><br />';}
$oldestacceptabletimeforguesteditbyip=$_nodesforum_edit_creation_time+($_nodesforum_allow_guests_to_edit_their_posts_for_x_hours*3600);
if(isset($_GET['_nodesforum_add_post']) || (isset($_GET['_nodesforum_edit_post']) && ($_nodesforum_edit_creator_uniqueID==$_SESSION[$_nodesforum_external_user_system_uniqueID_session_name] || ($_nodesforum_edit_creator_uniqueID==0 && $_nodesforum_edit_creator_ip==$_nodesforum_enc_ip && $nowtime<$oldestacceptabletimeforguesteditbyip))))
{echo 'post:



<div id="_nodesforum_bb_interfaz" style="width:100%;text-align:center;"></div>


<textarea name="_nodesforum_new_post" style="width:100%;height:200px;" id="_nodesforum_post_field" onchange="_nodesforum_fieldchange()" onclick="_nodesforum_fieldchange()" onmousedown="_nodesforum_fieldchange()" onmouseup="_nodesforum_fieldchange()">'.htmlspecialchars($_POST['_nodesforum_new_post']).'</textarea><br />


<input type="checkbox" name="_nodesforum_disable_auto_smileys"'; if(isset($_POST['_nodesforum_disable_auto_smileys'])){echo ' checked="checked"';} echo ' />disable auto-smileys<br />
<input type="checkbox" name="_nodesforum_disable_auto_links"'; if(isset($_POST['_nodesforum_disable_auto_links'])){echo ' checked="checked"';} echo ' />disable auto-links


<script type="text/javascript">
var _nodesforum_mysterypath = "'.$_nodesforum_mysterypath.'";
var _nodesforum_images_repo_path = "'.$_nodesforum_code_path.'images_repo";
var _nodesforum_bbcode_escape_char = "'.$_nodesforum_bbcode_escape_char.'";
var _nodesforum_code_path = "'.$_nodesforum_code_path.'";
</script>
<script type="text/javascript" src="'.$_nodesforum_code_path.'_nodesforum_bbcode_interface.js"></script>


<br />';}






if($_nodesforum_allow_guest_replies=='yes' && ((isset($_GET['_nodesforum_add_post']) && $_nodesforum_folder_or_post==1) || (isset($_GET['_nodesforum_edit_post']) && $_nodesforum_edit_firstletterof_containing_folder_or_post=='f')))
{
	//give choice to allow guest replies or not
	echo '<input type="radio" name="_nodesforum_allow_guest_reply" value="1"'; if($_POST['_nodesforum_allow_guest_reply']==1 || !isset($_POST['_nodesforum_allow_guest_reply'])) {echo ' checked="checked"';} echo ' />allow guests to reply<br />
		<input type="radio" name="_nodesforum_allow_guest_reply" value="0"'; if(isset($_POST['_nodesforum_allow_guest_reply']) && $_POST['_nodesforum_allow_guest_reply']==0) {echo ' checked="checked"';} echo ' />do not allow guests to reply<br />';
}

if(!isset($_SESSION[$_nodesforum_external_user_system_uniqueID_session_name]) && $_nodesforum_image_verification_on_guest_reply=='yes')
{
	//image verification for guest reply
	echo '<table class="class_nodesforum_bgcolorinherit"><tr><td>image verification:</td><td><img src="'.$_nodesforum_code_path.'image_verification.php?name=gpost&bgcolor='.urlencode($_nodesforum_background_color1).'&color='.urlencode($_nodesforum_text_color).'" /></td></tr>
		<tr><td>retype the number in the image verification:</td><td><input type="text" name="_nodesforum_numbazx" /></td></tr></table>';
}

if(isset($_GET['_nodesforum_add_post']))
{echo '<input type="submit" name="_nodesforum_create_post" value="post" />';}
else if(isset($_GET['_nodesforum_edit_post']))
{echo '<input type="submit" name="_nodesforum_edit_post" value="save changes" />';}
echo '</form>';










echo '<form style="visibility:hidden;"><input type="submit" value="test" /></form>';







echo '<br /><br /><h3 style="margin:0px;">bbcode legend:</h3>';

echo '<div style="width:600px;overflow:auto;">';

echo '<br /><br /><h4 style="margin:0px;">standard tags:</h4>';
echo '<p>standard tags are available to everyone wihtout any restriction</p>';
foreach($bb_legend as $key => $value)
{
	if($bb_type[$key]=='standard')
	{echo '<b>'.$bb_name[$key].'</b>: '.nl2br(htmlspecialchars($value)).'<br />';}
}

echo '<br /><br /><h4 style="margin:0px;">3rd party tags:</h4>';
echo '<p>3rd party tags can be more or less restricted depending on the <a href="?_nodesforum_node=p4">config of the admins</a>. they are a safe way to allow people to add cool stuff to their posts.</p>';
foreach($bb_legend as $key => $value)
{
	if($bb_type[$key]=='3rd party')
	{echo '<b>'.$bb_name[$key].'</b>: '.nl2br(htmlspecialchars($value)).'<br />';}
}

echo '<br /><br /><h4 style="margin:0px;">risky tags:</h4>';
echo '<p>risky tags are only available to those who have the power of using them.</p>';
foreach($bb_legend as $key => $value)
{
	if($bb_type[$key]=='risky')
	{echo '<b>'.$bb_name[$key].'</b>: '.nl2br(htmlspecialchars($value)).'<br />';}
}

echo '</div>';

echo '</div></td></tr></table></div>';


?>
