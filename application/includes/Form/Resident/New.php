<?php
class Form_Resident_New extends Zend_Form
{
  public function init(){
    $this->setMethod('post');

		$email = new Zend_Form_Element_Text(array(
			'name' => 'email',
			'label' => 'Email Addresse'));
		$email->addValidator(new Zend_Validate_EmailAddress());
		$email->addFilter('StringtoLower');
		$email->setRequired(true);

		$this->addElement($email)
		->addElement('submit', 'aufnehmen', array(
				'label' => 'Bewohner aufnehmen'));
		return $this;
  }
}