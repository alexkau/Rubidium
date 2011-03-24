{if $loadInfo.changesMade}
	<p class='message'>
		The navbar item was successfully added.
	</p>
	{include file="`$smarty.const.ROOT_PATH`templates/modules/admin/navbar/list.tpl"}
{else}
	<form action="{$smarty.server.REQUEST_URI}" method="post">
	<ul class='textInputList'>
		<li><span>Title</span><input type="text" name="itemTitle"></input></li>
		<li><span>URL</span><input type="text" name="itemUrl"></input></li>
		<li><span>Regex to match (optional)</span><input type="text" name="itemRegex"></input></li>
	</ul>
	<input type="submit" class='button' value="Add item" />
	<input type="hidden" value="addItem" name="action" />
	</form>
{/if}