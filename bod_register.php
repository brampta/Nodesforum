<?php



echo '<div style="height:4px;"><!-- --></div><div style="width:100%;"><table class="class_nodesforum_bgcolor3" style="width:100%;"><tr><td class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner">';



if($_nodesforum_email_invalid==1)
{echo '<img src="'.$_nodesforum_warn_icon.'" style="vertical-align:text-bottom;border:none;" /> You must use a valid email address to register.<br />';}
if($_nodesforum_email_taken==1 && $_nodesforum_img_ver_invalid==0)
{echo '<img src="'.$_nodesforum_warn_icon.'" style="vertical-align:text-bottom;border:none;" /> The email you have chosen is already registered. If this is you please use the <a href="?_nodesforum_login">login page</a> to either login or have your password sent back to your email.<br />';}
if($_nodesforum_password_too_short==1)
{echo '<img src="'.$_nodesforum_warn_icon.'" style="vertical-align:text-bottom;border:none;" /> The password you have chosen is only '.strlen($_POST['_nodesforum_password']).' characters long. You must use a password of at least '.$_nodesforum_minimum_password_length.' characters long.<br />';}
if($_nodesforum_public_name_invalid==1)
{echo '<img src="'.$_nodesforum_warn_icon.'" style="vertical-align:text-bottom;border:none;" /> You must chose a public name.<br />';}
if($_nodesforum_public_name_taken==1)
{echo '<img src="'.$_nodesforum_warn_icon.'" style="vertical-align:text-bottom;border:none;" /> The public name you have chosen is already in use. Please chose another.<br />';}
if($_nodesforum_img_ver_invalid==1)
{echo '<img src="'.$_nodesforum_warn_icon.'" style="vertical-align:text-bottom;border:none;" /> The the number that you have written in the box for the image verification did not match the number shown in the picture.<br />';}
if($_nodesforum_register_suxxess_and_validated==1)
{echo 'Thank you for registering '.htmlspecialchars($_POST['_nodesforum_public_name']).'. You are now logged in as '.$_SESSION[$_nodesforum_external_user_system_loginusername_session_name].'.';}
else if($_nodesforum_register_suxxess==1)
{echo 'Thank you for registering '.htmlspecialchars($_POST['_nodesforum_public_name']).'. An email has been sent to '.$_POST['_nodesforum_email'].'. Please go click the link contained in this email to complete the registration process. Also please take note that the registration will be cancelled if you dont validate your email in the next 24 hours.';}
else
{
	echo '<h4 style="margin:0px;">register:</h4>
		<form action="?_nodesforum_register" method="post">
		<table class="class_nodesforum_bgcolorinherit">
		<tr><td>email:</td><td><input type="text" name="_nodesforum_email" value="'.$_POST['_nodesforum_email'].'" /></td></tr>
		<tr><td>password:</td><td><input type="password" name="_nodesforum_password" value="'.$_POST['_nodesforum_password'].'" /></td></tr>
		<tr><td>retype password:</td><td><input type="password" name="_nodesforum_password2" value="'.$_POST['_nodesforum_password2'].'" /></td></tr>
		<tr><td>public name:</td><td><input type="text" name="_nodesforum_public_name" value="'.$_POST['_nodesforum_public_name'].'" /></td></tr>';
	if($_nodesforum_image_verification_on_registration=='yes')
	{echo '
		<tr><td>image verification:</td><td><img src="'.$_nodesforum_code_path.'image_verification.php?name=registro&bgcolor='.urlencode($_nodesforum_background_color1).'&color='.urlencode($_nodesforum_text_color).'" /></td></tr>
		<tr><td>retype the number in the image verification:</td><td><input type="text" name="_nodesforum_numba" /></td></tr>';}
	echo '
		</table>
		<input type="submit" name="_nodesforum_register" value="register" />
		</form>';
}



echo '</div></td></tr></table></div>';

?>
