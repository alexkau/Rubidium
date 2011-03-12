<!DOCTYPE HTML>		
<html>
<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
	<title>{$loadInfo.title}</title>
	<link rel='stylesheet' href='{$config.base_url}/css/main.css' type='text/css' />
</head>
<body>
<br />
<br />
<br />
<br />
<br />
<br />
	<div id='wrapper'>
		{include file="`$smarty.const.ROOT_PATH`templates/core/header.tpl"}
		{include file="`$smarty.const.ROOT_PATH`templates/`$loadInfo.templateCategory`/`$loadInfo.templateToLoad`.tpl"}
		{include file="`$smarty.const.ROOT_PATH`templates/core/footer.tpl"}
	</div>
	
</body>
</html>
