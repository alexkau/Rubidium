<?php
echo (PRINT_FILENAMES) ? __FILE__ . "<br />" : '';
class classDB {
	static public $database = null;
	public static function connect() {
		self::$database = new mysqli(rubidium::$config['sql_server'],rubidium::$config['sql_user'],rubidium::$config['sql_password']);
		if (mysqli_connect_errno()) {
			die('<br />Database connection failed. Please check back later or notify the administrator.');
		}
		//Connect to DB; die if connection failed
		self::$database->select_db(rubidium::$config['sql_database']) or die('Unable to select database');
		debug::addMessage("Connected to database ".rubidium::$config['sql_database']);
	}
	
	public static function close() {
		mysqli_close(self::$database);
	}
	
	/**
	 * SelectByID
	 * Selects a single row (by ID) from a specified table
	 * Returns true if exactly one row is selected, otherwise false
	 * $table = table to select from
	 * $id = ID of row to select
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
	 * SelectByName
	 * Selects a single row (by name) from a specified table
	 * Returns true if exactly one row is selected, otherwise false
	 * $table = table to select from
	 * $name = name of row to select
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
	 * Select
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
	 */
	function select($table, $fields="*", $conditions="", $options=array()) {
		$query = "SELECT {$fields} FROM {$table}";

		if($conditions != "")
		{
			$query .= " WHERE ".$conditions;
		}
		
		if(isset($options['order_by']))
		{
			$query .= " ORDER BY ".$options['order_by'];
			$query .= (isset($options['order_dir'])) ? " ".strtoupper($options['order_dir']) : '';
		}
		
		if(isset($options['limit_start']) && isset($options['limit']))
		{
			$query .= " LIMIT ".$options['limit_start'].", ".$options['limit'];
		}
		else if(isset($options['limit']))
		{
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
	 * mysqlToArray
	 * Converts a MySQL object to an array
	 * $key is the name of the array value to use as the key for the array
	 */
	function mysqlToArray($input, $key) {
		$array = array();
		while ($row = $input->fetch_assoc()) {
			$array[$row[$key]] = $row;
		}
		return $array;
	}
	
	/**
	 * mysqlToSimpleArray
	 * Same as mysqlToArray, except only processes a single field and formats it as a string
	 */
	function mysqlToString($input) {
		$array = array();
		return reset($input->fetch_assoc());
	}
	
	/**
	 * getTable
	 * Gets specified data from specified table and formats it as an array
	 * $table: Table to pull data from
	 * $key: Name of field to use for array key
	 * $fields: Fields to pull from table
	 * $options: Options to use (see self::select())
	 */
	function getTable($table, $key, $fields, $conditions, $options) {
		$temp = self::select($table, $fields, $conditions, $options);
		$output = self::mysqlToArray($temp, $key);
		return $output;
	}
	
	/**
	 * getSimpleTable
	 * Same as getTable, except only pulls a single field and formats it as a non-nested array
	 */
	function getSimpleTable($table, $field, $conditions, $options) {
		$temp = self::select($table, $field, $conditions, $options);
		while ($row = $temp->fetch_assoc()) {
			$output[] = $row["{$field}"];
		}
		return $output;
	}
	
	/**
	 * store
	 * Stores $data in $table.$field where $conditions
	 * DO NOT LEAVE $conditions BLANK unless you're absolutely certain you want to overwrite everything.
	 */
	function store($table, $field, $data, $conditions) {
		$query = "update {$table} set {$field} = '{$data}'";
		$query .= ($conditions != '') ? ' WHERE ' . $conditions : '';
		debug::addMessage("Running MySQL query: " . $query);
		return (self::$database->query($query)) ? true : false;
	}
}
