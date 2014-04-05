<?php
/**
 * JTemplateEngine模版引擎
 *
 * @author      Jianghao <geekbaba.j@gmail.com>
 * @date 2013-12-2 上午11:06:50
 * @version 1.0.0
 * @copyright  Copyright 2012 Joincoding Technolcgies Co.,Ltd.
 */
namespace Julius\Core\TemplateEngine;
use Julius\Core\JObject;

class JTemplateEngine extends JObject{
	/**
	 * 构造方法
	 * 
	 * @return JTemplateEngine
	 * @date 2013-12-2上午11:18:07
	 * @version 1.0.0
	 */
	public function __construct() {
		if(defined('TEMPLATE_LEFT_DELIMITER')){
			define('TEMPLATE_LEFT_DELIMITER', '<{');
		}
		if(defined('TEMPLATE_RIGHT_DELIMITER')){
			define('TEMPLATE_RIGHT_DELIMITER', '}>');
		}
	}
	/**
	 * 对模版进行解析生成混编代码
	 * 
	 * @param string content
	 * @return void
	 * @date 2013-12-2上午11:08:24
	 * @version 1.0.0
	 */
	public function mixedCode($content) {

		$search = array('/'.TEMPLATE_LEFT_DELIMITER .'loop\s+\$(\w+)\s+\$(\w+)'. TEMPLATE_RIGHT_DELIMITER .'/s'
						,'/'.TEMPLATE_LEFT_DELIMITER .'loop\s+\$(\w+)\s+\$(\w+)\s+\$(\w+)'. TEMPLATE_RIGHT_DELIMITER .'/s'
						,'/'.TEMPLATE_LEFT_DELIMITER .'elseloop'. TEMPLATE_RIGHT_DELIMITER .'(.+?)'.TEMPLATE_LEFT_DELIMITER .'endloop'. TEMPLATE_RIGHT_DELIMITER .'/s'
			       		,'/'.TEMPLATE_LEFT_DELIMITER .'endloop'. TEMPLATE_RIGHT_DELIMITER .'/s'
			       		,'/'.TEMPLATE_LEFT_DELIMITER .'if\s+\((.+?)\)'. TEMPLATE_RIGHT_DELIMITER .'/s'
						,'/'.TEMPLATE_LEFT_DELIMITER .'endif'. TEMPLATE_RIGHT_DELIMITER .'/s'
						,'/'.TEMPLATE_LEFT_DELIMITER .'elseif\s+\((.+?)\)'. TEMPLATE_RIGHT_DELIMITER .'/s'
						,'/'.TEMPLATE_LEFT_DELIMITER .'else'. TEMPLATE_RIGHT_DELIMITER .'/s'
						,'/\{([a-zA-Z0-9_\[\]\'\"\$\.\x7f-\xff]+)\}/s'
						);
		$replace = array('<?php if(!empty($$1)&&is_array($$1)){$countLoop = 1;foreach($$1 as $$2){$countLoop++;?>'
						,'<?php if(!empty($$1)&&is_array($$1)){$countLoop = 1;foreach($$1 as $$2=>$$3){$countLoop++;?>'	
						,'<?php }if(!empty($countLoop))$countLoop--;}else{?>$1<?php }?>'
			       		,'<?php }if(!empty($countLoop))$countLoop--;}?>'
			       		,'<?php if($1){?>'
			       		,'<?php }?>'
			       		,'<?php }elseif($1){?>'
			       		,'<?php }else{?>'
			       		,'<?php echo $$1;?>');
		
		return preg_replace($search, $replace, $content);
	}
}