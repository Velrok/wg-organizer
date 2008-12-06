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
		$residents = new Table_Residents();
		return $residents->fetchRow(array('id = ?' => $this->resident_id));
	}
	
	/**
	 * @param Resident $resident
	 */
	public function setResident($resident){
		$this->resident_id = $resident->id;
	}
	
}//endClass