<?php

class RouteTest extends PHPUnit_Framework_TestCase {
	
	public $route;
	
	public function __construct() {
		$this->route = new Flyr\Route();
	}
	
	public function testGetPattern() {
		$this->route->setPattern('/foo');
		$this->assertEquals('/foo', $this->route->getPattern());
	}
	
	public function testGetParams() {
		$this->route->setParam('lang', 'es');
		$this->assertEquals(['lang' => 'es'], $this->route->getParams());
	}
	
}
