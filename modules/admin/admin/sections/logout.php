<?php
/**
 * Admin CP logout handler
 * @package rubidium 
 */

/**
 * Admin CP logout handler
 * @author alex
 * @package rubidium
 */
class module_admin_admin_logout {
	/**
	 * Kill the login key on both ends
	 */
	function execute() {
		unset($_SESSION['loginkey']);
		classDB::update('admin_info', array('value' => ''), "`name` = 'login_key'");
	}
}
