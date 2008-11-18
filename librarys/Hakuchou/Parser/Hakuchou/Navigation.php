<?php
/**
 * @author Waldemar Schwan <velrok@gmx.de>
 * @date 05.08.2008 00:13:34
 * @year 2008
 * 
 * Decription ...  
 */

class Hakuchou_Parser_Hakuchou_Navigation extends Hakuchou_Parser {
	
	/**
	 * @var Hakuchou_Navigation
	 */
	protected $objectToBeeParsed;
	
	public function parse(){
		$this->builder->beginBlock('Navigation');
		foreach( $this->objectToBeeParsed->getController() as $controller ){
			$this->builder->beginBlock('Controller');
			$this->builder->newElement('Controller_caption', $controller->getCaption());
			foreach($controller->getActions() as $caption => $link) {
				$this->builder->beginBlock('Action');
				$this->builder->newElement('Action_caption', $caption);
				$this->builder->newElement('Action_link', $link);
				$this->builder->endBlock();
			}
			$this->builder->endBlock();
		}
		$this->builder->endBlock();
	}
	
}