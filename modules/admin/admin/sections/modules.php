<?php
class module_admin_admin_modules {
	static public $post		= null;
	static public $get		= null;
	static public $moduleList	= null;
	static public $urlMode		= null;
	
	function execute() {
		self::$post	= rubidium::$request['POST'];
		self::$get	= rubidium::$request['GET'];
		self::updateModuleList();
		if (self::checkPostData()) {
			switch (self::$post['action']) {
				case 'edit':
					classDB::store1('modules', array('name' => self::$post['name']), '`numeric_id` = '.self::$post['id']);
					outputHandler::setLoadInfoVar('changesMade', true);
					rubidium::getInfo();
					self::updateModuleList();
					break;
				case 'add':
					$pageTitle	= self::$post['pageTitle'];
					$pageContent	= self::$post['pageContent'];
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
		if (self::checkUrlParams()) {
			switch (self::$urlMode) {
				case 'edit':
					outputHandler::setLoadInfoVar('moduleToEdit', self::$moduleList[self::$get['edit']]);
					outputHandler::setLoadInfoVar('subsection', 'edit');
					break;
				case 'add':
					outputHandler::setLoadInfoVar('subsection', 'add');
					break;
				default:
					break;
			}
		}
		if (self::$get['delete'] == 'true' && in_array(self::$get['edit'], array_keys(self::$moduleList))) {
			if (!self::$moduleList[self::$get['edit']]['protected']) {
				$toDelete = self::$get['edit'];
				classDB::delete('modules', "`numeric_id` = {$toDelete}");
				outputHandler::setLoadInfoVar('subsection', null);
				outputHandler::setLoadInfoVar('message', 'The module was successfully removed.');
				self::updateModuleList();
				outputHandler::setLoadInfoVar('moduleToEdit', self::$moduleList[self::$get['edit']]);
			} else {
				outputHandler::setLoadInfoVar('error', 'This module is protected; you cannot disable or remove it.');
			}
		} else if (self::$get['disable'] == 'true' && in_array(self::$get['edit'], array_keys(self::$moduleList))) {
			if (!self::$moduleList[self::$get['edit']]['protected']) {
				classDB::store1('modules', array('enabled' => 0), '`numeric_id` = '.self::$get['edit']);
				outputHandler::setLoadInfoVar('message', 'The module was successfully disabled.');
				self::updateModuleList();
				outputHandler::setLoadInfoVar('moduleToEdit', self::$moduleList[self::$get['edit']]);
			} else {
				outputHandler::setLoadInfoVar('error', 'This module is protected; you cannot disable or remove it.');
			}
		} else if (self::$get['enable'] == 'true' && in_array(self::$get['edit'], array_keys(self::$moduleList))) {
			classDB::store1('modules', array('enabled' => 1), '`numeric_id` = '.self::$get['edit']);
			outputHandler::setLoadInfoVar('message', 'The module was successfully enabled.');
			self::updateModuleList();
			outputHandler::setLoadInfoVar('moduleToEdit', self::$moduleList[self::$get['edit']]);
		}
		outputHandler::setLoadInfoVar('request_url', preg_replace('/\&(disable|enable)=true/i', '', $_SERVER['REQUEST_URI']));
	}
	function updateModuleList() {
		self::$moduleList = classDB::getTable('modules', 'numeric_id', '*', '', '');
	}

	function checkPostData() {
		switch (self::$post['action']) {
			case 'edit':
				if (self::$post['name'] != '') {
					return true;
				} else {
					outputHandler::setLoadInfoVar('error', 'You must enter a name for the module.');
					return false;
				}
				break;
			default:
				return false;
		}
	}
	function checkUrlParams() {
		if (self::$get['edit'] != '' && in_array(self::$get['edit'], array_keys(self::$moduleList)) ) {
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