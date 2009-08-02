<?php
/**
 * @author 
 * @date 
 * @year 
 * 
 * Decription ...  
 */

class Buying extends BaseModel {
	
	/**
	 * @return string
	 */
	public function getDescription() {
		return $this->description;	
	}
	
	/**
	 * @return integer
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 * @return string
	 */
	public function getBoughtAt() {
		return $this->bought_at;	
	}
	
	/**
	 * @return float
	 */
	public function getPriceInEuro(){
		return $this->price / 100.0;
	}
	
	/**
	 * @return float
	 */
	public function getPrice() {
		return $this->price;	
	}
	
	/**
	 * @param float $newPrice
	 * @return void
	 */
	public function setPriceInEuro($newPrice){
		$this->price = (int)($newPrice * 100);
	}
	
	public function setDescription($description){
		$this->description = $description;
	}
	
	/**
	 * @return Resident
	 */
	public function getResident(){
		$resident = Table_Residents::getInstance()->fetchRow(array('id = ?' => $this->resident_id));
		if ($resident){
			return $resident;
		} else {
			return new UnknownResident();
		}
	}
	
	/**
	 * @param Resident $resident
	 */
	public function setResident($resident){
		$this->resident_id = $resident->id;
	}
	
	/**
     * @return mixed The primary key value(s), as an associative array if the
     *     key is compound, or a scalar if the key is single-column.
     */
	protected function _doInsert(){
		$result = parent::_doInsert();
		$pricePerResident = ($this->price / Table_Residents::getInstance()->count());
		
		// you get youre money back
		$youreCashAccount = $this->getResident()->getCashAccount();
		$youreCashAccount->addCents($this->price);
		$youreCashAccount->save();
		
		// all have to pay the same ammount (including yourself)
		foreach (Table_Cashaccounts::getInstance()->fetchAll() as $cashaccount){
			$cashaccount->subCents($pricePerResident);
			$cashaccount->save();
		}
		
		return $result;
	}
	
	
}//endClass