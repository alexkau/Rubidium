<!DOCTYPE HTML>		
<html>
<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
	<title>{$loadInfo.title}</title>
	<link rel='stylesheet' href='{$config.base_url}/css/main.css' type='text/css' />
	<link rel='stylesheet' href='{$config.base_url}/css/admin.css' type='text/css' />
</head>
<body>
<br />
<br />
<hr />
Break here because of Chrome's autocomplete URL bar T__T
<hr />
<br />
<br />
	<div id='wrapper'{if $loadInfo.authorized && $loadInfo.templateToLoad != 'logout'} class='narrow'{/if}>
		{include file="`$smarty.const.ROOT_PATH`templates/modules/admin/header.tpl"}
		{if $loadInfo.authorized && $loadInfo.templateToLoad != 'logout'}
			{include file="`$smarty.const.ROOT_PATH`templates/modules/admin/sidebar.tpl"}
		{/if}
		<div id='content'>
			{include file="`$smarty.const.ROOT_PATH`templates/`$loadInfo.templateCategory`/`$loadInfo.templateToLoad`.tpl"}
		</div>
		{include file="`$smarty.const.ROOT_PATH`templates/core/footer.tpl"}
	</div>
	
</body>
</html>
