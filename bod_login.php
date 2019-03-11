<?php



echo '<div style="height:4px;"><!-- --></div><div style="width:100%;"><table class="class_nodesforum_bgcolor3" style="width:100%;"><tr><td class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner">';



if($_nodesforum_login_suxxess==1)
{echo 'You are now logged in as '.$_SESSION[$_nodesforum_external_user_system_loginusername_session_name].'.';}
else if($_nodesforum_login_notvalidated==1 || $_nodesforum_resendval_img_ver_invalid==1)
{
	if($_nodesforum_login_notvalidated==1)
	{
		echo '<p>The email and password you have entered are good but the email has not yet been verified on this account. When you registered, we sent you an email containing a link that you were supposed to click to validate your email. Before you can login the email must be validated in this manner.</p>
			<p>Please go double-check your email ('.htmlspecialchars($_POST['_nodesforum_login_email']).') to see if you cant find the email were supposed to have sent you there. If you cant find the email you can also use the form below to have it resent to you.</p><br />';
	}
	if($_nodesforum_resendval_img_ver_invalid==1)
	{
		echo '<img src="'.$_nodesforum_warn_icon.'" style="vertical-align:text-bottom;border:none;" /> The the number that you have written in the box for the image verification did not match the number shown in the picture.<br />';
	}
	echo '<form action="?_nodesforum_login" method="post">';
	if($_nodesforum_image_verification_on_resend_validation_mail=='yes')
	{echo '
		<table class="class_nodesforum_bgcolorinherit"><tr><td>image verification:</td><td><img src="'.$_nodesforum_code_path.'image_verification.php?name=resendval&bgcolor='.urlencode($_nodesforum_background_color1).'&color='.urlencode($_nodesforum_text_color).'" /></td></tr>
		<tr><td>retype the number in the image verification:</td><td><input type="text" name="_nodesforum_numbax" /></td></tr></table>';}
		echo '
		<input type="hidden" name="_nodesforum_remember_uniqueID" value="'.$_nodesforum_remember_uniqueID.'" />
		<input type="hidden" name="_nodesforum_remember_email" value="'.$_POST['_nodesforum_login_email'].'" />
		<input type="submit" name="_nodesforum_resendval" value="resend email validation email" />
		</form>';
}
else if($_nodesforum_resendval_suxxess==1)
{echo 'The validation email has been resent to your address. Please check your email and click the link contained in this validation email to complete the registration process.';}
else
{
	if($_nodesforum_emailandpassworddontmatch==1)
	{echo '<img src="'.$_nodesforum_warn_icon.'" style="vertical-align:text-bottom;border:none;" /> This email and password do not match.';}
	echo '<h4 style="margin:0px;">login:</h4>
		<form action="?_nodesforum_login" method="post">
		<table class="class_nodesforum_bgcolorinherit">
		<tr><td>email:</td><td><input type="text" name="_nodesforum_login_email" value="'.$_POST['_nodesforum_login_email'].'" /></td></tr>
		<tr><td>password:</td><td><input type="password" name="_nodesforum_login_password" value="'.$_POST['_nodesforum_login_password'].'" /></td></tr>
		<tr><td colspan="2">remember me for 2 weeks: <input type="checkbox" name="_nodesforum_login_remember_me"';
	if(isset($_POST['_nodesforum_login_remember_me']))
	{echo ' checked="checked"';}
	echo ' /></td></tr>
		</table>
		<input type="submit" name="_nodesforum_login" value="login" />
		</form>
		<br />
		<a href="?_nodesforum_register">register</a><br />
		<a href="?_nodesforum_forgot_password">forgot your password?</a>';
}



echo '</div></td></tr></table></div>';


?>
