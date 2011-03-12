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
		if (self::$section && file_exists(ROOT_PATH . 'templates/modules/page/admin/' . self::$section . '.tpl')) {
				//classDB::store('module_admin_sections', 'pageInfo', rubidium::arrayToString(self::$pageContent), "`name` = 'login'"); echo '<br/>';
				self::$pageContent = rubidium::stringToArray(classDB::mysqlToString(classDB::select('module_page_sections', 'pageInfo', "`name` = '" . self::$section . "'")));
			if (file_exists(ROOT_PATH . 'modules/page/admin/sections/' . self::$section . '.php')) {
				require (ROOT_PATH . 'modules/page/admin/sections/' . self::$section . '.php');
				$sectionClassName = "module_page_admin_" . self::$section;
				$sectionClass = new $sectionClassName();
				$sectionClass::execute();
			}
		} else {
			//self::$pageContent = rubidium::stringToArray(classDB::mysqlToString(classDB::select('module_page_sections', 'pageInfo', "`name` = 'index'")));
			self::$section = 'index';
			self::$pageContent = self::returnPage();
		}
	return self::$pageContent;
	}
}
