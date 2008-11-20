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

		$form = $this->getNewResidentForm();
		if($form->isValid($_POST)){

			if (!Table_Residents::getInstance()->residentExists($form->getValue('email'))){
					
				$data = $form->getValues();
				$password = rand(10000, 9999999);
				$data['password_hash'] = md5($password);
				unset($data['aufnehmen']);
				$newResident = Table_Residents::getInstance()->createRow($data);

				if ($newResident && $newResident->save()){

					$websiteUrl = Zend_Registry::get('configuration')->basepath;

					$mailText = "Du wurdest in die WG aufgenommen.
					Du kannst dich nun unter $websiteUrl/session/new anmelden.

					Deine Zugangsdaten:

					Email Addresse = $newResident->email
					Password = $password";

					$mail = new Zend_Mail();
					$mail->addTo($newResident->email)
					->setSubject("Du wurdest in der WG aufgenomme!")
					->setBodyText($mailText);

					$this->flash('Der Bewohner mit der Email Addresse '.$newResident->email.' wurde erfolgreich eingetragen.');
					$this->flash('Ein generiertes Passwort wurde per Email zugeschickt.');

					$this->_forward('index');
				} else {
					$this->flash('Es trat ein Fehler beim speichern des neuen Beweohners auf.');
					$this->_forward('new');
				}
			} else {
				$this->flash('Ein Bewohner mit der Emailaddresse '.$form->getValue('email').' existiert bereits.');
				$this->_forward('new');
			}
		} else {
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
		$form->setAction("residents/create")
		->setMethod('post');
			
		$email = new Zend_Form_Element_Text(array(
			'name' => 'email',
			'label' => 'Email Addresse'));
		$email->addValidator(new Zend_Validate_EmailAddress());
		$email->addFilter('StringtoLower');
		$email->setRequired(true);

		$form->addElement($email)
		->addElement('submit', 'aufnehmen', array(
				'label' => 'Bewohner aufnehmen'));
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