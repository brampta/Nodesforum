<?php


echo '<div style="height:4px;"><!-- --></div><div style="width:100%;"><table class="class_nodesforum_bgcolor3" style="width:100%;"><tr><td class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner">';



if($_nodesforum_chpass_goodkey==0)
{echo '<img src="'.$_nodesforum_warn_icon.'" style="vertical-align:text-bottom;border:none;" /> error this key is not found in the database. if you have requested to change your password more than 24 hours again then it might be expired.<br />';}
else if($_nodesforum_chpass_goodkey==1)
{
		{echo 'Hello, '.htmlspecialchars($_nodesforum_val_remember_public_name).'. As you have requested it, we have reset your password and emailed it to your email address, '.htmlspecialchars($_GET['em']).'. Once you have logged in with your new password you will be able to change your password to something that you can remember from the profile options page if you want. Keep in mind that the administrators of your email could potentially read your email, so thats why its also safer to change your password once you will have logged in, but that is up to you.<br />';}
}


echo '</div></td></tr></table></div>';


?>
