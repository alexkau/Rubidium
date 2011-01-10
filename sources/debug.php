<?php
class debug {
	static public $messages = array();
	static public $output = array();
	//Add requested debug message to array
	//Debug codes are not currently in use but can be utilized easily
	function addMessage($message,$code = null) {
		self::$messages[] = array(
				"code" => $code,
				"message" => $message );
	}
	//Set up debug output
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
