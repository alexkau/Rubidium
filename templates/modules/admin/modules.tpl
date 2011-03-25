<h2>Manage Modules</h2>
{if $loadInfo.changesMade}
	<p class='message'>
		The change was successfully made.
	</p>
{else if $loadInfo.error}
	<p class='message error'>
		There was an error in making the change: {$loadInfo.error}
	</p>
{/if}
{if $loadInfo.message}
	<p class='message'>
		{$loadInfo.message}
	</p>
{/if}
{if $loadInfo.subsection}
	{include file="`$smarty.const.ROOT_PATH`templates/modules/admin/modules/`$loadInfo.subsection`.tpl"}
{else}
	{include file="`$smarty.const.ROOT_PATH`templates/modules/admin/modules/list.tpl"}
{/if}