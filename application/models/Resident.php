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
	
}//endClass