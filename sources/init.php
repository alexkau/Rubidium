<?php
define("IN_ACP",0);

//Load required debug and core files
require(ROOT_PATH . 'sources/debug.php');
debug::addMessage("Loading file sources/debug.php");
require(ROOT_PATH . 'sources/core.php');
debug::addMessage("Loading file sources/core.php");

//Set up handler and get request info
$rubidium = new rubidium;
$rubidium::setup();
$rubidium::loadSettings();
$rubidium::getRequest();

//Load output handler and build page
require(ROOT_PATH . 'sources/output.php');
debug::addMessage("Loading file sources/output.php");
outputHandler::determineMode();
echo outputHandler::buildPage();

//Finalize debug output
debug::addMessage("Page rendered successfully");
echo (DEBUG == 1 || DEBUG == 2) ? debug::compileOutput() : '';
