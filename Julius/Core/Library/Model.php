<?php
/**
 * 模型基础类
 *
 * @author      Jianghao <geekbaba.j@gmail.com>
 * @date 2013-11-28 下午9:00:00
 * @version 1.0.0
 * @copyright  Copyright 2012 Joincoding Technolcgies Co.,Ltd.
 */
namespace Julius\Core\Library;
use \ReflectionMethod;
use Julius\Core\JObject;
use Julius\Core\Model\Mysql;
class Model extends JObject{
	private $Entity = null;
	
	/**
	 * 构建基础模型类
	 * 初始化设置一个反射的实体
	 * 
	 * @date 2014-4-1下午6:03:13
	 * @version 1.0.0
	 */
	public function __construct($model='Mysql'){
		switch($model){
			case 'Mysql' : $this->Entity = new Mysql();break;
			case 'Redis' : $this->Entity = new Redis();break;
			
			//模块不能随意添加
			default: throw new BaseException("No Such Model Named:{$model}");
		}
	}
	
	/**
	 * 反射方法调用不同Model类的方法
	 *
	 */
	public function __call($method, $args){
		$Reflection = new ReflectionMethod($this->Entity,$method);
		return $Reflection->invokeArgs($this->Entity,$args);
	}
}