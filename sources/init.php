<?php
require(ROOT_PATH . 'sources/debug.php');
debug::addMessage("Loading file sources/debug.php");
require(ROOT_PATH . 'sources/core.php');
debug::addMessage("Loading file sources/core.php");

$rubidium = new rubidium;
$rubidium::setup();
$rubidium::loadSettings();
$rubidium::getRequest();

require(ROOT_PATH . 'sources/output.php');
debug::addMessage("Loading file sources/output.php");
outputHandler::determineMode();
outputHandler::loadContent(rubidium::$toLoad);
echo outputHandler::buildPage();

debug::addMessage("Page rendered successfully");

echo (DEBUG == 1 || DEBUG == 2) ? debug::compileOutput() : '';
