<?php
class module_admin_admin_login {
	static public $loginKey = null;
	function execute() {
		if (rubidium::$request['POST']['password'] != '') {
			if (rubidium::checkPassword(rubidium::$request['POST']['password'])) {
				module_admin_admin::$pageContent['loginsuccessful'] = true;
				session_start();
				//Generate login key
				self::$loginKey = rubidium::generateLoginKey();
				//Store login key and timeout time in the DB
				//After half an hour, login key will be invalid
				//Timeout will be refreshed on every page load
				classDB::store('admin_info', 'login_key', self::$loginKey, "`name` = 'login_key'");
				classDB::store('admin_info', 'timeout_time', time() + 1800, "`name` = 'timeout_time'");
				//Set login key in cookie
				$_SESSION['loginkey'] = self::$loginKey;
print_r($_SESSION);
			} else {
				module_admin_admin::$pageContent['loginfailed'] = true;
			}
		}
	}
}