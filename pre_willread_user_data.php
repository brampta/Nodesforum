<?php

$hasuserdata=0;
$my_uniqueID=$_SESSION[$_nodesforum_external_user_system_uniqueID_session_name];

$read_p_part='';
foreach($_nodesforum_risky_bbcode_title as $key => $value)
{$read_p_part=$read_p_part.', '.$key;}

$myquery="SELECT avatar, signature, allow_posting_on_personal_page $read_p_part FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_user_data WHERE uniqueID = '".mysql_real_escape_string($my_uniqueID)."'";
$result = mysql_query($myquery);
while($row = mysql_fetch_array($result))
{
    $hasuserdata=1;
    $_nodesforum_remember_avatar=$row['avatar'];
    $_nodesforum_remember_signature=$row['signature'];
    $_nodesforum_remember_allow_posting_on_personal_page=$row['allow_posting_on_personal_page'];
    foreach($_nodesforum_risky_bbcode_title as $key => $value)
    {if($my_uniqueID==$_nodesforum_main_mod_uniqueID){$_nodesforum_display_pn[$key]=1;}else{$_nodesforum_display_pn[$key]=$row[$key];}}
    $_nodesforum_p_inf_str=implode('!',$_nodesforum_display_pn);
}
if($hasuserdata==0)
{
    $_nodesforum_remember_avatar='';
    $_nodesforum_remember_signature=0;
    $_nodesforum_remember_allow_posting_on_personal_page=0;
}


if($_nodesforum_remember_signature==0)
{
    $result = mysql_query("SELECT fapID FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts WHERE containing_folder_or_post = 's".mysql_real_escape_string($my_uniqueID)."'");
    while($row = mysql_fetch_array($result))
    {
        $_nodesforum_remember_signature=$row['fapID'];
        if($hasuserdata==0)
        {mysql_query("INSERT INTO ".$_nodesforum_db_table_name_modifier."_nodesforum_user_data (uniqueID, signature) VALUES ('".mysql_real_escape_string($my_uniqueID)."', '$row[fapID]')");}
        else
        {mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_user_data SET signature = '$row[fapID]' WHERE uniqueID = ".mysql_real_escape_string($my_uniqueID));}
    }
}



if($_nodesforum_remember_signature!=0)
{
    $result2 = mysql_query("SELECT post, disable_auto_smileys, disable_auto_links FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts WHERE fapID = '$_nodesforum_remember_signature'");
    while($row2 = mysql_fetch_array($result2))
    {
        $_nodesforum_remember_signature_post=$row2['post'];
        $_nodesforum_remember_signature_post_disable_auto_smileys=$row2['disable_auto_smileys'];
        $_nodesforum_remember_signature_post_disable_auto_links=$row2['disable_auto_links'];
    }
}


$_nodesforum_title='forum options - '.$_nodesforum_forum_name;
$_nodesforum_youarehere='<img src="'.$_nodesforum_home_icon.'" style="vertical-align:text-bottom;border:none;" /> <a href="?">root</a> => <img src="'.$_nodesforum_tool_icon.'" style="vertical-align:text-bottom;border:none;" /> forum options';


?>
