<?php
/** 
 * @author Waldemar Schwan <velrok@gmx.de>
 * @date 2008 14:31:40
 * 
 * A parser for Hakuchou_Parser_Zend_Db_Table_Row_Abstract.
 */
 
class Hakuchou_Parser_Zend_Db_Table_Row_Abstract extends Hakuchou_Parser {
	
	
	/**
	 * @var Zend_Db_Table_Row_Abstract
	 */
	protected $objectToBeeParsed;
	
	public function parse(){
//		Zend_Debug::dump($this->objectToBeeParsed);
		$array = $this->objectToBeeParsed->toArray();
		parent::getParserFor($array, $this->name)->parse();
	}
}
?>