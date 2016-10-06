<?php

################## Session Config ##################
session_start();
################## Session Config ##################

################## Define ##################
define('SITE_ROOT', dirname(dirname(__FILE__)));
################## Define ##################

################## Time Config ##################
date_default_timezone_set('Asia/Tehran');
################## Time Config ##################

################## Uri Setting ##################
if(!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS']))
{
    $uri = 'https://' . $_SERVER['HTTP_HOST'];
}
else
{
    $uri = 'http://' . $_SERVER['HTTP_HOST'];
}
$uri = $uri . '/ehda';
$_SESSION['uri'] = $uri;
################## Uri Setting ##################

################## Database Handler ##################
define('DB_PERSISTENCY', 'true');
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'list');
define('PDO_DSN', 'mysql:host=' . DB_SERVER . ';dbname=' . DB_DATABASE . ';charset=utf8;SET CHARACTER SET utf8');
################## Database Handler ##################

################## Include utility files ##################
require_once 'database_handler.php';
require_once 'aPdate.php';
################## Include utility files ##################

?>