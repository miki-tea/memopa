<?php

// Error ini
ini_set('log_errors','on');
ini_set('error_log','php.log');
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Session ini
session_save_path("/var/tmp/");
ini_set('session.gc_maxlifetime', 60*60*24*30); //30日間
ini_set('session.cookie_lifetime ', 60*60*24*30);
session_start();

// DB ini
define('DSN', 'mysql:host=localhost;dbname=memopa');
define('DB_USERNAME', 'dbuser');
define('DB_PASSWORD', 'nowak2020');

// locale
define('SITE_URL', 'http://' . $_SERVER['HTTP_HOST']);

// load Files
require_once(__DIR__ . '/../lib/functions.php');
require_once(__DIR__ . '/autoload.php');


// Debug
$debug_flg = true;

function debug($str){
  global $debug_flg;
  if(!empty($debug_flg)){
    error_log('DEBUG：'.$str);
  }
}

