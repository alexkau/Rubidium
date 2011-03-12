<form action="{$smarty.server.REQUEST_URI}" method="post">
Title: <input type="text" name="pageTitle" value="{$loadInfo.pageEditInfo.title}"></input>
<textarea class="editor" name="pageContent">{$loadInfo.pageEditInfo.content}</textarea>
<input type="submit" class='button' value="Save changes" />
<input type="hidden" value="{$loadInfo.pageEditInfo.id}" name="id" />
<input type="hidden" value="editPage" name="action" />
</form>
