<?php
/**
 * @author 
 * @date 
 * @year 
 * 
 * Decription ...  
 */

class BuyingsController extends ApplicationController  
{
	
	/**
	* Enter description here...
	 *
	 */
	public function indexAction(){
		$amount = 20;
		$this->view->amount = $amount;
		$this->view->resentBuyings = Table_Buyings::getInstance()->findResent($amount);
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
	
	protected function getSubMenue()
	{
		$menue = array();
		
		$link = array(
			'label' => 'Einkäufe eintrage',
			'controller' => 'buyings',
			'action' => 'new',
		);
		$menue[] = $link;
		
		$link = array(
			'label' => 'Einkäufe anzeigen',
			'controller' => 'buyings',
			'action' => 'index',
		);
		$menue[] = $link;
		
		return $menue;
	}
}//endClass