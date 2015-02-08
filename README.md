				_______________               
				___  ____/__  /____  _________
				__  /_   __  /__  / / /_  ___/
				_  __/   _  / _  /_/ /_  /    
				/_/      /_/  _\__, / /_/     
				              /____/          


# Flyr: The PHP micro Framework for develop fast REST applications.

**Flyr** is a micro famework designed to create REST applications easily and
also to be the skeleton for develop an application in which you want to install your
own libraries or from third party. Also it tries to apport a MVC model to organize your code
and apply design patterns. Flyr includes some third party libraries to make
easier the development of its components as [PHPMailer](https://github.com/PHPMailer/PHPMailer),
[Twig](https://github.com/twigphp/Twig). I suggest you to use a real ORM like Doctrine or also you
can use Propel which have a great documentation.

**Please** if you find an error in the documentation you can modify it or warm me.

### **Requirements**
* PHP 5.4.0 or newer
* Composer
* mcrypt(recomended)

### **Download and install**

You can download Flyr from the .zip file or using Composer running this command

	$ composer create-project "flyr/flyr":"0.1.*@dev"

### **Simple tutorial**

#### **Routes and request methods**

Flyr API is easy. You must know a short list of methods and then you can extend the API as many as you
want. First of all you are going to know how create routes in your **index.php** file, located in
the app folder. Routes are easy and simple in the current version. The following route patterns are correct:
/, /new, /user/:id, /post/:id/:slug, etc. When you put two dots(:) after the slash you are telling to Flyr
that it is a parameter and it could be any value you want.
For example, the URI /post/1234/any-post-title matches with the last pattern, /post/:id/:slug.

Now you need catch the pattern, but how?. This is easy. HTTP has the 4 most important request methods(there are more than 4 methods
but for the current version Flyr does not add support for all the rest), **GET**, **POST**, **PUT** and **DELETE**. You can use
the get, post, put and delete method to receive the response. For example, you can use in your **index.php** this methods
like you can see:

```php
<?php 	// index.php

// config and autload included files...

$app = new \Flyr\Flyr();
$app->session->start();

// gets /post/1234/any-post-title for example
$app->get('/post/:id/:slug', function($id, $slug) {
	echo "You are in the post number $id called $slug";
});

// catchs a post request and the title and text parameters
$app->post('/post', function($title, $text));
// also put and delete
```

If you can catch 404 pages and set a default web page or response you can set **at the end** of the index.php a route containing "*". See the following 

```php
<?php 	// index.php

// config and autload included files...

// all other routes to catch
// .
// .
// .
$app->get('*', function() {
	// do something right here
});
```

#### **Controllers**

As you can see, post, get, etc. receive two parameters, the URI and the callback function. The second parameter can be a function
callback as anonymous function or an string containing the class and method name as you do in Laravel. All classes must be stored in
**app/controllers**. Let's see an example:

```php
<?php 	// index.php

// config and autload included files...

$app = new \Flyr\Flyr();
$app->session->start();

$app->get('/post/:id/:slug', 'Test_Controller@index');

```

Your controller file and class name must be named **Test_Controller** and the method name **publication**, and, receive two parameters: $id and $slug.
This is a good practice because you are not generating all your code in only a unique file(index.php) and not only this, you are
structuring the code doing the code easily to readable and organized.
Now that i am explaining you about controllers, this is not all, look how to create an controller and read the comments.

```php
<?php 	// app/controllers/Test_Controller.php

class Test_Controller extends Flyr\Flyr {
	
	// construct method must be created
	public function __construct() {
		parent::construct();	// you must to call the parent constructor again
		// optionally you can load helpers, language files or models
		$this->load->helper('string_helper');
	}
	
	public function publication($id, $slug) {
		// do some here
	}
}
```

It is easy to create a controller(yes, it could be easier if all controllers does not inherit from Flyr, because it is overload
the environment and making a new Flyr instance but it has its own why. It could be removed in future versions. Do not care, This manual will be maintained) and
load it from the index.php.

Before know many Flyr things, it is important that you can use all the Flyr features inside anonymous functions without load a controller to access them.
For this case it is recommended use the reserved word **use**.

```php
<?php 	// index.php

// config and autload included files...

$app = new \Flyr\Flyr();
$app->session->start();

$app->get('/post/:id/:slug', function($id, $slug) use ($app) {
	$app->cookie->create('foo', 'bar');
	// some code right here...
});

```

### **API**

#### **Views**

You may waiting for this. Views... without it you only would use echo(maybe print) containing a large string but it is not the case. You have two methods to response with your HTML code but you can choose if you want to use regular PHP or Twig templates. Yes, Flyr come with support for both. The methods are render and JSON.
Templates are sent with the header response Transfer-Encoding chunked. All you need to know about routes is that all the templates(PHP and Twig) must be placed inside the folder **app/views/** (included the email templates).

If you need render PHP template it must end in **.php**, else, if you decide to do your HTML template with Twig the file must end in **.html** or **.twig**, whatever you want. Here you can see all forms to render a template(read all the comments, it explain what the code do):

```php
<?php 	// index.php

$app = new \Flyr\Flyr();
$app->session->start();

$app->get('/', function() use ($app) {
	// render header.php template and send it
	// to the explorer.
	$app->view->render('header.php');
	
	// save the template in a variable for then do something with it.
	$params = ['name' => 'Siro', 'country' => 'Spain'];
	$renderedTemplate = $app->view->render('index.twig.html', $params, true);
	echo $renderedTemplate;
});

```

Now we are going to analize the last call to render. Render can contain three parameters. The first one is the template name (you can also put $app->view->render('path/to/template.html') that finds template.html in app/views/path/to/). The second parameter is the associative array of data to pass to the template(see the following example). The third parameter is true by default and if you specify it setting it to false you can save the rendered template inside a variable to do something with the content.

A simple example with template would be like the following:

```php
<?php 	// app/views/template.php ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title><?= $title ?></title>
</head>
<body>
	<div>Name: <?= $name ?></div>
	<?php if($age > 0): ?>
	<div>Age: <?= $age ?></div>
	<?php else: ?>
	<div>Invalid age</div>
	<?php endif; ?>
</body>
</html>
```
```php
<?php // index.php
// required files
$app = new \Flyr\Flyr();
$app->session->start();

$app->get('/', 'App@index');
```
```php
<?php // app/controllers/App.php

class App extends Flyr\Flyr {
	public function __construct() {

	}
	
	public function index() {
		$this->view->render(
			'template.php',
			['title' => 'Index page', 'name' => 'Siro', 'age' => 100]
	}
}
```

#### **Cookies**

Flyr offers a simple API for interact with cookies, sessions and other components. Cookies have easy methods to remember like

* create($key, $value, $optionArray)
*  delete($key)
* deleteAll()
* set($key, $value)
* get($key)

The "most" difficult may be create. The two firsts parameters are simple, you must give a key to access to the value and the second one is the value to save. The third parameter is an array containing options for the cookie. You may want to set a custom expire time or set the domain and path to be accessed. You can use only expire time and all the other options are set by default for the current domain and only HTTP read option. Let's see an example:

```php
<?php 	// index.php

// config and autload included files...

$app = new \Flyr\Flyr();
$app->session->start();

$app->get('/', function() use ($app) {
	if($app->cookie->get('foo') !== null && $app->cookie->get('ex') !== null) {
		// simple for to create a cookie
		$app->cookie->create('foo', 'bar');
		// some code right here...
		// specifying options. The cookie will be deleted in 5 seconds
		$app->cookie->create('ex', uniqid(), ['expire' => (time() + 5)]);
	} else {
		$app->cookie->deleteAll();
	}
});
```

All the sessions are encrypet with RIJNDAEL_256(AES-256) if the extension mcrypt is installed in the system.

#### **Sessions**

Sometimes you need to store sensitive data in a cookie but it is not a good idea and maybe you need to store all this data in a session. Flyr offers a session API similar to the cookie API. The methods that offers are:

* set($key, $value)
* get($key)
* delete($key)
* deleteAll()

See this simple example:

```php
<?php 	// index.php

// config and autload included files...

$app = new \Flyr\Flyr();
$app->session->start();

$app->get('/', function() use ($app) {
	// creating a session
	$app->session->set('user_id', 123342);
	$app->session->set('user_id.name', 'Jhon Doe');	
});
```

#### **Mail**

Flyr also offer a simple API to send emails that has been built on top PHPMailer. It offers a method to send emails: send($template, $data, $from, $to, $subject = '', $attach = null). 
The template is stored in the folder app/views and the data are all parameters required to render the template to be sent. From and to are arrays containing one or two keys, the "name" and the "email" key. Name key is optional.

Before make an example with the mail API **you must configure the email_config.php** file placed in Flyr/Config/. 

```php
<?php
return array(
	'server' => 'smtp.gmail.com', // SMTP server name
	'port' => 465,  // Port number
	'email' => 'your@email.com',  // Your email address
	'password' => 'place your email password here',  // Your password
	'charset' => 'UTF-8'  // The encoding used to send emails 
);
```

Afterwards you can send emails. See the following example:

```php
<?php 	// index.php

// config and autload included files...

$app = new \Flyr\Flyr();
$app->session->start();

// You can send a POST request with curl
$app->post('/', function() use ($app) {
	$app->mail->send(
		'index.php',
		['slogan' => 'Siro Rules!'],
		['email' => 'myemail@gmail.com'],
		['email' => 'friendemail@yahoo.com', 'name' => 'Fred'],
		'Tema casual'
	);
});
```

It is so simple to send an email with this function but you can also use other methods like addWordWrap to limit the maximum characters per line.

#### **Logging**

Other Flyr aspect is simple logging component. You can use logging to get alerts from source code where you want to obtain information and *"rate"* them with different error levels. Then you can read all this logs in the folder **app/storage/logs/** that ared sorted by date in descendant order. Logs files are named by year-month-day format. For example flyr-2015-02-06.log. Different log levels can be used with all this methods:

* logWarning($msg)
* logInfo($msg)
* logDebug($msg)
* logError($msg)

The parameter *"$msg"* can be an Exception thrown in a try/catch statement or a simple string message. This example log messages using different ways.

```php
<?php	// index.php

// config and autload included files...

$app = new \Flyr\Flyr();
$app->session->start();

// first example
$app->get('/', function() use ($app) {
	if($app->cookie->get('user') === null) {
		$app->cookie->create(
			'user',
			mt_rand(),
			['expire' => (time() + 86400)]
		);
		// thow a info log level
		$app->log->logInfo('Another visit to the index page');
	}
});

// second example
$app->get('/division', function() use ($app) {
	$a = 2;
	$b = 0;
	try {
		if($b === 0) {
			throw new Exception('You can not divide by zero!');
		}

		$c = $a / $b;
	} catch(Exception $e) {
		$app->log->logWarning($e);
	}
});
```

After run both GET requests, a log message will be created in your current date log file and the message will look like this:

```json
{
    "errlevel": "Info",
    "message": "Another visit to the index page",
    "time": "2015-02-06 19:40:27"
}
{
    "errlevel": "Warning",
    "errdate": "2015-02-06 19:40:53",
    "message": "You can not divide by zero!",
    "code": 0,
    "trace": "#0 C:\\xampp\\htdocs\\Flyr\\Route.php(352): {closure}()\n#1 C:\\xampp\\htdocs\\Flyr\\Route.php(152): Flyr\\Route->loadCallback(Object(Closure), Array)\n#2 C:\\xampp\\htdocs\\Flyr\\Flyr.php(40): Flyr\\Route->get('\/division', Object(Closure))\n#3 C:\\xampp\\htdocs\\index.php(69): Flyr\\Flyr->get('\/division', Object(Closure))\n#4 {main}",
    "file": "C:\\xampp\\htdocs\\index.php",
    "line": 32
}
```

Also, you can send a log message to your email. How can i do it? It is simple using the method sendEmail($template, $from, $to, $subject). This is similar that send an email using the *send* method from mail component.

#### **Loader**

Other important object is the Flyr loader. You can load helpers and language files.
helpers are just a files containing functions or classes to solve a specific group of problems. For example, you can create a file called String_Helper.php that has some functions to manipulate strings.

```php
<?php	// app/helpers/String_Helper.php
namespace Helpers\Strings;

function capitalize($str) {
	if(!is_string($str) || empty($str)) {
		return $str;
	}

	return (strtoupper(substr($str, 0, 1)) . substr($str, 1, strlen($str) - 1));
}

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
// more code...
```
```php
<?php	// index.php
// config and autload included files...

$app = new \Flyr\Flyr();
$app->session->start();

$app->get('/', 'My_Controller@index');
```

```php
<?php	// app/controllers/My_Controller.php

class My_Controller extends Flyr\Flyr {
	public function __construct() {
		parent::__construct();
		// load the helper in the construct function to access it from any method
		$this->load->helper('String_Helper');
	}

	public function index() {
		echo Helpers\Strings\capitalize('hello');
		echo Helpers\Strings\gitanize('goodbye');
	}
}
```

In this example you have seen how to create a simple helper for manipulate strings. Using *namespaces* is a convention to avoid errors or reuse a defined function or class. Also it is good use namespaces for a better code organization. Another important feature is the lang($files, $lang) method. The first parameter is the file name(you can set an array containing the multiple files) and the second parameter is the language.
How can i organize languages? this is simple. You must save all files inside the folder *app/lang* and inside this folder create subfolders named as the language them contain. For example *app/lang/en*(for English language), *app/lang/es* (for Spanish) and more...
Let's how to create a language file.

```php
<?php	// app/lang/es/days.php

return [
	'mon' => 'lunes',
	'tue' => 'martes',
	'wed' => 'miércoles',
	'thu' => 'jueves',
	'fri' => 'viernes',
	'sat', => 'sábado',
	'sun', => 'domingo'
];
```

```php
<?php	// index.php
// config and autload included files...

$app = new \Flyr\Flyr();
$app->session->start();

$app->get('/', function() use ($app) {
	$lang = $app->load->lang('days', 'es');
	var_dump($lang);    // you will se an array with key => value format
});
```

#### **Header**

Maybe you want to manipule the HTTP response header in any page. You can have access to header object and make use of this methods:

* set(array $headers)
* remove($header)
* getCode()
* send($statusCode)
* get()

See the following examples using header object.

```php
<?php	// index.php
// config and autload included files...

$app = new \Flyr\Flyr();
$app->session->start();

$app->get('/', function() use ($app) {
	$app->header->set([
		'Cache-Control' => 'no-cache',
		'x-frame-options' => 'DENY',
		'x-xss-protection' => '1; mode=block',
		'x-Content-Type-Options' => 'nosniff',
		'x-ua-compatible' => 'IE=edge,chrome=1'
	]);
});

$app->get('/redirect/:url', function($url) use ($app) {
	$app->header->redirect("http://$url");
});
```

And this is all for the moment. Flyr will continue growing as a MVC framework thought-out. Rigth now Flyr is a micro-framework used to be your app skeleton in PHP.
Thank you for read this short documentation and also for use Flyr.
