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
	  $mp = new Model_Index();
	  $data =  $mp->index();
	  echo "<pre>";
	  print_r($data);
	}
	
}