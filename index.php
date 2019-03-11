<?php
include('config.php');
if($_nodesforum_use_external_user_system=='yes')
{session_start();}
$_nodesforum_code_path='';
$_nodesforum_show_login_logout_bar='yes';
include('pre_output.php');
?>
<html>
<head>
<title><?php echo $_nodesforum_title; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
<?php include('body.php'); ?>
</body>
</html>
