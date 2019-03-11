<?php

//------------------------------Emulate register_globals off
function unregister_GLOBALS()
{
    if (!ini_get('register_globals'))
    { return; }
    // Might want to change this perhaps to a nicer error
    if (isset($_REQUEST['GLOBALS']) || isset($_FILES['GLOBALS']))
    { die('GLOBALS overwrite attempt detected'); }
    // Variables that shouldn't be unset
    $noUnset = array('GLOBALS', '_GET', '_POST', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');
    $input = array_merge($_GET, $_POST, $_COOKIE, $_SERVER, $_ENV, $_FILES, isset($_SESSION) && is_array($_SESSION) ? $_SESSION : array());
    foreach ($input as $k => $v)
    {
        if (!in_array($k, $noUnset) && isset($GLOBALS[$k]))
        { unset($GLOBALS[$k]); }
    }
}

unregister_GLOBALS();

//------------------------------Emulate register_globals off


function nodesforum_sanitize_nodesforum_code_path($include_path)
{
    if (stripos($include_path, 'http://') !== false || stripos($include_path, 'https://') !== false || stripos($include_path, 'ftp://') !== false)
    { die('Remote File Inclusion attempt detected.'); } else
    { return $include_path; }
}

include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_path_from_here_to_nodesforum_folder . 'config.php'));

if ($_nodesforum_conn_to_db_in_script != 'no')
{
    $conn = mysql_connect($_nodesforum_db_servername, $_nodesforum_db_username, $_nodesforum_db_password);
    mysql_select_db($_nodesforum_db_name, $conn);
}


$addslashed_uniqueID = mysql_real_escape_string($_nodesforum_uniqueID_of_user_to_delete);

//erase user_data
$result = mysql_query("SELECT avatar, signature FROM " . $_nodesforum_db_table_name_modifier . "_nodesforum_user_data WHERE uniqueID = '$addslashed_uniqueID'");
while ($row = mysql_fetch_array($result))
{
    if ($row['avatar'] != '')
    {
        //erase pic
        //read time of last glob
        $lastpathloadtimefile = fopen($_nodesforum_path_from_here_to_nodesforum_folder . 'images/lastpathloadtimefile', 'r');
        $lastglobtime = fread($lastpathloadtimefile, 9999);
        fclose($lastpathloadtimefile);


        //write time of last glob
        $lastpathloadtimefile = fopen($_nodesforum_path_from_here_to_nodesforum_folder . 'images/lastpathloadtimefile', 'w');
        fwrite($lastpathloadtimefile, $nowtime);
        fclose($lastpathloadtimefile);
        //get current path
        $_nodesforum_mysterypath = glob($_nodesforum_path_from_here_to_nodesforum_folder . 'images/*');
        $_nodesforum_mysterypath = $_nodesforum_mysterypath[0];



        if ($lastglobtime < ($nowtime - 15))
        {
            //if last glob older than x seconds change path
            $newmystery = $_nodesforum_path_from_here_to_nodesforum_folder . 'images/_' . rand(111111, 999999);
            rename($_nodesforum_mysterypath, $newmystery);
            $_nodesforum_mysterypath = $newmystery;
        }

        $this_user_pic = $_nodesforum_mysterypath . '/avatars/' . $row['avatar'];
        //echo 'will delete: '.$this_user_pic.'<br />';
        @chmod($this_user_pic, 777);
        unlink($this_user_pic);
    }
    if ($row['signature'] != '' && $row['signature'] != '0')
    {
        //erase signature
        mysql_query("DELETE FROM " . $_nodesforum_db_table_name_modifier . "_nodesforum_folders_and_posts WHERE fapID = '$row[signature]'");
    }
    //delete user_data row
    mysql_query("DELETE FROM " . $_nodesforum_db_table_name_modifier . "_nodesforum_user_data WHERE uniqueID = '$addslashed_uniqueID'");
}



//erase from folders_and_posts
mysql_query("UPDATE " . $_nodesforum_db_table_name_modifier . "_nodesforum_folders_and_posts SET containing_folder_or_post = 'fu" . $_nodesforum_uniqueID_of_deleted_user . "' WHERE containing_folder_or_post = 'fu" . $addslashed_uniqueID . "'");
mysql_query("UPDATE " . $_nodesforum_db_table_name_modifier . "_nodesforum_folders_and_posts SET creator_uniqueID = '" . $_nodesforum_uniqueID_of_deleted_user . "' WHERE creator_uniqueID = '" . $addslashed_uniqueID . "'");
mysql_query("UPDATE " . $_nodesforum_db_table_name_modifier . "_nodesforum_folders_and_posts SET ancestry = REPLACE(ancestry, '" . $_nodesforum_ancestry_separator . "u" . $addslashed_uniqueID . $_nodesforum_ancestry_separator . "', '" . $_nodesforum_ancestry_separator . "u" . $_nodesforum_uniqueID_of_deleted_user . $_nodesforum_ancestry_separator . "')");
mysql_query("UPDATE " . $_nodesforum_db_table_name_modifier . "_nodesforum_folders_and_posts SET last_post_user_uniqueID = '" . $_nodesforum_uniqueID_of_deleted_user . "' WHERE last_post_user_uniqueID = '" . $addslashed_uniqueID . "'");



//erase from mods
mysql_query("DELETE FROM " . $_nodesforum_db_table_name_modifier . "_nodesforum_mods WHERE mod_uniqueID = '$addslashed_uniqueID'");
mysql_query("UPDATE " . $_nodesforum_db_table_name_modifier . "_nodesforum_mods SET folderID = 'u" . $_nodesforum_uniqueID_of_deleted_user . "' WHERE folderID = 'u" . $addslashed_uniqueID . "'");




//erase from mods_log
mysql_query("UPDATE " . $_nodesforum_db_table_name_modifier . "_nodesforum_mods_log SET fapID = 'u" . $_nodesforum_uniqueID_of_deleted_user . "' WHERE fapID = 'u" . $addslashed_uniqueID . "'");
mysql_query("UPDATE " . $_nodesforum_db_table_name_modifier . "_nodesforum_mods_log SET ancestry = REPLACE(ancestry, '" . $_nodesforum_ancestry_separator . "u" . $addslashed_uniqueID . $_nodesforum_ancestry_separator . "', '" . $_nodesforum_ancestry_separator . "u" . $_nodesforum_uniqueID_of_deleted_user . $_nodesforum_ancestry_separator . "')");
mysql_query("UPDATE " . $_nodesforum_db_table_name_modifier . "_nodesforum_mods_log SET mod_uniqueID = '" . $_nodesforum_uniqueID_of_deleted_user . "' WHERE mod_uniqueID = '" . $addslashed_uniqueID . "'");
mysql_query("UPDATE " . $_nodesforum_db_table_name_modifier . "_nodesforum_mods_log SET moded_uniqueID = '" . $_nodesforum_uniqueID_of_deleted_user . "' WHERE moded_uniqueID = '" . $addslashed_uniqueID . "'");
mysql_query("UPDATE " . $_nodesforum_db_table_name_modifier . "_nodesforum_mods_log SET authoritative_folderID = 'u" . $_nodesforum_uniqueID_of_deleted_user . "' WHERE authoritative_folderID = 'u" . $addslashed_uniqueID . "'");






if ($_nodesforum_disconn_from_db_after_script != 'no')
{
    mysql_close($conn);
}
?>
