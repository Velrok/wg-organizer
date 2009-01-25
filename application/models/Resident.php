<?php
/**
 * @author
 * @date
 * @year
 *
 * Decription ...
 */

class Resident extends BaseModel {

	protected $_tableClass = 'Table_Residents';

	/**
	 * @return string
	 */
	public function getAppAuthKey() {
		return $this->appauth_key;	
	}

	/**
	 * @return mixed
	 */
	public function save()
	{
		$id = parent::save();
		$cashAccounts = Table_Cashaccounts::getInstance();
		$select = $cashAccounts->select()
		->where('resident_id = ?', $id);
		$rows = $cashAccounts->fetchAll($select);

		if ($rows->count() > 0){
			// found needs update
			$rows->current()->save();
		} else {
			// not found
			// means new resitend -> create an cash account
			$cashAccounts->createRow(array('resident_id' => $id))->save();
		}

		return $id;
	}

	/**
	 * @return string
	 */
	public function getEmail(){
		return $this->email;
	}

	public function getName(){
		if($this->name != null && $this->name != ''){
			return $this->name;
		} else {
			return $this->email;
		}
	}

	/**
	 * @return Cashaccount
	 */
	public function getCashAccount()
	{
		$select = Table_Cashaccounts::getInstance()
		->select()
		->where('resident_id = ?', $this->id);
		$rows = Table_Cashaccounts::getInstance()->fetchAll($select);
		return $rows->current();
	}

	public function delete(){
		if ($this->getCashAccount()->getBalanceInCent() != 0) {
			throw new Exception_BuisnessLogic("Das Konto von ".$this->getName()." ist nicht ausgeglichen.");
		}
		
		if ($this->getCashAccount()->delete() > 0){
			parent::delete();
		}
	}

}//endClass