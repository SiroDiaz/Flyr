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
	 */
	
	public function get($pattern, $callback, $caseSensitive = false) {
		$this->route->get($pattern, $callback, $caseSensitive);
	}
	
	/**
	 * Generate a post router.
	 */
	
	public function post($pattern, $callback, $caseSensitive = false) {
		$this->route->post($pattern, $callback, $caseSensitive);
	}
	
	/**
	 * Generate a put router.
	 */
	
	public function put($pattern, $callback, $caseSensitive = false) {
		$this->route->put($pattern, $callback, $caseSensitive);
	}
	
	/**
	 * Generate a delete router.
	 */
	
	public function delete($pattern, $callback, $caseSensitive = false) {
		$this->route->delete($pattern, $callback, $caseSensitive);
	}
	
	/**
	 * Responses to any HTTP method.
	 */
	
	public function any($pattern, $callback, $caseSensitive = false) {
		$this->route->any($pattern, $callback, $caseSensitive);
	}
	
	
}