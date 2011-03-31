<h2>System Settings</h2>
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
		<li><span>Site URL:</span><input type="text" name="siteUrl" value="{$config.base_url}" /><br />
		<li><span>Site title:</span><input type="text" name="siteTitle" value="{$settings.site_title.value}" /><br />
		<li><span>Site footer:</span><input type="text" name="footer" value="{$settings.footer.value}" /><br />
	</ul>
	<input type="hidden" value="changeSiteSettings" name="action" />
	<input type='submit' class='primary button' value='Change site settings' />
</form>
<form action="{$smarty.server.REQUEST_URI}" method="post">
	<ul class='textInputList'>
		<li><span>Old password:</span><input type="password" name="oldpassword" /><br />
		<li><span>New password:</span><input type="password" name="newpassword1" /><br />
		<li><span>Confirm new password:</span><input type="password" name="newpassword2" /><br />
	</ul>
	<input type="hidden" value="changePassword" name="action" />
	<input type='submit' class='primary button' value='Change administrator password' />
</form>