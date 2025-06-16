<?php




if(isset($_POST['_nodesforum_create_new_tables']))
{
    if(mysql_query("CREATE TABLE ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts (fapID int NOT NULL AUTO_INCREMENT, PRIMARY KEY(fapID), folder_or_post int NOT NULL, containing_folder_or_post varchar(102), creator_uniqueID varchar(100), creator_ip varchar(128), creation_time int NOT NULL, title varchar(1000), post longtext, allow_posting int NOT NULL, allow_guest_reply int NOT NULL, ancestry text, subfolders int NOT NULL, posts int NOT NULL, replies int NOT NULL, views int NOT NULL, last_post_postID int NOT NULL, last_post_user_uniqueID varchar(100), last_post_time int NOT NULL, sticky int NOT NULL, skeleton int NOT NULL, deletion_time int NOT NULL, `audited` tinyint NOT NULL DEFAULT '0', disable_auto_smileys int NOT NULL, disable_auto_links int NOT NULL, INDEX(containing_folder_or_post), INDEX(creator_uniqueID), KEY `folders_and_post_audited_index` (`audited`), FULLTEXT(title, post)) ENGINE = MYISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci"))
    {
        mysql_query("CREATE TABLE ".$_nodesforum_db_table_name_modifier."_nodesforum_users (uniqueID int NOT NULL AUTO_INCREMENT, PRIMARY KEY(uniqueID), email BLOB, password BLOB, validation_key varchar(100), public_name varchar(100), registration_time int NOT NULL) ENGINE = MYISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");
        mysql_query("CREATE TABLE ".$_nodesforum_db_table_name_modifier."_nodesforum_newemails (newemailID int NOT NULL AUTO_INCREMENT, PRIMARY KEY(newemailID), email BLOB, uniqueID int NOT NULL, validation_key varchar(100), time int NOT NULL) ENGINE = MYISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");
        mysql_query("CREATE TABLE ".$_nodesforum_db_table_name_modifier."_nodesforum_pss_rst_req (reqID int NOT NULL AUTO_INCREMENT, PRIMARY KEY(reqID), email BLOB, uniqueID int NOT NULL, request_key varchar(100), time int NOT NULL) ENGINE = MYISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");
        mysql_query("CREATE TABLE ".$_nodesforum_db_table_name_modifier."_nodesforum_remember_tokens (tokenID int NOT NULL AUTO_INCREMENT, PRIMARY KEY(tokenID), email BLOB, uniqueID int NOT NULL, token varchar(100), time int NOT NULL) ENGINE = MYISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

        mysql_query("CREATE TABLE ".$_nodesforum_db_table_name_modifier."_nodesforum_user_data (user_dataID int NOT NULL AUTO_INCREMENT, PRIMARY KEY(user_dataID), uniqueID varchar(100), avatar varchar(100), signature int NOT NULL, allow_posting_on_personal_page int NOT NULL, total_folders int NOT NULL, total_posts int NOT NULL, total_replies int NOT NULL, p1 int NOT NULL, p2 int NOT NULL, p3 int NOT NULL, p4 int NOT NULL, p1_time int NOT NULL, p2_time int NOT NULL, p3_time int NOT NULL, p4_time int NOT NULL) ENGINE = MYISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");
        mysql_query("CREATE TABLE ".$_nodesforum_db_table_name_modifier."_nodesforum_mods (modID int NOT NULL AUTO_INCREMENT, PRIMARY KEY(modID), mod_uniqueID varchar(100), folderID varchar(101), mod_level int NOT NULL, promotion_time int NOT NULL, reason text, ip BLOB) ENGINE = MYISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");
        mysql_query("CREATE TABLE ".$_nodesforum_db_table_name_modifier."_nodesforum_mods_log (logID int NOT NULL AUTO_INCREMENT, PRIMARY KEY(logID), fapID varchar(101), ancestry text, mod_uniqueID varchar(100), moded_uniqueID varchar(100), authoritative_folderID varchar(101), subaction_of int NOT NULL, action_time int NOT NULL, action_code varchar(10), action longtext, retrieval_number varchar(15)) ENGINE = MYISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");
        mysql_query("CREATE TABLE ".$_nodesforum_db_table_name_modifier."_nodesforum_3rd_party_tag_limits (tagID int NOT NULL AUTO_INCREMENT, PRIMARY KEY(tagID), tag_name varchar(100), user_limit int NOT NULL, guest_limit int NOT NULL) ENGINE = MYISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");


        //maybe soon!
        // //notification subscriptions table
        // mysql_query("CREATE TABLE ".$_nodesforum_db_table_name_modifier."_nodesforum_notification_subscriptions (
        //     subscriptionID int NOT NULL AUTO_INCREMENT, PRIMARY KEY(subscriptionID),
        //     fapID int NOT NULL,
        //     email BLOB NOT NULL,
        //     type varchar(50) NOT NULL,
        //     subscription_time int NOT NULL
        // ) ENGINE = MYISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

        $_nodesforum_tables_created=1;
    }
    else
    {$_nodesforum_error_creating_tables='<p><img src="'.$_nodesforum_warn_icon.'" style="vertical-align:text-bottom;border:none;" /> there was an error when attempting to create a table named '.$_nodesforum_db_table_name_modifier.'_nodesforum_folders_and_posts.</p>
        <p>error:<br />'.mysql_error().'</p>';}
}



if($_POST['_nodesforum_clone_old_tables'])
{
    if(mysql_query("CREATE TABLE ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts SELECT * FROM "._nodesforum_my_custom_addslashes($_POST['_nodesforum_old_startwith'])."_nodesforum_folders_and_posts"))
    {
        // TODO make sure all indexes are reproduced
        mysql_query("ALTER TABLE ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts ADD PRIMARY KEY(fapID)");
        mysql_query("ALTER TABLE ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts change fapID fapID int NOT NULL AUTO_INCREMENT");
        mysql_query("ALTER TABLE ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts ADD FULLTEXT(title, post)");
        mysql_query("CREATE TABLE ".$_nodesforum_db_table_name_modifier."_nodesforum_users SELECT * FROM "._nodesforum_my_custom_addslashes($_POST['_nodesforum_old_startwith'])."_nodesforum_users");
        mysql_query("ALTER TABLE ".$_nodesforum_db_table_name_modifier."_nodesforum_users ADD PRIMARY KEY(uniqueID)");
        mysql_query("ALTER TABLE ".$_nodesforum_db_table_name_modifier."_nodesforum_users change uniqueID uniqueID int NOT NULL AUTO_INCREMENT");
        mysql_query("CREATE TABLE ".$_nodesforum_db_table_name_modifier."_nodesforum_newemails SELECT * FROM "._nodesforum_my_custom_addslashes($_POST['_nodesforum_old_startwith'])."_nodesforum_newemails");
        mysql_query("ALTER TABLE ".$_nodesforum_db_table_name_modifier."_nodesforum_newemails ADD PRIMARY KEY(newemailID)");
        mysql_query("ALTER TABLE ".$_nodesforum_db_table_name_modifier."_nodesforum_newemails change newemailID newemailID int NOT NULL AUTO_INCREMENT");
        mysql_query("CREATE TABLE ".$_nodesforum_db_table_name_modifier."_nodesforum_pss_rst_req SELECT * FROM "._nodesforum_my_custom_addslashes($_POST['_nodesforum_old_startwith'])."_nodesforum_pss_rst_req");
        mysql_query("ALTER TABLE ".$_nodesforum_db_table_name_modifier."_nodesforum_pss_rst_req ADD PRIMARY KEY(reqID)");
        mysql_query("ALTER TABLE ".$_nodesforum_db_table_name_modifier."_nodesforum_pss_rst_req change reqID reqID int NOT NULL AUTO_INCREMENT");
        mysql_query("CREATE TABLE ".$_nodesforum_db_table_name_modifier."_nodesforum_remember_tokens SELECT * FROM "._nodesforum_my_custom_addslashes($_POST['_nodesforum_old_startwith'])."_nodesforum_remember_tokens");
        mysql_query("ALTER TABLE ".$_nodesforum_db_table_name_modifier."_nodesforum_remember_tokens ADD PRIMARY KEY(tokenID)");
        mysql_query("ALTER TABLE ".$_nodesforum_db_table_name_modifier."_nodesforum_remember_tokens change tokenID tokenID int NOT NULL AUTO_INCREMENT");

        mysql_query("CREATE TABLE ".$_nodesforum_db_table_name_modifier."_nodesforum_user_data SELECT * FROM "._nodesforum_my_custom_addslashes($_POST['_nodesforum_old_startwith'])."_nodesforum_user_data");
        mysql_query("ALTER TABLE ".$_nodesforum_db_table_name_modifier."_nodesforum_user_data ADD PRIMARY KEY(user_dataID)");
        mysql_query("ALTER TABLE ".$_nodesforum_db_table_name_modifier."_nodesforum_user_data change user_dataID user_dataID int NOT NULL AUTO_INCREMENT");
        mysql_query("CREATE TABLE ".$_nodesforum_db_table_name_modifier."_nodesforum_mods SELECT * FROM "._nodesforum_my_custom_addslashes($_POST['_nodesforum_old_startwith'])."_nodesforum_mods");
        mysql_query("ALTER TABLE ".$_nodesforum_db_table_name_modifier."_nodesforum_mods ADD PRIMARY KEY(modID)");
        mysql_query("ALTER TABLE ".$_nodesforum_db_table_name_modifier."_nodesforum_mods change modID modID int NOT NULL AUTO_INCREMENT");
        mysql_query("CREATE TABLE ".$_nodesforum_db_table_name_modifier."_nodesforum_mods_log SELECT * FROM "._nodesforum_my_custom_addslashes($_POST['_nodesforum_old_startwith'])."_nodesforum_mods_log");
        mysql_query("ALTER TABLE ".$_nodesforum_db_table_name_modifier."_nodesforum_mods_log ADD PRIMARY KEY(logID)");
        mysql_query("ALTER TABLE ".$_nodesforum_db_table_name_modifier."_nodesforum_mods_log change logID logID int NOT NULL AUTO_INCREMENT");
        mysql_query("CREATE TABLE ".$_nodesforum_db_table_name_modifier."_nodesforum_3rd_party_tag_limits SELECT * FROM "._nodesforum_my_custom_addslashes($_POST['_nodesforum_old_startwith'])."_nodesforum_3rd_party_tag_limits");
        mysql_query("ALTER TABLE ".$_nodesforum_db_table_name_modifier."_nodesforum_3rd_party_tag_limits ADD PRIMARY KEY(tagID)");
        mysql_query("ALTER TABLE ".$_nodesforum_db_table_name_modifier."_nodesforum_3rd_party_tag_limits change tagID tagID int NOT NULL AUTO_INCREMENT");

        //maybe soon!
        // //notification subscriptions table
        // mysql_query("CREATE TABLE ".$_nodesforum_db_table_name_modifier."_nodesforum_notification_subscriptions SELECT * FROM "._nodesforum_my_custom_addslashes($_POST['_nodesforum_old_startwith'])."_nodesforum_notification_subscriptions");
        // mysql_query("ALTER TABLE ".$_nodesforum_db_table_name_modifier."_nodesforum_notification_subscriptions ADD PRIMARY KEY(subscriptionID)");
        // mysql_query("ALTER TABLE ".$_nodesforum_db_table_name_modifier."_nodesforum_notification_subscriptions change subscriptionID subscriptionID int NOT NULL AUTO_INCREMENT");

        $_nodesforum_tables_created=1;
    }
    else
    {$_nodesforum_error_cloning_tables='<p><img src="'.$_nodesforum_warn_icon.'" style="vertical-align:text-bottom;border:none;" /> there was an error when attempting to create a table named '.$_nodesforum_db_table_name_modifier.'_nodesforum_folders_and_posts and copy the contents of the table named '.htmlspecialchars($_POST['_nodesforum_old_startwith']).'_nodesforum_folders_and_posts into it.</p>
        <p>error:<br />'.mysql_error().'</p>';}
}








?>