<?php

function parse_path() {
  $path = array();
  if (isset($_SERVER['REQUEST_URI'])) {
    $request_path = explode('?', $_SERVER['REQUEST_URI']);

    $path['base'] = rtrim(dirname($_SERVER['SCRIPT_NAME']), '\/');
    $path['call_utf8'] = substr(urldecode($request_path[0]), strlen($path['base']) + 1);
    $path['call'] = utf8_decode($path['call_utf8']);
    if ($path['call'] == basename($_SERVER['PHP_SELF'])) {
      $path['call'] = '';
    }
    $path['call_parts'] = explode('/', $path['call']);

    $path['query_utf8'] = (isset($request_path[1])) ? urldecode($request_path[1]) : '';
    $path['query'] = (isset($request_path[1])) ? utf8_decode(urldecode($request_path[1])) : '';
    $vars = explode('&', $path['query']);
    foreach ($vars as $var) {
      $t = explode('=', $var);
      $path['query_vars'][$t[0]] = (isset($t[1])) ? $t[1] : '';
    }
  }
  return $path;
}

function array_map_callback($a) {
  global $db;
  return $db->escape_string($a);
}

function insertTable($table, $fields) {
  global $db;
  $columns = "`".implode("`,`",array_keys($fields))."`";
  $escaped_values = array_map('array_map_callback', array_values($fields));
  $values  = "'".implode("','", $escaped_values)."'";
  $query = "INSERT INTO `$table` ($columns) VALUES ($values)";
  if($db->query($query)) {
    return $db->insert_id;
  } else {
    return false;
  }
}

function updateTable($table, $fields, $where) {
  global $db;
  $columns = array_keys($fields);
  $values = array_map('array_map_callback', array_values($fields));
  $array = array();
  for($i=0;$i < count($columns); $i++){
      $array[] = "`".$columns[$i]."` = '".$values[$i]."'";
  }
  $update = implode(",", $array);

  $query = "UPDATE `$table` SET $update $where ";
  if($db->query($query)) {
    return true;
  } else {
    return false;
  }
}

function selectTable($table, $where) {
  global $db;
  $sArray = array();
  $query="SELECT * FROM `$table` $where ";
  if(!$result = $db->query($query)){
    die('There was an error running the query [' . $db->error . ']');
  } 
  while($row = $result->fetch_assoc()){
    $sArray[] = $row;
  }
  $result->free();
  return $sArray;
}

function deleteTable($table, $where) {
  global $db;
  $query="DELETE FROM `$table` $where ";
  if(!$result = $db->query($query)){
    die('There was an error running the query [' . $db->error . ']');
  } else {
    return true;
  }
}

function getRow($id, $table) {
  $where = "WHERE `id` = '$id'";
  $result = selectTable($table, $where);
  return $result[0];
}

function getIdName($id, $table) {
  $where = "WHERE `id` = '$id' ";
  $result = selectTable($table, $where);
  return $result[0]['name'];
}

function login($vals) {
  $row = array();
  $table = 'cpanel';
  $where = "WHERE `email` = '".$vals['email']."' AND `pass` = '".$vals['pass']."'";
  $row = selectTable($table, $where);

  if(empty($row)) {
    return false;
  } else {
    return true;
  }
}

function isAdmin() {
  if (!isset($_SESSION['admin'])) {
    return false;
  } else {
    return true;
  } 
}


function getSettings() {
  global $db;
  $table = 'cpanel';
  $where = "WHERE `id` = '1'";
  $admin = selectTable($table, $where);
  return $admin[0];
}

?>