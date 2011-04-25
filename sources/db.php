<?php
/**
 * Database class file
 * @package rubidium 
 */

if (IN_RUBIDIUM != 1) {
	die('This file cannot be accessed directly.');
}

/**
 * Handles all database management - data insertion/deletion/modification.
 * @author alex
 * @package rubidium
 */
class classDB {
	static public $database = null;
	
	/**
	 * Connects to the database, using the configuration from the config file
	 */
	public static function connect() {
		self::$database = new mysqli(rubidium::$config['sql_server'],rubidium::$config['sql_user'],rubidium::$config['sql_password']);
		if (mysqli_connect_errno()) {
			die('<br />Database connection failed. Please check back later or notify the administrator.');
		}
		self::$database->select_db(rubidium::$config['sql_database']) or die('Unable to select database');
		debug::addMessage("Connected to database ".rubidium::$config['sql_database']);
	}
	
	/**
	 * Closes the database session if one exists
	 */
	public static function close() {
		if (self::$database) {
			mysqli_close(self::$database);
		}
	}
	

	/**
	 * Selects a single row (by ID) from a specified table
	 * Returns true if exactly one row is selected, otherwise false
	 * @param string $table
	 * @param integer $id
	 * @return array|boolean
	 */
	function selectByID($table, $id) {
		$query = "select * from {$table} where `id` = {$id}";
		$result = self::$database->query($query);
		if (mysqli_num_rows($result) == 1) {
			$array = $result->fetch_assoc();
			return $array;
		} else {
			return false;
		}
	}
 

	/**
	 * Selects a single row (by name) from a specified table
	 * Returns true if exactly one row is selected, otherwise false
	 * @param string $table
	 * @param string $name
	 * @return array|boolean
	 */
	function selectByName($table, $name) {
		$query = "select * from {$table} where `name` = {$name}";
		$result = self::$database->query($query);
		if (mysqli_num_rows($result) == 1) {
			$array = $result->fetch_assoc();
			return $array;
		} else {
			return false;
		}
	}
	

	/**
	 * Selects all results given certain criteria
	 *
	 * $options = array(
	 * 	"order_by"	=> "name",
	 * 	"order_dir"	=> "ASC"
	 * 	"limit"		=> "5"
	 * 	"limit_start"	=> "2"
	 * );
	 *
	 * $fields = "name, description, value";
	 * $conditions = "id > 5";
	 *
	 * @param string $table
	 * @param string $fields
	 * @param string $conditions
	 * @param array $options
	 * @return array|boolean
	 */
	function select($table, $fields="*", $conditions="", $options=array()) {
		$query = "SELECT {$fields} FROM {$table}";
		if ($conditions != "") {
			$query .= " WHERE ".$conditions;
		}
		if (isset($options['order_by'])) {
			$query .= " ORDER BY ".$options['order_by'];
			$query .= (isset($options['order_dir'])) ? " ".strtoupper($options['order_dir']) : '';
		}
		if (isset($options['limit_start']) && isset($options['limit'])) {
			$query .= " LIMIT ".$options['limit_start'].", ".$options['limit'];
		}
		else if(isset($options['limit'])) {
			$query .= " LIMIT ".$options['limit'];
		}
		//echo $query . "<br />";
		debug::addMessage("Running MySQL query: {$query}");
		$result = self::$database->query($query);
		if (mysqli_num_rows($result) > 0) {
		//echo $query . "<br />";
			return $result;
		} else {
			return false;
		}
	}
	
	/**
	 * Converts a MySQL object to an array
	 * $key = the name of the array value to use as the key for the array
	 * @param object $input
	 * @param string $key
	 * @return array
	 */
	function mysqlToArray($input, $key) {
		$array = array();
		while ($row = $input->fetch_assoc()) {
			$array[$row[$key]] = $row;
		}
		return $array;
	}
	
	/**
	 * Converts a MySQL object to a string - Only processes a single row.
	 * @param object $input
	 * @return string
	 */
	function mysqlToString($input) {
		$array = array();
		return reset($input->fetch_assoc());
	}
	
	/**
	 * Gets specified data from specified table and formats it as an array
	 * @param string $table
	 * @param string $key
	 * @param string $fields
	 * @param string $conditions
	 * @param array $options
	 * @return array
	 */
	function getTable($table, $key, $fields, $conditions, $options) {
		$temp = self::select($table, $fields, $conditions, $options);
		$output = self::mysqlToArray($temp, $key);
		return $output;
	}
	
	/**
	 * Same as getTable, except only pulls a single field and formats it as a non-nested array
	 * @param string $table
	 * @param string $field
	 * @param string $conditions
	 * @param array $options
	 * @return array
	 */
	function getSimpleTable($table, $field, $conditions, $options) {
		$temp = self::select($table, $field, $conditions, $options);
		while ($row = $temp->fetch_assoc()) {
			$output[] = $row["{$field}"];
		}
		return $output;
	}
	
	/**
	 * Stores data in where $conditions
	 * content: array (field => data)
	 * DO NOT LEAVE $conditions BLANK unless you're absolutely certain you want to overwrite everything.
	 * @param string $table
	 * @param array $content
	 * @param string $conditions
	 */
	function update($table, $content, $conditions) {
		$comma = '';
		$query = "update {$table} set ";
		foreach ($content as $field => $data) {
			$query .= "{$comma}`{$field}` = '{$data}'";
			$comma = ", ";
		}
		$query .= ($conditions != '') ? ' WHERE ' . $conditions : '';
		debug::addMessage("Running MySQL query: " . $query);
		self::$database->query($query);
		//echo $query."<br/>";
	}
	
	/**
	 * Inserts specified content into specified table
	 * content: array (field => data)
	 * @param string $table
	 * @param array $content
	 */
	function insert($table, $content) {
		$comma = '';
		$query = "INSERT INTO {$table} ( ";
		foreach ($content as $field => $data) {
			$query .= "{$comma}`{$field}`";
			$comma = ", ";
		}
		$query .= ') VALUES (';
		$comma = '';
		foreach ($content as $field => $data) {
			$query .= "{$comma}'{$data}'";
			$comma = ", ";
		}
		$query .= ')';
		debug::addMessage("Running MySQL query: " . $query);
		self::$database->query($query);
		//echo $query . "<br />";
	}
	
	/**
	 * Deletes specified data
	 * @param string $table
	 * @param string $conditions
	 */
	function delete($table, $conditions) {
		$query = "DELETE FROM {$table} WHERE {$conditions}";
		debug::addMessage("Running MySQL query: " . $query);
		self::$database->query($query);
	}
	
	/**
	 * Creates a sections table for the specified module 
	 * @param string $moduleName
	 */
	function createSectionsTable($moduleName) {
		$query = 	"CREATE TABLE IF NOT EXISTS `module_{$moduleName}_sections` (
				`name` varchar(32) NOT NULL,
				`public_name` varchar(64) NOT NULL,
				`pageInfo` mediumtext NOT NULL
				) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
		self::$database->query($query);
		//echo $query . "<br />";
	}
	
	/**
	 * Deletes the sections table for the specified module 
	 * @param string $moduleName
	 */
	function deleteSectionsTable($moduleName) {
		$query = "DROP TABLE `module_{$moduleName}_sections`;";
		self::$database->query($query);
	}
}
