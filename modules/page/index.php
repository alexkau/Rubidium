<?php
class module_page extends module_default {
	static public $idToLoad = null;
	function __construct() {
		//self::$content[''];
	}
	/* validateLoad
	 * Returns true if page exists or if no page is specified
	 * Returns false (404) if page is specified but doesn't exist
	 */
	function validateLoad() {
		if (rubidium::$request['GET']['id'] != '') {
			if (classDB::select('module_page_pages', '*', 'id = "' . rubidium::$request['GET']['id'] . '"')) {
				return true;
			} else {
				return false;
			}
		} else {
			return true;
		}
	}
	
	/* generatePage
	 * Gets page information from database
	 * Returns page info if it exists, otherwise returns false
	 * $idToLoad = ID of page to select (optional)
	 */
	function generatePage($idToLoad = null) {
		//If ID isn't set (normal page load), then assign value from GET
		if ($idToLoad == null) {
			//Loading specified page
			$idToLoad = rubidium::$request['GET']['id'];
		}

		if ($idToLoad == '') {
			$idToLoad = rubidium::$modules['page']['default_id'];
			debug::addMessage("Loading default page");
		}
		$pageInfo = classDB::select('module_page_pages','*','id = "' . $idToLoad . '"');
		if ($pageInfo) {
			$pageArray = $pageInfo->fetch_assoc();
			debug::addMessage('Page info: '.print_r($pageArray,true));
			outputHandler::$toLoad['template'] = 'page';
			return $pageArray;
		} else {
			return false;
		}
	}
}
