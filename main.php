<?php

$sAdmin = getSettings();

$path_info = parse_path();

switch($path_info['call_parts'][0]) {
  case '': 
  	$content = 'home.php';
    break;
  default:
    $content = $path_info['call_parts'][0].'.php';
    break;
}

include $content;

?>