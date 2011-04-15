<?php
/**
 * Admin handler for admin CP
 * @package rubidium 
 */

/**
 * Admin handler for admin CP
 * @author alex
 * @package rubidium
 */
class module_admin_admin {
	static public $pageContent		= array();
	static public $section			= null;
	static public $availableSections	= array();
	
	/**
	 * Assigns requested section and available sections
	 */
	function __construct() {
		self::$section = rubidium::$request['GET']['section'];
		self::$availableSections = classDB::getSimpleTable('module_admin_sections', 'name', '', '');
	}
	
	/**
	 * Always true
	 * @return boolean
	 */
	function validateLoad() {
		return true;
	}
	
	/**
	 * Assigns sidebar links
	 * @return array  
	 */
	function buildSidebar() {
		return array(	'System' => array( 	'Index'			=> 'index',
							'Settings'		=> 'settings',
							'Navigation Bar'	=> 'navbar',
							'Modules'		=> 'modules') );
	}
	
	/**
	 * Returns page info from section
	 * @return array
	 */
	function returnPage() {
		if (self::$section && in_array(self::$section, self::$availableSections)) {
				self::$pageContent = rubidium::stringToArray(classDB::mysqlToString(classDB::select('module_admin_sections', 'pageInfo', "`name` = '" . self::$section . "'")));
			if (file_exists(ROOT_PATH . 'modules/admin/admin/sections/' . self::$section . '.php')) {
				require (ROOT_PATH . 'modules/admin/admin/sections/' . self::$section . '.php');
				$sectionClassName = "module_admin_admin_" . self::$section;
				$sectionClass = new $sectionClassName();
				$sectionClass->execute();
			}
		} else {
			self::$section = 'index';
			self::$pageContent = self::returnPage();
		}
		self::$pageContent['section'] = self::$section;
		self::$pageContent['sidebar'] = self::buildSidebar();
		return self::$pageContent;
	}
}
