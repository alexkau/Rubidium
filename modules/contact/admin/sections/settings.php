<?php
/**
 * Settings section for contact form module
 * @package rubidium 
 */

/**
 * Settings section for contact form module
 * @author alex
 * @package rubidium
 */
class module_contact_admin_settings {
	static public $post	= array();
	static public $get	= array();
	static public $pageList	= array();
	
	/**
	 * Processes request
	 */
	function execute() {
		self::$post	= rubidium::$request['POST'];
		self::$get	= rubidium::$request['GET'];
		if (self::processPostData()) {
			outputHandler::setLoadInfoVar('changesMade', true);
			rubidium::getInfo();
		}
	}
	
	/**
	 * Checks each item for a change, updates it if it's different from the current value
	 * @return boolean
	 */
	function processPostData() {
		if (self::$post['email'] != rubidium::$settings['contact_email']['value'] && self::$post['email'] != '') {
			$changeMade = true;
			classDB::update('settings', array('value' => self::$post['email']), '`name` = "contact_email"');			
		}
		if (self::$post['public_key'] != rubidium::$settings['recaptcha_public_key']['value'] && self::$post['public_key'] != '') {
			$changeMade = true;
			classDB::update('settings', array('value' => self::$post['public_key']), '`name` = "recaptcha_public_key"');			
		}
		if (self::$post['private_key'] != rubidium::$settings['recaptcha_private_key']['value'] && self::$post['private_key'] != '') {
			$changeMade = true;
			classDB::update('settings', array('value' => self::$post['private_key']), '`name` = "recaptcha_private_key"');			
		}		
		if ($changeMade == 'true') {
			return true;
		} else {
			return false;
		}
	}
}
