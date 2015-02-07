<?php namespace Flyr\View;

abstract class ViewAbstract {
	
	private $template;
	private $folder;
	
	public function getFolder() {
		return $this->folder;
	}
	
	public function setFolder($path) {
		$this->folder = $path;
	}
	
	public function getTemplate() {
		return $this->template;
	}
	
	public function setTemplate($template) {
		$this->template = $template;
	}
	
	public function exists() {
		$fullPath = $this->getFolder() . $this->getTemplate();
		return file_exists($fullPath);
	}
	
	abstract public function render($params, $show = true);
}
