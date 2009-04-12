<?php

/**
 * Provides a way for a simple date formatting.
 */
class Zend_View_Helper_DateFormat extends Zend_View_Helper_Abstract {
	public function dateFormat($date) {
    	
    	$fmt = new Zend_Date($date); 
    	
    	return $fmt->toString('EE dd.MM.YY') . "<br>" . $fmt->toString('HH:mm');
    }  	
}