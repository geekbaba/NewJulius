<?php
/**
 * Julius框架基础类
 * 注意:文件编译文档和合并的时候需要 tokenizer支持
 *
 * @author      Jianghao <geekbaba.j@gmail.com>
 * @date 2013-11-26 下午5:40:39
 * @version 1.0.0
 * @copyright  Copyright 2012 Joincoding Technolcgies Co.,Ltd.
 */
namespace Julius;

use Julius\Core\App;
use Julius\Core\Doc\ClassDoc;
use Julius\Exception\BaseException;
use \ReflectionObject;

final class Julius {
	const DS = DIRECTORY_SEPARATOR;
	const PS = PATH_SEPARATOR;
	
	const NAME = 'Julius';
	const VERSION = '1.0.0';
	const CHARSET = 'utf-8';
	
	/**
	 * 初始化方法
	 * 
	 * @param int
	 * @return int
	 * @date 2013-11-26下午5:49:22
	 * @version 1.0.0
	 */
	public static function init() {
		
		$inc_path =  JULIUS_PATH .self::DS . self::PS
		. JULIUS_PATH . 'Vendor' . self::DS . self::PS
		. JULIUS_PPATH . self::DS . self::PS
		. APP_PATH . self::DS . APP_VERSION . self::DS . 'Lib' . self::DS . self::PS;
		
		set_include_path($inc_path);
		
		spl_autoload_register('self::autoload');
		
		if(!defined('ALL_IN_ONE')){
			define('ALL_IN_ONE', '~allinone.php');
		}
		
		if(!defined('NO_COMPILE')){
			define('NO_COMPILE',true);
		}
		self::bulid();
		
		if(file_exists(ALL_IN_ONE)&&(!NO_COMPILE)){
			
			include ALL_IN_ONE;
			App::run();
			
		}else{
			global $argv;
			
			if(isset($argv[1]) && ('--compile'==$argv[1] || '-c'==$argv[1])){
				
				$classlist = array();
				global $classlist;
				
				App::run();
				
				self::globlerun();
				self::compile();
			}else{
				App::run();
			}
			
		}
	}
	
	/**
	 * 运行所有应用的方法
	 * 
	 * @return void
	 * @date 2013-11-28下午5:14:44
	 * @version 1.0.0
	 */
	public static function globlerun() {
		
		global $classlist;
		
		$controllerlist = scandir(APP_PATH . APP_VERSION . self::DS . 'Lib' . self::DS . 'Controller' . self::DS);
		foreach ($controllerlist as $file){
			if('.'!=$file&&'..'!=$file){
				if(F::isPhpFile($file)){
					
					$className = 'Controller_'.substr($file, 0,-4);
					
					$currentObject = new $className();
					
					$class = new ReflectionObject($currentObject);
					$methods = $class->getMethods(ReflectionMethod::IS_PUBLIC);
					foreach($methods as $item){
						
						$method = $item->name;
						$fcName = $item->class;
						
						if($fcName==$className){
							$currentObject->$method();
						}
					}
				}
			}
		}
	}
	
	/**
	 * 判断是否需要编译
	 * 
	 * @return boolean
	 * @date 2013-11-28下午3:52:01
	 * @version 1.0.0
	 */
	public static function isneedCompile() {
		
		if(NO_COMPILE){
			return false;
		}else{
			return true;
		}
	}
	/**
	 * 自动加载
	 * 
	 * @param string className
	 * @return boolean
	 * @date 2013-11-26下午5:50:36
	 * @version 1.0.0
	 */
	public static function autoload($className) {
		require (strtr($className,'_',self::DS) . '.php');
	}
	
	/**
	 * 1.构建应用
	 * 2.编译项目
	 * 3.生成文档
	 * 
	 * @param void
	 * @return boolean
	 * @date 2013-11-26下午5:57:03
	 * @version 1.0.0
	 */
	public static function bulid() {
		
		define('BUILD_PATH', JULIUS_PATH.'Build' . self::DS );
		define('APPLIB_PATH', APP_PATH.APP_VERSION.self::DS.'Lib'.self::DS);
		
		$bulidDir = array();
		$bulidDir[] = APPLIB_PATH.'Controller'.self::DS;
		$bulidDir[] = APPLIB_PATH.'Configure'.self::DS;
		$bulidDir[] = APPLIB_PATH.'Model'.self::DS;
		$bulidDir[] = APPLIB_PATH.'View'.self::DS;
		
		foreach ($bulidDir as $dir){
			if(!is_dir($dir)){
				mkdir($dir,0777,true);
			}
		}
		
		$lambda = function ($path) use (&$lambda){
			$list = scandir($path);
				
			foreach ($list as $pt){
			
				if('.'!=$pt && '..'!=$pt){
						
					if(is_dir($path.self::DS.$pt)){
			
						$extdir = str_replace(BUILD_PATH,'', $path.self::DS.$pt);
			
						if(!is_dir(APPLIB_PATH.$extdir)){
							mkdir(APPLIB_PATH.$extdir,0777,true);
						}
			
						$lambda($path.self::DS.$pt);
					}else{
			
						$extfile = str_replace(BUILD_PATH,'', $path.self::DS.$pt);
						if(!is_file(APPLIB_PATH.$extfile)){
							if(!copy($path.self::DS.$pt,APPLIB_PATH.$extfile)){
								echo "Build File :{APPLIB_PATH.$extfile} Failed!\n";
							}
							}
						}
					}
				}
		};
		$lambda(BUILD_PATH);
		
		self::bulidDoc();
		
	}
	
	/**
	 * 文档编译
	 * 
	 * @param void
	 * @return boolean
	 * @date 2013-11-26下午6:01:54
	 * @version 1.0.0
	 */
	public static function bulidDoc() {
		
		$bulidfilelist = array();
		
		global $classlist,$bulidfilelist;
		
		$const = get_defined_constants(true);
		
		self::bulidDirectoryDoc(JULIUS_PATH.'Exception'.self::DS);
		self::bulidDirectoryDoc(JULIUS_PATH.'Common'.self::DS);
		
		self::buildFileDoc(JULIUS_PATH.'Core'.self::DS.'App.php');
			
		//$const['user'];
	}

	/**
	 * 编译目录下的文件
	 * 
	 * @param string 路径
	 * @return void
	 * @date 2013-11-29上午11:54:37
	 * @version 1.0.0
	 */
	public static function bulidDirectoryDoc($path) {
		$list = scandir($path);
		foreach($list as $value){
			if('..' !=$value && '.'!=$value){
				if(is_dir($path.$value)){
					self::bulidDirectoryDoc($path.self::DS.$value.self::DS);
				}else{
					if('.php'==substr($value,-4)){
						//self::buildFileDoc($path.self::DS.$value);
						self::buildClassDoc(substr($value,0,-4));
					}
				}
			}
		}
	}
	/**
	 * 构建文件文档
	 * 
	 * @param string 编译文件名
	 * @return void
	 * @date 2013-11-29上午11:48:42
	 * @version 1.0.0
	 */
	public static function buildFileDoc($file) {
		
		//$tokens = token_get_all(file_get_contents($file));
		//var_dump($tokens);
		//exit();
	}
	
	/**
	 * 构建类库文档
	 * 
	 * @param string 类名
	 * @return void
	 * @date 2013-12-1下午12:52:09
	 * @version 1.0.0
	 */
	public static function buildClassDoc($className){
//		new ClassDoc($className);
		
	}
	/**
	 * 检查必要配置是否存在
	 * 
	 * @param void
	 * @return boolean
	 * @date 2013-11-26下午6:08:07
	 * @version 1.0.0
	 */
	public static function constCheck() {
		
		$constlist = array( 'JULIUS_PATH'
							,'APP_PATH'
							,'APP_VERSION'
							);
		
		foreach($constlist as $const){
			if(!defined($const)){
			 	throw new BaseException('const "'. $const .'" not defined');
			}
		}
	}
	
	/**
	 * 编译于编译文件
	 *
	 * @return void
	 * @date 2013-11-26下午8:40:16
	 * @version 1.0.0
	 */
	public static function resetCompileFile() {
		if(file_exists(ALL_IN_ONE)){
			unlink(APP_PATH.ALL_IN_ONE);
		}
		file_put_contents(ALL_IN_ONE, '<?php');
		self::compiledir(JULIUS_PATH.'Exception'.self::DS);
		self::compiledir(JULIUS_PATH.'Common'.self::DS);
		self::compileFile(JULIUS_PATH.'Core'.self::DS.'App.php');
	}
	
	/**
	 * 编译使用的类库
	 * 
	 * @return boolean
	 * @date 2013-11-28下午4:30:28
	 * @version 1.0.0
	 */
	public static function compile() {
		global $classlist;
		self::resetCompileFile();
		foreach ($classlist as $class=>$status){
			$obj = new ReflectionClass($class);
			self::compileFile($obj->getFileName());
		}
		return true;
	}
	/**
	 * 编译目录
	 *
	 * @return void
	 * @date 2013-11-26下午8:47:02
	 * @version 1.0.0
	 */
	public static function compiledir($dir){
	
		$list = scandir($dir);
		foreach($list as $value){
			if('..' !=$value && '.'!=$value){
				if(is_dir($dir.$value)){
					self::compiledir($dir.self::DS.$value.self::DS);
				}else{
					if('.php'==substr($value,-4)){
						self::compileFile($dir.self::DS.$value);
					}
				}
			}
		}
	}
	/**
	 * 写入编译文件
	 *
	 * @return void
	 * @date 2013-11-26下午8:47:02
	 * @version 1.0.0
	 */
	public static function compileFile($file){
		
		if(F::isPhpFile($file)){
			$contents = file_get_contents($file);
			
			$contents = self::strip_whitespace($contents);
			
			$search = array('<?php',"\n","\r");
			$contents = str_replace($search, '',$contents);
			if($contents!=''){
				file_put_contents(ALL_IN_ONE, $contents, FILE_APPEND);
			}
		}
			
	}	
	/**
	 * 使用了Heredoc 可以替换php_strip_whitespace
	 *
	 * @param string contect
	 * @return string
	 * @date 2013-11-26下午9:35:53
	 * @version 1.0.0
	 */
	public static function strip_whitespace($content) {
		$stripStr = '';
		$tokens =   token_get_all ($content);
		$last_space = false;
		for ($i = 0, $j = count ($tokens); $i < $j; $i++){
			if (is_string ($tokens[$i])){
				$last_space = false;
				$stripStr .= $tokens[$i];
			}
			else{
				switch ($tokens[$i][0]){
					case T_COMMENT:
					case T_DOC_COMMENT:
						break;
					case T_WHITESPACE:
						if (!$last_space){
							$stripStr .= ' ';
							$last_space = true;
						}
						break;
					default:
						$last_space = false;
						$stripStr .= $tokens[$i][1];
				}
			}
		}
		return $stripStr;
	}
}
