<?php
include('config.php');
if($_nodesforum_use_external_user_system=='yes')
{session_start();}
$_nodesforum_code_path='';
$_nodesforum_show_login_logout_bar='yes';
include('pre_output.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title><?php echo $_nodesforum_title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>
<body>
    <?php include('body.php'); ?>
</body>
</html>
