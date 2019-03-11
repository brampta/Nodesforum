<?php



if(isset($_SESSION[$_nodesforum_external_user_system_uniqueID_session_name]))
{
    $my_uniqueID=$_SESSION[$_nodesforum_external_user_system_uniqueID_session_name];
    $_nodesforum_avatarupload_filetoobig=0;
    $_nodesforum_avatarupload_incorrectfiletype=0;
    $_nodesforum_avatarupload_errormovingfile=0;
    $_nodesforum_avatarupload_uploadsuccess=0;
    if(isset($_POST['_nodesforum_upload_avatar']))
    {
        $error=0;
        if($_FILES['_nodesforum_uploadedfile']['size']>$_nodesforum_avatars_max_filesize)
        {$error=1; $_nodesforum_avatarupload_filetoobig=1;}
        if($_FILES['_nodesforum_uploadedfile']['type']!="image/png" && $_FILES['_nodesforum_uploadedfile']['type']!="image/gif" && $_FILES['_nodesforum_uploadedfile']['type']!="image/jpeg" && $_FILES['_nodesforum_uploadedfile']['type']!="image/pjpeg")
        {$error=1; $_nodesforum_avatarupload_incorrectfiletype=1;}
        if($error==0)
        {
            //select what is file extension gonna be (to make file name)
            if($_FILES['_nodesforum_uploadedfile']['type']=="image/png")
            {$extension='png';}
            else if($_FILES['_nodesforum_uploadedfile']['type']=="image/gif")
            {$extension='gif';}
            else
            {$extension='jpg';}
            //file name and path:
            $uploaded_file_name=$_nodesforum_db_table_name_modifier.'_'.$my_uniqueID.'_'.$nowtime.'.'.$extension;
            $avatar_files_path=$_nodesforum_mysterypath.'/avatars/';
            //put uploaded file in place
            $uploadtarget=$avatar_files_path.$uploaded_file_name;
            if(!move_uploaded_file($_FILES['_nodesforum_uploadedfile']['tmp_name'], $uploadtarget))
            {$error=1; $_nodesforum_avatarupload_errormovingfile=1;}
            if($error==0)
            {
                //check users userdata
                $hasuserdata=0;
                $result = mysql_query("SELECT avatar FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_user_data WHERE uniqueID = '$my_uniqueID'");
                while($row = mysql_fetch_array($result))
                {
                    $hasuserdata=1;
                    $_nodesforum_remember_avatar=$row['avatar'];
                }
                if($hasuserdata==0)
                {mysql_query("INSERT INTO ".$_nodesforum_db_table_name_modifier."_nodesforum_user_data (uniqueID, avatar) VALUES ('$my_uniqueID', '$uploaded_file_name')");}
                else
                {
                    if($_nodesforum_remember_avatar!='')
                    {
                        //physically delete old pic!
                        $oldpic=$avatar_files_path.$_nodesforum_remember_avatar;
                        unlink($oldpic);
                    }
                    mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_user_data SET avatar = '$uploaded_file_name' WHERE uniqueID = '$my_uniqueID'");
                }
            }
        }
    }
    $_nodesforum_edit_allow_posting_success=0;
    if(isset($_POST['_nodesforum_edit_allow_posting']))
    {
        //check users userdata
        $hasuserdata=0;
        $result = mysql_query("SELECT user_dataID FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_user_data WHERE uniqueID = '$my_uniqueID'");
        while($row = mysql_fetch_array($result))
        {$hasuserdata=1;}

        $addslashed_allow_posting_on_personal_page=mysql_real_escape_string($_POST['_nodesforum_allow_posting_on_personal_page']);
        if($hasuserdata==1)
        {mysql_query("UPDATE ".$_nodesforum_db_table_name_modifier."_nodesforum_user_data SET allow_posting_on_personal_page = '$addslashed_allow_posting_on_personal_page' WHERE uniqueID = '$my_uniqueID'");}
        else
        {mysql_query("INSERT INTO ".$_nodesforum_db_table_name_modifier."_nodesforum_user_data (uniqueID, allow_posting_on_personal_page) VALUES ('$my_uniqueID', '$addslashed_allow_posting_on_personal_page')");}
    }
    $_nodesforum_willread_user_data_for_forumoptionspage=1;
}



?>
