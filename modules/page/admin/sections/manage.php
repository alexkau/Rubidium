<?
class module_page_admin_manage {
	static public $pageList		= array();
	static public $post		= array();
	static public $get		= array();
	
	function execute() {
		self::$post	= rubidium::$request['POST'];
		self::$get	= rubidium::$request['GET'];
		self::$pageList = self::getPageList();
		if (self::checkPostData()) {
			switch (self::$post['action']) {
				case "editPage":
					classDB::store1('module_page_pages', array('title' => self::$post['pageTitle'], 'content' => self::$post['pageContent']), '`id` = '.self::$post['id']);
					break;
				default:
					break;
			}
			
			module_page_admin::$pageContent['changesMade'] = true;
		}
		if (self::checkGetData()) {
			//Process it
			module_page_admin::$pageContent['changesMade'] = true;
		}
		if (self::checkUrlParams()) {
			module_page_admin::$pageContent['pageEditInfo']	= self::getSinglePageInfo(rubidium::$request['GET']['edit']);
			module_page_admin::$pageContent['subsection']	= 'edit';
		} else {
			module_page_admin::$pageContent['pageList']	= self::$pageList;
		}
	}
	
	/**
	 * getPageList
	 * Returns array of all pages: id => array(data)
	 */
	function getPageList() {
		$pageList = classDB::getTable('module_page_pages', 'id', '*', '', '');
		//print_r($pageList);
		return $pageList;
	}
	
	/**
	 * getSinglePageInfo
	 * Returns all info of specified page as an array
	 */
	function getSinglePageInfo($id) {
		$table = classDB::getTable('module_page_pages', 'id', '*', '`id` = '.$id, '');
		return $table[$id];
	}
	
	/**
	 * checkPostData
	 * Returns true if there's valid change data to process in $_POST
	 */
	function checkPostData() {
		switch (self::$post['action']) {
			case 'editPage':
				if (self::$post['pageTitle'] != '' && self::$post['pageContent'] != '' && self::$post['id'] != '') {
					return true;
				} else {
					return false;
				}
				break;
			default:
				return false;
		}
		
	}
	
	/**
	 * checkGetData
	 * Returns true if there's valid change data to process in $_GET
	 */
	function checkGetData() {
		return false;
	}
	
	/**
	 * checkUrlParams
	 * Returns true if there's a valid page (e.g. edit) specified in the URL
	 */
	function checkUrlParams() {
		if (rubidium::$request['GET']['edit'] != '' && in_array(rubidium::$request['GET']['edit'], array_keys(self::$pageList)) ) {
			return true;
		} else {
			return false;
		}
	}
}
