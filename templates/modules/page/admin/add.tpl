{if $loadInfo.changesMade}
	<p class='message'>
		The page was successfully added.<br />
		You can view it at <a href="{$config.base_url}/index.php?mode=page&id={$loadInfo.newPageId}">{$config.base_url}/index.php?mode=page&id={$loadInfo.newPageId}</a>.
	</p>
	{include file="`$smarty.const.ROOT_PATH`templates/modules/page/admin/pageList.tpl"}
{else}
	<form action="{$smarty.server.REQUEST_URI}" method="post">
	Title: <input type="text" name="pageTitle"></input>
	<textarea class="editor" name="pageContent"></textarea>
	<input type="submit" class='button' value="Add page" />
	<input type="hidden" value="addPage" name="action" />
	</form>
{/if}
