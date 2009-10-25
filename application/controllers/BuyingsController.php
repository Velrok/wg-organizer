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
    $this->view->recentBuyings = Table_Buyings::getInstance()->getAll();
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

      $buyings = array();
			for($i = 0; $i < 10; $i++){
				if ($form->getValue("product$i")){
					$product = $form->getValue("product$i");
					$price = $form->getValue("price$i");
					
					$buying = Table_Buyings::getInstance()->createRow();
						
					$buying->setDescription($product);
					$buying->setPriceInEuro($price);
					$buying->setResident($this->getCurrentResident());
						
					$buying->save();

          $buyings[] = $buying;
				} else {
				    break;
				}
			}
      
      if(!empty($buyings)){
        # tailor message that going to be sent to the other residents
        $message = $this->getCurrentResident()->getName();
        $message .= " hat folgende Dinge gekauft:\n";

        $buying = null;
        $summ = 0.0;
        foreach($buyings as $buying){
          $message .= $buying->getDescription()." für ".$buying->getPriceInEuro()."€\n";
          $summ += $buying->getPriceInEuro();
        }
        $message .= "\nGesammtwert: \t $summ €";

        foreach(Table_Residents::getInstance()->fetchAll() as $resident){
          if($resident->getId() != $this->getCurrentResident()->getId()){
            # Send a message to the other residents. Telling them the current one
            # entered a new buying.
            $msg = Table_Messages::getInstance()->createRow();
            $msg->setFrom('System');
            $msg->setFor($resident);
            $msg->setTitle('Neuer Einkauf');
            $msg->setMessage($message);
            $msg->save();
          }
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