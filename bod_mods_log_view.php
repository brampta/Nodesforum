<?php



if($_nodesforum_ismod==1 || (isset($_SESSION[$_nodesforum_external_user_system_uniqueID_session_name]) && $_SESSION[$_nodesforum_external_user_system_uniqueID_session_name]==$_GET['_nodesforum_log_moded']))
{




	function show_element($element_fapID,$element_title,$element_folder_or_post,$element_containing_folder_or_post)
	{
		global $_nodesforum_home_icon;
		global $_nodesforum_userhome_icon;
		global $_nodesforum_power_icon;
		global $_nodesforum_reply_icon;
		global $_nodesforum_folder_icon;
		global $_nodesforum_post_icon;
		global $_nodesforum_display_folder_and_post_titles;
		global $_nodesforum_display_user_publicname;
		global $_nodesforum_max_word_length_in_titles;
                global $_nodesforum_display_folder_and_post_deletion_time;

		global $_nodesforum_risky_bbcode_title;

		if(substr($element_fapID,0,1)=='u')
		{
			$user_uniqueID=substr($element_fapID,1);
			$user_publicname=$_nodesforum_display_user_publicname[$user_uniqueID];
			$last_letter=substr($user_publicname,strlen($user_publicname)-1);
			$proprS='s';
			if($last_letter=='s' || $last_letter=='z')
			{$proprS='';}
			return '<img src="'.$_nodesforum_userhome_icon.'" style="vertical-align:text-bottom;border:none;" /> <a href="?_nodesforum_node='.$element_fapID.'">'._nodesforum_display_title($user_publicname,$_nodesforum_max_word_length_in_titles)."'".$proprS.' forum page</a>';
		}
		if(substr($element_fapID,0,1)=='p')
		{
			$powername=$_nodesforum_risky_bbcode_title[$element_fapID];
			return '<img src="'.$_nodesforum_power_icon.'" style="vertical-align:text-bottom;border:none;" /> <a href="?_nodesforum_node='.$element_fapID.'">'._nodesforum_display_title($powername,$_nodesforum_max_word_length_in_titles).'</a>';
		}
		else if($element_folder_or_post=='2' && substr($element_containing_folder_or_post,0,1)=='p')
		{
			$containing_fapID=substr($element_containing_folder_or_post,1);
			return '<img src="'.$_nodesforum_reply_icon.'" style="vertical-align:text-bottom;border:none;" /> <a href="?_nodesforum_permalink='.$element_fapID.'&ghost=1#_nodesforum_anchor_'.$element_fapID.'">reply</a> on <a href="?_nodesforum_node='.$containing_fapID.'">'._nodesforum_display_title($_nodesforum_display_folder_and_post_titles[$containing_fapID],$_nodesforum_max_word_length_in_titles).'</a>';
		}
		else
		{
			if($element_fapID==0)
			{$this_icon=$_nodesforum_home_icon;}
			else if($element_folder_or_post==1)
			{$this_icon=$_nodesforum_folder_icon;}
			else if($element_folder_or_post==2)
			{$this_icon=$_nodesforum_post_icon;}
			return '<img src="'.$this_icon.'" style="vertical-align:text-bottom;border:none;" /> <a href="?_nodesforum_node='.$element_fapID.'">'._nodesforum_display_title($element_title,$_nodesforum_max_word_length_in_titles).'</a>';
		}
	}

	function make_user_link($uniqueID,$publicname)
	{
		global $_nodesforum_uniqueID_of_deleted_user;
		global $_nodesforum_max_word_length_in_titles;
		if($uniqueID=='0' || $uniqueID==$_nodesforum_uniqueID_of_deleted_user)
		{$user_link='<i>'._nodesforum_display_title($publicname,$_nodesforum_max_word_length_in_titles).'</i>';}
		else
		{$user_link='<a href="?_nodesforum_node=u'.$uniqueID.'">'._nodesforum_display_title($publicname,$_nodesforum_max_word_length_in_titles).'</a>';}
		return $user_link;
	}



	function _nodesforum_variable_setter($var_name,$var_value,$link_text)
	{
		global $_nodesforum_ismod;
		$thelink='?_nodesforum_node='.$_GET['_nodesforum_node'].'&_nodesforum_log_exclude_self='.$_GET['_nodesforum_log_exclude_self'];
		if($_nodesforum_ismod!=1)
		{$thelink=$thelink.'&_nodesforum_log_moded='.$_GET['_nodesforum_log_moded'];}
		$thelink=$thelink.'&'.$var_name.'='.$var_value;
		return '<a href="'.$thelink.'">'.$link_text.'</a>';
	}
	function _nodesforum_variable_adder($var_name,$var_value,$link_text)
	{
		$thelink='?_nodesforum_node='.$_GET['_nodesforum_node'].'&_nodesforum_log_exclude_self='.$_GET['_nodesforum_log_exclude_self'];
		foreach($_GET as $key => $value)
		{
			if($key!='_nodesforum_node' & $key!=$var_name)
			{$thelink=$thelink.'&'.$key.'='.$value;}
		}
		$thelink=$thelink.'&'.$var_name.'='.$var_value;
		return '<a href="'.$thelink.'">'.$link_text.'</a>';
	}
	function _nodesforum_variable_remover($var_name,$link_text)
	{
		$thelink='?_nodesforum_node='.$_GET['_nodesforum_node'].'&_nodesforum_log_exclude_self='.$_GET['_nodesforum_log_exclude_self'];
		foreach($_GET as $key => $value)
		{
			if($key!='_nodesforum_node' & $key!=$var_name)
			{$thelink=$thelink.'&'.$key.'='.$value;}
		}
		return '<a href="'.$thelink.'">'.$link_text.'</a>';
	}









	echo '<div style="height:4px;"><!-- --></div><div style="width:100%;"><table class="class_nodesforum_bgcolor3" style="width:100%;"><tr><td class="class_nodesforum_bgcolor2"><div class="class_nodesforum_inner">';





	if($_nodesforum_restore_post_or_folder_has_no_right==1)
	{echo '<img src="'.$_nodesforum_warn_icon.'" style="vertical-align:text-bottom;border:none;" /> you do not have the permission to post in the folder that you have chosen please chose another.<br />';}
	if($_nodesforum_restore_cannot_restore_reply_if_post_is_deleted==1)
	{echo '<img src="'.$_nodesforum_warn_icon.'" style="vertical-align:text-bottom;border:none;" /> you cannot restore this reply because the post that was containing it has been deleted.<br />';}
	if($_nodesforum_restore_node_noexist==1)
	{echo '<img src="'.$_nodesforum_warn_icon.'" style="vertical-align:text-bottom;border:none;" /> the element that you are trying to restore does not exist. when an item is deleted, it is kept in memory for '.$_nodesforum_keep_delete_forxhours.' hours and then permanently deleted.<br />';}







	if(isset($_GET['_nodesforum_log_mod']))
	{
		$uniqueID=$_GET['_nodesforum_log_mod'];
		echo '<div style="height:4px;"><!-- --></div><div style="width:100%;"><table class="class_nodesforum_bgcolor3" style="width:100%;"><tr><td class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner">';
		echo 'moderator: '.make_user_link($uniqueID,$_nodesforum_display_user_publicname[$uniqueID]).' ('._nodesforum_variable_remover('_nodesforum_log_mod','-').')';
		echo '</div></td></tr></table></div>';
	}
	if(isset($_GET['_nodesforum_log_moded']))
	{
		$uniqueID=$_GET['_nodesforum_log_moded'];
		echo '<div style="height:4px;"><!-- --></div><div style="width:100%;"><table class="class_nodesforum_bgcolor3" style="width:100%;"><tr><td class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner">';
		echo 'moderated: '.make_user_link($uniqueID,$_nodesforum_display_user_publicname[$uniqueID]).' ('._nodesforum_variable_remover('_nodesforum_log_moded','-').')';
		echo '</div></td></tr></table></div>';
	}
	if(isset($_GET['_nodesforum_log_moded_ip']))
	{
		echo '<div style="height:4px;"><!-- --></div><div style="width:100%;"><table class="class_nodesforum_bgcolor3" style="width:100%;"><tr><td class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner">';
		echo 'ip address (encrypted): <input type="text" value="'.addslashes($_GET['_nodesforum_log_moded_ip']).'" readonly="readonly" onmouseup="highlight(this)" /> ('._nodesforum_variable_remover('_nodesforum_log_moded_ip','-').')';
		echo '</div></td></tr></table></div>';
	}
	if(isset($_GET['_nodesforum_log_code']))
	{
		echo '<div style="height:4px;"><!-- --></div><div style="width:100%;"><table class="class_nodesforum_bgcolor3" style="width:100%;"><tr><td class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner">';
		echo 'action code: '.$_GET['_nodesforum_log_code'].' ('._nodesforum_variable_remover('_nodesforum_log_code','-').')';
		echo '</div></td></tr></table></div>';
	}


	if($_GET['_nodesforum_log_exclude_self']==1)
	{
		echo '<div style="height:4px;"><!-- --></div><div style="width:100%;"><table class="class_nodesforum_bgcolor3" style="width:100%;"><tr><td class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner">';
		echo 'exclude actions where moderator and moderated are the same user: yes ('._nodesforum_variable_adder('_nodesforum_log_exclude_self','0','-').')';
		echo '</div></td></tr></table></div>';
	}
	else
	{echo '<div>'._nodesforum_variable_adder('_nodesforum_log_exclude_self','1','exclude actions where moderator and moderated are the same user').'</div>';}




	$pagination='';
	if($_nodesforum_totalpages>1)
	{
		$previouspage='';
		if($_GET['_nodesforum_page']>1)
		{
			$previouspage='<a href="?_nodesforum_node='.$_GET['_nodesforum_node'].'&_nodesforum_page='.($_GET['_nodesforum_page']-1);
			foreach($_GET as $key => $value)
			{
				if($key!='_nodesforum_node' && $key!='_nodesforum_page')
				{$previouspage=$previouspage.'&'.$key.'='.$value;}
			}
			$previouspage=$previouspage.'">previous</a> | ';
		}
		$nextpage='';
		if($_GET['_nodesforum_page']<$_nodesforum_totalpages)
		{
			$nextpage=' | <a href="?_nodesforum_node='.$_GET['_nodesforum_node'].'&_nodesforum_page='.($_GET['_nodesforum_page']+1);
			foreach($_GET as $key => $value)
			{
				if($key!='_nodesforum_node' && $key!='_nodesforum_page')
				{$nextpage=$nextpage.'&'.$key.'='.$value;}
			}
			$nextpage=$nextpage.'">next</a>';
		}
		$pagination='<div style="height:4px;"><!-- --></div><div style="width:100%;"><table class="class_nodesforum_bgcolor3" style="width:100%;"><tr><td class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner">'.$previouspage.'page '.$_GET['_nodesforum_page'].' of '.$_nodesforum_totalpages.$nextpage.'</div></td></tr></table></div>';
	}
	
	
	echo $pagination.'<div style="height:4px;"><!-- --></div><div style="width:100%;"><table style="width:100%;" class="class_nodesforum_bgcolor3">';
	if($_nodesforum_display_logID)
	{




		$countem=0;
		foreach($_nodesforum_display_logID as $key => $value)
		{


			if(substr($key,0,5)!='main_')
			{

				$countem++;
				if($countem==1)
				{echo '<tr>
				<th class="class_nodesforum_bgcolor2"><div class="class_nodesforum_inner">folder or post</div></th>
				<th class="class_nodesforum_bgcolor2"><div class="class_nodesforum_inner">moderator</div></th>
				<th class="class_nodesforum_bgcolor2"><div class="class_nodesforum_inner">moderated</div></th>
				<th class="class_nodesforum_bgcolor2"><div class="class_nodesforum_inner">authority from</div></th>
				<th class="class_nodesforum_bgcolor2"><div class="class_nodesforum_inner">time</div></th>
				<th class="class_nodesforum_bgcolor2"><div class="class_nodesforum_inner">code</div></th>
				<th class="class_nodesforum_bgcolor2"><div class="class_nodesforum_inner">description</div></th>
				</tr>';}
	
				$thismoderatorID=$_nodesforum_display_mod_uniqueID[$key];
				$thismoderatedID=$_nodesforum_display_moded_uniqueID[$key];
	
	
	
					
				$this_folder_or_postID=$_nodesforum_display_fapID[$key];
				$this_folder_or_post=show_element($this_folder_or_postID,$_nodesforum_display_folder_and_post_titles[$this_folder_or_postID],$_nodesforum_display_folder_and_post_folder_or_posts[$this_folder_or_postID],$_nodesforum_display_folder_and_post_containing_folder_or_posts[$this_folder_or_postID]);
	
	
				$this_authoritative_folder_or_postID=$_nodesforum_display_authoritative_folderID[$key];
				$this_authoritative_folder_or_post=show_element($this_authoritative_folder_or_postID,$_nodesforum_display_folder_and_post_titles[$this_authoritative_folder_or_postID],$_nodesforum_display_folder_and_post_folder_or_posts[$this_authoritative_folder_or_postID],$_nodesforum_display_folder_and_post_containing_folder_or_posts[$this_authoritative_folder_or_postID]);


				$restore_button='';
				if($_nodesforum_display_action_code[$key]=='DEL')
				{
					$has_the_right=0;
					if($_nodesforum_remember_modership_folders[$this_folder_or_postID])
					{$has_the_right=1;}
					else
					{
						$exploded_ancestry=explode($_nodesforum_ancestry_separator,$_nodesforum_display_folder_and_post_ancestry[$this_folder_or_postID]);
						foreach($exploded_ancestry as $key2 => $value2)
						{
							if($_nodesforum_remember_modership_folders[$value2])
							{$has_the_right=1;}
						}
					}
					if($has_the_right==1)
					{
						if($_nodesforum_display_subaction_of[$key]==0)
						{$main_action=$value;}
						else
						{$main_action=$_nodesforum_display_subaction_of[$key];}
						$this_fapID=$_nodesforum_display_fapID[$key];
						if($_nodesforum_display_folder_and_post_folder_or_posts[$this_fapID]==1)
						{$isa='folder';}
						else if(substr($_nodesforum_display_folder_and_post_containing_folder_or_posts[$this_fapID],0,1)=='p')
						{$isa='reply';}
						else
						{$isa='post';}
						$restore_button=' <div>(<img src="'.$_nodesforum_restore_icon.'" style="vertical-align:text-bottom;border:none;" /> <a onclick="_nodesforum_restore(1, '.$main_action.', '."'".$this_fapID."'".', '."'".$isa."'".', '."'".urlencode($_nodesforum_display_user_publicname[$thismoderatedID])."'".', '."'".$_GET['_nodesforum_node']."'".', '."'".$_GET['_nodesforum_page']."'".')" style="cursor:pointer;">restore</a>)</div>';
					}
				}

					
				if($_nodesforum_display_action_code[$key]=='BANIP' || (($_nodesforum_display_action_code[$key]=='DEL' || $_nodesforum_display_action_code[$key]=='RES') && stripos($_nodesforum_display_action[$key],'<span style="display:none;">toip</span>')))
				{
					$posofipstart=stripos($_nodesforum_display_action[$key],'value="')+7;
					$posofipend=stripos($_nodesforum_display_action[$key],'"',$posofipstart+1);
					$lenofip=$posofipend-$posofipstart;
					$thisip=substr($_nodesforum_display_action[$key],$posofipstart,$lenofip);
					$moderated_link='<input type="text" value="'.addslashes($thisip).'" readonly="readonly" onmouseup="highlight(this)" />';
					if($_nodesforum_ismod==1){$moderated_link=$moderated_link.' ('._nodesforum_variable_setter('_nodesforum_log_moded_ip',urlencode($thisip),'.').')('._nodesforum_variable_adder('_nodesforum_log_moded_ip',urlencode($thisip),'+').')';}
				}
				else
				{$moderated_link=make_user_link($thismoderatedID,$_nodesforum_display_user_publicname[$thismoderatedID]); if($_nodesforum_ismod==1){$moderated_link=$moderated_link.' ('._nodesforum_variable_setter('_nodesforum_log_moded',$thismoderatedID,'.').')('._nodesforum_variable_adder('_nodesforum_log_moded',$thismoderatedID,'+').')';}}

				if($_nodesforum_display_subaction_of[$key]!=0 && $_nodesforum_display_subaction_of[$key]!=-1)
				{echo '<tr><td colspan="7"><br /></td></tr>';}
					
	
				echo '<tr>
				<td style="text-align:center;vertical-align:top;" class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner">'.$this_folder_or_post.'</div></td>
				<td style="text-align:center;vertical-align:top;" class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner">'.make_user_link($thismoderatorID,$_nodesforum_display_user_publicname[$thismoderatorID]).' ('._nodesforum_variable_setter('_nodesforum_log_mod',$thismoderatorID,'.').')('._nodesforum_variable_adder('_nodesforum_log_mod',$thismoderatorID,'+').')</div></td>
				<td style="text-align:center;vertical-align:top;" class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner">'.$moderated_link.'</div></td>
				<td style="text-align:center;vertical-align:top;" class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner">'.$this_authoritative_folder_or_post.'</div></td>
				<td style="text-align:center;vertical-align:top;" class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner"><script type="text/javascript">
				var writness = _nodesforum_maketimus('.$_nodesforum_display_action_time[$key].');
				document.write(writness);
				</script></div></td>
				<td style="text-align:center;vertical-align:top;" class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner">'.$_nodesforum_display_action_code[$key].' ('._nodesforum_variable_setter('_nodesforum_log_code',$_nodesforum_display_action_code[$key],'.').')('._nodesforum_variable_adder('_nodesforum_log_code',$_nodesforum_display_action_code[$key],'+').')</div></td>
				<td style="text-align:center;vertical-align:top;" class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner">'.$_nodesforum_display_action[$key].$restore_button.'</div></td>
				</tr>';



				if($_nodesforum_display_subaction_of[$key]!=0 && $_nodesforum_display_subaction_of[$key]!=-1)
				{
					$main_action_key='main_'.$_nodesforum_display_subaction_of[$key];
	
					$thismoderatorID=$_nodesforum_display_mod_uniqueID[$main_action_key];
					$thismoderatedID=$_nodesforum_display_moded_uniqueID[$main_action_key];
	
					$this_folder_or_postID=$_nodesforum_display_fapID[$main_action_key];
					$this_main_folder_or_post=show_element($this_folder_or_postID,$_nodesforum_display_folder_and_post_titles[$this_folder_or_postID],$_nodesforum_display_folder_and_post_folder_or_posts[$this_folder_or_postID],$_nodesforum_display_folder_and_post_containing_folder_or_posts[$this_folder_or_postID]);
	
		
					$this_authoritative_folder_or_postID=$_nodesforum_display_authoritative_folderID[$main_action_key];
					$this_main_authoritative_folder_or_post=show_element($this_authoritative_folder_or_postID,$_nodesforum_display_folder_and_post_titles[$this_authoritative_folder_or_postID],$_nodesforum_display_folder_and_post_folder_or_posts[$this_authoritative_folder_or_postID],$_nodesforum_display_folder_and_post_containing_folder_or_posts[$this_authoritative_folder_or_postID]);


					$restore_button='';
					if($_nodesforum_display_action_code[$key]=='DEL')
					{
						$has_the_right=0;
						if($_nodesforum_remember_modership_folders[$this_folder_or_postID])
						{$has_the_right=1;}
						else
						{
							$exploded_ancestry=explode($_nodesforum_ancestry_separator,$_nodesforum_display_folder_and_post_ancestry[$this_folder_or_postID]);
							foreach($exploded_ancestry as $key => $value)
							{
								if($value!='' && $_nodesforum_remember_modership_folders[$value])
								{$has_the_right=1;}
							}
						}
						if($has_the_right==1)
						{
							$this_fapID=$_nodesforum_display_fapID[$main_action_key];
							if($_nodesforum_display_folder_and_post_folder_or_posts[$this_fapID]==1)
							{$isa='folder';}
							else if(substr($_nodesforum_display_folder_and_post_containing_folder_or_posts[$this_fapID],0,1)=='p')
							{$isa='reply';}
							else
							{$isa='post';}
							$restore_button=' (<img src="'.$_nodesforum_restore_icon.'" style="vertical-align:text-bottom;border:none;" /> <a onclick="_nodesforum_restore(1, '.$_nodesforum_display_logID[$main_action_key].', '."'".$this_fapID."'".', '."'".$isa."'".', '."'".urlencode($_nodesforum_display_user_publicname[$thismoderatedID])."'".', '."'".$_GET['_nodesforum_node']."'".', '."'".$_GET['_nodesforum_page']."'".')" style="cursor:pointer;">restore</a>)';
						}
					}
	
					echo '<tr><td colspan="7" style="font-size:60%;">subaction of:</td></tr>
					
					<tr>
					<td style="text-align:center;vertical-align:top;" class="class_nodesforum_bgcolor2"><div class="class_nodesforum_inner">'.$this_main_folder_or_post.'</div></td>
					<td style="text-align:center;vertical-align:top;" class="class_nodesforum_bgcolor2"><div class="class_nodesforum_inner">'.make_user_link($thismoderatorID,$_nodesforum_display_user_publicname[$thismoderatorID]).' ('._nodesforum_variable_setter('_nodesforum_log_mod',$thismoderatorID,'.').')('._nodesforum_variable_adder('_nodesforum_log_mod',$thismoderatorID,'+').')</div></td>
					<td style="text-align:center;vertical-align:top;" class="class_nodesforum_bgcolor2"><div class="class_nodesforum_inner">'.make_user_link($thismoderatedID,$_nodesforum_display_user_publicname[$thismoderatedID]).'</div></td>
					<td style="text-align:center;vertical-align:top;" class="class_nodesforum_bgcolor2"><div class="class_nodesforum_inner">'.$this_main_authoritative_folder_or_post.'</div></td>
					<td style="text-align:center;vertical-align:top;" class="class_nodesforum_bgcolor2"><div class="class_nodesforum_inner"><script type="text/javascript">
					var writness = _nodesforum_maketimus('.$_nodesforum_display_action_time[$main_action_key].');
					document.write(writness);
					</script></div></td>
					<td style="text-align:center;vertical-align:top;" class="class_nodesforum_bgcolor2"><div class="class_nodesforum_inner">'.$_nodesforum_display_action_code[$main_action_key].' ('._nodesforum_variable_setter('_nodesforum_log_code',$_nodesforum_display_action_code[$key],'.').')('._nodesforum_variable_adder('_nodesforum_log_code',$_nodesforum_display_action_code[$key],'+').')</div></td>
					<td style="text-align:center;vertical-align:top;" class="class_nodesforum_bgcolor2"><div class="class_nodesforum_inner">'.$_nodesforum_display_action[$main_action_key].$restore_button.'</div></td>
					</tr>
					
					<tr><td colspan="7"><br /></td></tr>';
				}
			}
		}
	}
	else
	{echo '<tr><td style="text-align:center;vertical-align:top;" class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner">empty</div></td></tr>';}
	echo '</table></div>'.$pagination;






	echo '<div></td></tr></table></div>';






}
else
{echo '<div style="width:100%;padding-top:4px;padding-bottom:4px;" class="class_nodesforum_bgcolor4"><center><div style="width:50%;"><table style="width:100%" class="class_nodesforum_bgcolor3"><tr><td style="text-align:center;" class="class_nodesforum_bgcolor1"><div class="class_nodesforum_inner"><img src="'.$_nodesforum_warn_icon.'" style="vertical-align:text-bottom;border:none;" /> you cannot see the log of moderator actions on this folder or post because you do not have moderator powers on it.</div></td></tr></table></div></center></div>';}



?>
