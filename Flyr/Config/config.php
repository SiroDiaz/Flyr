<?php

/*
  --------------------------------------------------------------------------
   Application Debug Mode
  --------------------------------------------------------------------------
 
  When your application is in debug mode, detailed error messages with
  stack traces will be shown on every error that occurs within your
  application. If disabled, a simple generic error page is shown.
 
*/

# app key. modify it for secure reasons
define('FLYR', sha1('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'));

if((float)PHP_VERSION < 5.4) exit('You must install PHP >= 5.4 version');

/*
 --------------------------------------------------------------------------
  Application Logging Mode
 --------------------------------------------------------------------------
 
  When your application is in debug mode, detailed error messages with
  stack traces will be shown on every error that occurs within your
  application. If disabled, a simple generic error page is shown.
 
*/

define('LOG_PATH', __DIR__ .'/../../app/storage/logs/');

/*
 --------------------------------------------------------------------------
  Application Debug Mode
 --------------------------------------------------------------------------
 
  When your application is in debug mode, detailed error messages with
  stack traces will be shown on every error that occurs within your
  application. If disabled, a simple generic error page is shown.
 
*/

define('DEBUG', true);

if(DEBUG){
	error_reporting(E_STRICT | E_ALL);
}else{
	error_reporting(0);
}

/*
 --------------------------------------------------------------------------
  View and Template system
 --------------------------------------------------------------------------
 
  Here is specified where is ubicated the templates and
  the cache folder to be saved
 
*/

define('TEMPLATE_DIR', __DIR__ .'/../../app/views/');
define('TEMPLATE_CACHE_DIR', __DIR__ .'/../../app/storage/cache/');

/*
 --------------------------------------------------------------------------
  Application Controllers
 --------------------------------------------------------------------------
 
  If your application need make use of controllers instead of closure
  functions you must place your controllers in the following path.
 
*/

define('CONTROLLER_PATH', __DIR__ .'/../../app/controllers/');

/*
 --------------------------------------------------------------------------
  Application Sessions
 --------------------------------------------------------------------------
 
  If your application need make use of sessions you must enabled it.
  By default it is set on enable(true) and also has a default temporary
  dir to save it on disk.
 
*/

# You can change the session name
define('SESSION_NAME', 'FLYRSSID');

/*
 --------------------------------------------------------------------------
  Application Secure Cookies
 --------------------------------------------------------------------------
 
  If your application need make use of secure cookies to transactions and
  others uses like a shopping page it is recommend setting a key up and use
  an algorithm to make sure that the hickjack couldn't get the key.
  By default it use md5 algotithm, you can use others but the generated key
  CAN NOT be longer than 32 characters. If you don't want to make use of
  any algorithm you can remove it(NOT RECOMMENDED) but the password must not
  be longer than 32 characters.
 
*/

# yoy MUST modify the secure key and also, if you want, the hash algorithm
define('COOKIE_KEY', md5('KEY'));


/*
 --------------------------------------------------------------------------
  Languages
 --------------------------------------------------------------------------
 
  The path to language files. You can make a multilanguage app using different
  files to refering to the language that the user preffer.
 
*/

define('LANGS_PATH', __DIR__ .'/../../app/lang/');

/*
 --------------------------------------------------------------------------
  Helpers
 --------------------------------------------------------------------------
 
  The path to the helpers files. Helpers adds functionality to your
  app design implementing own classes or functions.
  So it must be sorted by type of data you manipulate.
 
*/

define('HELPERS_PATH', __DIR__ .'/../../app/helpers/');

/*
 --------------------------------------------------------------------------
  Application Internal Encoding
 --------------------------------------------------------------------------
 
  Here you may specify the default encoding for your application, which
  will be used by the PHP date and date-time functions.
 
*/

define('INTERNAL_ENCODING', 'UTF-8');
