<?php
//Define the root path for all scripts
define( 'ROOT_PATH', dirname( __FILE__ ) . '/');
define( 'TEMPLATES_DIR', dirname( __FILE__ ) . '/templates/');
//Load the init file.. Here we go!
require('sources/init.php');
//require('sources/exceptions.php');





//If page id specified and is numeric
//For now, pages must be specified by number
/*if (isset($_GET['page']) && is_numeric($_GET['page'])) {
	$pageInfo = $DB->getPage($_GET['page']);
	//If it returned a page...
	if (! isset($pageInfo)) {
		$pageToPrint = $page->buildDefaultPage();
	} else {
		$pageToPrint = $pageInfo;
	}
}*/

/*$title = "Title!";
$content = "This is my page!";*/
//print_r(rubidium::$settings);
//echo $page->buildPage($config, $pageToPrint['title'], $pageToPrint['content'], rubidium::$settings['footer']['value']);

