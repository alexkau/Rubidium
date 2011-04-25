<?php
/**
 * Output handler for page module
 * @package rubidium 
 */
 
if (IN_RUBIDIUM != 1) {
	die('This file cannot be accessed directly.');
}

/**
 * Output handler for page module
 * @author alex
 * @package rubidium
 */
class module_page {
	static public $idToLoad = null;
	static public $pageContent = null;
	static public $pageContentLoaded = false;
	
	/**
	 * Returns true if page exists or if no page is specified, otherwise false
	 * @return boolean
	 */
	function validateLoad() {
		if (rubidium::$request['GET']['id'] != '') {
			self::$pageContent = self::loadPage(rubidium::$request['GET']['ID']);
			if (is_array(self::$pageContent)) {
				self::$pageContentLoaded = true;
				return true;
			} else {
				return false;
			}
		} else {
			return true;
		}
	}
	
	/**
	 * Gets page information from database
	 * Returns page info if it exists, otherwise false
	 * @param integer $idToLoad
	 * @return string|boolean
	 */
	function loadPage($idToLoad) {
		//If ID isn't set (normal page load), then assign value from GET
		if ($idToLoad == null) {
			$idToLoad = rubidium::$request['GET']['id'];
		}
		$pageInfo = classDB::select('module_page_pages','*','id = "' . $idToLoad . '"');
		if ($pageInfo) {
			$pageArray = $pageInfo->fetch_assoc();
			//debug::addMessage('Page info: '.print_r($pageArray,true));
			$pageArray['templateCategory'] = 'modules/page';
			$pageArray['templateToLoad'] = 'page';
			return $pageArray;
		} else {
			return false;
		}
	}
	
	/**
	 * If we're telling it to load a specific page, then do it (overriding any previously loaded page).
	 * Otherwise, if we haven't already loaded a page, then load the default.
	 * @param integer $toLoad
	 * @return array
	 */
	function returnPage($toLoad) {
		if ($toLoad) {
			self::$pageContent = self::loadPage($toLoad['value']);
			self::$pageContentLoaded = true;
		}
		if (!self::$pageContentLoaded) {
			self::$pageContent = self::loadPage(rubidium::$modules['page']['default_action_value']);
			self::$pageContentLoaded = true;
			debug::addMessage("Loading default page");
		}
		return self::$pageContent;
	}
}
