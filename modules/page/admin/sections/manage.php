<?php
/**
 * Page management section for page module
 * @package rubidium 
 */

/**
 * Page management section for page module
 * @author alex
 * @package rubidium
 */
class module_page_admin_manage {
	static public $pageList		= array();
	static public $post		= array();
	static public $get		= array();
	static public $urlMode		= null;
	
	/**
	 * Processes request
	 */
	function execute() {
		self::$post	= rubidium::$request['POST'];
		self::$get	= rubidium::$request['GET'];
		self::updatePageList();
			if (self::checkPostData()) {
			switch (self::$post['action']) {
				case 'editPage':
					$timeNow = time();
					classDB::update('module_page_pages', array('title' => self::$post['pageTitle'], 'content' => self::$post['pageContent'], 'last_updated' => time()), '`id` = '.self::$post['id']);
					outputHandler::setLoadInfoVar('changesMade', true);
					break;
				case 'addPage':
					$timeNow = time();
					$pageTitle	= self::$post['pageTitle'];
					$pageContent	= self::$post['pageContent'];
					classDB::insert('module_page_pages', array('title' => $pageTitle, 'content' => $pageContent, 'last_updated' => $timeNow));
					$temp = classDB::select('module_page_pages', 'id', "`title` = '{$pageTitle}' AND `content` = '{$pageContent}' AND `last_updated` = '{$timeNow}'");
					self::updatePageList();
					outputHandler::setLoadInfoVar('newPageId', classDB::mysqlToString($temp));
					outputHandler::setLoadInfoVar('pageList', self::$pageList);
					outputHandler::setLoadInfoVar('changesMade', true);
					break;
				default:
					break;
			}
		}
		
		if (self::$get['delete'] == 'true' && in_array(self::$get['edit'], array_keys(self::$pageList))) {
			if (self::$get['edit'] != rubidium::$settings['404_page']['value']) {
				if (self::$get['edit'] != rubidium::$modules['page']['default_action_value']) {
					$toDelete = self::$get['edit'];
					classDB::delete('module_page_pages', "`id` = {$toDelete}");
					outputHandler::setLoadInfoVar('deletedPage', true);
					self::updatePageList();
				} else {
					outputHandler::setLoadInfoVar('cantDeleteIndex', true);
				}
			} else {
				outputHandler::setLoadInfoVar('cantDelete404', true);
			}
		}
		if (self::checkUrlParams() && self::$get['delete'] != 'true') {
			switch (self::$urlMode) {
				case 'edit':
					outputHandler::setLoadInfoVar('pageEditInfo', self::getSinglePageInfo(rubidium::$request['GET']['edit']));
					outputHandler::setLoadInfoVar('subsection', 'edit');
					break;
				case 'add':
					outputHandler::setLoadInfoVar('subsection', 'add');
					break;
				default:
					break;
			}
		} else {
			outputHandler::setLoadInfoVar('pageList', self::$pageList);
		}
	}
	
	/**
	 * Sets self::$pageList to array of all pages: id => array(data)
	 */
	function updatePageList() {
		self::$pageList = classDB::getTable('module_page_pages', 'id', '*', '', '');
	}
	
	/**
	 * Returns all info of specified page as an array
	 * @param string $id
	 * @return array
	 */
	function getSinglePageInfo($id) {
		$table = classDB::getTable('module_page_pages', 'id', '*', '`id` = '.$id, '');
		return $table[$id];
	}
	
	/**
	 * Returns true if there's valid change data to process in $_POST
	 * @return boolean
	 */
	function checkPostData() {
		switch (self::$post['action']) {
			case 'editPage':
				if (self::$post['pageTitle'] != '') {
					if (self::$post['pageContent'] != '') {
						if (self::$post['id'] != '') {
							return true;
						} else {
							outputHandler::setLoadInfoVar('error', 'A valid page ID was not specified. Please check your configuration.');
							return false;
						}
					} else {
						outputHandler::setLoadInfoVar('error', 'You must enter some content.');
						return false;
					}
				} else {
					outputHandler::setLoadInfoVar('error', 'You must enter a title for the page.');
					return false;
				}
				break;
			case 'addPage':
				if (self::$post['pageTitle'] != '') {
					if (self::$post['pageContent'] != '') {
						return true;
					} else {
						outputHandler::setLoadInfoVar('error', 'You must enter some content.');
						return false;
					}
				} else {
					outputHandler::setLoadInfoVar('error', 'You must enter a title for the page.');
					return false;
				}
				break;
			default:
				return false;
		}		
	}
	
	/**
	 * Returns true if there's a valid page (e.g. edit) specified in the URL
	 * @return boolean
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
