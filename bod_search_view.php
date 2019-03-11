<?php


$pagination='';
if($_nodesforum_totalpages>1)
{
    $previouspage='';
    if($_GET['_nodesforum_page']>1)
    {$previouspage='<a href="?_nodesforum_node='.$_GET['_nodesforum_node'].'&_nodesforum_search='.urlencode($_GET['_nodesforum_search']).'&_nodesforum_search_spectre='.$_GET['_nodesforum_search_spectre'].'&_nodesforum_page='.($_GET['_nodesforum_page']-1).'">previous</a> | ';}
    $nextpage='';
    if($_GET['_nodesforum_page']<$_nodesforum_totalpages)
    {$nextpage=' | <a href="?_nodesforum_node='.$_GET['_nodesforum_node'].'&_nodesforum_search='.urlencode($_GET['_nodesforum_search']).'&_nodesforum_search_spectre='.$_GET['_nodesforum_search_spectre'].'&_nodesforum_page='.($_GET['_nodesforum_page']+1).'">next</a>';}
    $pagination='<div style="height:4px;"><!-- --></div><div style="width:100%;"><table class="class_nodesforum_bgcolor3" style="width:100%;"><tr><td class="class_nodesforum_bgcolor2"><div class="class_nodesforum_inner">'.$previouspage.'page '.$_GET['_nodesforum_page'].' of '.$_nodesforum_totalpages.$nextpage.'</div></td></tr></table></div>';
}

echo '<div style="height:4px;"><!-- --></div><div style="width:100%;"><table style="width:100%;" class="class_nodesforum_bgcolor3">';
if($_nodesforum_display_search_results_fapID)
{
    foreach($_nodesforum_display_search_results_fapID as $key => $value)
    {
        if($_nodesforum_display_search_results_folder_or_post[$key]==2 && substr($_nodesforum_display_search_results_containing_folder_or_post[$key],0,1)=='p')
        {
            $container_fapID=substr($_nodesforum_display_search_results_containing_folder_or_post[$key],1);
            $eltitle='<img src="'.$_nodesforum_reply_icon.'" style="vertical-align:text-bottom;border:none;" /> <a href="?_nodesforum_permalink='.$value.'#_nodesforum_anchor_'.$value.'">reply</a> on <a href="?_nodesforum_node='.$container_fapID.'">'._nodesforum_display_title($_nodesforum_display_search_results_title[$container_fapID],$_nodesforum_max_word_length_in_titles).'</a>';
        }
        else if($_nodesforum_display_search_results_folder_or_post[$key]==2)
        {$eltitle='<img src="'.$_nodesforum_post_icon.'" style="vertical-align:text-bottom;border:none;" /> <a href="?_nodesforum_node='.$value.'">'._nodesforum_display_title($_nodesforum_display_search_results_title[$value],$_nodesforum_max_word_length_in_titles).'</a>';}
        else if($_nodesforum_display_search_results_folder_or_post[$key]==1)
        {$eltitle='<img src="'.$_nodesforum_folder_icon.'" style="vertical-align:text-bottom;border:none;" /> <a href="?_nodesforum_node='.$value.'">'._nodesforum_display_title($_nodesforum_display_search_results_title[$value],$_nodesforum_max_word_length_in_titles).'</a>';}
        echo '<tr><td style="text-align:left;vertical-align:top;" class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner"><h4 style="padding:10px;margin:0px;">'.$eltitle.'</h4><p style="padding:10px;margin:0px;">'.display_bb($_nodesforum_display_search_results_post[$key],0,0,1,1,1).'</p></div></td></tr>';
    }
}
else
{echo '<tr><td style="text-align:center;vertical-align:top;" class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner">no results matching '._nodesforum_display_title($_GET['_nodesforum_search'],$_nodesforum_max_word_length_in_titles).'</div></td></tr>';}
echo '</table></div>'.$pagination;



?>