<?php



echo '<div style="height:4px;"><!-- --></div><div style="width:100%;"><table class="class_nodesforum_bgcolor3" style="width:100%;"><tr><td class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner">';


if($_nodesforum_logout_suxxess==1)
{echo 'Thank you for visiting '.$_nodesforum_forum_name.' '.$_SESSION[$_nodesforum_external_user_system_username_session_var_name].'. You are now logged out.';}
else
{
	echo '<h4 style="margin:0px;">logout:</h4>
		<form action="?_nodesforum_logout" method="post">
		<input type="submit" name="_nodesforum_logout" value="logout" />
		</form>';
}


echo '</div></td></tr></table></div>';





?>
