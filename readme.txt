nodesforum 1.065



if you have any difficulty installing the forum on your server, go to http://home.nodesforum.com/demo for help

also consider that it is possible to create your own nodesforum without having to install it to your own server by creating a free hosted forum at http://home.nodesforum.com/signup/




//==========================installing the forum
-create a folder on your server to place the forum into, you can call it whatever you want.

-copy all the files of the nodesforum into the folder you have created. (and the folders too)

-depending on the permissions on your server, it might be necessary to run a chmod -R 777 on the folders "images" and "cache" in the nodesforum files to make sure that nodesforum will be able to create/read/modify files in these folders (or set the permissions from your control panel)(depending on your server settings you might not need to do that step. anyways if you do need to do it and you dont, the forum will show some error messages about not beeing able to write files into its folders...)

-edit the config.php file in your new forum install make sure to answer all the questions in config.php unless it says that you dont have to, there are explanations under each setting in the config.php file.
*note that if you will use the user system of the nodesforum and create brand new tables instead of cloning existing ones, you will not be able to specify the uniqueID of the mainforum moderator because the profile has not been created yet. in this case just leave this field blank and come back to it later after you have created the tables and created your own profile.

-now you need to chose how you will include the forum to your site. if you want to include the forum in a page of your site, include it like this:
-------------------------------------
<?php include('nodesforum_folder/config.php'); include('nodesforum_folder/pre_output.php'); ?>
<html>
<head>
<title><?php echo $_nodesforum_title; ?></title>
</head>
<body>
<!--my header, my ads, ect..-->
<?php include('nodesforum_folder/body.php'); ?>
<!--page bottom, more ads, ect..-->
</body>
</html>
------------------------------------------
or like this:
<?php
include('nodesforum_folder/config.php');
include('nodesforum_folder/pre_output.php');
echo '<html><head><title>'.$_nodesforum_title.'</title></head><body><!--my header, my ads, ect..-->';
include('nodesforum_folder/body.php');
echo '<!--page bottom, more ads, ect..--></body></html>';
?>
---------------------------------------
or like this (working with your own site's user system):
<?php
session_start();
//run any session related scripts here... auto-login from cookie? logout banned? record user's last pageload?...

include('nodesforum_folder/config.php');
include('nodesforum_folder/pre_output.php');

echo '<html>
<head>
<title>'.$_nodesforum_title.'</title>
</head>
<body>';
//display site header here, top and left side ads, ect...

include('nodesforum_folder/body.php');

//display page bottom here, right side and bottom ads, ect...
echo '</body>
</html>';
?>
---------------------------------------
*the "config.php" must be included first, then the "pre_output.php" and then the "body.php"
*the "pre_output.php" must be included before any output, the "body.php" must be included in the <body> of the page
*the variable $_nodesforum_title will contain the title of the page
otherwise you can always also just use the forum by navigating to the folder you placed the forum in, example: http://mywebsite/nodesforum_folder
*in all cases, do not forget to replace "nodesforum_folder" by the actual path to the forum files on your server
note: if you use the user system of your own site and will include the forum in a page of yours, you must start the session with "session_start()" yourself before running the pre_output.php


-finally, navigate to the url of the forum and you should see the auto installer menu asking you to create tables. either create new tables or clone existing ones depending on what you need

-after you have created the tables, if you are installing a new forum and will use the user system of the forum, you need to create the main admin profile, so just register normally to create your profile, once your profile is created, find out your uniqueID by navigating to your forum page and specify that unique ID as the unique ID of the main forum mod in your config.php file


-once your forum is created and you have the main mod admin rights on it, you can start laying out the sections of your forum. only you and users who have moderator powers on the root of the forum will be able to create posts and folders on the root of the forum. so if you want ppl to be able to create posts or folders in your forum, you must create at least some folders on the root. these folders are the main categories of your forum.







//=========================getting rid of old user data (for if you use the forum with your own site's user system and you have an option for a user to erase their account, you will then be better to trigger the script to cleanup the forum data of a user too, heres how:)
add:

$_nodesforum_uniqueID_of_user_to_delete=x;
$_nodesforum_path_from_here_to_nodesforum_folder='x/x/';
$_nodesforum_conn_to_db_in_script='yes';
$_nodesforum_disconn_from_db_after_script='yes';
include($_nodesforum_path_from_here_to_nodesforum_folder.'erase_user_data.php');

to your user profile erasing script to remove the user data stored by the forum.

note that you must make sure that the uniqueID of the user you want to delete is set on "$_nodesforum_uniqueID_of_user_to_delete" and the path to the nodesforum folder from where you run the erase script is set on $_nodesforum_path_from_here_to_nodesforum_folder




//=========================using the last posts widget (last_posts_widget.php)
add:

$_nodesforum_lpw_howmany=10; //how many last posts will be shown
$_nodesforum_lpw_max_titlelen=100; //max lenght for title
$_nodesforum_lpw_title_css='style="font-weight:bold;font-size:14px;"'; //css style to be applied to title
$_nodesforum_lpw_max_post=300; //max lenght for post
$_nodesforum_lpw_post_css='style="font-size:12px;"'; //css style to be applied to post
$_nodesforum_lpw_link_target='_self';
$_nodesforum_lpw_include_replies=0;
$_nodesforum_lpw_cache_time_in_minutes=15;
$_nodesforum_lpw_widget_instance_cache_number=1; //if you run more than 1 widget instances with different settings for 1 same forum instance, specify a different number for each widget instance so that they each run their own separate cache
$_nodesforum_path_from_here_to_nodesforum_folder='joyousfolder/nodesforum_folder/'; //php (internal, server-side) path from running php script to nodesforum instance folder
$_nodesforum_path_from_here_to_nodesforum_HTML='/forum/index'; //HTML (external, client-side) path from webpage to nodesforum instance webpage (needed for linking to posts)
$_nodesforum_conn_to_db_in_script='yes';
$_nodesforum_select_db_in_script='yes';
$_nodesforum_disconn_from_db_after_script='yes';
$_nodesforum_skip_db_conn_if_cache='yes';
$_nodesforum_skip_db_select_if_cache='yes';
$_nodesforum_skip_db_disconn_if_cache='yes';
include($_nodesforum_path_from_here_to_nodesforum_folder.'last_posts_widget.php');





//======================whats new in nodesforum 1.065?
there was customs error reporting level set on all of the pages which caused problems, it has been removed completely so that nodesforum will respect the error reporting level that you chose in your php.ini instead
//======================whats new in nodesforum 1.064?
pre_add_post.php has been changed to fix a bug that caused the last post on a post or folder to be incorrectly determined.
//======================whats new in nodesforum 1.063?
last_posts_widget.php has been changed to fix a bug that caused an error message when $_nodesforum_lpw_include_replies was set to 1 but none of the last posts had a reply.
//======================whats new in nodesforum 1.062?
last_posts_widget.php has been added. this new script allows you to show an overview of the x last forum posts somewhere else on your site.
//======================whats new in nodesforum 1.061?
pre_create_tables.php has been changed to fix a small error that was preventing the "clone tables script" to work.
//======================whats new in nodesforum 1.060?
pre_output.php, 3rd_party_limits.php, bod_folder_view.php, body.php, erase_user_data.php, pre_else.php, pre_folder_view.php, xml_nodesforum_make_strict_quote.php and xml_nodesforum_move_browse.php have been changed. these files were changed to add an extra security against file inclusion attack because someone claims he is still able to execute a file inclusion attack despite the fix of 1.046
//======================whats new in nodesforum 1.059?
bod_mod_forms.php has been changed to fix 2 small display bugs that did not affect performance and pre_grant_p.php has been changed to fix a bug that prevented attribution of powe on risky bbcode tags without moderator privileges in the case of forums running on a website's already existing user system
//======================whats new in nodesforum 1.058?
bod_post_view.php and config.php have been changed to add the option of placing an ad after each first post. note that the change to config.php is optional (only 1 more var has been added) and if you do not have the change (ie. you still run with an old config.php) it will not cause any problem. Though if you want to use this new option to show an ad after each first post, you will need to have the new variable "$_nodesforum_code_of_ad_after_first_post" in your config.php. Instead of replacing your old config.php with the new one and having to replace all the values, it will probably be easier to simply add the line to your old config.php by copying it from the new, search for "$_nodesforum_code_of_ad_after_first_post" in the new config.php to find the new line.
//======================whats new in nodesforum 1.057?
the .php has been added at the end of all file names in _nodesforum_bbcode_interface.js, _nodesforum_move_js.js, bod_add_post.php, bod_forgot_password.php, bod_login.php and bod_register.php to fix it for those who dont have the MultiViews option enabled on their server.
//======================whats new in nodesforum 1.056?
pre_move.php has been changed. a small echo that was put there for testing purposes has been forgotten there, causing an error message but no real problem. it has been removed.
//======================whats new in nodesforum 1.055?
pre_else.php has been changed to fix a tiny bug that caused the move post page of a post in the root folder to be called move folder instead of move post.
//======================whats new in nodesforum 1.054?
bbcode.php has been changed to include veoh, hulu and myspace and become Nodesforum BBCODE version 1.001 which will now also be offered as a separate download
//======================whats new in nodesforum 1.053?
pre_create_tables.php has been changed. "ENGINE = MYISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci" has been added at the end of each table creation command to make sure that the tables will be created with proper charset and db engine and all. most people should normally have these as their defaults if they are on recent servers so that wont change anything for them, but for those whos mysql has different defaults this will insure compatibility.
//======================whats new in nodesforum 1.052?
bbcode.php was changed so that the google maps can work with any top level google domain of google (example .ca or .co.uk)
//======================whats new in nodesforum 1.051?
pre_verify_validity_of_strict_quotes.php was changed to fix a bug that caused strict quotes to not work when using you own site user system and the uniqueID row in your users DB is not named uniqueID (example "userID")
//======================whats new in nodesforum 1.050?
bod_forum_options.php has been changed. a small change so that when an uploaded avatar is refused because it is of a wrong mime type the detected mime type will be shown to the user
//======================whats new in nodesforum 1.049?
pre_output.php has been changed: the multibyte wordwrap function has been re-written.
//======================whats new in nodesforum 1.048?
a custom error has been added to warn the people if the forum is unable to write in the folders "images" or "cache" (telling them to go set permissions properly)
//======================whats new in nodesforum 1.047?
it was pointed out that the nodesforum is open for "PHP Remote File Inclusion" attack for those who have both "register_globals" and "allow_url_fopen" enabled on their server. 1.047 contains a fix to this problem.
erase_user_data.php, pre_output.php, 3rd_party_limits.php, bod_folder_view.php, body.php, pre_else.php, pre_folder_view.php, xml_nodesforum_make_strict_quote.php and xml_nodesforum_move_browse.php were changed for this update.
//======================whats new in nodesforum 1.046?
pre_move.php has been changed to fix a few little bugs that were causing the update of the contained subfolders and post on parent to not be counted right all the time on a move operation
xml_nodesforum_move_browse.php has been changed so that folders in the move browse ajax menu appear in the same order than when browsing the forum normally
bod_folder_view.php and pre_sticky_move.php have been changed so that when changing the position of sticky elements, the page will reload to the anchor of the element you are moving, making the manipulation more easy on crowded pages.
bod_folder_view.php has been changed so that folders dont show what they contain 0 of anymore, instead the only show what they contain or empty if they dont contain anything, a similar update has been made for the posts too
pre_output.php, bbcode.php, bod_post.php and config.php (optional parameters added) have been changed to break long words without spaces in a way that now supports utf-8
//======================whats new in nodesforum 1.045?
bod_post_view.php and bod_folder_view.php have been changed again: the update that was supposed to add scrolling bars on posts larger than the page or abusively long from 1.034 has been entirely redone, but this time using only CSS (except for limiting long posts internet explorer needs to use javascript because it does not support the max-height property). this new solution to add scrolling bars on posts is extremely stable because it does not use javascript to measure things anymore, its a real breakthrough :D now i can finaly sit back and be confident that the javascript to limit large posts is not gonna do anymore weird things, its entirely gone and replaced by plane old CSS
body.php has been changed to revert it to how it was before 1.034
//======================whats new in nodesforum 1.044?
bod_post_view.php has been changed to tweak that javascript function that handles large content in posts
//======================whats new in nodesforum 1.043?
bbcode.php has been slightly changed to add a line break after the code cos IE was placing the scrollbar inside of the code window, hiding the last line.
//======================whats new in nodesforum 1.042?
more tiny adjustements in bod_post_view.php in the code that protects from huge contents in posts
//======================whats new in nodesforum 1.041?
pre_delete.php and pre_restore.php were changed to fix a bug that caused removing or restoring all posts from a user or IP from a folder that is not in database such as root, userpage or power page to not get logged in mods_log
bod_folder_view.php has been changed so that moderator buttons would not appear in history view
//======================whats new in nodesforum 1.040?
pre_delete.php and pre_restore.php were changed to fix a bug that caused the "last post" to not be correctly calculated on all the parents when an element was deleted or restored.
bbcode.php was changed to fix a bug that caused 3rd party tags to be rendered in quotes but not when posted by users or guests within their allowed limit. it was supposed to be the other way around.
//======================whats new in nodesforum 1.039?
following the eye candy update of 1.035  the [code] tag had lost its ability to scroll for long codes and was instead making the whole post scroll. but incredibly it appears that i found a way to fix that without losing the visual update of 1.035 (tables and divs have very different behaviors it seems), and at the same time make the space added at the bottom of each post to fix a bug with IE a bit smaller. these changes were all in the file bod_post_view.php
//======================whats new in nodesforum 1.038?
yet again changed bbocode.php and bod_post_view.php to change the way long words are cut and also adjust the javascript that brings back long posts to normal size from 1.034, to make it work better in all situations
//======================whats new in nodesforum 1.037?
corrected a bug in the 1.036 update
//======================whats new in nodesforum 1.036?
more little display adjustements.
this time bod_post_view.php and bbcode.php have been changed to make sure that the system against big posts from 1.034 works well in a situation where the forum is very squeezed and the page take time to finish loading because of multiple ads.
//======================whats new in nodesforum 1.035?
bod_post_view.php has been changed to make the posts display in a slightly prettier way (added padding around them, which i had to remove for an update in 1.034 but i finaly found a way to get my padding back). also a small issue whit internet explorer showing a useless vertical scrolling bar when it poped a horizontal scrolling bar has been fixed.
//======================whats new in nodesforum 1.034?
bod_post_view.php, bod_folder_view.php, bbcode.php and body.php(this change has become useless since 1.045) have been changed so that posts that contain abusively large or high content will get individual scrolling bars instead of stretching the page
bbcode.php was changed to improve the way [code] tags are displayed
bbcode.php was changed to *potentially cut off a fraction of second from the parsing time (many parsing while loops were doing 1 useless extra loop if a tag is opened but not valid cos not closed...)
bbcode.php has been changed so that long words with no spaces will be cut off
bbcode.php and _nodesforum_js.js were changed to add a link that selects the code to the code tag
//======================whats new in nodesforum 1.033?
bbcode.php has been changed so that tables will now be parsed manually instead of processed by the main preg_replace(). this way only table with valid structures can be rendered to prevent breaking the page display but nested table are still possible.
pre_move.php and pre_pre_move.php have been changed so that the number of posts or subfolders will be updated on old and new container when an element is moved
pre_move.php, bod_move.php and _nodesforum_move_js.js have been changed to prevent moving a folder into itself
pre_create_tables.php has been changed so that when cloning tables the folders_and_posts table will be forced to be in MyISAM in the same fashion than when it is created from scratch
_nodesforum_bbcode_interface.js has been changed to fix a tiny bug in the function to build a loose quote that caused the resulting quote to be [QUOTEundefined] when the source was left empty, it will now be [QUOTE] or [QUOTE source="my grandmother"] as it was supposed to be
//======================whats new in nodesforum 1.032?
pre_output.php has been changed to force the database connection to run in standard mode (not strict)
//======================whats new in nodesforum 1.031?
turns out the update in 1.030 didnt work, did it differently and had to change bod_add_folder.php bod_add_post.php pre_add_folder.php and pre_add_post.php for that
//======================whats new in nodesforum 1.030?
bod_add_folder.php and bod_add_post.php have been modified to show more details in case of error posting to the db
//======================whats new in nodesforum 1.029?
bod_post_view.php has been changed so that ppls post will not be contained in a <p> tag anymore because a <p> tag cannot contains some of the tags that are used to build quotes and other things..
pre_val2b.php was changed to fix a bug when changing email (bug will cause the user account to not be possible to log-in into anymore, email should be rentered manually on the database to fix ("UPDATE blah_nodesforum_users set email = AES_ENCRYPT('john@rabb.com','john@rabb.com') WHERE uniqueID = '17'"))
//======================whats new in nodesforum 1.028?
changed pre_registerb.php to change "email validification" to "email validation"
//======================whats new in 1.027?
bbcode.php has been changed to allow demonstration of bbcode tags inside of the [code] tag (anything but [/code])
//======================whats new in nodesforum 1.026?
pre_create_tables.php has been changed to force the table of folders and posts to be created with the MyISAM engine
//======================whats new in nodesforum 1.025?
tiny change in bbcode.php to fix a bug that caused auto-smileys to "eat" 1 of the spaces preceding them
//======================whats new in nodesforum 1.024?
tiny change in bbcode.php to make the code tag display better
change in bbcode.php to fix a bug with the basic URL tag (bug did not affect auto-links)
//======================whats new in nodesforum 1.023?
index.php has been changed to start the session if you will use the user system of your own site but will use the forum without including it in a page of yours (but simply by navigating to the folder in which you placed the forum instead)
note: if you use the user system of your own site and will include the forum in a page of yours, you must start the session with "session_start()" yourself before running the pre_output.php
//======================whats new in nodesforum 1.022?
bbcode.php has been changed to make html shown with no html power look better (shows like the [code] tag)
bbcode.php, pre_verify_validity_of_strict_quotes.php and xml_nodesforum_make_strict_quote.php have been changed to enable strict quoting of guests and deleted users posts
error_reporting(E_ALL ^ E_NOTICE); has been added to the 2 xml files (xml_nodesforum_make_strict_quote.php and xml_nodesforum_move_browse.php) and image_verification.php to make sure they dont show PHP notices
//======================whats new in nodesforum 1.021?
bbcode.php has been changed to better handle line breaks before and after code and table tags so that [code]blah[/code] gives the same result than
[code]
blah
[/code]
//======================whats new in nodesforum 1.020?
pre_output.php has been changed to disable the PHP notices (E_NOTICE) that show when undeclared variables are compared on servers that are set to show the notices by default
//======================whats new in nodesforum 1.019?
pre_create_tables.php was changed so that the function mysql_error() will be invoked when creating the tables is not successful to help ppl see more easily what causes the table creation to fail
bbcode.php was changed to make the [code] tag look better
fixed a bug in pre_create_tables.php that cause table installion to fail
//======================whats new in nodesforum 1.018?
bbcode.php has been changed to add the valign attribute to the [td] tag
bbcode.php has been changed so that the first linebreak after some of the tags (all table tags, all alignement tags and the code tag) will be ignored to allow the user to write tables more intuitively in his/her post without resulting in having full of unplanned line breaks (basically this update makes the bbcode behave more like html in the writing of tables while still conservating the users line breaks in the text, which html does not do)
bbcode.php has been changed to change the way auto-smileys work, they will now only be rendered if following the start or the text, a line break or a space. which in turn allowed me to re-enable safely :/ but i did not re-enable 80 cos ppl might wanna write the number 80 in their posts.. like in "i puked 80 times"
//======================whats new in nodesforum 1.017?
the file pre_willread_user_data.php has been changed to correct the little bug that caused risky powers to not work on the forum options page
bbcode.php has been changed so that default text color in table will be inherited from parent element
bbcode.php has been changed to add the colspan and rowspan attributes to the [td] tag
//======================whats new in nodesforum 1.016?
the file bbcode.php was changed so that the tags [left], [center] and [right] would also align tables
//======================whats new in nodesforum 1.015?
fixed the resize pictures script in _nodesforum_js.js so that small pictures wont be stretched
changed bod_add_post.php so that the bbcode legend on the bottom would appear in a box with scroll bars so that the forum can fit in a smaller area (example globolister.com)
//======================whats new in nodesforum 1.014?
the file pre_create_tables.php was changed to fix a bug that was affecting the process of cloning old tables. the clones created had no primary key. but that problem is now fixed.
//======================whats new in nodesforum 1.013?
the file bbcode.php has been changed to disable the auto smiley :/ cos it was bugging links
//======================whats new in nodesforum nodesforum 1.012?
the file bbcode.php has been changed so that the number 80 would not become a big eyes big mouth smiley anymore when auto-smileys is on cos it caused a bug when some code contained the number 80
//======================whats new in nodesforum 1.011?
the file pre_permalink.php has been changed to fix a bug which was causing the permalink to be broken
//======================whats new in nodesforum 1.01?
just little display adjustements. the file bbcode.php and the file bod_folder_view.php have been updated to fix a display bug with the quotes and to make it so that post and folder names in the folder view wont be shown in a too small box..





if you experience any problem, please go to home.nodesforum.com and ask your question in the support forum, or click "contact me" in the navigation  and email me your questions directly


