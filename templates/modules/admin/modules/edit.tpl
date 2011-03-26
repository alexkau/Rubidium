<form action="{$smarty.server.REQUEST_URI}" method="post">
Module name: <input type="text" name="name" value="{$loadInfo.moduleToEdit.name}"></input><br /><br />
<input type="hidden" value="{$loadInfo.moduleToEdit.numeric_id}" name="id" />
<input type="hidden" value="edit" name="action" />
<input type="submit" class='button' value="Save changes" />
{if $loadInfo.moduleToEdit.enabled}
	<a class='button' href='{$loadInfo.request_url}&disable=true'>Disable module</a>
{else}
	<a class='button' href='{$loadInfo.request_url}&enable=true'>Enable module</a>
{/if}
<a class='button negative' onclick="javascript:confirmDeleteModule('{$smarty.server.REQUEST_URI}&delete=true')">Remove module</a>
</form>