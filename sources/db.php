<?php
class classDB {
	public $config;
	public $mysql;
	function __construct($config) {
		$this->config = $config; //Set DB config
		$this->database = new mysqli($this->config['sql_server'],$this->config['sql_user'],$this->config['sql_password']);
		if (mysqli_connect_errno()) {
			die('Database connection failed. Please check back later or notify the administrator.');
		}
		//Connect to DB; die if connection failed
		$this->database->select_db($this->config['sql_database']);	
	}

	function getPage($pageID) {
		//Get page info
		$query = "select * from pages where `id` = {$pageID}";
		$pageInfo = $this->database->query($query);	
		if (mysqli_num_rows($pageInfo) == 1) {
			$pageArray = $pageInfo->fetch_assoc();
			return $pageArray;
		} else {
			return false;
		}
	}
}
