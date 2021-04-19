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

function isUser() {
  global $db;
  $isUser = false;
  
  if(isset($_COOKIE['biddest_email'])) {
    $query="SELECT * FROM `users` WHERE `email` = '".$_COOKIE['biddest_email']."' AND `pass` = '".$_COOKIE['biddest_pass']."'";
  } else if(isset($_SESSION['email'])) {
    $query="SELECT * FROM `users` WHERE `email` = '".$_SESSION['email']."' AND `pass` = '".$_SESSION['pass']."'";
  } else {
    return false;
  }
  
  if(!$result = $db->query($query)){
    die('There was an error running the query [' . $db->error . ']');
  }
  
  if($result->num_rows > 0) { 
    $isUser = true; 
    while($row = $result->fetch_assoc()){
      $_SESSION['user'] = $row;
    }
    $result->free();
  }

  return $isUser;
}

function isAdmin() {
  if (!isUser()) {
    return false;
  } else {
    if (!isset($_SESSION['admin'])) {
      return false;
    } else {
      return true;
    } 
  }
}

function checkUser($value) {
  global $db;
  $isUser = false;
  
  $query="SELECT * FROM `users` WHERE `email` = '".$value."' ";
  
  if(!$result = $db->query($query)){
    die('There was an error running the query [' . $db->error . ']');
  }
  
  if($result->num_rows > 0) { 
    $isUser = true; 
    while($row = $result->fetch_assoc()){
      $_SESSION['user'] = $row;
    }
    $result->free();
  }

  return $isUser;
}

function signup($vals) {
  $user = array();

  if(isset($vals['email'])) {
    $table = 'users';
    $where = "WHERE `email` = '".$vals['email']."'";
    $user = selectTable($table, $where);
  } else {
    return false;
  }

  if(!empty($user)) {
    return false;
  } else {
    return insertTable($table, $vals);
  }
}

function login($vals) {
  $user = array();

  if(isset($vals['email'])) {
    $table = 'users';
    if (isset($vals['admin'])) {
      $where = "WHERE `email` = '".$vals['email']."' AND `pass` = '".$vals['pass']."' AND `admin` = '1'";
    } else {
      $where = "WHERE `email` = '".$vals['email']."' AND `pass` = '".$vals['pass']."'";
    }
    $user = selectTable($table, $where);
  } else {
    return false;
  }

  if(empty($user)) {
    return false;
  } else {
    return getUser($vals['email']);
  }
}

function getUser($value) {
  global $db;
  $table = 'users';
  $where = "WHERE `email` = '$value' OR `id` = '$value' OR `tokens` = '$value'";
  $user = selectTable($table, $where);
  return $user[0];
}

function getUsers() {
  global $db;
  $users = selectTable('users', '');
  $i = 0;
  foreach ($users as $user) {
    $users[$i]['full-name'] = $user['fname'].' '.$user['lname'];
    $users[$i]['uname'] = '<img class="avatar" src="../pics/avatar'.$user['avatar'].'.png" /> '.$user['name'];
    $users[$i]['country'] = getIdName($user['country'], 'country');
    $users[$i]['gender'] = getIdName($user['gender'], 'gender');
    $users[$i]['age'] = date("Y")- date('Y', $user['birth_date']);
    $users[$i]['adminhtml'] = ($user['admin'] == 1) ? '<i class="fa fa-thumbs-up" aria-hidden="true"></i>' : '<i class="fa fa-thumbs-down" aria-hidden="true"></i>';
    $i++;
  }
  return $users;
}

function getSettings() {
  global $db;
  $table = 'cpanel';
  $where = "WHERE `id` = '1'";
  $admin = selectTable($table, $where);
  return $admin[0];
}

function getEmails() {
  $table = 'users';
  $where = "";
  $users = selectTable($table, $where);
  $emails = array();
  foreach ($users as $user) {
    $emails[] = md5($user['email']);
  }
  return $emails;
}

function getAllProducts() {
  $table = 'products';
  $where = "ORDER BY `start_time` DESC ";
  $products = selectTable($table, $where);
  $i = 0;
  foreach ($products as $product) {
    if($product['user_id'] != 0) {
      $user = getUser($product['user_id']);
      $products[$i]['uname'] = '<img class="avatar" src="../pics/avatar'.$user['avatar'].'.png" /> '.$user['name'];
    } else {
      $products[$i]['uname'] = '';
    }
    $products[$i]['status'] = ($product['current'] != 0) ? 'Opened' : 'Closed';  
    $products[$i]['start_time'] = date('d-m-Y g:i a', $product['start_time']);
    $products[$i]['end_time'] = ($product['current'] != 0) ? '' : date('d-m-Y g:i a', $product['end_time']);
    $i++;
  }
  
  return $products;
}

function getProduct($product_id) {
  $table = 'products';
  $where = "WHERE `id` = '$product_id'";
  $product = selectTable($table, $where);
  return $product[0];
}

function getSlide($slide_id) {
  $table = 'slide';
  $where = "WHERE `id` = '$slide_id'";
  $slide = selectTable($table, $where);
  return $slide[0];
}

?>