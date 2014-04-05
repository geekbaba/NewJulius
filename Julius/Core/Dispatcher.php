<?php
/**
 * 分发器基类
 *
 * @author      Jianghao <geekbaba.j@gmail.com>
 * @date 2013-11-27 下午2:24:31
 * @version 1.0.0
 * @copyright  Copyright 2012 Joincoding Technolcgies Co.,Ltd.
 */
namespace Julius\Core;
use Julius\Common\RouteType;
use Julius\Common\RouteStatus;
use Julius\Core\Dispatcher\CommondMode;
use Julius\Core\Dispatcher\RoutingMode;

class Dispatcher extends JObject{
	
	private $DispatcherMode = null;
	/**
	 * 
	 * 
	 * @return Dispatcher
	 * @date 2013-11-27下午9:41:06
	 * @version 1.0.0
	 */
	public function __construct() {
		switch (ROUTE_MODE) {
			case RouteType::ROUTETING_MODE:
				$this->DispatcherMode = new RoutingMode();
			;
			break;
			case RouteType::REWRITE_MODE :
				;
			break;
			case RouteType::COMMOND_MODE :
				$this->DispatcherMode = new CommondMode();
			;
			break;
			case RouteType::STATIC_MODE :
			;
			break;
			default:
				;
			break;
		};
		switch ($this->DispatcherMode->routeCheck()) {
			case RouteStatus::ROUTE_OK:
				$this->DispatcherMode->dispatch();
			;
			break;
			case RouteStatus::ROUTE_SKIP:
				$this->DispatcherMode->dispatch();
				;
				break;
			case RouteStatus::ROUTE_FAIELD:
				throw new BaseException('Router Status Is Failed');
				;
				break;
			default:
				throw new BaseException('Unknow Router Status');
				;
			break;
		}
	}
	
}