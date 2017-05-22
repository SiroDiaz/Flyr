<?php namespace Flyr\Components;

class Session {
	
	/**
	 * Start the session and regenerate the session id
	 */
	 
	public function start() {
		session_start();
		session_regenerate_id(true);
	}	
	
	/**
	 * Returns the session value.
	 * 
	 * @param string $key The session key
	 * @return mixed
	 */
	 
	public function get($key) {
		if($_SESSION[$key] !== null) {
			return $_SESSION[$key];
		}
		
		return null;
	}
	
	/**
	 * Set a new session or update an existing session
	 * 
	 * @param string $key
	 * @param mixed $value
	 */
	 
	public function set($key, $value) {
		$_SESSION[$key] = $value;
	}
	
	/**
	 * Remove a sesion key and value.
	 * 
	 * @param string $key
	 */
	 
	public function delete($key) {
		if($this->get($key) !== null) {
			$_SESSION[$key] = null;
			unset($_SESSION[$key]); 
		}
	}
	
	/**
	 * Remove all session keys and its values.
	 */
	 
	public function deleteAll() {
		foreach($_SESSION as $key => $val) {
			$this->delete($key);
		}
	}
	
	/**
	 * Clear all sessions and close them
	 */
		
	public function close() {
		$this->deleteAll();
		session_destroy();
	}
}
