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
mysql_select_db($_nodesforum_db_name,$conn);

$addslashed_node=_nodesforum_my_custom_addslashes($_GET['node']);


header('Content-Type: text/xml');



echo '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><response>';


//get info about this node (name, allow_posting)
$folder_is_found=0;
$folder_is_allow_posting=0;
$folder_name='';
$folder_parent='';
$ancestry='';

if($_GET['node']=='0')
{
    $folder_is_found=1;
    $folder_is_allow_posting=0;
    $folder_name='root';
    $folder_parent='none';
    $ancestry=$_nodesforum_ancestry_separator;
}
else if(substr($_GET['node'],0,1)=='p')
{
    $this_node=$_GET['node'];
    if($_nodesforum_risky_bbcode_title[$this_node])
    {$folder_is_found=1;}
    $folder_is_allow_posting=1;
    $folder_name=$_nodesforum_risky_bbcode_title[$this_node];
    $folder_parent='0';
    $ancestry=$_nodesforum_ancestry_separator.'0'.$_nodesforum_ancestry_separator;
}
else if(substr($_GET['node'],0,1)=='u')
{



    if($_nodesforum_use_external_user_system=='no')
    {
        $_nodesforum_external_user_system_publicname_rowname='public_name';
        $_nodesforum_external_user_system_user_uniqueID_rowname='uniqueID';
        $_nodesforum_external_user_system_table_name='_nodesforum_users';
        $_nodesforum_external_user_system_user_uniqueID_rowname='uniqueID';
    }

    if($_nodesforum_use_external_user_system=='no')
    {$_nodesforum_external_user_system_table_name=$_nodesforum_db_table_name_modifier.'_nodesforum_users';}

    $addslashed_user_uniqueID=_nodesforum_my_custom_addslashes(substr($_GET['node'],1));
    $myquery="SELECT $_nodesforum_external_user_system_publicname_rowname FROM $_nodesforum_external_user_system_table_name WHERE $_nodesforum_external_user_system_user_uniqueID_rowname = '$addslashed_user_uniqueID'";
    $result = mysql_query($myquery);
    while($row = mysql_fetch_array($result))
    {
        $folder_is_found=1;

        $this_publicname=$row[$_nodesforum_external_user_system_publicname_rowname];
        $last_letter=substr($this_publicname,strlen($this_publicname)-1);
        $proprS='s';
        if($last_letter=='s' || $last_letter=='z')
        {$proprS='';}
        $folder_name=$this_publicname."'".$proprS.' forum page';

        $hasuserdata=0;
        $result = mysql_query("SELECT allow_posting_on_personal_page FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_user_data WHERE uniqueID = '$addslashed_user_uniqueID'");
        while($row = mysql_fetch_array($result))
        {$_nodesforum_userpage_allow_posting_on_personal_page=$row['allow_posting_on_personal_page'];}
        if($hasuserdata==0)
        {$_nodesforum_userpage_allow_posting_on_personal_page=2;}
        if($_nodesforum_userpage_allow_posting_on_personal_page==0 || $_nodesforum_userpage_allow_posting_on_personal_page==2)
        {$folder_is_allow_posting=1;}
    }

    $folder_parent='0';
    $ancestry=$_nodesforum_ancestry_separator.'0'.$_nodesforum_ancestry_separator;
}
else
{

    $myquery="SELECT title, allow_posting, containing_folder_or_post, ancestry FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts WHERE fapID = '$addslashed_node' && folder_or_post = 1";
    //echo htmlspecialchars($myquery).'<br />';
    $result = mysql_query($myquery);
    while($row = mysql_fetch_array($result))
    {
        $folder_is_found=1;
        if($row['allow_posting']==2)
        {$folder_is_allow_posting=1;}
        $folder_name=$row['title'];
        $folder_parent=substr($row['containing_folder_or_post'],1);
        $ancestry=$row['ancestry'];
    }

}



echo '<folder_is_found>'.$folder_is_found.'</folder_is_found>
	<folder_is_allow_posting>'.$folder_is_allow_posting.'</folder_is_allow_posting>
	<folder_name><![CDATA['.htmlspecialchars($folder_name).']]></folder_name>
	<folder_parent><![CDATA['.$folder_parent.']]></folder_parent>
	<folder_ancestry><![CDATA['.$ancestry.']]></folder_ancestry>';


//get list of folders in this node (fapID, name)

$countem=0;

$needed_container='f'.$addslashed_node;

$result = mysql_query("SELECT fapID, title, IF(sticky = 0,'True','False') AS not_sticky FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts WHERE containing_folder_or_post = '$needed_container' && folder_or_post = 1 && deletion_time = 0 ORDER BY not_sticky, sticky, last_post_time DESC, creation_time");
while($row = mysql_fetch_array($result))
{
    $countem++;
    echo '<subfolder_fapID-'.$countem.'>'.$row['fapID'].'</subfolder_fapID-'.$countem.'>';
    echo '<subfolder_title-'.$countem.'><![CDATA['.htmlspecialchars($row['title']).']]></subfolder_title-'.$countem.'>';
}

echo '<total_subfolders>'.$countem.'</total_subfolders>';




//read time of last glob
$lastpathloadtimefile=fopen('images/lastpathloadtimefile','r');
$lastglobtime=fread($lastpathloadtimefile,9999);
fclose($lastpathloadtimefile);


//write time of last glob
$lastpathloadtimefile=fopen('images/lastpathloadtimefile','w');
fwrite($lastpathloadtimefile,$nowtime);
fclose($lastpathloadtimefile);
//get current path
$_nodesforum_mysterypath=glob('images/*');
$_nodesforum_mysterypath=$_nodesforum_mysterypath[0];



if($lastglobtime<($nowtime-15))
{
    //if last glob older than x seconds change path
    $newmystery='images/_'.rand(111111,999999);
    rename($_nodesforum_mysterypath,$newmystery);
    $_nodesforum_mysterypath=$newmystery;
}
echo '<mysterypath>'.$_nodesforum_mysterypath.'</mysterypath>';



echo '<node>'.$_GET['node'].'</node>
	</response>';












mysql_close($conn);
?>

