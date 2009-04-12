<?php
/**
 * @author Waldemar Schwan <velrok@gmx.de>
 * @date 17.11.2008 21:56:23
 * @year 2008
 * 
 * Decription ...  
 */

class Zend_View_Helper_Menue extends Zend_View_Helper_Abstract {
	
	/**
	 * @param array $menue
	 * @param array $attributes
	 * return string html
	 */
	public function menue(array $menue, $attributes = null)
	{
		if ($attributes){
			$html = "<ul";
			foreach($attributes as $k => $v){
				$html .= " $k=\"$v\"";
			}
			$html .= '>';
		} else {
			$html = "<ul>";
		}
		
		foreach($menue as $menueItem){
			$urlOptions = array(
				'controller' => $menueItem['controller'],
				'action' => $menueItem['action'],
			);
			$html .= '<li><a href="'.$this->view->url($urlOptions).'">';
			$html .= $menueItem['label'].'</a></li>'."\n";
		}
		$html .= "</ul>";
		return $html;
	}
}