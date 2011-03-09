<?php
class module_admin extends module_default {
	
	static public $available_modules	= array();
	static public $pageContent			= null;
	static public $pageContentLoaded	= false;
	static public $moduleToLoad			= null;
	static public $moduleAdminName		= null;
	
	function __construct() {
		self::$available_modules = classDB::getSimpleTable('modules','id','enabled = 1','');
		//If module is not specified, set to null; if module specified is admin, set to null; otherwise, set to specified module
		self::$moduleToLoad = (rubidium::$request['GET']['module'] != '') ? (rubidium::$request['GET']['module'] != 'admin') ? rubidium::$request['GET']['module'] : null : null;
	}
	/*	?mode=admin&module=page&section=list
		Load is valid if either:
		-No values specified
		-$_GET['module'] is in_array(available_modules)
			-> If it is, then load module's admin section: If requested page doesn't exist, then return true and give admin CP's 404 page	
	
	*/
	function validateLoad() {
		//If module is specified and they aren't trying to do something recursive here...
		if (rubidium::$request['GET']['module'] != '' && rubidium::$request['GET']['module'] != 'admin') {
			//and if the module exists...
			if (in_array(rubidium::$request['GET']['module'], self::$available_modules)) {
				require (ROOT_PATH . "modules/" . rubidium::$request['GET']['module'] . "/admin.php");
				self::$moduleAdminName = "module_" . rubidium::$request['GET']['module'] . "_admin";
				$moduleAdmin = new self::$moduleAdminName();
				if ($moduleAdmin::validateLoad()) {
					
				} else {
					self::load404();
				}
				return true;
			} else {
				return false;
			}
		} else {
			return true;
		}
	}
	
	function load404() {
		self::$pageContent['title']				= "404!!!";
		self::$pageContent['content']			= "404!!!";
		self::$pageContent['templateCategory']	= 'modules/admin';
		self::$pageContent['templateToLoad']	= 'generic';
		self::$pageContentLoaded = true;
	}
	
	function returnPage() {
		if (! self::$pageContentLoaded) {
			if (self::$moduleToLoad) {
				self::$pageContent = $moduleAdmin->returnPage();
//				self::$pageContent['title'] = 'placeholder';
//				self::$pageContent['content'] = 'module index for '.self::$moduleToLoad;
//				self::$pageContent['templateCategory'] = 'modules/admin';
//				self::$pageContent['templateToLoad'] = 'generic';
			} else {
				self::$pageContent['title'] = 'admin index';
				self::$pageContent['content'] = 'admin cp index page';
				self::$pageContent['templateCategory'] = 'modules/admin';
				self::$pageContent['templateToLoad'] = 'generic';
			}
		}
			return self::$pageContent;
	}
}