<?php
class rubidium {
	static public $settings = array();
	static public $modules = array();
	static public $config = array();
	static public $request = array();
	static public $toLoad = array();
	static public $DB = null;
	function init() {
		require(ROOT_PATH . 'sources/debug.php');
		debug::addMessage("Loading file sources/debug.php");
		debug::addMessage("Loading file sources/core.php");
		debug::addMessage("Running init routine");
		
		//Get config
		//$baseconfig from file
		//goes to self::$config
		require(ROOT_PATH . 'config.php');
		if ( is_array( $baseconfig ) )
		{
			foreach( $baseconfig as $k => $v )
			{
				self::$config[$k] = $v;
			}
		}

		//Set up database and connect
		require(ROOT_PATH . 'sources/db.php');
		debug::addMessage("Loading file sources/db.php");
		classDB::connect(rubidium::$config);

		//Load settings and request
		self::$settings = classDB::getTable('settings', 'name', 'name, value', '',  array( 'order_by' => 'name', 'order_dir' => 'ASC' ));
		self::$modules = classDB::getTable('modules', 'id', 'id, name, default_action, default_action_value, enabled, protected', '', '' );
		self::getRequest();
		
		//Load output handler and build page
		require(ROOT_PATH . 'sources/output.php');
		debug::addMessage("Loading file sources/output.php");
		outputHandler::determineMode();
		outputHandler::buildPage();
		
		//Close database connection
		classDB::close();
		
		//Finalize debug output
		debug::addMessage("Page rendered successfully");
		echo (DEBUG == 1 || DEBUG == 2) ? debug::compileOutput() : '';
	}
	
	//Gets the current request from URL
	function getRequest() {
		//GET array must be converted to lowercase so case sensitivity doesn't matter (index.php?mode=page versus index.php?MODE=PAGE)
		self::$request['GET'] = ((! empty($_GET)) ? self::arrayToLower(self::cleanArray($_GET)) : null);
		self::$request['POST'] = ((! empty($_POST)) ? self::cleanArray($_POST) : null);
		self::$request['COOKIES'] = ((! empty($_COOKIES)) ? self::cleanArray($_COOKIES) : null);
		debug::addMessage("GET input loaded: ".print_r(self::$request['GET'],true));
	}
	
	//Cleans all values in an array
	function cleanArray($array)
	{
		if(is_array($array)) {
			foreach($array as $k => $v)
			{
				if(is_array($array[$k]))
				{
					self::cleanArray($array[$k]);
				}
				else
				{
					$output[$k] = addslashes($array[$k]);
				}
			}
			return $output;
		} else {
			return false;
		}
	}

	//Converts an entire array's contents to lowercase, including keys
	function arrayToLower($array,$round = 0){ 
		foreach($array as $key => $value){ 
			//Must unset key first, otherwise it's completely removed if it's already lowercase
			unset($array[$key]);
			$array[strtolower($key)] = ((is_array($value)) ? self::arraytolower($value,$round+1) : strtolower($value));
		}
        	return $array;
	}
}
