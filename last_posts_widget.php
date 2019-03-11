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



$_nodesforum_lpw_elrezulto = '';
$_nodesforum_lpw_cache_url = $_nodesforum_path_from_here_to_nodesforum_folder . 'cache/lpw_cache_' . $_nodesforum_db_table_name_modifier . '_' . $_nodesforum_lpw_widget_instance_cache_number . '.cache';
$_nodesforum_lpw_use_cache = 0;
if (@filemtime($_nodesforum_lpw_cache_url) && @filemtime($_nodesforum_lpw_cache_url) > (time() - ($_nodesforum_lpw_cache_time_in_minutes * 60)))
{
    $_nodesforum_lpw_use_cache = 1;
    $_nodesforum_lpw_elrezulto = file_get_contents($_nodesforum_lpw_cache_url);
}

if ($_nodesforum_conn_to_db_in_script != 'no' && ($_nodesforum_lpw_use_cache == 0 || $_nodesforum_skip_db_conn_if_cache != 'yes'))
{
    $conn = mysql_connect($_nodesforum_db_servername, $_nodesforum_db_username, $_nodesforum_db_password);
    mysql_select_db($_nodesforum_db_name, $conn);
}

if ($_nodesforum_select_db_in_script != 'no' && ($_nodesforum_lpw_use_cache == 0 || $_nodesforum_skip_db_select_if_cache != 'yes'))
{
    $conn = mysql_connect($_nodesforum_db_servername, $_nodesforum_db_username, $_nodesforum_db_password);
    mysql_select_db($_nodesforum_db_name, $conn);
}


if ($_nodesforum_lpw_use_cache == 0)
{

    function bb_less_prev($bb_string, $maxlen)
    {
        $rebbi = '';
        $inputting = 1;
        $readinghead = 0;
        $strlen = mb_strlen($bb_string, 'UTF-8');
        $last_letter = 'none';
        $newlen = 0;
        $maxturns = 10000;
        $counturns = 0;
        while ($readinghead < $strlen && $newlen < $maxlen + 1 && $counturns < $maxturns)
        {
            $counturns++;

            if ($newlen < $maxlen)
            {
                $thisletter = mb_substr($bb_string, $readinghead, 1, 'UTF-8');
                //echo '.'.$thisletter.' ';
                if ($thisletter == '[')
                {
                    $inputting = 0;
                    if ($last_letter != ' ')
                    {
                        $rebbi = $rebbi . ' ';
                        $last_letter = ' ';
                        $newlen++;
                    }
                }

                if ($inputting == 1)
                {
                    $rebbi = $rebbi . $thisletter;
                    $last_letter = $thisletter;
                    $newlen++;
                }

                if ($thisletter == ']')
                { $inputting = 1; }

                $readinghead++;
            } else
            {
                $rebbi = $rebbi . '...';
                $newlen++;
            }
        }
        return $rebbi;
    }

    $order = 'creation_time DESC';
    if ($_nodesforum_lpw_include_replies == 1)
    { $order = 'last_post_time DESC'; }
    $_nodesforum_elqueriosss = "SELECT fapID, title, post, last_post_postID FROM " . $_nodesforum_db_table_name_modifier . "_nodesforum_folders_and_posts WHERE folder_or_post = 2 && containing_folder_or_post LIKE 'f%' && deletion_time = 0 ORDER BY $order LIMIT 0, $_nodesforum_lpw_howmany";
//echo htmlspecialchars($_nodesforum_elqueriosss) . '<br />';
    $_nodesforum_result = mysql_query($_nodesforum_elqueriosss);
    $countrezu = 0;
    while ($_nodesforum_row = mysql_fetch_array($_nodesforum_result))
    {
        $countrezu++;

        $_nodesforum_lastposts[$countrezu]['fapID'] = $_nodesforum_row['fapID'];
        $_nodesforum_lastposts[$countrezu]['title'] = $_nodesforum_row['title'];
        $_nodesforum_lastposts[$countrezu]['post'] = $_nodesforum_row['post'];
        $_nodesforum_lastposts[$countrezu]['last_post_postID'] = $_nodesforum_row['last_post_postID'];
        if ($_nodesforum_row['last_post_postID'] != 0)
        { $_nodesforum_lastposts_toget[$_nodesforum_row['last_post_postID']] = 'get'; }
    }

    if ($_nodesforum_lpw_include_replies == 1 && $_nodesforum_lastposts_toget)
    {
        $foriner = '';
        $countinforin = 0;
        foreach ($_nodesforum_lastposts_toget as $_nodesforum_key => $_nodesforum_value)
        {
            $countinforin++;
            if ($countinforin > 1)
            { $foriner = $foriner . ', '; }
            $foriner = $foriner . $_nodesforum_key;
        }

        $_nodesforum_elqueriosss = "SELECT fapID, post FROM " . $_nodesforum_db_table_name_modifier . "_nodesforum_folders_and_posts WHERE fapID IN ($foriner)";
        //echo htmlspecialchars($_nodesforum_elqueriosss) . '<br />';
        $_nodesforum_result = mysql_query($_nodesforum_elqueriosss);
        while ($_nodesforum_row = mysql_fetch_array($_nodesforum_result))
        { $_nodesforum_lastposts_lastpostpost[$_nodesforum_row['fapID']] = $_nodesforum_row['post']; }
    }

    foreach ($_nodesforum_lastposts as $_nodesforum_key => $_nodesforum_value)
    {
        $titlelen = mb_strlen($_nodesforum_value['title'], 'UTF-8');
        $showtitle = $_nodesforum_value['title'];
        if ($titlelen > $_nodesforum_lpw_max_titlelen)
        { $showtitle = mb_substr($_nodesforum_value['title'], 0, $_nodesforum_lpw_max_titlelen, 'UTF-8') . '...'; }

        $_nodesforum_lastposts_elpost = $_nodesforum_value['post'];
        $_nodesforum_lastposts_ellink = $_nodesforum_path_from_here_to_nodesforum_HTML . '?_nodesforum_node=' . $_nodesforum_value['fapID'];
        if ($_nodesforum_lpw_include_replies == 1 && $_nodesforum_value['last_post_postID'] != 0)
        {
            $_nodesforum_lastposts_elpost = $_nodesforum_lastposts_lastpostpost[$_nodesforum_value['last_post_postID']];
            $_nodesforum_lastposts_ellink = $_nodesforum_path_from_here_to_nodesforum_HTML . '?_nodesforum_permalink=' . $_nodesforum_value['last_post_postID'] . '#_nodesforum_anchor_' . $_nodesforum_value['last_post_postID'];
        }

        //overview title
        $_nodesforum_lpw_elrezulto = $_nodesforum_lpw_elrezulto . '<div ' . $_nodesforum_lpw_title_css . '><a href="' . $_nodesforum_lastposts_ellink . '" target="' . $_nodesforum_lpw_link_target . '">' . htmlspecialchars($showtitle) . '</a></div>';
        //overview post
        $_nodesforum_lpw_elrezulto = $_nodesforum_lpw_elrezulto . '<div ' . $_nodesforum_lpw_post_css . '>' . bb_less_prev(strip_tags($_nodesforum_lastposts_elpost), $_nodesforum_lpw_max_post) . '</div>';
    }







//write to cache
    file_put_contents($_nodesforum_lpw_cache_url, $_nodesforum_lpw_elrezulto);
}




//output
echo $_nodesforum_lpw_elrezulto;



if ($_nodesforum_disconn_from_db_after_script != 'no' && ($_nodesforum_lpw_use_cache == 0 || $_nodesforum_skip_db_disconn_if_cache != 'yes'))
{
    mysql_close($conn);
}
?>
