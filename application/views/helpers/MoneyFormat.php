<?php

/**
 * Provides a way for a simple money formatting.
 * 
 * Example:
 *  $price = 1.40;
 *  echo $this->moneyFormat($price);
 *  
 * Result:
 *  1.40 €
 */
class Zend_View_Helper_MoneyFormat extends Zend_View_Helper_Abstract {
	
	public function moneyFormat($price, $currency = "EUR") {
    	$text = sprintf("%.2f", ($price / 100));
    	
    	if ( $currency == "EUR" ) {
    		$text .= " &euro;";	
    	}
    	else if ( $currency == "USD" ) {
    		$text = '$ ' . $text;
    	}
    	else if ( $currency == "YEN") {
    		$text .= " &yen;";	
    	}
    	return $text;
    }  	
}