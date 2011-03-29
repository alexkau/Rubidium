{if $loadInfo.error}
	<p class='message error'>Error: {$loadInfo.error}</p>
{/if}
{if $loadInfo.moduleInstalled}
	<p class='message'>The module was successfully installed.</p>
{else}
	{if $loadInfo.moduleValidated}
		<p class='message'>The module "{$loadInfo.moduleToInstall}" is ready to install.
		<form action='index.php?mode=admin&module=admin&section=modules&install={$loadInfo.moduleToInstall}' method='post'>
			<input type='submit' class='button' value='Confirm installation' />
			<input type='hidden' name='action' value='install' />
		</form>
		</p>
	{else if $loadInfo.badXml}
		<p class='message error'>The module has an invalid installation routine. Installation cannot continue.</p>
	{else}
		<p class='message error'>The module appears to be incomplete. Installation cannot continue.</p>
	{/if}
{/if}