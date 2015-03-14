<?php namespace Flyr;

class Route {
	
	const GET_METHOD = 'GET';
	const POST_METHOD = 'POST';
	const PUT_METHOD = 'PUT';
	const DELETE_METHOD = 'DELETE';
	
	const SEPARATOR = '@';			// the separator between the class name and the method name
	private static $found = false;	// it is used to stop checking requests
	private $pattern;				// the uri pattern
	private $method;
	private $url;
	private $params;
	
	public function __construct() {
		$this->url = new Http\Url();
		$this->setRequestedMethod();
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
	 * Returns the request method.
	 * 
	 * @return string
	 */
	 
	public function getMethod() {
		return $this->method;
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
	 * Set the http request method used to uppercase.
	 */
	
	private function setRequestedMethod() {
		$this->method = strtoupper(getenv('REQUEST_METHOD'));
	}
	
	/**
	 * Set the pattern and put it to lowercase.
	 * 
	 * @return boolean
	 */
	
	public function setPattern($pattern) {
		if(is_string($pattern) && $pattern) {
			$this->pattern = strtolower($pattern);
		}
	}
	
	/**
	 * Checks if it is a GET request.
	 * 
	 * @return bool
	 */
	 
	private function isGet() {
		return $this->method === self::GET_METHOD;
	}
	
	/**
	 * Checks if it is a POST request.
	 * 
	 * @return bool
	 */
	 
	private function isPost() {
		return $this->method === self::POST_METHOD;
	}
	
	/**
	 * Checks if it is a PUT request.
	 * 
	 * @return bool
	 */
	 
	private function isPut() {
		return $this->method === self::PUT_METHOD;
	}
	
	/**
	 * Checks if it is a DELETE request.
	 * 
	 * @return bool
	 */
	
	private function isDelete() {
		return $this->method === self::DELETE_METHOD;
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
					self::$found = true;
					return;
				}
				
				if($this->uriMatches($caseSensitive)) {
					$this->loadCallback($callback, $this->params);
					self::$found = true;
				}
			}
		}
		
		return $this;
	}
	
	/**
	 * Execute the POST request.
	 * 
	 * @param string $uri The requested uri pattern
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
					$this->loadCallback($callback, $_POST);
					self::$found = true;
				}
			}
		}
	}
	
	/**
	 * Execute the PUT request.
	 * 
	 * @param string $uri The requested uri pattern
	 * @param mixed $callback A function or a class method
	 * @param bool $caseSensitive (default false)
	 */
	
	public function put($pattern, $callback = null, $caseSensitive = false) {
		if(!self::$found) {
			$this->setPattern($pattern);
			parse_str(file_get_contents("php://input"), $_PUT);
			
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
					$this->loadCallback($callback, $_PUT);
					self::$found = true;
				}
			}
		}
	}
	
	/**
	 * Execute the DELETE request.
	 * 
	 * @param string $uri The requested uri pattern
	 * @param mixed $callback A function or a class method
	 * @param bool $caseSensitive (default false)
	 */
	
	public function delete($pattern, $callback = null, $caseSensitive = false) {
		if(!self::$found) {
			$this->setPattern($pattern);
			parse_str(file_get_contents("php://input"), $_DELETE);
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
					$this->loadCallback($callback, $_DELETE);
					self::$found = true;
				}
			}
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
					exit('Unknown Request method');
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
		
		$uriLength = count($uri);
		$patternLength = count($pattern);
		
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
	 * 
	 */
	  
	public function both() {
		
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
