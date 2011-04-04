{if $inlineHelp}
	{include file="`$smarty.const.ROOT_PATH`templates/modules/admin/inlinehelp.tpl" message="Welcome to Rubidium!<br /><br />To get started, click on the 'Pages' tab and follow the directions to create and edit your website's pages.<br />Next, click on the 'Dashboard' tab to return to this page and then visit the menus on the left to customize your site's settings and navigation bar.<br /><br />These inline help messages can be disabled or re-enabled from the Settings section."}
{else}
	<p class='message info'>Welcome to the Rubidium administrator control panel.</p>
{/if}