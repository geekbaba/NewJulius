<?php
define('JULIUS_PATH','../Julius/');
define('JULIUS_PPATH', '../');//用作命名空间来自动加载
define('APP_PATH', './');
define('APP_VERSION', '1.0.0');
define('ALL_IN_ONE', '~index.php');
define('NO_COMPILE', false);
define('ROUTE_MODE',3);
require JULIUS_PATH.'Julius.php';

use Julius\Julius;

try {
		Julius::init();
		
	} catch (Exception $e) {
	file_put_contents('xdata.log',print_r($e->getMessage(),true));
}