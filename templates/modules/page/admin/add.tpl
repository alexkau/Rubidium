{if $loadInfo.changesMade}
	<p class='message'>
		The page was successfully added.<br />
		You can view it at <a href="{$config.base_url}/index.php?mode=page&id={$loadInfo.newPageId}">{$config.base_url}/index.php?mode=page&id={$loadInfo.newPageId}</a>.
	</p>
	{include file="`$smarty.const.ROOT_PATH`templates/modules/page/admin/pageList.tpl"}
{else}
	{include file="`$smarty.const.ROOT_PATH`templates/modules/admin/inlinehelp.tpl" message="From here, you can add a new page.<br />Fill in the title and desired page content and click the 'Add Page' button."}
	<form action="{$smarty.server.REQUEST_URI}" method="post">
	Title: <input type="text" name="pageTitle" value="{$smarty.post.pageTitle}"></input>
	<textarea class="editor" name="pageContent">{$smarty.post.pageContent}</textarea>
	<input type="submit" class='button' value="Add page" />
	<input type="hidden" value="addPage" name="action" />
	</form>
{/if}
