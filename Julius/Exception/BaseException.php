<?php
/**
 * BaseException
 *
 * @author      Jianghao <geekbaba.j@gmail.com>
 * @date 2013-11-26 下午8:05:34
 * @version 1.0.0
 * @copyright  Copyright 2012 Joincoding Technolcgies Co.,Ltd.
 */
namespace Julius\Exception;
use \Exception;
class BaseException extends Exception{
	
	/**
	 * 基础支持
	 * 
	 * @param string	[require]	$message
	 * @param string	[optional]	$code
	 * @param Exception	[optional] 	$previous
	 * @return BaseException
	 * @date 2013-11-26下午8:06:06 
	 * @version 1.0.0
	 */
	public function __construct($message,$code=null,$previous=null){

		 parent::__construct($message,$code,$previous);
	}
}