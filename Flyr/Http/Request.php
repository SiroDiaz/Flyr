<?php namespace Flyr\Http;

class Request {
	
	const GET_METHOD = 'GET';
	const POST_METHOD = 'POST';
	const PUT_METHOD = 'PUT';
	const DELETE_METHOD = 'DELETE';
	const PATCH_METHOD = 'PATCH';
	
	/**
	 * The method used for the request.
	 * 
	 * @var string
	 */
	
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
	
	/**
	 * Checks if it is a PATCH request.
	 * 
	 * @return bool
	 */
	
	public function isPatch() {
		return $this->getMethod() === self::PATCH_METHOD;
	}
	
	/**
	 * Checks if the request has been used via AJAX.
	 * Sometimes it can not work properly by server problems
	 * but most JavaScript frameworks send 'X-Requested-With'
	 * header tag containing 'XMLHttpRequest'.
	 * 
	 * @return bool
	 */
	
	public function isAjax() {
		$header = new Header();
		$headers = $header->get();
		return isset($headers['X-Requested-With']) && $headers['X-Requested-With'] === 'XMLHttpRequest';
	}
	
	/**
	 * Fetch GET data.
	 * Returns the query string from the URL
	 * and converts it to an array.
	 * 
	 * @return array The key:value from URL query
	 */
	
	public function getData() {
		$data = [];
		$url = new Url();
		
		if(function_exists('mb_parse_str')) {
			return mb_parse_str($url->getQuery(), $data);
		} else {
			return parse_str($url->getQuery(), $data);
		}
	}
	
	/**
	 * Fetch POST data.
	 * Return the $_POST data and converts it to an array.
	 * 
	 * @return array The key:value from php input
	 */
	
	public function postData() {
		$input = file_get_contents('php://input');
		$outputData = [];
		
		if(function_exists('mb_parse_str')) {
			mb_parse_str($input, $outputData);
		} else {
			parse_str($input, $outputData);
		}
		
		return $outputData;
	}
	
	/**
	 * Fetch PUT data.
	 * Return data incoming from PHP input as
	 * an array.
	 * 
	 * @return array
	 */
	
	public function putData() {
		return $this->postData();
	}
	
	/**
	 * Fetch DELETE data.
	 * Return data incoming from PHP input as
	 * an array.
	 * 
	 * @return array
	 */
	
	public function deleteData() {
		return $this->postData();
	}
}
