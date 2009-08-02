<?php
/**
 * @author
 * @date
 * @year
 *
 * Decription ...
 */

class SetupController extends ApplicationController {

  public function indexAction() {

  }

  /**
   * Enter description here...
   *
   */
  public function installAction() {
    $this->view->form = $this->getConfigForm();
  }

  public function createconfigAction() {
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
      $this->createDbAction();
      $this->redirect('index', 'index');
      return;
    } else {
      $this->flash('Formular nicht korrekt.');
      $this->redirect('install');
      return;
    }
  }

  public function createdbAction() {
    $this->debug('createdbAction');
    $filename = APPLICATION_PATH . '/config/app.ini';
    $configuration = new Zend_Config_Ini(
        $filename,
        APPLICATION_ENVIRONMENT);

    $dbAdapter = Zend_Db::factory($configuration->database);
    $this->debug('Beginning Transaction');
    $dbAdapter->beginTransaction();

    try {
      $form = $this->getConfigForm();
      $form->populate($_POST);

      $this->debug('Setting Default Addapter');
      Zend_Db_Table_Abstract::setDefaultAdapter($dbAdapter);

      $registry = Zend_Registry::getInstance();
      $registry->configuration = $configuration;
      $registry->dbAdapter     = $dbAdapter;

      $database_path = APPLICATION_PATH.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."database". DIRECTORY_SEPARATOR;
      $database_dir = new DirectoryIterator($database_path);

      $sql = file_get_contents($database_path.'schema.sql');
      $this->debug("executing schema.sql sql= ". $sql);
      $dbAdapter->query($sql);


      foreach ($database_dir as $file) {
        if($file->isFile() &&
            preg_match("/\d\d\d.*/", $file->getFilename())) { // starts with a number

          $sql = file_get_contents($database_path.$file->getFilename());
          $this->debug("executing $file sql: ". $sql);
          $dbAdapter->query($sql);
        }
      }

      $data = array(
          'email' => $form->getValue('email'),
          'password_hash' => md5($form->getValue('password')),
      );

      $new_resident = Table_Residents::getInstance()->createRow($data);
      $new_resident->save();
      $this->debug('db commit');
      $dbAdapter->commit();
    }

    catch (Exception $e ) {
      $this->debug('Exception: '.$e->getMessage(). $e->getTraceAsString());

      unlink($filename);
    }
  }

  /**
   * @return Zend_Form
   */
  private function getConfigForm() {
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

    $dbpassword = new Zend_Form_Element_Password(array(
        'name' => 'dbpassword',
        'label' => 'Datenbank Passwort'));
    $dbpassword->setRequired(false);

    $email = new Zend_Form_Element_Text(array(
        'name' => 'email',
        'label' => 'Email Addresse des ersten Bewohners'));
    $email->addValidator(new Zend_Validate_EmailAddress());
    $email->addFilter('StringtoLower');
    $email->setRequired(true);

    $password = new Zend_Form_Element_Password(array(
        'name' => 'password',
        'label' => 'Password des ersten Bewohners'));
    $password->setRequired(true);

    $form->addElement($dbname)
        ->addElement($dbuser)
        ->addElement($dbpassword);

    $form->addElement($email)
        ->addElement($password);

    $form->addElement('submit', 'aufnehmen', array(
        'label' => 'weiter'));
    return $form;
  }

}//endClass