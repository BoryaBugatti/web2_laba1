<?php
session_start();
$_SESSION['user_email'] = null;
$_SESSION['user_role'] = null;
$_SESSION['user_name'] = null;
$_SESSION['is_authorizated'] = null;
header("Location: index.php");
exit();