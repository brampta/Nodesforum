<?php


		echo '<div style="height:4px;"><!-- --></div><div style="width:100%;"><table class="class_nodesforum_bgcolor3" style="width:100%;"><tr><td class="class_nodesforum_bgcolor2"><div class="class_nodesforum_inner">';
		
		
		echo '<h4 style="margin:0px;">'.htmlspecialchars($_nodesforum_this_user_publicname).$userpage_link.'</h4>';
		
		
		echo '<table style="width:100%;" class="class_nodesforum_bgcolorinherit"><tr><td style="vertical-align:top;">';

		

		if($_nodesforum_userpage_avatar!='')
		{echo '<table class="class_nodesforum_bgcolor3"><tr><td><img src="'.$_nodesforum_mysterypath.'/avatars/'.$_nodesforum_userpage_avatar.'" style="width:140px;height:140px;" id="post_avatar_userpic" onload="resize_pic(140, 140, '."'post_avatar_userpic'".')" /></td></tr></table>';}
	
		echo '</td><td style="vertical-align:top;">';


		




		


		echo '<table style="font-size:80%;" class="class_nodesforum_bgcolor3">';
		
		echo '<tr><td class="class_nodesforum_bgcolor2"><div class="class_nodesforum_inner">uniqueID:</div></td><td class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner">'.substr($_GET['_nodesforum_node'],1).'</td></td></tr>';

		$userpage_link='';
		if($_nodesforum_use_external_user_system=='yes')
		{$userpage_link='<tr><td colspan="2" class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner"><a href="'.$_nodesforum_external_user_system_userpage_link.substr($_GET['_nodesforum_node'],1).'">userpage '.$_nodesforum_external_user_system_site_name_at_or_at_the.' '.$_nodesforum_external_user_system_site_name.'</a></div></td></tr>';}
		echo $userpage_link;


		if($_nodesforum_this_user_registration_time!=0)
		{
			echo '<tr><td class="class_nodesforum_bgcolor2"><div class="class_nodesforum_inner">member since:</div></td><td class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner"><script type="text/javascript">
			var writness = _nodesforum_maketimus('.$_nodesforum_this_user_registration_time.');
			document.write(writness);
			</script></div></td></tr>';
		}
		
		
		echo '<tr><td class="class_nodesforum_bgcolor2"><div class="class_nodesforum_inner"><img src="'.$_nodesforum_folder_icon.'" style="vertical-align:text-bottom;border:none;" /> folders:</div></td><td class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner">'.$_nodesforum_userpage_total_folders.'</div></td></tr>
		<tr><td class="class_nodesforum_bgcolor2"><div class="class_nodesforum_inner"><img src="'.$_nodesforum_post_icon.'" style="vertical-align:text-bottom;border:none;" /> posts:</div></td><td class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner">'.$_nodesforum_userpage_total_posts.'</div></td></tr>
		<tr><td class="class_nodesforum_bgcolor2"><div class="class_nodesforum_inner"><img src="'.$_nodesforum_reply_icon.'" style="vertical-align:text-bottom;border:none;" /> replies:</div></td><td class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner">'.$_nodesforum_userpage_total_replies.'</div></td></tr>

		<tr><td colspan="2" class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner"><img src="'.$_nodesforum_history_icon.'" style="vertical-align:text-bottom;border:none;" /> <a href="?_nodesforum_node=h0&_nodesforum_history_user='.$this_creator_uniqueID.'">posting history</a></div></td></tr>';

		$hasa_p=0;
		foreach($_nodesforum_userpage_pn as $key => $value)
		{
			if($value==1)
			{$hasa_p=1;}
		}
		if($hasa_p==1)
		{
			echo '<tr><td class="class_nodesforum_bgcolor1" colspan="2"><div class="class_nodesforum_inner">';
			foreach($_nodesforum_userpage_pn as $key => $value)
			{
				if($value==1)
				{echo '<img src="'.$_nodesforum_power_icon.'" style="vertical-align:text-bottom;border:none;" /> <a href="?_nodesforum_node='.$key.'">'.$_nodesforum_risky_bbcode_title[$key].'</a><br />';}
			}
			echo '</div></td></tr>';
		}
		
		echo '</table>';
	
		echo '</td><td style="vertical-align:top;">';
	
		if($_nodesforum_userpage_signature!=0 && $_nodesforum_userpage_signature_post!='')
		{
			echo '<div style="width:100%;"><table class="class_nodesforum_bgcolor3" style="width:100%;"><tr><td class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner"><p style="padding:10px;margin:0px;">'.display_bb($_nodesforum_userpage_signature_post,$_nodesforum_folder_p_inf_str,1,$_nodesforum_userpage_signature_post_disable_auto_smileys,$_nodesforum_userpage_signature_post_disable_auto_links,0).'</p></div></td></tr></table>';
		}
	
		echo '</div></td></tr></table></td></tr></table></div>';




?>
