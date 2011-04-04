{include file="`$smarty.const.ROOT_PATH`templates/modules/admin/inlinehelp.tpl" message="From here, you can edit or delete a page.<br />After making your desired changes, click the 'Save changes' button.<br />If you wish to delete this page, click the 'Delete page' button."}
{if $loadInfo.changesMade}
	<p class='message'>Your changes were successfully made.</p>
{/if}
<form action="{$smarty.server.REQUEST_URI}" method="post">
Title: <input type="text" name="pageTitle" value="{$loadInfo.pageEditInfo.title}"></input>
<textarea class="editor" name="pageContent">{$loadInfo.pageEditInfo.content}</textarea>
<a class='button' href="index.php?mode=page&id={$loadInfo.pageEditInfo.id}">View page</a>
<input type="submit" class='button' value="Save changes" />
<a class='button negative' onclick="javascript:confirmDelete('{$smarty.server.REQUEST_URI}&delete=true')">Delete page</a>
<input type="hidden" value="{$loadInfo.pageEditInfo.id}" name="id" />
<input type="hidden" value="editPage" name="action" />
</form>
