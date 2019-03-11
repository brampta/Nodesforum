<?php





//read list of replies on that post
    $hideghosts=' && deletion_time = 0';
    if($_nodesforum_ismod==1 && $_GET['ghost']==1)
    {
        $hideghosts='';
        if($get_ghost_permalink_page==1)
        {$_GET['_nodesforum_page']=$ghost_permalink_page;}
    }
    $queryRows=mysql_query("SELECT COUNT(fapID) FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts WHERE (fapID = '$addslashed_node' || containing_folder_or_post = 'p$addslashed_node')".$hideghosts);
    $numRows=mysql_fetch_array($queryRows);
    $_nodesforum_totalfap=$numRows[0];
    $_nodesforum_totalpages=ceil($_nodesforum_totalfap/$_nodesforum_howmany_replies_perpage);
    if($_GET['_nodesforum_page']=='last')
    {$_GET['_nodesforum_page']=$_nodesforum_totalpages;}
    $startat=($_GET['_nodesforum_page']-1)*$_nodesforum_howmany_replies_perpage;

    $_nodesforum_count_fap_results=0;
    $result = mysql_query("SELECT fapID, creator_uniqueID, creator_ip, AES_ENCRYPT(creator_ip,creator_ip) AS enc_ip, creation_time, title, post, disable_auto_smileys, disable_auto_links, deletion_time FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts WHERE (fapID = '$addslashed_node' || containing_folder_or_post = 'p$addslashed_node') $hideghosts ORDER BY creation_time LIMIT $startat, $_nodesforum_howmany_replies_perpage");
    while($row = mysql_fetch_array($result))
    {
        $_nodesforum_count_fap_results++;
        $_nodesforum_display_fapID[$_nodesforum_count_fap_results]=$row['fapID'];
        $_nodesforum_display_creator_uniqueID[$_nodesforum_count_fap_results]=$row['creator_uniqueID'];
        $this_creator_uniqueID=$_nodesforum_display_creator_uniqueID[$_nodesforum_count_fap_results];
        if(!$_nodesforum_creator_publicname[$this_creator_uniqueID])
        {$_nodesforum_creator_publicname[$this_creator_uniqueID]='yes';}
        $_nodesforum_display_creator_ip[$_nodesforum_count_fap_results]=$row['creator_ip'];
        if($row['creator_ip']=='')
        {$_nodesforum_display_enc_ip[$_nodesforum_count_fap_results]='';}
        else
        {$_nodesforum_display_enc_ip[$_nodesforum_count_fap_results]=$row['enc_ip'];}
        $_nodesforum_display_creation_time[$_nodesforum_count_fap_results]=$row['creation_time'];
        $_nodesforum_display_title[$_nodesforum_count_fap_results]=$row['title'];
        $_nodesforum_display_post[$_nodesforum_count_fap_results]=$row['post'];
        $_nodesforum_display_disable_auto_smileys[$_nodesforum_count_fap_results]=$row['disable_auto_smileys'];
        $_nodesforum_display_disable_auto_links[$_nodesforum_count_fap_results]=$row['disable_auto_links'];
        $_nodesforum_display_deletion_time[$_nodesforum_count_fap_results]=$row['deletion_time'];
    }









//get list of mods on that post
    $_nodesforum_count_mod_results=0;
    $_nodesforum_count_banned_results=0;
    $_nodesforum_count_banned_ip_results=0;
    if($_nodesforum_creator_uniqueID!=$_nodesforum_uniqueID_of_deleted_user)
    {
        $_nodesforum_display_mod_uniqueID[1]=$_nodesforum_creator_uniqueID;
        $_nodesforum_display_mod_level[1]=0;
        $this_mod_uniqueID=$_nodesforum_display_mod_uniqueID[1];
        if(!$_nodesforum_creator_publicname[$this_mod_uniqueID])
        {$_nodesforum_creator_publicname[$this_mod_uniqueID]='yes';}
        $_nodesforum_count_mod_results++;
    }
    $result = mysql_query("SELECT mod_uniqueID, mod_level, ip, reason FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_mods WHERE folderID = '$addslashed_node' ORDER BY mod_level, promotion_time LIMIT 1000000");
    while($row = mysql_fetch_array($result))
    {
        $this_uniqueID=$row['mod_uniqueID'];
        if($row['mod_level']==-13)
        {
            if($row['ip']=='')
            {
                $_nodesforum_count_banned_results++;
                $_nodesforum_display_banned_uniqueID[$_nodesforum_count_banned_results]=$this_uniqueID;
                $_nodesforum_display_banned_reason[$_nodesforum_count_banned_results]=$row['reason'];
            }
            else if($row['mod_uniqueID']==0)
            {
                $_nodesforum_count_banned_ip_results++;
                $_nodesforum_display_banned_ip_ip[$_nodesforum_count_banned_ip_results]=$row['ip'];
                $_nodesforum_display_banned_ip_reason[$_nodesforum_count_banned_ip_results]=$row['reason'];
            }
        }
        else
        {
            $_nodesforum_count_mod_results++;
            $_nodesforum_display_mod_uniqueID[$_nodesforum_count_mod_results]=$this_uniqueID;
            $_nodesforum_display_mod_level[$_nodesforum_count_mod_results]=$row['mod_level'];
            $remember_modz[$this_mod_uniqueID]='remember';
        }
        if(!$_nodesforum_creator_publicname[$this_uniqueID])
        {$_nodesforum_creator_publicname[$this_uniqueID]='yes';}
    }




//get concerned users info
    if($_nodesforum_creator_publicname)
    {
        $wherer='';
        $wherer2='';
        $countzz=0;
        foreach($_nodesforum_creator_publicname as $key => $value)
        {
            if($key!='0' && $key!=$_nodesforum_uniqueID_of_deleted_user)
            {
                $countzz++;
                if($countzz>1)
                {
                    $wherer=$wherer.", ";
                    $wherer2=$wherer2.", ";
                }
                $wherer=$wherer." "."'".$key."'";
                $wherer2=$wherer2."'".$key."'";
            }
        }

        if($countzz>=1)
        {
            //get publicnames and registration times
            $regtime_selector='';
            if($_nodesforum_external_user_system_show_registration_time=='yes')
            {$regtime_selector=', '.$_nodesforum_external_user_system_registration_time_rowname;}
            $myquery="SELECT $_nodesforum_external_user_system_user_uniqueID_rowname, $_nodesforum_external_user_system_publicname_rowname $regtime_selector FROM $_nodesforum_external_user_system_table_name WHERE ".$_nodesforum_external_user_system_user_uniqueID_rowname." in ($wherer)";
            $result = mysql_query($myquery);
            while($row = mysql_fetch_array($result))
            {
                $this_creator_uniqueID=$row[$_nodesforum_external_user_system_user_uniqueID_rowname];
                $_nodesforum_display_creator_publicname[$this_creator_uniqueID]=$row[$_nodesforum_external_user_system_publicname_rowname];
                if($_nodesforum_external_user_system_show_registration_time=='yes')
                {$this_creator_registration_time[$this_creator_uniqueID]=$row[$_nodesforum_external_user_system_registration_time_rowname];}
            }
            //get forum user data
            $read_p_part='';
            foreach($_nodesforum_risky_bbcode_title as $key => $value)
            {$read_p_part=$read_p_part.', '.$key;}
            $myquery="SELECT uniqueID, avatar, signature, total_folders, total_posts, total_replies $read_p_part FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_user_data WHERE uniqueID in ($wherer2)";
            $result = mysql_query($myquery);
            while($row = mysql_fetch_array($result))
            {
                $this_creator_uniqueID=$row['uniqueID'];
                $_nodesforum_display_avatar[$this_creator_uniqueID]=$row['avatar'];
                if($row['signature']==0)
                {$_nodesforum_display_signature[$this_creator_uniqueID]=0;}
                else
                {
                    $signaID=$row['signature'];
                    $get_signatorrr[$signaID]=$this_creator_uniqueID;
                }
                $_nodesforum_display_has_folderstuff[$this_creator_uniqueID]=1;
                $_nodesforum_display_total_folders[$this_creator_uniqueID]=$row['total_folders'];
                $_nodesforum_display_total_posts[$this_creator_uniqueID]=$row['total_posts'];
                $_nodesforum_display_total_replies[$this_creator_uniqueID]=$row['total_replies'];
                foreach($_nodesforum_risky_bbcode_title as $key => $value)
                {if($this_creator_uniqueID==$_nodesforum_main_mod_uniqueID){$_nodesforum_display_pn[$key]=1;}else{$_nodesforum_display_pn[$key]=$row[$key];}}
                $_nodesforum_display_p_inf_str[$this_creator_uniqueID]=implode('!',$_nodesforum_display_pn);
            }
            //get signatures
            if($get_signatorrr)
            {
                $countemsignaghetti=0;
                $fapinclause='';
                foreach($get_signatorrr as $key => $value)
                {
                    $countemsignaghetti++;
                    if($countemsignaghetti>1)
                    {$fapinclause=$fapinclause.', ';}
                    $fapinclause=$fapinclause.$key;
                }
                $result = mysql_query("SELECT fapID, post, disable_auto_smileys, disable_auto_links FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts WHERE fapID in (".$fapinclause.")");
                while($row = mysql_fetch_array($result))
                {
                    $thisfapID=$row['fapID'];
                    $signator_creator_uniqueID=$get_signatorrr[$thisfapID];
                    $_nodesforum_display_signature[$signator_creator_uniqueID]=$row['post'];
                    $_nodesforum_display_signature_disable_auto_smileys[$signator_creator_uniqueID]=$row['disable_auto_smileys'];
                    $_nodesforum_display_signature_disable_auto_links[$signator_creator_uniqueID]=$row['disable_auto_links'];
                }
            }
        }


        $_nodesforum_display_creator_publicname[0]='a guest';
        $_nodesforum_display_creator_publicname[$_nodesforum_uniqueID_of_deleted_user]='deleted user';
    }













?>
