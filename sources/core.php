<?php
class rubidium {
	static public $settings = array();
	static public $config = array();
	static public $request = array();
	static public $toLoad = array();
	static public $DB = null;
	static public $debug = null;
	function setup() {
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
		//print_r(rubidium::$settings);
		//Set up database and connect
		require(ROOT_PATH . 'sources/db.php');
		debug::addMessage("Loading file sources/db.php");
		self::$DB = new classDB;
		self::$DB->connect(rubidium::$config);

	}
	//Not used, will likely be deprecared
	static public function instance()
	{
		if ( ! self::$instance )
		{
			self::$instance = new self();
		}

		return self::$instance;
	}
	
	//Gets the current request
	function getRequest() {
		//GET array must be lowercase due to case sensitivity issues...
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
	
	//Gets the settings from the DB and outputs to self::$settings
	function loadSettings() {
		$settings_temp = classDB::select('settings','name, value', '',  array( 'order_by' => 'name', 'order_dir' => 'ASC' ) );
		while ($row = $settings_temp->fetch_assoc()) {
			self::$settings[$row['name']] = $row;
		}
		debug::addMessage("Settings loaded: ".print_r(self::$settings,true));
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
