<?php
/**
 * @author Waldemar Schwan <velrok@gmx.de>
 * @date 2008 14:24:22
 *
 * This is a builder, wich generates html output using 
 * xTemplate.
 */
 
class Hakuchou_Builder_Html extends Hakuchou_Builder
{
	/**
	 * @var XTemplate
	 */
	protected $xTemplate;
	
	/**
	 * @var Block
	 */
	protected $lastBlock;
	
	/**
	 * @var Block
	 */
	protected $currentBlock = null;
	
	/**
	 * @var Block
	 */
	protected $mainBlock;
	
	/**
	 * @var ArrayObject
	 */
	protected $currentBlockPath = array();
	
	/**
	 * @return Hakuchou_Builder_Html
	 */
	public function __construct($templateFile, $templateDir)
	{
		$this->xTemplate = new XTemplate($templateFile, $templateDir);
	}
	
	/**
	 * Returns restult as a string.
	 * 
	 * @return string
	 */
	public function getResult(){
		throw new Hakuchou_Exception("implement");
	}
	
	/**
	 * Outputs result to std out.
	 * 
	 * @return void
	 */
	public function echoResult()
	{
		$this->parseBlock($this->mainBlock);
		$this->xTemplate->out('main');
	}
	
	/**
	 * Starts an block named $name
	 * 
	 * @param string $name
	 * @return void
	 */
	public function beginBlock($name)
	{
		if($this->currentBlock){
			$this->currentBlock = $this->currentBlock->addBlock($name);
			// save current assignment state
			$this->currentBlock->parent->vars = $this->xTemplate->vars;
		} else {
			// first Block
			$this->currentBlock = new Block($name, null);
			$this->mainBlock = $this->currentBlock;
		}
	}
	
	/**
	 * Closes last block, returning to its parent.
	 * 
	 * @return void
	 */
	public function endBlock(){
		// merg saved assignemtns ( befor subblock was created ) 
		// with new assignments made during prosess
		$this->currentBlock->vars = $this->currentBlock->vars + $this->xTemplate->vars;
		
		if($this->currentBlock->parent){
			// set xTemplate assignment sate back to parent values
			$this->xTemplate->vars = $this->currentBlock->parent->vars;
			
			$this->currentBlock = $this->currentBlock->parent;
		}
	}
	
	/**
	 * Adds a new element to the current block.
	 * 
	 * @param string $name
	 * @param mixed $value
	 * @return void
	 */
	public function newElement($name, $value)
	{
//		Zend_Debug::dump($value, "new Element $name");
		$this->xTemplate->assign($name, $value);
	}
	
	/**
	 * Parses a block recursiv.
	 * 
	 * @param Block $block
	 * @return void
	 */
	private function parseBlock(Block $block){
		$id = count($this->currentBlockPath);
//		Zend_Debug::dump($id, 'id');
		$this->currentBlockPath[$id] = $block->name; 
		
		foreach ($block->subBlocks as $subBlock){
			$this->parseBlock($subBlock);
		}
		
//		Zend_Debug::dump($block->vars, "Block Vars");
		$this->xTemplate->vars = $block->vars;
		$blockPath = implode('.', $this->currentBlockPath);
//		Zend_Debug::dump($this->xTemplate->vars, "xTemplate Vars");
//		Zend_Debug::dump($blockPath, 'block path');
		$this->xTemplate->parse($blockPath);
		
		unset($this->currentBlockPath[$id]);
	}
}

/**
 * Represents an xTemplate block. 
 * Containing its own vars, so the blocks of the same kind
 * don't refer to the assignvalues of its silbings.
 */
class Block
{
	/**
	 * @var Block
	 */
	public $parent = null;
	
	public $subBlocks = array();
	public $name = '';
	public $vars = array();
	
	/**
	 * @return Block
	 */
	public function __construct($name, $parent){
		$this->parent = $parent;
		$this->name = $name;
	}
	
	/**
	 * @return Block
	 */
	public function addBlock($name){
		$newBlock = new Block($name, $this);
		$this->subBlocks[] = $newBlock;
		return $newBlock;
	}
}
?>