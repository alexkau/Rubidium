<?php
class module_admin extends module_default {
	
	static public available_modules		= array();
	static public pageContent			= null;
	
	function __construct() {
		//Load available_modules
	}
	/*	?mode=admin&module=page&section=list
		Load is valid if either:
		-No values specified
		-$_GET['module'] is in_array(available_modules)
			-> If it is, then load module's admin section: If requested page doesn't exist, then return true and give admin CP's 404 page	
	
	*/
	function validateLoad() {
		if (rubidium::$request['GET']['module'] != '') {
			if (/*module is available*/) {
				//Load module's admin page
				//Construct module
				//if ($module::validateLoad()) {
					//Load module's admin section
				//} else {
					//Load admin CP's 404
				//}
			} else {
				return false;
			}
		} else {
			return true;
		}
	}
	
	function load404() {
		self::$pageContent = "404!!!";
	}
	
	function returnPage() {
		return true;
	}
}
