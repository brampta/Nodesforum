<?php

echo '<div style="height:4px;"><!-- --></div><div style="width:100%;"><table class="class_nodesforum_bgcolor3" style="width:100%;"><tr><td class="class_nodesforum_bgcolor2"><div class="class_nodesforum_inner">';


if($_nodesforum_use_external_user_system=='no' && isset($_SESSION[$_nodesforum_external_user_system_uniqueID_session_name]))
{
    echo '<h4 style="margin:0px;">profile options:</h4>';
    echo '<div style="width:100%;"><table style="width:100%;" class="class_nodesforum_bgcolor3"><tr>
			<td style="width:33%;text-align:left;vertical-align:top;" class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner">';
    //public name
    echo '<h5 style="margin:0px;">public name:</h5><form action="?_nodesforum_profile_options" method="post">';
    if($_nodesforum_po_public_name_taken!=0)
    {echo '<img src="'.$_nodesforum_warn_icon.'" style="vertical-align:text-bottom;border:none;" /> This name is already in use by <a href="?_nodesforum_node=u'.$_SESSION[$_nodesforum_external_user_system_uniqueID_session_name].'">'.htmlspecialchars($_nodesforum_po_public_name_taken_public_name).'</a>.<br />';}
    if($_nodesforum_po_public_name_changed==1)
    {echo 'You have successfully changed your public name to '.htmlspecialchars($_nodesforum_remember_public_name).'.<br />';}
    echo '<input type="text" name="_nodesforum_change_public_name" value="'.htmlspecialchars($_nodesforum_remember_public_name).'" /><br />
			<input type="submit" name="_nodesforum_submit_change_public_name" value="save public name" />
			</form>';
    echo '</div></td>
			<td style="width:34%;text-align:left;vertical-align:top;" class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner">';
    //change password
    echo '<h5 style="margin:0px;">change password:</h5><form action="?_nodesforum_profile_options" method="post">';
    if($_nodesforum_po_password_oldbad!=0)
    {echo '<img src="'.$_nodesforum_warn_icon.'" style="vertical-align:text-bottom;border:none;" /> The curent password is incorrect.<br />';}
    if($_nodesforum_po_password_newshort!=0)
    {
        $yourcharactersS='';
        if(strlen($_POST['_nodesforum_new_password1'])!=1)
        {$yourcharactersS='s';}
        echo '<img src="'.$_nodesforum_warn_icon.'" style="vertical-align:text-bottom;border:none;" /> the new password is too short. this forum needs passwords to be at least '.$_nodesforum_minimum_password_length.' characters long but your was only '.strlen($_POST['_nodesforum_new_password1']).' character'.$yourcharactersS.' long.<br />';
    }
    if($_nodesforum_po_password_retypebad!=0)
    {echo '<img src="'.$_nodesforum_warn_icon.'" style="vertical-align:text-bottom;border:none;" /> the 2 new password don'."'".'t match.<br />';}
    if($_nodesforum_po_password_changed==1)
    {echo 'You have successfully changed your password.<br />';}
    echo 'current password:<br />
			<input type="password" name="_nodesforum_old_password" value="'.$_POST['_nodesforum_old_password'].'" /><br />
			new password:<br />
			<input type="password" name="_nodesforum_new_password1" /><br />
			retype new password:<br />
			<input type="password" name="_nodesforum_new_password2" /><br />
			<input type="submit" name="_nodesforum_submit_change_password" value="change password" />
			</form>';
    echo '</div></td>
			<td style="width:33%;text-align:left;vertical-align:top;" class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner">';
    //email address
    echo '<h5 style="margin:0px;">change email:</h5><form action="?_nodesforum_profile_options" method="post">';
    if($_nodesforum_po_email_taken==1)
    {echo '<img src="'.$_nodesforum_warn_icon.'" style="vertical-align:text-bottom;border:none;" /> This email address ('.htmlspecialchars($_POST['_nodesforum_change_email']).') is already in use by someone.<br />';}
    if($_nodesforum_po_email_validation_send==1)
    {echo 'You have successfully requested for your email address to be changed to '.htmlspecialchars($_POST['_nodesforum_change_email']).'. An email containing a link that you must click to validate the new email address has been sent at this new email. Please go click the link in that email to complete the email address change. Note that the link in the email will only be valid for 24h.<br />';}
    if($_nodesforum_po_email_changed==1)
    {echo 'You have successfully changed your email address to '.htmlspecialchars($_POST['_nodesforum_change_email']).'.<br />';}
    echo '<input type="text" name="_nodesforum_change_email" /><br />
			<input type="submit" name="_nodesforum_submit_change_email" value="submit new email" />
			</form>';
    echo '</div></td>
			</tr></table></div>';
}
else
{echo 'error...<br />';}



echo '</div></td></tr></table></div>';


?>
