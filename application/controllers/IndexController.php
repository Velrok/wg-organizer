<?php
/**
 * @author 
 * @date 
 * @year 
 * 
 * Decription ...  
 */

class IndexController extends ApplicationController  
{

	
	/**
	* Enter description here...
	 *
	 */
	public function indexAction(){
    if($this->hasCurrentResident()){
      $this->redirect('index', 'messages');
    }
	}
	
	public function testAction(){
		$rank = new Rank();
		Zend_Debug::dump($rank->getTable()->find(0)->current()->name);
		exit;
	}
}//classend