<?php
/**
 * @author Waldemar Schwan <velrok@gmx.de>
 * @date 18.11.2008 02:34:37
 * @year 2008
 * 
 * Decription ...  
 */

class Zend_View_Helper_Cycle extends Zend_View_Helper_Abstract {
	private static $counter = -1;
	
	/**
	 * @param array $values
	 * @return string
	 */
	public function cycle($values)
	{
		self::$counter++;
		self::$counter %= count($values);
		return $values[self::$counter];
	}
	
}