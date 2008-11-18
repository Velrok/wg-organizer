<?php
/**
 * @author Waldemar Schwan <velrok@gmx.de>
 * @date 16.03.2008 23:44:59
 * @year 2008
 * 
 * A collection of usefull functions  
 */

class RainSystem{
	
	/**
	 * prints an string an adds <br> and \n 
	 *
	 * @param mixed $var
	 */
	public static function println($var){
		echo $var."<br>\n";
	}
	
	
	public static function generateMD5Hash($var)
	{
		return md5($var);
	}
}