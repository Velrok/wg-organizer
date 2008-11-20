<?php
/**
 * @author 
 * @date 
 * @year 
 * 
 * Decription ...  
 */

class Table_Cashaccounts extends BaseTable {
	/**
	 * @var = Table_Cashaccounts
	 */
	private static $uniqueInstance = null;
	
	protected $_name = 'Cashaccounts';
	protected $_rowClass = 'Cashaccount';
	
	/**
	 * @return Table_Cashaccounts
	 */
	public function getInstance()
	{
		if(!self::$uniqueInstance){
			self::$uniqueInstance = new Table_Cashaccounts();
		}
		return self::$uniqueInstance;
	}
}//endClass