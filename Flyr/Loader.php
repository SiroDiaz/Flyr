<?php namespace Flyr;

class Loader {
	
	/**
	 * Loads helper/s file/s to the current scope.
	 * 
	 * @param mixed The helper to load
	 */
	
	public function helper($helpers) {
		if(is_array($helpers)) {
			foreach($helpers as $helper) {
				if(file_exists(HELPERS_PATH ."$helper.php")) {
					require_once HELPERS_PATH ."$helper.php";
				}
			}
		} else {
			if(file_exists(HELPERS_PATH ."$helpers.php")) {
				require_once HELPERS_PATH ."$helpers.php";
			}
		}
	}
	
	/**
	 * Loads a file or an array of files.
	 * 
	 * @param string $lang The language folder to load
	 * @param mixed $files the file/s to load in the controller
	 * @return array Contains all the listed phrases
	 */
	
	public function lang($files, $lang = 'en') {
		if(is_array($files)) {
			$langContent = [];
			foreach($files as $file) {
				if(file_exists(LANGS_PATH ."$lang/$file.php")) {
					$langContent = array_merge($langContent, require_once LANGS_PATH ."$lang/$file.php");
				}
			}
			
			return $langContent;
		} else {
			if(file_exists(LANGS_PATH ."$lang/$files.php")) {
				return require_once LANGS_PATH ."$lang/$files.php";
			}
		}
	}
	
	/**
	 * Still under-building
	 */
	
	public function model() {
		
	}
}
