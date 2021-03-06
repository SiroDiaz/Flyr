<?php namespace Flyr;

class Flyr {
	
	/**
	 * Instance of Cookie class.
	 * 
	 * @var $cookie
	 */
	 
	public $cookie;
	
	/**
	 * Instance of Loader.
	 * 
	 * @var $load 
	 */
	 
	public $load;
	
	/**
	 * Mail instance.
	 * 
	 * @var $mail
	 */
	 
	public $mail;
	
	/**
	 * Router instance for provide
	 * a hight level route API.
	 * 
	 * @var $route
	 */
	 
	private $route;
	
	/**
	 * Instance all core classes.
	 */
	
	public function __construct() {
		$this->cookie = new Http\Cookie();
		$this->load = new Loader();
		$this->mail = new Mail();
		$this->route = new Route();
	}
	
	/**
	 * Implementing singleton pattern to avoid
	 * duplicate instance creation.
	 * 
	 * @param string $property The property to create
	 * @param mixed $object The instance to save
	 * @return mixed The instance
	 */
	
	private function _singleton($property, $object) {
		if(property_exists($this, $property) && $this->$property !== null) {
			return $this->property;
		}
		
		$this->$property = $object;
		return $this->$property;
	}
	
	/**
	 * Generate a get router.
	 * 
	 * @param string $pattern The requested uri pattern
	 * @param mixed $callback A function or a class method
	 * @param bool $caseSensitive (default false)
	 */
	
	public function get($pattern, $callback = null, $caseSensitive = false) {
		$this->route->get($pattern, $callback, $caseSensitive);
	}
	
	/**
	 * Generate a post router.
	 * 
	 * @param string $pattern The requested uri pattern
	 * @param mixed $callback A function or a class method
	 * @param bool $caseSensitive (default false)
	 */
	
	public function post($pattern, $callback = null, $caseSensitive = false) {
		$this->route->post($pattern, $callback, $caseSensitive);
	}
	
	/**
	 * Generate a put router.
	 * 
	 * @param string $pattern The requested uri pattern
	 * @param mixed $callback A function or a class method
	 * @param bool $caseSensitive (default false)
	 */
	
	public function put($pattern, $callback = null, $caseSensitive = false) {
		$this->route->put($pattern, $callback, $caseSensitive);
	}
	
	/**
	 * Generate a delete router.
	 * 
	 * @param string $pattern The requested uri pattern
	 * @param mixed $callback A function or a class method
	 * @param bool $caseSensitive (default false)
	 */
	
	public function delete($pattern, $callback = null, $caseSensitive = false) {
		$this->route->delete($pattern, $callback, $caseSensitive);
	}
	
	/**
	 * Generate a delete router.
	 * 
	 * @param string $pattern The requested uri pattern
	 * @param mixed $callback A function or a class method
	 * @param bool $caseSensitive (default false)
	 */
	
	public function patch($pattern, $callback = null, $caseSensitive = false) {
		$this->route->patch($pattern, $callback, $caseSensitive);
	}
	
	/**
	 * Responses to any matched HTTP request method.
	 * 
	 * @param array $methods Valid methods for this uri pattern
	 * @param string $pattern The requested uri pattern
	 * @param mixed $callback A function or a class method
	 * @param bool $caseSensitive (default false)
	 */
	 
	public function both(array $methods, $pattern, $callback = null, $caseSensitive = false) {
		$this->route->both($methods, $pattern, $callback, $caseSensitive);
	}
	
	/**
	 * Responses to any HTTP method.
	 * 
	 * @param string $pattern The requested uri pattern
	 * @param mixed $callback A function or a class method
	 * @param bool $caseSensitive (default false)
	 */
	
	public function any($pattern, $callback = null, $caseSensitive = false) {
		$this->route->any($pattern, $callback, $caseSensitive);
	}
	
	/**
	 * Supporting overload for create instances
	 * of required framework components.
	 * 
	 * @param string $property The component to create
	 * @return mixed The instance
	 */
	
	public function __get($property) {
		switch($property) {
			case 'session':
				return $this->_singleton($property, new Components\Session());
			case 'view':
				return $this->_singleton($property, new View\View());
			case 'url':
				return $this->_singleton($property, new Http\Url());
			case 'env':
				return $this->_singleton($property, new Http\Environment());
			case 'header':
				return $this->_singleton($property, new Http\Header());
			case 'request':
				return $this->_singleton($property, new Http\Request());
			case 'log':
				return $this->_singleton($property, new Components\Logger());
		}
	}
	
}