<div class='center' id='loginbox'>
	{if $loadInfo.loginfailed}
		{include file="`$smarty.const.ROOT_PATH`templates/modules/admin/login/loginfailed.tpl"}
	{else if $loadInfo.timeout}
		{include file="`$smarty.const.ROOT_PATH`templates/modules/admin/login/timeout.tpl"}
	{/if}
	{include file="`$smarty.const.ROOT_PATH`templates/modules/admin/login/loginbox.tpl"}
</div>
