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

$app->post('/', function() use ($app) {
	echo "You have used a post method!";
});

$app->both(['GET', 'POST'], '/both', 'Welcome_Controller@index');

$app->put('/', function() use ($app) {
	echo "You have used a put method!";
});

$app->delete('/', function() use ($app) {
	echo "You have used a delete method!";
});

$app->any('*', function() use ($app) {
	echo "404, page not found";
});
