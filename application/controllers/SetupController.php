<?php
/**
 * @author 
 * @date 
 * @year 
 * 
 * Decription ...  
 */

class SetupController extends ApplicationController  
{

	public function indexAction()
	{
		
	}
	
	/**
	* Enter description here...
	 *
	 */
	public function installAction(){
		$this->view->form = $this->getConfigForm();
	}
	
	public function createconfigAction(){
		$form = $this->getConfigForm();
		
		if($form->isValid($_POST)) {
			$file = 
'[production]
	database.adapter       = "PDO_MYSQL"
	database.params.dbname = "'.$form->getValue('dbname').'"
	database.params.host = "localhost"
	database.params.username = "'.$form->getValue('dbuser').'"
	database.params.password = "'.$form->getValue('dbpassword').'"
[development : production]
[testing : production]';
			file_put_contents(APPLICATION_PATH . '/config/app.ini',$file);
			$this->createDb();
		} else {
			$this->flash('Formular nicht korrekt.');
			$this->redirect('install');
		}
	}
	
	public function createDb()
	{
		$adapter = Zend_Registry::getInstance()->dbAdapter;
		$adapter->
		
		$a = Zend_Db_Table_Abstract
	}
	
	/**
	 * @return Zend_Form
	 */
	private function getConfigForm()
	{
		$form = new Zend_Form();
		$form->setAction($this->getBasePath() . "setup/create_config")
			->setMethod('post');
			
		$dbname = new Zend_Form_Element_Text(array(
			'name' => 'dbname',
			'label' => 'Datenbankname'));
		$dbname->setRequired(true);

		$dbuser = new Zend_Form_Element_Text(array(
			'name' => 'dbuser',
			'label' => 'Datenbank Benutzername'));
		$dbuser->setRequired(true);
		
		$dbpassword = new Zend_Form_Element_Text(array(
			'name' => 'dbpassword',
			'label' => 'Datenbank Passwort'));
		$dbpassword->setRequired(true);
		
		$form->addElement($dbname)
			->addElement($dbuser)
			->addElement($dbpassword)
			->addElement('submit', 'aufnehmen', array(
				'label' => 'weiter'));
		return $form;
	}
}//endClass