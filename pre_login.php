<?php




if(isset($_POST['_nodesforum_resendval']))
{
	$_nodesforum_title='resend validation email - '.$_nodesforum_forum_name;
	$_nodesforum_youarehere='<img src="'.$_nodesforum_home_icon.'" style="vertical-align:text-bottom;border:none;" /> <a href="?">root</a> => <img src="'.$_nodesforum_lock_icon.'" style="vertical-align:text-bottom;border:none;" /> <a href="?_nodesforum_login">login</a> => <img src="'.$_nodesforum_home_icon.'" style="vertical-align:text-bottom;border:none;" /> resend validation email';
}
else
{
	$_nodesforum_title='login - '.$_nodesforum_forum_name;
	$_nodesforum_youarehere='<img src="'.$_nodesforum_home_icon.'" style="vertical-align:text-bottom;border:none;" /> <a href="?">root</a> => <img src="'.$_nodesforum_lock_icon.'" style="vertical-align:text-bottom;border:none;" /> login';
}




?>
