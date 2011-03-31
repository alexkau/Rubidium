<h2>Page Module Settings</h2>
{if $loadInfo.changesMade}
	<p class='message'>
		The change was successfully made.
	</p>
{/if}
<form action="{$smarty.server.REQUEST_URI}" method="post">
	<ul class='textInputList'>
		<li><span>Change default page</span>
			<select name="default">
				{foreach $loadInfo.pageList as $id => $data}
					<option value="{$id}"{if $id == $modules.page.default_action_value} selected{/if}>{$data.title}</option>
				{/foreach}
			</select>
		</li>
		<li><span>Change 404 page</span>
			<select name="404">
				{foreach $loadInfo.pageList as $id => $data}
					<option value="{$id}"{if $id == $settings.404_page.value} selected{/if}>{$data.title}</option>
				{/foreach}
			</select>
		</li>
	</ul>
	<input type='submit' class='primary button' value='Save changes'></input>
</form>
