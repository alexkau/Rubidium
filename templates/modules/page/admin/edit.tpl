<form action="{$smarty.server.REQUEST_URI}" method="post">
{if $loadInfo.changesMade}
	<p class='message'>Your changes were successfully made.</p>
{/if}
Title: <input type="text" name="pageTitle" value="{$loadInfo.pageEditInfo.title}"></input>
<textarea class="editor" name="pageContent">{$loadInfo.pageEditInfo.content}</textarea>
<input type="submit" class='button' value="Save changes" />
<a class='button negative' onclick="javascript:confirmDelete('{$smarty.server.REQUEST_URI}&delete=true')">Delete page</a>
<input type="hidden" value="{$loadInfo.pageEditInfo.id}" name="id" />
<input type="hidden" value="editPage" name="action" />
</form>
