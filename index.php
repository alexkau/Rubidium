<?php

global $settings;

require('sources/core.php');
$rubidium = new rubidium;

require('config.php');
$rubidium->config = $config;

require('sources/db.php');
$DB = new classDB;
$DB->connect($rubidium->config);

require('sources/functions.php');
$functions = new functions;

$options = array(
	"order_by" => "name",
	"order_dir" => "ASC"
);
$settings = $functions->buildSettings($DB->select("settings","name, value","",$options));

$rubidium->settings = $settings;






$functions->clean_array($_POST);
$functions->clean_array($_GET);
$functions->clean_array($_COOKIE);

require('sources/page.php');
$page	= new classPage;

require('sources/exceptions.php');





//If page id specified and is numeric
//For now, pages must be specified by number
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
	$pageInfo = $DB->getPage($_GET['page']);
	//If it returned a page...
	if (! isset($pageInfo)) {
		$pageToPrint = $page->buildDefaultPage();
	} else {
		$pageToPrint = $pageInfo;
	}
}

/*$title = "Title!";
$content = "This is my page!";*/

echo $page->buildPage($config, $pageToPrint['title'], $pageToPrint['content'], $rubidium->settings['footer']['value']);

?>
