<?php
/**
 * @author Waldemar Schwan <velrok@gmx.de>
 * @date 08.04.2008 22:11:06
 * @year 2008
 * 
 * Attach content to the container by just doing something like
 * $container->header = "Some Header";
 */

class Hakuchou_Container {
	
	private $_name;
	private $_subContainer;
	
	
	/**
	 * Don't create an Hakuchou_Container manualy.
	 * Use an existing Container->crateContainer() to create a 
	 * subcontainer. Every Controller has an view attribue beeing an
	 * Hakuchou_Container if you configured your applicaiton corectly to use 
	 * the Hakucho Framework.
	 * 
	 * @see Hakuchou_View
	 *
	 * @param string $name
	 * @return Hakuchou_Container
	 */
	public function __construct($name)
	{
		$this->_name = $name;
		$this->_subContainer = new ArrayObject();
	}
	
	/**
	 * adds an subContainer
	 *
	 * @param Hakuchou_Container $subContainer
	 * @return Hakuchou_Container
	 */
	private function addContainer(Hakuchou_Container $subContainer)
	{
		$this->_subContainer[] = $subContainer;
		return $subContainer;
	}
	
	/**
	 * Creats an adds an Container to this container.
	 * The created container will be retured.
	 *
	 * @param string $name
	 * @return Hakuchou_Container
	 */
	public function createContainer($name)
	{
		return $this->addContainer(new Hakuchou_Container($name));
	}
	
	/**
	 * 
	 *
	 * @return ArrayObject of sub Continers
	 */
	public function getChildren()
	{
		return $this->_subContainer;
	}
	
	/**
	 * getter for name
	 *
	 * @return string
	 */
	public function getName()
	{
		return $this->_name;
	}
}