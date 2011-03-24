<h2>Manage Navigation Bar</h2>
{if $loadInfo.error}
	<p class='message error'>
		There was an error in making the change: {$loadInfo.error}
	</p>
{/if}
{if $loadInfo.subsection}
	{include file="`$smarty.const.ROOT_PATH`templates/modules/admin/navbar/`$loadInfo.subsection`.tpl"}
{else}
	{include file="`$smarty.const.ROOT_PATH`templates/modules/admin/navbar/list.tpl"}
{/if}
