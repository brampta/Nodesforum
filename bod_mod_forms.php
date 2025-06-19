<?php


if($_nodesforum_folder_or_post==1)
{$isa='folder';}
else if($_nodesforum_folder_or_post==2)
{$isa='post';}

$lowestpowertogive=$_nodesforum_mod_level;
if($lowestpowertogive<1)
{$lowestpowertogive=1;}

$the_thing='this '.$isa;
if(substr($_GET['_nodesforum_node'],0,1)=='p')
{
	$this_node=$_GET['_nodesforum_node'];
	$the_thing='the '.$_nodesforum_risky_bbcode_title[$this_node];
}







	
$modpart_text='';

//show this folders moderators
if($_nodesforum_demod_cannotdemodowner==1)
{$modpart_text=$modpart_text.'<img src="'.$_nodesforum_warn_icon.'" style="vertical-align:text-bottom;border:none;" /> you cannot remove moderator powers from the creator of the '.$isa.'.<br />';}
if($_nodesforum_demod_usernotmodhere==1)
{$modpart_text=$modpart_text.'<img src="'.$_nodesforum_warn_icon.'" style="vertical-align:text-bottom;border:none;" /> the user uniqueID that you entered does not correspond to an existing moderator on this '.$isa.'.<br />';}
if($_nodesforum_demod_cannotdemodmorepowerful==1)
{$modpart_text=$modpart_text.'<img src="'.$_nodesforum_warn_icon.'" style="vertical-align:text-bottom;border:none;" /> you cannot remove moderator powers from someone with a more or equally powerful moderator level.<br />';}
if($_nodesforum_demod_suxxess==1)
{$modpart_text=$modpart_text.'you have successfully removed moderator powers from <a href="?_nodesforum_node=u'.$_nodesforum_remember_grant_moderee.'">'.htmlspecialchars($remembermoddedpublicname).'</a> on this '.$isa.'.<br />';}


if($_nodesforum_display_mod_uniqueID)
{
	
	$modpart_text=$modpart_text.'<h4 style="margin:0px;">moderators of '.$the_thing.'</h4>';
	$modpart_text=$modpart_text.'<div style="width:100%;"><table class="class_nodesforum_bgcolor3" style="width:100%;">';
	foreach($_nodesforum_display_mod_uniqueID as $key => $value)
	{
		$this_mod_uniqueID=$_nodesforum_display_mod_uniqueID[$key];
		if($_nodesforum_display_mod_level[$key]<1)
		{$showmodlevel='&infin;';}
		else
		{$showmodlevel=$_nodesforum_display_mod_level[$key];}
		$modstring='';
		if($lowestpowertogive<=$_nodesforum_display_mod_level[$key] && $_nodesforum_ismod==1)
		{$modstring=' <acronym title="modify moderator level" style="border:none;"><a onclick="_nodesforum_modmod('."'".$this_mod_uniqueID."'".','.$_nodesforum_display_mod_level[$key].')" style="cursor:pointer;"><img src="'.$_nodesforum_tool_icon.'" style="vertical-align:text-bottom;border:none;" /></a></acronym><acronym title="remove moderator powers" style="border:none;"><a onclick="_nodesforum_demod('."'".$this_mod_uniqueID."'".','."'".urlencode($_nodesforum_display_creator_publicname[$this_mod_uniqueID])."'".','."'".$_GET['_nodesforum_node']."'".','.$_GET['_nodesforum_page'].')" style="cursor:pointer;"><img src="'.$_nodesforum_delete_icon.'" style="vertical-align:text-bottom;border:none;" /></a></acronym>';}
		$modpart_text=$modpart_text.'<tr><td class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner"><img src="'.$_nodesforum_tool_icon.'" style="vertical-align:text-bottom;border:none;" /> <a href="?_nodesforum_node=u'.$this_mod_uniqueID.'">'.htmlspecialchars($_nodesforum_display_creator_publicname[$this_mod_uniqueID]).'</a> (level: '.$showmodlevel.')'.$modstring.'</div></td></tr>';
	}
	$modpart_text=$modpart_text.'</table></div>';

}
	

		
	
//grant moderator powers form
$modpart_text=$modpart_text.'<a name="grant"></a>';
	
if($_nodesforum_grant_cannotgivethatmodstren==1)
{$modpart_text=$modpart_text.'<img src="'.$_nodesforum_warn_icon.'" style="vertical-align:text-bottom;border:none;" /> you can only give moderator powers of level '.$lowestpowertogive.' or more here (the lowest number is the strongest power).<br />';}
if($_nodesforum_grant_usernotfound==1)
{$modpart_text=$modpart_text.'<img src="'.$_nodesforum_warn_icon.'" style="vertical-align:text-bottom;border:none;" /> the user uniqueID that you entered does not correspond to any existing user.<br />';}
if($_nodesforum_grant_personyouwannamodisalreadyhigher==1)
{$modpart_text=$modpart_text.'<img src="'.$_nodesforum_warn_icon.'" style="vertical-align:text-bottom;border:none;" /> you cannot change the moderator level of someone with a more or equally powerful moderator level.<br />';}
if($_nodesforum_grant_cannotchangeowner==1)
{$modpart_text=$modpart_text.'<img src="'.$_nodesforum_warn_icon.'" style="vertical-align:text-bottom;border:none;" /> you cannot change the owner of the '.$isa.'.<br />';}
if($_nodesforum_grant_modmodded==1)
{$modpart_text=$modpart_text.'you have successfully granted moderator powers of level '.$_nodesforum_remember_grant_given_level.' to <a href="?_nodesforum_node=u'.$_nodesforum_remember_grant_moderee.'">'.htmlspecialchars($remembermoddedpublicname).'</a> on this '.$isa.'.<br />';}
if($_nodesforum_ismod==1)
{
	$modpart_text=$modpart_text.'<div style="height:4px;"><!-- --></div><div style="width:100%;"><table class="class_nodesforum_bgcolor3" style="width:100%;"><tr><td class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner">';
	$modpart_text=$modpart_text.'<h4 style="margin:0px;">grant moderator powers on '.$the_thing.'</h4>';
	$modpart_text=$modpart_text.'<form action="?_nodesforum_node='.$_GET['_nodesforum_node'].'&_nodesforum_page='.$_GET['_nodesforum_page'].'#grant" method="post">
		user uniqueID:<br />
		<input type="text" name="_nodesforum_moderated_uniqueID" value="'.$_POST['_nodesforum_moderated_uniqueID'].'" id="grant_uniqueID" /><br />
		granted moderator level ('.$lowestpowertogive.' or +, the lowest level beeing the most powerful):<br />
		<input type="text" name="_nodesforum_moderated_given_level" value="'.$_POST['_nodesforum_moderated_given_level'].'" id="grant_level" /><br />
		<input type="submit" name="_nodesforum_grant_mod" value="grant power" />
		</form>';
	$modpart_text=$modpart_text.'</div></td></tr></table></div>';
}


if($modpart_text!='')
{
	echo '<div style="height:4px;"><!-- --></div><div style="width:100%;"><table class="class_nodesforum_bgcolor3" style="width:100%;"><tr><td class="class_nodesforum_bgcolor2"><div class="class_nodesforum_inner">';
	echo $modpart_text;
	echo '</div></td></tr></table></div>';
}





if(substr($_GET['_nodesforum_node'],0,1)=='p')
{

	$powerspart_text='';




	//show power holders
			
	if($_nodesforum_remove_p_usernopower==1)
	{$powerspart_text=$powerspart_text.'<img src="'.$_nodesforum_warn_icon.'" style="vertical-align:text-bottom;border:none;" /> <a href="?_nodesforum_node=u'.$_nodesforum_remember_grant_moderee.'">'.htmlspecialchars($remembermoddedpublicname).'</a> does not have '.$the_thing.'.<br />';}
	if($_nodesforum_remove_p_ismod==1)
	{$powerspart_text=$powerspart_text.'<img src="'.$_nodesforum_warn_icon.'" style="vertical-align:text-bottom;border:none;" /> you cannot remove '.$the_thing.' from <a href="?_nodesforum_node=u'.$_nodesforum_remember_grant_moderee.'">'.htmlspecialchars($remembermoddedpublicname).'</a> because <a href="?_nodesforum_node=u'.$_nodesforum_remember_grant_moderee.'">'.htmlspecialchars($remembermoddedpublicname).'</a> is moderator of '.$the_thing.'.<br />';}
	if($_nodesforum_remove_p_suxxess==1)
	{$powerspart_text=$powerspart_text.'you have successfully removed '.$the_thing.' from <a href="?_nodesforum_node=u'.$_nodesforum_remember_grant_moderee.'">'.htmlspecialchars($remembermoddedpublicname).'</a>.<br />';}

	if($_nodesforum_display_poweree)
	{
		$powerspart_text=$powerspart_text.'<h4 style="margin:0px;">holders of '.$the_thing.'</h4>';
		$powerspart_text=$powerspart_text.'<div style="width:100%;"><table class="class_nodesforum_bgcolor3" style="width:100%;">';
		foreach($_nodesforum_display_poweree as $key => $value)
		{
			$this_uniqueID=$_nodesforum_display_poweree[$key];
			$modstring='';
			if($_nodesforum_ismod==1)
			{$modstring=' <acronym title="remove power" style="border:none;"><a onclick="_nodesforum_depow('."'".$this_uniqueID."'".','."'".urlencode($_nodesforum_display_creator_publicname[$this_uniqueID])."'".','."'".$_GET['_nodesforum_node']."'".','.$_GET['_nodesforum_page'].','."'".$the_thing."'".')" style="cursor:pointer;"><img src="'.$_nodesforum_delete_icon.'" style="vertical-align:text-bottom;border:none;" /></a></acronym>';}
			$powerspart_text=$powerspart_text.'<tr><td class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner"><img src="'.$_nodesforum_power_icon.'" style="vertical-align:text-bottom;border:none;" /> <a href="?_nodesforum_node=u'.$this_uniqueID.'">'.htmlspecialchars($_nodesforum_display_creator_publicname[$this_uniqueID]).'</a>'.$modstring.'</div></td></tr>';
		}
		$powerspart_text=$powerspart_text.'</table></div>';
	}
	









	//grant powers form
        $powerspart_text=$powerspart_text.'<a name="grantp"></a>';

	if($_nodesforum_grantp_usernotfound==1)
	{$powerspart_text=$powerspart_text.'<img src="'.$_nodesforum_warn_icon.'" style="vertical-align:text-bottom;border:none;" /> the user uniqueID that you entered does not correspond to any existing user.<br />';}
	if($_nodesforum_grantp_alreadyhve==1)
	{$powerspart_text=$powerspart_text.'<img src="'.$_nodesforum_warn_icon.'" style="vertical-align:text-bottom;border:none;" /> <a href="?_nodesforum_node=u'.$_nodesforum_remember_grant_moderee.'">'.htmlspecialchars($remembermoddedpublicname).'</a> already has '.$the_thing.'.<br />';}
	if($_nodesforum_remove_p_usernotmodhere==1)
	{$powerspart_text=$powerspart_text.'you have successfully granted '.$the_thing.' to <a href="?_nodesforum_node=u'.$_nodesforum_remember_grant_moderee.'">'.htmlspecialchars($remembermoddedpublicname).'</a>.<br />';}

	if($_nodesforum_ismod==1)
	{
		$powerspart_text=$powerspart_text.'<div style="height:4px;"><!-- --></div><div style="width:100%;"><table class="class_nodesforum_bgcolor3" style="width:100%;"><tr><td class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner">';
		$powerspart_text=$powerspart_text.'<h4 style="margin:0px;">grant '.$the_thing.'</h4>
			<form action="?_nodesforum_node='.$_GET['_nodesforum_node'].'&_nodesforum_page='.$_GET['_nodesforum_page'].'#grantp" method="post">
			user uniqueID:<br />
			<input type="text" name="_nodesforum_moderated_uniqueIDb" value="'.$_POST['_nodesforum_moderated_uniqueIDb'].'" id="grant_uniqueID" /><br />
			<input type="submit" name="_nodesforum_grant_p" value="grant power" />
			</form>';
		$powerspart_text=$powerspart_text.'</div></td></tr></table></div>';
	}










	if($powerspart_text!='')
	{
		echo '<div style="height:4px;"><!-- --></div><div style="width:100%;"><table class="class_nodesforum_bgcolor3" style="width:100%;"><tr><td class="class_nodesforum_bgcolor2"><div class="class_nodesforum_inner">';
		echo $powerspart_text;
		echo '</div></td></tr></table></div>';
	}





}



$banpart_text='';


//show banned
if($_nodesforum_display_banned_uniqueID)
{
	$banpart_text=$banpart_text.'<h4 style="margin:0px;">banned from '.$the_thing.'</h4>';
	$banpart_text=$banpart_text.'<div style="width:100%;"><table class="class_nodesforum_bgcolor3" style="width:100%;">';
	foreach($_nodesforum_display_banned_uniqueID as $key => $value)
	{
		$this_uniqueID=$_nodesforum_display_banned_uniqueID[$key];
		$modstring='';
		if($_nodesforum_ismod==1)
		{$modstring=' <acronym title="unban" style="border:none;"><a onclick="_nodesforum_unban('."'".$this_uniqueID."'".','."'".urlencode($_nodesforum_display_creator_publicname[$this_uniqueID])."'".','."'".$_GET['_nodesforum_node']."'".','.$_GET['_nodesforum_page'].')" style="cursor:pointer;"><img src="'.$_nodesforum_delete_icon.'" style="vertical-align:text-bottom;border:none;" /></a></acronym>';}
		$banpart_text=$banpart_text.'<tr><td class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner"><img src="'.$_nodesforum_no2_icon.'" style="vertical-align:text-bottom;border:none;" /> <a href="?_nodesforum_node=u'.$this_uniqueID.'">'.htmlspecialchars($_nodesforum_display_creator_publicname[$this_uniqueID]).'</a>'.$modstring.'<br />
		reason: '.htmlspecialchars($_nodesforum_display_banned_reason[$key]).'</div></td></tr>';
	}
	$banpart_text=$banpart_text.'</table></div>';
}



if($_nodesforum_ismod==1)
{


	$banpart_text=$banpart_text.'<a name="_nodesforum_ban"></a><div style="height:4px;"><!-- --></div><div style="width:100%;"><table style="width:100%;" class="class_nodesforum_bgcolor3 respo"><tr class="respo"><td style="width:33%;vertical-align:top;" class="class_nodesforum_bgcolor1 respo"><div class="class_nodesforum_inner">';
	
	
	
	//ban
	if($_nodesforum_ban_usernotfound==1)
	{$banpart_text=$banpart_text.'<img src="'.$_nodesforum_warn_icon.'" style="vertical-align:text-bottom;border:none;" /> the user uniqueID that you entered does not correspond to any existing user.<br />';}
	if($_nodesforum_ban_cannotchangeowner==1)
	{$banpart_text=$banpart_text.'<img src="'.$_nodesforum_warn_icon.'" style="vertical-align:text-bottom;border:none;" /> you cannot ban the creator of the '.$isa.'.<br />';}
	if($_nodesforum_ban_already_banned==1)
	{$banpart_text=$banpart_text.'<img src="'.$_nodesforum_warn_icon.'" style="vertical-align:text-bottom;border:none;" /> this user is already banned.<br />';}
	if($_nodesforum_ban_reason_is_blank==1)
	{$banpart_text=$banpart_text.'<img src="'.$_nodesforum_warn_icon.'" style="vertical-align:text-bottom;border:none;" /> please provide a reason for the banning.<br />';}
	if($_nodesforum_ban_banned==1)
	{$banpart_text=$banpart_text.'you have successfully banned <a href="?_nodesforum_node=u'.$_nodesforum_remember_grant_moderee.'">'.htmlspecialchars($remembermoddedpublicname).'</a> from this '.$isa.'.<br />';}
		
	$banpart_text=$banpart_text.'<h4 style="margin:0px;">ban user from '.$the_thing.'</h4>
		<form action="?_nodesforum_node='.$_GET['_nodesforum_node'].'&_nodesforum_page='.$_GET['_nodesforum_page'].'#_nodesforum_ban" method="post">
		user uniqueID:<br />
		<input type="text" name="_nodesforum_banned_uniqueID" value="'.$_POST['_nodesforum_banned_uniqueID'].'" /><br />
		reason:<br />
		<textarea style="width:200px;height:60px;" name="_nodesforum_banned_reason">'.$_POST['_nodesforum_banned_reason'].'</textarea><br />
		<input type="submit" name="_nodesforum_ban" value="ban" />
		</form>';		

	
	
	$banpart_text=$banpart_text.'</div></td><td style="width:34%;vertical-align:top;" class="class_nodesforum_bgcolor1 respo"><div class="class_nodesforum_inner">';
	
	$banpart_text=$banpart_text.'<h4 style="margin:0px;">see posts from a user in '.$the_thing.'</h4>';
	
	$banpart_text=$banpart_text.'<form method="get">
		<input type="hidden" name="_nodesforum_node" value="h'.$_GET['_nodesforum_node'].'" />
		user uniqueID:<br />
		<input type="text" name="_nodesforum_history_user" /><br />
		<input type="submit" value="see" />
		</form>';
	
	
	$banpart_text=$banpart_text.'</div></td><td style="width:33%;vertical-align:top;" class="class_nodesforum_bgcolor1 respo"><div class="class_nodesforum_inner">';
	

	$banpart_text=$banpart_text.'<h4 style="margin:0px;">erase all posts from a user in '.$the_thing.'</h4>';
	$banpart_text=$banpart_text.'<form method="get">
		<input type="hidden" name="_nodesforum_node" value="'.$_GET['_nodesforum_node'].'" />
		<input type="hidden" name="_nodesforum_delete" value="'.$_GET['_nodesforum_node'].'" />
		<input type="hidden" name="_nodesforum_page" value="'.$_GET['_nodesforum_page'].'" />
		user uniqueID:<br />
		<input type="text" name="_nodesforum_delete_user" value="'.addslashes($_GET['_nodesforum_delete_user']).'" /><br />
		<input type="checkbox" name="_nodesforum_delete_imsure" /> im sure<br />
		<input type="submit" value="delete all" />
		</form>';
	
	
	$banpart_text=$banpart_text.'</div></td></tr></table></div>';


}





//show banned ip
if($_nodesforum_display_banned_ip_ip)
{
	$banpart_text=$banpart_text.'<h4 style="margin:0px;">IP addresses banned from '.$the_thing.'</h4>';
	$banpart_text=$banpart_text.'<div style="width:100%;"><table class="class_nodesforum_bgcolor3" style="width:100%;">';
	foreach($_nodesforum_display_banned_ip_ip as $key => $value)
	{
		$modstring='';
		if($_nodesforum_ismod==1)
		{$modstring=' <acronym title="unban" style="border:none;"><a onclick="_nodesforum_unban_ip('."'".urlencode(base64_encode($value))."'".','."'".$_GET['_nodesforum_node']."'".','.$_GET['_nodesforum_page'].')" style="cursor:pointer;"><img src="'.$_nodesforum_delete_icon.'" style="vertical-align:text-bottom;border:none;" /></a></acronym>';}
		$banpart_text=$banpart_text.'<tr><td class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner"><img src="'.$_nodesforum_no2_icon.'" style="vertical-align:text-bottom;border:none;" /> <input type="text" value="'.base64_encode($value).'" readonly="readonly" onmouseup="highlight(this)" />'.$modstring.'<br />
		reason: '.htmlspecialchars($_nodesforum_display_banned_ip_reason[$key]).'</div></td></tr>';
	}
	$banpart_text=$banpart_text.'</table></div>';
}









if($_nodesforum_ismod==1)
{

	$banpart_text=$banpart_text.'<a name="_nodesforum_ban_ip"></a><div style="width:100%;"><table style="width:100%;" class="class_nodesforum_bgcolor3 respo"><tr class="respo"><td style="width:33%;vertical-align:top;" class="class_nodesforum_bgcolor1 respo"><div class="class_nodesforum_inner">';



	//ban ip
	if($_nodesforum_ban_ip_notfound==1)
	{$banpart_text=$banpart_text.'<img src="'.$_nodesforum_warn_icon.'" style="vertical-align:text-bottom;border:none;" /> the encrypted IP that you entered does not correspond to the IP address associated with any post of this forum.<br />';}
	if($_nodesforum_ban_ip_already_banned==1)
	{$banpart_text=$banpart_text.'<img src="'.$_nodesforum_warn_icon.'" style="vertical-align:text-bottom;border:none;" /> this IP address already banned.<br />';}
	if($_nodesforum_ban_ip_reason_is_blank==1)
	{$banpart_text=$banpart_text.'<img src="'.$_nodesforum_warn_icon.'" style="vertical-align:text-bottom;border:none;" /> please provide a reason for the banning of the IP address.<br />';}
	if($_nodesforum_ban_ip_banned==1)
	{$banpart_text=$banpart_text.'you have successfully banned the IP '.htmlspecialchars($_POST['_nodesforum_banned_ip']).' (the IP is encrypted).<br />';}
	
	$banpart_text=$banpart_text.'<h4 style="margin:0px;">ban an IP address from '.$the_thing.'</h4>
		<form action="?_nodesforum_node='.$_GET['_nodesforum_node'].'&_nodesforum_page='.$_GET['_nodesforum_page'].'#_nodesforum_ban_ip" method="post">
		encrypted IP:<br />
		<input type="text" name="_nodesforum_banned_ip" value="'.$_POST['_nodesforum_banned_ip'].'" /><br />
		reason:<br />
		<textarea style="width:200px;height:60px;" name="_nodesforum_banned_ip_reason">'.$_POST['_nodesforum_banned_ip_reason'].'</textarea><br />
		<input type="submit" name="_nodesforum_ban_ip" value="ban IP" />
		</form>';





	$banpart_text=$banpart_text.'</div></td><td style="width:34%;vertical-align:top;" class="class_nodesforum_bgcolor1 respo"><div class="class_nodesforum_inner">';

	
	$banpart_text=$banpart_text.'<h4 style="margin:0px;">see posts from an ip in '.$the_thing.'</h4>';
	
	$banpart_text=$banpart_text.'<form method="get">
		<input type="hidden" name="_nodesforum_node" value="h'.$_GET['_nodesforum_node'].'" />
		encrypted IP:<br />
		<input type="text" name="_nodesforum_history_ip" /><br />
		<input type="submit" value="see" />
		</form>';
	
	
	$banpart_text=$banpart_text.'</div></td><td style="width:33%;vertical-align:top;" class="class_nodesforum_bgcolor1 respo"><div class="class_nodesforum_inner">';
	

	$banpart_text=$banpart_text.'<h4 style="margin:0px;">erase all posts from an ip in '.$the_thing.'</h4>';
	$banpart_text=$banpart_text.'<form method="get">
		<input type="hidden" name="_nodesforum_node" value="'.$_GET['_nodesforum_node'].'" />
		<input type="hidden" name="_nodesforum_delete" value="'.$_GET['_nodesforum_node'].'" />
		<input type="hidden" name="_nodesforum_page" value="'.$_GET['_nodesforum_page'].'" />
		encrypted IP:<br />
		<input type="text" name="_nodesforum_delete_ip" value="'.addslashes($_GET['_nodesforum_delete_ip']).'" /><br />
		<input type="checkbox" name="_nodesforum_delete_imsure" /> im sure<br />
		<input type="submit" value="delete all" />
		</form>';
	
	
	$banpart_text=$banpart_text.'</div></td></tr></table></div>';



}


if($banpart_text!='')
{
	echo '<div style="height:4px;"><!-- --></div><div style="width:100%;"><table class="class_nodesforum_bgcolor3" style="width:100%;"><tr><td class="class_nodesforum_bgcolor2"><div class="class_nodesforum_inner">';
	echo $banpart_text;
	echo '</div></td></tr></table></div>';
}



if($_nodesforum_ismod==1)
{
	echo '<div style="height:4px;"><!-- --></div><div style="width:100%;"><table class="class_nodesforum_bgcolor3" style="width:100%;"><tr><td class="class_nodesforum_bgcolor2"><div class="class_nodesforum_inner">';


	//posts history link
	echo '<div style="text-align:right;"><a href="?_nodesforum_node=h'.$_GET['_nodesforum_node'].'" style="font-size:80%;">see the posts history of this '.$isa;
	if($_nodesforum_folder_or_post==1)
	{echo ' and its children';}
	//mods log link
	echo '<div style="text-align:right;"><a href="?_nodesforum_node=l'.$_GET['_nodesforum_node'].'" style="font-size:80%;">see the log of moderator actions on this '.$isa;
	if($_nodesforum_folder_or_post==1)
	{echo ' and its children';}
	echo '</a></div>';


	echo '</div></td></tr></table></div>';
}






