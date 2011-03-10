<?php
class rubidium {
	static public $startTime = null;
	static public $settings = array();
	static public $modules = array();
	static public $config = array();
	static public $request = array();
	static public $toLoad = array();
	static public $DB = null;
	
	function init() {
		self::startTimer();
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
		debug::addMessage("Page rendered successfully in ". self::endTimer() ." seconds");
		echo (DEBUG == 1 || DEBUG == 2) ? debug::compileOutput() : '';

	}
	
	function startTimer() {
		$mtime = microtime(); 
		$mtime = explode(" ",$mtime); 
		$mtime = $mtime[1] + $mtime[0]; 
		self::$startTime = $mtime;
	}
	
	function endTimer() {
		$mtime = microtime(); 
		$mtime = explode(" ",$mtime); 
		$mtime = $mtime[1] + $mtime[0]; 
		$endTime = $mtime; 
		$totalTime = round(($endTime - self::$startTime), 4, PHP_ROUND_HALF_UP);
		return $totalTime;
	}
	
	/**
	 * arrayToString
	 * Input array, out comes string (for DB storage)
	 */
	function arrayToString($array) {
		return http_build_query($array);
	}
	
	/**
	 * stringToArray
	 * Input string (from DB), out comes array
	 */
	function stringToArray($string) {
		parse_str($string, $array);
		return $array;
	}
	
	//Gets the current request info
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
	
	/**
	 * generateHash
	 * Returns a random 16-character string to be used as a password hash
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
	 * generateLoginKey
	 * Returns a random 128-character string to be used as a password hash
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
	 * setPassword
	 * Generates a password salt, SHA-512 hashes it against the password, and sets the admin password and salt
	 */
	function setPassword($password) {
		$salt = self::generateSalt();
		$hash = hash("sha512", $password.$salt);
		//echo "Password: {$password} - Salt: {$salt} - Hash: {$hash}";
		classDB::store('admin_info', 'value', $salt, "`name` = 'password_salt'");
		classDB::store('admin_info', 'value', $hash, "`name` = 'password_hash'");
	}
	
	/**
	 * checkPassword
	 * Checks specified admin password against database, returns true or false
	 */
	function checkPassword($password) {
		$adminInfo = classDB::getTable('admin_info', 'name', 'name, value');
		$hash = hash("sha512", $password.$adminInfo['password_salt']['value']);
		//echo $hash."<br/>".$adminInfo['password_hash']['value'];
		return ($hash == $adminInfo['password_hash']['value']) ? true : false;
	}
}
