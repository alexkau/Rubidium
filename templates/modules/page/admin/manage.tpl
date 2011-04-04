<h2>Manage Pages</h2>
{if $loadInfo.error}
<p class='message error'>{$loadInfo.error}</p>
{/if}
{if $loadInfo.subsection}
	{include file="`$smarty.const.ROOT_PATH`templates/modules/page/admin/`$loadInfo.subsection`.tpl"}
{else}
	{include file="`$smarty.const.ROOT_PATH`templates/modules/page/admin/pageList.tpl"}
{/if}
