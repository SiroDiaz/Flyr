<?php namespace Flyr\View;

abstract class ViewAbstract {
	
	private $template;
	private $folder;
	
	/**
	 * Returns the folder name.
	 * 
	 * @return string
	 */
	
	public function getFolder() {
		return $this->folder;
	}
	
	/**
	 * Set the path where templates are stored.
	 */
	
	public function setFolder($path) {
		$this->folder = $path;
	}
	
	/**
	 * Get the template name.
	 * 
	 * @return string
	 */
	
	public function getTemplate() {
		return $this->template;
	}
	
	/**
	 * Set the template name.
	 */
	
	public function setTemplate($template) {
		$this->template = $template;
	}
	
	/**
	 * Check if the template file exists.
	 * 
	 * @return bool
	 */
	
	public function exists() {
		$fullPath = $this->getFolder() . $this->getTemplate();
		return file_exists($fullPath);
	}
	
	/**
	 * Method that render the template depending of
	 * the template system used.
	 * 
	 * @param array $params The contained information to render
	 * @param bool $show False if the view will be stored in a variable
	 */
	
	abstract public function render($params = array(), $show = true);
}
