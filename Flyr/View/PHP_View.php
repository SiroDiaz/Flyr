<?php namespace Flyr\View;

class PHP_View extends ViewAbstract {
	
	public function __construct($template) {
		$this->setTemplate($template);
		$this->setFolder(TEMPLATE_DIR);
	}
	
	public function render($params, $show = true) {
		if($this->exists()) {
				
			if(is_array($params)) {
            	extract($params);
        	}
			
			if($show) {			
				session_write_close();
				ob_flush();
				flush();
				require $this->getFolder() . $this->getTemplate();
				ob_flush();
				flush();
			} else {
				ob_start();
				require($this->getFolder() . $this->getTemplate());
				$html = ob_get_contents();
				ob_end_clean();
				return $html;
			}
		}
			
	}
}