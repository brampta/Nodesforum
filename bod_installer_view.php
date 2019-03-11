<?php


echo '<div style="height:4px;"><!-- --></div><div style="width:100%;"><table class="class_nodesforum_bgcolor3" style="width:100%;"><tr><td class="class_nodesforum_bgcolor2"><div class="class_nodesforum_inner">';


if($_nodesforum_tables_created==1)
{echo '<table class="class_nodesforum_bgcolor3" style="width:100%;"><tr><td class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner">

the tables have been created successfully. the forum should now be ready. click <a href="?_nodesforum_node=0">here</a> to go to the root of the forum

</div></td></tr></table></div>';}
else
{


echo '<h3 style="margin:0px;">auto-installer</h3>';

echo '<p style="margin:0px;">the connection to the database was successful but the query to read the posts and folders in your forum did not work. this could possibly be because you have not yet created the tables to run the forum..</p>';

echo '<p style="margin:0px;">this forum is trying to read the set of tables starting with "'.$_nodesforum_db_table_name_modifier.'" which was not successful.</p>';


echo '<p style="margin:0px;">you can either:

<table class="class_nodesforum_bgcolorinherit"><tr><td style="text-align:left;vertical-align:top;">

<table class="class_nodesforum_bgcolor3" style="width:100%;"><tr><td class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner">
<h4 style="margin:0px;">create blank tables</h4>'.$_nodesforum_error_creating_tables.'
<p style="margin:0px;">create new empty tables starting with "'.$_nodesforum_db_table_name_modifier.'"</p>

<form method="post"><input type="submit" name="_nodesforum_create_new_tables" value="create new tables" /></form>

</div></td></tr></table></div>

</td><td style="text-align:center;vertical-align:middle;">
or
</td><td style="text-align:left;vertical-align:top;">

<table class="class_nodesforum_bgcolor3" style="width:100%;"><tr><td class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner">
<h4 style="margin:0px;">clone old tables</h4>'.$_nodesforum_error_cloning_tables.'
<p style="margin:0px;">create new tables starting with "'.$_nodesforum_db_table_name_modifier.'" from a copy of another set of tables.</p>

<form method="post">clone tables starting with:<br /><input type="text" name="_nodesforum_old_startwith" value="'.$_POST['_nodesforum_old_startwith'].'" /><br />
<input type="submit" name="_nodesforum_clone_old_tables" value="create clone" /></form>
*note that after cloning the old tables, the new forum will be ready to run on the old data except that the users avatars wont show. to complete process you will need to manually copy all the pictures in the images/****/avatar/ folder of the old forum to the images/****/avatar/ folder of the new forum

</div></td></tr></table></div>

</td></tr></table>

</p>';

}

echo '</div></td></tr></table></div>';



?>