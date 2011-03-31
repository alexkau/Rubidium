{if $loadInfo.installableModules}
	<p class='message'>Click a module to install it. You will have a chance to confirm the installation on the next page.</p>
	<ul class='textLinkList'>
		{foreach $loadInfo.installableModules as $k => $name}
			<li><a href='index.php?mode=admin&module=admin&section=modules&install={$name}'>{$name}</a></li>
		{/foreach}
	</ul>
{else}
	<p class='message'>There are no installable modules availabe.</p>
{/if}