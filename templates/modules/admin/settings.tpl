<h2>System Settings</h2>
{include file="`$smarty.const.ROOT_PATH`templates/modules/admin/inlinehelp.tpl" message="This page is for managing various system settings related to the site.<br />From here, you can also change the password that you use to log in to the administrator control panel."}
{if $loadInfo.changesMade}
	<p class='message'>
		The change was successfully made.
	</p>
{else if $loadInfo.error}
	<p class='message error'>
		There was an error in making the change: {$loadInfo.error}
	</p>
{/if}
<form action="{$smarty.server.REQUEST_URI}" method="post">
	<ul class='textInputList'>
		<li><span>Site URL:</span><input type="text" class='wide' name="siteUrl" value="{$config.base_url}" /><br />
		<li><span>Site title:</span><input type="text" class='wide' name="siteTitle" value="{$settings.site_title.value}" /><br />
		<li><span>Site footer:</span><input type="text" class='wide' name="footer" value="{$settings.footer.value}" /><br />
		<li><span>Enable inline help?</span><input type='radio' name='useInlineHelp' value='1' id='yes' {if $inlineHelp}checked {/if}/><label for='yes'>Yes</label><input type='radio' name='useInlineHelp' value='0' id='no' {if !$inlineHelp}checked {/if}/><label for='no'>No</label></li>
	</ul>
	<input type="hidden" value="changeSiteSettings" name="action" />
	<input type='submit' class='primary button' value='Change site settings' />
</form>
<form action="{$smarty.server.REQUEST_URI}" method="post">
	<ul class='textInputList'>
		<li><span>Old password:</span><input type="password" class='wide' name="oldpassword" /><br />
		<li><span>New password:</span><input type="password" class='wide' name="newpassword1" /><br />
		<li><span>Confirm new password:</span><input type="password" class='wide' name="newpassword2" /><br />
	</ul>
	<input type="hidden" value="changePassword" name="action" />
	<input type='submit' class='primary button' value='Change administrator password' />
</form>
