<?php namespace Flyr\Components;

class Logger {
	const WARNING = 'Warning';
	const ERROR = 'Error';
	const INFO = 'Info';
	const DEBUG = 'Debug';
	
	private $properties = [];
	
	public function __construct() {}
	
	/**
	 *  Generate the log data to be registered.
	 * 
	 * @param mixed $properties The message container
	 * @param string $level The log level
	 */
	
	public function setLog($properties, $level) {
		// case for exceptions
		if($properties instanceof \Exception) {
			$this->properties = [
				'loglevel' => $level,
				'errdate' => date("Y-m-d H:i:s"),
				'message' => $properties->getMessage(),
				'code' => ($properties->getCode()) ? $properties->getCode() : 0,
				'trace' => $properties->getTraceAsString(),
				'file' => $properties->getFile(),
				'line' => $properties->getLine(),
			];
		} else {
			$this->properties = [
				'loglevel' => $level,
				'message' => $properties,
				'time' => date("Y-m-d H:i:s")
			];
		}
	}
	
	/**
	 * Returns log properties.
	 * 
	 * @return array
	 */
	 
	public function getProperties() {
		return $this->properties;
	}
	
	/**
	 * Returns the log level defined.
	 * 
	 * @return string
	 */
	 
	public function getLogLevel() {
		return $this->getProperties()['loglevel'];
	}
	
	/**
	 * Checks if the log file exists.
	 * 
	 * @return bool true if the file exists
	 */
	
	private function fileExists($file) {
		return (file_exists(LOG_PATH ."{$file}.log"));
	}
	
	/**
	 * Generate the file name and if it exists
	 * 
	 * @return object file handler
	 */
	
	private function getFileHandler() {
		$filePath = 'flyr-'. date("Y-m-d");
		if($this->fileExists($filePath)) {
			return fopen($filePath, 'a');
		}
		
		return fopen($filePath, 'w');
	}
	
	/**
	 * Save a warning log message inside a file.
	 * 
	 * @param mixed|string $message A message or Exception
	 */
	
	public function logWarning($message) {
		$this->save($message, self::WARNING);
	}
	
	/**
	 * Save an info log.
	 * 
	 * @param mixed|string $message
	 */
	
	public function logInfo($message) {
		$this->save($message, self::INFO);
	}
	
	/**
	 * Save a debug log.
	 * 
	 * @param mixed|string $message
	 */
	
	public function logDebug($message) {
		$this->save($message, self::DEBUG);
	}
	
	/**
	 * Save an error log.
	 * 
	 * @param mixed|string $message
	 */
	
	public function logError($message) {
		$this->save($message, self::ERROR);
	}
	
	/**
	 * Save the error data inside a log file
	 * as a JSON format and close the file
	 * 
	 * @param mixed $log Data to save or send
	 * @param string $level The Logging level
	 */
	
	private function save($log, $level) {
		$this->setLog($log, $level);
		$file = $this->getFilehandler();
		if(count($this->properties)) {
			fwrite($file, json_encode($this->properties, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) ."\n");
		}
		fclose($file);
	}
	
	/**
	 * Send an email with the log data.
	 * 
	 * @param string $template The view to render
	 * @param mixed $from
	 * @param mixed $to
	 * @param string $subject
	 */
	
	public function sendEmail($template, $from, $to, $subject) {
		$mail = new \Flyr\Mail();
		$mail->send($template,
			$this->properties,
			$from,
			$to,
			$subject
		);
	}
}
