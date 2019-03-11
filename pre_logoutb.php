<?php


unset($_SESSION[$_nodesforum_external_user_system_uniqueID_session_name]);
unset($_SESSION[$_nodesforum_external_user_system_loginusername_session_name]);
if(isset($_COOKIE[$_nodesforum_db_table_name_modifier.'_nodesforum_remember_token']))
{setcookie($_nodesforum_db_table_name_modifier."_nodesforum_remember_token", "", time()-3600);}
$_nodesforum_logout_suxxess=1;


?>
