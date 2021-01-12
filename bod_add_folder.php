<?php

echo '<div style="height:4px;"><!-- --></div><div style="width:100%;"><table class="class_nodesforum_bgcolor3" style="width:100%;"><tr><td class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner">';

if($_nodesforum_create_folder_namecannotbeblank==1)
{echo '<img src="'.$_nodesforum_warn_icon.'" style="vertical-align:text-bottom;border:none;" /> the name of the folder cannot be blank.<br />';}
if($_nodesforum_create_folder_dberror==1)
{echo '<img src="'.$_nodesforum_warn_icon.'" style="vertical-align:text-bottom;border:none;" /> there was an error creating the new folder in the database, please notify the admin of the forum of this problem.<br /><b>'.$_nodesforum_remember_wtf.'</b><br />';}
if($_nodesforum_contains_invalid_strict_quotes!='')
{echo '<img src="'.$_nodesforum_warn_icon.'" style="vertical-align:text-bottom;border:none;" /> error, 1 or more strict quotes in your post could not be successfully validated:'.nl2br($_nodesforum_contains_invalid_strict_quotes).'.<br />';}


if(isset($_GET['_nodesforum_add_folder']))
{$addoredit='add a';}
else if(isset($_GET['_nodesforum_edit_folder']))
{$addoredit='edit';}
echo '<h4 style="margin:0px;">'.$addoredit.' folder:</h4>';
echo '<form action="?_nodesforum_node='.$_GET['_nodesforum_node'].'&';
if(isset($_GET['_nodesforum_add_folder']))
{echo '_nodesforum_add_folder';}
else if(isset($_GET['_nodesforum_edit_folder']))
{echo '_nodesforum_edit_folder='.$_GET['_nodesforum_edit_folder'].'&_nodesforum_page='.$_GET['_nodesforum_page'].'#_nodesforum_anchor_'.$_GET['_nodesforum_edit_folder'];}
echo '" method="post">
	folder name:<br />
	<input type="text" name="_nodesforum_new_folder_name" value="'.htmlspecialchars($_POST['_nodesforum_new_folder_name']).'" /><br />
	description (optional):


	<div id="_nodesforum_bb_interfaz" style="width:100%;text-align:left;"></div>


	<textarea style="width:600px;height:100px;" name="_nodesforum_new_folder_description" id="_nodesforum_post_field" onchange="_nodesforum_fieldchange()" onclick="_nodesforum_fieldchange()" onmousedown="_nodesforum_fieldchange()" onmouseup="_nodesforum_fieldchange()">'.htmlspecialchars($_POST['_nodesforum_new_folder_description']).'</textarea><br />


	<input type="checkbox" name="_nodesforum_disable_auto_smileys"'; if(isset($_POST['_nodesforum_disable_auto_smileys'])){echo ' checked="checked"';} echo ' />disable auto-smileys<br />
	<input type="checkbox" name="_nodesforum_disable_auto_links"'; if(isset($_POST['_nodesforum_disable_auto_links'])){echo ' checked="checked"';} echo ' />disable auto-links


<script type="text/javascript">
var _nodesforum_mysterypath = "'.$_nodesforum_mysterypath.'";
var _nodesforum_images_repo_path = "'.$_nodesforum_code_path.'images_repo";
var _nodesforum_bbcode_escape_char = "'.$_nodesforum_bbcode_escape_char.'";
var _nodesforum_code_path = "'.$_nodesforum_code_path.'";
</script>
<script type="text/javascript" src="'.$_nodesforum_code_path.'_nodesforum_bbcode_interface.js"></script>


<br />

	allow posting:<br />
	<input type="radio" name="_nodesforum_new_folder_allow_posting" value="2"'; if($_POST['_nodesforum_new_folder_allow_posting']=='2' || !isset($_POST['_nodesforum_new_folder_allow_posting'])) {echo ' checked="checked"';} echo ' />allow all users to create posts and subfolders inside of this folder<br />
	<input type="radio" name="_nodesforum_new_folder_allow_posting" value="1"'; if($_POST['_nodesforum_new_folder_allow_posting']=='1') {echo ' checked="checked"';} echo ' />allow only moderators to create posts and subfolders inside of this folder<br />';
	if($_nodesforum_power_on_skeleton==1)
{echo 'skeleton folder:<br />
	<input type="radio" name="_nodesforum_new_folder_skeleton" value="0"'; if($_POST['_nodesforum_new_folder_skeleton']=='0' || !isset($_POST['_nodesforum_new_folder_skeleton'])) {echo ' checked="checked"';} echo ' />normal folder<br />
	<input type="radio" name="_nodesforum_new_folder_skeleton" value="1"'; if($_POST['_nodesforum_new_folder_skeleton']=='1') {echo ' checked="checked"';} echo ' />skeleton folder<br />';}


if(isset($_GET['_nodesforum_add_folder']))
{echo '<input type="submit" name="_nodesforum_create_folder" value="create folder" />';}
else if(isset($_GET['_nodesforum_edit_folder']))
{echo '<input type="submit" name="_nodesforum_edit_folder" value="save changes" />';}
echo '</form>';












echo '<form style="visibility:hidden;"><input type="submit" value="test" /></form>';











echo '</div></td></tr></table></div>';


?>
