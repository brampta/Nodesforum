<?php


echo '<div style="height:4px;"><!-- --></div><div style="width:100%;"><table class="class_nodesforum_bgcolor3" style="width:100%;"><tr><td class="class_nodesforum_bgcolor2"><div class="class_nodesforum_inner">';

if(isset($_SESSION[$_nodesforum_external_user_system_uniqueID_session_name]))
{
	echo '<h4 style="margin:0px;">forum options:</h4>';
	echo '<div style="width:100%;"><table style="width:100%;" class="class_nodesforum_bgcolor3"><tr>
		<td style="width:160px;text-align:center;vertical-align:top;" class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner">';
	//upload avatar
	echo '<h5 style="margin:0px;">avatar:</h5><form enctype="multipart/form-data" action="?_nodesforum_forum_options" method="post">';


	if($_nodesforum_remember_avatar=='')
	{echo 'you have not yet uploaded an avatar.<br />';}
	else
	{echo '<img src="'.$_nodesforum_mysterypath.'/avatars/'.$_nodesforum_remember_avatar.'" style="width:140px;height:140px;" id="my_avatar" onload="resize_pic(140, 140, '."'my_avatar'".')" /><br />';}


	if($_nodesforum_avatarupload_filetoobig==1)
	{echo '<img src="'.$_nodesforum_warn_icon.'" style="vertical-align:text-bottom;border:none;" /> file too big. the max file size for the forum avatar is '.(($_nodesforum_avatars_max_filesize/1024)/1024).'Mb but the file that you have tried to upload was '.(($_FILES['_nodesforum_uploadedfile']['size']/1024)/1024).'Mb. please use a smaller file.<br />';}
	if($_nodesforum_avatarupload_incorrectfiletype==1)
	{echo '<img src="'.$_nodesforum_warn_icon.'" style="vertical-align:text-bottom;border:none;" /> incorrect file type. the allowed file types are jpg, gif and png (image/jpeg, image/pjpeg, image/gif and image/png) but this file is of type: '.$_FILES['_nodesforum_uploadedfile']['type'].'.<br />';}
	if($_nodesforum_avatarupload_errormovingfile==1)
	{echo '<img src="'.$_nodesforum_warn_icon.'" style="vertical-align:text-bottom;border:none;" /> there was an error saving the file, please try again.<br />';}
	if($_nodesforum_avatarupload_uploadsuccess==1)
	{echo 'You have successfully uploaded your new avatar.<br />';}
	echo 'chose a file to upload:<br />
	<input name="_nodesforum_uploadedfile" id="_nodesforum_uploadedfile" type="file" /><br />
		<input type="submit" name="_nodesforum_upload_avatar" value="upload new avatar" />
		</form>';
	echo '</div></td>
		<td style="text-align:left;vertical-align:top;" class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner">';
	//edit signature
	echo '<h5 style="margin:0px;">signature:</h5>';
	if($_nodesforum_remember_signature==0)
	{
		echo 'you have not yet created your signature.<br />';
		echo '<a href="?_nodesforum_node=s'.$_SESSION[$_nodesforum_external_user_system_uniqueID_session_name].'&_nodesforum_add_post">edit signature</a>';
	}
	else
	{
		echo '<p>'.display_bb($_nodesforum_remember_signature_post,$_nodesforum_p_inf_str,1,$_nodesforum_remember_signature_post_disable_auto_smileys,$_nodesforum_remember_signature_post_disable_auto_links,0).'</p>';
		echo '<a href="?_nodesforum_node=s'.$_SESSION[$_nodesforum_external_user_system_uniqueID_session_name].'&_nodesforum_edit_post='.$_nodesforum_remember_signature.'">edit signature</a>';
	}
	echo '</div></td>
		<tr><td colspan="2" class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner">';
	//edit allow_posting_on_personal_page
	echo '<h5 style="margin:0px;">allow non-moderators to create posts and folders on <a href="?_nodesforum_node=u'.$_SESSION[$_nodesforum_external_user_system_uniqueID_session_name].'">my personal forum page</a>:</h5><form action="?_nodesforum_forum_options" method="post">';
	if($_nodesforum_edit_allow_posting_success==1)
	{echo 'You have successfully saved your choice.<br />';}
	echo '<input type="radio" name="_nodesforum_allow_posting_on_personal_page" value="2"'; if($_nodesforum_remember_allow_posting_on_personal_page==0 || $_nodesforum_remember_allow_posting_on_personal_page==2) {echo ' checked="checked"';} echo ' />allow them<br />
		<input type="radio" name="_nodesforum_allow_posting_on_personal_page" value="1"'; if($_nodesforum_remember_allow_posting_on_personal_page==1) {echo ' checked="checked"';} echo ' />do not allow them (make sure to create some folders that people can post in on your forum page before you disallow them to post directly on the page because otherwise they will have nowhere to leave you some messages)<br />
		<input type="submit" name="_nodesforum_edit_allow_posting" value="save preference" />
		</form>';
	echo '</div></td></tr>
		</tr></table></div>';
}
else
{echo 'error...<br />';}


echo '</div></td></tr></table></div>';


?>
