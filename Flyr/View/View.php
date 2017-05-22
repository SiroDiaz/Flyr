<?php namespace Flyr\View;

class View {

	public function render($template, $params = [], $show = true) {
		$extension = explode('.', $template);
		$extension = $extension[count($extension) - 1];
		
		switch(strtolower($extension)) {
			case 'php':
				$view = new PHP_View($template);
				if($show === true) {
					$view->render($params, $show);
				}else {
					return $view->render($params, $show);
				}
				break;
			case 'twig':
			case 'html':
				$view = new Twig_View($template);
				if($show === true) {
					$view->render($params, $show);
				}else {
					return $view->render($params, $show);
				}
				break;
			default:
				// error message here...
		}
	}
	
	public function JSON($data) {
		header('Content-Type: application/json');
		echo json_encode($data);
	}
}