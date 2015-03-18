<?php namespace Flyr\Http;

class Request {
	
	const GET_METHOD = 'GET';
	const POST_METHOD = 'POST';
	const PUT_METHOD = 'PUT';
	const DELETE_METHOD = 'DELETE';
	
	protected $method;
	
	public function __construct() {
		$this->_setMethod();
	}
	
	/**
	 * Set the request method that is used.
	 */
	
	private function _setMethod() {
		$this->method = strtoupper(getenv('REQUEST_METHOD'));
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
	 * Checks if it is a GET request.
	 * 
	 * @return bool
	 */
	 
	public function isGet() {
		return $this->getMethod() === self::GET_METHOD;
	}
	
	/**
	 * Checks if it is a POST request.
	 * 
	 * @return bool
	 */
	 
	public function isPost() {
		return $this->getMethod() === self::POST_METHOD;
	}
	
	/**
	 * Checks if it is a PUT request.
	 * 
	 * @return bool
	 */
	 
	public function isPut() {
		return $this->getMethod() === self::PUT_METHOD;
	}
	
	/**
	 * Checks if it is a DELETE request.
	 * 
	 * @return bool
	 */
	
	public function isDelete() {
		return $this->getMethod() === self::DELETE_METHOD;
	}
}
