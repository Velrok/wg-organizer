<?php
/**
 * @author
 * @date
 * @year
 *
 * Decription ...
 */

class MoneypoolController extends ApplicationController
{


	/**
	 * Enter description here...
	 *
	 */
	public function indexAction(){
		$this->view->residents = Table_Residents::getInstance()->fetchAll();
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
		$cashaccounts = Table_Cashaccounts::getInstance()->fetchAll();

		try {
			$mail = new Zend_Mail();
			$mail->setSubject("[WGOrganizer] Kassensturz durchgeführt.");

			$mailMessage = $this->getCurrentResident()->getName();
			$mailMessage .= " hat die Gemeinschaftskasse zurückgesetzt.\n\n";

			$mailMessage .= "Die Kontostände waren: \n";

			foreach($cashaccounts as $cashaccount){
				$resident = $cashaccount->getResident();
				$mailMessage .= $resident->getName();
				$mailMessage .= "\t\t";
				$mailMessage .= $cashaccount->getBalanceInEuro() . " €\n";
					
				$mail->addTo($resident->getEmail());
			}

			$mail->setBodyText($mailMessage);
//			$mail->send();
				
			foreach($cashaccounts as $cashaccount){
				$cashaccount->setBalanceInCent(0);
				$cashaccount->save();
			}
			
			$this->flash("Kassensturz durchgefürt");
		}

		catch (Exception $e){
			$errorMail = new Zend_Mail();
			$errorMail->setSubject("[WGOrganizer] Beim ausführen des Kassensturz ist ein Fehler aufgetreten.");
			foreach($cashaccounts as $cashaccount){
				$errorMail->addTo($resident->getEmail());
			}
				
			$notice = "Der Kassenstruz wurde NICHT durchgeführt, weil ein Fehler aufgetreten ist.\n\n";
				
			$errorMailMessage = $notice;
			$this->flash($notice);
				
			$errorMailMessage .= "Fehlermeldung:\n";
			$errorMailMessage .= $e->getMessage();
			$this->flash($e->getMessage());
				
			$errorMailMessage .= "\n\nStacktrace:\n";
			$errorMailMessage .= $e->getTraceAsString();
				
			$errorMail->setBodyText($errorMailMessage);
				
			$errorMail->send();
		}

		$this->redirect('index');
	}

	public function getSubMenue(){
		$menue = array();

		$link = array(
			'label' => 'Kassensturz',
			'controller' => 'moneypool',
			'action' => 'destroy',
		);
		$menue[] = $link;

		return $menue;
	}
}//endClass