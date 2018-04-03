<?php 

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
ini_set('error_log', dirname(__FILE__) . '/error_log.txt');

date_default_timezone_set('Asia/Shanghai');

define('BOT_API_TOKEN', getenv('BOT_API_TOKEN'));
define('MASTER_NAME', getenv('MASTER_NAME'));
define('MASTER_USER_ID', getenv('MASTER_USER_ID'));
define('CHANNAL_ID', getenv('CHANNAL_ID'));