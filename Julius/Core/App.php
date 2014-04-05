<?php
/**
 * App运行类
 *
 * @author      Jianghao <geekbaba.j@gmail.com>
 * @date 2013-11-27 下午9:18:56
 * @version 1.0.0
 * @copyright  Copyright 2012 Joincoding Technolcgies Co.,Ltd.
 */
namespace Julius\Core;
use Julius\Common\RouteType;
use Julius\Exception\JErrorException;
final class App{
	
	public static function run(){
		set_error_handler('Julius\Core\App::error_handler',E_ALL);
		
		if(!defined('ROUTE_MODE')){
			define('ROUTE_MODE', RouteType::ROUTETING_MODE);
		}
		$dispatcher = new Dispatcher();
		
	}
	
	public static function error_handler($errno, $errstr, $errfile, $errline){
		throw new JErrorException($errstr,$errno);
	}
	
	public static function addIncludePath($path){
		set_include_path(get_include_path() . PATH_SEPARATOR . $path);
	}
}
