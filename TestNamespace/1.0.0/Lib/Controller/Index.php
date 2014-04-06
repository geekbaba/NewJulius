<?php
/**
 * 例子Controller
 *
 * @author      Jianghao <geekbaba.j@gmail.com>
 * @date 2014-4-3 下午3:18:22
 * @version 1.0.0
 * @copyright  Copyright 2012 Joincoding Technolcgies Co.,Ltd.
 */
use Julius\Core\App;
use Julius\Core\Library\Controller;
use Thrift\ClassLoader\ThriftClassLoader;
use Thrift\Protocol\TBinaryProtocol;
use Thrift\Transport\TPhpStream;
use Thrift\Transport\TBufferedTransport;
class Controller_Index extends Controller{
	
	/**
	 * Test
	 * 
	 * @param 
	 * @return return_type
	 * @date 2013-11-28下午5:09:15
	 * @version 1.0.0
	 */
	public function index() {
		
		
		header('Content-Type', 'application/x-thrift');
		if (php_sapi_name() == 'cli') {
			echo "\r\n";
		}			
		$GEN_DIR = APPLIB_PATH . 'gen-php\AMC\\';
			
		App::addIncludePath($GEN_DIR);
		include "AMCService.php";
		include "Types.php";
		$AMCService = new Controller_AMC();
		//$ar = $AMCService->getNameSpaceList();
		
		//var_dump($ar);exit();
		
		$processor = new AMCServiceProcessor($AMCService);
		
		$transport = new TBufferedTransport(new TPhpStream(TPhpStream::MODE_R | TPhpStream::MODE_W));
		$protocol = new TBinaryProtocol($transport, true, true);
		
		$transport->open();
		$processor->process($protocol, $protocol);
		
		$transport->close();
	}
	
}