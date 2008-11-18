<?php
/**
 * @author Waldemar Schwan <velrok@gmx.de>
 * @date 20.03.2008 00:45:32
 * @year 2008
 * 
 * This represents an controller in the navigation object.
 *   
 */

class Hakuchou_Navigation_Controller {
	
	/**
	 * controller name or caption
	 *
	 * @var string
	 */
	protected $_caption;
	
	/**
	 * array of linked actions
	 *
	 * @var array
	 */
	protected $_actions;
	
	/**
	 * @param string $name
	 * @return Hakuchou_Navigation_Controller
	 */
	public function __construct($caption)
	{
		$this->_caption = $caption;
		$this->_actions = array();
	}
	
	/**
	 * addes an action
	 *
	 * @param string $caption
	 * @param string $action
	 * @return Hakuchou_Navigation_Controller
	 */
	public function addAction($caption, $action)
	{
		$this->_actions[$caption] = $action;
		return $this;
	}
	
	/**
	 * returns all actions
	 *
	 * @return array of strings
	 */
	public function getActions()
	{
		return $this->_actions;
	}
	
	/**
	 *
	 * @deprecated use getCaption instead.
	 * @return string
	 */
	public function getName()
	{
		return $this->getCaption();
	}
	
	/**
	 * Returns the caption of the Controller.
	 *
	 * @return string
	 */
	public function getCaption()
	{
		return $this->_caption;
	}
}