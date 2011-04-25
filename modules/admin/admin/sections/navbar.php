<?php
/**
 * Navbar management handler
 * @package rubidium 
 */

if (IN_RUBIDIUM != 1) {
	die('This file cannot be accessed directly.');
}

/**
 * Navbar management handler
 * @author alex
 * @package rubidium
 */
class module_admin_admin_navbar {
	static public $post	= array();
	static public $get	= array();
	static public $itemList	= array();
	static public $urlMode	= null;
	static public $pageList	= array();
	
	/**
	 * Sets variables, processes requests if it exists
	 */
	function execute() {
		self::$post	= rubidium::$request['POST'];
		self::$get	= rubidium::$request['GET'];
		self::updateItemList();
		if (self::checkPostData()) {
			switch (self::$post['action']) {
				case 'editItem':
					$itemTitle	= self::$post['itemTitle'];
					$itemUrl	= self::$post['itemUrl'];
					$itemRegex	= self::$post['itemRegex'];
					classDB::update('navbar', array('title' => $itemTitle, 'url' => $itemUrl, 'regex' => $itemRegex), '`id` = '.self::$post['id']);
					outputHandler::setLoadInfoVar('changesMade', true);
					break;
				case 'addItem':
					$itemTitle	= self::$post['itemTitle'];
					$itemUrl	= self::$post['itemUrl'];
					$itemRegex	= self::$post['itemRegex'];
					classDB::insert('navbar', array('title' => $itemTitle, 'url' => $itemUrl, 'regex' => $itemRegex, 'position' => self::getNextItemPosition()));
					self::updateItemList();
					outputHandler::setLoadInfoVar('changesMade', true);
					break;
				default:
					break;
			}
		}
		
		if (self::$get['delete'] == 'true' && in_array(self::$get['edit'], array_keys(self::$itemList))) {
			$toDelete = self::$get['edit'];
			classDB::delete('navbar', "`id` = {$toDelete}");
			outputHandler::setLoadInfoVar('deletedItem', true);
			self::updateItemList();
		}

		if (self::checkUrlParams() && self::$get['delete'] != 'true') {
			switch (self::$urlMode) {
				case 'edit':
					outputHandler::setLoadInfoVar('itemEditInfo', self::getSingleItemInfo(rubidium::$request['GET']['edit']));
					outputHandler::setLoadInfoVar('subsection', 'edit');
					break;
				case 'add':
					self::$pageList = self::getPageList();
					outputHandler::setLoadInfoVar('pageList', self::$pageList);
					outputHandler::setLoadInfoVar('subsection', 'add');
					break;
				default:
					break;
			}
		}
	}
	
	/**
	 * Returns full list of all pages for navbar item generation
	 * @return array
	 */
	function getPageList() {
		$pageList = classDB::getTable('module_page_pages', 'id', '*', '', '');
		return $pageList;
	}
	
	/**
	 * Updates page+navbar info
	 */
	function updateItemList() {
		self::$itemList = classDB::getTable('navbar', 'id', 'id, position, title, url, regex', '', array());
		rubidium::$navbar = classDB::getTable('navbar', 'position', 'id, position, title, url, regex', '', array( 'order_by' => 'position', 'order_dir' => 'ASC' ));
	}
	
	/**
	 * Returns the position to be used for the next navbar item
	 * @return integer
	 */
	function getNextItemPosition() {
		return max(array_keys(rubidium::$navbar)) + 1;
	}

	/**
	 * Returns info of specified navbar item
	 * @param integer $id
	 * @return array
	 */
	function getSingleItemInfo($id) {
		$table = classDB::getTable('navbar', 'id', '*', '`id` = '.$id, '');
		return $table[$id];
	}
	
	/**
	 * Checks whether post data is valid, sets appropriate error if not
	 * @return boolean
	 */
	function checkPostData() {
		switch (self::$post['action']) {
			case 'editItem':
				if (self::$post['itemTitle'] != '') {
					if (self::$post['itemUrl'] != '') {
						if (self::$post['id'] != '') {
							return true;
						} else {
							outputHandler::setLoadInfoVar('error', 'A valid item ID was not specified. Please check your configuration.');
							return false;
						}
					} else {
						outputHandler::setLoadInfoVar('error', 'You must enter a URL for the item.');
						return false;
					}
				} else {
					outputHandler::setLoadInfoVar('error', 'You must enter a title for the item.');
					return false;
				}
				break;
			case 'addItem':
				if (self::$post['itemTitle'] != '') {
					if (self::$post['itemUrl'] != '') {
						return true;
					} else {
						outputHandler::setLoadInfoVar('error', 'You must enter a URL for the item.');
						return false;
					}
				} else {
					outputHandler::setLoadInfoVar('error', 'You must enter a title for the item.');
					return false;
				}
				break;
			default:
				return false;
		}
	}
	
	/**
	 * Checks whether there's valid URL input
	 * @return boolean
	 */
	function checkUrlParams() {
		if (self::$get['edit'] != '' && in_array(self::$get['edit'], array_keys(self::$itemList)) ) {
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
