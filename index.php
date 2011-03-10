<?php

//Define the root path for all scripts
define('ROOT_PATH', dirname( __FILE__ ) . '/');

//Define the root path for the Smarty template system
define('SMARTY_DIR', dirname( __FILE__ ) . '/3rdparty/smarty/');

//Load the init file.. Here we go!
require(ROOT_PATH . 'sources/init.php');
