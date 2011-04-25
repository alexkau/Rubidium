<?php
/**
 * Admin CP settings handler
 * @package rubidium 
 */

if (IN_RUBIDIUM != 1) {
	die('This file cannot be accessed directly.');
}

/**
 * Admin CP settings handler
 * @author alex
 * @package rubidium
 */
class module_admin_admin_settings {
	static public $post	= array();
	
	/**
	 * Processes the request if any changes were made
	 */
	function execute() {
		self::$post	= rubidium::$request['POST'];
		self::processPostData();
	}
	
	/**
	 * Checks if any valid changes have been requested, sets them if they have
	 * @return boolean
	 */
	function processPostData() {
		switch (self::$post['action']) {
			case changeSiteSettings:
				if (self::$post['siteUrl'] != rubidium::$config['base_url']) {
					rubidium::changeConfigSetting('base_url', self::$post['siteUrl']);
					outputHandler::setLoadInfoVar('changesMade', true);
				}
				if (self::$post['siteTitle'] != rubidium::$settings['site_title']['value']) {
					classDB::update('settings', array('value' => self::$post['siteTitle']), '`name` = "site_title"');			
					outputHandler::setLoadInfoVar('changesMade', true);
					$reloadSettings = true;
				}
				if (self::$post['footer'] != rubidium::$settings['footer']['value']) {
					classDB::update('settings', array('value' => self::$post['footer']), '`name` = "footer"');			
					outputHandler::setLoadInfoVar('changesMade', true);
					$reloadSettings = true;
				}
				if (self::$post['useInlineHelp'] != rubidium::$settings['useInlineHelp']['value']) {
					classDB::update('settings', array('value' => self::$post['useInlineHelp']), '`name` = "useInlineHelp"');			
					outputHandler::setLoadInfoVar('changesMade', true);
					$reloadSettings = true;
				}
				if ($reloadSettings) {
					rubidium::getInfo();
				}
				break;
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
			default:
				break;
		}
	}
}
