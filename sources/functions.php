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
}
