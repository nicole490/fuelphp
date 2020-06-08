<?php
/**
 * Fuel is a fast, lightweight, community driven PHP 5.4+ framework.
 *
 * @package    Fuel
 * @version    1.8.2
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2019 Fuel Development Team
 * @link       https://fuelphp.com
 */

return array(
	// web
	'_404_' => 'todo/index', //全てのURLでindex.phpを返す

	// API
	"api/todos" => [['GET', new Route('todo/list')], ['POST', new Route('todo/create')]],
	"api/todos/(?P<id>\d+)" => [['GET', new Route('todo/detail')], ['POST', new Route('todo/update')], ['DELETE', new Route('todo/item')]],
);
