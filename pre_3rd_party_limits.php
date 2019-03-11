<?php


$the_tag_name=_nodesforum_my_custom_addslashes($_POST['_nodesforum_set_new_3rd_party_tag_limit_tag_name']);
$the_limit_for_users=_nodesforum_my_custom_addslashes($_POST['_nodesforum_set_new_3rd_party_tag_limit_user']);
$the_limit_for_guests=_nodesforum_my_custom_addslashes($_POST['_nodesforum_set_new_3rd_party_tag_limit_guest']);


$already_have_a_setting_for_this_tag=0;
$myquery="SELECT tagID FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_3rd_party_tag_limits WHERE tag_name = '$the_tag_name'";
$result = mysql_query($myquery);
while($row = mysql_fetch_array($result))
{
	$already_have_a_setting_for_this_tag=1;
	$myquery="UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_3rd_party_tag_limits SET user_limit = '$the_limit_for_users' WHERE tagID = '$row[tagID]'";
	mysql_query($myquery);
	$myquery="UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_3rd_party_tag_limits SET guest_limit = '$the_limit_for_guests' WHERE tagID = '$row[tagID]'";
	mysql_query($myquery);
}

if($already_have_a_setting_for_this_tag==0)
{
	$myquery="INSERT INTO ".$_nodesforum_db_table_name_modifier."_nodesforum_3rd_party_tag_limits (tag_name, user_limit, guest_limit) VALUES ('$the_tag_name', '$the_limit_for_users', '$the_limit_for_guests')";
	mysql_query($myquery);
}



//clear 3rd party tag limits cache
$limits_cache_url=$_nodesforum_code_path.'cache/3rd_party_limits.php';
unlink($limits_cache_url);



//update limits from array
$_nodesforum_3rd_party_tag_limits_specific_has_data[$the_tag_name]=1;
$_nodesforum_3rd_party_tag_limits_user_specific[$the_tag_name]=$the_limit_for_users;
$_nodesforum_3rd_party_tag_limits_guest_specific[$the_tag_name]=$the_limit_for_guests;




?>
