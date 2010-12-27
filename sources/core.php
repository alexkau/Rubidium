<?php
class rubidium {
	static public $settings = array();
	static public $config = array();
	static public $request = array();
	static public $toLoad = array();
	static public $debugOutput = array();
	static public $DB = null;
	function __construct() {
	}
	function setup() {
		//Get config
		//$baseconfig from file
		//goes to self::$config
		require('config.php');
		if ( is_array( $baseconfig ) )
		{
			foreach( $baseconfig as $k => $v )
			{
				self::$config[$k] = $v;
			}
		}
		//print_r(rubidium::$settings);
		//Set up database and connect
		require('sources/db.php');
		self::$DB = new classDB;
		self::$DB->connect(rubidium::$config);
	}
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
		echo ((DEBUG) ? "GET input: ".print_r(self::$request['GET'],true)."<br />" : "");
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
		$settings_temp = self::$DB->select('settings','name, value', '',  array( 'order_by' => 'name', 'order_dir' => 'ASC' ) );
		while ($row = $settings_temp->fetch_assoc()) {
			self::$settings[$row['name']] = $row;
		}
		echo ((DEBUG) ? "Settings loaded: ".print_r(self::$settings,true)."<br />" : "");
	}	
	
	//What mode are we in?
	//Right now it's just an if->else, but eventually will be if->else if->....->else
	function determineMode() {
		//If valid page load values are specified...
		if (self::$request['GET']['mode'] == 'page' && is_numeric(self::$request['GET']['id'])) {
			echo ((DEBUG) ? "Loading page ".self::$request['GET']['id']."<br />" : "");
			//...then we're loading that page!
			self::$toLoad = array(
					"mode" => "page",
					"id" => self::$request['GET']['id'] );
		} else {
			//If none of the above, then we load the default page
			echo ((DEBUG) ? "No valid load values specified, loading default page<br />" : "");
			self::$toLoad = array(
					"mode" => "page",
					"id" => self::$settings['default_page_id']['value'] );
		}
		echo ((DEBUG) ? "Content to load: ".print_r(self::$toLoad,true)."<br />" : "");
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
	function addDebugMessage($message,$code = null) {
		self::$debugOutput[] = array(
				"Code" => $code,
				"Message" => $message );
	}
	function returnDebugOutput() {
		foreach(self::$debugOutput as $message) {
			
		}
	}
}
