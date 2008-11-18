<?php
/**
 * @author Waldemar Schwan <velrok@gmx.de>
 * @date 2008 14:59:49
 * 
 * Standard parser for objects if none is found. 
 */
 
class Hakuchou_Parser_Object extends Hakuchou_Parser
{
	/**
	 * @var object
	 */
	protected $objectToBeeParsed;
	
	public function parse()
	{
//		Zend_Debug::dump($this->objectToBeeParsed, '$this->objectToBeeParsed');
		
		if ($this->objectToBeeParsed == null){
			Zend_Debug::dump('null value for '.$this->name, null, true);
			return;
		}
		
		foreach($this->objectToBeeParsed as $attibute => $value){
			if(is_scalar($value)){
				$this->builder->newElement($this->name.'_'.$attibute, $value);
			} else {
//				Zend_Debug::dump($attibute, "attribute");
//				Zend_Debug::dump($value, "value");
				parent::getParserFor($value, $attibute)->parse();
			}
		}
	}
}
?>