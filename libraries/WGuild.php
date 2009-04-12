<?php
/**
 * @author Waldemar Schwan <velrok@gmx.de>
 * @date 15.11.2008 20:47:39
 * @year 2008
 * 
 * Decription ...  
 */

class WGuild {
	
	/**
	 * @return string
	 */
	public static function getArsenalGuildUrl()
	{
		return Zend_Registry::getInstance()->get('configuration')->ArsenalGuildUrl;
	}
}