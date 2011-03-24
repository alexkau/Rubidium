<?php
switch ($_GET['method']) {
	case 'sortable_admin':
		session_start();
		define("PRINT_FILENAMES",0);
		define("ROOT_PATH",dirname( __FILE__ ) . "/../");
		require ( ROOT_PATH . "/sources/core.php");
		rubidium::instantiate();
		require ( ROOT_PATH . "/modules/admin/frontend/handler.php");
		if (module_admin::checkAuthorization()) {
			foreach ($_GET['list'] as $position => $id) {
				classDB::store1('navbar', array('position' => $position), "`id` = $id");
			}
		} else {
			echo 'Access denied. Please ensure you are correctly logged in.';
		}
		classDB::close();
		break;
	default:
		break;
}