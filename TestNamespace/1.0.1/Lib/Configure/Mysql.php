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
class Configure_Mysql extends JObject{
	
	//MYSQL 主机设置
	public $HOST = '127.0.0.1';
	//MYSQL 端口设置
	public $PORT = '3306';
	//MYSQL 用户名
	public $USER ='root';
	//MYSQL 密码设置
	public $PASSWORD = '000000';
	//MYSQL 数据名	
	public $DBNAME = 'testa';
	//MYSQL 字符设置
	public $CHARSET = 'utf8';
	//MySQL 链接方式(驱动方式)
	public $DRIVERTYPE = 'PDO';
	
}