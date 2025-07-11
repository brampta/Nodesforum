<?php

//chose a name for the forum
$_nodesforum_forum_name='NodesForum Development install'; //the name of your forum
$_nodesforum_forum_name_at_or_at_the='at the'; //should we say at *forum name* or at the *forum name* (to and to the will be assumed accordingly)
$_nodesforum_forum_description='[center][size=130]Welcome to the [color=red][b]Development install[/b][/color] of the Nodesform.[/size][/center]'; //the description of your root folder. will appear on the first page of the forum


//------------DATABASE CONNECTION
$_nodesforum_db_servername='localhost'; //host for database connection
$_nodesforum_db_username='nodesman'; //username for database connection
$_nodesforum_db_password='8*8420jfdeIU'; //password for database connection
$_nodesforum_db_name='nodesforum'; //name of database to use
$_nodesforum_db_table_name_modifier='test10'; //the value of this variable (a string) will be added at the beginning of every table name used by the forum (only including the tables that have been created by the forum itself). with this variable you can for example run multiple nodesforum forums on 1 same database by setting a different unique string on this variable for each forum. This will be also useful if you want to update your forum version by allowing you to install and try the new version of the forum without affecting or even stopping your old version from running. since the value that you set on this variable will become part of all your table names, avoid any non standard characters.


//--------------PATH TO nodesforum CODE
$_nodesforum_code_path='test_nodesforum/'; //the relative path to access the nodesforum script folder from the page where the forum is included (not needed if you do not use the forum as a php include())


//--------------SERVER SETTINGS
$_nodesforum_magic_quotes_on_or_off='off'; //does your php have magic quotes on or off


//-----------------------USER SYSTEM
$_nodesforum_use_external_user_system='no'; //if no the forum will have its own user system if yes the forum will use the already existing user system of your site (this value must not be changed once there already are posts in the forum or it will bug everything)

//------------INTERNAL USER SYSTEM SETTINGS (only needed if $_nodesforum_use_external_user_system=='no')
$_nodesforum_minimum_password_length=8; //min lenght of passwords
$_nodesforum_image_verification_on_registration='yes'; //will ask for image verification when user registers. requires the gd php extension
$_nodesforum_image_verification_on_forgotten_pass='yes'; //will ask for image verification when user has password resent to his email. requires the gd php extension
$_nodesforum_image_verification_on_resend_validation_mail='yes'; //will ask for image verification when user has validation email resent. requires the gd php extension
$_nodesforum_validate_email='yes'; //if yes user will have to validate email when registering if no email validation will be skipped
$_nodesforum_email_from='admin@home.nodesforum.com'; //emails sent from your server will be from this address
$_nodesforum_validate_email_address_from='admin@home.nodesforum.com'; //validation emails sent from your server will be from this address
$_nodesforum_validate_resend_password_from='admin@home.nodesforum.com'; //password reset request links sent from your server will be from this address
$_nodesforum_instance_asolute_URL='http://home.nodesforum.com/test'; //emails sent by your server need to contain links that link back to the forum. this must be set to the URL of the root of the forum. the URL after which we can add a ? and then some variables


//-----------EXTERNAL USER SYSTEM SETTINGS (only needed if $_nodesforum_use_external_user_system=='yes')
$_nodesforum_external_user_system_site_name=''; //the name of the main website from which we are using the user system
$_nodesforum_external_user_system_site_name_at_or_at_the=''; //should we say at *main site name* or at the *main site name*
$_nodesforum_external_user_system_uniqueID_session_name=''; //name of the php session variable in which you keep track of your users uniqueID
$_nodesforum_external_user_system_table_name=''; //name of the users table
$_nodesforum_external_user_system_user_uniqueID_rowname=''; //name of the column in which you store the users uniqueID in your users table
$_nodesforum_external_user_system_publicname_rowname=''; //name of the column in which you store the users name or public name in your users table
$_nodesforum_external_user_system_show_registration_time='yes'; //does your users table contain a column where the registration time of the user is recorded (in unix timestamp format)
$_nodesforum_external_user_system_registration_time_rowname=''; //if yes what is the name of the column where the registration time of the user is recorded
$_nodesforum_external_user_system_userpage_link=''; //how should we build the links to the user pages on your main site (will take the value in this variable and will append the user uniqueID to it to build the link to the userpage)

$_nodesforum_show_login_logout_bar='yes'; //yes or no. should we show the login/logout bar (is automatically shown if you use the user system of the forum, but optional if you use the user system of your website)
$_nodesforum_external_user_system_loginusername_session_name=''; //what is the name of the php session variable in which you keep the username or email that the user logged in with to be able to say "logged in as..."
$_nodesforum_external_user_system_login_link=''; //link to your login page from the forum
$_nodesforum_external_user_system_logout_link=''; //link to your logout page from the forum
$_nodesforum_external_user_system_register_link=''; //link to your register page from the forum
$_nodesforum_external_user_system_profile_options_link=''; //link for logged in user to get to his profile options page from the forum


//-------------technical (only change if $_nodesforum_use_external_user_system=='yes' and there is a conflict, otherwise leave to default)
$_nodesforum_ancestry_separator='|'; //must be a char or string that cannot be contained in user uniqueID and is not an integer or a letter. using just 1 char will allow the forum to have more subflder depth (this value must not be changed once there already are posts in the forum or it will bug everything)
$_nodesforum_uniqueID_of_deleted_user='[du]'; //must be a value that is not a possible user uniqueID (this value must not be changed once there already are deleted users posts in the forum or it will bug everything)


//------------------MODERATOR POWERS
$_nodesforum_main_mod_uniqueID='1'; //for the forum to work, there must be a main admin. if you use the already existing user system of your own site, put in your own profiles uniqueID on your site here. if you use the user system of the forum, please install the forum and register yourself an account first. then put in the uniqueID of your newly created account here to get main moderator powers.
$_nodesforum_keep_delete_forxhours=365*24; //anything that is deleted becomes invisible but is still kept in the background for this amount of hours so that it can be restored if needed



//-----------AVATAR OPTIONS
$_nodesforum_avatars_on_off='on'; //on or off if on people will be able to upload their picture for their avatar, if off people will not have any picture
$_nodesforum_avatars_max_filesize=2*(1024*1024); //the max size (in bytes) of the pictures that people can upload for their avatar



//------------GUEST OPTIONS
$_nodesforum_allow_guest_replies='yes'; //yes or no. if yes, when users create posts they will be able to chose if they want to allow guests to reply or not. if no guest replies will not be possible.
$_nodesforum_image_verification_on_guest_reply='yes'; //yes or no. if yes when guest reply they will be needed to pass the image verification. php gd extension is needed for that. if no guests will be able to post comments without any image verification (not recommended because of spam-bots)
$_nodesforum_allow_guests_to_edit_their_posts_for_x_hours=72; //guests are allowed to edit or delete replies from their own ip until they are x hours old



//------------PAGE OPTIONS
$_nodesforum_howmany_posts_perpage=50; //how many post and folders per page in folder view
$_nodesforum_howmany_replies_perpage=20; //how many replies per page in post view
$_nodesforum_howmany_search_results_perpage=20; //how many results per page in search view
$_nodesforum_howmany_moderator_actions_perpage=20; //how many actions per page in mods log view
$_nodesforum_minimum_post_length=16; //min lenght of a post
$_nodesforum_minimum_reply_length=3; //min lenght of a reply
$_nodesforum_show_how_deep_of_you_are_here=5; //show x folders deep in the navigation menu
$_nodesforum_max_word_length_in_titles=30; //words longer than this in titles will have their middle replaced by dots (...) and will have an acronym on them that shows the whole word when you put your mouse over them. thats to avoid that the pages get fucked up when someone puts long words with no spaces in the title of their post or folder
$_nodesforum_code_of_ad_after_first_post=''; //the html code that you place in this variable will be output after each first post



//------------COLORS
$_nodesforum_background_color1='#000000'; //main background color
$_nodesforum_background_color2='#333333'; //secondary background color
$_nodesforum_frames_color='#666666'; //color of table borders and other frames
$_nodesforum_bottom_color='#000000'; //background color of forum
$_nodesforum_text_color='#FFFFFF'; //normal text color (should be readable on the 2 background colors)
$_nodesforum_link_color='#FFD328'; //link color (should be readable on the 2 background colors)
$_nodesforum_link_visited_color='#D4CA68'; //visited link color (should be readable on the 2 background colors)
$_nodesforum_link_hover_color='#FFFF99'; //mouse-over link color (should be readable on the 2 background colors)



//------------PRIVACY AND SECURITY
$_nodesforum_php_encyption_for_IP_addresses='sha512'; //to grant ultimate privacy to your users, passwords and email addresses area already encrypted with AES at the database level (applies if you use nodesforum user system). IP addresses are also recorded with each post (to allow IP banning and to allow guests to edit/delete their posts) but they must be encrypted with an algo that php can do. since chinese have recently cracked md5 and sha1 and a bunch of other we recommend that you use something better. run "print_r(hash_algos());" in php to see what algorythms are available on your php install. It is safe to change this setting anytime but doing it will render any previously banned IP useless and cut off guests from the possibility of editing their posts from before the change.
$_nodesforum_delete_ips_after_x_days=365*2; //ip addresses on the forum might be encrypted with an algorythm that we cannot decode today but maybe some day it will be decryptable. to guarantee the greatest level of privacy to the users of your forum it is best to not keep the ip addresses on posts forever. the number you set on this variable will be the number of days after which ip addresses associated with posts are erased
$_nodesforum_keep_ips_banned_for_x_days=30; //most people do not use static ip addresses. someone could have an ip today and another tomorow and someone else could have his first ip. for that reason it is not a good idea to permanently ban an ip address. the number you set on this variable will be the number of days for which a ban on an ip will last


//------------MAIL
$_nodesforum_mailer='php'; //php, uses mail() or custom, drops to a function in a file of your choosing
$_nodesforum_mailer_custom_file='/var/www/html/mymailer/sendmailcustom.php'; //the path of the file where you will write your custom mail function, like this:
/*
 * function send_mail_custom($to, $toname, $from, $fromname, $subject, $message_html, $message_text){
 *  //do stuff
 * }
 */

//------------OTHER
$_nodesforum_admin_email = 'info@intercode.ca'; //notifications about new posts and other admin notifications will be sent to this email address