<?php
/**
 * Core handler file
 * @package rubidium 
 */

if (IN_RUBIDIUM != 1) {
	die('This file cannot be accessed directly.');
}

/**
 * General i/o handler + procedures
 * @author alex
 * @package rubidium
 */
class rubidium {
	static public $startTime	= null;
	static public $settings		= array();
	static public $modules		= array();
	static public $navbar		= array();
	static public $config		= array();
	static public $request		= array();
	static public $toLoad		= array();
	static public $DB		= null;
	
	/**
	 * Loads basic required items, builds page, cleans up
	 */
	function init() {
		self::startTimer();
		require(ROOT_PATH . 'sources/debug.php');
		debug::addMessage("Loading file sources/debug.php");
		debug::addMessage("Loading file sources/core.php");
		debug::addMessage("Running init routine");
		
		self::loadConfig();

		//Set up database and connect
		require(ROOT_PATH . 'sources/db.php');
		debug::addMessage("Loading file sources/db.php");
		classDB::connect(rubidium::$config);

		//Load settings and request
		self::getInfo();

		//Load output handler and build page
		require(ROOT_PATH . 'sources/output.php');
		debug::addMessage("Loading file sources/output.php");
		outputHandler::determineMode();
		outputHandler::buildPage();
		
		//Close database connection
		classDB::close();
		
		//Finalize debug output
		debug::addMessage("Page rendered successfully in ". self::endTimer() ." seconds");
		echo (DEBUG == 1) ? debug::compileOutput() : '';
	}
	
	/**
	 * Creates a minimal instance of the class for basic operations.
	 * Mainly intended for things such as processing AJAX requests
	 */
	function instantiate() {
		self::loadConfig();
		require(ROOT_PATH . 'sources/debug.php');
		require(ROOT_PATH . 'sources/db.php');
		classDB::connect(rubidium::$config);

		self::getInfo();
	}
	
	/**
	 * Loads settings from config.php and assigns them to self::$config
	 * If the config isn't set up, redirects to install.php
	 */
	function loadConfig() {	
		require(ROOT_PATH . 'config.php');
		if ( is_array( $baseconfig ) ) {
			foreach( $baseconfig as $k => $v ) {
				self::$config[$k] = $v;
			}
		} else {
			header("Location: install.php");
		}
	}
	
	/**
	 * Gets system settings, module information and navbar information; assigns them to class variables
	 */
	function getInfo() {
		require_once(ROOT_PATH . 'sources/db.php');
		self::$settings	= classDB::getTable('settings', 'name', 'name, value', '',  array( 'order_by' => 'name', 'order_dir' => 'ASC' ));
		self::$modules	= classDB::getTable('modules', 'id', 'id, name, default_action, default_action_value, enabled, protected, numeric_id', 'enabled = 1', array("order_by" => "numeric_id") );
		self::$navbar	= classDB::getTable('navbar', 'position', 'id, position, title, url, regex', '', array( 'order_by' => 'position', 'order_dir' => 'ASC' ));
		self::getRequest();
	}
	
	/**
	 * Starts the page load timer 
	 */
	function startTimer() {
		$mtime = microtime(); 
		$mtime = explode(" ",$mtime); 
		$mtime = $mtime[1] + $mtime[0]; 
		self::$startTime = $mtime;
	}
	
	/**
	 * Stops the page load timer and returns the total time taken (seconds to 2 decimals)
	 * @return number
	 */
	function endTimer() {
		$mtime = microtime(); 
		$mtime = explode(" ",$mtime); 
		$mtime = $mtime[1] + $mtime[0]; 
		$endTime = $mtime; 
		$totalTime = round(($endTime - self::$startTime), 4, PHP_ROUND_HALF_UP);
		return $totalTime;
	}
	
	/**
	 * Converts an array into a string (url query type) for DB storage
	 * @param array $array
	 * @return string
	 */
	function arrayToString($array) {
		return http_build_query($array);
	}
	
	/**
	 * Takes a string (from arrayToString) and returns it to the array from which it came
	 * @param string $string
	 * @return array
	 */
	function stringToArray($string) {
		parse_str($string, $array);
		return $array;
	}
	
	/**
	 * Loads GET and POST requests and cookies, escapes them if magic quotes aren't enabled
	 */
	function getRequest() {
		//GET array must be converted to lowercase so case sensitivity doesn't matter (index.php?mode=page versus index.php?MODE=PAGE)
		self::$request['GET']		= ((! empty($_GET)) ? get_magic_quotes_gpc() ? self::arrayToLower($_GET) : self::arrayToLower(self::cleanArray($_GET)) : null);
		self::$request['POST']		= ((! empty($_POST)) ? get_magic_quotes_gpc() ? $_POST : self::cleanArray($_POST) : null);
		self::$request['COOKIES']	= ((! empty($_COOKIES)) ? get_magic_quotes_gpc() ? $_COOKIES :self::cleanArray($_COOKIES) : null);
		debug::addMessage("GET input loaded: ".print_r(self::$request['GET'],true));
	}
	
	/**
	 * Escapes all values in an array (for use if magic quotes aren't enabled)
	 * @param array $array
	 * @return array|boolean
	 */
	function cleanArray($array) {
		if (is_array($array)) {
			foreach ($array as $k => $v) {
				if (is_array($array[$k])) {
					self::cleanArray($array[$k]);
				} else {
					$output[$k] = addslashes($array[$k]);
				}
			}
			return $output;
		} else {
			return false;
		}
	}

	/**
	 * Converts all values in an array to lowercase
	 * @param array $array
	 * @param integer $round
	 * @return string
	 */
	function arrayToLower($array,$round = 0){ 
		foreach($array as $key => $value){ 
			//Must unset key first, otherwise it's completely removed if it's already lowercase
			unset($array[$key]);
			$array[strtolower($key)] = ((is_array($value)) ? self::arraytolower($value,$round+1) : strtolower($value));
		}
        return $array;
	}
	
	/**
	 * Generates a random 16-character string to be used as a password salt
	 * @return string
	 */
	function generateSalt() {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
		$string = '';
		for ($p = 0; $p < 16; $p++) {
			$string .= substr($characters, mt_rand(0, 35), 1);
		}
		return $string;
	}
	
	/**
	 * Returns a random 128-character string to be used as a login key
	 * @return string
	 */
	function generateLoginKey() {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
		$string = '';
		for ($p = 0; $p < 127; $p++) {
			$string .= substr($characters, mt_rand(0, 35), 1);
		}
		return $string;
	}
	
	/**
	 * Generates a password salt, SHA-512 hashes it against the password, and sets the admin password and salt
	 * @param string $password
	 */
	function setPassword($password) {
		require_once(ROOT_PATH . 'sources/db.php');
		$salt = self::generateSalt();
		$hash = hash("sha512", $password.$salt);
		classDB::update('admin_info', array('value' => $salt), "`name` = 'password_salt'");
		classDB::update('admin_info', array('value' => $hash), "`name` = 'password_hash'");
	}
	
	/**
	 * Checks the specified admin password against database, returns true or false
	 * @param string $password
	 * @return boolean
	 */
	function checkPassword($password) {
		$adminInfo = classDB::getTable('admin_info', 'name', 'name, value');
		$hash = hash("sha512", $password.$adminInfo['password_salt']['value']);
		//echo $hash."<br/>".$adminInfo['password_hash']['value'];
		return ($hash == $adminInfo['password_hash']['value']) ? true : false;
	}
	
	/**
	 * Changes the specified setting in the config file
	 * Refreshes config settings when done writing
	 * @param string $setting
	 * @param string $value
	 */
	function changeConfigSetting($setting, $value) {
		$configfilename = ROOT_PATH . 'config.php';
		$configtemp = file_get_contents($configfilename);
		$configtemp = preg_replace('/^\$baseconfig\[\'' . $setting . '\'\](\s*).+/m', "\$baseconfig['{$setting}']$1= '{$value}';", $configtemp);
		file_put_contents($configfilename, $configtemp);
		self::loadConfig();
	}
}
