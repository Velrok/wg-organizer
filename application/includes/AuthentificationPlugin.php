<?php
/**
 * @author Waldemar Schwan <velrok@gmx.de>
 * @date 18.11.2008 00:07:34
 * @year 2008
 *
 * Decription ...
 */

class AuthentificationPlugin extends Zend_Controller_Plugin_Abstract {

	/**
	 * @param Zend_Controller_Request_Http $request
	 */
	public function preDispatch($request)
	{
		// dont filter anything if a resident is logged in
		$session = new Zend_Session_Namespace();
		
		if($session->currentResidentId){
			$session->currentResident = Table_Residents::getInstance()->find($session->currentResidentId)->current();
			return;
		}
		
		
		// allow index and session controller to all
		if ($request->getControllerName() == 'index' ||
		$request->getControllerName() == 'session'){
			return;
		}
		
		// else redirect to frontpage
		$request->setControllerName('index');
		$request->setActionName('index');
	}

}