<?php
/**
 * @author Waldemar Schwan <velrok@gmx.de>
 * @date 20.03.2008 00:39:38
 * @year 2008
 * 
 * The Objects helps representing an menuestructure
 * corresponding to the controller structure.
 */

class Hakuchou_Navigation {
	
	/**
	 * array of Hakuchou_Navigation_Controller
	 *
	 * @var array
	 */
	protected $_controller;
	
	/**
	 * Creates an Hakuchou_Navigation object.
	 * This is used to represend an typical menustructure conresponding
	 * to the used Zend_Controller_Actions.
	 *
	 * @return Hakuchou_Navigation
	 */
	public function __construct()
	{
		$this->_controller = array();
	}
	
	/**
	 * adds an Hakuchou_Navigation_Controller.
	 *
	 * @param Hakuchou_Navigation_Controller $controller
	 * @return Hakuchou_Navigation_Controller
	 */
	public function addController(Hakuchou_Navigation_Controller $controller)
	{
		$this->_controller[] = $controller;
		return $controller;
	}
	
	/**
	 * contianted Hakuchou_Navigation_Controller as array
	 *
	 * @return array
	 */
	public function getController()
	{
		return $this->_controller;
	}
}