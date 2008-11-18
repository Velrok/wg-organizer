<?php
/**
 * @author Waldemar Schwan <velrok@gmx.de>
 * @date 06.04.2008 22:06:58
 * @year 2008
 * 
 * Holds an treestructure of Hakuchou_Container to enable
 * easy rendering.
 * 
 * You have to register this as the default View in Zend.
 */

class Hakuchou_View extends Zend_View {
	
	/**
	 * main container
	 *
	 * @var Container
	 */
	protected $_mainContainer;
	
	/**
     * Constructor.
     *
     * @param array $config Configuration key-value pairs.
     */
    public function __construct($config = array())
    {
		parent::__construct($config);
		$this->_mainContainer = new Hakuchou_Container('main');
	}
	
	/**
	 * Returns added Container
	 *
	 * @deprecated use createContainer, this ist mutch easyer.
	 * 
	 * @param Hakuchou_Cotainer $container
	 * @return Hakuchou_Cotainer
	 */
	public function addContainer(Hakuchou_Container $container)
	{
		return $this->_mainContainer->addContainer($container);
	}
	
	/**
	 * creats and returns an Container
	 *
	 * @param string $name
	 * @return Hakuchou_Container
	 */
	public function createContainer($name)
	{
		return $this->_mainContainer->createContainer($name);
	}
	
	/**
	 * returns the mainContainer
	 *
	 * @return Hakuchou_Container
	 */
	public function getMainContainer()
	{
		return $this->_mainContainer;
	}
	
	/**
	 * attributed added to view will ne forwared to 
	 * $this->_mainContainer so they are available to 
	 * the Renderer.
	 *
	 * @param mixed $key
	 * @param mixed $value
	 */
	public function __set($key, $value)
	{
		$this->_mainContainer->$key = $value;
	}
}