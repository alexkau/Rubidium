<?php
/**
 * Settings section for page module
 * @package rubidium 
 */

/**
 * Settings section for page module
 * @author alex
 * @package rubidium
 */
class module_page_admin_settings {
	static public $post	= array();
	static public $get	= array();
	static public $pageList	= array();
	
	/**
	 * Gets and returns page info, processes post data if necessary
	 */
	function execute() {
		self::$post	= rubidium::$request['POST'];
		self::$get	= rubidium::$request['GET'];
		self::$pageList	= self::getPageList();
		if (self::processPostData()) {
			outputHandler::setLoadInfoVar('changesMade', true);
			rubidium::getInfo();
		}
		outputHandler::setLoadInfoVar('pageList', self::$pageList);
	}
	
	/**
	 * Gets the list of pages from the database
	 * @return array
	 */
	function getPageList() {
		$pageList = classDB::getTable('module_page_pages', 'id', '*', '', '');
		return $pageList;
	}
	
	/**
	 * Checks whether post data is valid, if so then makes necessary changes
	 * @return boolean
	 */
	function processPostData() {
		if (self::$post['404'] != rubidium::$settings['404_page']['value'] && self::$post['404'] != '') {
			$changeMade = true;
			classDB::update('settings', array('value' => self::$post['404']), '`name` = "404_page"');			
		}
		if (self::$post['default'] != rubidium::$modules['page']['default_action_value'] && self::$post['default'] != '') {
			$changeMade = true;
			classDB::update('modules', array('default_action_value' => self::$post['default']), '`id` = "page"');			
		}
		
		if ($changeMade == 'true') {
			return true;
		} else {
			return false;
		}
	}
}
