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
		$amount = (int)$this->getRequest()->getParam('amount');
		if ($amount < 1){
			$amount = 10;
		} 
		
		$this->view->amount = $amount;
		$this->view->recentBuyings = Table_Buyings::getInstance()->findRecent($amount);		
		
		switch ($this->requestedFormat()){
			case Format::ATOM:
				echo $this->view->render('./buyings/index.xml.phtml');
				exit;
				break;
		}
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

		if ($_POST) $form->isValid($_POST);

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
		$this->requirePost();
		$form = $this->getNewByingsForm();
		if($form->isValid($_POST)){
			// do some inputting
				
			for($i = 0; $i < 10; $i++){
				if ($form->getValue("product$i")){
					$product = $form->getValue("product$i");
					$price = $form->getValue("price$i");
						
					$buyings = Table_Buyings::getInstance();
					$buying = $buyings->createRow();
						
					$buying->setDescription($product);
					$buying->setPriceInEuro($price);
					$buying->setResident($this->getCurrentResident());
						
					$buying->save();
				} else {
				    break;    
				}
			}
			// list byings
			$this->flash('Einkäufte eingetragen');
			$this->redirect('index');
		} else {
			$this->redirect('new');
		}
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
		$form->setAction($this->view->url(array('action' => 'create')));

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