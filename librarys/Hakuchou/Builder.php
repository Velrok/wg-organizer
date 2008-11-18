<?php
/**
 * @author Waldemar Schwan <velrok@gmx.de>
 * @date 2008 14:27:35
 *
 * Abstract superclass of all Builder.
 * Builder are used by the Hakuchou_Parser_View to 
 * generate output. Normaly you will use Hakuchou_Builder_Html to 
 * generate html output, but you are free to implement youre own Builder
 * for your owne ouput formats, like XML CSV or anything else.
 * 
 */
 
abstract class Hakuchou_Builder{
	
	
	public function setEncoding($encoding){}

	
	public function beginBlock($name){}
	public function endBlock(){}
	public function newElement($name, $value){}
	
	
	public abstract function getResult();
	public abstract function echoResult();
	
}
?>