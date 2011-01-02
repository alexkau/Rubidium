<?php
class outputHandler {
	static public $toLoad = array();
	static public $pageInfo = array();
	static public $smarty = null;
	//What mode are we in?
	//Right now it's just an if->else, but eventually will be if->else if->....->else
	function determineMode() {
		//If valid page load values are specified...
		if (rubidium::$request['GET']['mode'] == 'page' && is_numeric(rubidium::$request['GET']['id'])) {
			//...then we're loading that page!
			self::$toLoad = array(
					"mode" => "page",
					"id" => rubidium::$request['GET']['id'] );
		} else {
			//If none of the above, then we load the default page
			debug::addMessage("No valid load values specified, loading default index");
			$defaultID = "default_id_" . rubidium::$settings['default_mode']['value'];
			self::$toLoad = array(
					"mode" => "page",
					"id" => rubidium::$settings['default_page_id']['value'] );
		}
		debug::addMessage('Content to load: '.print_r(self::$toLoad,true));
	}
	static public function loadContent($toLoad) {
		require(ROOT_PATH . 'sources/content/'.self::$toLoad['mode'].'.php');
		debug::addMessage('Loading file sources/content/'.self::$toLoad['mode'].'.php');
	}
	static public function setTemplateVars($smarty, $pageInfo) {
		$smarty->assign('pageInfo',$pageInfo);
		$smarty->assign('config',rubidium::$config);
		$smarty->assign('settings',rubidium::$settings);
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
		self::$pageInfo = classDB::getPage(self::$toLoad['id']);
		self::setTemplateVars($smarty, self::$pageInfo);
		$smarty->display('wrapper.tpl');
		//$outputClass	= "output_" . self::$toLoad['mode'];
		/*$header		= $outputClass::buildHeader();
		$content	= $outputClass::buildContent(self::$toLoad);
		$footer		= $outputClass::buildFooter();
		$output		= $header . $content . $footer;*/
		return $output;
	}
	
}
