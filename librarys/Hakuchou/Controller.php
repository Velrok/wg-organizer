<?php
/**
 * @author Waldemar Schwan <velrok@gmx.de>
 * @date 16.03.2008 23:44:59
 * @year 2008
 * 
 * Adds some functionalitiy to Zend_Controller_Action.
 */

abstract class Hakuchou_Controller extends Zend_Controller_Action {
	
	/**
	 * input
	 *
	 * @var Zend_Filter_Input
	 */
	protected $input;
	
	/**
     * View object
     * @var Hakuchou_View
     */
    public $view;
    
    /**
     * stores Zend_Filters.
     * example:
     * array(
     * 	'id' => new Zend_Filter_Digits(),
     * )
     * 
     * @var array
     */
    protected $filterRules = array();
    
    /**
     * stores Zend_Validators.
     * array(
     * 	'id' => new Zend_Validate_Digits(),
     * )
     * 
     * @var array
     */
    protected $validateRules = array();
    
	
	/**
     * Class constructor
     *
     *
     * @param Zend_Controller_Request_Abstract $request
     * @param Zend_Controller_Response_Abstract $response
     * @param array $invokeArgs Any additional invocation arguments
     * @return Hakuchou_Controller
     */
	public function __construct(Zend_Controller_Request_Abstract $request, Zend_Controller_Response_Abstract $response, array $invokeArgs = array())
	{
		parent::__construct($request, $response, $invokeArgs);
		
		$this->view->Navigation = $this->createNavigation();
		
		$this->validateInput();
		
		foreach($request->getParams() as $param => $value){
			$this->view->$param = $value;
		}
		
		
	}
	
	/**
	 * Callbackfunction to create a Hakuchou_Navigation, wich is assigned to the view.
	 *
	 * @return Hakuchou_Navigation
	 */
	abstract protected function createNavigation();
	

	/**
	 * Callbackfunction to validate input.
	 * Input is available at $this->input.
	 *
	 */
	protected function validateInput()
	{
		$this->input = new Zend_Filter_Input($this->filterRules, 
												$this->validateRules, 
												$this->getRequest()->getParams());
	}
	
	
	/**
	 * sets title in view
	 *
	 * @param string $title
	 */
	protected function setTitle($title)
	{
		$this->view->titel = $title;
	}
	
	/**
	 * Adds an array of Zend_Filter to $this->filterRules
	 * merging bouth arrays.
	 * IMPORTANT: You need to call validateInput afterwards.
	 * 
	 * @param array $filterRules
	 * @return void
	 */
	protected function addFilterRules(array $filterRules)
	{
		array_merge($this->filterRules, $filterRules);
		$this->validateInput();
	}
	
	/**
	 * Adds an array of Zend_Validator to $this->validateRules
	 * merging bouth arrays.
	 * 
	 * @param array $validatorRules
	 * @return void
	 */
	protected function addValidatorRules(array $validatorRules)
	{
		array_merge($this->filterRules, $validatorRules);
		$this->validateInput();
	}
	
	
	/**
	 * setts an error message to view
	 *
	 * @param string $msg
	 */
	protected function setErrorMessage($msg)
	{
		$this->view->errorMessage = $msg;
	}
	
	
	
}