<div id='content'>
	{if $loadInfo.loginfailed}
		{include file="`$smarty.const.ROOT_PATH`templates/modules/admin/login/loginfailed.tpl"}
	{/if}
	{if $loadInfo.loginsuccessful}
		{include file="`$smarty.const.ROOT_PATH`templates/modules/admin/login/loginsuccessful.tpl"}
		<meta http-equiv='refresh' content='2; url={$config.base_url}/index.php?mode=admin&module=admin&section=index' /> 
	{else}
		{include file="`$smarty.const.ROOT_PATH`templates/modules/admin/login/loginbox.tpl"}
	{/if}
</div>
