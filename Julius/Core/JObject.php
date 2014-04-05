<?php
/**
 * JObject 是所有项目核心文件的父类
 *
 * @author      Jianghao <geekbaba.j@gmail.com>
 * @date 2013-11-27 上午9:38:16
 * @version 1.0.0
 * @copyright  Copyright 2012 Joincoding Technolcgies Co.,Ltd.
 */
namespace Julius\Core;
use Julius\Exception\BaseException;

class JObject{
	
	/**
	 * 公共构造方法
	 * 
	 * @return JObject
	 * @date 2013-11-27上午9:39:00
	 * @version 1.0.0
	 */
	public function __construct(){
		;
	}
	
	/**
	 * 调用一个不存在的方法抛出异常
	 * 
	 * @return Exception
	 * @date 2013-11-28下午3:02:09
	 * @version 1.0.0
	 */
	public function __call($method,$args) {
		throw new BaseException("No such a method:{$method}");
	}
	
	/**
	 * 公共析构方法
	 * 
	 * @return void
	 * @date 2013-11-27上午9:40:13
	 * @version 1.0.0
	 */
	public  function __destruct(){
		
		global $classlist;
		
		$parents_class = class_parents($this);
		
		$classlist[get_class($this)]=true;
		
		$classlist = array_merge($classlist,$parents_class);
	}
}