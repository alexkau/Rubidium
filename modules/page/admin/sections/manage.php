<?
class module_page_admin_manage {
	static public $pageList		= array();
	static public $post		= array();
	static public $get		= array();
	static public $urlMode		= null;
	
	function execute() {
		self::$post	= rubidium::$request['POST'];
		self::$get	= rubidium::$request['GET'];
		self::updatePageList();
		if (self::checkPostData()) {
			switch (self::$post['action']) {
				case 'editPage':
					classDB::store1('module_page_pages', array('title' => self::$post['pageTitle'], 'content' => self::$post['pageContent'], 'last_updated' => time()), '`id` = '.self::$post['id']);
					module_page_admin::$pageContent['changesMade'] = true;
					break;
				case 'addPage':
					$timeNow	= time();
					$pageTitle	= self::$post['pageTitle'];
					$pageContent	= self::$post['pageContent'];
					classDB::insert('module_page_pages', array('title' => $pageTitle, 'content' => $pageContent, 'last_updated' => $timeNow));
					$temp = classDB::select('module_page_pages', 'id', "`title` = '{$pageTitle}' AND `content` = '{$pageContent}' AND `last_updated` = '{$timeNow}'");
					self::updatePageList();
					module_page_admin::$pageContent['newPageId']	= classDB::mysqlToString($temp);
					module_page_admin::$pageContent['pageList']	= self::$pageList;
					module_page_admin::$pageContent['changesMade'] = true;
					break;
				default:
					break;
			}
			module_page_admin::$pageContent['changesMade'] = true;
		}
		if (self::$get['delete'] == 'true' && in_array(self::$get['edit'], array_keys(self::$pageList))) {
			if (self::$get['edit'] != rubidium::$settings['404_page']['value']) {
				$toDelete = self::$get['edit'];
				classDB::delete('module_page_pages', "`id` = {$toDelete}");
				module_page_admin::$pageContent['deletedPage'] = 'true';
				self::updatePageList();
			} else {
				module_page_admin::$pageContent['cantDelete404'] = 'true';
			}
		}
		if (self::checkGetData()) {
			//Process it
			module_page_admin::$pageContent['changesMade'] = true;
		}
		if (self::checkUrlParams() && self::$get['delete'] != 'true') {
			switch (self::$urlMode) {
				case 'edit':
					module_page_admin::$pageContent['pageEditInfo']	= self::getSinglePageInfo(rubidium::$request['GET']['edit']);
					module_page_admin::$pageContent['subsection']	= 'edit';
					break;
				case 'add':
					module_page_admin::$pageContent['subsection']	= 'add';
					break;
				default:
					break;
			}
		} else {
			module_page_admin::$pageContent['pageList']	= self::$pageList;
		}
	}
	
	/**
	 * updatePageList
	 * Sets self::$pageList to array of all pages: id => array(data)
	 */
	function updatePageList() {
		$pageList = classDB::getTable('module_page_pages', 'id', '*', '', '');
		//print_r($pageList);
		//print_r(array_keys($pageList));
		self::$pageList = $pageList;
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
			//Need to add errors if title or content isn't filled in, rather than just returning false
			case 'addPage':
				if (self::$post['pageTitle'] != '' && self::$post['pageContent'] != '') {
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
		if (self::$get['edit'] != '' && in_array(self::$get['edit'], array_keys(self::$pageList)) ) {
			self::$urlMode = 'edit';
			return true;
		} else if (self::$get['add'] == 'true') {
			self::$urlMode = 'add';
			return true;
		} else {
			return false;
		}
	}
}
