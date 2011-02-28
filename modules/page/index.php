<?php
class module_page extends module_default {
	static public $idToLoad = null;
	static public $pageContent = null;
	
	/* validateLoad
	 * Returns true if page exists or if no page is specified
	 * Returns false (404) if page is specified but doesn't exist
	 */
	function validateLoad() {
		if (rubidium::$request['GET']['id'] != '') {
			self::$pageContent = self::loadPage(rubidium::$request['GET']['ID']);
			//if (classDB::select('module_page_pages', '*', 'id = "' . rubidium::$request['GET']['id'] . '"')) {
			if (is_array(self::$pageContent)) {
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
	function loadPage($idToLoad = null) {
		//If ID isn't set (normal page load), then assign value from GET
		if ($idToLoad == null) {
			//Loading specified page
			$idToLoad = rubidium::$request['GET']['id'];
		}
		$pageInfo = classDB::select('module_page_pages','*','id = "' . $idToLoad . '"');
		if ($pageInfo) {
			$pageArray = $pageInfo->fetch_assoc();
			debug::addMessage('Page info: '.print_r($pageArray,true));
			$pageArray['templateCategory'] = 'modules/page';
			$pageArray['templateToLoad'] = 'page';
			return $pageArray;
		} else {
			return false;
		}
	}
	
	/* returnPage
	 * $loadInfo['id'] = ID of page to load
	 * If page content is already loaded, don't waste another database query on it...
	 */
	function returnPage($loadInfo) {
		//If we're being told to load a different ID from what we loaded earlier...
		if (self::$pageContent['id'] != $loadInfo['id']) {
			self::$pageContent = self::loadPage($loadInfo['id']);
		}
		//And if we didn't load anything earlier and aren't being told to load anything...
		if ($loadInfo['id'] == '') {
			self::$pageContent = self::loadPage(rubidium::$modules['page']['default_id']);
			debug::addMessage("Loading default page");
		}
		return self::$pageContent;
	}
}
