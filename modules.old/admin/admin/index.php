<?php
echo (PRINT_FILENAMES) ? __FILE__ . "<br />" : '';
class module_admin_admin_index {
	static public $pageContent		= array();
	static public $section			= null;
	static public $availableSections	= array();
	
	function __construct() {
		self::$section = rubidium::$request['GET']['section'];
		self::$availableSections = classDB::getSimpleTable('module_admin_sections', 'name', '', '');
		print_r(self::$availableSections);
	}
	function validateLoad() {
		return true;
	}
	function returnPage() {
		if (self::$section && in_array(self::$section, self::$availableSections)) {
				//classDB::store('module_admin_sections', 'pageInfo', rubidium::arrayToString(self::$pageContent), "`name` = 'login'"); echo '<br/>';
				self::$pageContent = rubidium::stringToArray(classDB::mysqlToString(classDB::select('module_admin_sections', 'pageInfo', "`name` = '" . self::$section . "'")));
			if (file_exists(ROOT_PATH . 'modules/admin/admin/' . self::$section . '.php')) {
				require (ROOT_PATH . 'modules/admin/admin/' . self::$section . '.php');
				$sectionClassName = "module_admin_admin_" . self::$section;
				$sectionClass = new $sectionClassName();
				$sectionClass::execute();
			}
		} else {
//			self::$pageContent = rubidium::stringToArray(classDB::mysqlToString(classDB::select('module_admin_sections', 'pageInfo', "`name` = 'index'")));
			self::$section = 'index';
			self::$pageContent = self::returnPage();
		}
		return self::$pageContent;
	}
}
