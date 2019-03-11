<?php

echo '<div style="height:4px;"><!-- --></div><div style="width:100%;"><table class="class_nodesforum_bgcolor3" style="width:100%;"><tr><td class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner">';

if($_nodesforum_val_suxxess==1)
{echo 'Thank you '.$_nodesforum_val_remember_public_name.'. Your email has now been successfully validated and you are logged in as '.$_nodesforum_val_remember_email.'.<br />';}
else
{
	echo 'nothing to validate.';
}

echo '</div></td></tr></table></div>';


?>
