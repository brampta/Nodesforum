<?php

echo '<div style="height:4px;"><!-- --></div><div style="width:100%;"><table class="class_nodesforum_bgcolor3" style="width:100%;"><tr><td class="class_nodesforum_bgcolor2"><div class="class_nodesforum_inner">';


echo '<h4 style="text-align:center;margin:0px;">3rd party tag limits for users and guests: <span style="font-weight:normal;">(per post)</span></h4>';



echo '<center><table class="class_nodesforum_bgcolor3">';
foreach($bb_name as $key => $value)
{
	if($bb_type[$key]=='3rd party')
	{
		if($_nodesforum_3rd_party_tag_limits_specific_has_data[$key])
		{$howmany_3rd_party_user=$_nodesforum_3rd_party_tag_limits_user_specific[$key];}
		else
		{$howmany_3rd_party_user=$_nodesforum_3rd_party_tag_limits_user_default;}
		if($_nodesforum_3rd_party_tag_limits_specific_has_data[$key])
		{$howmany_3rd_party_guest=$_nodesforum_3rd_party_tag_limits_guest_specific[$key];}
		else
		{$howmany_3rd_party_guest=$_nodesforum_3rd_party_tag_limits_guest_default;}
		echo '<tr><td class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner"><a name="_nodesforum_3rd_party_tag_limit_setting_'.$key.'"></a><b>'.$value.':</b></div></td><td class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner">users:'.$howmany_3rd_party_user.'</div></td><td class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner">guests '.$howmany_3rd_party_guest.'</div></td>';
		if($_nodesforum_ismod==1)
		{echo '<td class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner"><acronym title="change limit"><a href="?_nodesforum_node=p4&_nodesforum_edit_3rd_party_tag_limit='.urlencode($key).'#_nodesforum_3rd_party_tag_limit_setting_'.urlencode($key).'"><img src="'.$_nodesforum_tool_icon.'" style="vertical-align:text-bottom;border:none;" /></a></acronym></div></td>';}
		echo'</tr>';


		if($_GET['_nodesforum_edit_3rd_party_tag_limit']==$key && $_nodesforum_ismod==1)
		{
			echo '<tr><td colspan="4" class="class_nodesforum_bgcolor2"><div class="class_nodesforum_inner"><form action="?_nodesforum_node=p4#_nodesforum_3rd_party_tag_limit_setting_'.urlencode($key).'" method="post">';
			echo 'set new limit for the '.$value.' tag<br />
				<table class="class_nodesforum_bgcolorinherit">
				<tr><td>users:</td><td><input type="text" name="_nodesforum_set_new_3rd_party_tag_limit_user" value="'.$howmany_3rd_party_user.'" /></td></tr>
				<tr><td>guests:</td><td><input type="text" name="_nodesforum_set_new_3rd_party_tag_limit_guest" value="'.$howmany_3rd_party_guest.'" /></td></tr>
				</table>
				<input type="hidden" name="_nodesforum_set_new_3rd_party_tag_limit_tag_name" value="'.$key.'" />
				<input type="submit" name="_nodesforum_set_new_3rd_party_tag_limit" value="set new limit" />';
			echo '</form></div></td></tr>';
		}

	}
}
echo '</table></center>';

echo '</div></td></tr></table></div>';


?>
