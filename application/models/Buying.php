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
	 * @return float
	 */
	public function getPriceInEuro(){
		return $this->price / 100.0;
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
	
	protected function _doInsert(){
		$result = parent::_doInsert();
		$pricePerResident = ($this->price / Table_Residents::getInstance()->count());
		return $result;
	}
	
	
}//endClass