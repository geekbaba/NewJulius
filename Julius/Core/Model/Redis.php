<?php
/**
 * RedisModel
 *
 * @author      Jianghao <geekbaba.j@gmail.com>
 * @date 2013-11-28 下午9:00:00
 * @version 1.0.0
 * @copyright  Copyright 2012 Joincoding Technolcgies Co.,Ltd.
 */
namespace Julius\Core\Model;
use Julius\Core\JObject;
use Julius\Exception\BaseException;
class Redis extends JObject{
	
	
	public function __construct(){
		
		$config = $this->getConfig();
		
		var_dump($config);
	}
	


	/**
	 * 获取配置
	 * 当你需要使用多个主机配置的时候你可以在你的Model类里重写getConfig
	 * @return array
	 * @date 2014-4-2上午10:47:45
	 * @version 1.0.0
	 */
	protected function getConfig(){
		if(!class_exists('Configure_Redis')){
			throw new BaseException("Configure_Redis Not Found!");
		}
		return new Configure_Redis();
	}
}