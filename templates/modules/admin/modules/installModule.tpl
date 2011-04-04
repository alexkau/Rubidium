{if $loadInfo.error}
	<p class='message error'>Error: {$loadInfo.error}</p>
{/if}
{if $loadInfo.moduleInstalled}
	<p class='message'>The module was successfully installed.</p>
{else}
	{if $loadInfo.moduleValidated}
		{include file="`$smarty.const.ROOT_PATH`templates/modules/admin/inlinehelp.tpl" message="If you are ready to install this module, click 'Confirm installation'."}
		<p class='message'>The module "{$loadInfo.moduleToInstall}" is ready to install.
		<form action='index.php?mode=admin&module=admin&section=modules&install={$loadInfo.moduleToInstall}' method='post'>
			<input type='submit' class='button' value='Confirm installation' />
			<input type='hidden' name='action' value='install' />
		</form>
		</p>
	{else if $loadInfo.badXml}
		<p class='message error'>The module has an invalid installation routine. Installation cannot continue.<br />Please contact the module's author for assistance.</p>
	{else}
		<p class='message error'>The module appears to be incomplete. Installation cannot continue.<br />Please contact the module's author for assistance.</p>
	{/if}
{/if}
