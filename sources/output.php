<?php
class outputHandler {
	static public $toLoad = array();
	
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
			debug::addMessage("No valid load values specified, loading default page");
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
}
