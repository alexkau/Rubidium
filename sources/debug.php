<?php
class debug {
	static public $messages = array();
	static public $output = array();
	function addMessage($message,$code = null) {
		self::$messages[] = array(
				"code" => $code,
				"message" => $message );
	}
	function compileOutput() {
		$string = '----- DEBUG MESSAGES -----<br />';
		foreach(self::$messages as $message) {
			if (! empty($message['code']) && is_numeric($message['code'])) {
				$string .= "Code {$message['code']}: ";
			}
			$string .= $message['message'] . "<br />";
		}
		return $string;
	}
}
