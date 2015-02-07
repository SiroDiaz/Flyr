<?php

/*
|--------------------------------------------------------------------------
| Application Debug Mode
|--------------------------------------------------------------------------
|
| When your application is in debug mode, detailed error messages with
| stack traces will be shown on every error that occurs within your
| application. If disabled, a simple generic error page is shown.
|
*/

# app key. modify it for secure reasons
define('FLYR', sha1('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'));

if((float)PHP_VERSION < 5.4) exit('You must install PHP >= 5.4 version');

/*
|--------------------------------------------------------------------------
| Application Logging Mode
|--------------------------------------------------------------------------
|
| When your application is in debug mode, detailed error messages with
| stack traces will be shown on every error that occurs within your
| application. If disabled, a simple generic error page is shown.
|
*/

define('LOG', true);

# enable the log path if user activate the logging system

if(LOG === true){
	define('LOG_PATH', __DIR__ .'/../../app/storage/logs/');
}

/*
|--------------------------------------------------------------------------
| Application Debug Mode
|--------------------------------------------------------------------------
|
| When your application is in debug mode, detailed error messages with
| stack traces will be shown on every error that occurs within your
| application. If disabled, a simple generic error page is shown.
|
*/

define('DEBUG', true);

if(DEBUG){
	error_reporting(E_STRICT | E_ALL);
}else{
	error_reporting(0);
}

/*
|--------------------------------------------------------------------------
| Application Core Path
|--------------------------------------------------------------------------
|
| When you want to extend the framework functionality you must write your
| code inside the CORE_PATH directory. The following you must do when add new
| features is add to the libraries.php file the class name and the path to be
| auto loaded.
|
*/

define('CORE_PATH', __DIR__ .'/../../app/core/');

/*
|--------------------------------------------------------------------------
| View and Template system
|--------------------------------------------------------------------------
|
| Here is specified where is ubicated the templates and
| the cache folder to be saved
|
*/

define('TEMPLATE_DIR', __DIR__ .'/../../app/views/');
define('TEMPLATE_CACHE_DIR', __DIR__ .'/../../app/storage/cache/');

/*
|--------------------------------------------------------------------------
| Application Controllers
|--------------------------------------------------------------------------
|
| If your application need make use of controllers instead of closure
| functions you must place your controllers in the following path.
|
*/

define('CONTROLLER_PATH', __DIR__ .'/../../app/controllers/');


/*
|--------------------------------------------------------------------------
| Application Sessions
|--------------------------------------------------------------------------
|
| If your application need make use of sessions you must enabled it.
| By default it is set on enable(true) and also has a default temporary
| dir to save it on disk.
|
*/

# You can change the session name
define('SESSION_NAME', 'FLYRSSID');
# uncomment the following line if you want to save sessions in the storage folder
// define('SESSION_DIR', __DIR__ .'/../app/storage/sessions/tmp');


/*
|--------------------------------------------------------------------------
| Application Secure Cookies
|--------------------------------------------------------------------------
|
| If your application need make use of secure cookies to transactions and
| others uses like a shopping page it is recommend setting a key up and use
| an algorithm to make sure that the hickjack couldn't get the key.
| By default it use md5 algotithm, you can use others but the generated key
| CAN NOT be longer than 32 characters. If you don't want to make use of
| any algorithm you can remove it(NOT RECOMMENDED) but the password must not
| be longer than 32 characters.
|
*/

# yoy MUST modify the secure key
define('COOKIE_KEY', md5('KEY'));


/*
|--------------------------------------------------------------------------
| Languages
|--------------------------------------------------------------------------
|
| The path to language files. You can make a multilanguage app using different
| files to refering to the language that the user preffer.
|
*/

define('LANGS_PATH', __DIR__ .'/../../app/lang/');

/*
|--------------------------------------------------------------------------
| Helpers
|--------------------------------------------------------------------------
|
| The path to the helpers files. Helpers adds functionality to your
| app design implementing own classes or functions.
| So it must be sorted by type of data you manipulate.
|
*/


define('HELPERS_PATH', __DIR__ .'/../../app/helpers/');


/*
|--------------------------------------------------------------------------
| Application Internal Encoding
|--------------------------------------------------------------------------
|
| Here you may specify the default encoding for your application, which
| will be used by the PHP date and date-time functions.
|
*/

define('INTERNAL_ENCODING', 'UTF-8');

/*
|--------------------------------------------------------------------------
| Application URL (Deprecated)
|--------------------------------------------------------------------------
|
| This URL is used by the framework to properly generate URLs when using
| routes and you place your app in a different place that the root app.
| By the way, you can also have multiple projects in your web server.
| You should set this to the root of your application.
|
*/

# IMPORTANT! do not put a slash at the end of the BASEPATH.
# You can cause an error
# define('BASEPATH', 'http://localhost/tweetbeeg');


/*
|--------------------------------------------------------------------------
| Application Update Mode
|--------------------------------------------------------------------------
|
| When your application is been updated in realtime you could want to
| so to the user a message telling why he can make use of your
| application. If disabled, a simple generic message is shown.
|
*/

define('ACTUALIZE', false);
define('ACTUALIZE_PAGE', '');

if(ACTUALIZE){
	exit('page under update. Please wait a momment');
}

/*
|--------------------------------------------------------------------------
| Application Timezone
|--------------------------------------------------------------------------
|
| Here you may specify the default timezone for your application, which
| will be used by the PHP date and date-time functions. We have gone
| ahead and set this to a sensible default for you out of the box.
|
*/

define('TIMEZONE', 'UTC');
