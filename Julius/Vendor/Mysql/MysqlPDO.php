<?php
/**
 * 文件描述
 *
 * @author      Jianghao <geekbaba.j@gmail.com>
 * @date 2014-4-1 下午5:15:25
 * @version 1.0.0
 * @copyright  Copyright 2012 Joincoding Technolcgies Co.,Ltd.
 */
namespace Julius\Vendor\Mysql;
use \PDO;
class MysqlPDO extends PDO{

	protected $statment;

	protected $current_sql;

	protected $params;

	protected static $proccessd;

	public function __construct($dsn, $username, $passwd, $options){

		parent::__construct($dsn, $username, $passwd, $options);
		$this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); //禁用prepared statements的仿真效果
		$this->exec("set names 'utf8'");
	}

	/**
	 * 查询多条记录
	 * @param string $sql
	 * @param array $params
	 * @return array
	 * @date 2014-4-1下午5:15:35
	 * @version 1.0.0
	 */
	public function getRows($sql,$params){

		$this->e($sql, $params);
		if($this->statment){
			$res = $this->statment->fetchAll(PDO::FETCH_ASSOC);
			$this->statment->closeCursor();
			return $res;
		}else{
			return false;
		}
	}

	/**
	 * 查询一条结果
	 *
	 * @param string $sql
	 * @param array $params
	 * @return array
	 * @date 2014-4-1下午5:16:14
	 * @version 1.0.0
	 */
	public function getRow($sql,$params){

		$this->e($sql, $params);

		if($this->statment){
			$res = $this->statment->fetch(PDO::FETCH_ASSOC);
			$this->statment->closeCursor();
			return $res;
		}else{
			return false;
		}
	}

	/**
	 * 插入数据
	 *
	 * @param string $table
	 * @param array $data
	 * @return int
	 * @date 2014-4-1下午5:16:34
	 * @version 1.0.0
	 */
	public function insert($table,$data){
		$params = array();
		$fields = array();
		$values = array();

		foreach ($data as $field => $value){
			$fields[] = $field;
			$params[] = $value;
			$values[] = '?';
		}

		$sql = sprintf("INSERT INTO %s (%s) VALUES (%s)", $table,'`'.implode('`,`', $fields).'`', implode(',', $values));

		unset($data);

		if($this->e($sql, $params)){
			$this->statment->closeCursor();
			return $this->lastInsertId();
		}else{
			return false;
		}
	}

	/**
	 * 更新接口
	 *
	 * @param string	$table
	 * @param mixd		$condition
	 * @param array		$data
	 * @return int
	 * @date 2014-4-1下午5:17:03
	 * @version 1.0.0
	 */
	public function update($table,$condition,$data){
		$field =array();
		$values = array();
		//如果参数 是数组
		if(is_array($data)){
			foreach($data as $key => $val){
				$field[] = '`'. $key .'` = ?';
				$values[] =$val;
			}
			$sql = sprintf( "UPDATE %s SET %s WHERE %s", $table, implode( ',', $field ), $condition );
			$this->e( $sql, $values );
			$this->statment->closeCursor();
		}else if(is_string ( $data )){
			$sql = sprintf( "UPDATE %s SET %s WHERE %s", $table, $data, $condition );
			$this->e( $sql );
			$this->statment->closeCursor();
		}
	}

	/**
	 * 删除数据
	 *
	 * @param string	$table
	 * @param mixd		$condition
	 * @return int
	 * @date 2014-4-1下午5:17:20
	 * @version 1.0.0
	 */
	public function delete($table,$condition){

		$sql = sprintf( "DELETE FROM %s WHERE %s", $table, $condition );

		$this->e( $sql );
		$this->statment->closeCursor();
	}

	/**
	 * 执行SQL
	 *
	 * @param string 	$sql
	 * @param array		$params
	 * 
	 * @date 2014-4-1下午5:17:34
	 * @version 1.0.0
	 */
	private function e($sql,$params=false){
		
		$this->before_execute();

		$this->statment = $this->prepare($sql);


		$einfo = $this->errorInfo();
		//$stat_einfo = $this->statment->errorInfo();

		if('00000'!=$einfo['0']){
			throw new Exception($einfo[2], $einfo[0]);
		}

		if($params){
			$return = $this->statment->execute(array_values($params));
		}else{
			$return = $this->statment->execute();
		}

		$this->current_sql = $sql;

		$this->params = $params;

		self::$proccessd[] = $sql;

		$this->after_execute();

		return $return;
	}
	/**
	 * sql 执行前
	 * @param function
	 * @return void
	 * @date 2014-4-1下午5:17:57
	 * @version 1.0.0
	 */
	public function before_execute(){

	}

	/**
	 * sql 执行结束后
	 * @param function
	 * @return void
	 * @date 2014-4-1下午5:17:57
	 * @version 1.0.0
	 */
	public function after_execute($function=''){

	}

	/**
	 * 返回当前执行的sql
	 *
	 * @return string
	 * @date 2014-4-1下午5:18:29
	 * @version 1.0.0
	 */
	public function getCurrentSql(){
		return $this->current_sql;
	}

	/**
	 * 执行过的所有sql列表
	 *
	 * @return array
	 * @date 2014-4-1下午5:18:47
	 * @version 1.0.0
	 */
	public function getProccessSqlList(){
		return self::$proccessd;
	}
}