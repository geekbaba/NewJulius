<?php
/**
 * 例子Model
 *
 * @author      Jianghao <geekbaba.j@gmail.com>
 * @date 2014-4-3 下午3:18:22
 * @version 1.0.0
 * @copyright  Copyright 2012 Joincoding Technolcgies Co.,Ltd.
 */
use Julius\Core\Library\Model;
class Model_Index extends Model{

	/**
	 * 例子方法
	 */
	public function index(){
	
		return $this->getRows("select * from users",false);

	}
}