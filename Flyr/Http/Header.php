<?php namespace Flyr\Http;

class Header {
	
	/**
	 * Send a custom HTTP status code.
	 */
	 
	public function status($code) {
		http_response_code($code);
	}
	
	/**
	 * Get the HTTP response code.
	 * 
	 * @return int The HTTP code
	 */
	
	public function getCode() {
		return http_response_code();
	}
	
	/**
	 * Get all the HTTP headers.
	 * 
	 * @return array The HTTP header
	 */
	
	public function get() {
		return headers_list();
	}
	
	public function lastModified($timestamp) {
		header('Last-Modified: '. date(DATE_RFC1123, $timestamp));
		header('If-Modified-Since: '. date(DATE_RFC1123, $timestamp));
	}
	
	/**
	 * Redirects to the given URL.
	 * 
	 * @param string $url The URL
	 */
	
	public function redirect($url) {
		header("Location: $url");
	}
	
	/**
	 * Set the HTTP headers.
	 * 
	 * @param array $headers A pair of key/value headers configuration
	 * @return object null if $headers is not an array
	 */
	
	public function set(array $headers) {
		if(!is_array($headers)) {
			return null;
		}
		
		foreach($headers as $header => &$config) {
			header($header .":". $config);
		}
	}
	
	/**
	 * Remove HTTP header information.
	 * 
	 * @param mixed $headers The header to remove
	 * @return object null if $headers is not an array or a string
	 */
	
	public function remove($headers) {
		if(!is_array($headers) && !is_string($headers)) {
			return null;
		}
		
		if(is_array($headers)) {
			foreach($headers as $header) {
				header_remove($header);
			}
		} else {
			header_remove($headers);
		}
	}
}
