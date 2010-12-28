<?php
class outputHandler {
	static public $toLoad = array();
	static public $pageInfo = array();
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
	static public function buildPage() {
		$outputClass	= "output_" . self::$toLoad['mode'];
		$header		= $outputClass::buildHeader();
		$content	= $outputClass::buildContent(self::$toLoad);
		$footer		= $outputClass::buildFooter();
		$output		= $header . $content . $footer;
		self::$pageInfo = classDB::getPage(1);
		return $output;
	}
	//Putting default functions here, will overload them from other output modes
	static public function buildHeader() {
		$title = self::$pageInfo['title'];
		require (TEMPLATES_DIR . 'header.php');
		return $header;
	}
	static public function buildFooter() {
		$footerText = rubidium::$settings['footer']['value'];
		require (TEMPLATES_DIR . 'footer.php');
		return $footer;
	}
	static public function buildContent($toLoad = null) {
		return "<div id='content'>Fatal error: The output handler hasn't been correctly set up.</div>";
	}
}
