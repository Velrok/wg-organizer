<?php
/**
 * @author Waldemar Schwan <velrok@gmx.de>
 * @date 21.03.2008 21:44:17
 * 
 * Adds some usefull fuctionalitiy to Zend_Db_Table_Row_Abstract.
 * 
 * This isn't needed for parsing.
 */

class Hakuchou_TableRow extends Zend_Db_Table_Row_Abstract implements IteratorAggregate {
	
	
	/**
	 * 
	 * @return ArrayIterator
	 */
	public function getIterator()
	{
		return new ArrayIterator($this->toArray());
	}
	
	/**
	 * Returns wheather the Row is a new (unsaved) one.
	 *
	 * @return boolean
	 */
	public function isNew()
	{
		/**
         * If the _cleanData array is empty,
         * this is an INSERT of a new row.
         * Otherwise it is an UPDATE.
         */
        if (empty($this->_cleanData)) {
            return true;
        } else {
            return false;
        }
	}
	
}