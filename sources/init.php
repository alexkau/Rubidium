<?php
require('sources/core.php');

$rubidium = new rubidium;
$rubidium::setup();
$rubidium::getRequest();
$rubidium::loadSettings();
$rubidium::determineMode();
$rubidium::addDebugMessage("test");
