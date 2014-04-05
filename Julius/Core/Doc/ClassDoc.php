<?php
/**
 * 类的文档构建类
 *
 * @author      Jianghao <geekbaba.j@gmail.com>
 * @date 2013-12-1 下午2:13:04
 * @version 1.0.0
 * @copyright  Copyright 2012 Joincoding Technolcgies Co.,Ltd.
 */
namespace Julius\Core\Doc;
use \ReflectionClass;
use Julius\Exception\BaseException;
class ClassDoc extends Doc{
	
	/**
	 * 开始解析文档
	 * 
	 * @param string ClassName
	 * @return ClassDoc
	 * @date 2013-12-1下午2:13:33
	 * @version 1.0.0
	 */
	public function __construct($className) {
		$class = new ReflectionClass($className);
		$comment = $class->getDocComment();
		$this->docComment($comment);
	}
	
	
	/**
	 * 文档注释处理
	 * 
	 * @param string DocComment
	 * @return void
	 * @date 2013-12-1下午2:59:07
	 * @version 1.0.0
	 */
	public function docComment($docComment) {
		return ;
	}
}