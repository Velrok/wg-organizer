<?php
/**
 * @author Waldemar Schwan <velrok@gmx.de>
 * @date 08.11.2008 19:52:57
 * @year 2008
 *
 * Decription ...
 */

class ApplicationController extends Zend_Controller_Action
{

	/**
	 * creats a new ApplicationController
	 *
	 * @param Zend_Controller_Request_Abstract $request
	 * @param Zend_Controller_Response_Abstract $response
	 * @param array $invokeArgs
	 * @return ApplicationController
	 */
	public function __construct(Zend_Controller_Request_Abstract $request, Zend_Controller_Response_Abstract $response, array $invokeArgs = array())
	{
		parent::__construct($request,$response,$invokeArgs);
    
		// retting old post if this is a redirect
		$session = new Zend_Session_Namespace('workarounds');
		if($session->lastPost){
			$_POST = $session->lastPost;
		}
		unset($session->lastPost);
		
    $this->view->basepath = Zend_Controller_Front::getInstance()->getBaseUrl();
		$this->view->pageTitle = "WG Organizer";

		$this->view->currentResident = $this->getCurrentResident();

		$this->view->mainMenue = $this->getMainMenue();
		$this->view->subMenue = $this->getSubMenue();

		$this->view->flashMessenger = $this->_helper->getHelper('FlashMessenger');
	}
	
	public function getBasePath()
	{
		return str_replace('index.php', '', $_SERVER['PHP_SELF']);
	}

	public function getMainMenue()
	{
		// if you arn't logged in, just show links to the pubilc resources
		if ($this->getCurrentResident()){
			return $this->residentsMainMenue();
		} else {
			return $this->guestMainMenue();
		}
	}

	protected function residentsMainMenue()
	{
		$menue = array();

		$link = array(
			'label' => 'Startseite',
			'controller' => 'index',
			'action' => 'index',
		);
		$menue[] = $link;

		$link = array(
			'label' => 'Einkäufe',
			'controller' => 'buyings',
			'action' => 'index',
		);
		$menue[] = $link;

		$link = array(
			'label' => 'Gemeinschaftskasse',
			'controller' => 'moneypool',
			'action' => 'index',
		);
		$menue[] = $link;

		$link = array(
			'label' => 'Bewohner',
			'controller' => 'residents',
			'action' => 'index',
		);
		$menue[] = $link;

		$link = array(
			'label' => 'Abmelden',
			'controller' => 'session',
			'action' => 'destroy',
		);
		$menue[] = $link;

		return $menue;
	}

	protected function guestMainMenue(){
		$menue[] = array();

		$link = array(
			'label' => 'Startseite',
			'controller' => 'index',
			'action' => 'index',
		);
		$menue[] = $link;
			
		$link = array(
			'label' => 'Anmelden',
			'controller' => 'session',
			'action' => 'new',
		);
		$menue[] = $link;

		return $menue;
	}

	protected function requirePost()
	{
		if (!$this->getRequest()->isPost()){
			throw new Exception_IllegalMethod("Method needs to be POST");
		}
	}

	/**
	 * @return Resident
	 */
	public function getCurrentResident()
	{
		$s = new Zend_Session_Namespace();
		return $s->currentResident;
	}

  /**
   * @return bool
   */
  public function hasCurrentResident()
  {
    if($this->getCurrentResident() == null){
      return false;
    } else {
      return true;
    }
  }

	/**
	 * API equals _forward.
	 * Althow recovers old post data to next action.
	 *
	 * @param string $action
	 * @param string $controller
	 * @param string $module
	 * $param array $params
	 *
	 * @return void
	 */
	protected function redirect($action, $controller=null, $module=null, array $params=array())
	{
		// do some workaround to tranport last post to redirected action
		$session = new Zend_Session_Namespace('workarounds');
		$session->lastPost = $_POST;

		$redirector = $this->_helper->getHelper('Redirector');
		$redirector->setGotoSimple($action, $controller, $module, $params);
		$redirector->redirectAndExit();
	}

	/**
	 * adds $message to the FlashMessage helper
	 *
	 * @param string $message
	 */
	protected function flash($message)
	{
		return $this->view->flashMessenger->addMessage($message);
	}

	/**
	 * @return array
	 */
	protected function getSubMenue()
	{
		return null;
	}

	/**
	 * @return string
	 */
	protected function requestedFormat(){
		return $this->getRequest()->getParam('format');
	}

}