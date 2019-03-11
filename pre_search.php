<?php


$_nodeforum_cant_search_empty_string=0;

$error=0;

$wasa='N.A.';
if($_nodesforum_folder_or_post==1)
{$wasa='folder';}
else if($_nodesforum_folder_or_post==2)
{$wasa='post';}

$_nodesforum_folder_or_post=5;



if($_GET['_nodesforum_search_spectre']==1)
{
    $addwherer=" && (fapID = '$addslashed_node' || ancestry LIKE '%|$addslashed_node|%')";
    $search_title='search for '._nodesforum_display_title(_nodesforum_my_custom_stripslashes($_GET['_nodesforum_search']),$_nodesforum_max_word_length_in_titles).' in this '.$wasa;
}
else
{
    $addwherer='';
    $search_title='search for '._nodesforum_display_title(_nodesforum_my_custom_stripslashes($_GET['_nodesforum_search']),$_nodesforum_max_word_length_in_titles).' in entire forum';
}



if($_GET['_nodesforum_search']=='')
{$error=1; $_nodeforum_cant_search_empty_string=1;}




if($error==0)
{

    $thequery=_nodesforum_my_custom_addslashes($_GET['_nodesforum_search']);



    $wherer="((title LIKE '%$thequery%' || post LIKE '%$thequery%') || (MATCH (title, post) AGAINST('$thequery'))) && deletion_time = 0".$addwherer;



    $myquery="SELECT COUNT(fapID) FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts WHERE $wherer";
    $queryRows=mysql_query($myquery);
    $numRows=mysql_fetch_array($queryRows);
    $_nodesforum_totalfap=$numRows[0];
    $_nodesforum_totalpages=ceil($_nodesforum_totalfap/$_nodesforum_howmany_search_results_perpage);

    if($_nodesforum_totalfap>0)
    {

        if($_GET['_nodesforum_page']=='last')
        {$_GET['_nodesforum_page']=$_nodesforum_totalpages;}
        $startat=($_GET['_nodesforum_page']-1)*$_nodesforum_howmany_search_results_perpage;
        $count=0;
        $myquery="SELECT fapID, folder_or_post, creator_uniqueID, creation_time, title, post, containing_folder_or_post, IF(title LIKE '%$thequery%' || post LIKE '%$thequery%','True','False') AS pureresult, (MATCH (title,post) AGAINST('$thequery')) AS relevance FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts WHERE $wherer ORDER BY relevance DESC, pureresult DESC, creation_time DESC LIMIT $startat, $_nodesforum_howmany_search_results_perpage";
        $result = mysql_query($myquery);
        while($row = mysql_fetch_array($result))
        {
            //echo '<b><a>*'.$row['title'].'</a></b><br />'.$row['post'].'<br />';

            $count++;
            $thisfapID=$row['fapID'];

            $_nodesforum_display_search_results_fapID[$count]=$row['fapID'];
            $_nodesforum_display_search_results_folder_or_post[$count]=$row['folder_or_post'];
            $_nodesforum_display_search_results_creator_uniqueID[$count]=$row['creator_uniqueID'];
            $_nodesforum_display_search_results_creation_time[$count]=$row['creation_time'];
            $_nodesforum_display_search_results_post[$count]=$row['post'];
            $_nodesforum_display_search_results_containing_folder_or_post[$count]=$row['containing_folder_or_post'];

            $_nodesforum_display_search_results_title[$thisfapID]=$row['title'];

            $parent_fapID=substr($row['containing_folder_or_post'],1);
            if($row['folder_or_post']==2 && substr($row['containing_folder_or_post'],0,1)=='p' && !$_nodesforum_display_search_results_title[$parent_fapID] && !$parent_titles_to_get[$parent_fapID])
            {$parent_titles_to_get[$parent_fapID]='get';}


        }
    }

    if($parent_titles_to_get)
    {
        $count=0;
        $array_of_parent_titles_to_get_in_string='';
        foreach($parent_titles_to_get as $key => $value)
        {
            if(!$_nodesforum_display_search_results_title[$key])
            {
                $count++;
                if($count>1)
                {$array_of_parent_titles_to_get_in_string=$array_of_parent_titles_to_get_in_string.', ';}
                $array_of_parent_titles_to_get_in_string=$array_of_parent_titles_to_get_in_string.$key;
            }
        }
    }


    if($parent_titles_to_get && $count>0)
    {
        $myquery="SELECT fapID, title FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts WHERE fapID in ($array_of_parent_titles_to_get_in_string)";
        $result = mysql_query($myquery);
        while($row = mysql_fetch_array($result))
        {
            $thisfapID=$row['fapID'];
            $_nodesforum_display_search_results_title[$thisfapID]=$row['title'];
        }
    }







}





?>