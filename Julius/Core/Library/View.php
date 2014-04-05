<?php
/**
 * 视图基础类
 *
 * @author      Jianghao <geekbaba.j@gmail.com>
 * @date 2013-11-28 下午9:00:18
 * @version 1.0.0
 * @copyright  Copyright 2012 Joincoding Technolcgies Co.,Ltd.
 */
namespace Julius\Core\Library;
class View extends JObject{
	
	/**
	 * 模版引擎对象
	 * 
	 * @var JObject
	 */
	protected $TemplateEngine = null;
	
	/**
	 * 模版上的变量
	 * @var array
	 */
	protected $TempVars = array();
	
	
	/**
	 * 视图的构造方法
	 * 
	 * @return View
	 * @date 2013-12-2下午12:04:39
	 * @version 1.0.0
	 */
	public function __construct() {
		;
	}
	
	/**
	 * 模版赋值
	 * 
	 * @param mixd
	 * @return void
	 * @date 2013-12-2下午12:00:10
	 * @version 1.0.0
	 */
	public function assign($name,$value) {
		$this->TempVars[$name] = $value;
	}
	
	/**
	 * 模版文件展示方法
	 * 
	 * @return void
	 * @date 2013-12-2下午12:03:11
	 * @version 1.0.0
	 */
	public function show($template='') {
		
		extract($this->TempVars);
		
		$templateEngine = new JTemplateEngine();
		$content = $templateEngine->mixedCode($this->getTemplate());
		
	//	var_dump($content);
		//$this->load();
	}
	
	/**
	 * 获取模版内容
	 * 
	 * @return string
	 * @date 2013-12-2下午9:07:52
	 * @version 1.0.0
	 */
	public function getTemplate(){
		return $this->_template;
	}
	
}