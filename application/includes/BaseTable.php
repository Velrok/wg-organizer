<?php
/**
 * @author Waldemar Schwan <velrok@gmx.de>
 * @date 15.11.2008 19:56:23
 * @year 2008
 * 
 * Decription ...  
 */

class BaseTable extends Zend_Db_Table_Abstract  {
	
	private static $uniqueInstance = null;
	
	/**
	 * @return boolean
	 */
	public function isEmpty()
	{
		$result =  $this->getAdapter()->query('select count(*) as rowcount from '.$this->_name);
		$result->execute();
		if ($result->fetchObject()->rowcount <= 0){
			return true;
		} else {
			return false;
		}
	}
	
}