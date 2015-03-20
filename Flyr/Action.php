<?php namespace Flyr;

class Action {
	
	private $actions;
	
	private $params;
	
	public function __construct($actions) {
		$this->actions = $actions;
	}
	
	/**
	 * 
	 */
	
	private function execFunction($action) {
		
	}
	
	/**
	 * 
	 */
	
	public function run() {
		
		if($this->actions === null) {
			return;
		}
		
		if (is_array($this->actions)) {
			foreach ($this->actions as $action) {
				$this->execFunction($this->actions);
			}
		} else
	}
}
