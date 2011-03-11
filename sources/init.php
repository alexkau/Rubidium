<?php
echo (PRINT_FILENAMES) ? __FILE__ . "<br />" : '';
define("IN_ACP",0);

require(ROOT_PATH . 'sources/core.php');
rubidium::init();
