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
	
	public function count(){
		return $this->fetchAll()->count();
	}
	
	
	public function findById($id){
		return $this->fetchRow(array("id = ?" => $id));
	}
	
	/**
     * Fetches one row in an object of type Zend_Db_Table_Row_Abstract,
     * or returns Boolean false if no row matches the specified criteria.
     *
     * @param string|array|Zend_Db_Table_Select $where  OPTIONAL An SQL WHERE clause or Zend_Db_Table_Select object.
     * @param string|array                      $order  OPTIONAL An SQL ORDER clause.
     * @return Zend_Db_Table_Row_Abstract The row results per the
     *     Zend_Db_Adapter fetch mode, or null if no row found.
     */
	public function findOne($where, $order=null){
		return $this->fetchRow($where, $order);
	}
}