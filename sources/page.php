<?php
class classPage {
	function buildHead ($config, $title) {
		$pageHead = "
			<!DOCTYPE HTML>		
			<html>
			<head>
				<title>{$title}</title>
				<link rel='stylesheet' href='{$config['base_url']}/css/main.css' type='text/css' />
			</head>
			<body>
				<div id='header'>
				</div>";
		return $pageHead;
	}
	function buildContent($config, $content) {
		$pageContent = $content;
		return $pageContent;
	}
	function buildFooter($config, $footer) {
		$pageFooter = "
			{$footer}
			</body>
			</html>";
		return $pageFooter;
	}
	function buildPage($config, $title, $content, $footer) {
		$page = $this->buildHead($config, $title) . $this->buildContent($config, $content) . $this->buildFooter($config, $footer);
		return $page;
	}
}
