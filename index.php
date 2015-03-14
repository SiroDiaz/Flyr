<?php

/*
|--------------------------------------------------------------------------
| Application starter
|--------------------------------------------------------------------------
|
| Here is where all depencencies and core application are loaded.
|
*/

require __DIR__ .'/Flyr/Config/config.php';
require __DIR__ .'/Flyr/Config/php_config.php';

require 'vendor/autoload.php';

require 'Flyr/Flyr.php';

$app = new \Flyr\Flyr();
$app->session->start();

$app->get('/', 'Welcome_Controller@index');

$app->post('/', function($id, $val) use ($app) {
	echo "$id $val";
});

$app->delete('/', function($id, $val) use ($app) {
	echo "$id and $val";
});

$app->any('*', function() use ($app) {
	echo "404, page not found";
});
