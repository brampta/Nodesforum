<?php



$addslashed_move_node=_nodesforum_my_custom_addslashes($_GET['_nodesforum_move']);
//read info about post or folder to move
$result = mysql_query("SELECT containing_folder_or_post, title, creator_uniqueID, ancestry, folder_or_post, skeleton, deletion_time FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts WHERE fapID = '$addslashed_move_node'");
while($row = mysql_fetch_array($result))
{
    $_nodesforum_move_title=$row['title'];
    $_nodesforum_move_creator_uniqueID=$row['creator_uniqueID'];
    $_nodesforum_move_ancestry=$row['ancestry'];
    $_nodesforum_move_folder_or_post=$row['folder_or_post'];
    $_nodesforum_move_from=_nodesforum_make_ancestryz($_nodesforum_move_ancestry);
    $_nodesforum_move_skeleton=$row['skeleton'];
    $_nodesforum_move_deletion_time=$row['deletion_time'];

    if($_GET['_nodesforum_node']!=substr($row['containing_folder_or_post'],1) || ($row['folder_or_post']==2 && substr($row['containing_folder_or_post'],0,1)=='p'))
    {die('error');}
}





?>
