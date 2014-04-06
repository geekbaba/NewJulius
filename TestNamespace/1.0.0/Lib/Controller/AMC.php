<?php
/**
 * 例子Controller
 *
 * @author      Jianghao <geekbaba.j@gmail.com>
 * @date 2014-4-3 下午3:18:22
 * @version 1.0.0
 * @copyright  Copyright 2012 Joincoding Technolcgies Co.,Ltd.
 */
use Julius\Core\Library\Controller;
use Thrift\ClassLoader\ThriftClassLoader;
use Thrift\Protocol\TBinaryProtocol;
use Thrift\Transport\TPhpStream;
use Thrift\Transport\TBufferedTransport;
class Controller_AMC extends Controller implements AMCServiceIf{

	public function getNameSpaceList(){
		try {
			
				
			$list = new Item(array('name'=>'Jianghao'
						,'description'=>'TestNameSpace'
					));
				
			return array($list);
			
		} catch (Exception $e) {
			return new AMCException(array('code'=>'000','message'=>$e->getMessage()));
		}
	}
	
	public function getParamList($nameSpace, $custom){
		
	}
	
	public function getData($nameSpace, $custom, $field, $condition){

		
	}
	
	public function call($nameSpace, $functionName, $params){
		
	}
	
	public function setData($nameSpace, $custom, $value){
		
	}
	
	public function setList($nameSpace, $custom, $value){
		
	}
	
	public function multiJob($multidata){
		
	}
}