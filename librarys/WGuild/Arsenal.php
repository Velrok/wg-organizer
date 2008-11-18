<?php
/**
 * @author Waldemar Schwan <velrok@gmx.de>
 * @date 15.11.2008 21:20:24
 * @year 2008
 *
 * Decription ...
 */

class WGuild_Arsenal {
	
	
	/**
	 * @return SimpleXMLIterator
	 */
	public static function getGuildStats()
	{
		$xmlString = self::getGuildStatsXmlContent();
		$xmlObject = new SimpleXMLIterator($xmlString); 
		return $xmlObject;
	}
	
	
	/**
	 * @return string
	 */
	private static function getGuildStatsXmlContent(){
		ini_set('user_agent', 'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10.5; de; rv:1.9.0.4) Gecko/2008102920 Firefox/3.0.4');
		return file_get_contents(WGuild::getArsenalGuildUrl());
	}
}