{if $loadInfo.changesMade}
	<p class='message'>
		The navbar item was successfully added.
	</p>
	{include file="`$smarty.const.ROOT_PATH`templates/modules/admin/navbar/list.tpl"}
{else}
	{include file="`$smarty.const.ROOT_PATH`templates/modules/admin/inlinehelp.tpl" message="From here, you can add a link to the navigation bar.<br />After entering the desired title and URL for the link, click the 'Add Item' button.<br />If a value is entered for 'Regex to match', the link will be highlighted when the specified regular expression matches against the current URL. This feature is for advanced users only, however an automatic generator for these regular expressions will be added soon."}
	<form action="{$smarty.server.REQUEST_URI}" method="post" name='navbaradd' class='navbaraddform'>
		<ul class='textInputList'>
			<li><span>Title</span><input type="text" name="itemTitle"></input></li>
			<li><span>URL</span><input type="text" name="itemUrl"></input></li>
			<li><span>Regex to match (optional)</span><input type="text" name="itemRegex"></input></li>
		</ul>
		<input type="submit" class='button' value="Add item" />
		<input type="hidden" value="addItem" name="action" />
	</form>
	<div class='navbaraddform'>
		<p class='message'>Select a page to automatically generate a navbar item for it.</p>
		<select onchange="generateNavbarItem(this.options[this.selectedIndex].value)">
			<option value=''>Select a page</option>
			{foreach $loadInfo.pageList as $id => $data}
				<option value='{$data.title}|!|!|{$id}'>{$data.title}</option>
			{/foreach}
		</select>
	</div>
{/if}
<br class='clear' />