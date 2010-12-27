<?php
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

	function getPage($pageID) {
		//Get page info
		$query = "select * from pages where `id` = {$pageID}";
		$pageInfo = self::$database->query($query);	
		if (mysqli_num_rows($pageInfo) == 1) {
			$pageArray = $pageInfo->fetch_assoc();
			return $pageArray;
		} else {
			return false;
		}
	}
	/* 
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
 
	/* 
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
	/*
	* Select
	* Selects all results given certain criteria
	*
	* $options = array(
	* 	"order_by"	=> "title",
	* 	"order_dir"	=> "ASC"
	* 	"limit"		=> "5"
	* 	"limit_start"	=> "2"
	* );
	*
	* $fields = "name, description, value";
	*
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
			if(isset($options['order_dir']))
			{
				$query .= " ".strtoupper($options['order_dir']);
			}
		}
		
		if(isset($options['limit_start']) && isset($options['limit']))
		{
			$query .= " LIMIT ".$options['limit_start'].", ".$options['limit'];
		}
		else if(isset($options['limit']))
		{
			$query .= " LIMIT ".$options['limit'];
		}
		debug::addMessage("Running MySQL query: {$query}");
		return self::$database->query($query);
	}
	function mysqlToArray($input) {
		$array = array();
		while ($row = $input->fetch_assoc()) {
			$array[] = $row;
		}
		return $array;
	}
		
		
}
