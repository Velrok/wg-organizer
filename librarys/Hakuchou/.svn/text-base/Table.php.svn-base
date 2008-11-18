<?php
/**
 * @author Waldemar Schwan <velrok@gmx.de>
 * @date 23.03.2008 02:20:01
 * @year 2008
 * 
 * Adds some functionality. Isn't needed for parsing.
 */

abstract class Hakuchou_Table extends Zend_Db_Table_Abstract  {
	
	/**
	 * number of table rows
	 *
	 * @return int
	 */
	public function count()
	{
		$sql = "SELECT COUNT(*) AS count FROM $this->_name";
		$result = $this->getDefaultAdapter()->query($sql)->fetchObject();
		
		return (int)$result->count;
	}
	
}