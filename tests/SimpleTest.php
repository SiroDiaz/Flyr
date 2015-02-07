<?php

class SimpleTest extends PHPUnit_Framework_TestCase {
	
	public function testSimple() {
		$name = 'Siro';
		$this->assertEquals('Siro', $name);
	}
	
	public function testOne() {
		$this->assertTrue(true);
		return true;
	}
	
	/**
	 * @depends testOne
	 */
	 
	public function testSecond($val) {
		$this->assertTrue($val);
	}
}
