<?php
echo (PRINT_FILENAMES) ? __FILE__ . "<br />" : '';
class module_admin extends module_default {
	
	static public $availableModules		= array();
	static public $pageContent		= null;
	static public $pageContentLoaded	= false;
	static public $moduleToLoad		= null;
	static public $moduleAdminName		= null;
	static public $authorized		= false;
	static public $timeout			= false;
	static public $onLoginPage		= false;
	
	function __construct() {
		self::$availableModules = classDB::getSimpleTable('modules','id','enabled = 1','');
		self::$moduleToLoad = (rubidium::$request['GET']['module'] != '') ? rubidium::$request['GET']['module'] : null;
		self::$onLoginPage = (rubidium::$request['GET']['module'] == 'admin' && rubidium::$request['GET']['section'] == 'login') ? true : false;
		self::checkAuthorization();
	}
	/*	?mode=admin&module=page&section=list
		Load is valid if either:
		-No values specified
		-$_GET['module'] is in_array(available_modules)
			-> If it is, then load module's admin section: If requested page doesn't exist, then return true and give admin CP's 404 page	
	
	*/
	
	function checkAuthorization() {
		$adminInfo = classDB::getTable('admin_info', 'name', 'name, value');
		session_start();
		if ($adminInfo['login_key']['value'] != '' && $_SESSION['loginkey'] == $adminInfo['login_key']['value'] && time() <= $adminInfo['timeout_time']['value']) {
			classDB::store('admin_info', 'value', time() + 1800, "`name` = 'timeout_time'");
			self::$authorized = true;
		}
		if (time() >= $adminInfo['timeout_time']['value']) {
			self::$timeout = true;
		}
	}
	function validateLoad() {

		//If module is specified and they aren't trying to do something recursive here...
		if (self::$moduleToLoad != '') {
			//and if the module exists...
			if (in_array(self::$moduleToLoad, self::$availableModules)) {
				require (ROOT_PATH . "modules/" . self::$moduleToLoad . "/admin.php");
				self::$moduleAdminName = "module_" . self::$moduleToLoad . "_admin";
				$moduleAdmin = new self::$moduleAdminName();
				if (!$moduleAdmin::validateLoad()) {
					self::load404();
				}
				unset($moduleAdmin);
				
			} else {
				self::load404();
			}
		}
		return true;
	}
	
	function load404() {
		self::$pageContent['title']				= "404!!!";
		self::$pageContent['content']			= "404!!!";
		self::$pageContent['templateCategory']	= 'modules/admin';
		self::$pageContent['templateToLoad']	= 'generic';
		self::$pageContentLoaded = true;
	}
	
	function returnPage() {
		if (self::$authorized || self::$onLoginPage) {
			if (! self::$pageContentLoaded) {
				if (self::$moduleToLoad) {
					$moduleAdmin = new self::$moduleAdminName();
					self::$pageContentLoaded = true;
					self::$pageContent = $moduleAdmin::returnPage();
				} else {
					self::$pageContent['title'] = 'admin index';
					self::$pageContent['content'] = 'admin cp index page';
					self::$pageContent['templateCategory'] = 'modules/admin';
					self::$pageContent['templateToLoad'] = 'generic';
				}
			}
		} else {
			header('Location: index.php?mode=admin&module=admin&section=login');
			die();
		}
	self::$pageContent['authorized']	= self::$authorized;
	self::$pageContent['timeout']		= self::$timeout;
	return self::$pageContent;
	}
}
