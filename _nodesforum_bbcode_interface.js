var steps=new Array();
var _nodesforum_rememberrange;
var _nodesforum_remember_selection_start = 0;
var _nodesforum_remember_selection_end = 0;


var current_text = document.getElementById("_nodesforum_post_field").value;
steps[0]=current_text;
var this_step = 0;
_nodesforum_remember_selection_start = current_text.length;
_nodesforum_remember_selection_end = current_text.length;











var fonts=new Array();
var fonts_generic_family=new Array();
fonts[1]='"Times New Roman"';
fonts_generic_family[1]='serif';
fonts[2]='Georgia';
fonts_generic_family[2]='serif';
fonts[3]='Arial';
fonts_generic_family[3]='sans-serif';
fonts[4]='Verdana';
fonts_generic_family[4]='sans-serif';
fonts[5]='"Courier New"';
fonts_generic_family[5]='monospace';
fonts[6]='"Lucida Console"';
fonts_generic_family[6]='monospace';

var fonts_selector_choices_opening_tags_array=new Array();
var fonts_selector_choices_closing_tags_array=new Array();
var fonts_selector_choices_styles_array=new Array();
var fonts_selector_choices_texts_array=new Array();

var count_choices = 0;
for(x in fonts)
{
    count_choices++;
    fonts_selector_choices_opening_tags_array[count_choices] = '[FONT=' + fonts[x] + ', ' + fonts_generic_family[x] + ']';
    fonts_selector_choices_closing_tags_array[count_choices] = '[/FONT]';
    fonts_selector_choices_styles_array[count_choices] = 'font-family:' + fonts[x] + ', ' + fonts_generic_family[x] + ';';
    fonts_selector_choices_texts_array[count_choices] = fonts[x].replace(/"/g,'');
}

var _nodesforum_fonts_button = _nodesforum_make_selector('fonts',fonts_selector_choices_opening_tags_array,fonts_selector_choices_closing_tags_array,fonts_selector_choices_styles_array,fonts_selector_choices_texts_array);




var sizes_selector_choices_opening_tags_array=new Array();
var sizes_selector_choices_closing_tags_array=new Array();
var sizes_selector_choices_styles_array=new Array();
var sizes_selector_choices_texts_array=new Array();

var _nodesforum_sizes_startat = 30;
var _nodesforum_sizes_stopat = 300;
var _nodesforum_sizes_jumpby = 10;

var count_choices = 0;
var counting_head = _nodesforum_sizes_startat;
while(counting_head <= _nodesforum_sizes_stopat)
{
    count_choices++;
    sizes_selector_choices_opening_tags_array[count_choices] = '[SIZE=' + counting_head + ']';
    sizes_selector_choices_closing_tags_array[count_choices] = '[/SIZE]';
    sizes_selector_choices_styles_array[count_choices] = 'font-size:' + counting_head + '%;';
    sizes_selector_choices_texts_array[count_choices] = counting_head + '%&#160;';
    counting_head = counting_head + _nodesforum_sizes_jumpby;
}
var _nodesforum_sizes_button = _nodesforum_make_selector('sizes',sizes_selector_choices_opening_tags_array,sizes_selector_choices_closing_tags_array,sizes_selector_choices_styles_array,sizes_selector_choices_texts_array);






var smiley_codes=new Array();
var pic_names=new Array();
smiley_codes[1]=':)';
pic_names[1]='smile';
smiley_codes[2]=':(';
pic_names[2]='frown';
smiley_codes[3]=':D';
pic_names[3]='bigsmile';
smiley_codes[4]=':P';
pic_names[4]='tongue';
smiley_codes[5]=';)';
pic_names[5]='wink';

smiley_codes[6]='8)';
pic_names[6]='glasses';
smiley_codes[7]='B)';
pic_names[7]='shades';
smiley_codes[8]=':/';
pic_names[8]='unsure';



smiley_codes[9]=':o';
pic_names[9]='surprise_ss';
smiley_codes[10]=':O';
pic_names[10]='surprise_sb';
smiley_codes[11]='8o';
pic_names[11]='surprise_bs';
smiley_codes[12]='8O';
pic_names[12]='surprise_bb';





var _nodesforum_smileys_button = '<div style="display:inline;position:relative;"><a onclick="_nodesforum_show_select_menu(' + "'_nodesforum_show_smileys_div', '_nodesforum_smileys_button'" + ')" style="cursor:pointer;padding-left:1px;padding-right:1px;" id="_nodesforum_smileys_button"><img src="' + _nodesforum_images_repo_path + '/minipics/smileys/smile.gif" /></a><div id="_nodesforum_show_smileys_div" style="display:none;position:absolute;"><table class="class_nodesforum_bgcolor3"><tr><td class="class_nodesforum_bgcolor1"><table>';

for(x in smiley_codes)
{
    _nodesforum_smileys_button = _nodesforum_smileys_button + '<tr><td><a onclick="_nodesforum_add_tag(' + "'" + escape('[SMILEY]' + smiley_codes[x] + '[/SMILEY]') + "'" + ',' + "''" + ')" style="cursor:pointer;"><img src="' + _nodesforum_images_repo_path + '/minipics/smileys/' + pic_names[x] + '.gif" /></a></td></tr>';
}

_nodesforum_smileys_button = _nodesforum_smileys_button + '</table></td></tr></table></div></div>';





var _nodesforum_colors_button = '<a onclick="_nodesforum_insert_color()" style="cursor:pointer;padding-left:1px;padding-right:1px;"><img src="' + _nodesforum_images_repo_path + '/minipics/bbcode/colors.gif" /></a>';
var _nodesforum_last_color = 'Black';
function _nodesforum_insert_color()
{
    var askachoice = prompt('color:',_nodesforum_last_color);
    if(askachoice!='' && askachoice!=null)
    {
        _nodesforum_last_color = askachoice;
        _nodesforum_add_tag(escape('[COLOR=' + askachoice + ']'),escape('[/COLOR]'));
    }
}


var _nodesforum_link_button = '<a onclick="_nodesforum_insert_link()" style="cursor:pointer;padding-left:1px;padding-right:1px;"><img src="' + _nodesforum_images_repo_path + '/minipics/bbcode/link.gif" /></a>';
function _nodesforum_insert_link()
{
    var askachoice = prompt('Please enter the URL of your link:','http://');
    if(askachoice!='' && askachoice!=null && askachoice!='http://')
    {
        _nodesforum_last_color = askachoice;
        _nodesforum_add_tag(escape('[URL=' + askachoice + ']'),escape('[/URL]'));
    }
}


var _nodesforum_image_button = '<a onclick="_nodesforum_insert_image()" style="cursor:pointer;padding-left:1px;padding-right:1px;"><img src="' + _nodesforum_images_repo_path + '/minipics/bbcode/image.gif" /></a>';
function _nodesforum_insert_image()
{
    var askachoice = prompt('Please enter the URL of your image:','http://');
    if(askachoice!='' && askachoice!=null && askachoice!='http://')
    {
        _nodesforum_last_color = askachoice;
        _nodesforum_add_tag(escape('[IMG]' + askachoice + '[/IMG]'),escape(''));
    }
}




var _nodesforum_ordered_list_button = '<a onclick="_nodesforum_add_tag(' + "'" + escape('[LIST=1]\n[*]') + "'" + ',' + "'" + escape('\n[/LIST]') + "'" + ')" style="cursor:pointer;padding-left:1px;padding-right:1px;"><img src="' + _nodesforum_images_repo_path + '/minipics/bbcode/ordered_list.gif" /></a>';
var _nodesforum_unordered_list_button = '<a onclick="_nodesforum_add_tag(' + "'" + escape('[LIST]\n[*]') + "'" + ',' + "'" + escape('\n[/LIST]') + "'" + ')" style="cursor:pointer;padding-left:1px;padding-right:1px;"><img src="' + _nodesforum_images_repo_path + '/minipics/bbcode/unordered_list.gif" /></a>';



var _nodesforum_bold_button = '<a onclick="_nodesforum_add_tag(' + "'" + escape('[B]') + "'" + ',' + "'" + escape('[/B]') + "'" + ')" style="cursor:pointer;padding-left:1px;padding-right:1px;"><img src="' + _nodesforum_images_repo_path + '/minipics/bbcode/bold.gif" /></a>';
var _nodesforum_italic_button = '<a onclick="_nodesforum_add_tag(' + "'" + escape('[I]') + "'" + ',' + "'" + escape('[/I]') + "'" + ')" style="cursor:pointer;padding-left:1px;padding-right:1px;"><img src="' + _nodesforum_images_repo_path + '/minipics/bbcode/italic.gif" /></a>';
var _nodesforum_underlined_button = '<a onclick="_nodesforum_add_tag(' + "'" + escape('[U]') + "'" + ',' + "'" + escape('[/U]') + "'" + ')" style="cursor:pointer;padding-left:1px;padding-right:1px;"><img src="' + _nodesforum_images_repo_path + '/minipics/bbcode/underlined.gif" /></a>';
var _nodesforum_strike_through_button = '<a onclick="_nodesforum_add_tag(' + "'" + escape('[S]') + "'" + ',' + "'" + escape('[/S]') + "'" + ')" style="cursor:pointer;padding-left:1px;padding-right:1px;"><img src="' + _nodesforum_images_repo_path + '/minipics/bbcode/strike-through.gif" /></a>';
var _nodesforum_sub_button = '<a onclick="_nodesforum_add_tag(' + "'" + escape('[SUB]') + "'" + ',' + "'" + escape('[/SUB]') + "'" + ')" style="cursor:pointer;padding-left:1px;padding-right:1px;"><img src="' + _nodesforum_images_repo_path + '/minipics/bbcode/sub.gif" /></a>';
var _nodesforum_sup_button = '<a onclick="_nodesforum_add_tag(' + "'" + escape('[SUP]') + "'" + ',' + "'" + escape('[/SUP]') + "'" + ')" style="cursor:pointer;padding-left:1px;padding-right:1px;"><img src="' + _nodesforum_images_repo_path + '/minipics/bbcode/sup.gif" /></a>';




var _nodesforum_align_left_button = '<a onclick="_nodesforum_add_tag(' + "'" + escape('[LEFT]') + "'" + ',' + "'" + escape('[/LEFT]') + "'" + ')" style="cursor:pointer;padding-left:1px;padding-right:1px;"><img src="' + _nodesforum_images_repo_path + '/minipics/bbcode/left.gif" /></a>';
var _nodesforum_align_center_button = '<a onclick="_nodesforum_add_tag(' + "'" + escape('[CENTER]') + "'" + ',' + "'" + escape('[/CENTER]') + "'" + ')" style="cursor:pointer;padding-left:1px;padding-right:1px;"><img src="' + _nodesforum_images_repo_path + '/minipics/bbcode/center.gif" /></a>';
var _nodesforum_align_right_button = '<a onclick="_nodesforum_add_tag(' + "'" + escape('[RIGHT]') + "'" + ',' + "'" + escape('[/RIGHT]') + "'" + ')" style="cursor:pointer;padding-left:1px;padding-right:1px;"><img src="' + _nodesforum_images_repo_path + '/minipics/bbcode/right.gif" /></a>';




var _nodesforum_quote_button = '<a onclick="_nodesforum_addloosequote()" style="cursor:pointer;padding-left:1px;padding-right:1px;"><img src="' + _nodesforum_images_repo_path + '/minipics/bbcode/quote.gif" /></a>';
function _nodesforum_addloosequote()
{
    var mysource = prompt('source: (optional, example: who said it and where. maybe a link)');
    var sourcepart = '';
    if(mysource!=null && mysource!="")
    {
        var escapedsource = _nodesforum_different_escape_certain_chars(mysource,'"]');
        sourcepart = ' source="' + escapedsource + '"';
    }
    _nodesforum_add_tag(escape('[QUOTE' + sourcepart + ']'),escape('[/QUOTE]'));
}



var ajax_pipes=new Array();
ajax_pipes[1]='_nodesforum_make_strict_quote';
for (xol in ajax_pipes)
{
    var joystring = 'var req' + ajax_pipes[xol] + '; function loadXMLDoc' + ajax_pipes[xol] + '(url) {if (window.XMLHttpRequest) {req' + ajax_pipes[xol] + ' = new XMLHttpRequest(); req' + ajax_pipes[xol] + '.onreadystatechange = processReqChange' + ajax_pipes[xol] + '; req' + ajax_pipes[xol] + '.open("GET", url, true); req' + ajax_pipes[xol] + '.send(null);} else if (window.ActiveXObject){req' + ajax_pipes[xol] + ' = new ActiveXObject("Microsoft.XMLHTTP"); if (req' + ajax_pipes[xol] + ') {req' + ajax_pipes[xol] + '.onreadystatechange = processReqChange' + ajax_pipes[xol] + ';req' + ajax_pipes[xol] + '.open("GET", url, true);req' + ajax_pipes[xol] + '.send();}}}';
    eval(joystring);
}



var _nodesforum_strict_quote_button = '<a onclick="_nodesforum_addstrictquote()" style="cursor:pointer;padding-left:1px;padding-right:1px;"><img src="' + _nodesforum_images_repo_path + '/minipics/bbcode/quote2.gif" /></a>';
function _nodesforum_addstrictquote()
{
    var postID = prompt('post #: (required)');
    if(postID!=null && postID!="")
    {
        var urlz = _nodesforum_code_path + "xml_nodesforum_make_strict_quote.php?postID=" + postID;
        loadXMLDoc_nodesforum_make_strict_quote(urlz);
    }
}


function processReqChange_nodesforum_make_strict_quote() 
{
    if (req_nodesforum_make_strict_quote.readyState == 4)
    {
        if (req_nodesforum_make_strict_quote.status == 200)
        {
            var response = req_nodesforum_make_strict_quote.responseXML.documentElement;
            var post_is_found = response.getElementsByTagName("post_is_found")[0].firstChild.data;
            var postID = response.getElementsByTagName("postID")[0].firstChild.data;
            if(post_is_found == 1)
            {
                var userID = _nodesforum_different_escape_certain_chars(response.getElementsByTagName("userID")[0].firstChild.data,'"]');
                var publicname = _nodesforum_different_escape_certain_chars(response.getElementsByTagName("publicname")[0].firstChild.data,'"]');
                var time = response.getElementsByTagName("time")[0].firstChild.data;
                var post = _nodesforum_different_escape_certain_chars(response.getElementsByTagName("post")[0].firstChild.data,'/');
                var thequote = '[QUOTE strict="' + postID + '"' + userID + '"' + publicname + '"' + time + '"]' + post + '[/QUOTE]';
                _nodesforum_add_tag(escape(thequote),'');
            }
            else
            {
                alert('error, post #' + postID + ' was not found!');
            }
        }
    }
}


function _nodesforum_different_escape_certain_chars(stringz,chars_to_escape)
{
    var the_replacement_string = "stringz = stringz.replace(/" + _nodesforum_bbcode_escape_char + "/gi,'" + _nodesforum_bbcode_escape_char + _nodesforum_bbcode_escape_char + "');";
    eval(the_replacement_string);
    var exploded_chars_to_escape = chars_to_escape.split('');
    for(x in exploded_chars_to_escape)
    {
        if(exploded_chars_to_escape[x] != _nodesforum_bbcode_escape_char)
        {
            var the_replacement_string = "stringz = stringz.replace(/\\" + exploded_chars_to_escape[x] + "/gi,'" + _nodesforum_bbcode_escape_char + exploded_chars_to_escape[x] + "');";
            eval(the_replacement_string);
        }
    }
    return stringz;
}





var _nodesforum_code_button = '<a onclick="_nodesforum_add_tag(' + "'" + escape('[CODE]') + "'" + ',' + "'" + escape('[/CODE]') + "'" + ')" style="cursor:pointer;padding-left:1px;padding-right:1px;"><img src="' + _nodesforum_images_repo_path + '/minipics/bbcode/code.gif" /></a>';



var _nodesforum_undo_button = '<span id="_nodesforum_undo_span" style="padding-left:1px;padding-right:1px;"><img src="' + _nodesforum_images_repo_path + '/minipics/bbcode/undo_grey.gif" /></span>';
var _nodesforum_redo_button = '<span id="_nodesforum_redo_span" style="padding-left:1px;padding-right:1px;"><img src="' + _nodesforum_images_repo_path + '/minipics/bbcode/redo_grey.gif" /></span>';







var _nodesforum_biggen_smallen_button = '<div style="display:inline;padding-left:1px;padding-right:1px;position:relative;"><a onclick="_nodesforum_smallen_text()" style="cursor:pointer;"><img src="' + _nodesforum_images_repo_path + '/minipics/bbcode/smallen.gif" style="position:absolute;" /></a><a onclick="_nodesforum_biggen_text()" style="cursor:pointer;"><img src="' + _nodesforum_images_repo_path + '/minipics/bbcode/biggen.gif" style="position:absolute;top:8px;" /></a></span>';





var the_interfaz = _nodesforum_fonts_button + ' ' + _nodesforum_sizes_button + ' ' + _nodesforum_colors_button + _nodesforum_smileys_button + _nodesforum_bold_button + _nodesforum_italic_button + _nodesforum_underlined_button + _nodesforum_strike_through_button + _nodesforum_sub_button + _nodesforum_sup_button + _nodesforum_align_left_button + _nodesforum_align_center_button + _nodesforum_align_right_button + _nodesforum_ordered_list_button + _nodesforum_unordered_list_button + _nodesforum_quote_button + _nodesforum_strict_quote_button + _nodesforum_code_button + _nodesforum_link_button + _nodesforum_image_button + _nodesforum_undo_button + _nodesforum_redo_button + _nodesforum_biggen_smallen_button;




document.getElementById("_nodesforum_bb_interfaz").innerHTML = the_interfaz;






function setpic(element_id,pic_url)
{
    document.getElementById(element_id).src=pic_url;
}










function _nodesforum_make_selector(selector_name,selector_choices_opening_tags_array,selector_choices_closing_tags_array,selector_choices_styles_array,selector_choices_texts_array)
{
    var selector_code = '<div style="display:inline;position:relative;"><span style="margin:1px;cursor:pointer;position:relative;top:-2px;color:#000000;font-size:16px;background-color:#FFFFFF;border-style:solid;border-color:#444444;border-width:1px;z-index:10;" onmouseover="setpic(' + "'_nodesforum_main_select_box_arrow_" + selector_name + "','" + _nodesforum_images_repo_path + "/minipics/bbcode/little_arrow2.gif'" + ')" onmouseout="setpic(' + "'_nodesforum_main_select_box_arrow_" + selector_name + "','" + _nodesforum_images_repo_path + "/minipics/bbcode/little_arrow.gif'" + ')" id="_nodesforum_select_handler_' + selector_name + '"><span onclick="_nodesforum_show_select_menu(' + "'" + '_nodesforum_show_' + selector_name + '_div' + "'" + ',' + "'_nodesforum_select_handler_" + selector_name + "'" + ')">&#160;' + selector_name + '<img src="' + _nodesforum_images_repo_path + '/minipics/bbcode/little_arrow.gif" style="vertical-align:text-top;position:relative;top:2px;" id="_nodesforum_main_select_box_arrow_' + selector_name + '" /></span></span>';
    selector_code = selector_code + '<div id="_nodesforum_show_' + selector_name + '_div" style="position:absolute;top:0px;height:0px;display:none;z-index:20;overflow:auto;height:260px;overflow-x: hidden;"><table class="class_nodesforum_bgcolor3">';

    for(x in selector_choices_texts_array)
    {
        selector_code = selector_code + '<tr><td class="class_nodesforum_bgcolor1" id="_nodesforum_' + selector_name + '_' + x + '" onclick="_nodesforum_add_tag(' + "'" + escape(selector_choices_opening_tags_array[x]) + "', '" + escape(selector_choices_closing_tags_array[x]) + "'" + ')" onmouseover="_nodesforum_set_class(' + "'" + '_nodesforum_' + selector_name + '_' + x + "'" + ',' + "'" + 'class_nodesforum_bgcolor2' + "'" + ')" onmouseout="_nodesforum_set_class(' + "'" + '_nodesforum_' + selector_name + '_' + x + "'" + ',' + "'" + 'class_nodesforum_bgcolor1' + "'" + ')" style=' + "'" + 'cursor:pointer;' + selector_choices_styles_array[x] + "'" + '>' + selector_choices_texts_array[x] + '</td></tr>';
    }

    selector_code = selector_code + '</table></div></div>';
    return selector_code;
}





function _nodesforum_add_tag(opening_tag,closing_tag)
{

	

    _nodesforum_fieldchange();


    opening_tag = unescape(opening_tag);
    closing_tag = unescape(closing_tag);
    var _nodesforum_post_field = document.getElementById("_nodesforum_post_field");
    var lenofopeningtag = opening_tag.length;

	

    if(_nodesforum_post_field.selectionStart || _nodesforum_post_field.selectionStart=='0')
    {

        var remember_scroll_pos = _nodesforum_post_field.scrollTop;


        var selection_start = _nodesforum_remember_selection_start;
        var selection_end = _nodesforum_remember_selection_end;

        if(opening_tag.substr(0,5)=='[URL=' && selection_start==selection_end)
        {
            var link_url = opening_tag.substring(5,lenofopeningtag-1);
            opening_tag = '[URL]' + link_url;
            lenofopeningtag = opening_tag.length;
        }
        else if(opening_tag.substr(0,5)=='[LIST' && selection_start==selection_end)
        {
            var nomoreitems = 0;
            var items_inside_string = '';
            while(nomoreitems==0)
            {
                var askforitem = prompt('Enter a list item.\nLeave the box empty or press "Cancel" to complete the list:','');
                if(askforitem!='' && askforitem!=null)
                {
                    items_inside_string = items_inside_string + '[*]' + askforitem + '\n';
                }
                else
                {
                    nomoreitems=1;
                }
            }
            if(items_inside_string=='')
            {
                opening_tag = '';
                closing_tag = '';
                lenofopeningtag = 0;
            }
            else
            {
                opening_tag = opening_tag.substr(0,opening_tag.length-3) + items_inside_string.substr(0,items_inside_string.length-2);
                lenofopeningtag = opening_tag.length;
            }
        }
		

        _nodesforum_post_field.value = _nodesforum_insert_text(opening_tag,_nodesforum_post_field.value,selection_start);
        _nodesforum_post_field.scrollTop = remember_scroll_pos;
        _nodesforum_post_field.value = _nodesforum_insert_text(closing_tag,_nodesforum_post_field.value,selection_end+lenofopeningtag);
        _nodesforum_post_field.scrollTop = remember_scroll_pos;
	
        _nodesforum_post_field.focus();
        _nodesforum_post_field.selectionStart = selection_start + lenofopeningtag;
        _nodesforum_post_field.selectionEnd = selection_end + lenofopeningtag;


		
    }
    else if(document.selection)
    {
        var old_field_text=_nodesforum_post_field.innerHTML;
        if(norangeyet==1)
        {
            var selection_start = _nodesforum_remember_selection_start;
            var selection_end = _nodesforum_remember_selection_end;
        }
        else
        {
            var range = _nodesforum_rememberrange;
	
			
	
            var gotastringthatisntintext = 0;
            var maxturns = 10000;
            var countturns = 0;
            while(gotastringthatisntintext==0 && countturns<maxturns)
            {
                countturns++;
                var a_random_string=Math.floor(Math.random()*10000000000) + '';
                var lookforrandomstring_in_hoststring=old_field_text.indexOf(a_random_string);
                if(lookforrandomstring_in_hoststring==-1)
                {
                    gotastringthatisntintext = 1;
                }
            }
	
            range.text = a_random_string;
            var new_field_text=_nodesforum_post_field.innerHTML;
            var selection_start = new_field_text.indexOf(a_random_string);
            var selection_end = old_field_text.length - (new_field_text.length - (selection_start + a_random_string.length));
        }



        _nodesforum_post_field.value = old_field_text;


        if(opening_tag.substr(0,5)=='[URL=' && selection_start==selection_end)
        {
            var link_url = opening_tag.substring(5,lenofopeningtag-1);
            opening_tag = '[URL]' + link_url;
            lenofopeningtag = opening_tag.length;
        }
        else if(opening_tag.substr(0,5)=='[LIST' && selection_start==selection_end)
        {
            var nomoreitems = 0;
            var items_inside_string = '';
            while(nomoreitems==0)
            {
                var askforitem = prompt('Enter a list item.\nLeave the box empty or press "Cancel" to complete the list:','');
                if(askforitem!='' && askforitem!=null)
                {
                    items_inside_string = items_inside_string + '[*]' + askforitem + '\n';
                }
                else
                {
                    nomoreitems=1;
                }
            }
            if(items_inside_string=='')
            {
                opening_tag = '';
                closing_tag = '';
                lenofopeningtag = 0;
            }
            else
            {
                opening_tag = opening_tag.substr(0,opening_tag.length-3) + items_inside_string.substr(0,items_inside_string.length-1);
                lenofopeningtag = opening_tag.length;
            }
        }




        var patt1=/\n/gi;




        var lb_in_opening_tag=0;
        if(opening_tag.substr(0,5)=='[LIST')
        {
            var array_of_lb_in_opening_tag = opening_tag.match(patt1);
            if(array_of_lb_in_opening_tag==null)
            {
                lb_in_opening_tag=0;
            }
            else
            {
                lb_in_opening_tag=array_of_lb_in_opening_tag.length;
            }
        }

		

        _nodesforum_post_field.value = _nodesforum_insert_text(opening_tag,old_field_text,selection_start);
        _nodesforum_post_field.value = _nodesforum_insert_text(closing_tag,_nodesforum_post_field.value,selection_end+(lenofopeningtag+lb_in_opening_tag));


        var textrange = _nodesforum_post_field.createTextRange();



	

		


        var array_of_lb_before_selection_start = old_field_text.substring(0,selection_start).match(patt1);
        if(array_of_lb_before_selection_start==null)
        {
            number_of_lb_before_selection_start=0;
        }
        else
        {
            number_of_lb_before_selection_start=array_of_lb_before_selection_start.length;
        }


        var array_of_lb_in_selection = old_field_text.substring(selection_start,selection_end-1).match(patt1);
        if(array_of_lb_in_selection==null)
        {
            number_of_lb_in_selection=0;
        }
        else
        {
            number_of_lb_in_selection=array_of_lb_in_selection.length;
        }



        var selection_move = (selection_start+lenofopeningtag)-number_of_lb_before_selection_start;
        var selection_moveend = (selection_end-selection_start)-number_of_lb_in_selection;



        textrange.move("character", selection_move);
        textrange.moveEnd("character", selection_moveend);
        textrange.select();
    }
    _nodesforum_fieldchange();
}

var norangeyet = 1;
var _nodesforum_auto_recall_range_started = 0;

function _nodesforum_makerange()
{
    var _nodesforum_post_field = document.getElementById("_nodesforum_post_field");
    if(document.selection)
    {
        _nodesforum_really_make_range();
        if(_nodesforum_auto_recall_range_started == 0)
        {
            _nodesforum_recall_range();
            _nodesforum_auto_recall_range_started = 1;
        }
    }
    else if(_nodesforum_post_field.selectionStart || _nodesforum_post_field.selectionStart=='0')
    {
        _nodesforum_remember_selection_start = _nodesforum_post_field.selectionStart;
        _nodesforum_remember_selection_end = _nodesforum_post_field.selectionEnd;
    }
}

function _nodesforum_really_make_range()
{
    var _nodesforum_post_field = document.getElementById("_nodesforum_post_field");
    var range = document.selection.createRange();
    if(range.parentElement() != _nodesforum_post_field)
    {
        return false;
    }
    else
    {
        _nodesforum_rememberrange = range;
        norangeyet = 0;
    }
}


function _nodesforum_recall_range()
{
    _nodesforum_really_make_range();
    var tord=setTimeout("_nodesforum_recall_range()",50);
}



function _nodesforum_fieldchange()
{
    _nodesforum_makerange();
    _nodesforum_maybe_remember_step();
    _nodesforum_set_undo_button_state();
    _nodesforum_set_redo_button_state();
}

function _nodesforum_insert_text(insert_text,host_text,insert_position)
{
    var shostring = "insert_text: " + insert_text + ", host_text: " + host_text + ", insert_position: " + insert_position;
    var firstpartof_host_text = host_text.substr(0,insert_position);
    var secondpartof_host_text = host_text.substr(insert_position);
    var final_text = firstpartof_host_text + insert_text + secondpartof_host_text;
    return final_text;
}







function _nodesforum_maybe_remember_step()
{
    var _nodesforum_post_field = document.getElementById("_nodesforum_post_field");
    if(_nodesforum_post_field.value != steps[this_step])
    {
        this_step++;
        steps[this_step]=_nodesforum_post_field.value;
        for(x in steps)
        {
            if(x>this_step)
            {
                steps[x]=0;
            }
        }
    }
}

function _nodesforum_undo()
{
    var _nodesforum_post_field = document.getElementById("_nodesforum_post_field");
    if(_nodesforum_post_field.selectionStart)
    {
        var remember_scroll_pos = _nodesforum_post_field.scrollTop;
    }
    this_step--;
    _nodesforum_post_field.value = steps[this_step];
    _nodesforum_set_undo_button_state();
    _nodesforum_set_redo_button_state();
    if(_nodesforum_post_field.selectionStart)
    {
        _nodesforum_post_field.scrollTop = remember_scroll_pos;
    }
}
function _nodesforum_set_undo_button_state()
{
    //var last_step = this_step - 1;
    //if(steps[last_step])
    if(this_step>0)
    {
        document.getElementById("_nodesforum_undo_span").innerHTML = '<a onclick="_nodesforum_undo()" style="cursor:pointer;"><img src="' + _nodesforum_images_repo_path + '/minipics/bbcode/undo.gif" /></a>';
    }
    else
    {
        document.getElementById("_nodesforum_undo_span").innerHTML = '<img src="' + _nodesforum_images_repo_path + '/minipics/bbcode/undo_grey.gif" />';
    }
}

function _nodesforum_redo()
{
    var _nodesforum_post_field = document.getElementById("_nodesforum_post_field");
    if(_nodesforum_post_field.selectionStart)
    {
        var remember_scroll_pos = _nodesforum_post_field.scrollTop;
    }
    this_step++;
    _nodesforum_post_field.value = steps[this_step];
    _nodesforum_set_undo_button_state();
    _nodesforum_set_redo_button_state();
    if(_nodesforum_post_field.selectionStart)
    {
        _nodesforum_post_field.scrollTop = remember_scroll_pos;
    }
}
function _nodesforum_set_redo_button_state()
{
    var next_step = this_step + 1;
    if(steps[next_step])
    {
        document.getElementById("_nodesforum_redo_span").innerHTML = '<a onclick="_nodesforum_redo()" style="cursor:pointer;"><img src="' + _nodesforum_images_repo_path + '/minipics/bbcode/redo.gif" /></a>';
    }
    else
    {
        document.getElementById("_nodesforum_redo_span").innerHTML = '<img src="' + _nodesforum_images_repo_path + '/minipics/bbcode/redo_grey.gif" />';
    }
}


document.onclick = function()
{
    _nodesforum_close_menus();
}


var donotclose=new Array();
function _nodesforum_close_menus()
{
    if(donotclose['_nodesforum_show_fonts_div']==0)
    {
        document.getElementById("_nodesforum_show_fonts_div").style.display="none";
    }
    if(donotclose['_nodesforum_show_sizes_div']==0)
    {
        document.getElementById("_nodesforum_show_sizes_div").style.display="none";
    }
    if(donotclose['_nodesforum_show_smileys_div']==0)
    {
        document.getElementById("_nodesforum_show_smileys_div").style.display="none";
    }
}












function _nodesforum_show_select_menu(element_to_pop_id,holding_element)
{
    var handlingblock = document.getElementById(holding_element);
    var handledblock = document.getElementById(element_to_pop_id);
    handledblock.style.display="block";
    handledblock.style.position="absolute";
    handledblock.style.top="20px";
    handledblock.style.left="0px";
    donotclose[element_to_pop_id] = 1;
    var t=setTimeout("donotclose['" + element_to_pop_id + "'] = 0;",10);
}





function _nodesforum_biggen_text()
{
    document.getElementById("_nodesforum_post_field").style.height = Math.abs(document.getElementById("_nodesforum_post_field").style.height.substr(0,document.getElementById("_nodesforum_post_field").style.height.length - 2)) + 200 + 'px';
}
function _nodesforum_smallen_text()
{
    document.getElementById("_nodesforum_post_field").style.height = Math.abs(document.getElementById("_nodesforum_post_field").style.height.substr(0,document.getElementById("_nodesforum_post_field").style.height.length - 2)) - 200 + 'px';
}


