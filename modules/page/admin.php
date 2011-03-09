<?php
class module_page_admin {
	static public $pageContent	= array();
	static public $section		= null;
	
	function __construct() {
		self::$section = rubidium::$request['GET']['section'];
	}
	function validateLoad() {
		return true;
	}
	function returnPage() {
		if (self::$section) {
			echo 'loading section ' . self::$section;
//			return self::$pageContent;
		} else {
			echo 'loading index';
		}
	}
}