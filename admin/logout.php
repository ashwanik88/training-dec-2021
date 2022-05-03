<?php 
require_once('includes/startup.php');

unset($_SESSION['admin_user']);

setcookie('username', $username, time() - 60*60*24*30);
setcookie('password', $md5_password, time() - 60*60*24*30);

redirect('index.php');