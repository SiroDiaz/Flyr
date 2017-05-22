<?php namespace Flyr\View;

class Twig_View extends ViewAbstract {

	private $twig;
			
	public function __construct($template) {
		$this->setTemplate($template);
		$this->setFolder(TEMPLATE_DIR);
		$loader = new \Twig_Loader_Filesystem(TEMPLATE_DIR);
		$this->twig = new \Twig_Environment($loader, array(
			'debug' => false,
			'cache' => TEMPLATE_CACHE_DIR,
			'autoescape' => true,
			'auto_reload' => true
		));
	}

	public function render($params = array(), $show = true) {
		
		if($this->exists()) {
			if($show) {
				echo $this->twig->render($this->getTemplate(), $params);
			} else {
				return $this->twig->render($this->getTemplate(), $params);
			}
		}
	}
	
	/**********************************************************
	 * You can extend this class to add new funcionalities like
	 * add filters, functions, etc.
	 * ********************************************************/
	 
	 public function filters($filter) {
	 	$this->twig->addFilter($filter);
	 }
	 
	 public function functions($fun) {
	 	$this->twig->addFunction($fun);
	 }
	 
}