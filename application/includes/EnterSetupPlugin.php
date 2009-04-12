<?php
/**
 * @author Waldemar Schwan <velrok@gmx.de>
 * @date 18.11.2008 00:07:34
 * @year 2008
 *
 * Decription ...
 */

class EnterSetupPlugin extends Zend_Controller_Plugin_Abstract {

	/**
	 * @param Zend_Controller_Request_Http $request
	 */
	public function preDispatch($request)
	{
		if ($request->getControllerName() == 'setup' || $request->getControllerName() == 'error') {
			// allow all setup actions
			// and all error actions
			return;
		} else {
			// redirect other to setup install
			$request->setControllerName('setup');
			$request->setActionName('install');
		}
	}
}