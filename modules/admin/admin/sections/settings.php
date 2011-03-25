<?php
echo (PRINT_FILENAMES) ? __FILE__ . "<br />" : '';
class module_admin_admin_settings {
	static public $post	= array();
	
	function execute() {
		self::$post	= rubidium::$request['POST'];
		self::processPostData();
	}
	
	function processPostData() {
		switch (self::$post['action']) {
			case changePassword:
				if (self::$post['oldpassword'] != '' || self::$post['newpassword1'] != '' || self::$post['newpassword2'] != '') {
					if (self::$post['oldpassword'] != '' && self::$post['newpassword1'] != '' && self::$post['newpassword2'] != '') {
						if (rubidium::checkPassword(self::$post['oldpassword'])) {
							if (self::$post['newpassword1'] == self::$post['newpassword2']) {
								rubidium::setPassword(self::$post['newpassword1']);
								outputHandler::setLoadInfoVar('changesMade', true);
								return true;
							} else {
								outputHandler::setLoadInfoVar('error', "The new passwords did not match.");
								return true;
							}
						} else {
							outputHandler::setLoadInfoVar('error', "You did not enter the correct password.");
							return true;
						}
					} else {
						outputHandler::setLoadInfoVar('error', "You must enter a value for all three fields.");
						return true;
					}
				}
				break;
			case changeSiteUrl:
				if (self::$post['siteUrl'] != rubidium::$config['base_url']) {
					rubidium::changeconfigSetting('base_url', self::$post['siteUrl']);
					outputHandler::setLoadInfoVar('changesMade', true);
				}
				break;
			default:
				break;
		}
	}
}
