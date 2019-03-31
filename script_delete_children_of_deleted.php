<?php
//if(isset($argv[0])){
	//include('config.php');
	//include('pre_output.php');
//}

_nodesforum_db_conn();

$query="SELECT fapID, ancestry FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts WHERE deletion_time = 0";
echo $query."<br>";
$result = mysql_query($query);
while($row = mysql_fetch_array($result)){
	echo '#'.$row['fapID'].', ancestry: '.$row['ancestry'].'<br>';
	$explode_ancestry=explode('|',$row['ancestry']);
	$query2="SELECT fapID, deletion_time FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts WHERE fapID = IN(".implode(',',$explode_ancestry).") && deletion_time != 0 order by deletion_time";
	echo $query2."<br>";
	$result2 = mysql_query($query2);
	while($row2 = mysql_fetch_array($result2)){
		echo '#'.$row['fapID'].' has deleted parent #'.$row2['fapID'].' (deletion time: '.$row2['deletion_time'].')<br>';
	}
}
