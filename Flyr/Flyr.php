<?php namespace Flyr;

class Flyr {
	
	public $header;
	public $env;
	public $cookie;
	public $load;
	public $log;
	public $mail;
	private $route;
	public $session;
	public $url;
	public $view;
	
	/**
	 * Instance all core classes.
	 */
	
	public function __construct() {
		$this->header = new Http\Header();
		$this->env = new Http\Environment();
		$this->cookie = new Http\Cookie();
		$this->log = new Components\Logger();
		$this->load = new Loader();
		$this->mail = new Mail();
		$this->route = new Route();
		$this->session = new Components\Session();
		$this->url = new Http\Url();
		$this->view = new View();
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
	 * Get access to request class for getting
	 * access to the demanded request.
	 * 
	 * @return object Request class instance
	 */
	
	public function request() {
		return new Http\Request();
	}
	
	
}