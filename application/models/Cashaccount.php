<?php
/**
 * @author 
 * @date 
 * @year 
 * 
 * Decription ...  
 */

class Cashaccount extends BaseModel {
	
	/**
	 * @param int $cents
	 */
	public function addCents($cents){
		$this->balance += $cents;
	}
	
	public function addEuro($euro) {
		$this->addCents($euro * 100);
	}
	
	/**
	 * @param int $cents
	 */
	public function subCents($cents){
		$this->balance -= $cents;
	}
	
	public function subEuro($euro) {
		$this->subCents($euro * 100);	
	}
	
	public function getBalanceInEuro(){
		return $this->balance / 100.0;
	}
	
	public function getBalanceInCent(){
		return $this->balance;
	}
	
}//endClass