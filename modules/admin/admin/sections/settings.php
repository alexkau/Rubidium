<?php
echo (PRINT_FILENAMES) ? __FILE__ . "<br />" : '';
class module_admin_admin_settings {
	static public $post	= array();
	
	function execute() {
		self::$post	= rubidium::$request['POST'];
		self::processPostData();
	}
	
	function processPostData() {
		if (self::$post['oldpassword'] != '' || self::$post['newpassword1'] != '' || self::$post['newpassword2'] != '') {
			if (self::$post['oldpassword'] != '' && self::$post['newpassword1'] != '' && self::$post['newpassword2'] != '') {
				if (rubidium::checkPassword(self::$post['oldpassword'])) {
					if (self::$post['newpassword1'] == self::$post['newpassword2']) {
						rubidium::setPassword(self::$post['newpassword1']);
						module_admin_admin::$pageContent['changesMade'] = true;
						return true;
					} else {
						module_admin_admin::$pageContent['error'] = "The new passwords did not match.";
						return true;
					}
				} else {
					module_admin_admin::$pageContent['error'] = "You did not enter the correct password.";
					return true;
				}
			} else {
				module_admin_admin::$pageContent['error'] = "You must enter a value for all three boxes.";
				return true;
			}
		}
	}
}
