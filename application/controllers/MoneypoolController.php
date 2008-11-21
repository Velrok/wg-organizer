<?php
/**
 * @author 
 * @date 
 * @year 
 * 
 * Decription ...  
 */

class MoneypoolController extends ApplicationController  
{

	
	/**
	* Enter description here...
	 *
	 */
	public function indexAction(){
		$this->view->residents = Table_Residents::getInstance()->fetchAll();
	}
	
	/**
	* Enter description here...
	 *
	 */
	public function showAction(){
		
	}
	
	/**
	* Enter description here...
	 *
	 */
	public function newAction(){
		
	}
	
	/**
	* Enter description here...
	 *
	 */
	public function editAction(){
		
	}
	
	/**
	* Enter description here...
	 *
	 */
	public function createAction(){
		
	}
	
	/**
	* Enter description here...
	 *
	 */
	public function updateAction(){
		
	}
	
	/**
	* Enter description here...
	 *
	 */
	public function destroyAction(){
		
	}
}//endClass