<?php
echo (PRINT_FILENAMES) ? __FILE__ . "<br />" : '';
class module_admin_admin extends module_default {
	static public $pageContent		= array();
	static public $section			= null;
	static public $availableSections	= array();
	
	function __construct() {
		self::$section = rubidium::$request['GET']['section'];
		self::$availableSections = classDB::getSimpleTable('module_admin_sections', 'name', '', '');
	}
	
	function validateLoad() {
		return true;
	}
	
	function buildSidebar() {
		return array(	'System' => array( 	'Index'			=> 'index',
							'Settings'		=> 'settings',
							'Navigation Bar'	=> 'navbar',
							'Modules'		=> 'modules') );
	}
	
	function returnPage() {
		if (self::$section && in_array(self::$section, self::$availableSections)) {
				//classDB::store('module_admin_sections', 'pageInfo', rubidium::arrayToString(self::$pageContent), "`name` = 'login'"); echo '<br/>';
				self::$pageContent = rubidium::stringToArray(classDB::mysqlToString(classDB::select('module_admin_sections', 'pageInfo', "`name` = '" . self::$section . "'")));
			if (file_exists(ROOT_PATH . 'modules/admin/admin/sections/' . self::$section . '.php')) {
				require (ROOT_PATH . 'modules/admin/admin/sections/' . self::$section . '.php');
				$sectionClassName = "module_admin_admin_" . self::$section;
				$sectionClass = new $sectionClassName();
				$sectionClass::execute();
			}
		} else {
//			self::$pageContent = rubidium::stringToArray(classDB::mysqlToString(classDB::select('module_admin_sections', 'pageInfo', "`name` = 'index'")));
			self::$section = 'index';
			self::$pageContent = self::returnPage();
		}
		self::$pageContent['section'] = self::$section;
		self::$pageContent['sidebar'] = self::buildSidebar();
		//print_r(self::$pageContent);
		return self::$pageContent;
	}
}
