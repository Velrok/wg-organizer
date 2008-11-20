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
			->where('resident_id = ?', $di);
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
	
}//endClass