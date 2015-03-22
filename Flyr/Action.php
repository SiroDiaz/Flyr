<?php namespace Flyr;

class Action {
	
	const SEPARATOR = '@';		// the separator between the class name and the method name
	
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
		list($class, $method) = explode(self::SEPARATOR, $controller);
		$filename = CONTROLLER_PATH ."$class.php";
		
		if(!file_exists($filename)) {
			return;
		}
		
		require_once($filename);
		
		if(class_exists($class)) {
			$instance = new $class();
		}
		
		return call_user_func_array([$instance, $method], $this->params);
	}
	
	/**
	 * Ececute the queue of callbacks or controllers
	 * in the order in which callbacks were defined.
	 */
	
	public function run() {
		
		if($this->_areValidActions()) {
			if (is_array($this->actions)) {
				
				foreach ($this->actions as $action) {
					
					if(is_callable($action)) {
						$this->_execFunction($action);
					} elseif(is_string($action)) {
						$this->_execController($action);
					}
				}
			} elseif(is_callable($this->actions)) {
				$this->_execFunction($this->actions);
			} else {
				$this->_execController($this->actions);	// case action is a string(controller)
			}
		}
	}
}
