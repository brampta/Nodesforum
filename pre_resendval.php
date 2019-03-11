<?php


$_nodesforum_resendval_img_ver_invalid=0;
$_nodesforum_resendval_suxxess=0;
$error=0;

$addslashed_uniqueID=_nodesforum_my_custom_addslashes($_POST['_nodesforum_remember_uniqueID']);
$addslashed_email=_nodesforum_my_custom_addslashes($_POST['_nodesforum_remember_email']);

$_nodesforum_remember_uniqueID=$_POST['_nodesforum_remember_uniqueID'];
if($_nodesforum_image_verification_on_resend_validation_mail=='yes')
{
	if(md5($_POST['_nodesforum_numbax'])!=$_SESSION['img_ver_resendval'])
	{$error=1; $_nodesforum_resendval_img_ver_invalid=1;}
	unset($_SESSION['img_ver_resendval']);
}
if($error==0)
{
	$result = mysql_query("SELECT public_name, validation_key FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_users WHERE uniqueID = '$addslashed_uniqueID' && email = AES_ENCRYPT('$addslashed_email','$addslashed_email')");
	while($row = mysql_fetch_array($result))
	{
		$this_public_name=$row['public_name'];
		$this_validation_key=$row['validation_key'];
	}
	$to=$_POST['_nodesforum_remember_email'];
	$subject=$_nodesforum_forum_name.' email validification';
	$message='Hi '.$this_public_name.' and thank you for registering to'.$_nodesforum_forum_name_the_or_not.' '.$_nodesforum_forum_name.'. Please validate your email address by clicking the following link:
	'.$_nodesforum_instance_asolute_URL.'?_nodesforum_val=shiz&u='.$_POST['_nodesforum_remember_uniqueID'].'&key='.$this_validation_key.'&em='.urlencode($_POST['_nodesforum_remember_email']).'


	'.$_nodesforum_forum_name.'
	'.$_nodesforum_instance_asolute_URL.'
	
	
	
	';
	$headers = "From: ".$_nodesforum_validate_email_address_from;
	mail($to,$subject,$message,$headers);
	$_nodesforum_resendval_suxxess=1;
}

?>
