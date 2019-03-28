function _nodesforum_maketimus(timestampz)
{
    var linktime = new Date(timestampz * 1000);
    var linkday = linktime.getDate();
    var freakingmonths=new Array();
    freakingmonths[0]="jan";
    freakingmonths[1]="feb";
    freakingmonths[2]="mar";
    freakingmonths[3]="apr";
    freakingmonths[4]="may";
    freakingmonths[5]="jun";
    freakingmonths[6]="jul";
    freakingmonths[7]="aug";
    freakingmonths[8]="sep";
    freakingmonths[9]="oct";
    freakingmonths[10]="nov";
    freakingmonths[11]="dec";
    var linkmonthnum = linktime.getMonth();
    var linkmonth = freakingmonths[linkmonthnum];
    var linkyear = linktime.getFullYear();
    var linkhour = linktime.getHours();
    var linkminute = linktime.getMinutes();
    if (linkminute < 10)
    {
        linkminute = "0" + linkminute;
    }
    var fomratedtime = linkday + linkmonth + linkyear + " " + linkhour + ":" + linkminute + "h";
    return fomratedtime;
}
function delete_node(node, folder_or_post, creator_public_name, subfolders_or_replies, posts_or_views, view_node, view_page)
{
    var decoded_public_name = decodeURIComponent(creator_public_name.replace(/\+/g, '%20'));
    var postsS='';
    if(posts_or_views!=1)
    {
        postsS='s';
    }
    if(folder_or_post==1)
    {
        var subfoldersS='';
        if(subfolders_or_replies!=1)
        {
            subfoldersS='s';
        }
        var confirm_question = "are you sure that you want to delete this folder created by " + decoded_public_name + " containing " + subfolders_or_replies + " folder" + subfoldersS + " and " + posts_or_views + " post" + postsS + "?";
    }
    else if(folder_or_post==2)
    {
        var subfoldersS='y';
        if(subfolders_or_replies!=1)
        {
            subfoldersS='ies';
        }
        var confirm_question = "are you sure that you want to delete this post created by " + decoded_public_name + " containing " + subfolders_or_replies + " repl" + subfoldersS + " and viewed " + posts_or_views + " time" + postsS + "?";
    }
    else if(folder_or_post==3)
    {
        var confirm_question = "are you sure that you want to delete this reply from " + decoded_public_name + "?";
    }
    var confirmeos = confirm(confirm_question);
    if(confirmeos==true)
    {
        document.location.href="?_nodesforum_node=" + view_node + "&_nodesforum_page=" + view_page + "&_nodesforum_delete=" + node;
    }
}
function _nodesforum_restore(restore, main_actionID, handling_fapID, isa, creator_public_name, view_node, view_page)
{
    var decoded_public_name = decodeURIComponent(creator_public_name.replace(/\+/g, '%20'));
    var confirm_question = "are you sure that you want to restore this " + isa + " from " + decoded_public_name + "?";
    var confirmeos = confirm(confirm_question);
    if(confirmeos==true)
    {
        document.location.href="?_nodesforum_node=" + view_node + "&_nodesforum_page=" + view_page + "&_nodesforum_restore=" + restore + "&_nodesforum_main_actionID=" + main_actionID + "&_nodesforum_handling_fapID=" + handling_fapID;
    }
}

function _nodesforum_modmod(uniqueID,level)
{
    document.getElementById("grant_uniqueID").value = uniqueID;
    document.getElementById("grant_level").value = level;
}

function _nodesforum_demod(uniqueID, publicname, view_node, view_page)
{
    var decoded_public_name = decodeURIComponent(publicname.replace(/\+/g, '%20'));
    var confirm_question = "Are you sure that you want to remove moderator powers from " + decoded_public_name + "?";
    var confirmeos = confirm(confirm_question);
    if(confirmeos==true)
    {
        document.location.href="?_nodesforum_node=" + view_node + "&_nodesforum_page=" + view_page + "&_nodesforum_demod=" + uniqueID;
    }
}

function _nodesforum_unban(uniqueID, publicname, view_node, view_page)
{
    var decoded_public_name = decodeURIComponent(publicname.replace(/\+/g, '%20'));
    var confirm_question = "Are you sure that you want to unban " + decoded_public_name + "?";
    var confirmeos = confirm(confirm_question);
    if(confirmeos==true)
    {
        document.location.href="?_nodesforum_node=" + view_node + "&_nodesforum_page=" + view_page + "&_nodesforum_unban=" + uniqueID;
    }
}

function _nodesforum_unban_ip(ip, view_node, view_page)
{
    var confirm_question = "Are you sure that you want to unban this IP address " + decodeURIComponent(ip) + "?";
    var confirmeos = confirm(confirm_question);
    if(confirmeos==true)
    {
        document.location.href="?_nodesforum_node=" + view_node + "&_nodesforum_page=" + view_page + "&_nodesforum_unban_ip=" + ip;
    }
}

function _nodesforum_depow(uniqueID, publicname, view_node, view_page, the_thing)
{
    var decoded_public_name = decodeURIComponent(publicname.replace(/\+/g, '%20'));
    var confirm_question = "Are you sure that you want to remove " + the_thing + " from " + decoded_public_name + "?";
    var confirmeos = confirm(confirm_question);
    if(confirmeos==true)
    {
        document.location.href="?_nodesforum_node=" + view_node + "&_nodesforum_page=" + view_page + "&_nodesforum_remove_p=" + uniqueID;
    }
}

function resize_pic(maxwidth, maxheigth, thispicid)
{
    var javascrexpr = "exec_resize_pic(" + maxwidth + ", " + maxheigth + ", '" + thispicid + "')";
    var random = (Math.random())*600;
    random = Math.abs(random);
    var t=setTimeout(javascrexpr,random);
}
function exec_resize_pic(maxwidth, maxheigth, thispicid)
{
    var thepiconmypage = document.getElementById(thispicid);
    var image_source = thepiconmypage.src;
    var oImg = new Image();
    oImg.src = image_source;
    if (oImg.complete)
    {
        var width_of_this_pic_is_what_pr1_of_max = oImg.width / maxwidth;
        var height_of_this_pic_is_what_pr1_of_max = oImg.height / maxheigth;
        if(oImg.width > maxwidth || oImg.height > maxheigth)
        {
            if(width_of_this_pic_is_what_pr1_of_max >= height_of_this_pic_is_what_pr1_of_max)
            {
                var newwidth = Math.floor(oImg.width / width_of_this_pic_is_what_pr1_of_max);
                var newheigth = Math.floor(oImg.height / width_of_this_pic_is_what_pr1_of_max);
                thepiconmypage.style.width = newwidth + 'px';
                thepiconmypage.style.height = newheigth + 'px';
            }
            else
            {
                var newwidth = Math.floor(oImg.width / height_of_this_pic_is_what_pr1_of_max);
                var newheigth = Math.floor(oImg.height / height_of_this_pic_is_what_pr1_of_max);
                thepiconmypage.style.width = newwidth + 'px';
                thepiconmypage.style.height = newheigth + 'px';
            }
        }
        else
        {
            thepiconmypage.style.width = oImg.width + 'px';
            thepiconmypage.style.height = oImg.height + 'px';
        }
    }
    else
    {
        resize_pic(maxwidth, maxheigth, thispicid);
    }
}


function highlight(field)
{
    field.focus();
    field.select();
}

var time_left_memories=new Array();
function show_countdown(seconds_left,span_name)
{
    time_left_memories[span_name]=seconds_left;
    run_countdown(span_name);
}
function run_countdown(span_name)
{
    if(time_left_memories[span_name] < 0)
    {
        var remove_span = document.getElementById(span_name + "_remove");
        remove_span.innerHTML = '';
    }
    else
    {
        var span = document.getElementById(span_name);
        span.innerHTML = make_nice_time_left(time_left_memories[span_name]);
        time_left_memories[span_name]--;
        var rerun_string = 'run_countdown("' + span_name + '");';
        var timz = setTimeout(rerun_string,1000);
    }
}
function make_nice_time_left(time_left_in_sec)
{
    var hours_left = Math.floor(time_left_in_sec/3600);
    var minutes_left = Math.floor((time_left_in_sec-(hours_left*3600))/60);
    if(minutes_left < 10)
    {
        minutes_left = "0" + minutes_left;
    }
    var seconds_left = time_left_in_sec - (hours_left*3600) - (minutes_left*60);
    if(seconds_left < 10)
    {
        seconds_left = "0" + seconds_left;
    }
    var eltime = hours_left + ":" + minutes_left + ' <span style="font-size:80%;">' + seconds_left + "</span>";
    return eltime;
}

function _nodesforum_set_class(element_id,class_name)
{
    document.getElementById(element_id).setAttribute("class", class_name);
    document.getElementById(element_id).setAttribute("className", class_name);
}

function selectcode(thingid)
{
    var theobject = document.getElementById(thingid);
    selectNode(theobject);
}



function selectNode (node) {
   var selection, range, doc, win;
   if ((doc = node.ownerDocument) && (win = doc.defaultView) && typeof win.getSelection != 'undefined' && typeof doc.createRange != 'undefined' && (selection = window.getSelection()) && typeof selection.removeAllRanges != 'undefined') {
     range = doc.createRange();
     range.selectNode(node); 
     selection.removeAllRanges();
     selection.addRange(range);
   }  else if (document.body && typeof document.body.createTextRange != 'undefined' && (range = document.body.createTextRange())) {
     range.moveToElementText(node);
     range.select();
   }

}

var waiting_for_requests={};
function purgeSpammer(user_id,user_ip){
	if(user_id=="0"){
		var areyousure = confirm("Spammer Purge: are you sure that you want to delete all the posts from ip "+user_ip+" and ban it for as far as your moderator go across the entire forum?");
	}else{
		var areyousure = confirm("Spammer Purge: are you sure that you want to delete all the posts from user id "+user_id+" and his/her ip "+user_ip+" and ban this user and his/her ip for as far as your moderator go across the entire forum?");
	}
	if(areyousure){
		waiting_for_requests={};
		var purge_reason = "Spammer Purge process";
		if(user_id!="0"){
			//ban user
			waiting_for_requests['1']={method:'ban',result:'ok',status:'waiting'};
			jax("?format=json&request_number=1","POST","_nodesforum_banned_uniqueID="+user_id+"&_nodesforum_banned_reason="+purge_reason+"&_nodesforum_ban=ban",purgeSpammerResults);
		}
		//ban ip
		waiting_for_requests['2']={method:'ban_ip',result:'ok',status:'waiting'};
		jax("?format=json&request_number=2","POST","_nodesforum_banned_ip="+user_ip+"&_nodesforum_banned_ip_reason="+purge_reason+"&_nodesforum_ban_ip=ban IP",purgeSpammerResults);
		if(user_id!="0"){
			//delete user post
			waiting_for_requests['3']={method:'delete',result:'ok',status:'waiting'};
			jax("?_nodesforum_delete=0&_nodesforum_delete_user="+user_id+"&_nodesforum_delete_imsure=1&format=json&request_number=3","GET","",purgeSpammerResults);
		}
		//delete ip posts
		waiting_for_requests['4']={method:'delete',result:'ok',status:'waiting'};
		jax("?_nodesforum_delete=0&_nodesforum_delete_ip="+user_ip+"&_nodesforum_delete_imsure=1&format=json&request_number=4","GET","",purgeSpammerResults);
	}
}
function purgeSpammerResults(result_plain){
	//console.log(result);
	var result = JSON.parse(result_plain)
	var this_request_num = result.request_number;
	if(result.method==waiting_for_requests[this_request_num].method && result.result==waiting_for_requests[this_request_num].result){
		//delete waiting_for_requests[this_request_num];
		waiting_for_requests[this_request_num].status='done';
	}else{
		waiting_for_requests[this_request_num].status='error';
		//alert('ajax error: '+result_plain);
		console.log('ajax error:expected:result');
		console.log(waiting_for_requests[this_request_num]);
		console.log(result_plain);
	}
	var count_waiting=0;
	var count_errors=0;
	for (var property in waiting_for_requests) {
		if (waiting_for_requests.hasOwnProperty(property)) {
			if(waiting_for_requests[property].status=='waiting'){
				count_waiting++;
			}else if(waiting_for_requests[property].status=='error'){
				count_errors++;
			}
		}
	}
	if(count_waiting==0){
		//all waiting done, lets shoot results
		if(count_errors>=1){
			var message='Spammer Purge done but there were some errors';
			console.log(waiting_for_requests);
		}else{
			var message='Spammer Purge done, reload the page to see the results';
		}
		alert(message);
	}
}
var count_requests=0;
function jax(url,method,data,callback){
	count_requests++;
	
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (xhr.readyState == XMLHttpRequest.DONE) {
			//alert(xhr.responseText);
			//var result = JSON.parse(xhr.responseText);
			callback(xhr.responseText);
		}
	}

	if(method=="POST"){
		xhr.open("POST", url, true);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
		xhr.send(data);
	} else if(method=="GET"){
		xhr.open("GET", url, true);
		xhr.send();
	}
}
