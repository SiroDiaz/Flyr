<?php namespace Flyr;

class Action {
	
	private $actions;
	
	private $params;
	
	public function __construct($actions, $params = []) {
		$this->actions = $actions;
		$this->params = $params;
	}
	
	/**
	 * Checks if actions are a valid datatype.
	 * 
	 * @return bool true if is string, array or not null
	 */
	
	private function _areValidActions() {
		
		if(is_string($this->actions)) {
			return true;
		} elseif (is_array($this->actions)) {
			return true;
		} elseif(is_callable($this->actions)) {
			return true;
		} else {
			return false;
		}
	}
	
	/**
	 * Execute the function.
	 * 
	 * @param object $action The callback to execute
	 * @return mixed
	 */
	
	private function _execFunction($action) {
		return call_user_func_array($action, $this->params);
	}
	
	/**
	 * Load the class file, create a new instance
	 * and execute the method.
	 * 
	 * @param string $controller The controller name
	 * @return mixed
	 */
	
	private function _execController($controller) {
		// check if class file exists
		// require class
		// create instance
		
		return call_user_func_array([$instance, $methodName], $this->params);
	}
	
	/**
	 * Ececute the queue of callbacks or controllers
	 * in the order in which callbacks were defined.
	 * 
	 * @return null only if actions are not a
	 */
	
	public function run() {
		
		if($this->_areValidActions())
			if (is_array($this->actions)) {
				foreach ($this->actions as $action) {
					$this->_execFunction($action);
				}
			} elseif(is_callable($this->actions)) {
				
			} else {
				// case action is a string(controller)
				
			}
		}
	}
}
