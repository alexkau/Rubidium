<?php
echo (PRINT_FILENAMES) ? __FILE__ . "<br />" : '';
class module_admin_admin_navbar {
	static public $post	= array();
	static public $get	= array();
	static public $itemList	= array();
	static public $urlMode	= null;
	
	function execute() {
		self::$post	= rubidium::$request['POST'];
		self::$get	= rubidium::$request['GET'];
		self::updateItemList();
		if (self::checkPostData()) {
			switch (self::$post['action']) {
				case 'editItem':
					//classDB::store1('module_page_pages', array('title' => self::$post['pageTitle'], 'content' => self::$post['pageContent'], 'last_updated' => time()), '`id` = '.self::$post['id']);
					outputHandler::setLoadInfoVar('changesMade', true);
					break;
				case 'addItem':
					$itemTitle	= self::$post['itemTitle'];
					$itemUrl	= self::$post['itemUrl'];
					$regex		= self::$post['itemRegex'];
					classDB::insert('navbar', array('title' => $itemTitle, 'url' => $itemUrl, 'regex' => $regex, 'position' => self::getNextItemPosition()));
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
					outputHandler::setLoadInfoVar('subsection', 'add');
					break;
				default:
					break;
			}
		}
	}
	
	function updateItemList() {
		self::$itemList = classDB::getTable('navbar', 'id', 'id, position, title, url, regex', '', array());
		rubidium::$navbar = classDB::getTable('navbar', 'position', 'id, position, title, url, regex', '', array( 'order_by' => 'position', 'order_dir' => 'ASC' ));
	}
	
	function getNextItemPosition() {
		return max(array_keys(rubidium::$navbar)) + 1;
	}

	function getSingleItemInfo($id) {
		$table = classDB::getTable('navbar', 'id', '*', '`id` = '.$id, '');
		return $table[$id];
	}
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
