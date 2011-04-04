{include file="`$smarty.const.ROOT_PATH`templates/modules/admin/inlinehelp.tpl" message="This page lists the available modules to install. Click on a module's name to proceed with its installation.<br />If you have uploaded a module but no modules are listed here, contact the module's author for assistance."}
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
