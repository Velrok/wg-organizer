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
		$form = $this->getNewByingsForm();
		$this->view->form = $form;
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
	
	/**
	 * @return Zend_Form
	 */
	private function getNewByingsForm(){
		$form = new Zend_Form();
		
		
		for($i = 0; $i < 10; $i++){
			$buyingName = new Zend_Form_Element_Text(array('name' => "product$i"));
			$buyingName->setLabel('Produkt');
			
			$buyingPrice = new Zend_Form_Element_Text(array('name' => "price$i"));
			$buyingPrice->setLabel('Preis');
			$buyingPrice->addValidator(new Zend_Validate_Float());
			
			$form->addElements(array($buyingName, $buyingPrice));
			
			$form->addDisplayGroup(array("product$i", "price$i"), "buying$i");
		}
		
		$submit = new Zend_Form_Element_Submit(array('name' => 'submit'));
		$submit->setLabel('Einkäufe eintragen');
		$form->addElement($submit);
		return $form;
	}
	
	protected function getSubMenue()
	{
		$menue = array();
		
		$link = array(
			'label' => 'Einkäufe eintragen',
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