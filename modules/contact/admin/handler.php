<?php
/**
 * Admin handler for contact form module
 * @package rubidium 
 */

/**
 * Admin handler for contact form module
 * @author alex
 * @package rubidium
 */
class module_contact_admin {
	static public $pageContent		= array();
	static public $section			= null;
	static public $availableSections	= array();
	
	/**
	 * Assigns section from get
	 */
	function __construct() {
		self::$section = rubidium::$request['GET']['section'];
	}
	
	/**
	 * Will always be true
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
		return array(	'Contact Form' => array( 	'Settings'		=> 'settings'));
	}
	
	/**
	 * Determines section to load, returns page info
	 * @return array
	 */
	function returnPage() {
		if (self::$section && file_exists(ROOT_PATH . 'templates/modules/contact/admin/' . self::$section . '.tpl')) {
			self::$pageContent = rubidium::stringToArray(classDB::mysqlToString(classDB::select('module_contact_sections', 'pageInfo', "`name` = '" . self::$section . "'")));
			if (file_exists(ROOT_PATH . 'modules/contact/admin/sections/' . self::$section . '.php')) {
				require (ROOT_PATH . 'modules/contact/admin/sections/' . self::$section . '.php');
				$sectionClassName = "module_contact_admin_" . self::$section;
				$sectionClass = new $sectionClassName();
				$sectionClass->execute();
			}
		} else {
			self::$section = 'settings';
			self::$pageContent = self::returnPage();
		}
		self::$pageContent['section'] = self::$section;
		self::$pageContent['sidebar'] = self::buildSidebar();
		return self::$pageContent;
	}
}
