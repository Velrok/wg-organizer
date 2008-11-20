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
		$this->view->form = $this->getNewResidentForm();
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
		
		Zend_Debug::dump('hallo');exit;
		
		$form = $this->getNewResidentForm();
		if($form->valid($_POST)){
			
			$data = $form->getValues();
			Zend_Debug::dump($data, 'data'); exit;
			$password = rand(10000, 9999999);
			$data['password_hash'] = md5($password);
			$newResident = Table_Residents::getInstance()->createRow($data);
			if ($newResident && $newResident->save()){
				
				$websiteUrl = Zend_Registry::get('websiteUrl');
				
				$mailText = "Du wurdest in die WG aufgenommen.
				Du kannst dich nun unter $websiteUrl/session/new anmelden.
				
				Deine Zugangsdaten:
				
				Email Addresse = $newResident->email
				Password = $password";
				
				$mail = new Zend_Mail();
				$mail->addTo($newResident->email)
					->setSubject("Du wurdest in der WG aufgenomme!")
					->setBodyText($mailText);
			}
		} else {
			Zend_Debug::dump('form not valid');exit;
			$this->_forward('new');
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
	private function getNewResidentForm()
	{
		$form = new Zend_Form();
		$form->setAction('/residents/create');
		$form->setMethod('post');
		$form->addElement('text', 'email', array(
			'validators' => array('email'),
			'label' => 'Email Adresse des neuen Bewohners',
		));
		
		$form->addElement('submit', 'aufnehmen!');
		return $form;
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