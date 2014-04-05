<?php
/**
 * 函数库
 *
 * @author      Jianghao <geekbaba.j@gmail.com>
 * @date 2013-11-29 下午6:04:47
 * @version 1.0.0
 * @copyright  Copyright 2012 Joincoding Technolcgies Co.,Ltd.
 */
namespace Julius\Common;
use Julius\Core\JObject;

class F extends JObject{
	/**
	 * 判断是否是PHP后缀的文件
	 *
	 * @param string 文件名
	 * @return boolean
	 * @date 2013-11-28下午5:22:29
	 * @version 1.0.0
	 */
	public static function isPhpFile($file) {
		if('.php'==substr($file,-4))
			return true;
		else
			return false;
	}
}