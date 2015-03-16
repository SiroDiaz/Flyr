<?php

class LoggerTest extends PHPUnit_Framework_TestCase {
	
	public $log;
	
	public function __construct() {
		$this->log = new Flyr\Components\Logger();
	}
	
	public function testGetProperties() {
		$properties = [
				'loglevel' => 'Warning',
				'message' => 'Some log message',
				'time' => date("Y-m-d H:i:s")
		];
		
		$this->log->setLog('Some log message', Flyr\Components\Logger::WARNING);
		$this->assertEquals($properties, $this->log->getProperties());
	}
	
	public function testGetLogLevel() {
		$properties = [
				'loglevel' => 'Warning',
				'message' => 'Some log message',
				'time' => date("Y-m-d H:i:s")
		];
		
		$this->log->setLog('Some log message', Flyr\Components\Logger::WARNING);
		$this->assertEquals($properties['loglevel'], $this->log->getLogLevel());
	}
	
}
