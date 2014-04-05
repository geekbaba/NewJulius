<?php
/**
 * 路由模式定义
 *
 * @author      Jianghao <geekbaba.j@gmail.com>
 * @date 2013-11-27 下午9:36:04
 * @version 1.0.0
 * @copyright  Copyright 2012 Joincoding Technolcgies Co.,Ltd.
 */
namespace Julius\Common;
use Julius\Core\JObject;
final class RouteType extends JObject{
	const ROUTETING_MODE = 1;//路由模式
	const REWRITE_MODE = 2; //重写规则
	const COMMOND_MODE = 3; //命令行模式
	const STATIC_MODE = 4; //静态模式
}