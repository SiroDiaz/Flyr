<?php

class MailTest extends PHPUnit_Framework_TestCase {
	
	public $mail;
	public $properties = [];
	 
	public function __construct() {
		$this->properties = [
			'server' => 'PLACE HERE THE SMTP SERVER',
			'port' => 465,
			'email' => 'PLACE YOUR EMAIL HERE',
			'password' => 'PLACE YOUR PASSWORD HERE',
			'charset' => 'UTF-8'
		];
		
		$this->mail = new Flyr\Components\Mail($this->properties);
	}
	
	public function testGetTemplate() {
		$this->mail->setTemplate('template.twig.html');
		$this->assertEquals('template.twig.html', $this->mail->getTemplate());
	}
	
	
}
