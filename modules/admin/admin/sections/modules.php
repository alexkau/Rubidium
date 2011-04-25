<?php
/**
 * Module management handler
 * @package rubidium 
 */

if (IN_RUBIDIUM != 1) {
	die('This file cannot be accessed directly.');
}

/**
 * Module management handler
 * @author alex
 * @package rubidium
 */
class module_admin_admin_modules {
	static public $post		= null;
	static public $get		= null;
	static public $moduleList	= null;
	static public $urlMode		= null;
	
	/**
	 * Processes request if it's valid, passes necessary variables to output handler
	 */
	function execute() {
		self::$post	= rubidium::$request['POST'];
		self::$get	= rubidium::$request['GET'];
		self::updateModuleList();
		if (self::checkPostData()) {
			switch (self::$post['action']) {
				case 'edit':
					classDB::update('modules', array('name' => self::$post['name']), '`numeric_id` = '.self::$post['id']);
					outputHandler::setLoadInfoVar('changesMade', true);
					rubidium::getInfo();
					self::updateModuleList();
					break;
				case 'install':
					$toInstall = self::$get['install'];
					if (self::validateModuleForInstall($toInstall)) {
						
						$xml = self::getInstallXml($toInstall);
						classDB::insert('modules', array(	'id' => $xml->moduleInfo->module_id,
											'name' => $xml->moduleInfo->module_name,
											'default_action' => $xml->moduleInfo->default_action,
											'default_action_value' => $xml->moduleInfo->default_action_value,
											'enabled' => '1',
											'protected' => '0'));
						classDB::createSectionsTable($toInstall);
						foreach ($xml->sections->section as $id => $content) {
							classDB::insert("module_{$toInstall}_sections", array('name' => $content->name, 'public_name' => $content->public_name, 'pageInfo' => $content->pageInfo));
						}
					} else {
						outputHandler::setLoadInfoVar('error', 'The specified module is invalid.');
					}
					outputHandler::setLoadInfoVar('moduleInstalled', true);
					rubidium::getInfo();
					self::updateModuleList();
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
				case 'installList':
					outputHandler::setLoadInfoVar('subsection', 'installList');
					outputHandler::setLoadInfoVar('installableModules', self::getInstallableModules());
					break;
				case 'installConfirm':
					outputHandler::setLoadInfoVar('subsection', 'installModule');
					if (self::validateModuleForInstall(self::$get['install'])) {
						if (self::getInstallXml(self::$get['install'])) {
							outputHandler::setLoadInfoVar('moduleValidated', true);
							outputHandler::setLoadInfoVar('moduleToInstall', self::$get['install']);
						} else {
							outputHandler::setLoadInfoVar('badXml', true);
						}
					} else {
						outputHandler::setLoadInfoVar('moduleValidated', false);
					}
				default:
					break;
			}
		}
		if (self::$get['delete'] == 'true' && in_array(self::$get['edit'], array_keys(self::$moduleList))) {
			if (!self::$moduleList[self::$get['edit']]['protected']) {
				$toDelete = self::$get['edit'];
				classDB::delete('modules', "`numeric_id` = {$toDelete}");
				classDB::deleteSectionsTable($toDelete);
				outputHandler::setLoadInfoVar('subsection', null);
				outputHandler::setLoadInfoVar('message', 'The module was successfully removed.');
				self::updateModuleList();
				rubidium::getInfo();
				outputHandler::setLoadInfoVar('moduleToEdit', self::$moduleList[self::$get['edit']]);
			} else {
				outputHandler::setLoadInfoVar('error', 'This module is protected; you cannot disable or remove it.');
			}
		} else if (self::$get['disable'] == 'true' && in_array(self::$get['edit'], array_keys(self::$moduleList))) {
			if (!self::$moduleList[self::$get['edit']]['protected']) {
				classDB::update('modules', array('enabled' => 0), '`numeric_id` = '.self::$get['edit']);
				outputHandler::setLoadInfoVar('message', 'The module was successfully disabled.');
				self::updateModuleList();
				rubidium::getInfo();
				outputHandler::setLoadInfoVar('moduleToEdit', self::$moduleList[self::$get['edit']]);
			} else {
				outputHandler::setLoadInfoVar('error', 'This module is protected; you cannot disable or remove it.');
			}
		} else if (self::$get['enable'] == 'true' && in_array(self::$get['edit'], array_keys(self::$moduleList))) {
			classDB::update('modules', array('enabled' => 1), '`numeric_id` = '.self::$get['edit']);
			outputHandler::setLoadInfoVar('message', 'The module was successfully enabled.');
			self::updateModuleList();
			rubidium::getInfo();
			outputHandler::setLoadInfoVar('moduleToEdit', self::$moduleList[self::$get['edit']]);
		}
		outputHandler::setLoadInfoVar('request_url', preg_replace('/\&(disable|enable)=true/i', '', $_SERVER['REQUEST_URI']));
		outputHandler::setLoadInfoVar('fullModuleList', self::$moduleList);
	}
	
	/**
	 * Gets all installed modules from database
	 */
	function updateModuleList() {
		self::$moduleList = classDB::getTable('modules', 'numeric_id', '*', '', '');
	}

	/**
	 * Checks for valid post data to process
	 * @return boolean
	 */
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
			case 'install':
				return true;
				break;
			default:
				return false;
		}
	}
	
	/**
	 * Checks for valid url parameters
	 * @return boolean
	 */
	function checkUrlParams() {
		if (self::$get['edit'] != '' && in_array(self::$get['edit'], array_keys(self::$moduleList)) ) {
			self::$urlMode = 'edit';
			return true;
		} else if (self::$get['install'] == 'true') {
			self::$urlMode = 'installList';
			return true;
		} else if (self::$get['install'] != '') {
			self::$urlMode = 'installConfirm';
			return true;
		} else {
			return false;
		}
	}
	
	/**
	 * Gets all modules that exist in the filesystem and aren't installed
	 * @return array
	 */
	function getInstallableModules() {
		$moduleTemp = array();
		//Need to get all modules (enabled or disabled), except sorted by name this time
		$moduleNames = classDB::getSimpleTable('modules', 'id', '', '');
		$module_dir = dir(ROOT_PATH . 'modules/');
		while (false !== ($dir = $module_dir->read())) {
			if ($dir != '.' && $dir != '..' && is_dir(ROOT_PATH . 'modules/' . $dir) && !in_array($dir, $moduleNames)) {
				$moduleTemp[] = $dir;
			}
		}
		return $moduleTemp;
	}
	
	/**
	 * Checks whether the module has admin/frontend handlers, template directory, and xml info file
	 * @param string $moduleName
	 * @return boolean
	 */
	function validateModuleForInstall($moduleName) {
		$modulePath = ROOT_PATH . 'modules/' . $moduleName;
		if (		is_dir($modulePath) &&
				file_exists($modulePath . '/admin/handler.php') &&
				file_exists($modulePath . '/frontend/handler.php') &&
				is_dir(ROOT_PATH . 'templates/modules/' . $moduleName) &&
				file_exists($modulePath . '/admin/install.xml')) {
			return true;
		} else {
			return false;
		}
	}
	
	/**
	 * Gets the XML info file for the specified module
	 * @param string $moduleName
	 * @return SimpleXMLElement|boolean
	 */
	function getInstallXml($moduleName) {
		if ( $xml = simplexml_load_file(ROOT_PATH . 'modules/' . $moduleName . '/admin/install.xml') ) {
			return $xml;
		} else {
			return false;
		}
	}
}
