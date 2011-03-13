<?
class module_page_admin_settings {
	static public $post	= array();
	static public $get	= array();
	static public $pageList	= array();
	
	function execute() {
		self::$post					= rubidium::$request['POST'];
		self::$get					= rubidium::$request['GET'];
		self::$pageList 				= self::getPageList();
		if (self::processPostData()) {
			module_page_admin::$pageContent['changesMade'] = true;
			rubidium::getInfo();
		}
		module_page_admin::$pageContent['pageList']	= self::$pageList;
	}
	
	function getPageList() {
		$pageList = classDB::getTable('module_page_pages', 'id', '*', '', '');
		return $pageList;
	}
	
	function processPostData() {
		if (self::$post['404'] != rubidium::$settings['404_page']['value'] && self::$post['404'] != '') {
			$changeMade = true;
			classDB::store1('settings', array('value' => self::$post['404']), '`name` = "404_page"');			
		}
		if (self::$post['default'] != rubidium::$modules['page']['default_action_value'] && self::$post['default'] != '') {
			$changeMade = true;
			classDB::store1('modules', array('default_action_value' => self::$post['default']), '`id` = "page"');			
		}
		
		if ($changeMade == 'true') {
			return true;
		} else {
			return false;
		}
	}
}
