<?php
/**
 * Sets constants, starts things rolling...
 * @package rubidium 
 */
error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);

//Define the root path for all scripts
define('ROOT_PATH', dirname( __FILE__ ) . '/');

//Define the root path for the Smarty template system
define('SMARTY_DIR', dirname( __FILE__ ) . '/3rdparty/smarty/');

//Tells other scripts that it's okay to execute
define('IN_RUBIDIUM', 1);

//Load the init file.. Here we go!
require(ROOT_PATH . 'sources/init.php');