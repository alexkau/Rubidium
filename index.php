<?php

require('config.php');
require('sources/db.php');
require('sources/page.php');
require('sources/exceptions.php');
require('sources/functions.php');

//Set up classes
$DB		= new classDB($config);
$page		= new classPage();
$functions	= new functions();

//If page id specified
if ($_GET['page']) {
	//Clean input for DB
	$pageID = $functions->cleanDBInput($_GET['page']);

	//If it returned a page...
	if ($pageInfo = $DB->getPage($pageID)) {
		echo "Default index page";
	}
}


		
		
		

$title = "Title!";
$content = "This is my page!";
$footer = "&copy; 2010";

//echo $page->buildPage($config, $title, $content, $footer);
echo $page->buildPage($config, $title, $content, $footer);
?>
