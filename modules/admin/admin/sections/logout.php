<?php
echo (PRINT_FILENAMES) ? __FILE__ . "<br />" : '';
class module_admin_admin_logout {
	function execute() {
		unset($_SESSION['loginkey']);
		classDB::store('admin_info', 'value', '', "`name` = 'login_key'");
	}
}
