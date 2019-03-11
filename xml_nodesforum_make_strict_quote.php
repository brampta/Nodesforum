<?php
//error_reporting(E_ALL ^ E_NOTICE);




include('config.php');
include('risky_powers_array.php');


//start of little part of code only needed for free hosted forums
$this_host=$_SERVER['HTTP_HOST'];
if(substr($this_host,0,4)=='www.')
{$this_host=substr($this_host,4);}
if(file_exists('../forum_setups/'.$this_host.'.php'))
{
    include('../forum_setups/'.$this_host.'.php');
    $_nodesforum_db_table_name_modifier=$forumID;
}
//end of little part of code only needed for free hosted forums




function _nodesforum_my_custom_addslashes($text_to_slash)
{
    if($GLOBALS['_nodesforum_magic_quotes_on_or_off']=='on')
    {$text_to_slash=stripslashes($text_to_slash);}
    $text_to_slash=mysql_real_escape_string($text_to_slash);
    return $text_to_slash;
}







$conn = mysql_connect($_nodesforum_db_servername,$_nodesforum_db_username,$_nodesforum_db_password);
//echo '_nodesforum_db_name: '.$_nodesforum_db_name.'<br />';
mysql_select_db($_nodesforum_db_name,$conn);


$addslashed_postID=_nodesforum_my_custom_addslashes($_GET['postID']);


header('Content-Type: text/xml');



echo '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><response>';

$post_is_found=0;


$myquery="SELECT creator_uniqueID, post FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts WHERE fapID = '$addslashed_postID'";
//echo htmlspecialchars($myquery).'<br />';
$result = mysql_query($myquery);
while($row = mysql_fetch_array($result))
{
    $post_is_found=1;
    $userID=$row['creator_uniqueID'];
    $post=$row['post'];

    $addslashed_user_uniqueID=_nodesforum_my_custom_addslashes($userID);


    if($_nodesforum_use_external_user_system=='no')
    {
        $_nodesforum_external_user_system_publicname_rowname='public_name';
        $_nodesforum_external_user_system_user_uniqueID_rowname='uniqueID';
        $_nodesforum_external_user_system_table_name='_nodesforum_users';
        $_nodesforum_external_user_system_user_uniqueID_rowname='uniqueID';
    }

    if($_nodesforum_use_external_user_system=='no')
    {$_nodesforum_external_user_system_table_name=$_nodesforum_db_table_name_modifier.'_nodesforum_users';}



    if($addslashed_user_uniqueID=='0')
    {$publicname='a guest';}
    else if($addslashed_user_uniqueID=='0')
    {$publicname='deleted user';}
    else
    {
        $myqyuery="SELECT $_nodesforum_external_user_system_publicname_rowname FROM $_nodesforum_external_user_system_table_name WHERE $_nodesforum_external_user_system_user_uniqueID_rowname = '$addslashed_user_uniqueID'";
        $result2 = mysql_query($myqyuery);
        while($row2 = mysql_fetch_array($result2))
        {$publicname=$row2[$_nodesforum_external_user_system_publicname_rowname];}
    }


}




echo '<post_is_found>'.$post_is_found.'</post_is_found>
	<postID>'.$_GET['postID'].'</postID>
	<userID><![CDATA['.$userID.']]></userID>
	<publicname><![CDATA['.$publicname.']]></publicname>
	<time><![CDATA['.time().']]></time>
	<post><![CDATA['.$post.']]></post>';




echo '</response>';












mysql_close($conn);
?>

