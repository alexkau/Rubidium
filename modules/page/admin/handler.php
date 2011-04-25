<?php
/**
 * Admin handler for page module
 * @package rubidium 
 */

if (IN_RUBIDIUM != 1) {
	die('This file cannot be accessed directly.');
}

/**
 * Admin handler for page module
 * @author alex
 * @package rubidium
 */
class module_page_admin {
	static public $pageContent	= array();
	static public $section		= null;
	
	/**
	 * Loads section to self variable
	 */
	function __construct() {
		self::$section = rubidium::$request['GET']['section'];
	}
	
	/**
	 * Load criteria are always true
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
		return array(	'General'		=> array( 	'Manage Pages'	=> 'manage',
									'Settings'	=> 'settings') );
	}
	
	/**
	 * Gets and returns page content from specified section (or default if invalid)
	 * @return array
	 */
	function returnPage() {
		if (self::$section && file_exists(ROOT_PATH . 'templates/modules/page/admin/' . self::$section . '.tpl')) {
				self::$pageContent = rubidium::stringToArray(classDB::mysqlToString(classDB::select('module_page_sections', 'pageInfo', "`name` = '" . self::$section . "'")));
			if (file_exists(ROOT_PATH . 'modules/page/admin/sections/' . self::$section . '.php')) {
				require (ROOT_PATH . 'modules/page/admin/sections/' . self::$section . '.php');
				$sectionClassName = "module_page_admin_" . self::$section;
				$sectionClass = new $sectionClassName();
				$sectionClass->execute();
			}
		} else {
			self::$section = 'manage';
			self::$pageContent = self::returnPage();
		}
		self::$pageContent['section'] = self::$section;
		self::$pageContent['sidebar'] = self::buildSidebar();
		return self::$pageContent;
	}
}
