<?php namespace Flyr;

if(!defined('FLYR')) exit('No direct script access allowed');

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
	
	public function get($pattern, $callback) {
		$this->route->get($pattern, $callback);
	}
	
	/**
	 * Generate a post router.
	 */
	
	public function post($pattern, $callback) {
		$this->route->post($pattern, $callback);
	}
	
	/**
	 * Generate a put router.
	 */
	
	public function put($pattern, $callback) {
		$this->route->put($pattern, $callback);
	}
	
	/**
	 * Generate a delete router.
	 */
	
	public function delete($pattern, $callback) {
		$this->route->delete($pattern, $callback);
	}
	
	/** Next version will add support for patch method
	
	public function patch($pattern, $callback = null) {
		$this->route->patch($pattern, $callback);
	}
	*/
	
}