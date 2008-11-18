<?php
/**
 * @author Waldemar Schwan <velrok@gmx.de>
 * @date 2008 14:22:27
 *
 * Parses Hakuchou_Parser_View.
 */
 
class Hakuchou_Parser_View extends Hakuchou_Parser 
{
	
	/**
	 * @var Hakuchou_View
	 */
	protected $objectToBeeParsed;
	
	/**
	 * @return Hakuchou_Parser_View
	 */
	public function __construct(Hakuchou_Builder $builder, Hakuchou_View $view, $name)
	{
		parent::__construct($builder, $view, $name);
	}
	
	public function parse()
	{
		$this->builder->setEncoding($this->objectToBeeParsed->getEncoding());
		parent::getParserFor($this->objectToBeeParsed->getMainContainer(),
								$this->objectToBeeParsed->getMainContainer()->getName())
								->parse();
	}

}
?>