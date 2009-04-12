<?php
/**
 * @author Waldemar Schwan <velrok@gmx.de>
 * @date 18.11.2008 02:34:37
 * @year 2008
 * 
 * Decription ...  
 */

class Zend_View_Helper_RandomBackground extends Zend_View_Helper_Abstract {
	
	public function randomBackground($numberOfPictures)
	{
		$session = new Zend_Session_Namespace();
		if (!$session->backgroud){
			$session->backgroud = rand(1,$numberOfPictures); 
		}
		return "background: #222222 url('".$this->view->basepath."/asf/img/$session->backgroud.jpg') no-repeat center top";
	}
	
}