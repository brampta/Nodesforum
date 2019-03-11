function _nodesforum_open_browse_menu()
{
	document.getElementById("_nodesforum_destination_browse_div").style.display = "block";
	_nodesforum_move_browse(_nodesforum_node);
}

function _nodesforum_tryuser()
{var tiogz=setTimeout("exec_nodesforum_tryuser();",100);}
function exec_nodesforum_tryuser()
{
	var gofornode = "u" + document.getElementById("_nodesforum_some1elseID").value;
	_nodesforum_move_browse(gofornode);
}



var ajax_pipes=new Array();
ajax_pipes[1]='_nodesforum_move_browse';
for (xol in ajax_pipes)
{
	var joystring = 'var req' + ajax_pipes[xol] + '; function loadXMLDoc' + ajax_pipes[xol] + '(url) {if (window.XMLHttpRequest) {req' + ajax_pipes[xol] + ' = new XMLHttpRequest(); req' + ajax_pipes[xol] + '.onreadystatechange = processReqChange' + ajax_pipes[xol] + '; req' + ajax_pipes[xol] + '.open("GET", url, true); req' + ajax_pipes[xol] + '.send(null);} else if (window.ActiveXObject){req' + ajax_pipes[xol] + ' = new ActiveXObject("Microsoft.XMLHTTP"); if (req' + ajax_pipes[xol] + ') {req' + ajax_pipes[xol] + '.onreadystatechange = processReqChange' + ajax_pipes[xol] + ';req' + ajax_pipes[xol] + '.open("GET", url, true);req' + ajax_pipes[xol] + '.send();}}}';
	eval(joystring);
}



function _nodesforum_move_browse(node)
{
	var urlz = _nodesforum_code_path + "xml_nodesforum_move_browse.php?node=" + node;
	loadXMLDoc_nodesforum_move_browse(urlz);
}
function processReqChange_nodesforum_move_browse() 
{
	if (req_nodesforum_move_browse.readyState == 4)
	{
		if (req_nodesforum_move_browse.status == 200)
		{
			var _nodesforum_move_destination = document.getElementById("_nodesforum_move_destination");
			var _nodesforum_show_selection = document.getElementById("_nodesforum_show_selection");
			var _nodesforum_show_children = document.getElementById("_nodesforum_show_children");

			var response = req_nodesforum_move_browse.responseXML.documentElement;
			var folder_is_found = response.getElementsByTagName("folder_is_found")[0].firstChild.data;
			var node = response.getElementsByTagName("node")[0].firstChild.data;
			var mysterypath = response.getElementsByTagName("mysterypath")[0].firstChild.data;
			var folder_is_allow_posting = response.getElementsByTagName("folder_is_allow_posting")[0].firstChild.data;
			var folder_name = response.getElementsByTagName("folder_name")[0].firstChild.data;
			var total_subfolders = response.getElementsByTagName("total_subfolders")[0].firstChild.data;
			var folder_parent = response.getElementsByTagName("folder_parent")[0].firstChild.data;
			var folder_ancestry = response.getElementsByTagName("folder_ancestry")[0].firstChild.data;

			if(folder_is_found == 1)
			{
				//show selection
				var cantposthere_icon = "";
				var can = 0;


				var ismod = 0;
				var isbanned = 0;
				var folder_ancestry_plus_node = folder_ancestry + node + _nodesforum_ancestry_separator;
				var exploded_ancestry_plus_node = folder_ancestry_plus_node.split(_nodesforum_ancestry_separator);
				for(x in exploded_ancestry_plus_node)
				{
					if(exploded_ancestry_plus_node[x]!='')
					{
						var this_node = exploded_ancestry_plus_node[x];
						if(modpowers_on[this_node]=='yes')
						{
							ismod = 1;
							break;
						}
						else if(banned_on[this_node]=='yes')
						{
							isbanned = 1;
							break;
						}
					}
				}

                                if(node != _nodesforum_movee)
                                {
                                    if(ismod==1)
                                    {can=1;}
                                    else if(folder_is_allow_posting==1 && isbanned!=1)
                                    {can=1;}
                                }


				if(can==0)
				{var cantposthere_icon = '<img src="' + _nodesforum_code_path + mysterypath + '/minipics/no2.gif" style="vertical-align:text-bottom;border:none;" /> ';}
				var this_icon = '';
                                if(node == '0')
				{this_icon = '<img src="' + _nodesforum_code_path + mysterypath + '/minipics/home.gif" style="vertical-align:text-bottom;border:none;" /> ';}
				else if(node.substr(0,1)=='p')
				{this_icon = '<img src="' + _nodesforum_code_path + mysterypath + '/minipics/power.gif" style="vertical-align:text-bottom;border:none;" /> ';}
				else if(node.substr(0,1)=='u')
				{this_icon = '<img src="' + _nodesforum_code_path + mysterypath + '/minipics/userhome.gif" style="vertical-align:text-bottom;border:none;" /> ';}
				else
				{this_icon = '<img src="' + _nodesforum_code_path + mysterypath + '/minipics/folder.gif" style="vertical-align:text-bottom;border:none;" /> ';}
				var your_selection = cantposthere_icon + this_icon + '<a href="?_nodesforum_node=' + node + '">' + folder_name + '</a>';
				_nodesforum_show_selection.innerHTML = your_selection;
				_nodesforum_move_destination.value = node;

				//show sufolders
				var countz = 0;
				var show_subfolders_string = "";
				if(folder_parent != 'none')
				{show_subfolders_string = show_subfolders_string + '<img src="' + _nodesforum_code_path + mysterypath + '/minipics/folder.gif" style="vertical-align:text-bottom;border:none;" /> <a onclick="_nodesforum_move_browse(' + "'" + folder_parent + "'" + ')" style="cursor:pointer;">.. (up 1 level)</a><br />';}

				if(total_subfolders==0)
				{show_subfolders_string = show_subfolders_string + "no subfolders<br />";}
				else
				{
					while(countz < total_subfolders)
					{
						countz++;
	
						var this_folder_fapID_name = "subfolder_fapID-" + countz;
						var this_folder_title_name = "subfolder_title-" + countz;
						var this_folder_fapID = response.getElementsByTagName(this_folder_fapID_name)[0].firstChild.data;
						var this_folder_title = response.getElementsByTagName(this_folder_title_name)[0].firstChild.data;
						var this_data_row = '<img src="' + _nodesforum_code_path + mysterypath + '/minipics/folder.gif" style="vertical-align:text-bottom;border:none;" /> <a onclick="_nodesforum_move_browse(' + "'" + this_folder_fapID + "'" + ')" style="cursor:pointer;">' + this_folder_title + '</a>';
						show_subfolders_string = show_subfolders_string + this_data_row + "<br />";
					}
				}
				_nodesforum_show_children.innerHTML = show_subfolders_string;
			}
			else
			{
				//show that isnt found
                                var error_message = '';
				if(node.substring(0,1)=='u')
				{error_message = 'user not found';}
				else if(node.substring(0,1)=='p')
				{error_message = 'power management folder not found';}
				else
				{error_message = 'folder not found';}
				error_message = '<img src="' + _nodesforum_code_path + mysterypath + '/minipics/warn.gif" style="vertical-align:text-bottom;border:none;" /> ' + error_message;
				_nodesforum_show_selection.innerHTML = error_message;
				_nodesforum_show_children.innerHTML = error_message;
			}
		}
	}
}
