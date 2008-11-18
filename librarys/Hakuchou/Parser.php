<?php
/**
 * @author Waldemar Schwan <velrok@gmx.de>
 * @date 2008 20:30:10
 * 
 * Superclass of all Parser. Is capable of finding another parser for a
 * given class.
 * 
 * Put all your application specific parsers into an folder contained in the 
 * include path of youre application and use the Zend naming convention to store 
 * php clases in folders and subFolders.
 * 
 * Tip: You can use the helper folder to store youre parsers.
 * Notice: You will need to add this folder to your includepath too.
 * 
 * example:
 * /application/default/helpers/Hakuchou/Parser/MyClass.php
 * will contain an Parser for the class MyClass names Hakuchou_Parser_MyClass.
 */

abstract class Hakuchou_Parser {

	/**
	 * @var Hakuchou_Builder
	 */
	protected $builder;

	/**
	 * @var string
	 */
	protected $name;

	/**
	 * @var mixed
	 */
	protected $objectToBeeParsed;

	/**
	 * @return Hakuchou_Parser
	 */
	public function __construct(Hakuchou_Builder $builder, $objectToBeeParsed, $name)
	{
		$this->builder = $builder;
		$this->objectToBeeParsed = $objectToBeeParsed;
		$this->name = $name;
	}


	/**
	 * Returns a parser for the given objects referenced in the template by
	 * the given name. Will search the classhierarchy up until it finds an 
	 * Hakuchou_Parser. If it is an object the last Parser will be 
	 * Hakuchou_Parser_Object.
	 * 
	 * @return Hakuchou_Parser
	 */
	public function getParserFor($object, $name)
	{
		if(is_scalar($object))
		throw new Hakuchou_Exception('First param ($object) hast to be of none-scalar type. '.gettype($object).' given.');

		if(!is_string($name))
		throw new Hakuchou_Exception('Secound param ($name) hast to be of type string. '.gettype($objectName).' given.');

			
		$parserclassname = $this->getParserclassname(get_class($object));

		return new $parserclassname($this->builder, $object, $name);
	}

	/**
	 * This function basicly adds an Hakuchou_Parser_ prefix to the 
	 * given classname.
	 * 
	 * @param string $classname
	 * 
	 * @returns string String of the parserclass conresponding to $classname. 
	 */
	private function getParserclassname($classname)
	{
		try{
			// load Parser class for object class
			$parserclassname = 'Hakuchou_Parser_'.$classname; 
				
			Zend_Loader::loadClass($parserclassname);
			return $parserclassname;
		}
			
		catch (Zend_Exception $e){
				
			// no direct parser class found

			$parentClass = get_parent_class($classname);
			if($parentClass !== false){
				// try to load parser class for parent class
				return $this->getParserclassname($parentClass);
			} else {
				// no specific parser class found
				// use parser class for stdObjects
				return 'Hakuchou_Parser_Object';
			}
		}
	}

	public abstract function parse();
	

}
?>