<?php
/**
 * Debug handler file
 * @package rubidium 
 */
 
if (IN_RUBIDIUM != 1) {
	die('This file cannot be accessed directly.');
}

/**
 * Stores and outputs debug messages
 * @author alex
 * @package rubidium
 */
class debug {
	static public $messages = array();
	static public $output = array();
		
	/**
	 * Adds the specified message to the debug output
	 * Debug codes are not currently in use but could be utilized easily
	 * @param string $message
	 * @param integer $code
	 */
	function addMessage($message, $code = null) {
		self::$messages[] = array(
				"code" => $code,
				"message" => $message );
	}
	
	/**
	 * Compiles the debug messages into a block of html to be appended to the end of the page
	 * It's not pretty and it'll break html validation, so don't use it on a live site.
	 * @return string
	 */
	function compileOutput() {
		$string = '<hr />----- DEBUG MESSAGES -----<br />';
		foreach(self::$messages as $message) {
			if (! empty($message['code']) && is_numeric($message['code'])) {
				$string .= "Code {$message['code']}: ";
			}
			$string .= $message['message'] . "<br />";
		}
		return $string;
	}
}
