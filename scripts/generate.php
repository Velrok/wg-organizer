#!/usr/bin/php
<?php

if ($argv[0] != 'scripts/generate' &&
$argv[0] != '/scripts/generate') {
	print_ln("please start from project root");
	exit -1;
}

switch ($argv[1]){

	case 'controller':
		controller($argv);
		break;
	
	case 'resource':
		resource($argv);
		break;
		
	case 'model':
		model($argv);
		break;

	case null:
	case '-h':
		print_ln(file_get_contents("scripts/help/generate.txt"));
		break;

	default:
		echo "argument not understand: ".$argv[1];
}

/*
 * 			functions
 */

function model($argv){
	if (!$argv[2]) {
		print_ln("no model name given");
		exit;
	}
	
	$modelName = mb_convert_case($argv[2], MB_CASE_TITLE);
	$modelNamePlural = $modelName.'s';
	
	$modelFileName = "application/models/".$modelName.'.php';
	$modelTableFileName = "application/models/Table/".$modelNamePlural.'.php';
	
	
	// model file creation
	if (file_exists($modelFileName)) {
		print_ln("exists: ".$modelFileName);
	} else {
		touch($modelFileName);
		file_put_contents($modelFileName, modelCodeFor($modelName, $modelNamePlural));
		print_ln("create: ".$modelFileName);
	}
	
	// model table file creation
	if (file_exists($modelTableFileName)) {
		print_ln("exists: ".$modelTableFileName);
	} else {
		touch($modelTableFileName);
		file_put_contents($modelTableFileName, modelTableCodeFor($modelName, $modelNamePlural));
		print_ln("create: ".$modelTableFileName);
	}
	
	print_ln("remember to create a databse table called $modelNamePlural");
}

function modelCodeFor($modelName, $modelNamePlural){
	$modelCode = "<?php
/**
 * @author 
 * @date 
 * @year 
 * 
 * Decription ...  
 */

class $modelName extends BaseModel {
	
}//endClass";
	return $modelCode;
}

function modelTableCodeFor($modelName, $modelNamePlural){
	$tableCode = "<?php
/**
 * @author 
 * @date 
 * @year 
 * 
 * Decription ...  
 */

class Table_$modelNamePlural extends BaseTable {
	/**
	 * @var = Table_$modelNamePlural
	 */
	private static \$uniqueInstance = null;
	
	protected \$_name = '$modelNamePlural';
	protected \$_rowClass = '$modelName';
	
	/**
	 * @return Table_$modelNamePlural
	 */
	public function getInstance()
	{
		if(!self::\$uniqueInstance){
			self::\$uniqueInstance = new Table_$modelNamePlural();
		}
		return self::\$uniqueInstance;
	}
}//endClass";
	return $tableCode;
}

function resource($argv){
	$restfullArgs[0] = $argv[0];
	$restfullArgs[1] = $argv[1];
	$restfullArgs[2] = $argv[2]; // controllername
	
	$restfullArgs[] = 'index';
	$restfullArgs[] = 'show';
	$restfullArgs[] = 'new';
	$restfullArgs[] = 'edit';
	$restfullArgs[] = 'create';
	$restfullArgs[] = 'update';
	$restfullArgs[] = 'destroy';
	
	if (!$argv[2]) {
		print_ln("no resource name given");
		exit;
	}

	$controllerName = mb_convert_case($argv[2], MB_CASE_TITLE);
	// creating controller file
	$controllerFile = "application/controllers/".$controllerName."Controller.php";
	if (file_exists($controllerFile)) {
		print_ln("exists: ".$controllerFile);
	} else {
		touch($controllerFile);
		file_put_contents($controllerFile, zendControllerCodeForControllerNamed($controllerName, $restfullArgs));
		print_ln("create: ".$controllerFile);
	}


	// creating view script
	$viewScriptDir = "application/views/scripts/".strtolower($controllerName);
	if(file_exists($viewScriptDir)){
		print_ln("exists: ".$viewScriptDir);
	} else {
		mkdir($viewScriptDir);
		print_ln("create: ".$viewScriptDir);
	}
	
	$restfullActionsWithOutput = array();
	$restfullActionsWithOutput[] = 'index';
	$restfullActionsWithOutput[] = 'show';
	$restfullActionsWithOutput[] = 'new';
	$restfullActionsWithOutput[] = 'edit';
	
	foreach($restfullActionsWithOutput as $outputAction){
		$viewScriptFile = $viewScriptDir."/".strtolower($outputAction.".phtml");
		if (file_exists($viewScriptFile)){
			print_ln("exists: ".$viewScriptFile);
		} else {
			touch($viewScriptFile);
			print_ln("create: ".$viewScriptFile);
		}
	}
}


function controller($argv){
	if (!$argv[2]) {
		print_ln("no controller name given");
		exit;
	}

	$controllerName = mb_convert_case($argv[2], MB_CASE_TITLE);
	// creating controller file
	$controllerFile = "application/controllers/".$controllerName."Controller.php";
	if (file_exists($controllerFile)) {
		print_ln("exists: ".$controllerFile);
	} else {
		touch($controllerFile);
		file_put_contents($controllerFile, zendControllerCodeForControllerNamed($controllerName, $argv));
		print_ln("create: ".$controllerFile);
	}


	// creating view script

	$viewScriptDir = "application/views/scripts/".strtolower($controllerName);
	if(file_exists($viewScriptDir)){
		print_ln("exists: ".$viewScriptDir);
	} else {
		mkdir($viewScriptDir);
		print_ln("create: ".$viewScriptDir);
	}
	
	for ($i = 3; $i < count($argv); $i++){
		$viewScriptFile = $viewScriptDir."/".strtolower($argv[$i].".phtml");
		if (file_exists($viewScriptFile)){
			print_ln("exists: ".$viewScriptFile);
		} else {
			touch($viewScriptFile);
			print_ln("create: ".$viewScriptFile);
		}
	}
}

function zendControllerCodeForControllerNamed($name, $argv){
	$code = "<?php
/**
 * @author 
 * @date 
 * @year 
 * 
 * Decription ...  
 */

class ".$name."Controller extends ApplicationController  
{
";

	for ($i = 3; $i < count($argv); $i++){
		$code .= zendControllerActionCodeForActionNamed($argv[$i]);
	}

	$code .="
}//endClass";
	return $code;
}

function zendControllerActionCodeForActionNamed($actionName){
	$actionCode = "
	
	/**
	* Enter description here...
	 *
	 */
	public function ".strtolower($actionName)."Action(){
		
	}";
	return $actionCode;
}


function print_ln($string){
	echo $string."\n";
}

?>