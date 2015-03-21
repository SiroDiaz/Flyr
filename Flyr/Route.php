<?php namespace Flyr;

class Route extends Http\Request {
	
	const SEPARATOR = '@';			// the separator between the class name and the method name
	private static $found = false;	// it is used to stop checking requests
	private $pattern;				// the uri pattern
	private $url;
	private $params;
	
	public function __construct() {
		parent::__construct();
		$this->url = new Http\Url();
		$this->params = [];
	}
	
	/**
	 * Get the last folder where is contained the script.
	 * 
	 * @return the last directory where is hosted the framework
	 */
	
	private function getPhysicalPath() {
		return dirname(getenv('SCRIPT_NAME'));
	}
	
	/**
	 * Get the uri pattern.
	 * 
	 * @return string
	 */
	 
	public function getPattern() {
		return $this->pattern;
	}
	
	/**
	 * Get all url parameters.
	 * 
	 * @return array|mixed
	 */
	 
	public function getParams() {
		return $this->params;
	}
	
	/**
	 * Generate the full pattern and return it.
	 * 
	 * @return string the full pattern
	 */
	 
	private function getFullPattern() {
		return $this->getPhysicalPath() . $this->getPattern();
	}
	
	/**
	 * Save the parameter to the list
	 */
	 
	public function setParam($key, $value) {
		$this->params[$key] = $value;
	}
	
	/**
	 * Set the pattern and put it to lowercase.
	 * 
	 * @return bool
	 */
	
	public function setPattern($pattern) {
		if(is_string($pattern) && $pattern) {
			$this->pattern = strtolower($pattern);
		}
	}
	
	/**
	 * Execute the GET request.
	 * 
	 * @param string $pattern The requested uri pattern
	 * @param mixed $callback A function or a class method
	 * @param bool $caseSensitive (default false)
	 */
	
	public function get($pattern, $callback = null, $caseSensitive = false) {
		if(!self::$found) {
			$this->setPattern($pattern);
			if($this->isGet()) {
				// when * is found load the callback(or controller) and then exit
				// must be set at the end of routes.php
				if($this->pattern === '*') {
					$this->loadCallback($callback);
					// will be replaced by the following code
					// $dispatcher = new Action($callback, $this->params);
					// $dispatcher->run();
					self::$found = true;
					return;
				}
				
				if($this->uriMatches($caseSensitive)) {
					$this->loadCallback($callback, $this->params);
					self::$found = true;
				}
			}
		}
	}
	
	/**
	 * Execute the POST request.
	 * 
	 * @param string $pattern The requested uri pattern
	 * @param mixed $callback A function or a class method
	 * @param bool $caseSensitive (default false)
	 */
	
	public function post($pattern, $callback = null, $caseSensitive = false) {
		if(!self::$found) {
			$this->setPattern($pattern);
			if($this->isPost()) {
				if($this->pattern === '*') {
					$this->loadCallback($callback);
					self::$found = true;
					return;
				}
				
				if($this->uriMatches($caseSensitive)) {
					// in this case the params atribute will be replace by $_POST
					$this->loadCallback($callback, $this->params);
					self::$found = true;
				}
			}
		}
	}
	
	/**
	 * Execute the PUT request.
	 * 
	 * @param string $pattern The requested uri pattern
	 * @param mixed $callback A function or a class method
	 * @param bool $caseSensitive (default false)
	 */
	
	public function put($pattern, $callback = null, $caseSensitive = false) {
		if(!self::$found) {
			$this->setPattern($pattern);
			// parse_str(file_get_contents("php://input"), $_PUT);
			
			if($this->isPut()) {
				// when * is found load the callback(or controller) and then exit
				// must be set at the end of routes.php
				if($this->pattern === '*') {
					$this->loadCallback($callback);
					self::$found = true;
					return;
				}
				
				if($this->uriMatches($caseSensitive)) {
					// in this case the params atribute will be replace by $_PUT
					$this->loadCallback($callback, $this->params);
					self::$found = true;
				}
			}
		}
	}
	
	/**
	 * Execute the DELETE request.
	 * 
	 * @param string $pattern The requested uri pattern
	 * @param mixed $callback A function or a class method
	 * @param bool $caseSensitive (default false)
	 */
	
	public function delete($pattern, $callback = null, $caseSensitive = false) {
		if(!self::$found) {
			$this->setPattern($pattern);
			// parse_str(file_get_contents("php://input"), $_DELETE);
			if($this->isDelete()) {
				// when * is found load the callback(or controller) and then exit
				// must be set at the end of routes.php
				if($this->pattern === '*') {
					$this->loadCallback($callback);
					self::$found = true;
					return;
				}
					
				if($this->uriMatches($caseSensitive)) {
					// in this case the params atribute will be replace by $_PUT
					$this->loadCallback($callback, $this->params);
					self::$found = true;
				}
			}
		}
	}
	
	/**
	 * It respond the same for any passed callback.
	 * 
	 * @param array $methods The request methods availables for matching
	 * @param string $pattern The requested uri pattern
	 * @param mixed $callback A function or the controller name
	 * @param bool $caseSensitive (default false)
	 */
	  
	public function both(array $methods, $pattern, $callback = null, $caseSensitive = false) {
		$totalMethods = count($methods);
		
		// Setting all methods in upper case
		for ($i = 0; $i < $totalMethods; $i++) {
			$methods[$i] = strtoupper($methods[$i]);
		}
		
		if ($this->isGet() && in_array('GET', $methods)) {
			$this->get($pattern, $callback, $caseSensitive);
		} elseif($this->isPost() && in_array('POST', $methods)) {
			$this->post($pattern, $callback, $caseSensitive);
		} elseif($this->isPut() && in_array('PUT', $methods)) {
			$this->put($pattern, $callback, $caseSensitive);
		} elseif($this->isDelete() && in_array('DELETE', $methods)) {
			$this->delete($pattern, $callback, $caseSensitive);
		} else {
			// in case of 
			$this->get($pattern, $callback, $caseSensitive);
		}
	}
	
	/**
	 * Respond any request verb
	 * 
	 * @param string $pattern
	 * @param callable|string $callback
	 * @param bool $caseSensitive (default false)
	 */
	
	public function any($pattern, $callback = null, $caseSensitive = false) {
		if(!self::$found) {

			switch($this->getMethod()) {
				case 'GET':
					$this->get($pattern, $callback, $caseSensitive);
					break;
				case 'POST':
					$this->post($pattern, $callback, $caseSensitive);
					break;
				case 'PUT':
					$this->put($pattern, $callback, $caseSensitive);
					break;
				case 'DELETE':
					$this->delete($pattern, $callback, $caseSensitive);
					break;
				default:
					// in case that the request method be unknow
					$this->get($pattern, $callback, $caseSensitive);
			}
		}
	}
	
	/**
	 * Strips the uri by '/' and delete the first empty element.
	 * 
	 * @param string $uri The uri to strip
	 * @return array the stripped uri
	 */
	 
	 private function stripUri($uri) {
	 	$uriParts = explode('/', $uri);
		array_shift($uriParts);
		return $uriParts;
	 }
	
	/**
	 * Adds the parameter to an associative array
	 * with its value to be passed to the callback or controller.
	 * 
	 * @param string $key the parameter name
	 * @param string $val the parameter value
	 */
	 
	private function addParam($key, $val) {
		if(strlen($key) && strlen($val)) {
			$this->params[$key] = $val;
		}
	}
	
	/**
	 * Checks if the fragment is a parameter.
	 * 
	 * @param string $elem uri fragment
	 */
	 
	private function isParam($elem) {
		return (strpos($elem, ':') === 0);
	}
	
	/**
	 * Checks if the real uri follows the same pattern.
	 * that the uri provided.
	 * 
	 * @return boolean true if matches 
	 */
	 
	 private function uriMatches($caseSensitive = false) {
	 	$pattern = $this->stripUri($this->getFullPattern());
		if($caseSensitive === false) {
			$uri = $this->stripUri(strtolower($this->url->getPath()));
		} else {
			$uri = $this->stripUri($this->url->getPath());
		}
		
		$uriLength = count($uri);		// takes the number of uri fragments
		$patternLength = count($pattern);	// takes the number of pattern fragments
		
		if(empty($uri[$uriLength - 1]) && !empty($pattern[$patternLength - 1])) {
			return false;
		}

		if($patternLength === $uriLength) {
			for($i = 0; $i < $patternLength; $i++) {
				if($pattern[$i] !== $uri[$i] && !$this->isParam($pattern[$i])) {
					return false;
				} else {
					if($this->isParam($pattern[$i])) {
						$this->addParam(substr($pattern[$i], 1), $uri[$i]);
					}
				}
			}

			return true;
		}
		
		return false;
	 }
	 
	
	/**
	 * Execute the callback or the method from a class controller.
	 * 
	 * @param mixed $callback a function or controller
	 * @param mixed $params null for no parameters
	 */
	
	private function loadCallback($callback = null, $params = []) {
		
		if($callback === null) {
			return;
		}
		
		if(is_callable($callback)) {		// if the callback is a function then execute it
			if(count($params) !== 0) {			// in exists any param then pass it to the function
				return call_user_func_array($callback, $params);
			}
			
			return $callback();
		} else {
			if(strpos($callback, self::SEPARATOR) !== false) {	// case is a string like this: 'class@method'
				list($className, $methodName) = explode(self::SEPARATOR, $callback);
				// load the class file (use the defined CONTROLLER_PATH, placed in config/config.php)
				require CONTROLLER_PATH ."$className.php";
				
				if(class_exists($className) && method_exists($className, $methodName)){
					$instance = new $className();	// new class instance
					if(count($params) !== 0) {
						return call_user_func_array([$instance, $methodName], $params);
					}
					
					return $instance->$methodName();
				}
			}
		}
	}
}
