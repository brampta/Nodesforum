<?php


echo '<div style="height:4px;"><!-- --></div><div style="width:100%;"><table class="class_nodesforum_bgcolor3" style="width:100%;"><tr><td class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner">';


if($_nodesforum_img_ver_invalid==1)
{echo '<img src="'.$_nodesforum_warn_icon.'" style="vertical-align:text-bottom;border:none;" /> The the number that you have written in the box for the image verification did not match the number shown in the picture.<br />';}
if($_nodesforum_email_not_found==1)
{echo '<img src="'.$_nodesforum_warn_icon.'" style="vertical-align:text-bottom;border:none;" /> This email address was not found in the system.<br />';}

if($_nodesforum_resendpass_suxxess==1)
{echo 'a request to change your password has been emailed to '.$_POST['_nodesforum_resend_email'].'. Please go check your email and click the link in the email we just sent you to access the page to change your password. the email will be valid for 24 hours.';}
else
{
	echo '<h4>request password reset:</h4>
		<form action="?_nodesforum_forgot_password" method="post">
		<table class="class_nodesforum_bgcolorinherit">
		<tr><td>email:</td><td><input type="text" name="_nodesforum_resend_email" value="'.$_POST['_nodesforum_resend_email'].'" /></td></tr>';
	if($_nodesforum_image_verification_on_forgotten_pass=='yes')
	{echo '
		<tr><td>image verification:</td><td><img src="'.$_nodesforum_code_path.'image_verification.php?name=forgotpass&bgcolor='.urlencode($_nodesforum_background_color1).'&color='.urlencode($_nodesforum_text_color).'" /></td></tr>
		<tr><td>retype the number in the image verification:</td><td><input type="text" name="_nodesforum_numbaz" /></td></tr>';}
	echo '
		</table>
		<input type="submit" name="_nodesforum_resendpass" value="request password reset" />
		</form>';
}


echo '</div></td></tr></table></div>';




?>
