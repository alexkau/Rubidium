{if $loadInfo.changesMade}
	<p class='message'>
		The change was successfully made.
	</p>
{/if}
<form action="{$smarty.server.REQUEST_URI}" method="post">
<ul class='textInputList'>
	<li><span>Title</span><input type="text" name="itemTitle" value="{$loadInfo.itemEditInfo.title}"></input></li>
	<li><span>URL</span><input type="text" name="itemUrl" value="{$loadInfo.itemEditInfo.url}"></input></li>
	<li><span>Regex to match (optional)</span><input type="text" name="itemRegex" value="{$loadInfo.itemEditInfo.regex}"></input></li>
</ul>
<input type="submit" class='button' value="Save changes" />
<a class='button negative' onclick="javascript:confirmDeleteItem('{$smarty.server.REQUEST_URI}&delete=true')">Delete item</a>
<input type="hidden" value="{$loadInfo.itemEditInfo.id}" name="id" />
<input type="hidden" value="editItem" name="action" />
</form>