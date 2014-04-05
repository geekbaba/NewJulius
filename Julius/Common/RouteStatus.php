<?php
/**
 * 路由状态
 *
 * @author      Jianghao <geekbaba.j@gmail.com>
 * @date 2013-11-27 下午9:36:04
 * @version 1.0.0
 * @copyright  Copyright 2012 Joincoding Technolcgies Co.,Ltd.
 */
namespace Julius\Common;
use Julius\Core\JObject;

final class RouteStatus extends JObject{
	const ROUTE_OK = 1; //正常路由规则
	const ROUTE_FAIELD = 2;//规则检查失败
	const ROUTE_SKIP = 0;	//跳过路由
}