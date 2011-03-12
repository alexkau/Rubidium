<?php
echo (PRINT_FILENAMES) ? __FILE__ . "<br />" : '';
class outputHandler {
	static public $toLoad			= array();
	static public $loadInfo			= array();
	static public $smarty			= null;
	static public $mode			= null;
	static public $workingModuleName	= null;
	static public $loadedModules		= array();
	static public $defaults			= array();
	
	function setDefaults() {
		self::$defaults['mode']		= rubidium::$settings['default_mode']['value'];
		self::$defaults['action']	= rubidium::$modules[rubidium::$settings['default_mode']['value']]['default_action'];
		self::$defaults['value']	= rubidium::$modules[rubidium::$settings['default_mode']['value']]['default_action_value'];
	}
	
	//What mode are we in?
	function determineMode() {
		self::setDefaults();
		self::$mode = rubidium::$request['GET']['mode'];
		require (ROOT_PATH . "sources/module_default.php");
		if (self::$mode != "") {
			if (file_exists (ROOT_PATH . "modules/" . self::$mode . "/frontend/handler.php")) {
				if(!in_array(self::$mode, self::$loadedModules)) {
					require (ROOT_PATH . "modules/" . self::$mode . "/frontend/handler.php");
					self::$loadedModules[] = self::$mode;
				}
				self::$workingModuleName = "module_" . self::$mode;
				$workingModule = new self::$workingModuleName();
				if ($workingModule::validateLoad()) {
					self::$loadInfo = $workingModule::returnPage();
					debug::addmessage('Loaded specified page');
				} else {
					self::load404();
				}
			} else {
				self::load404();
			}
		} else {
			if(!in_array(rubidium::$settings['default_mode']['value'], self::$loadedModules)) {
				require (ROOT_PATH . "modules/" . rubidium::$settings['default_mode']['value'] . "/frontend/handler.php");
				self::$loadedModules[] = rubidium::$settings['default_mode']['value'];
			}
			self::$workingModuleName = "module_" . rubidium::$settings['default_mode']['value'];
			$workingModule = new self::$workingModuleName();
			debug::addMessage("Loading default content");
			self::$loadInfo = $workingModule::returnPage(self::$defaults);
		}
	}
	
	//At this point, generic 404s are always handled by the page module
	static public function load404() {
		if(!in_array('page', self::$loadedModules)) {
			require (ROOT_PATH . "modules/page/frontend/handler.php");
			self::$loadedModules[] = 'page';
		}
		if (isset($workingModule)) {
			$workingModule->__destruct();
		}
		$workingModule = new module_page();
		self::$toLoad['mode']	= 'page';
		self::$toLoad['action']	= 'id';
		self::$toLoad['value']	= rubidium::$settings['404_page']['value'];
		debug::addMessage("Page not found, loading 404 error");
		self::$loadInfo = $workingModule::returnPage(self::$toLoad);
	}
	static public function setTemplateVars($smarty, $loadInfo, $toLoad) {
		$smarty->assign('toLoad',	$toLoad);
		$smarty->assign('loadInfo',	$loadInfo);
		$smarty->assign('config',	rubidium::$config);
		$smarty->assign('settings',	rubidium::$settings);
		$smarty->assign('modules',	rubidium::$modules);
	}
	static public function buildPage() {
		//Load the Smarty template engine
		require(SMARTY_DIR . 'Smarty.class.php');
		$smarty = new Smarty();
		$smarty->setTemplateDir	(ROOT_PATH . 'templates');
		$smarty->setCompileDir	(SMARTY_DIR . 'compile');
		$smarty->setCacheDir	(SMARTY_DIR . 'cache');
		$smarty->setConfigDir	(SMARTY_DIR . 'config');
		debug::addMessage("Template engine loaded");
		self::setTemplateVars($smarty, self::$loadInfo, self::$toLoad);
		if (self::$mode = 'admin') {
			$smarty->display('modules/admin/wrapper.tpl');
		} else {
			$smarty->display('core/wrapper.tpl');
		}
	}
}
