<?php
session_start();

defined('DB_SERVER') ? null : define("DB_SERVER", "");
defined('DB_USER')   ? null : define("DB_USER", "root");
defined('DB_PASS')   ? null : define("DB_PASS", "mc050215");
defined('DB_NAME')   ? null : define("DB_NAME", "ethraa");

$db = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

$db->set_charset("utf8");

?>