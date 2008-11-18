<?php
/**
 * @author Waldemar Schwan <velrok@gmx.de>
 * @date 21.03.2008 22:21:11
 * @year 2008
 * 
 * An representation of an html from tag.
 * It used Hakuchou_Environment (should bee changed to 
 * Zend_Config) to create correct string for the attribute 
 * $action.
 * 
 * Use this to fill forms in html dokuments.
 * 
 * Bsp:
 * -- in Controller
 * $container->myForm = new Hakuchou_Form('index', 'hello');
 * 
 * -- in View template
 * <form action="{myForm_action}" method="{myForm_method}">
 * </form>
 */

class Hakuchou_Form {
	
	public $action;
	public $method;
	
	/**
	 * class contructor
	 *
	 * @param string $action
	 * @param string $controller
	 * @param string $method
	 * @return Hakuchou_Form
	 */
	public function __construct($action, $controller, $method = 'post'){
		$config = Zend_Registry::get('config');
		$this->action = "$config->baseDir$controller/$action";
		$this->method = $method;
	}
}