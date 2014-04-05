<?php
/**
 * 控制器基础类
 *
 * @author      Jianghao <geekbaba.j@gmail.com>
 * @date 2013-11-28 下午8:26:51
 * @version 1.0.0
 * @copyright  Copyright 2012 Joincoding Technolcgies Co.,Ltd.
 */
namespace Julius\Core\Library;
use Julius\Core\JObject;
class Controller extends JObject{
	
	/**
	 * Controller 视图
	 * @var View
	 */
	public $view = null;
	/**
	 * 设置View
	 * 
	 * @param 
	 * @return void
	 * @date 2013-11-28下午8:29:46
	 * @version 1.0.0
	 */
	public function setView($view) {
		$this->view = $view;
	}
	
	/**
	 * 模版展示页面
	 * 
	 * @param string 模版变量名称
	 * @param mixd 变量值
	 * @return void
	 * @date 2013-12-2下午9:50:24
	 * @version 1.0.0
	 */
	public function assign($name,$var) {
		$this->view->assign($name, $var);
	}
	/**
	 * 展示页面
	 * 
	 * @return void
	 * @date 2013-12-2下午9:48:35
	 * @version 1.0.0
	 */
	public function display(){
		$this->view->show();
	}
}