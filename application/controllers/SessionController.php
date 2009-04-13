<?php
/**
 * @author 
 * @date 
 * @year 
 * 
 * Decription ...  
 */

class SessionController extends ApplicationController  
{
	/**
	 * Login
	 *
	 */
	public function newAction(){
		$form = $this->getLoginForm();
		
		if ($_POST) {
			$form->isValid($_POST);
		}
		
		$this->view->loginForm = $form;
		$this->render('new');
	}

	/**
	 * creating the session
	 *
	 */
	public function createAction(){
		$this->requirePost();
		
		$form = $this->getLoginForm();
		
		if ($form->isValid($_POST)){
			$resident = Table_Residents::getInstance()->findResidentByEmailAndPasswordhash($form->getValue('email'), $form->getValue('password'));

			
			if ($resident instanceof Resident){
				$s = new Zend_Session_Namespace();
				$s->currentResidentId = $resident->id;
				$this->redirect('index', 'index');
			} else {
				$this->flash("Email oder Password falsch!");
				$this->redirect('new');
			}
			
		} else {
			$this->redirect('new');
		}
	}
	
	
	/**
	* Enter description here...
	 *
	 */
	public function destroyAction(){
		$s = new Zend_Session_Namespace();
		$s->currentResidentId = null;
		$s->currentResident = null;
		$s->backgroud = null;
		$this->redirect('index', 'index');
	}
	
	/**
	 * @return Zend_Form
	 */
	private function getLoginForm()
	{
		$form = new Zend_Form();
    $form->setAction($this->getBasePath() . "session/create")
			->setMethod('post');
			
		$email = new Zend_Form_Element_Text(array(
			'name' => 'email',
			'label' => 'Email Addresse'));
		$email->addValidator(new Zend_Validate_EmailAddress());
		$email->addFilter('StringtoLower');
		$email->setRequired();
		
		$password = new Zend_Form_Element_Password(array(
			'name' => 'password',
			'label' => 'Passwort'));
		$password->setRequired();
		
		$form->addElement($email)
			->addElement($password)
			->addElement('submit', 'login', array('label'=>'Anmelden'));
			
		return $form;
	}
	
}//endClass