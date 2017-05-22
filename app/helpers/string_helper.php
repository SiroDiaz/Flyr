<?php namespace Helpers\Strings;

function gitanize($str) {
	if(!is_string($str) || empty($str)) {
		return $str;
	} 

	for($i = 0; $i < strlen($str); $i++) {
		if(($i % 2) === 0) {
			$str[$i] = strtoupper($str[$i]);
		} else {
			$str[$i] = strtolower($str[$i]);
		}
	}

	return $str;
}

function capitalize($str){
	if(!is_string($str) || empty($str)){
		return $str;
	}

	return (strtoupper(substr($str, 0, 1)) . substr($str, 1));
}

function e($html) {
    return htmlentities($html, ENT_QUOTES, "UTF-8", false);
}
