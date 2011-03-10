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
				self::$pageContent['title'] = 'admin dashboard';
				self::$pageContent['content'] = 'loading section ' . self::$section;
				self::$pageContent['templateCategory'] = 'modules/admin';
				self::$pageContent['templateToLoad'] = 'generic';
			return self::$pageContent;
		} else {
				self::$pageContent['title'] = 'admin dashboard';
				self::$pageContent['content'] = 'loading section ' . self::$section;
				self::$pageContent['templateCategory'] = 'modules/admin';
				self::$pageContent['templateToLoad'] = 'generic';
			return self::$pageContent;
		}
	}
}
