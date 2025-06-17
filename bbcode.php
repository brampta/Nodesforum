<?php
//Nodesforum BBcode 1.005


//bold
$bb_replace['1a']='/\[b\]/is';
$bb_replacements['1a']='<span style="font-weight: bold;">';
$bb_replace['1b']='/\[\/b\]/is';
$bb_replacements['1b']='</span>';
$bb_name[1]='bold';
$bb_legend[1]='[B]text[/B] makes bold text';
$bb_type[1]='standard';

//italic
$bb_replace['2a']='/\[i\]/is';
$bb_replacements['2a']='<span style="font-style: italic;">';
$bb_replace['2b']='/\[\/i\]/is';
$bb_replacements['2b']='</span>';
$bb_name[2]='italic';
$bb_legend[2]='[I]text[/I] makes italic text';
$bb_type[2]='standard';

//underlined
$bb_replace['3a']='/\[u\]/is';
$bb_replacements['3a']='<span style="text-decoration: underline;">';
$bb_replace['3b']='/\[\/u\]/is';
$bb_replacements['3b']='</span>';
$bb_name[3]='underlined';
$bb_legend[3]='[U]text[/U] makes underlined text';
$bb_type[3]='standard';

//strike through
$bb_replace['4a']='/\[s\]/is';
$bb_replacements['4a']='<span style="text-decoration: line-through;">';
$bb_replace['4b']='/\[\/s\]/is';
$bb_replacements['4b']='</span>';
$bb_name[4]='strike through';
$bb_legend[4]='[S]text[/S] makes strikethrough text';
$bb_type[4]='standard';


//sub
$bb_replace['5a']='/\[sub\]/is';
$bb_replacements['5a']='<sub>';
$bb_replace['5b']='/\[\/sub\]/is';
$bb_replacements['5b']='</sub>';
$bb_name[5]='subscript';
$bb_legend[5]='[SUB]text[/SUB] makes subscript text';
$bb_type[5]='standard';

//sup
$bb_replace['6a']='/\[sup\]/is';
$bb_replacements['6a']='<sup>';
$bb_replace['6b']='/\[\/sup\]/is';
$bb_replacements['6b']='</sup>';
$bb_name[6]='superscript';
$bb_legend[6]='[SUP]text[/SUP] makes superscript text';
$bb_type[6]='standard';






//color
$bb_replace['7a']='/\[color=([^ \]]+)\]/is';
$bb_replacements['7a']='<span style='."'".'color: \\1;'."'".'>';
$bb_replace['7b']='/\[\/color\]/is';
$bb_replacements['7b']='</span>';
$bb_name[7]='color';
$bb_legend[7]='[COLOR=red]text[/COLOR] or [COLOR=#FFAA44]text[/COLOR] makes text color red or #FFAA44';
$bb_type[7]='standard';



//size
$bb_replace['8a']='/\[size=([0-9]+)\]/is';
$bb_replacements['8a']='<span style='."'".'font-size: \\1%;'."'".'>';
$bb_replace['8b']='/\[\/size\]/is';
$bb_replacements['8b']='</span>';
$bb_name[8]='size';
$bb_legend[8]='[SIZE=80]text[/SIZE] makes text 80% of normal size';
$bb_type[8]='standard';



//font
$bb_replace['9a']='/\[font=([^\]]+)\]/is';
$bb_replacements['9a']='<span style='."'".'font-family: \\1;'."'".'>';
$bb_replace['9b']='/\[\/font\]/is';
$bb_replacements['9b']='</span>';
$bb_name[9]='font';
$bb_legend[9]='[FONT="Lucida Console"]text[/FONT] sets the font to courier';
$bb_type[9]='standard';



//align left
$bb_replace['10a']='/\[left\](<br \/>)?/is';
$bb_replacements['10a']='<div align=left>';
$bb_replace['10b']='/\[\/left\](<br \/>)?/is';
$bb_replacements['10b']='</div>';
$bb_name[10]='align left';
$bb_legend[10]='[LEFT]text[/LEFT] aligns text to the left';
$bb_type[10]='standard';

//align center
$bb_replace['11a']='/\[center\](<br \/>)?/is';
$bb_replacements['11a']='<div align=center>';
$bb_replace['11b']='/\[\/center\](<br \/>)?/is';
$bb_replacements['11b']='</div>';
$bb_name[11]='align center';
$bb_legend[11]='[CENTER]text[/CENTER] aligns text to the center';
$bb_type[11]='standard';

//align right
$bb_replace['12a']='/\[right\](<br \/>)?/is';
$bb_replacements['12a']='<div align=right>';
$bb_replace['12b']='/\[\/right\](<br \/>)?/is';
$bb_replacements['12b']='</div>';
$bb_name[12]='align right';
$bb_legend[12]='[RIGHT]text[/RIGHT] aligns text to the right';
$bb_type[12]='standard';


//code
//$bb_replace['13a']='/\[code\](<br \/>)?/is';
//$bb_replacements['13a']='<div style="width:100%;overflow:auto;overflow-x:auto;overflow-y:visible;"><table class="class_nodesforum_bgcolor3" style="width:100%;"><tr><td class="class_nodesforum_bgcolor2"><div class="class_nodesforum_inner"><pre style="padding:0px;margin:0px;">';
//$bb_replace['13b']='/(<br \/>(.)?(.)?)?\[\/code\]/is';
//$bb_replacements['13b']='</pre></div></td></tr></table></div>';

//$bb_replace[13]='/\[code\](<br \/>)?(.*?)(<br \/>(.)?(.)?)?\[\/code\]/is';
//$bb_replacements[13]='<div style="width:100%;overflow:auto;overflow-x:auto;overflow-y:visible;"><table class="class_nodesforum_bgcolor3" style="width:100%;"><tr><td class="class_nodesforum_bgcolor2"><div class="class_nodesforum_inner"><pre style="padding:0px;margin:0px;">\\2</pre></div></td></tr></table></div>';

//code tags will be parsed in the function
$bb_name[13]='code';
$bb_legend[13]='[CODE]text[/CODE] to write code';
$bb_type[13]='standard';



//quote
//quotes will be parsed in the function

$bb_name[21]='quote';
$bb_legend[21]='[QUOTE]text[/QUOTE] to write quoted text';
$bb_type[21]='standard';




//links
$bb_replace['14a']='/(\[url\])([^\[]+)(\[\/url\])/is';
$bb_replacements['14a']='<a target="_blank" href="\\2" rel="nofollow" class="nodesforum_outlink">\\2</a>';
$bb_replace['14b']='/\[url=([^\]]+)\]/is';
$bb_replacements['14b']='<a target="_blank" href="\\1" rel="nofollow" class="nodesforum_outlink">';
$bb_replace['14c']='/\[\/url\]/is';
$bb_replacements['14c']='</a>';
$bb_name[14]='link';
$bb_legend[14]='[URL=http://mylink.com/]text[/URL] or [URL]http://mylink.com/[/URL] makes a link';
$bb_type[14]='standard';

//images
$bb_replace[15]='/\[img(( width=([^ \]]+))*|( height=([^ \]]+))*)*\]([^\[]+)\[\/img\]/is';
$bb_replacements[15]='<img src="\\6" style="width: \\3px;height: \\5px;" />';
$bb_name[15]='image';
$bb_legend[15]='[IMG]http://image_link.com/[/IMG] or [IMG WIDTH=200 HEIGHT=50]http://image_link.com/[/IMG] or [IMG HEIGHT=50]http://image_link.com/[/IMG] makes an image';
$bb_type[15]='standard';





//lists ...

//no regex, code will be parsing in the function

$bb_name[16]='list';
$bb_legend[16]='
	[LIST]
	[*]apple
	[*]banana
	[*]piment
	[/LIST]
	makes an unordered list, and
	[LIST=1]
	[*]apple
	[*]banana
	[*]piment
	[/LIST]
	makes an ordered list';
$bb_type[16]='standard';








//smileys


$_nodesforum_smiley_spacing_style='style="padding-left:1px;padding-right:1px;"';


$bb_replace['22a']='/\[smiley\]:\)\[\/smiley\]/i';
$bb_replacements['22a']='<img src="'.$_icons_path.'/minipics/smileys/smile.gif" '.$_nodesforum_smiley_spacing_style.' />';
$bb_replace['22b']='/\[smiley\]:p\[\/smiley\]/i';
$bb_replacements['22b']='<img src="'.$_icons_path.'/minipics/smileys/tongue.gif" '.$_nodesforum_smiley_spacing_style.' />';
$bb_replace['22c']='/\[smiley\]:\(\[\/smiley\]/i';
$bb_replacements['22c']='<img src="'.$_icons_path.'/minipics/smileys/frown.gif" '.$_nodesforum_smiley_spacing_style.' />';
$bb_replace['22d']='/\[smiley\]:D\[\/smiley\]/i';
$bb_replacements['22d']='<img src="'.$_icons_path.'/minipics/smileys/bigsmile.gif" '.$_nodesforum_smiley_spacing_style.' />';
$bb_replace['22e']='/\[smiley\];\)\[\/smiley\]/i';
$bb_replacements['22e']='<img src="'.$_icons_path.'/minipics/smileys/wink.gif" '.$_nodesforum_smiley_spacing_style.' />';

$bb_replace['22f']='/\[smiley\]8\)\[\/smiley\]/i';
$bb_replacements['22f']='<img src="'.$_icons_path.'/minipics/smileys/glasses.gif" '.$_nodesforum_smiley_spacing_style.' />';
$bb_replace['22g']='/\[smiley\]B\)\[\/smiley\]/i';
$bb_replacements['22g']='<img src="'.$_icons_path.'/minipics/smileys/shades.gif" '.$_nodesforum_smiley_spacing_style.' />';
$bb_replace['22h']='/\[smiley\]:(\/|\\\)\[\/smiley\]/i';
$bb_replacements['22h']='<img src="'.$_icons_path.'/minipics/smileys/unsure.gif" '.$_nodesforum_smiley_spacing_style.' />';


$bb_replace['22sbb']='/\[(smiley|SMILEY)\]8(O|0)\[\/(smiley|SMILEY)\]/';
$bb_replacements['22sbb']='<img src="'.$_icons_path.'/minipics/smileys/surprise_bb.gif" '.$_nodesforum_smiley_spacing_style.' />';
$bb_replace['22sbs']='/\[(smiley|SMILEY)\]8o\[\/(smiley|SMILEY)\]/';
$bb_replacements['22sbs']='<img src="'.$_icons_path.'/minipics/smileys/surprise_bs.gif" '.$_nodesforum_smiley_spacing_style.' />';
$bb_replace['22sss']='/\[(smiley|SMILEY)\]:o\[\/(smiley|SMILEY)\]/';
$bb_replacements['22sss']='<img src="'.$_icons_path.'/minipics/smileys/surprise_ss.gif" '.$_nodesforum_smiley_spacing_style.' />';
$bb_replace['22ssb']='/\[(smiley|SMILEY)\]:(O|0)\[\/(smiley|SMILEY)\]/';
$bb_replacements['22ssb']='<img src="'.$_icons_path.'/minipics/smileys/surprise_sb.gif" '.$_nodesforum_smiley_spacing_style.' />';



$bb_name[22]='smileys';
$bb_legend[22]='[smiley]:)[/smiley] or [smiley]:P[/smiley] makes smileys';
$bb_type[22]='standard';








//tables

//tables will now be parsed manually in the function

//$bb_replace['23a']='/(<br \/>)?\[table( bg=([^ \]]+)| width=([^ \]]+))*\](<br \/>)?/is';
//$bb_replacements['23a']='<table style="color:inherit;width:\\4;background-color:\\3;">';
//$bb_replace['23b']='/(<br \/>)?\[\/table\](<br \/>)?/is';
//$bb_replacements['23b']='</table>';
//
//$bb_replace['23c']='/(<br \/>)?\[tr\](<br \/>)?/is';
//$bb_replacements['23c']='<tr>';
//$bb_replace['23d']='/(<br \/>)?\[\/tr\](<br \/>)?/is';
//$bb_replacements['23d']='</tr>';
//
//$bb_replace['23e']='/(<br \/>)?\[td( bg=([^ \]]+)| width=([^ \]]+)|( colspan=([^ \]]+))|( rowspan=([^ \]]+))|( valign=([^ \]]+)))*\](<br \/>)?/is';
//$bb_replacements['23e']='<td style="width:\\4;background-color:\\3;vertical-align:\\10;" \\5 \\7>';
//$bb_replace['23f']='/(<br \/>)?\[\/td\](<br \/>)?/is';
//$bb_replacements['23f']='</td>';




$bb_name[23]='tables';
$bb_legend[23]='
	[table width=100% bg=#CCCCCC]
	[tr][td] row 1 column 1 [/td][td] row 1 column 2 [/td][/tr]
	[tr][td width=15px bg=blue valign=top colspan=2] row 2[/td][/tr]
	[/table]
	makes a table';
$bb_type[23]='standard';















//flash
//with power
$bb_replace_with_power[17]='/\[flash(( width=([^ \]]+))*|( height=([^ \]]+))*|( flashvars=([^ \]]+))*)*\]([^\[]+)\[\/flash\]/is';
$bb_replacements_with_power[17]='<object classid="clsid: d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="\\3" height="\\5" id="flvplayer" align="middle">
	<param name="allowScriptAccess" value="sameDomain" />
	<param name="allowFullScreen" value="true" />
	<param name="movie" value="\\8" />
	<param name="flashvars" value="\\7" />
	<param name="loop" value="true" />
	<param name="quality" value="high" />
	<param name="bgcolor" value="#000000" />
	<embed src="\\8" flashvars="\\7" loop="true" quality="high" bgcolor="#000000" width="\\3" height="\\5" name="flvplayer" align="middle" allowScriptAccess="sameDomain" allowFullScreen="true" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer"></embed></object>';
//without power
$bb_replace_without_power[17]='/\[flash(( width=([^ \]]+))*|( height=([^ \]]+))*|( flashvars=([^ \]]+))*)*\]([^\[]+)\[\/flash\]/is';
$bb_replacements_without_power[17]='<a target="_blank" rel="nofollow" href="?_nodesforum_out_flash&url=\\8&flashvars=\\7&w=\\3&h=\\5" />\\8</a>';
$bb_name[17]='flash';
$bb_legend[17]='[FLASH]http://website.com/flash_movie_url.swf[/FLASH] or [FLASH width=200 height=50 flashvars=&var1=test&var2=test]http://website.com/flash_movie_url.swf[/FLASH] embeds flash in the post if you have the power to do it on this forum, otherwise it will only show a link to the flash movie';
$bb_type[17]='risky';

//iframes
//with power
$bb_replace_with_power[18]='/\[iframe(( width=([^ \]]+))*|( height=([^ \]]+))*)*\]([^\[]+)\[\/iframe\]/is';
$bb_replacements_with_power[18]='<iframe src="\\6" style="width: \\3px;height: \\5px;"></iframe>';
//without power
$bb_replace_without_power[18]='/\[iframe(( width=([^ \]]+))*|( height=([^ \]]+))*)*\]([^\[]+)\[\/iframe\]/is';
$bb_replacements_without_power[18]='<a target="_blank" href="\\6" rel="nofollow" />\\6</a>';
$bb_name[18]='iframe';
$bb_legend[18]='[IFRAME]http://website.com/frame[/IFRAME] or [IFRAME width=200 height=50]http://website.com/frame[/IFRAME] embeds an iframe in the post if you have the power to do it on this forum, otherwise it will only show a link to the framed page';
$bb_type[18]='risky';




//html
//no regex, code will be parsing in the function
$bb_name[19]='html';
$bb_legend[19]='
[HTML]
<p>this is a paragraph</p>
[/HTML]';
$bb_type[19]='risky';


//-----------3D PARTY TAGS


//default limits 3rd party tag limits
$_nodesforum_3rd_party_tag_limits_user_default=20;
$_nodesforum_3rd_party_tag_limits_guest_default=3;




//facebook like button
$bb_replace_3rd_party['like']='/\[like\]/is';
$bb_replacements_3rd_party['like']='<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) {return;}
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, \'script\', \'facebook-jssdk\'));</script>
<div class="fb-like" data-send="true" data-width="450" data-show-faces="true"></div>';
$bb_name['like']='facebook like button';
$bb_legend['like']='[LIKE] embeds facebook like button in the post';
$bb_type['like']='3rd party';

//twitter tweet button
$bb_replace_3rd_party['tweet']='/\[tweet\]/is';
$bb_replacements_3rd_party['tweet']='<a href="https://twitter.com/share" rel="nofollow" class="twitter-share-button" data-count="vertical">Tweet</a><script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>';
$bb_name['tweet']='twitter tweet button';
$bb_legend['tweet']='[TWEET] embeds twitter tweet button in the post';
$bb_type['tweet']='3rd party';

//google +1 button
$bb_replace_3rd_party['+1']='/\[\+1\]/is';
$bb_replacements_3rd_party['+1']='<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
<g:plusone></g:plusone>';
$bb_name['+1']='google +1 button';
$bb_legend['+1']='[+1] embeds google +1 button in the post';
$bb_type['+1']='3rd party';

//addthis button
$bb_replace_3rd_party['addthis']='/\[addthis\]/is';
$bb_replacements_3rd_party['addthis']='<!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style ">
<a class="addthis_button_preferred_1"></a>
<a class="addthis_button_preferred_2"></a>
<a class="addthis_button_preferred_3"></a>
<a class="addthis_button_preferred_4"></a>
<a class="addthis_button_compact"></a>
<a class="addthis_counter addthis_bubble_style"></a>
</div>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4e97e5fe184937be"></script>
<!-- AddThis Button END -->';
$bb_name['addthis']='addthis button';
$bb_legend['addthis']='[ADDTHIS] embeds addthis button in the post';
$bb_type['addthis']='3rd party';




//youtube videos
$bb_replace_3rd_party['youtube']='/\[youtube(( width=([^ \]]+))*|( height=([^ \]]+))*)*\]([^\[]+)(v=|\/v\/)([^\["]+)[^\[]*\[\/youtube\]/is';
$bb_replacements_3rd_party['youtube']='<object width="\\3" height="\\5"><param name="movie" value="http://www.youtube.com/v/\\8&fs=1"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/\\8&fs=1" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="\\3" height="\\5"></embed></object>';
$bb_name['youtube']='youtube video';
$bb_legend['youtube']='[YOUTUBE WIDTH=100 HEIGHT=100]http://www.youtube.com/watch?v=xxxXXxxXx[/YOUTUBE] embeds a youtube video in the post';
$bb_type['youtube']='3rd party';



//test quicktime
//$bb_replace_3rd_party['quicktime']='/\[quicktime(( width=([^ \]]+))*|( height=([^ \]]+))*|( autoplay=([^ \]]+))*|( controller=([^ \]]+))*)*\]([^ \[]*)\[\/quicktime\]/is';
//$bb_replacements_3rd_party['quicktime']='<object width="\\3" height="\\5"
//classid="clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B"
//codebase="http://www.apple.com/qtactivex/qtplugin.cab">
//<param name="src" value="\\10">
//<param name="autoplay" value="\\7">
//<param name="controller" value="\\9">
//
//<embed src="\\10" width="\\3" height="\\5"
//autoplay="\\7" controller="\\9"
//pluginspage="http://www.apple.com/quicktime/download/">
//</embed>
//
//</object>';
//$bb_name['quicktime']='quicktime video';
//$bb_legend['quicktime']='[QUICKTIME WIDTH=100 HEIGHT=100 AUTOPLAY=false CONTROLLER=true]http://mywebsite.com/myvideo.mov[/QUICKTIME] embeds a quicktime video in the post';
//$bb_type['quicktime']='3rd party';



////loombo -DEAD
//$bb_replace_3rd_party['loombo']='/\[loombo\][^\[]+ width\: ([0-9]+)px[^\[]+ height\: ([0-9]+)px[^\[]+id=([0-9]+)[^\[]+vid_type=([^\']+)[^\[]+\[\/loombo\]/is';
//$bb_replacements_3rd_party['loombo']="<iframe style='overflow: hidden; border: 0; width: \\1px; height: \\2px' src='http://loombo.com/cgi-bin/index.cgi?op=embed_video&id=\\3&vid_type=\\4' scrolling='no'></iframe>";
//$bb_name['loombo']='loombo video';
//$bb_legend['loombo']="
//	[LOOMBO]
//	<iframe style='overflow: hidden; border: 0; width: 640px; height: 395px' src='http://loombo.com/cgi-bin/index.cgi?op=embed_video&id=xxxxx&vid_type=flv' scrolling='no'></iframe>
//	[/LOOMBO] embeds a loombo video in the post";
//$bb_type['loombo']='3rd party';

// //zshare
// $bb_replace_3rd_party['zshare']='/\[zshare\][^\[]+?SID=([^\[]+)\&FID=([^\[]+)\&FN=([^\[]+)\&iframewidth=([^\[]+)\&iframeheight=([^\[]+)\&width=([^\[]+)\&height=([^\[]+)\&H=([^"]+)" height="([0-9]+)" width="([0-9]+)[^\[]+\[\/zshare\]/is';
// $bb_replacements_3rd_party['zshare']='<iframe src="http://www.zshare.net/videoplayer/player.php?SID=\\1&FID=\\2&FN=\\3&iframewidth=648&iframeheight=415&width=640&height=370&H=71794926c1510f72" height="415" width="648"  border=0 frameborder=0 scrolling=no></iframe>';
// $bb_name['zshare']='zshare video';
// $bb_legend['zshare']='
	// [ZSHARE]
	// <iframe src="http://www.zshare.net/videoplayer/player.php?SID=dl067&FID=xxxxxxx&FN...rameheight=415&width=640&height=370&H=xxxxxxxxxx" height="415" width="648"  border=0 frameborder=0 scrolling=no></iframe>
	// [/ZSHARE] embeds a loombo video in the post';
// $bb_type['zshare']='3rd party';


//novamov videos
$bb_replace_3rd_party['novamov']='/\[novamov\]([^\[]+)\/video\/([^\["]+)[^\[]*\[\/novamov\]/is';
$bb_replacements_3rd_party['novamov']="<iframe style='overflow: hidden; border: 0; width: 600px; height: 480px' src='http://embed.novamov.com/embed.php?width=600&height=480&v=\\2&px=1' scrolling='no'></iframe>";
$bb_name['novamov']='novamov video';
$bb_legend['novamov']="[NOVAMOV]http://www.novamov.com/video/xxxxxxxxxxxxx[/NOVAMOV] embeds a novamov video in the post";
$bb_type['novamov']='3rd party';


// //megavideo
// $bb_replace_3rd_party['megavideo']='/\[megavideo(( width=([^ \]]+))*|( height=([^ \]]+))*)*\][^\[]+\/v\/([^"]+)[^\[]+\[\/megavideo\]/is';
// $bb_replacements_3rd_party['megavideo']='<object width="\\3" height="\\5"><param name="movie" value="http://www.megavideo.com/v/\\6"></param><param name="allowFullScreen" value="true"></param><embed src="http://www.megavideo.com/v/1MVSMF485c8e12d5c3b0312f215e837c5358025a" type="application/x-shockwave-flash" allowfullscreen="true" width="\\3" height="\\5"></embed></object>';
// $bb_name['megavideo']='megavideo video';
// $bb_legend['megavideo']='
	// [MEGAVIDEO WIDTH="200" HEIGHT="120"]
	// <object width="640" height="330"><param name="movie" value="http://www.megavideo.com/v/xxxxxxxxxxxxxxxxxxxxxxxxxxxxx"></param><param name="allowFullScreen" value="true"></param><embed src="http://www.megavideo.com/v/1MVSMF485c8e12d5c3b0312f215e837c5358025a" type="application/x-shockwave-flash" allowfullscreen="true" width="640" height="330"></embed></object>
	// [/MEGAVIDEO] embeds a megavideo video in the post';
// $bb_type['megavideo']='3rd party';


//stagevu videos
$bb_replace_3rd_party['stagevu']='/\[stagevu\][^\[]+\/video\/([^\[]+)\[\/stagevu\]/is';
$bb_replacements_3rd_party['stagevu']="<iframe style='overflow: hidden; border: 0; width: 720px; height: 506px' src='http://stagevu.com/embed?width=720&amp;height=450&amp;background=000&amp;uid=\\1' scrolling='no'></iframe>";
$bb_name['stagevu']='stagevu video';
$bb_legend['stagevu']='[STAGEVU]http://stagevu.com/video/xxxxxxxxxxxxxxx[/STAGEVU] embeds a stagevu video in the post';
$bb_type['stagevu']='3rd party';


//tudou videos
$bb_replace_3rd_party['tudou']='/\[tudou(( width=([^ \]]+))*|( height=([^ \]]+))*)*\][^\[]+\/programs\/view\/([^\[\/]+)\/*\[\/tudou\]/is';
$bb_replacements_3rd_party['tudou']='<object width="\\3" height="\\5"><param name="movie" value="http://www.tudou.com/v/\\6"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><param name="wmode" value="opaque"></param><embed src="http://www.tudou.com/v/\\6" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" wmode="opaque" width="\\3" height="\\5"></embed></object>';
$bb_name['tudou']='tudou video';
$bb_legend['tudou']='[TUDOU WIDTH=100 HEIGHT=100]http://www.tudou.com/programs/view/xxxxxxxxxxxxxxx/[/TUDOU] embeds a tudou video in the post';
$bb_type['tudou']='3rd party';


//youku videos
$bb_replace_3rd_party['youku']='/\[youku(( width=([^ \]]+))*|( height=([^ \]]+))*)*\][^\[]+id_([^\[\/\.]+)[^\[]+\[\/youku\]/is';
$bb_replacements_3rd_party['youku']='<embed src="http://player.youku.com/player.php/sid/\\6/v.swf" quality="high" width="\\3" height="\\5" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash"></embed>';
$bb_name['youku']='youku video';
$bb_legend['youku']='[YOUKU WIDTH=100 HEIGHT=100]http://v.youku.com/v_show/id_xxxxxxxxxxxx.html[/YOUKU] embeds a youku video in the post';
$bb_type['youku']='3rd party';

//56.com
$bb_replace_3rd_party['56.com']='/\[56.com\][^\[]+ src="http:\/\/www.56.com\/([^\[]+)\.swf[^\[]+ width="([0-9]+)" height="([0-9]+)[^\[]+\[\/56.com\]/is';
$bb_replacements_3rd_party['56.com']='<embed src="http://www.56.com/\\1.swf"  type="application/x-shockwave-flash" width="\\2" height="\\3"></embed>';
$bb_name['56.com']='56.com video';
$bb_legend['56.com']='
	[56.COM WIDTH=100 HEIGHT=100]
	<embed src="http://www.56.com/n_v198_/c49_/14_/17_/ccf_win_/xxxxxxxxxxxxxxxhd_/xxxxxx_/0_/xxxxxxxx.swf"  type="application/x-shockwave-flash" width="480" height="395"></embed>
	[/56.COM] embeds a 56.com video in the post';
$bb_type['56.com']='3rd party';


//google maps
$bb_replace_3rd_party['google_maps']='/\[google_maps\][^\[]+ width="([0-9]+)" height="([0-9]+)"[^\[>]+http:\/\/maps\.google\.[^\[\/]{2,5}\/([^\["]+)[^\[]+http:\/\/maps\.google\.[^\[\/]{2,5}\/([^\["]+)[^\[]+\[\/google_maps\]/is';
$bb_replacements_3rd_party['google_maps']='<iframe width="\\1" height="\\2" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/\\3"></iframe><br /><small><a href="http://maps.google.com/\\4" rel="nofollow" style="color: #0000FF; text-align: left" target="_blank">View Larger Map</a></small>';
$bb_name['google_maps']='google maps';
$bb_legend['google_maps']='
	[GOOGLE_MAPS]
	<iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/?ie=UTF8&amp;ll=46.225453,-64.962158&amp;spn=3.739548,7.064209&amp;t=h&amp;z=7&amp;output=embed"></iframe><br /><small><a rel="nofollow" href="http://maps.google.com/?ie=UTF8&amp;ll=46.225453,-64.962158&amp;spn=3.739548,7.064209&amp;t=h&amp;z=7&amp;source=embed" style="color: #0000FF; text-align: left">View Larger Map</a></small>
	[/GOOGLE_MAPS] embeds a google map in the post';
$bb_type['google_maps']='3rd party';



//veoh videos
$bb_replace_3rd_party['veoh']='/\[veoh(( width=([^ \]]+))*|( height=([^ \]]+))*)*\][^\[]+(\/watch\/|#watch%3D)([^\[\/ ]+)[^\[]*\[\/veoh\]/is';
$bb_replacements_3rd_party['veoh']='<object width="\\3" height="\\5" id="veohFlashPlayer" name="veohFlashPlayer"><param name="movie" value="http://www.veoh.com/static/swf/webplayer/WebPlayer.swf?version=AFrontend.5.5.2.1010&permalinkId=\\7&player=videodetailsembedded&videoAutoPlay=0&id=anonymous"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.veoh.com/static/swf/webplayer/WebPlayer.swf?version=AFrontend.5.5.2.1010&permalinkId=\\7&player=videodetailsembedded&videoAutoPlay=0&id=anonymous" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="\\3" height="\\5" id="veohFlashPlayerEmbed" name="veohFlashPlayerEmbed"></embed></object>';
$bb_name['veoh']='veoh video';
$bb_legend['veoh']='[VEOH WIDTH=100 HEIGHT=100]http://www.veoh.com/browse/videos/category/anime/watch/vxxxxxxxxxxxxxx[/VEOH] or [VEOH]http://www.veoh.com/browse/videos#watch%3Dvxxxxxxxxxxxxxxxxxxx[/VEOH] embeds a veoh video in the post';
$bb_type['veoh']='3rd party';



//hulu videos
$bb_replace_3rd_party['hulu']='/\[hulu\][^\[]+width="([^\["]+)"[^\[]+height="([^\["]+)"[^\[]+\/embed\/([^\[">]+)[^\[]+\[\/hulu\]/is';
$bb_replacements_3rd_party['hulu']='<object width="\\1" height="\\2"><param name="movie" value="http://www.hulu.com/embed/\\3"></param><param name="allowFullScreen" value="true"></param><embed src="http://www.hulu.com/embed/\\3" type="application/x-shockwave-flash"  width="\\1" height="\\2" allowFullScreen="true"></embed></object>';
$bb_name['hulu']='hulu video';
$bb_legend['hulu']='[HULU]<object width="512" height="288"><param name="movie" value="http://www.hulu.com/embed/xxxxxxxxxxxxxxxxxx"></param><param name="allowFullScreen" value="true"></param><embed src="http://www.hulu.com/embed/xxxxxxxxxxxxxxx" type="application/x-shockwave-flash"  width="512" height="288" allowFullScreen="true"></embed></object>[/HULU] embeds a hulu video in the post';
$bb_type['hulu']='3rd party';





//myspace videos
$bb_replace_3rd_party['myspace_video']='/\[myspace_video(( width=([^ \]]+))*|( height=([^ \]]+))*)*\][^\[]+videoid=([^\[&]+)[^\[]*\[\/myspace_video\]/is';
$bb_replacements_3rd_party['myspace_video']='<object width="\\3px" height="\\5px" ><param name="allowFullScreen" value="true"/><param name="wmode" value="transparent"/><param name="movie" value="http://mediaservices.myspace.com/services/media/embed.aspx/m=\\6,t=1,mt=video"/><embed src="http://mediaservices.myspace.com/services/media/embed.aspx/m=\\6,t=1,mt=video" width="\\3" height="\\5" allowFullScreen="true" type="application/x-shockwave-flash" wmode="transparent"></embed></object><br/><a style="font: Verdana" rel="nofollow" href="http://www.myspace.com/diagonalview">Diagonal View</a> | <a rel="nofollow" style="font: Verdana" href="http://vids.myspace.com">MySpace Video</a></font>';
$bb_name['myspace_video']='myspace video';
$bb_legend['myspace_video']='[MYSPACE_VIDEO WIDTH=100 HEIGHT=100]http://vids.myspace.com/index.cfm?fuseaction=vids.individual&videoid=xxxxxxxxxxx[/MYSPACE_VIDEO] embeds a myspace video in the post';
$bb_type['myspace_video']='3rd party';



//barbavid video
$bb_replace_3rd_party['barbavid']='/\[barbavid(( width=([^ \]]+))*|( height=([^ \]]+))*)*\]([^\[]+)\/video\/([^\["]+)[^\[]*\[\/barbavid\]/is';
$bb_replacements_3rd_party['barbavid']='<object width="\\3" height="\\5"><param name="movie" value="http://barbavid.com/player2.swf"><param name="flashvars" value="upload_hash=\\7"><param name="allowFullScreen" value="true" /><param name="allowScriptAccess" value="always" /><param name="wmode" value="opaque" /><embed width="\\3" height="\\5" src="http://barbavid.com/player2.swf" flashvars="upload_hash=\\7" allowFullScreen="true" allowScriptAccess="always" wmode="opaque"></embed></object>';
$bb_name['barbavid']='barbavid video';
$bb_legend['barbavid']="[BARBAVID WIDTH=400 HEIGHT=200]http://barbavid.com/video/xxxxxxxxxxxx[/BARBAVID] embeds a barbavid video in the post";
$bb_type['barbavid']='3rd party';


//vidxden video
$bb_replace_3rd_party['vidxden']='/\[vidxden\]([^\[]+)vidxden.com\/([^\["]+)\/[^\[]*?\[\/vidxden\]/is';
$bb_replacements_3rd_party['vidxden']='<IFRAME SRC="http://www.vidxden.com/embed-\\2-width-653-height-362.html" FRAMEBORDER=0 MARGINWIDTH=0 MARGINHEIGHT=0 SCROLLING=NO WIDTH=653 HEIGHT=362></IFRAME>';
$bb_name['vidxden']='vidxden video';
$bb_legend['vidxden']="[VIDXDEN]http://www.vidxden.com/xxxxxxxxxxxx/pawn.stars.s01e01.dvdrip.xvid-wide.avi.html[/VIDXDEN] embeds a vidxden video in the post";
$bb_type['vidxden']='3rd party';

//vidbux video
$bb_replace_3rd_party['vidbux']='/\[vidbux\]([^\[]+)vidbux.com\/([^\["]+)\/[^\[]*?\[\/vidbux\]/is';
$bb_replacements_3rd_party['vidbux']='<IFRAME SRC="http://www.vidbux.com/embed-\\2-width-653-height-362.html" FRAMEBORDER=0 MARGINWIDTH=0 MARGINHEIGHT=0 SCROLLING=NO WIDTH=653 HEIGHT=362></IFRAME>';
$bb_name['vidbux']='vidbux video';
$bb_legend['vidbux']="[VIDBUX]http://www.vidbux.com/xxxxxxxxxxxxxx/xxxxxxxxxxxxxxxxxxxx.html[/VIDBUX] embeds a vidxden video in the post";
$bb_type['vidbux']='3rd party';

//gorillavid video
$bb_replace_3rd_party['gorillavid']='/\[gorillavid\]([^\[]+)gorillavid.com\/([^\["]+)[^\[]*?\[\/gorillavid\]/is';
$bb_replacements_3rd_party['gorillavid']='<IFRAME SRC="http://gorillavid.com/embed-\\2-960x511.html" FRAMEBORDER=0 MARGINWIDTH=0 MARGINHEIGHT=0 SCROLLING=NO WIDTH=960 HEIGHT=542></IFRAME>';
$bb_name['gorillavid']='gorillavid video';
$bb_legend['gorillavid']="[GORILLAVID]http://gorillavid.com/xxxxxxxxxxxxx[/GORILLAVID] embeds a gorillavid video in the post";
$bb_type['gorillavid']='3rd party';

//putlocker video
$bb_replace_3rd_party['putlocker']='/\[putlocker\]([^\[]+)\/file\/([^\["]+)[^\[]*\[\/putlocker\]/is';
$bb_replacements_3rd_party['putlocker']='<iframe src="http://www.putlocker.com/embed/\\2" width="600" height="360" frameborder="0" scrolling="no"></iframe>';
$bb_name['putlocker']='putlocker video';
$bb_legend['putlocker']="[PUTLOCKER]http://www.putlocker.com/file/xxxxxxxxxxxxxxx[/PUTLOCKER] embeds a putlocker video in the post";
$bb_type['putlocker']='3rd party';

//sockshare video
$bb_replace_3rd_party['sockshare']='/\[sockshare\]([^\[]+)\/file\/([^\["]+)[^\[]*\[\/sockshare\]/is';
$bb_replacements_3rd_party['sockshare']='<iframe src="http://www.sockshare.com/embed/\\2" width="600" height="360" frameborder="0" scrolling="no"></iframe>';
$bb_name['sockshare']='sockshare video';
$bb_legend['sockshare']="[SOCKSHARE]http://www.sockshare.com/file/xxxxxxxxxxxxxxx[/SOCKSHARE] embeds a sockshare video in the post";
$bb_type['sockshare']='3rd party';

//videoweed video
$bb_replace_3rd_party['videoweed']='/\[videoweed\]([^\[]+)\/file\/([^\["]+)[^\[]*\[\/videoweed\]/is';
$bb_replacements_3rd_party['videoweed']='<iframe width="600" height="480" frameborder="0" src="http://embed.videoweed.es/embed.php?v=\\2&width=600&height=480" scrolling="no"></iframe>';
$bb_name['videoweed']='videoweed video';
$bb_legend['videoweed']="[VIDEOWEED]http://www.videoweed.es/file/xxxxxxxxxxxxxxxxx[/VIDEOWEED] embeds a videoweed video in the post";
$bb_type['videoweed']='3rd party';

//divxstage videos
$bb_replace_3rd_party['divxstage']='/\[divxstage\]([^\[]+)\/video\/([^\["]+)[^\[]*\[\/divxstage\]/is';
$bb_replacements_3rd_party['divxstage']="<iframe style='overflow: hidden; border: 0; width: 600px; height: 400px' src='http://embed.divxstage.eu/embed.php?v=\\2&width=600&height=400' scrolling='no'></iframe>";
$bb_name['divxstage']='divxstage video';
$bb_legend['divxstage']="[DIVXSTAGE]http://www.divxstage.eu/video/xxxxxxxxxxxxx[/DIVXSTAGE] embeds a divxstage video in the post";
$bb_type['divxstage']='3rd party';

//movshare videos
$bb_replace_3rd_party['movshare']='/\[movshare\]([^\[]+)\/video\/([^\["]+)[^\[]*\[\/movshare\]/is';
$bb_replacements_3rd_party['movshare']="<iframe style='overflow: hidden; border: 0; width: 720px; height: 306px' src='http://embed.movshare.net/embed.php?v=\\2&width=720&height=306&color=black' scrolling='no'></iframe>";
$bb_name['movshare']='movshare video';
$bb_legend['movshare']="[MOVSHARE]http://www.movshare.net/video/xxxxxxxxxxxxxxxxxxxx[/MOVSHARE] embeds a movshare video in the post";
$bb_type['movshare']='3rd party';




if(!isset($_nodesforum_max_word_length_in_posts))
{$_nodesforum_max_word_length_in_posts=60;}

function display_bb($string,$p_inf_str='1!1!1!1!1!1!1!1!1!1',$user_or_guest=0,$disable_auto_smileys=0,$disable_auto_links=0,$quoteornot=0)
{



//echo htmlspecialchars($string).'<br />';


    global $bb_replace;
    global $bb_replacements;

    $exploded_powers=explode('!',$p_inf_str);

    global $bb_replace_with_power;
    global $bb_replacements_with_power;
    global $bb_replace_without_power;
    global $bb_replacements_without_power;


    global $_nodesforum_text_color;


    global $_nodesforum_max_word_length_in_posts;





    //remove info from quotes and save it in arrays

    global $_nodesforum_bbcode_escape_char;




    // 1. Extract all [code]...[/code] blocks (with nesting support) and replace with placeholders
    $code_blocks = [];
    $placeholder_prefix = '[[CODE_BLOCK_';
    $placeholder_suffix = ']]';
    $code_index = 0;

    while (true) {
        $start = stripos($string, '[code]');
        if ($start === false) break;
        $level = 1;
        $pos = $start + 6;
        while ($level > 0) {
            $next_open = stripos($string, '[code]', $pos);
            $next_close = stripos($string, '[/code]', $pos);
            if ($next_close === false) break 2; // Unmatched tag, abort
            if ($next_open !== false && $next_open < $next_close) {
                $level++;
                $pos = $next_open + 6;
            } else {
                $level--;
                $pos = $next_close + 7;
            }
        }
        $end = $pos;
        $code_content = substr($string, $start + 6, $end - $start - 13); // 6 for [code], 7 for [/code]
        $code_blocks[$code_index] = htmlspecialchars($code_content, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
        $string = substr($string, 0, $start) . $placeholder_prefix . $code_index . $placeholder_suffix . substr($string, $end);
        $code_index++;
    }




    $no_more_quote_tags=0;
    $count_tags=0;
    $max_tags=100;
    $reading_head=0;
    while($no_more_quote_tags==0)
    {
        $count_tags++;
        if($count_tags>=$max_tags)
        {
            echo 'max loops busted on loop looking for quote tags<br />';
            break;
        }

        $find_first_quote_tag=stripos(' '.$string,'[quote',$reading_head);
        if($find_first_quote_tag)
        {
            $reading_head=$find_first_quote_tag+2;
            $find_first_quote_tag=$find_first_quote_tag-1;



            $secondary_reading_head=$reading_head;
            $closingtag_good=0;
            $nomore_closing_brackets=0;
            $counturns=0;
            $maxturns=100;
            while($closingtag_good==0 && $nomore_closing_brackets==0)
            {
                $counturns++;
                if($counturns>=$maxturns)
                {
                    echo 'max loops busted on loop looking for ] closing quote opening tag<br />';
                    break;
                }




                $find_closing_of_opening_tag=stripos($string,']',$secondary_reading_head);
                if($find_closing_of_opening_tag)
                {
                    $secondary_reading_head=$find_closing_of_opening_tag+2;
                    $char_before_that=substr($string,$find_closing_of_opening_tag-1,1);
                    if($char_before_that!=$_nodesforum_bbcode_escape_char)
                    {$closingtag_good=1;}
                }
                else
                {$nomore_closing_brackets=1;}
            }


            if($closingtag_good==1)
            {

                $length_of_opening_tag=$find_closing_of_opening_tag-$find_first_quote_tag;


                $string_of_opening_tag=substr($string,$find_first_quote_tag,$length_of_opening_tag);











                $lookfor_source_attribute=stripos($string_of_opening_tag,' source="');
                if($lookfor_source_attribute)
                {
                    $secondary_reading_head=$lookfor_source_attribute+9;
                    $sourcetag_good=0;
                    $nomore_srcattr=0;
                    $counturns=0;
                    $maxturns=100;
                    while($sourcetag_good==0 && $nomore_srcattr==0)
                    {
                        $counturns++;
                        if($counturns>=$maxturns)
                        {
                            echo 'max loops busted on loop looking for " closing quote source tag attribute<br />';
                            break;
                        }





                        $lookforclose_of_source_attribute=stripos($string_of_opening_tag,'"',$secondary_reading_head);
                        if($lookforclose_of_source_attribute)
                        {
                            $secondary_reading_head=$lookforclose_of_source_attribute+1;
                            $char_before_that=substr($string_of_opening_tag,$lookforclose_of_source_attribute-1,1);
                            if($char_before_that!=$_nodesforum_bbcode_escape_char)
                            {$sourcetag_good=1;}
                        }
                        else
                        {$nomore_srcattr=1;}
                    }


                    if($sourcetag_good==1)
                    {
                        $the_source_string=substr($string_of_opening_tag,$lookfor_source_attribute+9,$lookforclose_of_source_attribute-($lookfor_source_attribute+9));
                        $quote_sources[$count_tags]=_nodesforum_different_unescape_certain_chars($the_source_string);
                    }
                }








                $lookfor_strict_attribute=stripos($string_of_opening_tag,' strict="');
                if($lookfor_strict_attribute)
                {
                    $secondary_reading_head=$lookfor_strict_attribute+9;
                    $stricttag_good=0;
                    $nomore_strattr=0;
                    $counturns=0;
                    $maxturns=100;
                    while($stricttag_good<4 && $nomore_strattr==0)
                    {
                        $counturns++;
                        if($counturns>=$maxturns)
                        {
                            echo 'max loops busted on loop looking for " delimiting quote strict tag attributes<br />';
                            break;
                        }



                        $lookforclose_of_strict_attribute=stripos($string_of_opening_tag,'"',$secondary_reading_head);
                        if($lookforclose_of_strict_attribute)
                        {
                            $secondary_reading_head=$lookforclose_of_strict_attribute+1;
                            $char_before_that=substr($string_of_opening_tag,$lookforclose_of_strict_attribute-1,1);
                            if($char_before_that!=$_nodesforum_bbcode_escape_char)
                            {
                                $stricttag_good++;
                                $closing_quotes[$stricttag_good]=$lookforclose_of_strict_attribute;
                            }
                        }
                        else
                        {$nomore_strattr=1;}
                    }


                    if($stricttag_good==4)
                    {
                        $quote_postID[$count_tags]=substr($string_of_opening_tag,$lookfor_strict_attribute+9,$closing_quotes[1]-($lookfor_strict_attribute+9));
                        $quote_userID[$count_tags]=_nodesforum_different_unescape_certain_chars(substr($string_of_opening_tag,$closing_quotes[1]+1,$closing_quotes[2]-($closing_quotes[1]+1)));
                        $quote_publicname[$count_tags]=_nodesforum_different_unescape_certain_chars(substr($string_of_opening_tag,$closing_quotes[2]+1,$closing_quotes[3]-($closing_quotes[2]+1)));
                        $quote_time[$count_tags]=substr($string_of_opening_tag,$closing_quotes[3]+1,$closing_quotes[4]-($closing_quotes[3]+1));



                    }


                }








                $find_first_closing_tag_after_that=stripos($string,'[/quote]',$find_closing_of_opening_tag);
                if($find_first_closing_tag_after_that)
                {

                    $string_inside_of_tags=substr($string,$find_first_quote_tag+$length_of_opening_tag+1,$find_first_closing_tag_after_that-($find_first_quote_tag+$length_of_opening_tag+1));
                    $quote_texts[$count_tags]=_nodesforum_different_unescape_certain_chars($string_inside_of_tags);



                    $string_before=substr($string,0,$find_first_quote_tag);
                    $string_after=substr($string,$find_first_closing_tag_after_that+8);
                    $string=$string_before.'[quote]'.$count_tags.'[/quote]'.$string_after;


                    $reading_head=strlen($string_before)+strlen('[quote]')+strlen($count_tags)+strlen('[/quote]');
                }
                else
                {$no_more_quote_tags=1;}

            }
            else
            {$no_more_quote_tags=1;}
        }
        else
        {$no_more_quote_tags=1;}
    }








    //flash
    if($exploded_powers[0]==1)
    {
        $bb_replace[17]=$bb_replace_with_power[17];
        $bb_replacements[17]=$bb_replacements_with_power[17];
    }
    else
    {
        $bb_replace[17]=$bb_replace_without_power[17];
        $bb_replacements[17]=$bb_replacements_without_power[17];
    }

    //iframes
    if($exploded_powers[1]==1)
    {
        $bb_replace[18]=$bb_replace_with_power[18];
        $bb_replacements[18]=$bb_replacements_with_power[18];
    }
    else
    {
        $bb_replace[18]=$bb_replace_without_power[18];
        $bb_replacements[18]=$bb_replacements_without_power[18];
    }

    //html
    if($exploded_powers[2]==1)
    {
        //save code in each html tag on the side to avoid nl2br and htmlspecialchars

        $no_more_html_tags=0;
        $count_tags=0;
        $max_tags=100;
        $reading_head=0;
        while($no_more_html_tags==0)
        {
            $count_tags++;
            if($count_tags>=$max_tags)
            {
                echo 'max loops busted on loop looking for html tags<br />';
                break;
            }


            $find_first_html_tag=stripos(' '.$string,'[html]',$reading_head);
            if($find_first_html_tag)
            {

                $reading_head=$find_first_html_tag+2;
                $find_first_html_tag=$find_first_html_tag-1;

                $find_first_closing_tag_after_that=stripos($string,'[/html]',$find_first_html_tag);
                if($find_first_closing_tag_after_that)
                {

                    $string_inside_of_tags=substr($string,$find_first_html_tag+6,$find_first_closing_tag_after_that-($find_first_html_tag+6));
                    $code_on_the_side[$count_tags]=$string_inside_of_tags;


                    $string_before_code=substr($string,0,$find_first_html_tag+6);
                    $string_after_code=substr($string,$find_first_closing_tag_after_that);
                    $string=$string_before_code.$count_tags.$string_after_code;


                    $reading_head=strlen($string_before_code)+strlen($count_tags)+strlen('[/html]');
                }
                else
                {$no_more_html_tags=1;}
            }
            else
            {$no_more_html_tags=1;}
        }
    }
    else
    {
        $html_replace[1]='/\[html\]/is';
        $html_replace[2]='/\[\/html\]/is';
        $html_replacements[1]='<code style="color:'.$_nodesforum_text_color.';">';
        $html_replacements[2]='</code>';
    }


    $string=str_replace('<','&#60;',str_replace('>','&#62;',$string));



    //remove content from code tags here:
    $nomore_codetags=0;
    $count_codetags=0;
    $max_codetags=100;
    $codetags_reading_head=0;
    while($nomore_codetags==0)
    {
        $count_codetags++;
        if($count_codetags>=$max_codetags)
        {
            echo 'max loops busted on loop looking for code tags<br />';
            break;
        }
        $find_first_code_tag=stripos(' '.$string,'[code]',$codetags_reading_head);
        if($find_first_code_tag)
        {
            $codetags_reading_head=$find_first_code_tag+2;
            $find_first_code_tag=$find_first_code_tag-1;

            $find_first_closing_tag_after_that=stripos($string,'[/code]',$find_first_code_tag);
            if($find_first_closing_tag_after_that)
            {
                $code_tag_contents_ont_the_side[$count_codetags]=substr($string,$find_first_code_tag+6,$find_first_closing_tag_after_that-($find_first_code_tag+6));
                $string_before_code=substr($string,0,$find_first_code_tag+6);
                $string_after_code=substr($string,$find_first_closing_tag_after_that);
                $string=$string_before_code.$count_codetags.$string_after_code;
            }
            else
            {$nomore_codetags=1;}
        }
        else
        {$nomore_codetags=1;}
    }



    $string=nl2br($string);





    //change [ to &#91; inside [code] tags to allow showing bbcode in a code tag..
//    $nomore_codetags=0;
//    $count_codetags=0;
//    $max_codetags=100;
//    $codetags_reading_head=0;
//    while($nomore_codetags==0)
//    {
//        $count_codetags++;
//        if($count_codetags>=$max_codetags)
//        {
//            echo 'max loops busted on loop looking for code tags<br />';
//            break;
//        }
//        $find_first_code_tag=stripos(' '.$string,'[code]',$codetags_reading_head);
//        if($find_first_code_tag)
//        {
//            $codetags_reading_head=$find_first_code_tag+2;
//            $find_first_code_tag=$find_first_code_tag-1;
//
//            $find_first_closing_tag_after_that=stripos($string,'[/code]',$find_first_code_tag);
//            if($find_first_closing_tag_after_that)
//            {
//                $string_inside_of_tags=substr($string,$find_first_code_tag+6,$find_first_closing_tag_after_that-($find_first_code_tag+6));
//                $string_before_code=substr($string,0,$find_first_code_tag+6);
//                $string_after_code=substr($string,$find_first_closing_tag_after_that);
//                $string=$string_before_code.str_replace('[','&#91;',$string_inside_of_tags).$string_after_code;
//            }
//            else
//            {$nomore_codetags=1;}
//        }
//        else
//        {$nomore_codetags=1;}
//    }







    //replace all normal regexes
    $string = preg_replace($bb_replace, $bb_replacements, $string);


    //auto smileys
    if($disable_auto_smileys!=1)
    {
        global $_nodesforum_mysterypath;
        global $_nodesforum_smiley_spacing_style;







        $auto_smileys_replace[1]='/(^| |<br \/>|\n):\)/';
        $auto_smileys_replacements[1]='\\1<img src="'.$_nodesforum_mysterypath.'/minipics/smileys/smile.gif" '.$_nodesforum_smiley_spacing_style.' />';
        $auto_smileys_replace[2]='/(^| |<br \/>|\n):P/i';
        $auto_smileys_replacements[2]='\\1<img src="'.$_nodesforum_mysterypath.'/minipics/smileys/tongue.gif" '.$_nodesforum_smiley_spacing_style.' />';
        $auto_smileys_replace[3]='/(^| |<br \/>|\n):\(/';
        $auto_smileys_replacements[3]='\\1<img src="'.$_nodesforum_mysterypath.'/minipics/smileys/frown.gif" '.$_nodesforum_smiley_spacing_style.' />';
        $auto_smileys_replace[4]='/(^| |\\1<br \/>|\n):D/i';
        $auto_smileys_replacements[4]='\\1<img src="'.$_nodesforum_mysterypath.'/minipics/smileys/bigsmile.gif" '.$_nodesforum_smiley_spacing_style.' />';
        $auto_smileys_replace[5]='/(^| |<br \/>|\n);\)/';
        $auto_smileys_replacements[5]='\\1<img src="'.$_nodesforum_mysterypath.'/minipics/smileys/wink.gif" '.$_nodesforum_smiley_spacing_style.' />';

        $auto_smileys_replace[6]='/(^| |<br \/>|\n)8\)/';
        $auto_smileys_replacements[6]='\\1<img src="'.$_nodesforum_mysterypath.'/minipics/smileys/glasses.gif" '.$_nodesforum_smiley_spacing_style.' />';
        $auto_smileys_replace[7]='/(^| |<br \/>|\n)B\)/';
        $auto_smileys_replacements[7]='\\1<img src="'.$_nodesforum_mysterypath.'/minipics/smileys/shades.gif" '.$_nodesforum_smiley_spacing_style.' />';
        $auto_smileys_replace[8]='/(^| |<br \/>|\n):(\/|\\\)/';
        $auto_smileys_replacements[8]='\\1<img src="'.$_nodesforum_mysterypath.'/minipics/smileys/unsure.gif" '.$_nodesforum_smiley_spacing_style.' />';


        $auto_smileys_replace[9]='/(^| |<br \/>|\n)8O/';
        $auto_smileys_replacements[9]='\\1<img src="'.$_nodesforum_mysterypath.'/minipics/smileys/surprise_bb.gif" '.$_nodesforum_smiley_spacing_style.' />';
        $auto_smileys_replace[10]='/(^| |<br \/>|\n)8o/';
        $auto_smileys_replacements[10]='\\1<img src="'.$_nodesforum_mysterypath.'/minipics/smileys/surprise_bs.gif" '.$_nodesforum_smiley_spacing_style.' />';
        $auto_smileys_replace[11]='/(^| |<br \/>|\n):o/';
        $auto_smileys_replacements[11]='\\1<img src="'.$_nodesforum_mysterypath.'/minipics/smileys/surprise_ss.gif" '.$_nodesforum_smiley_spacing_style.' />';
        $auto_smileys_replace[12]='/(^| |<br \/>|\n):(0|O)/';
        $auto_smileys_replacements[12]='\\1<img src="'.$_nodesforum_mysterypath.'/minipics/smileys/surprise_sb.gif" '.$_nodesforum_smiley_spacing_style.' />';



        $string = preg_replace($auto_smileys_replace, $auto_smileys_replacements, $string);


    }





    if($disable_auto_links!=1)
    {
        $auto_links_replace[1]='#(^| |\\n)+(http://[-a-zA-Z0-9@:%_\+.~,\#?&//=]+)#';
        $auto_links_replacements[1]='\\1<a rel="nofollow" target="_blank" href="\\2" class="nodesforum_outlink" />\\2</a>';
        $string = preg_replace($auto_links_replace, $auto_links_replacements, $string);
    }





    global $bb_replace_3rd_party;
    global $bb_replacements_3rd_party;


    global $_nodesforum_3rd_party_tag_limits_specific_has_data;
    global $_nodesforum_3rd_party_tag_limits_user_specific;
    global $_nodesforum_3rd_party_tag_limits_user_default;

    global $_nodesforum_3rd_party_tag_limits_user_default;
    global $_nodesforum_3rd_party_tag_limits_guest_default;

    foreach($bb_replace_3rd_party as $key => $value)
    {
        if($exploded_powers[3]==1)
        {$howmany_3rd_party=-1;}
        else if($quoteornot==1)
        {$howmany_3rd_party=0;}
        else if($user_or_guest==1)
        {
            if($_nodesforum_3rd_party_tag_limits_specific_has_data[$key])
            {$howmany_3rd_party=$_nodesforum_3rd_party_tag_limits_user_specific[$key];}
            else
            {$howmany_3rd_party=$_nodesforum_3rd_party_tag_limits_user_default;}
        }
        else
        {
            if($_nodesforum_3rd_party_tag_limits_specific_has_data[$key])
            {$howmany_3rd_party=$_nodesforum_3rd_party_tag_limits_guest_specific[$key];}
            else
            {$howmany_3rd_party=$_nodesforum_3rd_party_tag_limits_guest_default;}
        }
        $string = preg_replace($value, $bb_replacements_3rd_party[$key], $string, $howmany_3rd_party);
    }


    if($exploded_powers[2]!=1)
    {$string = preg_replace($html_replace, $html_replacements, $string);}




    //tables
    $no_more_tables=0;
    $maxtables=100;
    $counttables=0;
    $hasfoundatleast1table=0;

    while($no_more_tables==0)
    {
        $counttables++;
        if($counttables>=$maxtables)
        {
            echo 'max loops busted on loop looking for table tags<br />';
            break;
        }

        if($hasfoundatleast1table==1)
        {$string_to_find_tables_from_the_end=substr($string,0,$posoflasttable);}
        else
        {$string_to_find_tables_from_the_end=$string;}

        $posoflasttable=strripos(' '.$string_to_find_tables_from_the_end,'[table');
        if($posoflasttable)
        {
            $hasfoundatleast1table=1;
            $posoflasttable--;

            $posofclosingbracket=stripos($string,']',$posoflasttable);
            if($posofclosingbracket)
            {
                $posofclosingtag=stripos($string,'[/table]',$posofclosingbracket-1);
                if($posofclosingtag)
                {
                    //we have a good table structure
                    $string_inside_opening_tag=substr($string,$posoflasttable,($posofclosingbracket+1)-$posoflasttable);
                    $lenof_opening_tag=strlen($string_inside_opening_tag);

                    $bg='';
                    $lookfor_bg_attribute=stripos($string_inside_opening_tag,' bg=');
                    if($lookfor_bg_attribute)
                    {
                        $lookforspaceafter=stripos($string_inside_opening_tag,' ',$lookfor_bg_attribute+2);
                        if($lookforspaceafter)
                        {$bg=substr($string_inside_opening_tag,$lookfor_bg_attribute+4,$lookforspaceafter-($lookfor_bg_attribute+4));}
                        else
                        {$bg=substr($string_inside_opening_tag,$lookfor_bg_attribute+4,($lenof_opening_tag-1)-($lookfor_bg_attribute+4));}
                        $bg='background-color:'.$bg.';';
                    }

                    $width='';
                    $lookfor_width_attribute=stripos($string_inside_opening_tag,' width=');
                    if($lookfor_width_attribute)
                    {
                        $lookforspaceafter=stripos($string_inside_opening_tag,' ',$lookfor_width_attribute+2);
                        if($lookforspaceafter)
                        {$width=substr($string_inside_opening_tag,$lookfor_width_attribute+7,$lookforspaceafter-($lookfor_width_attribute+7));}
                        else
                        {$width=substr($string_inside_opening_tag,$lookfor_width_attribute+7,($lenof_opening_tag-1)-($lookfor_width_attribute+7));}
                        $width='width:'.$width.';';
                    }

                    $string_before_table=substr($string,0,$posoflasttable);
                    $string_inside_of_table=substr($string,$posoflasttable+$lenof_opening_tag,$posofclosingtag-($posoflasttable+$lenof_opening_tag));

                    //parse $string_inside_of_table non-recursively for [tr]
                    $nomoretr=0;
                    $maxtr=100;
                    $counttr=0;
                    $trreading_head=0;

                    $rebuilt_string_inside_of_table='';

                    while($nomoretr==0)
                    {
                        $counttr++;
                        if($counttr>=$maxtr)
                        {
                            echo 'max loops busted on loop looking for tr tags inside of a table tag<br />';
                            break;
                        }
                        $first_tr_ontheline=stripos(' '.$string_inside_of_table,'[tr]',$trreading_head);
                        if($first_tr_ontheline)
                        {
                            $first_tr_ontheline--;
                            $trreading_head=$first_tr_ontheline+2;
                            $closing_tr_after_that=stripos($string_inside_of_table,'[/tr]',$trreading_head);
                            if($closing_tr_after_that)
                            {
                                $trreading_head=$closing_tr_after_that+5;
                                //valid tr
                                $string_before_tr=substr($string_inside_of_table,0,$first_tr_ontheline);
                                $string_inside_tr=substr($string_inside_of_table,$first_tr_ontheline+4,$closing_tr_after_that-($first_tr_ontheline+4));


                                //parse $string_inside_tr  non-recursively for [td]
                                $nomoretd=0;
                                $maxtd=100;
                                $counttd=0;
                                $tdreading_head=0;


                                $rebuilt_string_inside_tr='';


                                while($nomoretd==0)
                                {
                                    $counttd++;
                                    if($counttd>=$maxtd)
                                    {
                                        echo 'max loops busted on loop looking for td tags inside of a tr tag<br />';
                                        break;
                                    }
                                    $first_td_ontheline=stripos(' '.$string_inside_tr,'[td',$tdreading_head);
                                    if($first_td_ontheline)
                                    {
                                        $first_td_ontheline--;
                                        $tdreading_head=$first_td_ontheline+2;
                                        $td_tag_closing_bracket=stripos($string_inside_tr,']',$tdreading_head);
                                        if($td_tag_closing_bracket)
                                        {
                                            $td_closing_tag=stripos($string_inside_tr,'[/td]',$td_tag_closing_bracket-1);
                                            if($td_closing_tag)
                                            {
                                                $tdreading_head=$td_closing_tag;
                                                //got good cell

                                                $string_inside_td_opening_tag=substr($string_inside_tr,$first_td_ontheline,($td_tag_closing_bracket+1)-$first_td_ontheline);
                                                $lenof_td_opening_tag=strlen($string_inside_td_opening_tag);


                                                //table cell attributes
                                                $td_bg='';
                                                $td_lookfor_bg_attribute=stripos($string_inside_td_opening_tag,' bg=');
                                                if($td_lookfor_bg_attribute)
                                                {
                                                    $td_lookforspaceafter=stripos($string_inside_td_opening_tag,' ',$td_lookfor_bg_attribute+2);
                                                    if($td_lookforspaceafter)
                                                    {$td_bg=substr($string_inside_td_opening_tag,$td_lookfor_bg_attribute+4,$td_lookforspaceafter-($td_lookfor_bg_attribute+4));}
                                                    else
                                                    {$td_bg=substr($string_inside_td_opening_tag,$td_lookfor_bg_attribute+4,($lenof_td_opening_tag-1)-($td_lookfor_bg_attribute+4));}
                                                    $td_bg='background-color:'.$td_bg.';';
                                                }

                                                $td_width='';
                                                $td_lookfor_width_attribute=stripos($string_inside_td_opening_tag,' width=');
                                                if($td_lookfor_width_attribute)
                                                {
                                                    $td_lookforspaceafter=stripos($string_inside_td_opening_tag,' ',$td_lookfor_width_attribute+2);
                                                    if($td_lookforspaceafter)
                                                    {$td_width=substr($string_inside_td_opening_tag,$td_lookfor_width_attribute+7,$td_lookforspaceafter-($td_lookfor_width_attribute+7));}
                                                    else
                                                    {$td_width=substr($string_inside_td_opening_tag,$td_lookfor_width_attribute+7,($lenof_td_opening_tag-1)-($td_lookfor_width_attribute+7));}
                                                    $td_width='width:'.$td_width.';';
                                                }

                                                $td_colspan='';
                                                $td_lookfor_width_attribute=stripos($string_inside_td_opening_tag,' colspan=');
                                                if($td_lookfor_width_attribute)
                                                {
                                                    $td_lookforspaceafter=stripos($string_inside_td_opening_tag,' ',$td_lookfor_width_attribute+2);
                                                    if($td_lookforspaceafter)
                                                    {$td_colspan=substr($string_inside_td_opening_tag,$td_lookfor_width_attribute+9,$td_lookforspaceafter-($td_lookfor_width_attribute+9));}
                                                    else
                                                    {$td_colspan=substr($string_inside_td_opening_tag,$td_lookfor_width_attribute+9,($lenof_td_opening_tag-1)-($td_lookfor_width_attribute+9));}
                                                    $td_colspan=' colspan="'.$td_colspan.'"';
                                                }

                                                $td_rowspan='';
                                                $td_lookfor_width_attribute=stripos($string_inside_td_opening_tag,' rowspan=');
                                                if($td_lookfor_width_attribute)
                                                {
                                                    $td_lookforspaceafter=stripos($string_inside_td_opening_tag,' ',$td_lookfor_width_attribute+2);
                                                    if($td_lookforspaceafter)
                                                    {$td_rowspan=substr($string_inside_td_opening_tag,$td_lookfor_width_attribute+9,$td_lookforspaceafter-($td_lookfor_width_attribute+9));}
                                                    else
                                                    {$td_rowspan=substr($string_inside_td_opening_tag,$td_lookfor_width_attribute+9,($lenof_td_opening_tag-1)-($td_lookfor_width_attribute+9));}
                                                    $td_rowspan=' rowspan="'.$td_rowspan.'"';
                                                }

                                                $td_valign='';
                                                $td_lookfor_width_attribute=stripos($string_inside_td_opening_tag,' valign=');
                                                if($td_lookfor_width_attribute)
                                                {
                                                    $td_lookforspaceafter=stripos($string_inside_td_opening_tag,' ',$td_lookfor_width_attribute+2);
                                                    if($td_lookforspaceafter)
                                                    {$td_valign=substr($string_inside_td_opening_tag,$td_lookfor_width_attribute+8,$td_lookforspaceafter-($td_lookfor_width_attribute+8));}
                                                    else
                                                    {$td_valign=substr($string_inside_td_opening_tag,$td_lookfor_width_attribute+8,($lenof_td_opening_tag-1)-($td_lookfor_width_attribute+8));}
                                                    $td_valign='vertical-align:'.$td_valign.';';
                                                }


                                                $string_before_td=substr($string_inside_tr,0,$first_td_ontheline);
                                                $string_inside_td=substr($string_inside_tr,$first_td_ontheline+$lenof_td_opening_tag,$td_closing_tag-($first_td_ontheline+$lenof_td_opening_tag));
                                                $string_after_td=substr($string_inside_tr,$td_closing_tag+5);
                                                $string_inside_tr=$string_before_td.'<td style="color:inherit;'.$td_bg.$td_width.$td_valign.'"'.$td_colspan.$td_rowspan.'>'.$string_inside_td.'</td>'.$string_after_td;


                                                $rebuilt_string_inside_tr=$rebuilt_string_inside_tr.'<td style="color:inherit;'.$td_bg.$td_width.$td_valign.'"'.$td_colspan.$td_rowspan.'>'.$string_inside_td.'</td>';

                                            }
                                            else
                                            {$nomoretd=1;}
                                        }
                                        else
                                        {$nomoretd=1;}
                                    }
                                    else
                                    {$nomoretd=1;}
                                }


                                $string_inside_tr=$rebuilt_string_inside_tr;



                                $string_after_tr=substr($string_inside_of_table,$closing_tr_after_that+5);
                                $string_inside_of_table=$string_before_tr.'<tr>'.$string_inside_tr.'</tr>'.$string_after_tr;

                                $rebuilt_string_inside_of_table=$rebuilt_string_inside_of_table.'<tr>'.$string_inside_tr.'</tr>';
                            }
                            else
                            {$nomoretr=1;}
                        }
                        else
                        {$nomoretr=1;}
                    }


                    $string_inside_of_table=$rebuilt_string_inside_of_table;


                    $string_after_table=substr($string,$posofclosingtag+8);

                    $string_before_table=rtrim($string_before_table);
                    if(substr($string_before_table,strlen($string_before_table)-6)=='<br />')
                    {$string_before_table=substr($string_before_table,0,strlen($string_before_table)-6);}
                    $string_after_table=ltrim($string_after_table);
                    if(substr($string_after_table,0,6)=='<br />')
                    {$string_after_table=substr($string_after_table,6);}

                    $string=$string_before_table.'<table style="color:inherit;'.$bg.$width.'">'.$string_inside_of_table.'</table>'.$string_after_table;
                }
                else
                {$no_more_tables=1;}
            }
            else
            {$no_more_tables=1;}
        }
        else
        {$no_more_tables=1;}
    }






    //lists
    $no_more_lists=0;
    $maxturns=100;
    $countturns=0;
    $hasfoundatleast1=0;
    while($no_more_lists==0)
    {
        $countturns++;
        if($countturns>=$maxturns)
        {
            echo 'max loops busted on loop looking for list tags<br />';
            break;
        }

        if($hasfoundatleast1==1)
        {$string_to_find_lists_from_the_end=substr($string,0,$posoflastlist);}
        else
        {$string_to_find_lists_from_the_end=$string;}


        $posoflastlist=strripos(' '.$string_to_find_lists_from_the_end,'[list');
        if($posoflastlist)
        {
            $hasfoundatleast1=1;
            $posoflastlist--;


            $eightcharz_ofjoy=strtolower(substr($string,$posoflastlist,6)).substr($string,$posoflastlist+6,2);
            if($eightcharz_ofjoy=='[list=1]')
            {
                $list_opening='<ol style="list-style-type:decimal;">';
                $list_closing='</ol>';
            }
            else if($eightcharz_ofjoy=='[list=a]')
            {
                $list_opening='<ol style="list-style-type:lower-alpha;">';
                $list_closing='</ol>';
            }
            else if($eightcharz_ofjoy=='[list=A]')
            {
                $list_opening='<ol style="list-style-type:upper-alpha;">';
                $list_closing='</ol>';
            }
            else if($eightcharz_ofjoy=='[list=i]')
            {
                $list_opening='<ol style="list-style-type:lower-roman;">';
                $list_closing='</ol>';
            }
            else if($eightcharz_ofjoy=='[list=I]')
            {
                $list_opening='<ol style="list-style-type:upper-roman;">';
                $list_closing='</ol>';
            }
            else
            {
                $list_opening='<ul>';
                $list_closing='</ul>';
            }



            $enofopening_listtag=stripos($string,']',$posoflastlist);
            $posoffirst_list_closing_after=stripos($string,'[/list]',$enofopening_listtag);
            if($posoffirst_list_closing_after && $enofopening_listtag<($posoflastlist+9))
            {
                $stuff_inside_the_list=substr($string,$enofopening_listtag+1,$posoffirst_list_closing_after-($enofopening_listtag+1));
                $exploded_stuff=explode('[*]',$stuff_inside_the_list);
                $rebuilt_insides='';
                $count_parts=0;
                foreach($exploded_stuff as $key => $value)
                {
                    $count_parts++;
                    if($count_parts>1)
                    {
                        $value=trim($value);
                        $last_6_chars=substr($value,strlen($value)-6);
                        if($last_6_chars=='<br />')
                        {$value=substr($value,0,strlen($value)-6);}
                        $rebuilt_insides=$rebuilt_insides.'<li>'.$value.'</li>';
                    }
                }
                $the_list_in_HTML=$list_opening.$rebuilt_insides.$list_closing;
                $string_before_this_list=substr($string,0,$posoflastlist);
                $string_after_this_list=substr($string,$posoffirst_list_closing_after+7);
                $string=$string_before_this_list.$the_list_in_HTML.$string_after_this_list;
            }
            else
            {$no_more_lists=1;}
        }
        else
        {$no_more_lists=1;}
    }







    //make sure that there at not more </div> than <div ***> tags
    $howmany_opening_divs=preg_match_all('/<div[^>]{0,13}>/',$string,$matches);
    $howmany_closing_divs=preg_match_all('/<\/div>/is',$string,$matches);
    if($howmany_closing_divs>$howmany_opening_divs)
    {
        $howmanymissing=$howmany_closing_divs-$howmany_opening_divs;
        $adder='';
        for ($i=1; $i<=$howmanymissing; $i++)
        {$adder=$adder.'<div>';}
        $string=$adder.$string;
    }




    //apply wordwrap here:
    //$string=wordWrapIgnoreHTML($string);


    //remove all HTML tags from string saving them in an array on the side
    //echo '$string: '.htmlspecialchars($string).'<br />';
    $nomore_HTML=0;
    $count_HTML=0;
    $max_HTML=10000;
    $HTML_reading_head=0;
    while($nomore_HTML==0)
    {
        $count_HTML++;
        //echo 'turn #'.$count_HTML.'<br />';
        if($count_HTML>=$max_HTML)
        {
            echo 'max loops busted on loop looking for HMTL to remove before utf8 wordwrap<br />';
            break;
        }
        $find_first_HTML=stripos($string,'<',$HTML_reading_head);
        if($find_first_HTML!==false)
        {
            //echo 'found HTML opener at char '.$find_first_HTML.'<br />';
            $HTML_reading_head=$find_first_HTML+3;

            $find_HTML_close_after_that=stripos($string,'>',$find_first_HTML);
            if($find_HTML_close_after_that!==false)
            {
                //echo 'found HTML closer at char '.$find_HTML_close_after_that.'<br />';
                $HTML_contents_ont_the_side[$count_HTML]=substr($string,$find_first_HTML+1,$find_HTML_close_after_that-($find_first_HTML+1));
                //echo '$HTML_contents_ont_the_side['.$count_HTML.']: '.$HTML_contents_ont_the_side[$count_HTML].'<br />';
                $string_before_code=substr($string,0,$find_first_HTML);
                //echo '$string_before_code: '.htmlspecialchars($string_before_code).'<br />';
                $string_after_code=substr($string,$find_HTML_close_after_that+1);
                //echo '$string_after_code: '.htmlspecialchars($string_after_code).'<br />';
                //echo '$count_HTML: '.$count_HTML.'<br />';
                $string=$string_before_code.'< :'.$count_HTML.': >'.$string_after_code;
            }
            else
            {$nomore_HTML=1;}
        }
        else
        {$nomore_HTML=1;}
    }
    //echo '$string: '.htmlspecialchars($string).'<br />';

    

    
    //apply utf8 word wrap on the string
    $string=unicode_wordwrap($string,$_nodesforum_max_word_length_in_posts);


    


    //put HTML tags back
    //echo '$string: '.htmlspecialchars($string).'<br />';
    $no_more_HTML=0;
    $count_HTML=0;
    $max_HTML=10000;
    $HTML_reading_head=0;
    while($no_more_HTML==0)
    {
        $count_HTML++;
        if($count_HTML>=$max_HTML)
        {
            echo 'max loops busted on trying to put HTML back in<br />';
            break;
        }

        $find_first_HTML=stripos($string,'< :',$HTML_reading_head);
        if($find_first_HTML!==false)
        {
            //echo 'found first HTML at pos '.$find_first_HTML.'<br />';
            $HTML_reading_head=$find_first_HTML+1;

            $find_first_HTML_closer_after_that=stripos($string,': >',$find_first_HTML);
            if($find_first_HTML_closer_after_that!==false)
            {
                //echo 'found closer after that at pos '.$find_first_HTML_closer_after_that.'<br />';

                $string_inside_of_HTML=substr($string,$find_first_HTML+3,$find_first_HTML_closer_after_that-($find_first_HTML+3));
                //echo '$string_inside_of_HTML: '.$string_inside_of_HTML.'<br />';

                $string_before_tags=substr($string,0,$find_first_HTML);
                $string_after_tags=substr($string,$find_first_HTML_closer_after_that+3);
                $string=$string_before_tags.'<'.$HTML_contents_ont_the_side[$string_inside_of_HTML].'>'.$string_after_tags;
            }
            else
            {$no_more_HTML=1;}
        }
        else
        {$no_more_HTML=1;}
    }
    //echo '$string: '.htmlspecialchars($string).'<br />';







    //build code tags here:
    // $no_more_code_tags=0;
    // $count_tags=0;
    // $max_tags=100;
    // $reading_head=0;
    // while($no_more_code_tags==0)
    // {
    //     $count_tags++;
    //     if($count_tags>=$max_tags)
    //     {
    //         echo 'max loops busted on loop looking for code tags to rebuild<br />';
    //         break;
    //     }

    //     $find_first_code_tag=stripos(' '.$string,'[code]',$reading_head);
    //     if($find_first_code_tag)
    //     {

    //         $reading_head=$find_first_code_tag+2;
    //         $find_first_code_tag=$find_first_code_tag-1;

    //         $find_first_closing_tag_after_that=stripos($string,'[/code]',$find_first_code_tag);
    //         if($find_first_closing_tag_after_that)
    //         {

    //             $string_inside_of_tags=substr($string,$find_first_code_tag+6,$find_first_closing_tag_after_that-($find_first_code_tag+6));


    //             $string_before_tags=substr($string,0,$find_first_code_tag);
    //             $string_after_tags=substr($string,$find_first_closing_tag_after_that+7);
    //             $random_number=rand(1111111111,9999999999).rand(1111111111,9999999999).rand(1111111111,9999999999).rand(1111111111,9999999999).rand(1111111111,9999999999);
    //             $string=$string_before_tags.'<div style="width:100%;"><div style="font-size:12px;text-align:left;padding-left:2em;padding-right:2em;">code:</div><div style="width:100%;overflow:auto;overflow-x:auto;overflow-y:visible;"><table class="class_nodesforum_bgcolor3" style="width:100%;"><tr><td class="class_nodesforum_bgcolor2"><div class="class_nodesforum_inner"><pre style="padding:4px;margin:0px;" id="pre_'.$random_number.'">'.$code_tag_contents_ont_the_side[$string_inside_of_tags].'</pre><br /></div></td></tr></table></div><div style="text-align:right;font-size:12px;padding-left:2em;padding-right:2em;"><a onclick="selectcode('."'pre_".$random_number."'".')" style="cursor:pointer;">select</a></div></div>'.$string_after_tags;
    //         }
    //         else
    //         {$no_more_code_tags=1;}
    //     }
    //     else
    //     {$no_more_code_tags=1;}
    // }


    // 3. Restore code blocks
    $string = preg_replace_callback(
        '/\[\[CODE_BLOCK_(\d+)\]\]/',
        function($matches) use ($code_blocks) {
            $key = $matches[1];
            $random_number = rand(1111111111,9999999999).rand(1111111111,9999999999);
            return '<div style="width:100%;"><div style="font-size:12px;text-align:left;padding-left:2em;padding-right:2em;">code:</div><div style="width:100%;overflow:auto;overflow-x:auto;overflow-y:visible;"><table class="class_nodesforum_bgcolor3" style="width:100%;"><tr><td class="class_nodesforum_bgcolor2"><div class="class_nodesforum_inner"><pre style="padding:4px;margin:0px;" id="pre_'.$random_number.'">'.$code_blocks[$key].'</pre><br /></div></td></tr></table></div><div style="text-align:right;font-size:12px;padding-left:2em;padding-right:2em;"><a onclick="selectcode(\'pre_'.$random_number.'\')" style="cursor:pointer;">select</a></div></div>';
        },
        $string
    );



    //build quotes
    $no_more_quote_tags=0;
    $count_tags=0;
    $max_tags=100;
    $reading_head=0;
    while($no_more_quote_tags==0)
    {
        $count_tags++;
        if($count_tags>=$max_tags)
        {
            echo 'max loops busted on loop looking for quote tags to rebuild<br />';
            break;
        }


        $find_first_quote_tag=stripos(' '.$string,'[quote]',$reading_head);
        if($find_first_quote_tag)
        {

            $reading_head=$find_first_quote_tag+2;
            $find_first_quote_tag=$find_first_quote_tag-1;

            $find_first_closing_tag_after_that=stripos($string,'[/quote]',$find_first_quote_tag);
            if($find_first_closing_tag_after_that)
            {

                $string_inside_of_tags=substr($string,$find_first_quote_tag+7,$find_first_closing_tag_after_that-($find_first_quote_tag+7));

                $string_before_tags=substr($string,0,$find_first_quote_tag);
                $string_after_tags=substr($string,$find_first_closing_tag_after_that+8);


                $source_string='';
                if($quote_sources[$string_inside_of_tags] && $quote_sources[$string_inside_of_tags]!='')
                {$source_string='<div style="text-align:right;font-size:75%;">source: '.unicode_wordwrap($quote_sources[$string_inside_of_tags],$_nodesforum_max_word_length_in_posts).'</div>';}


                $caption_string='quote';
                global $_nodesforum_uniqueID_of_deleted_user;
                if($quote_postID[$string_inside_of_tags] && $quote_postID[$string_inside_of_tags]!='')
                {
                    global $_nodesforum_max_word_length_in_titles;
                    if($quote_userID[$string_inside_of_tags]=='0')
                    {$sho_posterz_link='<i>a guest</i>';}
                    else if($quote_userID[$string_inside_of_tags]==$_nodesforum_uniqueID_of_deleted_user)
                    {$sho_posterz_link='<i>deleted user</i>';}
                    else
                    {$sho_posterz_link='<a href="?_nodesforum_node=u'.$quote_userID[$string_inside_of_tags].'" rel="nofollow">'._nodesforum_display_title($quote_publicname[$string_inside_of_tags],$_nodesforum_max_word_length_in_titles).'</a>';}
                    $caption_string='quote from '.$sho_posterz_link.' on <a href="?_nodesforum_permalink='.$quote_postID[$string_inside_of_tags].'#_nodesforum_anchor_'.$quote_postID[$string_inside_of_tags].'">post #'.$quote_postID[$string_inside_of_tags].'</a><script type="text/javascript">
				var quotetime = _nodesforum_maketimus('.$quote_time[$string_inside_of_tags].');
				var putstring = "<br />quoted on " + quotetime;
				document.write(putstring);
</script>';
                }


                $string=$string_before_tags.'<blockquote style="margin:0px;"><table class="class_nodesforum_bgcolorinherit"><tr><td><table class="class_nodesforum_bgcolor3"><caption style="text-align:left;font-size:75%;">'.$caption_string.'</caption><tr><td class="class_nodesforum_bgcolor2"><div class="class_nodesforum_inner">'.display_bb($quote_texts[$string_inside_of_tags],0,0,1,1,1).'</div></td></tr></table>'.$source_string.'</td></tr></table></blockquote>'.$string_after_tags;
            }
            else
            {$no_more_quote_tags=1;}
        }
        else
        {$no_more_quote_tags=1;}
    }





    if($exploded_powers[2]==1)
    {
        //put code back in html tags
        $no_more_html_tags=0;
        $count_tags=0;
        $max_tags=100;
        $reading_head=0;
        while($no_more_html_tags==0)
        {
            $count_tags++;
            if($count_tags>=$max_tags)
            {
                echo 'max loops busted on loop looking for quote tags to rebuild<br />';
                break;
            }

            $find_first_html_tag=stripos(' '.$string,'[html]',$reading_head);
            if($find_first_html_tag)
            {

                $reading_head=$find_first_html_tag+2;
                $find_first_html_tag=$find_first_html_tag-1;

                $find_first_closing_tag_after_that=stripos($string,'[/html]',$find_first_html_tag);
                if($find_first_closing_tag_after_that)
                {

                    $string_inside_of_tags=substr($string,$find_first_html_tag+6,$find_first_closing_tag_after_that-($find_first_html_tag+6));


                    $string_before_tags=substr($string,0,$find_first_html_tag);
                    $string_after_tags=substr($string,$find_first_closing_tag_after_that+7);
                    $string=$string_before_tags.$code_on_the_side[$string_inside_of_tags].$string_after_tags;
                }
                else
                {$no_more_html_tags=1;}
            }
            else
            {$no_more_html_tags=1;}
        }
    }

    //$string=str_replace('&amp;','&amp;amp;',$string);

    return $string;
}



?>
