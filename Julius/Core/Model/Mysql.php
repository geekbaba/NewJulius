<?php
/**
 * Mysql Model 类
 *
 * @author      Jianghao <geekbaba.j@gmail.com>
 * @date 2013-11-28 下午9:00:00
 * @version 1.0.0
 * @copyright  Copyright 2012 Joincoding Technolcgies Co.,Ltd.
 */
namespace Julius\Core\Model;
use Julius\Core\JObject;
use Julius\Exception\BaseException;
use Julius\Vendor\Mysql\MysqlPDO;
use \Configure_Mysql;
class Mysql extends JObject{
	
	/**
	 * 数据池连接
	 */
	protected static $connectionpool = array();
	
	/**
	 * 当前对象链接 
	 */
	private $connection = null;
	
	public function __construct(){
		
		$config = $this->getConfig();
		
		$key = md5($config->HOST.$config->PORT.$config->USER.$config->DBNAME);
		if(!isset(self::$connectionpool[$key])){
			switch ($config->DRIVERTYPE) {
				case 'PDO':
					$dsn = "mysql:dbname={$config->DBNAME};port={$config->PORT};host={$config->HOST}";
					self::$connectionpool[$key] = new MysqlPDO($dsn, $config->USER, $config->PASSWORD, array()) ;
				;
				break;
				
				default:
					;
				break;
			}
		}
		
		$this->connection = self::$connectionpool[$key];
	}
	
	
	/**
	 * 获取配置
	 * 当你需要使用多个主机配置的时候你可以在你的Model类里重写getConfig 
	 * return不同的配置文件类就可以了
	 * @return array
	 * @date 2014-4-2上午10:47:45
	 * @version 1.0.0
	 */
	protected function getConfig(){
		if(!class_exists('Configure_Mysql')){
			throw new BaseException("Configure_Mysql Not Found!");
		}
		return new Configure_Mysql();
	}
	
	public function getRow($sql,$params){
		return $this->connection->getRow($sql,$params);
	}
	
	public function getRows($sql,$params){
		return $this->connection->getRows($sql,$params);
	}
	
	public function insert($table,$data){
		return $this->connection->insert($table,$data);
	}
	
	public function update($table,$condition,$data){
		return $this->connection->update($table,$condition,$data);
	}
	
	public function delete($table,$condition){
		return $this->connection->delete($table,$condition);
	}

	
	public function getCurrentSql(){
		return $this->connection->getCurrentSql();	
	}
	
	public function getProccessSqlList(){
		return $this->connection->getProccessSqlList();
	}
}