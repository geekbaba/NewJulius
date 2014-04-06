<?php
/**
 * Mysql配置
 *
 * @author      Jianghao <geekbaba.j@gmail.com>
 * @date 2014-4-2 下午2:58:46
 * @version 1.0.0
 * @copyright  Copyright 2012 Joincoding Technolcgies Co.,Ltd.
 */
use Julius\Core\JObject;
class Configure_Redis extends JObject{
	
	//Redis 主机设置
	public $HOST = '127.0.0.1';
	//Redis 端口设置
	public $PORT = '6379';
	//Redis 密码设置
	public $AUTH = '123456';
	//Redis 数据名	
	public $INDEX = 0;
	
}