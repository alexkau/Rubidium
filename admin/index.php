<?php
//Define the root path for all scripts: /.. needs to be added to leave the admin directory
define('ROOT_PATH', dirname( __FILE__ ) . '/../');
define('ADMIN_DIR_PATH', dirname( __FILE__ ) . '/');
define('SMARTY_DIR', dirname( __FILE__ ) . '/../3rdparty/smarty/');
define('IN_ACP', 1);
//Load the init file.. Here we go!
require(ROOT_PATH . 'sources/init.php');
