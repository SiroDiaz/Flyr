<?php

if (!defined('FLYR')) exit('No direct script access allowed');

/**
 * HTTP security headers
 * prevent to be integrated inside iframes, frames, etc.
 * prevent sniffing atacks
 * prevent xss attacks
 */

// header('Access-Control-Allow-Origin: *');
// header('Access-Control-Allow-Methods: POST, GET');
// header('x-frame-options: SAMEORIGIN');
// header('x-ua-compatible:IE=edge,chrome=1');
// header('x-xss-protection:1; mode=block');
// header('x-Content-Type-Options: nosniff');
// header_remove('X-Powered-By');

/**
 * set the default internal encoding(UTF-8 by default)
 * you can change it in config/app_config
 * INTERNAL_ENCODING constant
 */

if(function_exists('mb_internal_encoding')) {
    mb_internal_encoding(INTERNAL_ENCODING);
}

/**
 * php.ini configuration by default
 * NOTE: Not all servers allow you change that config
 * 		 options. So maybe 
 */

ini_set('session.name', SESSION_NAME);
// ini_set('session.save_path', SESSION_DIR);
ini_set('expose_php', 'off');
ini_set('session.use_trans_sid', '0');
ini_set('session.hash_function', 'sha512');
ini_set('session.use_only_cookies', '1');
ini_set('session.upload_progress.enabled', '1');
ini_set('session.upload_progress.prefix', 'upload_progress_');
ini_set('session.upload_progress.cleanup', '1');
ini_set('session.upload_progress.name', 'PHP_SESSION_UPLOAD_PROGRESS');
ini_set('session.upload_progress.freq', '1%');
ini_set('session.upload_progress.min_freq', '1');
