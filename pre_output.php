<?php

//error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', 0);
$json_data=array(); //for json output format $_GET['format']='json'


if ($_nodesforum_use_external_user_system == 'no')
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}

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




function a_function_that_is_only_in_the_pre_output()
{
    //do nothing....
}


function nodesforum_sanitize_nodesforum_code_path($include_path)
{
    if (stripos($include_path, 'http://') !== false || stripos($include_path, 'https://') !== false || stripos($include_path, 'ftp://') !== false)
    { die('Remote File Inclusion attempt detected.'); } else
    { return $include_path; }
}

$nowtime = time();



include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path . 'risky_powers_array.php'));

function _nodesforum_my_custom_addslashes($text_to_slash)
{
    if ($GLOBALS['_nodesforum_magic_quotes_on_or_off'] == 'on')
    { $text_to_slash = stripslashes($text_to_slash); }
    $text_to_slash = mysql_real_escape_string($text_to_slash);
    return $text_to_slash;
}

function _nodesforum_my_custom_stripslashes($text_to_unslash)
{
    if ($GLOBALS['_nodesforum_magic_quotes_on_or_off'] == 'on')
    { $text_to_unslash = stripslashes($text_to_unslash); }
    return $text_to_unslash;
}

$_nodesforum_bbcode_escape_char = '~';

function _nodesforum_different_escape_certain_chars($string, $chars_to_escape)
{
    global $_nodesforum_bbcode_escape_char;
    $string = str_replace($_nodesforum_bbcode_escape_char, $_nodesforum_bbcode_escape_char . $_nodesforum_bbcode_escape_char, $string);
    $exploded_chars_to_escape = str_split($chars_to_escape);
    foreach ($exploded_chars_to_escape as $key => $value)
    {
        if ($value != $_nodesforum_bbcode_escape_char) $string = str_replace($value, $_nodesforum_bbcode_escape_char . $value, $string);
    }
    return $string;
}

function _nodesforum_different_unescape_certain_chars($string)
{
    global $_nodesforum_bbcode_escape_char;
    $pattern = '/' . $_nodesforum_bbcode_escape_char . '(.{1})/is';
    $replacement = '\\1';
    $string = preg_replace($pattern, $replacement, $string);
    return $string;
}

//-------------IMAGES MYSTERY FOLDER
//read time of last glob
$lastpathloadtimefile = @fopen($_nodesforum_code_path . 'images/lastpathloadtimefile', 'r');
$lastglobtime = @fread($lastpathloadtimefile, 9999);
@fclose($lastpathloadtimefile);
//read time of last rotation
$lastpathrotationtimefile = @fopen($_nodesforum_code_path . 'images/lastpathrotationtimefile', 'r');
$lastpathrotationtime = @fread($lastpathrotationtimefile, 9999);
@fclose($lastpathrotationtimefile);
//write time of last glob
$lastpathloadtimefile = @fopen($_nodesforum_code_path . 'images/lastpathloadtimefile', 'w');
if ($lastpathloadtimefile === false)
{ echo '<span style="padding:4px;margin:4px;color:#000000;background-color:#FFFFFF;border-style:solid;border-width:1px;border-color:#000000;"><span style="color:red;">error!!</span> unable to write to images/lastpathloadtimefile please set the permissions to allow the system to write in the "images" folder.</span><br />'; }
fwrite($lastpathloadtimefile, $nowtime);
fclose($lastpathloadtimefile);
//get current path
$_nodesforum_mysterypath = glob($_nodesforum_code_path . 'images/*');
$_nodesforum_mysterypath = $_nodesforum_mysterypath[0];
if ($lastglobtime < ($nowtime - 15) && $lastpathrotationtime < ($nowtime - (12 * 3600)))
{
    //if last glob older than x seconds change path
    $newmystery = $_nodesforum_code_path . 'images/_' . rand(111111, 999999);
    rename($_nodesforum_mysterypath, $newmystery);
    $_nodesforum_mysterypath = $newmystery;
    //write time of last rotation
    $lastpathrotationtimefile = @fopen($_nodesforum_code_path . 'images/lastpathrotationtimefile', 'w');
    fwrite($lastpathrotationtimefile, $nowtime);
    fclose($lastpathrotationtimefile);
}




$_icons_path=$_nodesforum_code_path.'images_repo';
$_nodesforum_lock_icon = $_icons_path . '/minipics/lock.gif';
$_nodesforum_home_icon = $_icons_path . '/minipics/home.gif';
$_nodesforum_tool_icon = $_icons_path . '/minipics/tool.gif';
$_nodesforum_folder_icon = $_icons_path . '/minipics/folder.gif';
$_nodesforum_post_icon = $_icons_path . '/minipics/post.gif';
$_nodesforum_delete_icon = $_icons_path . '/minipics/no.gif';
$_nodesforum_audit_icon = $_icons_path . '/minipics/yes.gif';
$_nodesforum_unaudit_icon = $_icons_path . '/minipics/no2.gif';
$_nodesforum_warn_icon = $_icons_path . '/minipics/warn.gif';
$_nodesforum_userhome_icon = $_icons_path . '/minipics/userhome.gif';
$_nodesforum_userhome_grey_icon = $_icons_path . '/minipics/userhome_grey.gif';
$_nodesforum_reply_icon = $_icons_path . '/minipics/reply.gif';
$_nodesforum_history_icon = $_icons_path . '/minipics/history.gif';
$_nodesforum_move_icon = $_icons_path . '/minipics/move.gif';
$_nodesforum_restore_icon = $_icons_path . '/minipics/restore.gif';
$_nodesforum_no2_icon = $_icons_path . '/minipics/no2.gif';
$_nodesforum_power_icon = $_icons_path . '/minipics/power.gif';
$_nodesforum_clip_icon = $_icons_path . '/minipics/clip.gif';
$_nodesforum_declip_icon = $_icons_path . '/minipics/declip.gif';
$_nodesforum_up_icon = $_icons_path . '/minipics/up.gif';
$_nodesforum_down_icon = $_icons_path . '/minipics/down.gif';
$_nodesforum_skeleton_icon = $_icons_path . '/minipics/skeleton.gif';
$_nodesforum_magnif_icon = $_icons_path . '/minipics/magnif.gif';

function unicode_wordwrap($string, $maxlen=10)
{
    if ($maxlen < 10)
    { $maxlen = 10; }
    $exploded_string = explode(' ', $string);
    $rebuiltstring = '';
    $countem = 0;
    foreach ($exploded_string as $key => $value)
    {
        $countem++;
        if ($countem > 1)
        { $rebuiltstring = $rebuiltstring . ' '; }
        $chunklen = mb_strlen($value, 'UTF-8');
        if ($chunklen > $maxlen)
        {
            $rebuilt_chunk = '';
            $neededturns = ceil($chunklen / $maxlen);
            $countrunzzzz = 0;
            while ($countrunzzzz < $neededturns)
            {
                $countrunzzzz++;
                $startat = ($countrunzzzz - 1) * $maxlen;
                if ($countrunzzzz > 1)
                { $rebuilt_chunk = $rebuilt_chunk . '&#8203;'; }
                $rebuilt_chunk = $rebuilt_chunk . mb_substr($value, $startat, $maxlen, 'UTF-8');
            }
            $rebuiltstring = $rebuiltstring . $rebuilt_chunk;
        } else
        { $rebuiltstring = $rebuiltstring . $value; }
    }
    return $rebuiltstring;
}

if (!isset($_nodesforum_max_title_length))
{ $_nodesforum_max_title_length = 100; }

function _nodesforum_display_title($string, $max_len, $apply_maxlen=true)
{
    global $_nodesforum_max_title_length;
    $final_string = unicode_wordwrap($string, $max_len);

    $stringlen = mb_strlen($final_string);
    if ($stringlen > $_nodesforum_max_title_length && $apply_maxlen === true)
    { $final_string = '<acronym title="' . htmlspecialchars($string) . '">' . str_replace('<', '&#60;', str_replace('>', '&#62;', mb_substr($final_string, 0, $_nodesforum_max_title_length))) . '...</acronym>'; } else
    { $final_string = str_replace('<', '&#60;', str_replace('>', '&#62;', $final_string)); }

    return $final_string;
}

//function _nodesforum_display_title($string,$max_len)
//{
//	$exploded_string=explode(' ',$string);
//	foreach($exploded_string as $key => $value)
//	{
//		if(strlen($value)>$max_len)
//		{$exploded_string[$key]='<acronym title="'.htmlspecialchars($value).'">'.htmlspecialchars(substr($value,0,($max_len-3)/2)).'...'.htmlspecialchars(substr($value,strlen($value)-(($max_len-3)/2))).'</acronym>';}
//		else
//		{$exploded_string[$key]=htmlspecialchars($value);}
//	}
//	$string=implode(' ',$exploded_string);
//	return $string;
//}


function nodesforum_send_mail($to, $toname, $from, $fromname, $subject, $message_html, $message_text){
    global $_nodesforum_mailer, $_nodesforum_mailer_custom_file;
    if($_nodesforum_mailer=='php'){
        $headers = "From: ".$from;
        return mail($to,$subject,$message_html,$headers);
    }elseif($_nodesforum_mailer=='custom'){
        if(file_exists($_nodesforum_mailer_custom_file)){
            include_once $_nodesforum_mailer_custom_file;
            return send_mail_custom($to, $toname, $from, $fromname, $subject, $message_html, $message_text);
        }
    }
}

include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path . 'bbcode.php'));









$_nodesforum_forum_name_the_or_not = '';
if ($_nodesforum_forum_name_at_or_at_the == 'at the')
{ $_nodesforum_forum_name_the_or_not = ' the'; }






$_nodesforum_db_isconn = 0;
$conn = null;

function _nodesforum_db_conn()
{
    global $_nodesforum_db_isconn;
    global $conn;
    if ($_nodesforum_db_isconn == 0)
    {
        global $_nodesforum_db_servername;
        global $_nodesforum_db_username;
        global $_nodesforum_db_password;
        global $_nodesforum_db_name;
        $conn = mysql_connect($_nodesforum_db_servername, $_nodesforum_db_username, $_nodesforum_db_password);
        if (!$conn)
        { die('Error, could not connect to database: ' . mysql_error()); }
        mysql_select_db($_nodesforum_db_name, $conn);
        mysql_query("SET @@SESSION.sql_mode = ''");
        $_nodesforum_db_isconn = 1;
    }
}

include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path . '3rd_party_limits.php'));



if ($_nodesforum_use_external_user_system == 'no')
{
    //get internal user system ready if beeing used
    $_nodesforum_external_user_system_uniqueID_session_name = $_nodesforum_db_table_name_modifier . '_nodesforum_uniqueID';
    $_nodesforum_external_user_system_loginusername_session_name = $_nodesforum_db_table_name_modifier . '_nodesforum_email';

    $_nodesforum_external_user_system_table_name = $_nodesforum_db_table_name_modifier . '_nodesforum_users';
    $_nodesforum_external_user_system_user_uniqueID_rowname = 'uniqueID';
    $_nodesforum_external_user_system_publicname_rowname = 'public_name';
    $_nodesforum_external_user_system_show_registration_time = 'yes';
    $_nodesforum_external_user_system_registration_time_rowname = 'registration_time';


    $_nodesforum_external_user_system_login_link = '?_nodesforum_login';
    $_nodesforum_external_user_system_logout_link = '?_nodesforum_logout';
    $_nodesforum_external_user_system_register_link = '?_nodesforum_register';
    $_nodesforum_external_user_system_profile_options_link = '?_nodesforum_profile_options';



    if ((!isset($_SESSION[$_nodesforum_external_user_system_uniqueID_session_name]) || !isset($_SESSION[$_nodesforum_external_user_system_loginusername_session_name])) && isset($_COOKIE[$_nodesforum_db_table_name_modifier . '_nodesforum_remember_token']))
    {
        _nodesforum_db_conn();
        $explode_cookie = explode(':', $_COOKIE[$_nodesforum_db_table_name_modifier . '_nodesforum_remember_token']);
        $token = $explode_cookie[0];
        $addslashed_token = _nodesforum_my_custom_addslashes($token);
        $email_cryptkey = $explode_cookie[1];
        $addslashed_email_cryptkey = _nodesforum_my_custom_addslashes($email_cryptkey);

        $result = mysql_query("SELECT uniqueID, AES_DECRYPT(email,'$addslashed_email_cryptkey') AS decrypted_email FROM " . $_nodesforum_db_table_name_modifier . "_nodesforum_remember_tokens WHERE token = '$addslashed_token'");
        while ($row = mysql_fetch_array($result))
        {
            $_SESSION[$_nodesforum_external_user_system_uniqueID_session_name] = $row['uniqueID'];
            $_SESSION[$_nodesforum_external_user_system_loginusername_session_name] = $row['decrypted_email'];
        }
    }
}


//============CONTROLLER============//
if(isset($_GET['script'])){
	if($_GET['script']=='delete_children_of_deleted'){
		include('script_delete_children_of_deleted.php');
	}else if($_GET['script']=='update_last_posts'){
		include('script_update_last_posts.php');
	}
	die('finished executing '.htmlspecialchars($_GET['script']));
}

$_nodesforum_willread_user_data_for_forumoptionspage = 0;
if (isset($_GET['_nodesforum_login']))
{ include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path . 'pre_login.php')); } else if (isset($_GET['_nodesforum_forgot_password']))
{ include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path . 'pre_forgot_password.php')); } else if (isset($_GET['_nodesforum_reset_password']))
{ include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path . 'pre_reset_password.php')); } else if (isset($_GET['_nodesforum_logout']))
{ include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path . 'pre_logout.php')); } else if (isset($_GET['_nodesforum_register']))
{ include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path . 'pre_register.php')); } else if (isset($_GET['_nodesforum_val']))
{ include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path . 'pre_val.php')); } else if (isset($_GET['_nodesforum_val2']))
{ include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path . 'pre_val2.php')); } else if (isset($_GET['_nodesforum_profile_options']))
{ _nodesforum_db_conn(); include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path . 'pre_profile_options.php')); } else if (isset($_GET['_nodesforum_forum_options']))
{ _nodesforum_db_conn(); include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path . 'pre_forum_options.php')); } else
{ _nodesforum_db_conn(); include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path . 'pre_else.php')); }
if ($_nodesforum_willread_user_data_for_forumoptionspage == 1)
{ _nodesforum_db_conn(); include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path . 'pre_willread_user_data.php')); }





if (isset($_POST['_nodesforum_logout']))
{ include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path . 'pre_logoutb.php')); }
if (isset($_POST['_nodesforum_register']))
{ _nodesforum_db_conn(); include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path . 'pre_registerb.php')); }
if (isset($_GET['_nodesforum_val']))
{ _nodesforum_db_conn(); include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path . 'pre_valb.php')); }
if (isset($_GET['_nodesforum_val2']))
{ _nodesforum_db_conn(); include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path . 'pre_val2b.php')); }
if (isset($_POST['_nodesforum_resendpass']))
{ _nodesforum_db_conn(); include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path . 'pre_resendpass.php')); }
if (isset($_POST['_nodesforum_login']))
{ _nodesforum_db_conn(); include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path . 'pre_loginb.php')); }
if (isset($_POST['_nodesforum_resendval']))
{ _nodesforum_db_conn(); include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path . 'pre_resendval.php')); }
if (isset($_GET['_nodesforum_reset_password']))
{ _nodesforum_db_conn(); include(nodesforum_sanitize_nodesforum_code_path($_nodesforum_code_path . 'pre_reset_passwordb.php')); }







$randominius = rand(1, 1000000);
if ($randominius == 1)
{
    _nodesforum_db_conn();
    //erase old deleted posts
    $oldest_acceptable_time = $nowtime - ($_nodesforum_keep_delete_forxhours * 3600);
    mysql_query("DELETE FROM " . $_nodesforum_db_table_name_modifier . "_nodesforum_folders_and_posts WHERE deletion_time != 0 && deletion_time < '$oldest_acceptable_time'");
}


$randominius = rand(1, 10000);
if ($randominius == 1)
{
    _nodesforum_db_conn();
    //delete old banned ips
    $oldest_acceptable_time1 = $nowtime - ($_nodesforum_keep_ips_banned_for_x_days * (24 * 3600));
    mysql_query("DELETE FROM " . $_nodesforum_db_table_name_modifier . "_nodesforum_mods WHERE mod_uniqueID = 0 && mod_level = -13 && promotion_time < $oldest_acceptable_time1");
    //delete ips from old posts
    $oldest_acceptable_time2 = $nowtime - ($_nodesforum_delete_ips_after_x_days * (24 * 3600));
    mysql_query("UPDATE " . $_nodesforum_db_table_name_modifier . "_nodesforum_folders_and_posts SET creator_ip = '' WHERE creation_time < $oldest_acceptable_time2");
}


//send email notification to admin about new posts or folders to audit

//check if last notification was sent in the last 24 hours
$last_audit_notification_flag_path = $_nodesforum_code_path . 'cache/last_audit_notification.txt';
$last_audit_notification_time = 0;
if(file_exists($last_audit_notification_flag_path)){
    $last_audit_notification_time = file_get_contents($last_audit_notification_flag_path);
}

if($last_audit_notification_time < ($nowtime - (24 * 3600))){
    
    $check_need_audit_query="SELECT fapID FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts WHERE audited = 0 && deletion_time = 0";
    $result = mysql_query($check_need_audit_query);
    while($row = mysql_fetch_array($result)){
        $this_fapID=$row['fapID'];
        $_nodesforum_mod_audit_count++;
    }
    if($_nodesforum_mod_audit_count>0){
        $subject = $_nodesforum_forum_name.' - folders or posts needing auditing';
        $audit_message = 
            '<img src="'.$_nodesforum_instance_asolute_URL.$_nodesforum_warn_icon.'" style="vertical-align:middle;margin-right:8px;border:none;" alt="Audit" />'
            .'There are <span style="color:'.$_nodesforum_link_color.'">'.$_nodesforum_mod_audit_count.'</span> folders or posts inside of this '.$thinger.' that need auditing. '
            .'<a href="'.$_nodesforum_instance_asolute_URL.'?_nodesforum_node=a'.$remember_actual_node.'" style="color:'.$_nodesforum_link_color.';text-decoration:underline;font-weight:bold;">Click here to audit them</a>.';


        //email about posts or folders needing auditing
        $to=$_nodesforum_admin_email;
        $message= $audit_message.'

        
            '.$_nodesforum_forum_name.'
            '.$_nodesforum_instance_asolute_URL.'

            ';
        //$headers = "From: ".$_nodesforum_validate_resend_password_from;
        //mail($to,$subject,$message,$headers);
        $sendmail_results = nodesforum_send_mail($to, null, $_nodesforum_email_from, null, $subject, $message, null);
        if(!$sendmail_results){
            //echo a warning if the email could not be sent
            echo '<span style="color:red;">Warning: unable to send email notification about posts or folders needing auditing</span><br />';
        }

        //set a flag in cache/ to remember last send time for audit notifications
        file_put_contents($last_audit_notification_flag_path, $nowtime);
        //check if the cache file was written correctly, if echo a warning
        if(!file_exists($last_audit_notification_flag_path) || file_get_contents($last_audit_notification_flag_path)!=$nowtime){
            echo '<span style="color:red;">Warning: unable to write last audit notification time to cache/last_audit_notification.txt</span><br />';
        }
    }

}

if ($_nodesforum_db_isconn == 1)
{ mysql_close($conn); }

if(isset($_GET['format']) && $_GET['format']=='json'){
	echo json_encode($json_data); exit;
}

