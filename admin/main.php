<?php

if (isset($_SESSION['expired_admin']) && time() > $_SESSION['expired_admin']) {
    unset($_SESSION['admin']);
    unset($_SESSION['expired_admin']);
}

$sAdmin = getSettings();

$path_info = parse_path();

switch($path_info['call_parts'][0]) {
  case '': 
  	$content = (!isAdmin()) ? 'login.php' : 'home.php';
    break;
  default:
    $content = (!isAdmin()) ? 'login.php' : $path_info['call_parts'][0].'.php';
    break;
}

include $content;

?>