<?php




echo '<div style="height:4px;"><!-- --></div><div style="width:100%;"><table class="class_nodesforum_bgcolor3" style="width:100%;"><tr><td class="class_nodesforum_bgcolor2"><div class="class_nodesforum_inner">';




	if($_nodesforum_move_folder_doesnt_exist==1)
	{echo '<img src="'.$_nodesforum_warn_icon.'" style="vertical-align:text-bottom;border:none;" /> the destination folder you have chosen does not appear to exist. make sure your target is the correct node number.<br />';}
	if($_nodesforum_move_folder_no_permission==1)
	{echo '<img src="'.$_nodesforum_warn_icon.'" style="vertical-align:text-bottom;border:none;" /> you can not move stuff to the folder you have selected because this destination does not allow posting and you do not have moderator rights on it.<br />';}
	if($_nodesforum_move_folder_not_folder==1)
	{echo '<img src="'.$_nodesforum_warn_icon.'" style="vertical-align:text-bottom;border:none;" /> the destination that you have selected is not a folder, you can only move stuff into folders.<br />';}
	if($_nodesforum_move_banned_from_destination==1)
	{echo '<img src="'.$_nodesforum_warn_icon.'" style="vertical-align:text-bottom;border:none;" /> you cannot move a post or a folder to the destination that you have chosen because either your account or your ip is banned there.<br />';}


	if($_nodesforum_move_folder_or_post==1)
	{
		$_nodesforum_action_icon=$_nodesforum_folder_icon;
		$iscalled='folder';
		$thismovedicon=$_nodesforum_folder_icon;
	}
	else if($_nodesforum_move_folder_or_post==2)
	{
		$_nodesforum_action_icon=$_nodesforum_post_icon;
		$iscalled='post';
		$thismovedicon=$_nodesforum_post_icon;
	}


	echo '<script type="text/javascript">
var _nodesforum_code_path = "'.$_nodesforum_code_path.'";
var _nodesforum_ancestry_separator = "'.$_nodesforum_ancestry_separator.'";
var _nodesforum_node = "'; if($_nodesforum_gofor_move_and_restore==1){echo 0;}else{echo $_GET['_nodesforum_node'];} echo '";
var _nodesforum_movee = "'.$_GET['_nodesforum_move'].'";
var modpowers_on=new Array();
';
if($_nodesforum_remember_modership_folders)
{
	foreach($_nodesforum_remember_modership_folders as $key => $value)
	{echo 'modpowers_on['."'".$key."'".']="yes";';}
}
echo '
var banned_on=new Array();
';
if($_nodesforum_remember_bannership_folders)
{
	foreach($_nodesforum_remember_bannership_folders as $key => $value)
	{echo 'banned_on['."'".$key."'".']="yes";';}
}
echo '
</script>
<script type="text/javascript" src="'.$_nodesforum_code_path.'_nodesforum_move_js.js"></script>';

	if($_nodesforum_gofor_move_and_restore==1)
	{
		echo '<h4 style="margin:0px;">move and restore a '.$iscalled.':</h4>
			<p><img src="'.$_nodesforum_warn_icon.'" style="vertical-align:text-bottom;border:none;" /> it was not possible to restore the '.$iscalled.' that you were trying to restore because the folder that was containing it is not active anymore. if you want you can use this menu to restore the '.$iscalled.' in a different location:</p>';
	}
	else
	{echo '<h4 style="margin:0px;">move a '.$iscalled.':</h4>';}
	echo '<form action="?_nodesforum_node='.$_GET['_nodesforum_node'].'&_nodesforum_move='.$_GET['_nodesforum_move'].'&_nodesforum_page='.$_GET['_nodesforum_page'];

if($_nodesforum_gofor_move_and_restore==1)
{echo '&_nodesforum_restore=1&_nodesforum_main_actionID='.$_GET['_nodesforum_main_actionID'].'&_nodesforum_handling_fapID='.$_GET['_nodesforum_handling_fapID'].'&_nodesforum_remember_node_togobackto='.$_GET['_nodesforum_handling_fapID'].'&_nodesforum_remember_page_togobackto='.$_GET['_nodesforum_remember_page_togobackto'];}

echo '" method="post">

		move this '.$iscalled.':<br />
		<img src="'.$thismovedicon.'" style="vertical-align:text-bottom;border:none;" /> '.htmlspecialchars($_nodesforum_move_title).'<br />
		from:<br />
		'.$_nodesforum_move_from.'<br />
		to:<br />
		<input type="text" name="_nodesforum_move_destination" value="'.$_POST['_nodesforum_move_destination'].'" id="_nodesforum_move_destination" /> <input type="button" value="browse" style="display:none;" id="_nodesforum_open_destination_browse" onclick="_nodesforum_open_browse_menu()" /><script type="text/javascript">
document.getElementById("_nodesforum_open_destination_browse").style.display = "inline";
</script><noscript><br />javascript is required to visually browse the available destinations</noscript><br />
	<div id="_nodesforum_destination_browse_div" style="display:none;">
	<table class="class_nodesforum_bgcolor3">

	<tr><td class="class_nodesforum_bgcolor1" colspan="4"><div class="class_nodesforum_inner">your selection => <span id="_nodesforum_show_selection"></span></div></td></tr>

	<tr>
	<td class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner"><img src="'.$_nodesforum_home_icon.'" style="vertical-align:text-bottom;border:none;" /> <a onclick="_nodesforum_move_browse('."'0'".')" style="cursor:pointer;">root</a></div></td>
	<td class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner"><img src="'.$_nodesforum_userhome_icon.'" style="vertical-align:text-bottom;border:none;" /> <a onclick="_nodesforum_move_browse('."'u".$_SESSION[$_nodesforum_external_user_system_uniqueID_session_name]."'".')" style="cursor:pointer;">my forum page</a></div></td>
	<td class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner"><img src="'.$_nodesforum_userhome_icon.'" style="vertical-align:text-bottom;border:none;" /> someone else'."'".'s forum page <input type="text" id="_nodesforum_some1elseID" onkeypress="_nodesforum_tryuser()" style="width:100px;" /></div></td>
	<td class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner">';
$countem=0;
foreach($_nodesforum_risky_bbcode_title as $key => $value)
{
	$countem++;
	if($countem>1)
	{echo ' ';}
	echo '<img src="'.$_nodesforum_power_icon.'" style="vertical-align:text-bottom;border:none;" /> <a onclick="_nodesforum_move_browse('."'".$key."'".')" style="cursor:pointer;">'.$key.'</a>';
}
echo '</div></td>
	</tr>

	<tr><td class="class_nodesforum_bgcolor1" colspan="4"><div class="class_nodesforum_inner" id="_nodesforum_show_children">...loading</div></td></tr>

	</table>
	</div>
	<br />';

if($_nodesforum_gofor_move_and_restore==1)
{
	echo 'and then restore it<br /><br />';
	$button_name='move and restore';
}
else
{$button_name='move';}

echo '<input type="submit" name="_nodesforum_move" value="'.$button_name.'" />
		</form>';



echo '</div></td></tr></table></div>';




?>
