<!DOCTYPE HTML>		
<html>
<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
	<title>{$loadInfo.title}</title>
	<link rel='stylesheet' href='{$config.base_url}/css/main.css' type='text/css' />
</head>
<body>
	<div id='wrapper'>
		{include file='header.tpl'}
		{include file="`$toLoad.mode`.tpl"}
		{include file='footer.tpl'}
	</div>
</body>
</html>
