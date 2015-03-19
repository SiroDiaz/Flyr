<?php namespace Flyr\Http;

class Cookie {
	
	private $key;
	 
	public function __construct() {
		$this->key = COOKIE_KEY;
	}
	
	/**
	 * Create a new cookie with default parameters.
	 * 
	 * @param string $key The cookie key
	 * @param mixed $value The value to store
	 * @param mixed $options An array of options or a default array
	 * @return bool true if the cookie is defined
	 */
	
	public function create($key, $value, $options = null) {
		if($options === null || (is_array($options) && count($options) < 4)) {
			if(is_array($options)) {
				$options = array_merge(array('expire' => (time() + 3600), 'httpOnly' => true, 'domain' => '', 'path' => '/'), $options);
			} else {
				$options = array('expire' => (time() + 3600), 'httpOnly' => true, 'domain' => '', 'path' => '/');
			}
		}
		
		if(is_string($options['expire']) && !empty($options['expire'])) {
			$options['expire'] = strtotime($options['expire']);
		}

		return setcookie(
				$key, $this->encryptCookie($value),
				$options['expire'], $options['path'], $options['domain'], isset($_SERVER['HTTPS']), $options['httpOnly']
		);
	}
	
	/**
	 * Encrypts the cookie value.
	 * 
	 * @param string|mixed $val The value to encrypt
	 * @return string The value encrypted
	 */
	 
	private function encryptCookie($val) {
		if(function_exists('mcrypt_encrypt')) {
			$td = mcrypt_module_open(MCRYPT_RIJNDAEL_256, '', MCRYPT_MODE_CBC, '');
			$iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_DEV_URANDOM );
			
			mcrypt_generic_init($td, $this->key, $iv);
			$encryptedDataBin = mcrypt_generic($td, $val);
			mcrypt_generic_deinit($td);
			mcrypt_module_close($td);
			$encryptedDataHex = bin2hex($iv).bin2hex($encryptedDataBin);
			
			return $encryptedDataHex;
		}
		
		return $val;
	}
	
	/**
	 * decrypt the cookie value.
	 * 
	 * @param string $val The encryptedd value
	 * @return string The value
	 */
	
	private function decryptCookie($val) {
		if(function_exists('mcrypt_encrypt')) {
			$td = mcrypt_module_open(MCRYPT_RIJNDAEL_256, '', MCRYPT_MODE_CBC, '');
			$ivSizeHex = mcrypt_enc_get_iv_size($td) * 2;
			$iv = pack("H*", substr($val, 0, $ivSizeHex));
			$encryptedDataBin = pack("H*", substr($val, $ivSizeHex));
			
			mcrypt_generic_init($td, $this->key, $iv);
			$decrypted = mdecrypt_generic($td, $encryptedDataBin);
			mcrypt_generic_deinit($td);
			mcrypt_module_close($td);
			
			return $decrypted;
		}
		
		return $val;
	}
	
	/**
	 * Obtains the value from an cookie id.
	 * 
	 * @return mixed null if cookie doesn't exists
	 */
	
	public function get($key) {
		if (isset($_COOKIE[$key])) {
			return $this->decryptCookie($_COOKIE[$key]);
		}
		
		return null;
	}
	
	/**
	 * Updates the cookie value or creates it
	 * if the cookie doesn't exists.
	 * 
	 * @param string $key The cookie index
	 * @param mixed $value The elemento to save
	 */
	 
	public function set($key, $value) {
		if(isset($_COOKIE[$key])) {
			$_COOKIE[$key] = $this->encryptCookie($value);
		} else {
			$this->create($key, $value);
		}
	}
	
	/**
	 * Delete a cookie by key.
	 * 
	 * @param string $key The cookie key
	 */
	
	public function delete($key) {
		unset($_COOKIE[$key]);
		setcookie($key, null, -1, '/');
	}
	
	/**
	 * Delete all cookies.
	 */
	 
	public function deleteAll() {
		foreach($_COOKIE as $key => &$val) {
			$this->delete($key);
		}
		unset($_COOKIE);
	}
}
