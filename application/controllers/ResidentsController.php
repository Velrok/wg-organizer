<?php
/**
 * @author 
 * @date 
 * @year 
 * 
 * Decription ...  
 */

class ResidentsController extends ApplicationController  
{

	
	/**
	* Enter description here...
	 *
	 */
	public function indexAction(){
		$residents = Table_Residents::getInstance();
		$this->view->residents = $residents->fetchAll();
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
		$link = array(
			'label' => 'Übersicht',
			'controller' => 'residents',
			'action' => 'index',
		);
		$menue[] = $link;
		
		$link = array(
			'label' => 'aufnehmen',
			'controller' => 'residents',
			'action' => 'new',
		);
		$menue[] = $link;
		
		return $menue;
	}
}//endClass