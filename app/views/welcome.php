<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Welcome to Flyr</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="public/css/bootstrap.min.css">
	
	<!-- Optional theme -->
	<link rel="stylesheet" href="public/css/bootstrap-theme.min.css">
	
	<!-- Latest compiled and minified JavaScript -->
	<script src="public/js/bootstrap.min.js"></script>
	<style>
		#container
		{
			width: 900px;
			padding: 0;
			margin: 0 auto;
		}
	</style>
</head>
<body>
<div id="container">
	<div class="preview-container" style="left: 32px; width: 944px; height: 593px;">
						<div id="preview-contents" style="padding-left: 35px; padding-right: 35px; padding-bottom: 533px;">
							<div id="wmd-preview" class="preview-content"></div>
						<div id="wmd-preview-section-1657" class="wmd-preview-section preview-content">
	
	<pre><code>
		    _______________               
	            ___  ____/__  /____  _________
	            __  /_   __  /__  / / /_  ___/
	            _  __/   _  / _  /_/ /_  /    
	            /_/      /_/  _\__, / /_/     
	                          /____/          
	</code></pre>
	
	</div><div id="wmd-preview-section-191307" class="wmd-preview-section preview-content">
	
	<h1 id="flyr-the-php-micro-framework-for-develop-fast-rest-applications">Flyr: The PHP micro Framework for develop fast REST applications.</h1>
	
	<p><strong>Flyr</strong> is a micro famework designed to create REST applications easily and <br>
	also to be the skeleton for develop an application in which you want to install your <br>
	own libraries or from third party. Also it tries to apport a MVC model to organize your code <br>
	and apply design patterns. Flyr includes some third party libraries to make <br>
	easier the development of its components as <a href="https://github.com/PHPMailer/PHPMailer">PHPMailer</a>, <br>
	<a href="https://github.com/twigphp/Twig">Twig</a>. I suggest you to use a real ORM like Doctrine or also you <br>
	can use Propel which have a great documentation.</p>
	
	<p><strong>Please</strong> if you find an error in the documentation you can modify it or warm me.</p></div><div id="wmd-preview-section-364648" class="wmd-preview-section preview-content">
	
	<h3 id="requirements"><strong>Requirements</strong></h3>
	
	<ul>
	<li>PHP 5.4.0 or newer</li>
	<li>Composer</li>
	<li>mcrypt(recomended)</li>
	</ul>
	
	</div><div id="wmd-preview-section-364785" class="wmd-preview-section preview-content">
	
	<h3 id="download-and-install"><strong>Download and install</strong></h3>
	
	<p>You can download Flyr from the .zip file or using Composer running this command</p>
	
	<pre><code>$ composer require Flyr/Flyr
	</code></pre></div><div id="wmd-preview-section-364484" class="wmd-preview-section preview-content">
	
	<h3 id="simple-tutorial"><strong>Simple tutorial</strong></h3></div><div id="wmd-preview-section-100628" class="wmd-preview-section preview-content">
	
	<h4 id="routes-and-request-methods"><strong>Routes and request methods</strong></h4>
	
	<p>Flyr API is easy. You must know a short list of methods and then you can extend the API as many as you <br>
	want. First of all you are going to know how create routes in your <strong>index.php</strong> file, located in <br>
	the app folder. Routes are easy and simple in the current version. The following route patterns are correct: <br>
	/, /new, /user/:id, /post/:id/:slug, etc. When you put two dots(:) after the slash you are telling to Flyr <br>
	that it is a parameter and it could be any value you want. <br>
	For example, the URI /post/1234/any-post-title matches with the last pattern, /post/:id/:slug.</p>
	
	<p>Now you need catch the pattern, but how?. This is easy. HTTP has the 4 most important request methods(there are more than 4 methods <br>
	but for the current version Flyr does not add support for all the rest), <strong>GET</strong>, <strong>POST</strong>, <strong>PUT</strong> and <strong>DELETE</strong>. You can use <br>
	the get, post, put and delete method to receive the response. For example, you can use in your <strong>index.php</strong> this methods <br>
	like you can see:</p></div><div id="wmd-preview-section-27970" class="wmd-preview-section preview-content">
	
	<pre class="prettyprint"><code class="language-php hljs "><span class="hljs-preprocessor">&lt;?php</span>   <span class="hljs-comment">// index.php</span>
	
	<span class="hljs-comment">// config and autload included files...</span>
	
	<span class="hljs-variable">$app</span> = <span class="hljs-keyword">new</span> \Flyr\Flyr();
	<span class="hljs-variable">$app</span>-&gt;session-&gt;start();
	
	<span class="hljs-comment">// gets /post/1234/any-post-title for example</span>
	<span class="hljs-variable">$app</span>-&gt;get(<span class="hljs-string">'/post/:id/:slug'</span>, <span class="hljs-function"><span class="hljs-keyword">function</span><span class="hljs-params">(<span class="hljs-variable">$id</span>, <span class="hljs-variable">$slug</span>)</span> {</span>
	    <span class="hljs-keyword">echo</span> <span class="hljs-string">"You are in the post number $id called $slug"</span>;
	});
	
	<span class="hljs-comment">// catchs a post request and the title and text parameters</span>
	<span class="hljs-variable">$app</span>-&gt;post(<span class="hljs-string">'/post'</span>, <span class="hljs-function"><span class="hljs-keyword">function</span><span class="hljs-params">(<span class="hljs-variable">$title</span>, <span class="hljs-variable">$text</span>)</span>);</span>
	<span class="hljs-comment">// also put and delete</span></code></pre>
	
	<p>If you can catch 404 pages and set a default web page or response you can set <strong>at the end</strong> of the index.php a route containing “*”. See the following </p></div><div id="wmd-preview-section-15168" class="wmd-preview-section preview-content">
	
	<pre class="prettyprint"><code class="language-php hljs "><span class="hljs-preprocessor">&lt;?php</span>   <span class="hljs-comment">// index.php</span>
	
	<span class="hljs-comment">// config and autload included files...</span>
	
	<span class="hljs-comment">// all other routes to catch</span>
	<span class="hljs-comment">// .</span>
	<span class="hljs-comment">// .</span>
	<span class="hljs-comment">// .</span>
	<span class="hljs-variable">$app</span>-&gt;get(<span class="hljs-string">'*'</span>, <span class="hljs-function"><span class="hljs-keyword">function</span><span class="hljs-params">()</span> {</span>
	    <span class="hljs-comment">// do something right here</span>
	});</code></pre></div><div id="wmd-preview-section-100543" class="wmd-preview-section preview-content">
	
	<h4 id="controllers"><strong>Controllers</strong></h4>
	
	<p>As you can see, post, get, etc. receive two parameters, the URI and the callback function. The second parameter can be a function <br>
	callback as anonymous function or an string containing the class and method name as you do in Laravel. All classes must be stored in <br>
	<strong>app/controllers</strong>. Let’s see an example:</p></div><div id="wmd-preview-section-28243" class="wmd-preview-section preview-content">
	
	<pre class="prettyprint"><code class="language-php hljs "><span class="hljs-preprocessor">&lt;?php</span>   <span class="hljs-comment">// index.php</span>
	
	<span class="hljs-comment">// config and autload included files...</span>
	
	<span class="hljs-variable">$app</span> = <span class="hljs-keyword">new</span> \Flyr\Flyr();
	<span class="hljs-variable">$app</span>-&gt;session-&gt;start();
	
	<span class="hljs-variable">$app</span>-&gt;get(<span class="hljs-string">'/post/:id/:slug'</span>, <span class="hljs-string">'Test_Controller@index'</span>);
	</code></pre>
	
	<p>Your controller file and class name must be named <strong>Test_Controller</strong> and the method name <strong>publication</strong>, and, receive two parameters: <span>$</span>id and <span>$</span>slug. <br>
	This is a good practice because you are not generating all your code in only a unique file(index.php) and not only this, you are <br>
	structuring the code doing the code easily to readable and organized. <br>
	Now that i am explaining you about controllers, this is not all, look how to create an controller and read the comments.</p></div><div id="wmd-preview-section-28274" class="wmd-preview-section preview-content">
	
	<pre class="prettyprint"><code class="language-php hljs "><span class="hljs-preprocessor">&lt;?php</span>   <span class="hljs-comment">// app/controllers/Test_Controller.php</span>
	
	<span class="hljs-class"><span class="hljs-keyword">class</span> <span class="hljs-title">Test_Controller</span> <span class="hljs-keyword">extends</span> <span class="hljs-title">Flyr</span>\<span class="hljs-title">Flyr</span> {</span>
	
	    <span class="hljs-comment">// construct method must be created</span>
	    <span class="hljs-keyword">public</span> <span class="hljs-function"><span class="hljs-keyword">function</span> <span class="hljs-title">__construct</span><span class="hljs-params">()</span> {</span>
	        <span class="hljs-keyword">parent</span>::construct();    <span class="hljs-comment">// you must to call the parent constructor again</span>
	        <span class="hljs-comment">// optionally you can load helpers, language files or models</span>
	        <span class="hljs-variable">$this</span>-&gt;load-&gt;helper(<span class="hljs-string">'string_helper'</span>);
	    }
	
	    <span class="hljs-keyword">public</span> <span class="hljs-function"><span class="hljs-keyword">function</span> <span class="hljs-title">publication</span><span class="hljs-params">(<span class="hljs-variable">$id</span>, <span class="hljs-variable">$slug</span>)</span> {</span>
	        <span class="hljs-comment">// do some here</span>
	    }
	}</code></pre>
	
	<p>It is easy to create a controller(yes, it could be easier if all controllers does not inherit from Flyr, because it is overload <br>
	the environment and making a new Flyr instance but it has its own why. It could be removed in future versions. Do not care, This manual will be maintained) and <br>
	load it from the index.php.</p>
	
	<p>Before know many Flyr things, it is important that you can use all the Flyr features inside anonymous functions without load a controller to access them. <br>
	For this case it is recommended use the reserved word <strong>use</strong>.</p></div><div id="wmd-preview-section-23040" class="wmd-preview-section preview-content">
	
	<pre class="prettyprint"><code class="language-php hljs "><span class="hljs-preprocessor">&lt;?php</span>   <span class="hljs-comment">// index.php</span>
	
	<span class="hljs-comment">// config and autload included files...</span>
	
	<span class="hljs-variable">$app</span> = <span class="hljs-keyword">new</span> \Flyr\Flyr();
	<span class="hljs-variable">$app</span>-&gt;session-&gt;start();
	
	<span class="hljs-variable">$app</span>-&gt;get(<span class="hljs-string">'/post/:id/:slug'</span>, <span class="hljs-function"><span class="hljs-keyword">function</span><span class="hljs-params">(<span class="hljs-variable">$id</span>, <span class="hljs-variable">$slug</span>)</span> <span class="hljs-title">use</span> <span class="hljs-params">(<span class="hljs-variable">$app</span>)</span> {</span>
	    <span class="hljs-variable">$app</span>-&gt;cookie-&gt;create(<span class="hljs-string">'foo'</span>, <span class="hljs-string">'bar'</span>);
	    <span class="hljs-comment">// some code right here...</span>
	});
	</code></pre>
	
	</div><div id="wmd-preview-section-28456" class="wmd-preview-section preview-content">
	
	<h3 id="api"><strong>API</strong></h3></div><div id="wmd-preview-section-100460" class="wmd-preview-section preview-content">
	
	<h4 id="views"><strong>Views</strong></h4>
	
	<p>You may waiting for this. Views… without it you only would use echo(maybe print) containing a large string but it is not the case. You have two methods to response with your HTML code but you can choose if you want to use regular PHP or Twig templates. Yes, Flyr come with support for both. The methods are render and JSON. <br>
	Templates are sent with the header response Transfer-Encoding chunked. All you need to know about routes is that all the templates(PHP and Twig) must be placed inside the folder <strong>app/views/</strong> (included the email templates).</p>
	
	<p>If you need render PHP template it must end in <strong>.php</strong>, else, if you decide to do your HTML template with Twig the file must end in <strong>.html</strong> or <strong>.twig</strong>, whatever you want. Here you can see all forms to render a template(read all the comments, it explain what the code do):</p></div><div id="wmd-preview-section-73616" class="wmd-preview-section preview-content">
	
	<pre class="prettyprint"><code class="language-php hljs "><span class="hljs-preprocessor">&lt;?php</span>   <span class="hljs-comment">// index.php</span>
	
	<span class="hljs-variable">$app</span> = <span class="hljs-keyword">new</span> \Flyr\Flyr();
	<span class="hljs-variable">$app</span>-&gt;session-&gt;start();
	
	<span class="hljs-variable">$app</span>-&gt;get(<span class="hljs-string">'/'</span>, <span class="hljs-function"><span class="hljs-keyword">function</span><span class="hljs-params">()</span> <span class="hljs-title">use</span> <span class="hljs-params">(<span class="hljs-variable">$app</span>)</span> {</span>
	    <span class="hljs-comment">// render header.php template and send it</span>
	    <span class="hljs-comment">// to the explorer.</span>
	    <span class="hljs-variable">$app</span>-&gt;view-&gt;render(<span class="hljs-string">'header.php'</span>);
	
	    <span class="hljs-comment">// save the template in a variable for then do something with it.</span>
	    <span class="hljs-variable">$params</span> = [<span class="hljs-string">'name'</span> =&gt; <span class="hljs-string">'Siro'</span>, <span class="hljs-string">'country'</span> =&gt; <span class="hljs-string">'Spain'</span>];
	    <span class="hljs-variable">$renderedTemplate</span> = <span class="hljs-variable">$app</span>-&gt;view-&gt;render(<span class="hljs-string">'index.twig.html'</span>, <span class="hljs-variable">$params</span>, <span class="hljs-keyword">true</span>);
	    <span class="hljs-keyword">echo</span> <span class="hljs-variable">$renderedTemplate</span>;
	});
	</code></pre>
	
	<p>Now we are going to analize the last call to render. Render can contain three parameters. The first one is the template name (you can also put $app-&gt;view-&gt;render(‘path/to/template.html’) that finds template.html in app/views/path/to/). The second parameter is the associative array of data to pass to the template(see the following example). The third parameter is true by default and if you specify it setting it to false you can save the rendered template inside a variable to do something with the content.</p>
	
	<p>A simple example with template would be like the following:</p></div><div id="wmd-preview-section-65254" class="wmd-preview-section preview-content">
	
	<pre class="prettyprint"><code class="language-php hljs "><span class="hljs-preprocessor">&lt;?php</span>   <span class="hljs-comment">// app/views/template.php ?&gt;</span>
	&lt;!DOCTYPE html&gt;
	&lt;html lang=<span class="hljs-string">"en"</span>&gt;
	&lt;head&gt;
	    &lt;title&gt;<span class="hljs-preprocessor">&lt;?</span>= <span class="hljs-variable">$title</span> <span class="hljs-preprocessor">?&gt;</span>&lt;/title&gt;
	&lt;/head&gt;
	&lt;body&gt;
	    &lt;div&gt;Name: <span class="hljs-preprocessor">&lt;?</span>= <span class="hljs-variable">$name</span> <span class="hljs-preprocessor">?&gt;</span>&lt;/div&gt;
	    <span class="hljs-preprocessor">&lt;?php</span> <span class="hljs-keyword">if</span>(<span class="hljs-variable">$age</span> &gt; <span class="hljs-number">0</span>): <span class="hljs-preprocessor">?&gt;</span>
	    &lt;div&gt;Age: <span class="hljs-preprocessor">&lt;?</span>= <span class="hljs-variable">$age</span> <span class="hljs-preprocessor">?&gt;</span>&lt;/div&gt;
	    <span class="hljs-preprocessor">&lt;?php</span> <span class="hljs-keyword">else</span>: <span class="hljs-preprocessor">?&gt;</span>
	    &lt;div&gt;Invalid age&lt;/div&gt;
	    <span class="hljs-preprocessor">&lt;?php</span> <span class="hljs-keyword">endif</span>; <span class="hljs-preprocessor">?&gt;</span>
	&lt;/body&gt;
	&lt;/html&gt;</code></pre>
	
	</div><div id="wmd-preview-section-68374" class="wmd-preview-section preview-content">
	
	<pre class="prettyprint"><code class="language-php hljs "><span class="hljs-preprocessor">&lt;?php</span> <span class="hljs-comment">// index.php</span>
	<span class="hljs-comment">// required files</span>
	<span class="hljs-variable">$app</span> = <span class="hljs-keyword">new</span> \Flyr\Flyr();
	<span class="hljs-variable">$app</span>-&gt;session-&gt;start();
	
	<span class="hljs-variable">$app</span>-&gt;get(<span class="hljs-string">'/'</span>, <span class="hljs-string">'App@index'</span>);</code></pre></div><div id="wmd-preview-section-73030" class="wmd-preview-section preview-content">
	
	<pre class="prettyprint"><code class="language-php hljs "><span class="hljs-preprocessor">&lt;?php</span> <span class="hljs-comment">// app/controllers/App.php</span>
	
	<span class="hljs-class"><span class="hljs-keyword">class</span> <span class="hljs-title">App</span> <span class="hljs-keyword">extends</span> <span class="hljs-title">Flyr</span>\<span class="hljs-title">Flyr</span> {</span>
	    <span class="hljs-keyword">public</span> <span class="hljs-function"><span class="hljs-keyword">function</span> <span class="hljs-title">__construct</span><span class="hljs-params">()</span> {</span>
	
	    }
	
	    <span class="hljs-keyword">public</span> <span class="hljs-function"><span class="hljs-keyword">function</span> <span class="hljs-title">index</span><span class="hljs-params">()</span> {</span>
	        <span class="hljs-variable">$this</span>-&gt;view-&gt;render(
	            <span class="hljs-string">'template.php'</span>,
	            [<span class="hljs-string">'title'</span> =&gt; <span class="hljs-string">'Index page'</span>, <span class="hljs-string">'name'</span> =&gt; <span class="hljs-string">'Siro'</span>, <span class="hljs-string">'age'</span> =&gt; <span class="hljs-number">100</span>]
	    }
	}</code></pre></div><div id="wmd-preview-section-100201" class="wmd-preview-section preview-content">
	
	<h4 id="cookies"><strong>Cookies</strong></h4>
	
	<p>Flyr offers a simple API for interact with cookies, sessions and other components. Cookies have easy methods to remember like</p>
	
	<ul>
	<li>create(<span>$</span>key, <span>$</span>value, <span>$</span>optionArray)</li>
	<li>delete(<span>$</span>key)</li>
	<li>deleteAll()</li>
	<li>set(<span>$</span>key, <span>$</span>value)</li>
	<li>get(<span>$</span>key)</li>
	</ul>
	
	<p>The “most” difficult may be create. The two firsts parameters are simple, you must give a key to access to the value and the second one is the value to save. The third parameter is an array containing options for the cookie. You may want to set a custom expire time or set the domain and path to be accessed. You can use only expire time and all the other options are set by default for the current domain and only HTTP read option. Let’s see an example:</p></div><div id="wmd-preview-section-102446" class="wmd-preview-section preview-content">
	
	<pre class="prettyprint"><code class="language-php hljs "><span class="hljs-preprocessor">&lt;?php</span>   <span class="hljs-comment">// index.php</span>
	
	<span class="hljs-comment">// config and autload included files...</span>
	
	<span class="hljs-variable">$app</span> = <span class="hljs-keyword">new</span> \Flyr\Flyr();
	<span class="hljs-variable">$app</span>-&gt;session-&gt;start();
	
	<span class="hljs-variable">$app</span>-&gt;get(<span class="hljs-string">'/'</span>, <span class="hljs-function"><span class="hljs-keyword">function</span><span class="hljs-params">()</span> <span class="hljs-title">use</span> <span class="hljs-params">(<span class="hljs-variable">$app</span>)</span> {</span>
	    <span class="hljs-keyword">if</span>(<span class="hljs-variable">$app</span>-&gt;cookie-&gt;get(<span class="hljs-string">'foo'</span>) !== <span class="hljs-keyword">null</span> &amp;&amp; <span class="hljs-variable">$app</span>-&gt;cookie-&gt;get(<span class="hljs-string">'ex'</span>) !== <span class="hljs-keyword">null</span>) {
	        <span class="hljs-comment">// simple for to create a cookie</span>
	        <span class="hljs-variable">$app</span>-&gt;cookie-&gt;create(<span class="hljs-string">'foo'</span>, <span class="hljs-string">'bar'</span>);
	        <span class="hljs-comment">// some code right here...</span>
	        <span class="hljs-comment">// specifying options. The cookie will be deleted in 5 seconds</span>
	        <span class="hljs-variable">$app</span>-&gt;cookie-&gt;create(<span class="hljs-string">'ex'</span>, uniqid(), [<span class="hljs-string">'expire'</span> =&gt; (time() + <span class="hljs-number">5</span>)]);
	    } <span class="hljs-keyword">else</span> {
	        <span class="hljs-variable">$app</span>-&gt;cookie-&gt;deleteAll();
	    }
	});</code></pre>
	
	<p>All the sessions are encrypet with RIJNDAEL_256(AES-256) if the extension mcrypt is installed in the system.</p></div><div id="wmd-preview-section-100687" class="wmd-preview-section preview-content">
	
	<h4 id="sessions"><strong>Sessions</strong></h4>
	
	<p>Sometimes you need to store sensitive data in a cookie but it is not a good idea and maybe you need to store all this data in a session. Flyr offers a session API similar to the cookie API. The methods that offers are:</p>
	
	<ul>
	<li>set(<span>$</span>key, <span>$</span>value)</li>
	<li>get(<span>$</span>key)</li>
	<li>delete(<span>$</span>key)</li>
	<li>deleteAll()</li>
	</ul>
	
	<p>See this simple example:</p></div><div id="wmd-preview-section-99480" class="wmd-preview-section preview-content">
	
	<pre class="prettyprint"><code class="language-php hljs "><span class="hljs-preprocessor">&lt;?php</span>   <span class="hljs-comment">// index.php</span>
	
	<span class="hljs-comment">// config and autload included files...</span>
	
	<span class="hljs-variable">$app</span> = <span class="hljs-keyword">new</span> \Flyr\Flyr();
	<span class="hljs-variable">$app</span>-&gt;session-&gt;start();
	
	<span class="hljs-variable">$app</span>-&gt;get(<span class="hljs-string">'/'</span>, <span class="hljs-function"><span class="hljs-keyword">function</span><span class="hljs-params">()</span> <span class="hljs-title">use</span> <span class="hljs-params">(<span class="hljs-variable">$app</span>)</span> {</span>
	    <span class="hljs-comment">// creating a session</span>
	    <span class="hljs-variable">$app</span>-&gt;session-&gt;set(<span class="hljs-string">'user_id'</span>, <span class="hljs-number">123342</span>);
	    <span class="hljs-variable">$app</span>-&gt;session-&gt;set(<span class="hljs-string">'user_id.name'</span>, <span class="hljs-string">'Jhon Doe'</span>);    
	});</code></pre></div><div id="wmd-preview-section-122251" class="wmd-preview-section preview-content">
	
	<h4 id="mail"><strong>Mail</strong></h4>
	
	<p>Flyr also offer a simple API to send emails that has been built on top PHPMailer. It offers a method to send emails: send(<span>$</span>template, <span>$</span>data, <span>$</span>from, <span>$</span>to, <span>$</span>subject = ”, <span>$</span>attach = null).  <br>
	The template is stored in the folder app/views and the data are all parameters required to render the template to be sent. From and to are arrays containing one or two keys, the “name” and the “email” key. Name key is optional.</p>
	
	<p>Before make an example with the mail API <strong>you must configure the email_config.php</strong> file placed in Flyr/Config/. </p>
	
	</div><div id="wmd-preview-section-128738" class="wmd-preview-section preview-content">
	
	<pre class="prettyprint"><code class="language-php hljs "><span class="hljs-preprocessor">&lt;?php</span>
	<span class="hljs-keyword">return</span> <span class="hljs-keyword">array</span>(
	    <span class="hljs-string">'server'</span> =&gt; <span class="hljs-string">'smtp.gmail.com'</span>, <span class="hljs-comment">// SMTP server name</span>
	    <span class="hljs-string">'port'</span> =&gt; <span class="hljs-number">465</span>,  <span class="hljs-comment">// Port number</span>
	    <span class="hljs-string">'email'</span> =&gt; <span class="hljs-string">'your@email.com'</span>,  <span class="hljs-comment">// Your email address</span>
	    <span class="hljs-string">'password'</span> =&gt; <span class="hljs-string">'place your email password here'</span>,  <span class="hljs-comment">// Your password</span>
	    <span class="hljs-string">'charset'</span> =&gt; <span class="hljs-string">'UTF-8'</span>  <span class="hljs-comment">// The encoding used to send emails </span>
	);</code></pre>
	
	<p>Afterwards you can send emails. See the following example:</p>
	
	</div><div id="wmd-preview-section-142611" class="wmd-preview-section preview-content">
	
	<pre class="prettyprint"><code class="language-php hljs "><span class="hljs-preprocessor">&lt;?php</span>   <span class="hljs-comment">// index.php</span>
	
	<span class="hljs-comment">// config and autload included files...</span>
	
	<span class="hljs-variable">$app</span> = <span class="hljs-keyword">new</span> \Flyr\Flyr();
	<span class="hljs-variable">$app</span>-&gt;session-&gt;start();
	
	<span class="hljs-comment">// You can send a POST request with curl</span>
	<span class="hljs-variable">$app</span>-&gt;post(<span class="hljs-string">'/'</span>, <span class="hljs-function"><span class="hljs-keyword">function</span><span class="hljs-params">()</span> <span class="hljs-title">use</span> <span class="hljs-params">(<span class="hljs-variable">$app</span>)</span> {</span>
	    <span class="hljs-variable">$app</span>-&gt;mail-&gt;send(
	        <span class="hljs-string">'index.php'</span>,
	        [<span class="hljs-string">'slogan'</span> =&gt; <span class="hljs-string">'Siro Rules!'</span>],
	        [<span class="hljs-string">'email'</span> =&gt; <span class="hljs-string">'myemail@gmail.com'</span>],
	        [<span class="hljs-string">'email'</span> =&gt; <span class="hljs-string">'friendemail@yahoo.com'</span>, <span class="hljs-string">'name'</span> =&gt; <span class="hljs-string">'Fred'</span>],
	        <span class="hljs-string">'Tema casual'</span>
	    );
	});</code></pre>
	
	<p>It is so simple to send an email with this function but you can also use other methods like addWordWrap to limit the maximum characters per line.</p></div><div id="wmd-preview-section-185480" class="wmd-preview-section preview-content">
	
	<h4 id="logging"><strong>Logging</strong></h4>
	
	<p>Other Flyr aspect is simple logging component. You can use logging to get alerts from source code where you want to obtain information and <em>“rate”</em> them with different error levels. Then you can read all this logs in the folder <strong>app/storage/logs/</strong> that ared sorted by date in descendant order. Logs files are named by year-month-day format. For example flyr-2015-02-06.log. Different log levels can be used with all this methods:</p>
	
	<ul>
	<li>logWarning(<span>$</span>msg)</li>
	<li>logInfo(<span>$</span>msg)</li>
	<li>logDebug(<span>$</span>msg)</li>
	<li>logError(<span>$</span>msg)</li>
	</ul>
	
	<p>The parameter <em>“$msg”</em> can be an Exception thrown in a try/catch statement or a simple string message. This example log messages using different ways.</p></div><div id="wmd-preview-section-212255" class="wmd-preview-section preview-content">
	
	<pre class="prettyprint"><code class="language-php hljs "><span class="hljs-preprocessor">&lt;?php</span>   <span class="hljs-comment">// index.php</span>
	
	<span class="hljs-comment">// config and autload included files...</span>
	
	<span class="hljs-variable">$app</span> = <span class="hljs-keyword">new</span> \Flyr\Flyr();
	<span class="hljs-variable">$app</span>-&gt;session-&gt;start();
	
	<span class="hljs-comment">// first example</span>
	<span class="hljs-variable">$app</span>-&gt;get(<span class="hljs-string">'/'</span>, <span class="hljs-function"><span class="hljs-keyword">function</span><span class="hljs-params">()</span> <span class="hljs-title">use</span> <span class="hljs-params">(<span class="hljs-variable">$app</span>)</span> {</span>
	    <span class="hljs-keyword">if</span>(<span class="hljs-variable">$app</span>-&gt;cookie-&gt;get(<span class="hljs-string">'user'</span>) === <span class="hljs-keyword">null</span>) {
	        <span class="hljs-variable">$app</span>-&gt;cookie-&gt;create(
	            <span class="hljs-string">'user'</span>,
	            mt_rand(),
	            [<span class="hljs-string">'expire'</span> =&gt; (time() + <span class="hljs-number">86400</span>)]
	        );
	        <span class="hljs-comment">// thow a info log level</span>
	        <span class="hljs-variable">$app</span>-&gt;log-&gt;logInfo(<span class="hljs-string">'Another visit to the index page'</span>);
	    }
	});
	
	<span class="hljs-comment">// second example</span>
	<span class="hljs-variable">$app</span>-&gt;get(<span class="hljs-string">'/division'</span>, <span class="hljs-function"><span class="hljs-keyword">function</span><span class="hljs-params">()</span> <span class="hljs-title">use</span> <span class="hljs-params">(<span class="hljs-variable">$app</span>)</span> {</span>
	    <span class="hljs-variable">$a</span> = <span class="hljs-number">2</span>;
	    <span class="hljs-variable">$b</span> = <span class="hljs-number">0</span>;
	    <span class="hljs-keyword">try</span> {
	        <span class="hljs-keyword">if</span>(<span class="hljs-variable">$b</span> === <span class="hljs-number">0</span>) {
	            <span class="hljs-keyword">throw</span> <span class="hljs-keyword">new</span> <span class="hljs-keyword">Exception</span>(<span class="hljs-string">'You can not divide by zero!'</span>);
	        }
	
	        <span class="hljs-variable">$c</span> = <span class="hljs-variable">$a</span> / <span class="hljs-variable">$b</span>;
	    } <span class="hljs-keyword">catch</span>(<span class="hljs-keyword">Exception</span> <span class="hljs-variable">$e</span>) {
	        <span class="hljs-variable">$app</span>-&gt;log-&gt;logWarning(<span class="hljs-variable">$e</span>);
	    }
	});</code></pre>
	
	<p>After run both GET requests, a log message will be created in your current date log file and the message will look like this:</p></div><div id="wmd-preview-section-212715" class="wmd-preview-section preview-content">
	
	<pre class="prettyprint"><code class="language-json hljs ">{
	    "<span class="hljs-attribute">errlevel</span>": <span class="hljs-value"><span class="hljs-string">"Info"</span></span>,
	    "<span class="hljs-attribute">message</span>": <span class="hljs-value"><span class="hljs-string">"Another visit to the index page"</span></span>,
	    "<span class="hljs-attribute">time</span>": <span class="hljs-value"><span class="hljs-string">"2015-02-06 19:40:27"</span>
	</span>}
	{
	    "<span class="hljs-attribute">errlevel</span>": <span class="hljs-value"><span class="hljs-string">"Warning"</span></span>,
	    "<span class="hljs-attribute">errdate</span>": <span class="hljs-value"><span class="hljs-string">"2015-02-06 19:40:53"</span></span>,
	    "<span class="hljs-attribute">message</span>": <span class="hljs-value"><span class="hljs-string">"You can not divide by zero!"</span></span>,
	    "<span class="hljs-attribute">code</span>": <span class="hljs-value"><span class="hljs-number">0</span></span>,
	    "<span class="hljs-attribute">trace</span>": <span class="hljs-value"><span class="hljs-string">"#0 C:\\xampp\\htdocs\\Flyr\\Route.php(352): {closure}()\n#1 C:\\xampp\\htdocs\\Flyr\\Route.php(152): Flyr\\Route-&gt;loadCallback(Object(Closure), Array)\n#2 C:\\xampp\\htdocs\\Flyr\\Flyr.php(40): Flyr\\Route-&gt;get('\/division', Object(Closure))\n#3 C:\\xampp\\htdocs\\index.php(69): Flyr\\Flyr-&gt;get('\/division', Object(Closure))\n#4 {main}"</span></span>,
	    "<span class="hljs-attribute">file</span>": <span class="hljs-value"><span class="hljs-string">"C:\\xampp\\htdocs\\index.php"</span></span>,
	    "<span class="hljs-attribute">line</span>": <span class="hljs-value"><span class="hljs-number">32</span>
	</span>}</code></pre>
	
	<p>Also, you can send a log message to your email. How can i do it? It is simple using the method sendEmail(<span>$</span>template, <span>$</span>from, <span>$</span>to, <span>$</span>subject). This is similar that send an email using the <em>send</em> method from mail component.</p></div><div id="wmd-preview-section-233182" class="wmd-preview-section preview-content">
	
	<h4 id="loader"><strong>Loader</strong></h4>
	
	<p>Other important object is the Flyr loader. You can load helpers and language files. <br>
	helpers are just a files containing functions or classes to solve a specific group of problems. For example, you can create a file called String_Helper.php that has some functions to manipulate strings.</p>
	
	</div><div id="wmd-preview-section-271160" class="wmd-preview-section preview-content">
	
	<pre class="prettyprint"><code class="language-php hljs "><span class="hljs-preprocessor">&lt;?php</span>   <span class="hljs-comment">// app/helpers/String_Helper.php</span>
	<span class="hljs-keyword">namespace</span> <span class="hljs-title">Helpers</span>\<span class="hljs-title">Strings</span>;
	
	<span class="hljs-function"><span class="hljs-keyword">function</span> <span class="hljs-title">capitalize</span><span class="hljs-params">(<span class="hljs-variable">$str</span>)</span> {</span>
	    <span class="hljs-keyword">if</span>(!is_string(<span class="hljs-variable">$str</span>) || <span class="hljs-keyword">empty</span>(<span class="hljs-variable">$str</span>)) {
	        <span class="hljs-keyword">return</span> <span class="hljs-variable">$str</span>;
	    }
	
	    <span class="hljs-keyword">return</span> (strtoupper(substr(<span class="hljs-variable">$str</span>, <span class="hljs-number">0</span>, <span class="hljs-number">1</span>)) . substr(<span class="hljs-variable">$str</span>, <span class="hljs-number">1</span>, strlen(<span class="hljs-variable">$str</span>) - <span class="hljs-number">1</span>));
	}
	
	<span class="hljs-function"><span class="hljs-keyword">function</span> <span class="hljs-title">gitanize</span><span class="hljs-params">(<span class="hljs-variable">$str</span>)</span> {</span>
	    <span class="hljs-keyword">if</span>(!is_string(<span class="hljs-variable">$str</span>) || <span class="hljs-keyword">empty</span>(<span class="hljs-variable">$str</span>)) {
	        <span class="hljs-keyword">return</span> <span class="hljs-variable">$str</span>;
	    } 
	
	    <span class="hljs-keyword">for</span>(<span class="hljs-variable">$i</span> = <span class="hljs-number">0</span>; <span class="hljs-variable">$i</span> &lt; strlen(<span class="hljs-variable">$str</span>); <span class="hljs-variable">$i</span>++) {
	        <span class="hljs-keyword">if</span>((<span class="hljs-variable">$i</span> % <span class="hljs-number">2</span>) === <span class="hljs-number">0</span>) {
	            <span class="hljs-variable">$str</span>[<span class="hljs-variable">$i</span>] = strtoupper(<span class="hljs-variable">$str</span>[<span class="hljs-variable">$i</span>]);
	        } <span class="hljs-keyword">else</span> {
	            <span class="hljs-variable">$str</span>[<span class="hljs-variable">$i</span>] = strtolower(<span class="hljs-variable">$str</span>[<span class="hljs-variable">$i</span>]);
	        }
	    }
	
	    <span class="hljs-keyword">return</span> <span class="hljs-variable">$str</span>;
	}
	<span class="hljs-comment">// more code...</span></code></pre></div><div id="wmd-preview-section-253553" class="wmd-preview-section preview-content">
	
	<pre class="prettyprint"><code class="language-php hljs "><span class="hljs-preprocessor">&lt;?php</span>   <span class="hljs-comment">// index.php</span>
	<span class="hljs-comment">// config and autload included files...</span>
	
	<span class="hljs-variable">$app</span> = <span class="hljs-keyword">new</span> \Flyr\Flyr();
	<span class="hljs-variable">$app</span>-&gt;session-&gt;start();
	
	<span class="hljs-variable">$app</span>-&gt;get(<span class="hljs-string">'/'</span>, <span class="hljs-string">'My_Controller@index'</span>);</code></pre>
	
	</div><div id="wmd-preview-section-320793" class="wmd-preview-section preview-content">
	
	<pre class="prettyprint"><code class="language-php hljs "><span class="hljs-preprocessor">&lt;?php</span>   <span class="hljs-comment">// app/controllers/My_Controller.php</span>
	
	<span class="hljs-class"><span class="hljs-keyword">class</span> <span class="hljs-title">My_Controller</span> <span class="hljs-keyword">extends</span> <span class="hljs-title">Flyr</span>\<span class="hljs-title">Flyr</span> {</span>
	    <span class="hljs-keyword">public</span> <span class="hljs-function"><span class="hljs-keyword">function</span> <span class="hljs-title">__construct</span><span class="hljs-params">()</span> {</span>
	        <span class="hljs-keyword">parent</span>::__construct();
	        <span class="hljs-comment">// load the helper in the construct function to access it from any method</span>
	        <span class="hljs-variable">$this</span>-&gt;load-&gt;helper(<span class="hljs-string">'String_Helper'</span>);
	    }
	
	    <span class="hljs-keyword">public</span> <span class="hljs-function"><span class="hljs-keyword">function</span> <span class="hljs-title">index</span><span class="hljs-params">()</span> {</span>
	        <span class="hljs-keyword">echo</span> Helpers\Strings\capitalize(<span class="hljs-string">'hello'</span>);
	        <span class="hljs-keyword">echo</span> Helpers\Strings\gitanize(<span class="hljs-string">'goodbye'</span>);
	    }
	}</code></pre>
	
	<p>In this example you have seen how to create a simple helper for manipulate strings. Using <em>namespaces</em> is a convention to avoid errors or reuse a defined function or class. Also it is good use namespaces for a better code organization. Another important feature is the lang(<span>$</span>files, <span>$</span>lang) method. The first parameter is the file name(you can set an array containing the multiple files) and the second parameter is the language. <br>
	How can i organize languages? this is simple. You must save all files inside the folder <em>app/lang</em> and inside this folder create subfolders named as the language them contain. For example <em>app/lang/en</em>(for English language), <em>app/lang/es</em> (for Spanish) and more… <br>
	Let’s how to create a language file.</p>
	
	</div><div id="wmd-preview-section-329018" class="wmd-preview-section preview-content">
	
	<pre class="prettyprint"><code class="language-php hljs "><span class="hljs-preprocessor">&lt;?php</span>   <span class="hljs-comment">// app/lang/es/days.php</span>
	
	<span class="hljs-keyword">return</span> [
	    <span class="hljs-string">'mon'</span> =&gt; <span class="hljs-string">'lunes'</span>,
	    <span class="hljs-string">'tue'</span> =&gt; <span class="hljs-string">'martes'</span>,
	    <span class="hljs-string">'wed'</span> =&gt; <span class="hljs-string">'miércoles'</span>,
	    <span class="hljs-string">'thu'</span> =&gt; <span class="hljs-string">'jueves'</span>,
	    <span class="hljs-string">'fri'</span> =&gt; <span class="hljs-string">'viernes'</span>,
	    <span class="hljs-string">'sat'</span>, =&gt; <span class="hljs-string">'sábado'</span>,
	    <span class="hljs-string">'sun'</span>, =&gt; <span class="hljs-string">'domingo'</span>
	];</code></pre>
	
	</div><div id="wmd-preview-section-365089" class="wmd-preview-section preview-content">
	
	<pre class="prettyprint"><code class="language-php hljs "><span class="hljs-preprocessor">&lt;?php</span>   <span class="hljs-comment">// index.php</span>
	<span class="hljs-comment">// config and autload included files...</span>
	
	<span class="hljs-variable">$app</span> = <span class="hljs-keyword">new</span> \Flyr\Flyr();
	<span class="hljs-variable">$app</span>-&gt;session-&gt;start();
	
	<span class="hljs-variable">$app</span>-&gt;get(<span class="hljs-string">'/'</span>, <span class="hljs-function"><span class="hljs-keyword">function</span><span class="hljs-params">()</span> <span class="hljs-title">use</span> <span class="hljs-params">(<span class="hljs-variable">$app</span>)</span> {</span>
	    <span class="hljs-variable">$lang</span> = <span class="hljs-variable">$app</span>-&gt;load-&gt;lang(<span class="hljs-string">'days'</span>, <span class="hljs-string">'es'</span>);
	    var_dump(<span class="hljs-variable">$lang</span>);    <span class="hljs-comment">// you will se an array with key =&gt; value format</span>
	});</code></pre>
	
	</div><div id="wmd-preview-section-385087" class="wmd-preview-section preview-content">
	
	<h4 id="header"><strong>Header</strong></h4>
	
	<p>Maybe you want to manipule the HTTP response header in any page. You can have access to header object and make use of this methods:</p>
	
	<ul>
	<li>set(array <span>$</span>headers)</li>
	<li>remove(<span>$</span>header)</li>
	<li>getCode()</li>
	<li>send(<span>$</span>statusCode)</li>
	<li>get()</li>
	</ul>
	
	<p>See the following examples using header object.</p></div><div id="wmd-preview-section-384980" class="wmd-preview-section preview-content">
	
	<pre class="prettyprint"><code class="language-php hljs "><span class="hljs-preprocessor">&lt;?php</span>   <span class="hljs-comment">// index.php</span>
	<span class="hljs-comment">// config and autload included files...</span>
	
	<span class="hljs-variable">$app</span> = <span class="hljs-keyword">new</span> \Flyr\Flyr();
	<span class="hljs-variable">$app</span>-&gt;session-&gt;start();
	
	<span class="hljs-variable">$app</span>-&gt;get(<span class="hljs-string">'/'</span>, <span class="hljs-function"><span class="hljs-keyword">function</span><span class="hljs-params">()</span> <span class="hljs-title">use</span> <span class="hljs-params">(<span class="hljs-variable">$app</span>)</span> {</span>
	    <span class="hljs-variable">$app</span>-&gt;header-&gt;set([
	        <span class="hljs-string">'Cache-Control'</span> =&gt; <span class="hljs-string">'no-cache'</span>,
	        <span class="hljs-string">'x-frame-options'</span> =&gt; <span class="hljs-string">'DENY'</span>,
	        <span class="hljs-string">'x-xss-protection'</span> =&gt; <span class="hljs-string">'1; mode=block'</span>,
	        <span class="hljs-string">'x-Content-Type-Options'</span> =&gt; <span class="hljs-string">'nosniff'</span>,
	        <span class="hljs-string">'x-ua-compatible'</span> =&gt; <span class="hljs-string">'IE=edge,chrome=1'</span>
	    ]);
	});
	
	<span class="hljs-variable">$app</span>-&gt;get(<span class="hljs-string">'/redirect/:url'</span>, <span class="hljs-function"><span class="hljs-keyword">function</span><span class="hljs-params">(<span class="hljs-variable">$url</span>)</span> <span class="hljs-title">use</span> <span class="hljs-params">(<span class="hljs-variable">$app</span>)</span> {</span>
	    <span class="hljs-variable">$app</span>-&gt;header-&gt;redirect(<span class="hljs-string">"http://$url"</span>);
	});</code></pre>
	
	<p>And this is all for the moment. Flyr will continue growing as a MVC framework thought-out. Rigth now Flyr is a micro-framework used to be your app skeleton in PHP. <br>
	Thank you for read this short documentation and also for use Flyr.</p></div><div id="wmd-preview-section-footnotes" class="preview-content"></div></div>
					</div>
</div>
</body>
</html>