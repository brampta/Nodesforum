<?php

echo '<div style="height:4px;"><!-- --></div><div style="width:100%;"><table class="class_nodesforum_bgcolor3" style="width:100%;"><tr><td class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner">';


if($_nodesforum_val2_suxxess==1)
{echo 'Thank you '.$_nodesforum_val2_remember_public_name.'. Your new email has now been successfully validated and is now the email associated to your account. This will also be the email that you will need to use to login.<br />';}
else if($_nodesforum_val2_already_taken==1)
{echo '<img src="'.$_nodesforum_warn_icon.'" style="vertical-align:text-bottom;border:none;" /> The email address that you are trying to validate ('.$_nodesforum_val2_remember_email.') is already associated with an account. Please try another.<br />';}
else
{
	echo 'nothing to validate.';
}



echo '</div></td></tr></table></div>';




?>
