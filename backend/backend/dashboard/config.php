<?php
$db_host	    = 'localhost';
$db_user        = 'euroserv_db';
$db_password	= 'euroserv_db';
$db_name	    = 'euroserv_db';
if (!defined('APP_URL')) {
    define('APP_URL', 'http://euroservee.com/backend/dashboard');
}
if (!defined('PASS_SALT')) {
define('PASS_SALT','8kit={xe');
}
$_app_stage = 'Live'; // You can set this variable Live to enable DEPRIXA -  Integrated Web system Debug