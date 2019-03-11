<?php
a_function_that_is_only_in_the_pre_output();



$limits_cache_url=$_nodesforum_code_path.'cache/'.$_nodesforum_db_table_name_modifier.'_3rd_party_limits.php';
if(@filemtime($limits_cache_url) && @filemtime($limits_cache_url)>(time()-(24*3600*14)))
{include(nodesforum_sanitize_nodesforum_code_path($limits_cache_url));}
else
{




    $countem=0;
    $_nodesforum_tag_names_array_string='';
    foreach($bb_name as $key => $value)
    {
        if($bb_type[$key]=='3rd party')
        {
            $countem++;
            if($countem>1)
            {$_nodesforum_tag_names_array_string=$_nodesforum_tag_names_array_string.', ';}
            $_nodesforum_tag_names_array_string=$_nodesforum_tag_names_array_string."'".addslashes($key)."'";
        }
    }


    $string_for_cache='';

    $myquery="SELECT tag_name, user_limit, guest_limit FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_3rd_party_tag_limits WHERE tag_name in (".$_nodesforum_tag_names_array_string.")";


    _nodesforum_db_conn();
    $result = mysql_query($myquery);



    
    if($result!=null)
    {

        while($row = mysql_fetch_array($result))
        {
            $tag_name=$row['tag_name'];
            $_nodesforum_3rd_party_tag_limits_specific_has_data[$tag_name]=1;
            $_nodesforum_3rd_party_tag_limits_user_specific[$tag_name]=$row['user_limit'];
            $_nodesforum_3rd_party_tag_limits_guest_specific[$tag_name]=$row['guest_limit'];
            $string_for_cache=$string_for_cache."$"."_nodesforum_3rd_party_tag_limits_specific_has_data['".$tag_name."']=1; $"."_nodesforum_3rd_party_tag_limits_user_specific['".$tag_name."']=".$row['user_limit']."; $"."_nodesforum_3rd_party_tag_limits_guest_specific['".$tag_name."']=".$row['guest_limit'].";";
        }



        $string_for_cache="<?php ".$string_for_cache." ?>";
        $limits_cache=fopen($limits_cache_url,'w');
        if($limits_cache===false)
        {echo '<span style="padding:4px;margin:4px;color:#000000;background-color:#FFFFFF;border-style:solid;border-width:1px;border-color:#000000;"><span style="color:red;">error!!</span> unable to write to '.$limits_cache_url.' please set the permissions to allow the system to write in the "cache" folder</span><br />';}
        fwrite($limits_cache,$string_for_cache);
        fclose($limits_cache);

    }


}




?>
