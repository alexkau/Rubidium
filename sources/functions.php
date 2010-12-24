<?php
class functions {
	//Cleans a string for database input.
	//If magic quotes are enabled, it'll handle it automatically;
	//If not, use the regular escape string.
	function cleanDBInput($input) {
		if (! get_magic_quotes_gpc()) {
			$output = addslashes($input);
		} else {
			$output = $input;
		}
		return $output;
	}
	
	//Cleans all values in an array for DB input
	//$_GET, $_POST, etc.
	function clean_array($array)
	{
		foreach($array as $k => $v)
		{
			if(is_array($array[$k]))
			{
				$this->clean_array($array[$k]);
			}
			else
			{
				$array[$k] = stripslashes($array[$k]);
			}
		}
	}
	function buildSettings($input) {
		$array = array();
		while ($row = $input->fetch_assoc()) {
			$array[$row['name']] = $row;
		}
		return $array;
	}
}
