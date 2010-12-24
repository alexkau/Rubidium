<?php
class classPage {
	function buildHead ($config, $title) {
		$pageHead = "
			<!DOCTYPE HTML>		
			<html>
			<head>
				<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
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
			<br />
			{$footer}
			</body>
			</html>";
		return $pageFooter;
	}
	function buildPage($config, $title, $content, $footer) {
		$page = $this->buildHead($config, $title) . $this->buildContent($config, $content) . $this->buildFooter($config, $footer);
		echo $settings;
		return $page;
	}
}
