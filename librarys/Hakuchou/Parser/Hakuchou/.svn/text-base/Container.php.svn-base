<?php
/**
 * Enter description here...
 * 
 * @author velrok
 * @date 2008 14:18:54
 *
 * @copyright Taktsoft
 */
 
class Hakuchou_Parser_Hakuchou_Container extends Hakuchou_Parser 
{
	/**
	 * @var Hakuchou_Container
	 */
	protected $objectToBeeParsed;
	
	public function __construct(Hakuchou_Builder $builder, Hakuchou_Container $container)
	{
		parent::__construct($builder, $container, $container->getName());
	}
	
	
	public function parse()
	{
		$this->builder->beginBlock($this->objectToBeeParsed->getName());
		foreach($this->objectToBeeParsed as $key => $value){
//			Zend_Debug::dump($key, 'key');
//			Zend_Debug::dump($value, 'value');

			if(is_scalar($value)){
				$this->builder->newElement($key, $value);
				continue;
			}
			
			if (is_null($value)){
				Zend_Debug::dump('null value for '.$key, null, true);
				continue;
			}
			
			parent::getParserFor($value, $key)->parse();
		}
		
		foreach ($this->objectToBeeParsed->getChildren() as $subContainer){
//			Zend_Debug::dump($subContainer, 'subContainer');
			parent::getParserFor($subContainer, $subContainer->getName())->parse();
		}
		$this->builder->endBlock();
	}
	
}
?>