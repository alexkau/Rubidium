<?php
/**
 * Output handler file
 * @package rubidium 
 */

if (IN_RUBIDIUM != 1) {
	die('This file cannot be accessed directly.');
}

/**
 * Output handler - General controller for output generation
 * @author alex
 * @package rubidium
 */
class outputHandler {
	static public $toLoad			= array();
	static public $loadInfo			= array();
	static public $loadInfoTemp		= array();
	static public $smarty			= null;
	static public $mode			= null;
	static public $workingModuleName	= null;
	static public $loadedModules		= array();
	static public $defaults			= array();
	
	/**
	 * Gets the necessary info for the default mode from the database and loads it to self::$defaults
	 */
	function setDefaults() {
		self::$defaults['mode']		= rubidium::$settings['default_mode']['value'];
		self::$defaults['action']	= rubidium::$modules[rubidium::$settings['default_mode']['value']]['default_action'];
		self::$defaults['value']	= rubidium::$modules[rubidium::$settings['default_mode']['value']]['default_action_value'];
	}
	
	/**
	 * Decides what mode to load, then gets page info from the appropriate mode's output handler
	 * Loads the defaults or throws a 404 if necessary
	 */
	function determineMode() {
		self::setDefaults();
		self::$mode = rubidium::$request['GET']['mode'];
		if (self::$mode != "" && in_array(self::$mode, array_keys(rubidium::$modules))) {
			if (file_exists (ROOT_PATH . "modules/" . self::$mode . "/frontend/handler.php")) {
				if(!in_array(self::$mode, self::$loadedModules)) {
					require (ROOT_PATH . "modules/" . self::$mode . "/frontend/handler.php");
					self::$loadedModules[] = self::$mode;
				}
				self::$workingModuleName = "module_" . self::$mode;
				$workingModule = new self::$workingModuleName();
				if ($workingModule->validateLoad()) {
					self::$loadInfo = $workingModule->returnPage();
					debug::addMessage('Loaded specified page');
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
			self::$loadInfo = $workingModule->returnPage(self::$defaults);
		}
	}
	
	/**
	 * Sets a variable that will be passed to Smarty (to be used in the template)
	 * @param string $key
	 * @param string $var
	 */
	function setLoadInfoVar($key, $var) {
		self::$loadInfoTemp[$key] = $var;
	}
	
	/**
	 * Loads the page module and the 404 error page
	 */
	static public function load404() {
		if (!in_array('page', self::$loadedModules)) {
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
		self::$loadInfo = $workingModule->returnPage(self::$toLoad);
	}
	
	/**
	 * Passes variables to Smarty for use in templates
	 * @param object $smarty
	 * @param array $loadInfo
	 * @param array $toLoad
	 */
	static public function setTemplateVars($smarty, $loadInfo, $toLoad) {
		$smarty->assign('toLoad',	$toLoad);
		foreach(self::$loadInfoTemp as $key => $var) {
			$loadInfo[$key] = $var;
		}
		$smarty->assign('loadInfo',	$loadInfo);
		//print_r($loadInfo);
		$smarty->assign('config',	rubidium::$config);
		$smarty->assign('settings',	rubidium::$settings);
		$smarty->assign('modules',	rubidium::$modules);
		$smarty->assign('navbar',	rubidium::$navbar);
		$smarty->assign('inlineHelp',	rubidium::$settings['useInlineHelp']['value']);
	}
	
	/**
	 * Loads Smarty, sets it up, builds and outputs the page
	 */
	static public function buildPage() {
		require(SMARTY_DIR . 'Smarty.class.php');
		$smarty = new Smarty();
		$smarty->setTemplateDir	(ROOT_PATH . 'templates');
		$smarty->setCompileDir	(SMARTY_DIR . 'compile');
		$smarty->setCacheDir	(SMARTY_DIR . 'cache');
		$smarty->setConfigDir	(SMARTY_DIR . 'config');
		debug::addMessage("Template engine loaded");
		self::setTemplateVars($smarty, self::$loadInfo, self::$toLoad);
		if (self::$mode == 'admin') {
			$smarty->display('modules/admin/wrapper.tpl');
		} else {
			$smarty->display('core/wrapper.tpl');
		}
	}
}
