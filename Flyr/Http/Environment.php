<?php namespace Flyr\Http;

class Environment {
	
	private $env = array();
	
	public function __construct() {
		foreach($_SERVER as $key => $val) {
			$this->env[$key] = $val;
		}
	}
	
	public function get($key) {
		if(isset($this->env[$key])) {
			return $this->env[$key];
		}
		
		return null;
	}
	
	public function getAll() {
		return $this->env;
	}
}
