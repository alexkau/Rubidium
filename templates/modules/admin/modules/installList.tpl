{if $loadInfo.installableModules}
	Click a module to install it. You will have a chance to confirm the installation on the next page.<br/><br/>
	<ul>
		{foreach $loadInfo.installableModules as $k => $name}
			<li><a href='index.php?mode=admin&module=admin&section=modules&install={$name}'>{$name}</a></li>
		{/foreach}
	</ul>
{else}
	There are no installable modules availabe.
{/if}