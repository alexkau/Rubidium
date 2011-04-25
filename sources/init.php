<?php

if (IN_RUBIDIUM != 1) {
	die('This file cannot be accessed directly.');
}

/**
 * Loads and runs Rubidium
 * @package rubidium 
 */
require(ROOT_PATH . 'sources/core.php');
rubidium::init();
