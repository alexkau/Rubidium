<?php
class outputHandler {
	static public $toLoad			= array();
	static public $loadInfo			= array();
	static public $smarty			= null;
	static public $mode			= null;
	static public $workingModuleName	= null;
	
	//What mode are we in?
	//Right now it's just an if->else, but eventually will be if->else if->....->else
	//If 3rd-party addons are ever enabled, this will have to become a foreach..
	//Maybe do this for 1.x just in case, and for simplicity?
	function determineMode() {
		self::$mode = rubidium::$request['GET']['mode'];
		require (ROOT_PATH . "sources/module_default.php");
			
		if (self::$mode != "") {
			if (file_exists (ROOT_PATH . "modules/" . self::$mode . "/index.php")) {
				require (ROOT_PATH . "modules/" . self::$mode . "/index.php");
				self::$workingModuleName = "module_" . self::$mode;
				$workingModule = new self::$workingModuleName();
				if ($workingModule::validateLoad()) {
					self::$toLoad['mode']	= self::$mode;
					self::$toLoad['id']	= rubidium::$request['GET']['id'];
					self::$loadInfo = $workingModule::generatePage();
				} else {
					self::load404();
				}
			} else {
				require (ROOT_PATH . "modules/page/index.php");
				self::load404();
			}
		} else {
			self::$toLoad['mode']	= rubidium::$settings['default_mode']['value'];
			self::$toLoad['id']	= rubidium::$modules[rubidium::$settings['default_mode']['value']]['default_id'];
			require (ROOT_PATH . "modules/" . rubidium::$settings['default_mode']['value'] . "/index.php");
			self::$workingModuleName = "module_" . rubidium::$settings['default_mode']['value'];
			$workingModule = new self::$workingModuleName();
			debug::addMessage("Loading default content");
			self::$loadInfo = $workingModule::generatePage(self::$toLoad['id']);
		}
	}
	
	//At this point, 404s are always handled by the page module
	static public function load404() {
		if (isset($workingModule)) {
			$workingModule->__destruct();
		}
		$workingModule = new module_page();
		self::$toLoad['id'] = rubidium::$settings['404_page']['value'];
		self::$toLoad['mode'] = 'page';
		debug::addMessage("Loading 404 error");
		self::$loadInfo = $workingModule::generatePage(self::$toLoad['id']);
	}
	static public function setTemplateVars($smarty, $loadInfo, $toLoad) {
		$smarty->assign('toLoad',	$toLoad);
		$smarty->assign('loadInfo',	$loadInfo);
		$smarty->assign('config',	rubidium::$config);
		$smarty->assign('settings',	rubidium::$settings);
	}
	static public function buildPage() {
		//Load the Smarty template engine
		require(SMARTY_DIR . 'Smarty.class.php');
		$smarty = new Smarty();
		$smarty->setTemplateDir	(SMARTY_DIR . 'templates');
		$smarty->setCompileDir	(SMARTY_DIR . 'compile');
		$smarty->setCacheDir	(SMARTY_DIR . 'cache');
		$smarty->setConfigDir	(SMARTY_DIR . 'config');
		debug::addMessage("Template engine loaded");
		self::setTemplateVars($smarty, self::$loadInfo, self::$toLoad);
		$smarty->display('wrapper.tpl');
	}
}
