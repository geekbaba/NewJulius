<?php
/**
 * 
 *
 * @author      Jianghao <geekbaba.j@gmail.com>
 * @date 2013-11-29 上午11:02:43
 * @version 1.0.0
 * @copyright  Copyright 2012 Joincoding Technolcgies Co.,Ltd.
 */
namespace Julius\Common;
use Julius\Core\JObject;

final class consts extends JObject{                                                                                                                                                                                                             
	
	/**
	 * 框架根目录
	 * 
	 * @var string
	 */
	const JULIUS_PATH = '';
	/**
	 * 应用根目录
	 *
	 * @var string
	 */
	const APP_PATH = '';
	
	/**
	 * 项目版本号
	 *
	 * @var string
	 */
	const APP_VERSION = '';
	
	/**
	 * 合并文件名称
	 *
	 * @var string
	 */
	const ALL_IN_ONE = '';
	
	/**
	 * 是否不需要合并编译
	 *
	 * @var string
	 */
	const NO_COMPILE = '';
	
	/**
	 * 输出文档的模版选择
	 *
	 * @var string
	 */	
	const DOC_TPL = '';
	
	/**
	 * 模版左定界符
	 * @var string
	 */
	const TEMPLATE_LEFT_DELIMITER = '<{';
	
	/**
	 * 模版右定界符
	 * @var string
	 */
	const TEMPLATE_RIGHT_DELIMITER = '}>';
	
	/**
	 * 默认的Controller 类名
	 * @var string
	 */
	const DEFAULT_INDEX = '';
	
	/**
	 * 默认的执行方法名
	 * @var string
	 */
	const DEFAULT_ACTION = '';
}