<?php

class Welcome_Controller extends Flyr\Flyr {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$this->view->render('welcome.php');
	}
	
}
