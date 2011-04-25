<?php
/**
 * Admin CP login handler
 * @package rubidium 
 */

if (IN_RUBIDIUM != 1) {
	die('This file cannot be accessed directly.');
}

/**
 * Admin CP login handler
 * @author alex
 * @package rubidium
 */
class module_admin_admin_login {
	static public $loginKey = null;
	
	/**
	 * Checks the login, sets necessary variables if credentials are valid, redirects to ACP index if authorized
	 */
	function execute() {
		if (module_admin::$authorized) {
			header("Location: index.php?mode=admin&module=admin&section=index");
			die();
		}
		if (rubidium::$request['POST']['password'] != '') {
			if (rubidium::checkPassword(rubidium::$request['POST']['password'])) {
				module_admin_admin::$pageContent['loginsuccessful'] = true;
				self::$loginKey = rubidium::generateLoginKey();
				classDB::update('admin_info', array('value' => self::$loginKey), "`name` = 'login_key'");
				classDB::update('admin_info', array('value' => time() + 1800), "`name` = 'timeout_time'");
				$_SESSION['loginkey'] = self::$loginKey;
				header('Location: index.php?mode=admin&module=admin&section=index');
				die();
			} else {
				module_admin_admin::$pageContent['loginfailed'] = true;
			}
		}
	}
}
